<!-- ######################     Main Navigation   ########################## -->
<br />
<nav class="navbar navbar-default">
    <ol>
        <?php
        // This sets the current page to not be a link. Repeat this if block for
        //  each menu item 
        //  
        
          $pmkUserId = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");
          $adminId = "SELECT * from tblAdmins";
          //$adminArray = $thisDatabaseReader->testquery($adminId, "", 0,0,0,0, false, false);
          $adminArray = $thisDatabaseReader->select($adminId, "", 0,0,0,0, false, false);
          
    
      
        
        //Home
        if ($path_parts['filename'] == "index") {
            print '<li class="activePage">Home</li>';
        } else {
            print '<li><a href="index.php">Home</a></li>';
        }
        
        //pricecs
        if ($path_parts['filename'] == "Movie Prices") {
            print '<li class="activePage">Movie Prices</li>';
        } else {
            print '<li><a href="pricing.php">Movie Prices</a></li>';
        }
        
        //Detailed Show Time
        if ($path_parts['filename'] == "Current Show Times") {
            print '<li class="activePage">Current Show Times</li>';
        } else {
            print '<li><a href="currentMovieSchedule.php">Current Show Times</a></li>';
        }
        
        //Movie Description 
        if ($path_parts['filename'] == "Movie Descriptions") {
            print '<li class="activePage">Movie Descriptions</li>';
        } else {
            print '<li><a href="descriptions.php">Movie Descriptions</a></li>';
        }
        
        
        //Upcoming
        if ($path_parts['filename'] == "Upcoming") {
            print '<li class="activePage">Upcoming</li>';
        } else {
            print '<li><a href="upcoming.php">Upcoming</a></li>';
        }
        
        //Suggestions
        if ($path_parts['filename'] == "Suggestions") {
            print '<li class="activePage">Suggestions</li>';
        } else {
            print '<li><a href="suggestions.php">Suggestions</a></li>';
        }
        
//          //Suggestions Listed
//        if ($path_parts['filename'] == "Suggestions Listed") {
//            print '<li class="activePage"><button>Suggestions Listed</button></li>';
//        } else {
//            print '<li><a href="post.php"><button>Suggestions List</button></a></li>';
//        }
//        
        
        //About
        if ($path_parts['filename'] == "About") {
            print '<li class="activePage">About</li>';
        } else {
            print '<li><a href="about.php">About</a></li>';
        }
        
        //Employment 
        if ($path_parts['filename'] == "Employment") {
            print '<li class="activePage">Employment</li>';
        } else {
            print '<li><a href="employment.php">Employment</a></li>';
        }
        
        //shows to only admins
        foreach($adminArray as $adminId){
            //foreach($adminId as $rec){
                //print $rec; 
            //}
             
        
           for($i =0; $i<1; $i++)
            {
                
               if($pmkUserId == $adminId[$i])
               {
                    //print $username . ' : ' . $adminId[$i]; 
                    
                if ($path_parts['filename'] == "Suggestions Listed") {
            print '<li class="activePage">Suggestions Listed</li>';
        } else {
            print '<li><a href="post.php">Suggestions List</a></li>';
        }
                }
                     
            }
        }
        
      
        ?>
    </ol>
</nav>

<!-- #################### Ends Main Navigation    ########################## -->


