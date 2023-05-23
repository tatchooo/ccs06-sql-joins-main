<html>
<?php

require "config.php";

use App\Employee_Stats;

$emps = Employee_Stats::list();

echo "<table border='1' cellpadding='5' id='myTable'>";
$keys = array_keys($emps);

for ($i = 0; $i < count($emps); $i++) {
    echo "<tr>";
    foreach ($emps[$keys[$i]] as $key => $value) {
        echo "<td>" . $value . "</td>";
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

</html>