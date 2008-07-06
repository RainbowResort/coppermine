<?php

/**
 * Request wrapper class.  Prepares a request for consumption by the OAuth routines
 * 
 * @version $Id: OAuthRequest.php 5 2008-02-13 12:29:12Z marcw@pobox.com $
 * @author Marc Worrell <marc@mediamatic.nl>
 * @copyright (c) 2007 Mediamatic Lab
 * @date  Nov 16, 2007 12:20:31 PM
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


require_once dirname(__FILE__) . '/OAuthException.php';

/**
 * Object to parse an incoming OAuth request or prepare an outgoing OAuth request
 */
class OAuthRequest 
{
	/* the realm for this request */
	protected $realm;
	
	/* all the parameters, RFC3986 encoded name/value pairs */
	protected $param = array();

	/* the parsed request uri */
	protected $uri_parts;

	/* the raw request uri */
	protected $uri;

	/* the request headers */
	protected $headers;

	/* the request method */
	protected $method;
	
	/* the body of the OAuth request */
	protected $body;
	

	/**
	 * Construct from the current request. Useful for checking the signature of a request.
	 * When not supplied with any parameters this will use the current request.
	 * 
	 * @param string	uri				might include parameters
	 * @param string	method			GET, PUT, POST etc.
	 * @param string	parameters		additional post parameters, urlencoded (RFC1738)
	 * @param array		headers			headers for request
	 * @param string	body			optional body of the OAuth request (POST or PUT)
	 */
	function __construct ( $uri = null, $method = 'GET', $parameters = '', $headers = array(), $body = null )
	{
		$superCage = Inspekt::makeSuperCage();

		if (empty($uri))
		{			
			$method	= $superCage->server->getAlpha('REQUEST_METHOD');
			$matches = $superCage->server->getMatched('REQUEST_URI', '/^[0-9A-Za-z\/_.-]+$/');
			$uri = $matches[0];
			$headers      = getallheaders();
			$parameters   = '';
			$this->method = strtoupper($method);
			
			// If this is a post then also check the posted variables
			if (strcasecmp($method, 'POST') == 0)
			{
				/*
				// TODO: what to do with 'multipart/form-data'?
				if ($this->getRequestContentType() == 'multipart/form-data')
				{
					throw new OAuthException('Unsupported POST content type, expected "application/x-www-form-urlencoded" got "'.@$_SERVER['CONTENT_TYPE'].'"');
				}
				*/
				if ($this->getRequestContentType() == 'application/x-www-form-urlencoded')
				{
					// Get the posted body (when available)
					if (!isset($headers['X-OAuth-Test']))
					{
						$parameters .= $this->getRequestBody();
					}
				}
				else
				{
					$body = $this->getRequestBody();
				}
			}
			else if (strcasecmp($method, 'PUT') == 0)
			{
				$body = $this->getRequestBody();
			}
		}

		$this->method  = strtoupper($method);
		$this->headers = $headers;
		// Store the values, prepare for oauth
		$this->uri     = $uri;
		$this->body    = $body;
		$this->parseUri($parameters);
		$this->parseHeaders();
		$this->transcodeParams();
	}


