<?php

        // Include the constants.php
        include('../config/constants.php');

        // Destroy  the session

        session_destroy(); // Unset $_session['user']

        header('location:'.SITEURL.'admin/login.php');

?>

     
<?php


// This page is secure from sql injection and also structured...


?>