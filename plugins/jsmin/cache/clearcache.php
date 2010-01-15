<?php
      $dir = './';
      foreach(glob($dir.'*.js') as $v){
      unlink($v);
      }
      $dir = './';
      foreach(glob($dir.'*.js.gz') as $v){
      unlink($v);
      }

      echo "The cache is now empty.";
?>