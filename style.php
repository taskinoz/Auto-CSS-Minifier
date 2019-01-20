<?php

  if (isset($_GET['s'])){
    $stylesheet = $_GET['s'];
    $stylesheetHash = $stylesheet.'.hash';
    $stylesheetMini = explode(".",$stylesheet);
    $stylesheetMini = $stylesheetMini[0].'.min.'$stylesheetMini[1];

    $getCurrentHash = file_get_contents($stylesheetHash);

    // Minification function from https://cssminifier.com/
    function minifyCss($cssFile) {
      // setup the URL and read the CSS from a file
      $url = 'https://cssminifier.com/raw';
      $css = file_get_contents($cssFile);

      // init the request, set various options, and send it
      $ch = curl_init();

      curl_setopt_array($ch, [
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POST => true,
          CURLOPT_HTTPHEADER => ["Content-Type: application/x-www-form-urlencoded"],
          CURLOPT_POSTFIELDS => http_build_query([ "input" => $css ])
      ]);

      $minified = curl_exec($ch);

      // finally, close the request
      curl_close($ch);

      // output the $minified css
      return $minified;
    }

    file_put_contents($stylesheetHash, hash_file('md5', $stylesheet));


    if (file_exists($stylesheet) && file_exists($stylesheetHash) && hash_file('md5', $stylesheet) == $getCurrentHash) {
      echo "The file $filename exists";
    }
    elseif (condition) {
      // code...
    }
    else {
      hash_file('md5', 'example.txt');
    }
  }
?>
