<?php

namespace App;
use Exception;


class Employee
{

    public static function list()
    {
        global $conn;
        $dept_name= $_SESSION['dept_name'];
        try {
            $sql = "SELECT
            d.dept_no,
            d.dept_name,
            de.emp_no,
            CONCAT (e.first_name, ' ', e.last_name) AS EMPLOYEE,
            e.birth_date,
            (SELECT TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE())) AS age,
            e.gender,
            e.hire_date,
            (SELECT Max(s.from_date)) AS RECENT_DATE,
            s.salary
            FROM departments AS d
            LEFT JOIN dept_emp AS de
            ON (de.dept_no=d.dept_no)
            LEFT JOIN employees AS e
            ON (e.emp_no=de.emp_no)
            LEFT JOIN salaries AS sa
            ON (sa.emp_no=e.emp_no) 
            INNER JOIN (
                SELECT emp_no, MAX(from_date) AS latest_date
                FROM salaries
                GROUP BY emp_no
            ) latest_sal ON e.emp_no= latest_sal.emp_no
            INNER JOIN salaries s ON latest_sal.emp_no = s.emp_no AND latest_sal.latest_date = s.from_date
            WHERE d.dept_name = '$dept_name'
            GROUP BY e.emp_no ASC
            LIMIT 100
            ";

            $statement = $conn->prepare($sql);
            $statement->execute(
            );
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