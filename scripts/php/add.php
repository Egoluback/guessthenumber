<?php
    require('config.php');

    if (isset($_GET['value']) and isset($_GET['username'])){ # if user has sent data to us
        $value = $_GET['value'];
        $username = $_GET['username'];
        
        # sql injection
        $query = "INSERT INTO saves (username, value) VALUES ('$username', $value)";
        $result = mysqli_query($mysqli, $query);
        mysqli_close($mysqli);

        echo "<script>document.location.replace('/')</script>"; # redirection to the main page with JS
    }
    
?>