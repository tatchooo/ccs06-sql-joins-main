<?php

namespace App;

use Exception;

class Department
{

    public static function list()
    {
        global $conn;

        try {
            $sql = "SELECT
            d.dept_no,
            d.dept_name,
            dm.emp_no,
            CONCAT (e.first_name, ' ', e.last_name) AS MANAGER,
            dm.from_date,
            dm.to_date,
            (SELECT YEAR(dm.to_date) - YEAR(dm.from_date)) AS YEARS
            FROM departments AS d
            LEFT JOIN dept_manager AS dm
            ON (dm.dept_no=d.dept_no)
            LEFT JOIN employees AS e
            ON (dm.emp_no=e.emp_no)
            ORDER BY d.dept_no ASC
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
