<?php
/* %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
 * the purpose of this page is to display a list of poets, admin can edit
 * 
 * Written By: Prakrit Timsina ptimsin1@uvm.edu
 */
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
$adminId = true; 
include "top.php";
print "<article>"; 
    // print '<table>';
    //now print out each record
    $query = 'select * from tblUserInfo'; 
    
    if ($debug)
    print "<p>sql " . $query;
    
    //$info2 = $thisDatabaseReader->testquery($query, "", 0, 0, 0, 0, false, false);
    $info2 = $thisDatabaseReader->select($query, "", 0,0, 0, 0, false, false);
    
    $columns = 10;
    
    if ($debug) {
        print "<pre>";
        print_r($info2);
        print "</pre>";
    }
    
    
//   $headerFields = array_keys($info2[0]);
//   $headerArray = array_filter($headerFields, "is_string");
//    
//   // echo "<h2> Records: " . count($info2) . "</h2>";
//    print '<table>';
//    //header block
//    print '<tr class="tblHeaders">';
//    foreach ($headerArray as $key) {
//        $camelCase = preg_split('/(?=[A-Z])/', substr($key, 3));
//        $message = "";
//        foreach ($camelCase as $one) {
//            $message .= $one . " ";
//        }
//        print '<th>' . $message . '</th>';
//    }
//    print '</tr>';
//   // print '<table>';
//    $highlight = 0; // used to highlight alternate rows
//   // print '<p>Total Records:'. count($info2). '</p>';
//    print '<p>SQL'. $query. '</p>';
//    
//    $variable = array_keys($array-variable);
//    foreach ($info2 as $rec) {
//        $highlight++;
//        if ($highlight % 2 != 0) {
//            $style = ' odd ';
//        } else {
//            $style = ' even ';
//        }
//        print '<tr class="' . $style . '">';
//        for ($i = 0; $i < $columns; $i++) { 
//            print '<td>' . $rec[$i] . '</td>';
//        }
//        print '</tr>';
//    }
//    // all done
//    print '</table>';
//    print '</aside>';
//
//print '</article>';
//}
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// print out the results
print "<ol>\n";
foreach ($info2 as $user) {
    print "<li>";
    if ($adminId) {
        print '<a href="update.php?id=' . $onePost["pmkUserId"] . '">[Edit]</a>';
        print '<a href="delete.php?id=' . $onePost["pmkUserId"] . '">[Delete]</a>';
        
    }
    print $users['fldFirstName'] . " " . $user['fldLastName']  ."</li>\n";
}
print "</ol>\n";
print "</article>";
print "</div>";
?>

 <div id="footer">
<?php
include "footer.php";
?>
 </div>

