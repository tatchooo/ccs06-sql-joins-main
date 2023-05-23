<?php

namespace App;
use Exception;

class Employee_Stats
{
    public static function list()
    {
        global $conn;
        $emp_no= $_SESSION['emp_no'];
        try {
            $sql = "SELECT 
            sa.emp_no,
            CONCAT (e.first_name, ' ', e.last_name) AS EMPLOYEE,
            sa.salary,
            sa.from_date,
            sa.to_date
            FROM employees AS e
            LEFT JOIN salaries AS sa
            ON (sa.emp_no=e.emp_no) 
            WHERE sa.emp_no = $emp_no
            ORDER BY sa.salary
            ";

            $statement = $conn->prepare($sql);
            $statement->execute();
            $records = [];

            while ($rows = $statement->fetch()) {
                array_push($records, $rows);
            }
            return $records;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        return null;
    }
}