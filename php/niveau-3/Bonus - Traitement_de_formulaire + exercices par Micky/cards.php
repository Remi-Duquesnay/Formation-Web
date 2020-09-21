<?php
function card($id, $title, $nbVotes, $totalVoteScore, $imgLocation, $cookieVote)
{
    echo "<div class=\"card\" style=\"width:300px\">";
    echo "<img class=\"card-img-top game-cover\" src=\"" . $imgLocation . "\" alt=\"" . $title . "-cover\">";
    echo "<div class=\"card-body\">";
    echo "<h4 class=\"card-title\">" . $title . "</h4>";
    // if (!$cookieVote[$id]) { 
        echo "<form action=\"note.php\" method=\"POST\">";
        echo "<p>Noter ce jeu : <select name=\"note\">";
        for ($i = 0; $i <= 5; $i++) {
            echo "<option value=\"" . $i . "\">".$i."</option>";
        }
        echo "</select>";
        echo "<button type=\"submit\" name=\"submit\">Noter</button>";
    // }
    echo "<div class=\"card-note\">";
    if ($nbVotes == 0) {
        echo "<p class=\"card-text\">Note : pas encore noté.</p>";
    } else {
        $noteAvg = $totalVoteScore / $nbVotes;
        echo "<p class=\"card-text\">Note : " . $noteAvg . "(" . $nbVotes . " votes)</p>";
    }
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
