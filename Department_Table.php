<html>
<?php
require "config.php";

use App\Employee;

$emps = Employee::list();


echo "<table border='1' cellpadding='5' id='myTable'>";
$keys = array_keys($emps);

for ($i = 0; $i < count($emps); $i++) {
    echo "<tr>";

    foreach ($emps[$keys[$i]] as $key => $value) {
        // Check if the current column is the one where you want to add the link
        if ($key === "emp_no") {
            echo "<td><a href='#' class='submitLink'>" . $value . "</a></td>";
        } else {
            echo "<td>" . $value . "</td>";
        }
    }

    echo "</tr>";
}

echo "</table>";
?>
<script>
    window.onload = function() {
      // Get the table element by its ID
      var table = document.getElementById("myTable");

      // Get the number of columns in the table
      var columnCount = table.rows[0].cells.length;

      // Loop through the columns and remove every other column
      for (var i = columnCount - 1; i >= 0; i -= 2) {
        // Loop through each row and remove the cell at the current index
        for (var j = 0; j < table.rows.length; j++) {
          table.rows[j].deleteCell(i);
        }
      }
    };
  </script>
  <script>
  var links = document.getElementsByClassName("submitLink");

  // Attach event listeners to each link
  for (var i = 0; i < links.length; i++) {
  links[i].addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default link behavior

    var valueToPost = this.textContent; // Retrieve the value from the link

    // Create a hidden form element with the desired post value
    var form = document.createElement("form");
    form.method = "post";
    form.action = "Employee_Salary.php"; // Specify the URL to submit the form to

    var input = document.createElement("input");
    input.type = "hidden";
    input.name = "emp_no"; // Specify the name of the post parameter
    input.value = valueToPost; // Specify the value to be posted

    form.appendChild(input);
    document.body.appendChild(form);

    form.submit(); // Submit the form
  });
}
  </script>
</html>