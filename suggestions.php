<?php
/* the purpose of this page is to display a form to allow a user and allow us
 * to add a new user or update an existing user 
 * 
 * Written By: Meaghan Winter
 */
include "top.php";
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1 Initialize variables
$debug = true;
$update = false;
// SECTION: 1a.
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1b Security
//
// define security variable to be used in SECTION 2a.
$yourURL = $domain . $phpSelf;
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1c form variables
//
// Initialize variables one for each form element
// in the order they appear on the form
if (isset($_GET["id"])) {
    $pmkUserId = (int) htmlentities($_GET["id"], ENT_QUOTES, "UTF-8");
    $query = 'SELECT fldFirstName, fldLastName, fldBirthDate, fldEmail ';
    $query .= 'FROM tblUserInfo '
            . 'WHERE pmkUserId = ?';
    $results = $thisDatabaseWriter->select($query, array($pmkUserId), 1, 0, 0, 0, false, false);
    $firstName = $results[0]["fldFirstName"];
    $lastName = $results[0]["fldLastName"];
    $birthday = $results[0]["fldBirthDate"];
    $email = $results[0]["fldEmail"];
} else {
    $pmkUserId = -1;
    $firstName = "";
    $lastName = "";
    $birthday = "";
    $email = "";
}
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$firstNameERROR = false;
$lastNameERROR = false;
$birthdayERROR = false;
$emailERROR = false;
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1e misc variables
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array();
$data = array();
$dataEntered = false;
// used for building email message to be sent and displayed
$mailed = false;
$messageA = "";
$messageB = "";
$messageC = "";
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2 Process for when the form is submitted
//
if (isset($_POST["btnSubmit"])) {
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2a Security
//
    /*    if (!securityCheck(true)) {
      $msg = "<p>Sorry you cannot access this page. ";
      $msg.= "Security breach detected and reported</p>";
      die($msg);
      }
     */
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2b Sanitize (clean) data
// remove any potential JavaScript or html code from users input on the
// form. Note it is best to follow the same order as declared in section 1c.
    $pmkUserId = (int) htmlentities($_POST["hidUserId"], ENT_QUOTES, "UTF-8");
    if ($pmkUserId > 0) {
        $update = true;
    }
    // I am not putting the ID in the $data array at this time
    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $data[] = $firstName;
    $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
    $data[] = $lastName;
    $birthday = htmlentities($_POST["txtBirthday"], ENT_QUOTES, "UTF-8");
    $data[] = $birthday;
    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL, 'UTF-8');
    $data[] = $email;
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2c Validation
//
    if ($firstName == "") {
        $errorMsg[] = "Please enter your first name";
        $firstNameERROR = true;
    } elseif (!verifyAlphaNum($firstName)) {
        $errorMsg[] = "Your first name appears to have extra character.";
        $firstNameERROR = true;
    }
    if ($lastName == "") {
        $errorMsg[] = "Please enter your last name";
        $lastNameERROR = true;
    } elseif (!verifyAlphaNum($lastName)) {
        $errorMsg[] = "Your last name appears to have extra character.";
        $lastNameERROR = true;
    }
    if ($birthday == "") {
        $errorMsg[] = "Please enter your birthday";
        $birthdayERROR = true;
    }// should check to make sure its the correct date format
    //
//email checking
    if ($email == "") {
        $errorMsg[] = "Please enter your email address";
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = "Your email address appears to be incorrect.";
        $emailERROR = true;
    }
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2d Process Form - Passed Validation
//
// Process for when the form passes validation (the errorMsg array is empty)
//
    if (!$errorMsg) {
        if ($debug) {
            print "<p>Form is valid</p>";
        }
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2e Save Data
        if ($debug) {
            print '<p> 2e';
        }
        $primaryKey = "";
        $dataEntered = false;
        try {
            $thisDatabaseWriter->db->beginTransaction();
            if ($update) {
                $query = 'UPDATE tblUserInfo SET ';
            } else {
                $query = 'INSERT INTO tblUserInfo SET ';
            }
            if ($debug) {
                print '<p> before query';
            }
            $query .= 'fldFirstName = ?, ';
            $query .= 'fldLastName = ?, ';
            $query .= 'fldBirthDate = ?, ';
            $query .= 'fldEmail = ? ';
            if ($debug) {
                print '<p> after query';
            }
            
            //$data = array($email);
            
            if ($update) {
                $query .= 'WHERE pmkUserId = ?';
                $data[] = $pmkUserId;
                //if ($_SERVER["REMOTE_USER"] == 'mewinter') {
                $results = $thisDatabaseWriter->update($query, $data, 1, 0, 0, 0, false, false);
                // }
                  } else {
                //     if ($_SERVER["REMOTE_USER"] == 'mewinter') {
                $results = $thisDatabaseWriter->insert($query, $data);
                $primaryKey = $thisDatabaseWriter->lastInsert();
                if ($debug) {
                    print "<p>pmk= " . $primaryKey;
                }
            }
           
//               }
            if ($debug) {
                print '<p> update';
            }
            // all sql statements are done so lets commit to our changes
            //if($_SERVER["REMOTE_USER"]=='rerickso'){
            $dataEntered = $thisDatabaseWriter->db->commit();
            // }else{
            //     $thisDatabase->db->rollback();
            // }
            $dataEntered = true;
            if ($debug)
                print "<p>transaction complete ";
        } catch (PDOExecption $e) {
            $thisDatabaseWriter->db->rollback();
            if ($debug)
                print "Error!: " . $e->getMessage() . "</br>";
            $errorMsg[] = "There was a problem with accpeting your data please contact us directly.";
        }
        // If the transaction was successful, give success message
        if ($dataEntered) {
            if ($debug)
                print "<p>data entered now prepare keys ";
            //#################################################################
            // create a key value for confirmation
            
            $query = "SELECT fldDateJoined FROM tblUserInfo WHERE pmkUserId=" . $primaryKey;
           
            $results = $thisDatabaseReader->select($query);
            print "<p>1";
            $dateSubmitted = $results[0]["fldDateJoined"];
            print "<p>2";
            $key1 = sha1($dateSubmitted);
            $key2 = $primaryKey;
            if ($debug)
                print "<p>key 1: " . $key1;
            if ($debug)
                print "<p>key 2: " . $key2;
            print '<p> selct thing works</p>';
            //#################################################################
            //
            //Put forms information into a variable to print on the screen
            //
            $messageA = '<h2>Thank you for registering.</h2>';
            $messageB = "<p>Click this link to confirm your registration: ";
            $messageB .= '<a href="' . $domain . $path_parts["dirname"] . '/confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . '">Confirm Registration</a></p>';
            $messageB .= "<p>or copy and paste this url into a web browser: ";
            $messageB .= $domain . $path_parts["dirname"] . '/confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . "</p>";
            $messageC .= "<p><b>Email Address:</b><i>   " . $email . "</i></p>";
            //##############################################################
            //
            // email the form's information
            //
            $to = $email; // the person who filled out the form
            $cc = "";
            $bcc = "";
            $from = "DigiPix <noreply@yoursite.com>";
            $subject = "Confirm email for DigiPix";
            $mailed = sendMail($to, $cc, $bcc, $from, $subject, $messageA . $messageB . $messageC);
        } //data entered  
        print'<p>data mailed</p>';
    } // end form is valid
} // ends if form was submitted.
if ($debug) {
    print '<p> Form submitted';
    print "<p>Section 3</p>";
}
//#############################################################################
//
// SECTION 3 Display Form
//
?>
<article id="main">
    <?php