	/**
	 * Return the signature base string.
	 * Note that we can't use rawurlencode due to specified use of RFC3986.
	 * 
	 * @return string
	 */
	function signatureBaseString ()
	{
		$sig 	= array();
		$sig[]	= $this->method;
		$sig[]	= $this->getRequestUrl();
		$sig[]	= $this->getNormalizedParams();
		
		return implode('&', array_map(array($this, 'urlencode'), $sig));
	}
	
	
	/**
	 * Calculate the signature of the request, using the method in oauth_signature_method.
	 * The signature is returned encoded in the form as used in the url.  So the base64 and
	 * urlencoding has been done.
	 * 
	 * @param string consumer_secret
	 * @param string token_secret
	 * @exception when not all parts available
	 * @return string
	 */
	function calculateSignature ( $consumer_secret, $token_secret, $token_type = 'access' )
	{
		$required = array(
						'oauth_consumer_key',
						'oauth_signature_method',
						'oauth_timestamp',
						'oauth_nonce'
					);

		if ($token_type !== false)
		{
			$required[] = 'oauth_token';
		}

		foreach ($required as $req)
		{
			if (!isset($this->param[$req]))
			{
				throw new OAuthException('Can\'t sign request, missing parameter "'.$req.'"');
			}
		}

		$this->checks();

		$base      = $this->signatureBaseString();
		$signature = $this->calculateDataSignature($base, $consumer_secret, $token_secret, $this->param['oauth_signature_method']);
		return $signature;
	}
	
	
	/**
	 * Calculate the signature of a string.
	 * Uses the signature method from the current parameters.
	 * 
	 * @param string 	data
	 * @param string	consumer_secret
	 * @param string	token_secret
	 * @param string 	signature_method
	 * @exception OAuthException thrown when the signature method is unknown 
	 * @return string signature
	 */
	function calculateDataSignature ( $data, $consumer_secret, $token_secret, $signature_method )
	{
		if (is_null($data))
		{
			$data = '';
		}
		$method = str_replace('-', '_', $signature_method);
		if (method_exists($this, 'signature_'.$method))
		{
			$func	   = 'signature_'.$method;
			$signature = $this->$func($data, $consumer_secret, $token_secret);
		}
		else
		{
			throw new OAuthException('Unsupported signature method "'.$signature_method.'"');
		}
		return $signature;
	}


	/**
	 * Select a signature method from the list of available methods.
	 * We try to check the most secure methods first.
	 * 
	 * @param array methods
	 * @exception OAuthException when we don't support any method in the list
	 * @return string
	 */
	public function selectSignatureMethod ( $methods )
	{
		if (in_array('HMAC-SHA1', $methods))
		{
			$method = 'HMAC-SHA1';
		}
		else if (in_array('MD5', $methods))
		{
			$method = 'MD5';
		}
		else
		{
			$method = false;
			foreach ($methods as $m)
			{
				$m = str_replace('-', '_', $m);
				if (method_exists($this, 'signature_'.$m))
				{
					$method = $m;
					break;
				}
			}
			
			if (empty($method))
			{
				throw new OAuthException('None of the signing methods is supported.');
			}
		}
		return $method;
	}


	/**
	 * Perform some sanity checks.
	 * 
	 * @exception OAuthException thrown when sanity checks failed
	 */
	function checks ()
	{
		if (isset($this->param['oauth_version']))
		{
			$version = $this->urldecode($this->param['oauth_version']);
			if ($version != '1.0')
			{
				throw new OAuthException('Expected OAuth version 1.0, got "'.$this->param['oauth_version'].'"');
			}
		}
	}


	/**
	 * Return the request method
	 * 
	 * @return string
	 */
	function getMethod ()
	{
		return $this->method;
	}

	/**
	 * Return the complete parameter string for the signature check.
	 * All parameters are correctly urlencoded and sorted on name and value
	 * 
	 * @return string
	 */
	function getNormalizedParams ()
	{
		/*
		// sort by name, then by value 
		// (needed when we start allowing multiple values with the same name)
		$keys   = array_keys($this->param);
		$values = array_values($this->param);
		array_multisort($keys, SORT_ASC, $values, SORT_ASC);
        */
        $params     = $this->param;
		$normalized = array();

		ksort($params);
		foreach ($params as $key => $value)
		{
		    // all names and values are already urlencoded
		    if (	 $key != 'oauth_signature'
		    	&&	($key != 'oauth_token' || strlen($value) > 0))
		   	{
				$normalized[] = $key.'='.$value;
			}
		}
		return implode('&', $normalized);
	}


