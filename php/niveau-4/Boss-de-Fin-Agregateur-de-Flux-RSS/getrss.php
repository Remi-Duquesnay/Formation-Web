<?php
  
    $xmlDoc = new DOMDocument();
    $xmlDoc->preserveWhiteSpace = false;
    $xmlDoc->load("https://www.jeuxvideo.com/rss/rss.xml"); 

    $x = $xmlDoc->getElementsByTagName('item');

    foreach($x as $item){
        $title = $item->getElementsByTagName('title')->item(0)->nodeValue;
        $link = $item->getElementsByTagName('link')->item(0)->nodeValue;
        $thumbnail = $item->getElementsByTagName('thumbnail')->item(0)->getAttribute('url');
        $desc = $item->getElementsByTagName('description')->item(0)->nodeValue;
        $date = substr($item->getElementsByTagName('pubDate')->item(0)->nodeValue, 0, -6);

        echo "<a href=\"".$link."\">
              <div class=\"card\">
              <img class=\"card-img-top game-thumbnail\" src=\"" . $thumbnail . "\" alt=\"Game-cover\">
              <div class=\"card-body\">
              <h4 class=\"card-title\">" . $title . "</h4>
              <p class=\"card-text\">".$desc."</p>
              </div>
              <small class=\"date\">".$date."</small>
              </div>
              </a>";
    }
?>