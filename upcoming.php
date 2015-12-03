<?php

include "top.php";
print '<h2>Upcoming Movies</h2>';
print '<table>';

//now print out each record
$columns = 4; 
$query = "SELECT fldPicture, fldTitle, fldDescription, fldStatus FROM tblMovies where fldStatus='Upcoming'";
//$info2 = $thisDatabaseReader->testquery($query, "", 0, 0, 0, 0, false, false);
$queryDescription = $thisDatabaseReader->select($query, "", 1, 0, 2, 0, false, false);


foreach ($queryDescription as $rec) {
    print '<tr>';
    print '<td><img class="imgdescription" src="' . $rec['fldPicture'] . '">';
    print '<td>' . $rec['fldTitle'] . '</td>';
    print '<td>' . $rec['fldStatus'] . '</td>';
    print '</tr>';
}
print '</table>';

include "footer.php";
?>


