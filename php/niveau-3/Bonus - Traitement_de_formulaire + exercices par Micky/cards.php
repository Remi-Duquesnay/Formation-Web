<?php
    function card($title, $nbVotes, $totalVoteScore, $imgLocation){
        echo "<div class=\"card\" style=\"width:400px\">";
        echo "<img class=\"card-img-top\" src=\"".$imgLocation."\" alt=\"".$title."-cover\">";
        echo "<div class=\"card-body\">";
        echo "<h4 class=\"card-title\">".$title."</h4>";
        echo "<p class=\"card-text\">Nombre de votes : ".$nbVotes."</p>";
        echo "</div>";
        echo "</div>";
    }
