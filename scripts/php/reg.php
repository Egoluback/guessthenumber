<?php

require('config.php');
        
if (isset($_POST['password']) and isset($_POST['username'])){ # if user has sent data to us
    $username = $_POST['username'];
    $password = hash('ripemd160',$_POST['password']); # coding password with hash function; algorithm - 'ripemd160'
    
    # sql injection
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($mysqli,$query);
    mysqli_close($mysqli);
    header('Location: /login.php'); # redirection to the login page with PHP
}
?>