<?php

require "config.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        $dept_name = $_POST['dept_name'];
        $_SESSION['dept_name'] = $dept_name;
        header('Location: Department_Table.php');


    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
    }
}