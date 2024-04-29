<?php
    include("connect.php");
    $leagueName = $_GET["get1LeagueName"];
    
    $cursor = $collectionMatches->find(['league' => "$leagueName"], [
        'projection' => ['teams' => 1, '_id' => 0]
    ]);

    $allTeams = [];
    foreach ($cursor as $football) {
        foreach ($football['teams'] as $someTeam) {
            $allTeams[] = $someTeam;
        }
    }
    $teams = array_unique($allTeams);

    $winsArray = [];
    foreach ($teams as $someTeam) {
        $winsArray[] = $collectionMatches->count(['winner' => "$someTeam", 'league' => "$leagueName"]);
    }

    array_multisort($winsArray, SORT_DESC, $teams);

    $res = "";
    $res .= "<h3>Таблиця ліги $leagueName</h3>";
    $res .= "<table border=2>";
    $res .= "<tr>";
    $res .= "<th>№</th><th>Team</th><th>Wins</th>";
    $res .= "</tr>";
    
    for ($i=0; $i < count($teams); $i++) {
        $number = $i+1;
        $res .= "<tr>";
        $res .= "<td>$number</td><td>$teams[$i]</td><td>$winsArray[$i]</td>";
        $res .= "</tr>";
    }

    echo $res;

    $script = "<script>let keyString = 'get1.' + '$leagueName'; localStorage.setItem(keyString,'$res')</script>";
    echo $script;
?>