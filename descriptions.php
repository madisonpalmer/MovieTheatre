<?php

include "top.php";
print '<h2>Movie Descriptions</h2>';
//print '<table>';

//now print out each record
$columns = 2; 
$query = 'SELECT fldPicture, fldDescription FROM tblMovies';
//$info2 = $thisDatabaseReader->testquery($query, "", 0, 0, 0, 0, false, false);
$queryDescription = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);

//print '<tr>';
foreach ($queryDescription as $rec) {
    
    print '<span class="description"><img class="imgdescription" src="' . $rec['fldPicture'] . '">';
    print '<p class="txtdescription"><b>Description:</b> ' . $rec['fldDescription'] . '</p></span>';
    
}
//print '</tr>';
//print '</table>';

include "footer.php";
?>





