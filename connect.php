<?php
    require_once __DIR__ . '/vendor/autoload.php';
    $collectionMatches = (new MongoDB\Client)->lab2->footballMatches;
    $collectionTeams = (new MongoDB\Client)->lab2->footballTeams;
?>