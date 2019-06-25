<?php
    require('config.php');

    if (isset($_GET['value']) and isset($_GET['username']) and isset($_GET['countCells'])){ # if user has sent data to us
        $value = $_GET['value'];
        $username = $_GET['username'];
        $countCells = $_GET['countCells'];
        # counting speed (distance / time formula)
        $speed = (float) $countCells / $value;
        
        # sql injection
        $query = "INSERT INTO saves (username, value, countCells, speed) VALUES ('$username', $value, $countCells, $speed)";
        $result = mysqli_query($mysqli, $query);
        mysqli_close($mysqli);

        echo "<script>document.location.replace('/')</script>"; # redirection to the main page with JS
    }
    
?>