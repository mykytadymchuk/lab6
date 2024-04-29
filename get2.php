<?php
    include("connect.php");
    $teamName = $_GET["get2TeamName"];

    $cursor = $collectionTeams->find(['name'=> "$teamName"], [
        'projection' => ['players' => 1, '_id' => 0]
    ]);

    foreach ($cursor as $football) {
        $players = [];
        foreach ($football['players'] as $somePlayer) {
            $players[] = $somePlayer;
        }
    }
    
    $res = "";
    $res .= "<h3>Гравці команди $teamName</h3>";
    $res .= "<ol>";
    foreach ($players as $row) {
        $res .= "<li>$row</li>";
    }
    $res .= "</ol>";

    echo $res;

    $script = "<script>let keyString = 'get2.' + '$teamName'; localStorage.setItem(keyString,'$res')</script>";
    echo $script;
?>