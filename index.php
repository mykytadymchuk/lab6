<?php
    include("connect.php");
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab2</title>

    <script>
        function getPrevRes1() {
            let leagueName = document.getElementById("get1LeagueName").value;
            document.getElementById("prevResultTitle").innerHTML = "Попередній результат за обраним параметром:";
            document.getElementById("prevResult").innerHTML = localStorage.getItem('get1.' + leagueName);
        }

        function getPrevRes2() {
            let teamName = document.getElementById("get2TeamName").value;
            document.getElementById("prevResultTitle").innerHTML = "Попередній результат за обраним параметром:";
            document.getElementById("prevResult").innerHTML = localStorage.getItem('get2.' + teamName);
        }

        function getPrevRes3() {
            let teamName = document.getElementById("get3TeamName").value;
            document.getElementById("prevResultTitle").innerHTML = "Попередній результат за обраним параметром:";
            document.getElementById("prevResult").innerHTML = localStorage.getItem('get3.' + teamName);
        }
    </script>

</head>
<body>
<h3>Таблиця чемпіонату для обраної ліги:</h3>
    <form action="get1.php" method="get">
        <label for="get1LeagueName">Назва ліги: </label>
        <select name="get1LeagueName" id="get1LeagueName" onchange="getPrevRes1()">
            <?php
                $cursor = $collectionMatches->distinct('league');
                foreach ($cursor as $leagueName) {
                    echo "<option value='$leagueName'>$leagueName</option>";
                }
            ?>
        </select> <br>
        <input type="submit" value="OK">
    </form>

   <br>

   <h3>Список футболістів обраної команди:</h3>
    <form action="get2.php" method="get">
        <label for="get2TeamName">Назва команди: </label>
        <select name="get2TeamName" id="get2TeamName" onchange="getPrevRes2()">
            <?php
                $cursor = $collectionTeams->find([], [
                    'projection' => ['name' => 1, '_id' => 0]
                    ]);
                foreach ($cursor as $tN) {
                    $teamName = $tN['name'];
                    echo "<option value='$teamName'>$teamName</option>";
                }
            ?>
        </select> <br>
        <input type="submit" value="OK">
    </form>

    <br>

    <h3>Список ігор обраної команди:</h3>
    <form action="get3.php" method="get">
        <label for="get3TeamName">Назва команди: </label>
        <select name="get3TeamName" id="get3TeamName" onchange="getPrevRes3()">
            <?php
                $cursor = $collectionTeams->find([], [
                    'projection' => ['name' => 1, '_id' => 0]
                    ]);
                foreach ($cursor as $tN) {
                    $teamName = $tN['name'];
                    echo "<option value='$teamName'>$teamName</option>";
                }
            ?>
        </select> <br>
        <input type="submit" value="OK">
    </form>

    <h3 id="prevResultTitle"></h3>
    <p id="prevResult"></p>

</body>
</html>