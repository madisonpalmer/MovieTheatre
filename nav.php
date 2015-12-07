<!-- ######################     Main Navigation   ########################## -->
<br />
<hr />
<nav>
    <ol>
        <?php
        // This sets the current page to not be a link. Repeat this if block for
        //  each menu item 
        if ($path_parts['filename'] == "index") {
            print '<li class="activePage"><button class="navbar">Home</button></li>';
        } else {
            print '<li><a href="index.php"><button class="navbar">Home</button></a></li>';
        }
        
        if ($path_parts['filename'] == "tables") {
            print '<li class="activePage"><button class="navbar">Display Tables</button></li>';
        } else {
            print '<li><a href="tables.php"><button class="navbar">Display Tables</button></a></li>';
        }
        
        if ($path_parts['filename'] == "about") {
            print '<li class="activePage"><button class="navbar">About</button></li>';
        } else {
            print '<li><a href="about.php"><button class="navbar">About</button></a></li>';
        }
        
        if ($path_parts['filename'] == "descriptions") {
            print '<li class="activePage"><button class="navbar">Movie Descriptions</button></li>';
        } else {
            print '<li><a href="descriptions.php"><button class="navbar">Movie Descriptions</button></a></li>';
        }
        
        if ($path_parts['filename'] == "upcoming") {
            print '<li class="activePage"><button class="navbar">Upcoming Movies</button></li>';
        } else {
            print '<li><a href="upcoming.php"><button class="navbar">Upcoming Movies</button></a></li>';
        }
        
        if ($path_parts['filename'] == "suggestions") {
            print '<li class="activePage"><button class="navbar">Suggestions</button></li>';
        } else {
            print '<li><a href="suggestions.php"><button class="navbar">Suggestions</button></a></li>';
        }
        
//        if ($path_parts['filename'] == "populate-table.php") {
//            print '<li class="activePage">Populate Tables</li>';
//        } else {
//            print '<li><a href="populate-table.php">Populate Tables</a></li>';
//        }
        
        ?>
    </ol>
</nav>
<hr />
<!-- #################### Ends Main Navigation    ########################## -->

