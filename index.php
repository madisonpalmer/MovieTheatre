<?php
//##############################################################################
//
// main home page for the site 
// 
//##############################################################################
include "top.php";
?>

<div id="header">
<h1>Digi Pix Home Page</h1>
</div>

<?php
// Begin output
print '<article>';
print '<h2>Welcome!</h2>';
print '<p> Welcome! Thank you for coming to this movie site.  </p>';
print '</article>';
//maddie's stuff
$columns = 2; 
$query = 'SELECT fldPicture, fldDescription FROM tblMovies';
//$info2 = $thisDatabaseReader->testquery($query, "", 0, 0, 0, 0, false, false);
$queryDescription = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
print '<div id="accordion">';
foreach ($queryDescription as $rec) {
    print '<div id="' . $rec['fldMovieId'] . '">';
    print '<img class="accordion" src="' . $rec['fldPicture'] . '">';
    print '</div>';
}
print '</div>';
//end maddie's stuff
?>

<div id="footer">
<?php
include "footer.php";
?>
 </div>