<?php

include "top.php";
print '<div id="header">';
print '<h1>Movie Descriptions</h1>';
print '</div>';
print '<br />';
print '<div class="description">';
//print '<table>';

//now print out each record
$columns = 2; 
$query = 'SELECT fldPicture, fldDescription, fldTitle FROM tblMovies';
//$info2 = $thisDatabaseReader->testquery($query, "", 0, 0, 0, 0, false, false);
$queryDescription = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);

//print '<tr>';
foreach ($queryDescription as $rec) {
    
    print '<span class="description"><img class="imgdescription" src="' . $rec['fldPicture'] . '">';
    print '<p class="txtdescription"><b>Title:</b> ' . $rec['fldTitle'] . '</ br>';
    print '<br />';
    print '<b>Description:</b> ' . $rec['fldDescription'] . '</p></span>';
    
}
print '</div>';
//print '</table>';

include "footer.php";
?>





