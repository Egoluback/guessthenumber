<?php
    require('scripts/php/config.php');
            
    if (isset($_POST['password']) and isset($_POST['username'])){  # if user has sent data to us
        $username = $_POST['username'];
        $password = hash('ripemd160',$_POST['password']); # encoding password with hash function
        
        # sql injection from 'users' database
        $query = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
        $result = mysqli_query($mysqli,$query);

        if (mysqli_num_rows($result) > 0){ # if there are one more rows with same data
            $isError = FALSE;
            mysqli_close($mysqli);
            echo "<script>document.cookie = 'username=$username';document.location.replace('/');</script>"; # writing data to cookies, and then redirection to the main page with JS
        } else{
            $isError = TRUE;
            mysqli_close($mysqli);
            echo "<script>document.location.replace('/')</script>"; # redirection to the main page with JS
        }
    }
?>