<?php

/**
 * Server layer over the OAuthRequest handler
 * 
 * @version $Id: OAuthServer.php 5 2008-02-13 12:29:12Z marcw@pobox.com $
 * @author Marc Worrell <marc@mediamatic.nl>
 * @copyright (c) 2007 Mediamatic Lab
 * @date  Nov 27, 2007 12:36:38 PM
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

require_once 'OAuthRequestVerifier.php';

class OAuthServer extends OAuthRequestVerifier
{
	/**
	 * Handle the request_token request.
	 * Returns the new request token and request token secret.
	 * 
	 * TODO: add correct result code to exception
	 */
	public function requestToken ()
	{
		OAuthRequestLogger::start($this);
		try
		{
			$this->verify(false);
			
			// Create a request token
			$store  = OAuthStore::instance();
			$token  = $store->addConsumerRequestToken($this->getParam('oauth_consumer_key', true));
			$result = 'oauth_token='.$this->urlencode($token['token'])
					.'&oauth_token_secret='.$this->urlencode($token['token_secret']);
					
			header('HTTP/1.1 200 OK');
			header('Content-Length: '.strlen($result));
		//	header('Content-Type: application/x-www-form-urlencoded');
			echo $result;

		}
		catch (OAuthException $e)
		{
			header('HTTP/1.1 401 Unauthorized');
			echo "OAuth Verification Failed";
			// header('HTTP/1.1 400 Bad Request');
		}

		OAuthRequestLogger::flush();
		exit();
	}
	
	
	/**
	 * Verify the start of an authorization request.  Verifies if the request token is valid.
	 * 
	 * @exception OAuthException thrown when not a valid request
	 * @return array token description
	 */
	public function authorizeVerify ( )
	{
		OAuthRequestLogger::start($this);

		$store = OAuthStore::instance();
		$token = $this->getParam('oauth_token', true);
		$rs    = $store->getConsumerRequestToken($token);
		if (empty($rs))
		{
			throw new OAuthException('Unknown request token "'.$token.'"');
		}

		// We need to remember the callback		
		if (	empty($_SESSION['verify_oauth_token'])
			||	strcmp($_SESSION['verify_oauth_token'], $rs['token']))
		{
			$_SESSION['verify_oauth_token'] 		= $rs['token'];
			$_SESSION['verify_oauth_consumer_key']	= $rs['consumer_key'];
			$_SESSION['verify_oauth_callback']		= $this->getParam('oauth_callback', true);
		}

		OAuthRequestLogger::flush();
		return $rs;
	}
	
	
	/**
	 * Overrule this method when you want to want to display a nice page when
	 * the authorization is finished.  This function does not know if the authorization was
	 * succesfull, you need to check the token in the database.
	 */
	public function authorizeFinish ( $authorized, $user_id )
	{
		OAuthRequestLogger::start($this);

		$token = $this->getParam('oauth_token', true);
		if (	isset($_SESSION['verify_oauth_token']) 
			&&	$_SESSION['verify_oauth_token'] == $token)
		{
			// Flag the token as authorized, or remove the token when not authorized
			$store = OAuthStore::instance();
			
			if ($authorized)
			{
				OAuthRequestLogger::addNote('Authorized token "'.$token.'" for user '.$user_id);
				$store->authorizeConsumerRequestToken($token, $user_id);
			}
			else
			{
				OAuthRequestLogger::addNote('Authorization rejected for token "'.$token.'" for user '.$user_id."\nToken has been deleted");
				$store->deleteConsumerRequestToken($token);
			}
			
			if (!empty($_SESSION['verify_oauth_callback']))
			{
				$this->redirect($_SESSION['verify_oauth_callback'], array('oauth_token'=>rawurlencode($token)));
			}
		}
		OAuthRequestLogger::finish();
	}
	
	
	/**
	 * Exchange a request token for an access token.
	 * The exchange is only succesful if the request token has been authorized.
	 */
	public function accessToken ()
	{
		OAuthRequestLogger::start($this);

		try
		{
			$this->verify('request');
			
			$store  = OAuthStore::instance();
			$token  = $store->exchangeConsumerRequestForAccessToken($this->getParam('oauth_token', true));
			$result = 'oauth_token='.$this->urlencode($token['token'])
					.'&oauth_token_secret='.$this->urlencode($token['token_secret']);
					
			header('HTTP/1.1 200 OK');
			header('Content-Length: '.strlen($result));
			//header('Content-Type: application/x-www-form-urlencoded');

			echo $result;
		}
		catch (OAuthException $e)
		{
			header('HTTP/1.1 401 Access Denied');
			header('Content-Type: text/plain');

			echo $e->getMessage();
		}
		OAuthRequestLogger::flush();
		exit();
	}	
}

/* vi:set ts=4 sts=4 sw=4 binary noeol: */

?>