	/**
	 * Return the normalised url for signature checks
	 */
	function getRequestUrl ()
	{
        $url =  $this->uri_parts['scheme'] . '://'
              . $this->uri_parts['user'] . (!empty($this->uri_parts['pass']) ? ':' : '')
              . $this->uri_parts['pass'] . (!empty($this->uri_parts['user']) ? '@' : '')
			  . $this->uri_parts['host'];
			  
		if (	$this->uri_parts['port'] 
			&&	$this->uri_parts['port'] != $this->defaultPortForScheme($this->uri_parts['scheme']))
		{
			$url .= ':'.$this->uri_parts['port'];
		}
		if (!empty($this->uri_parts['path']))
		{
			$url .= $this->uri_parts['path'];
		}
		return $url;
	}
	
	
	/**
	 * Get a parameter, value is always urlencoded
	 * 
	 * @param string	name
	 * @param boolean	urldecode	set to true to decode the value upon return
	 * @return string value		false when not found
	 */
	function getParam ( $name, $urldecode = false )
	{
		if (isset($this->param[$name]))
		{
			$s = $this->param[$name];
		}
		else if (isset($this->param[$this->urlencode($name)]))
		{
			$s = $this->param[$this->urlencode($name)];
		}
		else
		{
			$s = false;
		}
		if (!empty($s) && $urldecode)
		{
			$s = $this->urldecode($s);
		}
		return $s;
	}

	/**
	 * Set a parameter
	 * 
	 * @param string	name
	 * @param string	value
	 * @param boolean	encoded	set to true when the values are already encoded
	 */
	function setParam ( $name, $value, $encoded = false )
	{
		if (!$encoded)
		{
			$this->param[$this->urlencode($name)] = $this->urlencode($value);
		}
		else
		{
			$this->param[$name] = $value;
		}
	}


	/**
	 * Re-encode all parameters so that they are encoded using RFC3986.
	 * Updates the $this->param attribute.
	 */
	protected function transcodeParams ()
	{
		$params      = $this->param;
		$this->param = array();
		
		foreach ($params as $name=>$value)
		{
			$this->param[$this->urltranscode($name)] = $this->urltranscode($value);
		}
	}



	/**
	 * Return the body of the OAuth request.
	 * 
	 * @return string		null when no body
	 */
	function getBody ()
	{
		return $this->body;
	}


	/**
	 * Return the body of the OAuth request.
	 * 
	 * @return string		null when no body
	 */
	function setBody ( $body )
	{
		$this->body = $body;
	}


	/**
	 * Parse the uri into its parts.  Fill in the missing parts.
	 * 
	 * @todo  check for the use of https, right now we default to http
	 * @todo  support for multiple occurences of parameters
	 * @param string $parameters  optional extra parameters (from eg the http post)
	 */
	protected function parseUri ( $parameters )
	{
		$superCage = Inspekt::makeSuperCage();

		$ps = parse_url($this->uri);

		// Get the current/requested method
		if (empty($ps['scheme']))
		{
			$ps['scheme'] = 'http';
		}
		else
		{
			$ps['scheme'] = strtolower($ps['scheme']);
		}

		// Get the current/requested host
		if (empty($ps['host']))
		{
			$matches = $superCage->server->getMatched('HTTP_HOST', '/^[a-z0-9\.\-]+$/');
			if ($matches[0])
			{
				$matches[0] = mb_strtolower($matches[0]);
				$ps['host'] = $matches[0];
			}
			else
			{
				$ps['host'] = '';
			}
		}
		$ps['host'] = mb_strtolower($ps['host']);

		// getRaw() used for comparison purposes only
		if ($ps['host'] != $superCage->server->getRaw('HTTP_HOST'))
		{
			throw new OAuthException('Unsupported characters in host name');
		}

		// Get the port we are talking on
		if (empty($ps['port']))
		{
			$ps['port'] = $this->defaultPortForScheme($ps['scheme']);
		}

		if (empty($ps['user']))
		{
			$ps['user'] = '';
		}
		if (empty($ps['pass']))
		{
			$ps['pass'] = '';
		}
		if (empty($ps['path']))
		{
			$ps['path'] = '/';
		}
		if (empty($ps['query']))
		{
			$ps['query'] = '';
		}
		if (empty($ps['fragment']))
		{
			$ps['fragment'] = '';
		}

		// Now all is complete - parse all parameters
		foreach (array($ps['query'], $parameters) as $params)
		{
			if (strlen($params) > 0)
			{
				$params = explode('&', $params);
				foreach ($params as $p)
				{
					@list($name, $value) = explode('=', $p, 2);
					$this->param[$name]  = $value;
				}
			}
		}
		$this->uri_parts = $ps;
	}


