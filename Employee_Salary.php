
<?php

require "config.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        $emp_no = $_POST['emp_no'];
        $_SESSION['emp_no'] = $emp_no;
        header('Location: Salary_Table.php');


    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
    }
}