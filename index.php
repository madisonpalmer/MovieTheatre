<?php

include "top.php";
//print '<table>';

//now print out each record
$columns = 2; 
$query = 'SELECT fldPicture, fldDescription FROM tblMovies';
//$info2 = $thisDatabaseReader->testquery($query, "", 0, 0, 0, 0, false, false);
$queryDescription = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);

print '<div id="accordion">';
foreach ($queryDescription as $rec) {
    print '<div id="' . $rec['fldMovieId'] . '">';
    print '<img src="' . $rec['fldPicture'] . '">';
    print '</div>';
}
print '</div>';	


include "footer.php";
?>