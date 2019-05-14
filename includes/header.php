


    <!-- This one in here is responsive menu for tablet and mobiles -->
    <div class="responsive-navigation visible-sm visible-xs">
        <a href="#" class="menu-toggle-btn">
            <i class="fa fa-bars"></i>
        </a>
        <div class="responsive_menu">
            <ul class="main_menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Events</a>
                    <ul>
                        <li><a href="events-grid.html">Events Grid</a></li>
                        <li><a href="events-list.html">Events List</a></li>
                        <li><a href="event-single.html">Event Details</a></li>
                    </ul>
                </li>
                <li><a href="#">Courses</a>
                    <ul>
                        <li><a href="courses.html">Course List</a></li>
                        <li><a href="course-single.html">Course Single</a></li>
                    </ul>
                </li>
                <li><a href="#">Blog Entries</a>
                    <ul>
                        <li><a href="blog.html">Blog Grid</a></li>
                        <li><a href="blog-single.html">Blog Single</a></li>
                        <li><a href="blog-disqus.html">Blog Disqus</a></li>
                    </ul>
                </li>
                <li><a href="#">Pages</a>
                    <ul>
                        <li><a href="archives.html">Archives</a></li>
                        <li><a href="shortcodes.html">Shortcodes</a></li>
                        <li><a href="gallery.html">Our Gallery</a></li>
                    </ul>
                </li>
                <li><a href="contact.html">Contact</a></li>
            </ul> <!-- /.main_menu -->
            <ul class="social_icons">
                <li><a href="<?php echo "$fb";?>"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?php echo "$twitter";?>"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?php echo "$linkedin";?>"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="<?php echo "$google_plus";?>"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="<?php echo "$youtube";?>"><i class="fa fa-youtube"></i></a></li>
            </ul> <!-- /.social_icons -->
        </div> <!-- /.responsive_menu -->
    </div> <!-- /responsive_navigation -->


    <header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-md-3 header-left">
                    <p><i class="fa fa-phone"></i><?php echo "$mobile";?></p>
                    <p><i class="fa fa-envelope"></i> <a href="mailto:email@universe.com"><?php echo "$email";?></a></p>
                    <?php
                    if(!isset($_SESSION['username']) && empty($_SESSION['username'])){
                        
                        ?>
                    <p><i class="fa fa-lock"></i> <a href="admin-login.php">Admin Login</a></p>
                    <?php
                
                }
                       ?>
                </div> <!-- /.header-left -->

                <div class="col-md-5">
                    <div class="logo">
                        <a href="index.php" title="Universe" rel="home">
                            <img style="filter:brightness(0) invert(1);" src="images/logo3.png" alt="Universe">
                        </a>
                    </div> <!-- /.logo -->
                </div> <!-- /.col-md-4 -->
                
                <?php
                    
                    if(isset($_SESSION['hsc_roll']) && !empty($_SESSION['hsc_roll']))
                       {
                        
                        ?>               
                <div class="col-md-4 header-right">
                    <ul class="small-links">
                        <li><a href="help.php">Help</a></li>
                        <li><a href="user_dashboard/user-dashboard.php">Dashboard</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                    
                </div>
                <?php
                    }
                    else if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
                        
                        ?>
                        <div class="col-md-4 header-right">
                    <ul class="small-links">
                        <li><a href="help.php">Help</a></li>
                        <li><a href="admin/admin-dashboard.php">Dashboard</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                    
                </div>
                <?php
                    }
                
                else
                {
                       ?>
                       <div class="col-md-4 header-right">
                    <ul class="small-links">
                        <li><a href="help.php">Help</a></li>
                        <li><a href="reg-form.php">Apply Now</a></li>
                    </ul>
                    
                </div>
                <?php
                
                }
                       ?>
                       
                 <!-- /.header-right -->
            </div>
        </div> <!-- /.container -->

        <div class="nav-bar-main" role="navigation">
            <div class="container">
                <nav class="main-navigation clearfix visible-md visible-lg" role="navigation">
                        <ul class="main-menu sf-menu">
                            <li class="<?php if($this_page=="home"){echo "active";}?>"><a href="index.php">Home</a></li>
                            <li class=""><a href="index.php#notices">Notices</a></li>
                            <li class="<?php if($this_page=="help"){echo "active";}?>"><a href="help.php">Apply Process</a></li>                            
                            <li class="<?php if($this_page=="contact"){echo "active";}?>"><a href="contact.php">Contact</a></li>
                        </ul> <!-- /.main-menu -->

                        <ul class="social-icons pull-right">
                            <li><a href="<?php echo "$fb";?>"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?php echo "$twitter";?>"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?php echo "$linkedin";?>"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="<?php echo "$google_plus";?>"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="<?php echo "$youtube";?>"><i class="fa fa-youtube"></i></a></li>
                        </ul> <!-- /.social-icons -->
                </nav> <!-- /.main-navigation -->
            </div> <!-- /.container -->
        </div> <!-- /.nav-bar-main -->

    </header>