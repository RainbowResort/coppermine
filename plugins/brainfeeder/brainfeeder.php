<?php

 /**
 *
 * BrainFeeder for CPG
 * Version 0.7 Beta release
 * written  by Hallvard Natvik <hallvard@natvik.com>
 * Send me a mail if you use it
 * 
 * This is free software made available to you without any guarantees or obligations
 * You can use this sofware anyway you like.
 *------------------------------------------------------------
 * This is the BrainFeeder RSS class
 */

class feed_generator
{
    var $format = '2.0';
    var $media_tags = True; //Whether Yahoo media tags should be included (recommended)
    var $encoding;
    var $stylesheet;
    var $debug = FALSE; //whether debug information should be shown
    var $enclose_media = FALSE; //whether media (pictures, movies) should be included as attachments to the items
    var $channel; //The array that carries all the data for the feed
    var $item_count =0; //number of valid items in the feed
    private $ispermalink = TRUE; //whether isPermaLink attribute of GUID should be set or not
    private $fileoutput; //whether date should be sent to file (true) or browser (false)

    public function __construct($fileoutput=FALSE, $format="2.0", $encoding ="utf-8") {
        $this->fileoutput=$fileoutput;
        if ($this->fileoutput) {
            ob_start("write_to_file");
        }
        $this->format = $format;
        $this->encoding = $encoding;
    }
    