//####################################
//
// SECTION 3a.
//
//// If its the first time coming to the form or there are errors we are going
// to display the form.
    
//
//
// If its the first time coming to the form or there are errors we are going
// to display the form.
//    if ($dataEntered) { // closing of if marked with: end body submit
//        print "<h1>Record Saved</h1> ";
//    } else {
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit
        print "<h1>Your Request has ";
        if (!$mailed) {
            print "not ";
        }
        print "been processed</h1>";
        print "<p>A copy of this message has ";
        if (!$mailed) {
            print "not ";
        }
        print "been sent</p>";
        print "<p>To: " . $email . "</p>";
        print "<p>Mail Message:</p>";
        print $messageA . $messageC;
    } else {
        
//####################################
//
// SECTION 3b Error Messages
//
// display any error messages before we print out the form
        if ($errorMsg) {
            print '<div id="errors">';
            print '<h1>Your form has the following mistakes</h1>';
            print "<ol>\n";
            foreach ($errorMsg as $err) {
                print "<li>" . $err . "</li>\n";
            }
            print "</ol>\n";
            print '</div>';
        }
//####################################
//
// SECTION 3c html Form
//
        /* Display the HTML form. note that the action is to this same page. $phpSelf
          is defined in top.php
          NOTE the line:
          value="<?php print $email; ?>
          this makes the form sticky by displaying either the initial default value (line 35)
          or the value they typed in (line 84)
          NOTE this line:
          <?php if($emailERROR) print 'class="mistake"'; ?>
          this prints out a css class so that we can highlight the background etc. to
          make it stand out that a mistake happened here.
         */
        ?>
        <form action="<?php print $phpSelf; ?>"
              method="post"
              id="frmRegister">
            <fieldset class="wrapper">
                <legend>User Information</legend>

                <input type="hidden" id="hidUserId" name="hidUserId"
                       value="<?php print $pmkUserId; ?>"
                       >

                <label for="txtFirstName" class="required">First Name
                    <input type="text" id="txtFirstName" name="txtFirstName"
                           value="<?php print $firstName; ?>"
                           tabindex="100" maxlength="45" placeholder="Enter your first name"
                           <?php if ($firstNameERROR) print 'class="mistake"'; ?>
                           onfocus="this.select()"
                           autofocus>
                </label>

                <label for="txtLastName" class="required">Last Name
                    <input type="text" id="txtLastName" name="txtLastName"
                           value="<?php print $lastName; ?>"
                           tabindex="100" maxlength="45" placeholder="Enter your last name"
                           <?php if ($lastNameERROR) print 'class="mistake"'; ?>
                           onfocus="this.select()"
                           >
                </label>

                <label for="txtBirthday" class="required">Birthday
                    <input type="text" id="txtBirthday" name="txtBirthday"
                           value="<?php print $birthday; ?>"
                           tabindex="100" maxlength="45" placeholder="YYYY-MM-DD"
                           <?php if ($birthdayERROR) print 'class="mistake"'; ?>
                           onfocus="this.select()"
                           >
                </label>  

                <label for="txtEmail" class="required">Email
                    <input type="text" id="txtEmail" name="txtEmail"
                           value="<?php print $email; ?>"
                           tabindex="120" maxlength="45" placeholder="Enter a valid email address"
                           <?php if ($emailERROR) print 'class="mistake"'; ?>
                           onfocus="this.select()" 
                           autofocus>
                </label>

            </fieldset> <!-- ends contact -->
            </fieldset> <!-- ends wrapper Two -->
            <fieldset class="buttons">
                <legend></legend>
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Save" tabindex="900" class="button">
            </fieldset> <!-- ends buttons -->
            </fieldset> <!-- Ends Wrapper -->
        </form>
        <?php
    } // end body submit
    ?>
</article>

<?php
include "footer.php";
if ($debug)
    print "<p>END OF PROCESSING</p>";
?>