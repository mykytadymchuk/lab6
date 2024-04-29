<?php
    include("connect.php");
    $teamName = $_GET["get3TeamName"];
    
    $cursor = $collectionMatches->find(['teams'=> "$teamName"], [
        'projection' => ['_id' => 0], 'sort'=>['date'=>-1]
    ]);

    $res = "";
    $res.= "<h3>Всі матчі команди $teamName</h3>";
    $res.= "<table border=2>";
    $res.= "<tr>";
    $res.= "<th>League</th><th>Team 1</th><th>Team 2</th><th>Date</th><th>Place</th><th>Winner</th>";
    $res.= "</tr>";
    foreach ($cursor as $football) {
        $league = $football['league'];
        $timestamp = $football['date'];
        $date = date("d.m.y, H:s", $timestamp);
        $place = $football['place'];
        $winner = $football['winner'];
        $teams = [];
        foreach ($football['teams'] as $someTeam) {
            $teams[] = $someTeam;
        }
        $res.= "<tr>";
        $res.= "<td>$league</td><td>$teams[0]</td><td>$teams[1]</td><td>$date</td><td>$place</td><td>$winner</td>";
        $res.= "</tr>";
    }
    $res.= "</table>";

    echo $res;

    $script = "<script>let keyString = 'get3.' + '$teamName'; localStorage.setItem(keyString,'$res')</script>";
    echo $script;


?>