	/**
	 * Return the default port for a scheme
	 * 
	 * @param string scheme
	 * @return int
	 */
	protected function defaultPortForScheme ( $scheme )
	{
		switch ($scheme)
		{
		case 'http':	return 80;
		case 'https':	return 43;
		default:
			throw new OAuthException('Unsupported scheme type, expected http or https, got "'.$scheme.'"');
			break;
		}
	}
	
	
	/**
	 * Encode a string according to the RFC3986
	 * 
	 * @param string s
	 * @return string
	 */
	function urlencode ( $s )
	{
		if ($s === false)
		{
			return $s;
		}
		else
		{
			return str_replace('%7E', '~', rawurlencode($s));
		}
	}
	
	/**
	 * Decode a string according to RFC3986.
	 * Also correctly decodes RFC1738 urls.
	 * 
	 * @param string s
	 * @return string
	 */
	function urldecode ( $s )
	{
		if ($s === false)
		{
			return $s;
		}
		else
		{
			return rawurldecode($s);
		}
	}

	/**
	 * urltranscode - make sure that a value is encoded using RFC3986.
	 * We use a basic urldecode() function so that any use of '+' as the
	 * encoding of the space character is correctly handled.
	 * 
	 * @param string s
	 * @return string
	 */
	function urltranscode ( $s )
	{
		if ($s === false)
		{
			return $s;
		}
		else
		{
			return $this->urlencode(urldecode($s));
		}
	}


	/**
	 * Parse the oauth parameters from the request headers
	 * Looks for something like:
	 *
     * Authorization: OAuth realm="http://photos.example.net/authorize",
     *           oauth_consumer_key="dpf43f3p2l4k3l03",
     *           oauth_token="nnch734d00sl2jdk",
     *           oauth_signature_method="HMAC-SHA1",
     *           oauth_signature="tR3%2BTy81lMeYAr%2FFid0kMTYa%2FWM%3D",
     *           oauth_timestamp="1191242096",
     *           oauth_nonce="kllo9940pd9333jh",
     *           oauth_version="1.0"
     */
	private function parseHeaders ()
	{
/*
		$this->headers['Authorization'] = 'OAuth realm="http://photos.example.net/authorize",
                oauth_consumer_key="dpf43f3p2l4k3l03",
                oauth_token="nnch734d00sl2jdk",
                oauth_signature_method="HMAC-SHA1",
                oauth_signature="tR3%2BTy81lMeYAr%2FFid0kMTYa%2FWM%3D",
                oauth_timestamp="1191242096",
                oauth_nonce="kllo9940pd9333jh",
                oauth_version="1.0"';
*/		
		if (isset($this->headers['Authorization']))
		{
			$auth = trim($this->headers['Authorization']);
			if (strncasecmp($auth, 'OAuth', 4) == 0)
			{
				$vs = explode(',', substr($auth, 6));
				foreach ($vs as $v)
				{
					if (strpos($v, '='))
					{
						$v = trim($v);
						list($name,$value) = explode('=', $v, 2);
						if (!empty($value) && $value{0} == '"' && substr($value, -1) == '"')
						{
							$value = substr(substr($value, 1), 0, -1);
						}
						
						if (strcasecmp($name, 'realm') == 0)
						{
							$this->realm = $value;
						}
						else
						{
							$this->param[$name] = $value;
						}
					}
				}
			}
		}
	}


	/**
	 * Fetch the content type of the current request
	 * 
	 * @return string
	 */
	private function getRequestContentType ()
	{
		$superCage = Inspekt::makeSuperCage();

		$content_type = 'application/octet-stream';
		if ($superCage->server->keyExists('CONTENT_TYPE'))
		{
			$matches = $superCage->server->getMatched('CONTENT_TYPE', '/^[A-Za-z0-9\/-]+$/');
			list($content_type) = explode(';', $matches[0]);
		}
		return trim($content_type);
	}


