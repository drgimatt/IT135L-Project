<?php
    session_start();
    unset($SESSION["EmployeeID"]);
    unset($SESSION["ID"]);
    header("Location: ./adminLogin.php")
?>