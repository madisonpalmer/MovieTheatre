<!-- ######################     Main Navigation   ########################## -->
<br />
<hr />
<nav>
    <ol>
        <?php
        // This sets the current page to not be a link. Repeat this if block for
        //  each menu item 
        if ($path_parts['filename'] == "index") {
            print '<li class="activePage"><button>Home</button></li>';
        } else {
            print '<li><a href="index.php"><button>Home</button></a></li>';
        }
        
        if ($path_parts['filename'] == "tables") {
            print '<li class="activePage"><button>Display Tables</button></li>';
        } else {
            print '<li><a href="tables.php"><button>Display Tables</button></a></li>';
        }
        
        if ($path_parts['filename'] == "about") {
            print '<li class="activePage"><button>About</button></li>';
        } else {
            print '<li><a href="about.php"><button>About</button></a></li>';
        }
        
        if ($path_parts['filename'] == "descriptions") {
            print '<li class="activePage"><button>Movie Descriptions</button></li>';
        } else {
            print '<li><a href="descriptions.php"><button>Movie Descriptions</button></a></li>';
        }
        
        if ($path_parts['filename'] == "upcoming") {
            print '<li class="activePage"><button>Upcoming Movies</button></li>';
        } else {
            print '<li><a href="upcoming.php"><button>Upcoming Movies</button></a></li>';
        }
        
        if ($path_parts['filename'] == "suggestions") {
            print '<li class="activePage"><button>Suggestions</button></li>';
        } else {
            print '<li><a href="suggestions.php"><button>Suggestions</button></a></li>';
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