    public function createFeed() {
        $selfUrl = (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' ? 'http://' : 'https://');
        $selfUrl .= $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        $rss = '<?xml version="1.0" encoding="' . $this->encoding . '"?>'."\n";
        $rss .= '<!-- Generated on ' . date('r') . ' -->'."\n";
        $rss .= '<rss version="'.$this->format.'"';
        $rss .= '>'."\n";
        
        $rss .= '  <channel>' . "\n";
        foreach ($this->channel['cnl'] as $k=>$v) {
            switch ($k) {
                case "category":
                    $cats = explode(" ",$v);
                    foreach ($cats as $w) {
                        $rss .= '           <'.$k.'>'.$w.'</'.$k.'>'."\n";
                    }
                    break;
                case "skipHours":
                    $hrs = explode(" ", $v);
                    $rss .= '    <'.$k.'>';
                    foreach ($hrs as $h) {
                        $rss .= '           <hour>'.$h.'</hour>'."\n";
                    }
                    $rss .= '    </'.$k.'>'."\n";
                    break;
                case "skipDays":
                    $hrs = explode(" ", $v);
                    $rss .= '    <'.$k.'>'."\n";
                    foreach ($hrs as $h) {
                        $rss .= '           <day>'.$h.'</day>'."\n";
                    }
                    $rss .= '    </'.$k.'>'."\n";
                    break;
                default:
                    $rss .= '    <'.$k.'>'.$v.'</'.$k.'>'."\n";
            }
        }
        
        if (isset($this->channel['cnlimg'])) {
            $rss .= '    <image>' ."\n";
            foreach ($this->channel['cnlimg'] as $k=>$v) {
                $rss .= '          <'.$k.'>'.$v.'</'.$k.'>'."\n";
            }
            $rss .= '    </image>' ."\n";
        }
        foreach ($this->channel['items'] as $item) {
            $rss .= '    <item>'."\n";
            foreach ($item as $k=>$v) {
                switch ($k) {
                    case "guid":
                        $perm = ($this->ispermalink) ? "true" : "false";
                        $rss .= '        <'.$k.' isPermaLink="'.$perm.'">'.$v.'</'.$k.'>'."\n";
                        break;
                    case "source":
                        $rss .= '        <'.$k.' url="'.$v.'">'.$this->channel['cnl']['title'].'</'.$k.'>'."\n";
                        break;
                    case "enclosure":
                        $rss .= '        <'.$k.' url="'.$v['url'].'" length="'.$v['size'].'" type ="'.$v['type'].'" />'."\n";
                        break;
                    case "category":
                        $cats = explode(" ",$v);
                        foreach ($cats as $w) {
                            $rss .= '           <'.$k.'>'.$w.'</'.$k.'>'."\n";
                        }
                        break;
                    default:
                        $rss .= '        <'.$k.'>'.$v.'</'.$k.'>'."\n";
                        break;
                }
            }
            $rss .= '    </item>' ."\n";  
        }
        $rss .= '  </channel>' ."\n </rss>";
        echo $rss;
        if ($this->fileoutput) {
            ob_end_flush();
        }
    }


    /**
    * Receives channel values
    * Verifies that required values are given, and that all values are valid
    * Optional elements without specific rules are not verified
    * 
    * @param array $channel
    */
    public function build_channel ($channel){
        if (!is_array($channel)) die ("Channel should be an array");
        $errors = array();
        if (!isset($channel['title'])) $errors[]="Title missing";
        if (!isset($channel['link'])) $errors[]="Link missing";
        if (!isset($channel['description'])) $errors[]="description missing";
        if (isset($channel['image'])) $errors[]="Use set_channel_image for images";
        if (isset($channel['textInput'])) $errors[]="Use set_textInput for textInput";
        if (isset($channel['cloud'])) $errors[]="Use set_cloud for cloud ";
        $channel['description'] = htmlspecialchars($channel['description']);
        $channel['link'] = htmlspecialchars($channel['link']);
        if (count($errors)>0) {
            die ("Invalid channel: ".implode(", ", $errors));
        }
        $valid_elements = array ("title","link","description","language","copyright","managingEditor","webMaster","pubDate","lastBuildDate","category","generator","docs","ttl","skipHours","skipDays");
        
        $invalid_elements = find_invalid_keys($valid_elements,$channel);
        if ($this->debug){
            echo "<br />Invalid elements in Channel: ",implode($invalid_elements,", ");
        }
        $this->channel['cnl'] = delete_invalid_keys($channel,$invalid_elements);
        //print_r ($this->channel);
    }

    public function set_channel_image($image){
        if (!is_array($image)) die ("Image");
        $errors = array();
        if (!isset($image['title'])) $errors[]="Image title missing";
        if (!isset($image['link'])) $errors[]="Image link missing";
        if (!isset($image['url'])) $errors[]="Image URL missing";
        if (!isset ($image['width'])) $image['width']=88;
        if ($image['width']>144) $errors[]="Image too wide (max 133)";
        if (!isset ($image['height'])) $image['height']=33;
        if ($image['height']>400) $errors[]="Image too high (max 400)";
        //$image['link'] = urlencode($image['link']);
        if (count($errors)>0) {
            die ("Invalid channel image: ".implode(", ", $errors));
        }
        $image['description'] = htmlspecialchars($image['description']);
        $this->channel['cnlimg'] = $image;
    }

    public function add_items($item) {
        $valid = TRUE;
        $valid_enclosure = TRUE;
        if (!isset($item['title'])) {
            $title="";
        } else {
            $title = $item['title'];
        }
        if (!isset($item['description'])) {
            $description="";
        } else {
            $description = $item['description'];
        }
        if (strlen(trim($title.$description)) < 5) $valid = FALSE;
        $item['description'] = htmlspecialchars($item['description']);
//        $item['description'] = urlencode($item['description']);
        $item['title'] = htmlspecialchars($item['title']);
        //if (isset($item['guid'])) $item['guid'] = urlencode($item['guid']);
        
        
        if (isset($item['enclosure'])){
            if ($enc=$this->append_enclosure($item['enclosure'])){
                $item['enclosure']=$enc;
            } else {    //enclosure data not found
                unset ($item['enclosure']); 
                if ($this->debug) echo "enclosure from item ". $this->item_count + 1 . " not valid";
            }
        }
        //domains for categories is not supported
        if (isset($item['category'])) if (str_replace(array(";",",")," ",$item['category'])); //remove any , or ; from category to make sure they are separated by spaces
      
        $valid_elements = array ("title","link","description","author","category","comments","enclosure","guid","pubDate","source");
        $invalid_elements = find_invalid_keys($valid_elements,$item);
        if ($this->debug && count($invalid_elements>0)){
            echo "<br />Invalid elements in Item: ",implode($invalid_elements,", ");
        }
        $this->add_to_item_array($item);
      }

    /**
    * isPermaLink indicates whether the data in GUID is a valid URL or not - which it usually will be
    * @param bool $switch set isPermalink to true or false
    */
    public function set_permalink ($switch) {
        $this->ispermalink = $switch;
    }

    protected function append_enclosure($url) {
        if (!$size = get_filesize($url)) $size = "unknown";
   //     $size = 1000;
        switch (strtolower(pathinfo($url,PATHINFO_EXTENSION))) {
            case "jpg":
            case "jpeg":
                $type ="image/jpeg";
                break;
            case "gif":
                $type ="image/gif";
                break;
            case "png":
                $type ="image/png";
                break;
            case "mpeg":
            case "mpg":
            case "mpe":
                $type ="video/mpeg";
                break;
            case "avi":
                $type ="video/x-msvideo";
                break;
            case "mov":
            case "qt":
                $type ="video/quicktime";
                break;
            case "tif":
            case "tiff":
                $type ="image/tiff";
                break;
            case "bmp":
                $type ="image/bmp";
                break;
            case "ppt":
            case "pps":
                $type ="application/powerpoint";
                break;
            case "pdf":
                $type ="application/pdf";
                break;
            case "xls":
                $type ="application/excel";
                break;
            case "zip":
                $type ="application/zip";
                break;
            case "doc":
                $type ="application/msword";
                break;
            case "mp3":
                $type ="audio/mpeg3";
                break;
            case "ogg":
                $type ="audio/ogg";
                break;
            case "wma":
                $type ="audio/x-ms-wma";
                break;
            default:         //no valid mime type found
                return FALSE;
        }
        return array('url'=>$url, 'size'=>$size,'type'=>$type);
    }
    
    public function set_textinput (){
        die ("textinput is not implemented");
    }

    public function set_cloud (){
        die ("cloud is not implemented");
    }
    protected function add_to_item_array ($item) {
        $this->item_count ++;
        $this->channel['items'][$this->item_count] = $item;
    }


} //class

   
/**
* Accepts an array of valid elements that is compared to the keys of the input_array
* Returns all keys of the input_array that is not present in the valid_elements array
* 
* @param array $valid_elements
* @param array $input_array Needs to be associative
*/
function find_invalid_keys ($valid_elements, $input_array) {
    $keys_to_be_tested = array_keys($input_array);
    return array_diff($keys_to_be_tested, $valid_elements);
}

/**
* Uses the values in the to_be_deleted array as keys to delete from the input_array
* 
* @param array $input_array An associative array containing potentially invalid elements
* @param array $to_be_deleted An array containing invalid keys that should be deleted from input_array
*/
function delete_invalid_keys ($input_array, $to_be_deleted){
    foreach ($to_be_deleted as $v) {
        unset($input_array[$v]);
    }
    return $input_array;
}


function get_filesize ($file) {
$found = FALSE;
if (!$size=@filesize($file)) {
    //if its a HTTP Url - try finding with the remote method
    if (stripos("x".$file,"http://") && !stripos($file,'localhost')) { //the "x" is there to have clear distinction between True and False, not relevant for localhost
        if ($headers = get_headers($file,1)) {
            $headers = array_change_key_case($headers,CASE_LOWER);
            if (isset($headers['content-length'])) {
                $size = $headers['content-length'];
                $found = TRUE;
            }
        }       
        if (!$found) {
            $file = substr($file,strpos($file,"/",7)); //chop off http://www.domain.tld - keep the '/'
        }
    }
    if (!$found) {
        $fileparts = pathinfo($file);
        $path = $fileparts['dirname'];
        $file = $fileparts['basename']; 
        $path_parts = explode('/',$path);
        $n = count($path_parts);
        for ($i=$n;$i>=0;$i--) {
            $pathstring="";
            if ($found) continue;
            for ($a = $i; $a<$n; $a++) {
                $pathstring .= $path_parts[$a]."/";
            }
            $filepath = $pathstring.$file;
            if (file_exists($filepath)) {
                $found = TRUE;
                $size = filesize($filepath);
                continue;
            }
        }
    } 
    if (!$found) return FALSE;
}
return $size;
} // end get file size


function write_to_file($cache, $params) {
  global $rss_filename;
  $file = new cache_file_writer($rss_filename);  //file name should be found in a global variable or something...
  $file->write_to_file($cache);
  return "";
}
  
class cache_file_writer {
    private $hndl;
    
    public function __construct ($filename) {
        if (!$this->hndl=@fopen($filename, 'w')) {
            $error = @fopen("ob_buffer_output_error.txt", 'w');
            fwrite($error,"BrainFeeder could not create and write to the file ".$filename);
            fclose($error);
            return FALSE;
        }
    }
        
    public function write_to_file ($cache) {
        if (!fwrite($this->hndl, $cache)) {
            return FALSE;
        }
        return TRUE;
    }
    
    public function __destruct(){
        fclose($this->file);
    }
}  //end class cache file writer
?>