	/**
	 * Get the body of a POST or PUT.
	 * 
	 * Used for fetching the post parameters and to calculate the body signature.
	 * 
	 * @return string		null when no body present (or wrong content type for body)
	 */
	private function getRequestBody ()
	{
		$body = null;
		if ($this->method == 'POST' || $this->method == 'PUT')
		{
			$body = '';
			$fh   = @fopen('php://input', 'r');
			if ($fh)
			{
				while (!feof($fh))
				{
					$s = fread($fh, 1024);
					if (is_string($s))
					{
						$body .= $s;
					}
				}
				fclose($fh);
			}
		}
		return $body;
	}
	
	
	/**
	 * Calculate the signature using MD5
	 * Binary md5 digest, as distinct from PHP's built-in hexdigest.
	 * This function is copyright Andy Smith, 2007.
	 * 
	 * @param string consumer_secret
	 * @param string token_secret
	 * @return string  
	 */
	function signature_MD5 ( $s, $consumer_secret, $token_secret )
	{
		$s  .= '&'.$this->urlencode($consumer_secret).'&'.$this->urlencode($token_secret);
		$md5 = md5($s);
		$bin = '';
		
		for ($i = 0; $i < strlen($md5); $i += 2)
		{
		    $bin .= chr(hexdec($md5{$i+1}) + hexdec($md5{$i}) * 16);
		}
		return $this->urlencode(base64_encode($bin));
	}


	/**
	 * Calculate the signature using PLAINTEXT.
	 * This signature is transported over SSL and does not incorporate anything from the request itself.
	 * Just an exchange of the shared secrets.
	 * 
	 * @param string consumer_secret
	 * @param string token_secret
	 * @return   string  
	 */
	function signature_PLAINTEXT ( $s, $consumer_secret, $token_secret )
	{
		return $this->urlencode($this->urlencode($consumer_secret).'&'.$this->urlencode($token_secret));
	}


	/**
	 * Calculate the signature using HMAC-SHA1
	 * This function is copyright Andy Smith, 2007.
	 * 
	 * @param string consumer_secret
	 * @param string token_secret
	 * @return   string  
	 */
	function signature_HMAC_SHA1 ( $s, $consumer_secret, $token_secret )
	{
		$key = $this->urlencode($consumer_secret).'&'.$this->urlencode($token_secret);
		if (function_exists('hash_hmac'))
		{
			$signature = base64_encode(hash_hmac("sha1", $s, $key, true));
		}
		else
		{
		    $blocksize	= 64;
		    $hashfunc	= 'sha1';
		    if (strlen($key) > $blocksize)
		    {
		        $key = pack('H*', $hashfunc($key));
		    }
		    $key	= str_pad($key,$blocksize,chr(0x00));
		    $ipad	= str_repeat(chr(0x36),$blocksize);
		    $opad	= str_repeat(chr(0x5c),$blocksize);
		    $hmac 	= pack(
		                'H*',$hashfunc(
		                    ($key^$opad).pack(
		                        'H*',$hashfunc(
		                            ($key^$ipad).$s
		                        )
		                    )
		                )
		            );
			$signature = base64_encode($hmac);
		}
		return $this->urlencode($signature);
	}
	
	
	/**
	 * Simple function to perform a redirect (GET).
	 * Redirects the User-Agent, does not return.
	 * 
	 * @param string uri
	 * @param array params		parameters, urlencoded
	 * @exception OAuthException when redirect uri is illegal
	 */
	public function redirect ( $uri, $params )
	{
		if (!empty($params))
		{
			$q = array();
			foreach ($params as $name=>$value)
			{
				$q[] = $name.'='.$value;
			}
			$q_s = implode('&', $q);
			
			if (strpos($uri, '?'))
			{
				$uri .= '&'.$q_s;
			}
			else
			{
				$uri .= '?'.$q_s;
			}
		}
		
		// simple security - multiline location headers can inject all kinds of extras
		$uri = preg_replace('/\s/', '%20', $uri);
		if (strncasecmp($uri, 'http://', 7) && strncasecmp($uri, 'https://', 8))
		{
			if (strpos($uri, '://'))
			{
				throw new OAuthException('Illegal protocol in redirect uri '.$uri);
			}
			$uri = 'http://'.$uri;
		}
		
		header('HTTP/1.1 302 Found');
		header('Location: '.$uri);
		echo '';
		exit();
	}
	
}


/* vi:set ts=4 sts=4 sw=4 binary noeol: */

?>