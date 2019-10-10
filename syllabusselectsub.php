<!DOCTYPE HTML>
<html>
    <head>
        <title>Mark Entry</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
        <!-- Custom CSS -->
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <!-- font-awesome icons CSS -->
        <link href="css/font-awesome.css" rel="stylesheet">
        <!-- //font-awesome icons CSS -->
        <!-- side nav css file -->
        <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
        <!-- side nav css file -->
        <!-- js-->
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/modernizr.custom.js"></script>
        <!--webfonts-->
        <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
        <!--//webfonts--> 
        <!-- Metis Menu -->
        <script src="js/metisMenu.min.js"></script>
        <script src="js/custom.js"></script>
        <link href="css/custom.css" rel="stylesheet">
        <!--//Metis Menu -->
    </head>
    <body class="cbp-spmenu-push">
        <div class="main-content">
        <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
            <!--left-fixed -navigation-->
            <aside class="sidebar-left">
                <nav class="navbar navbar-inverse">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <!--<h1><a class="navbar-brand" href="index.html"><span class="fa fa-area-chart"></span> Glance<span class="dashboard_text">Design dashboard</span></a></h1>-->
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="sidebar-menu">
                            <li class="header">MAIN NAVIGATION</li>
                            <li class="treeview">
                                <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Mark Entry</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="CIA1selectsubject.php"><i class="fa fa-angle-right"></i>CIA I</a></li>
                                    <li><a href="CIA2selectsubject.php"><i class="fa fa-angle-right"></i>CIA II</a></li>
                                    <li><a href="CIA3selectsubject.php"><i class="fa fa-angle-right"></i>CIA III</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Question Entry</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="CIA1qentry.php"><i class="fa fa-angle-right"></i>CIA I</a></li>
                                    <li><a href="CIA2qentry.php"><i class="fa fa-angle-right"></i>CIA II</a></li>
                                    <li><a href="CIA3qentry.php"><i class="fa fa-angle-right"></i>CIA III</a></li>
                                </ul>
                            <li class="treeview">
                                <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>View Marks</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="CIA1viewsub.php"><i class="fa fa-angle-right"></i>CIA I</a></li>
                                    <li><a href="CIA2viewsub.php"><i class="fa fa-angle-right"></i>CIA II</a></li>
                                    <li><a href="CIA3viewsub.php"><i class="fa fa-angle-right"></i>CIA III</a></li>
                                    <li><a href="assignment1viewsub.php"><i class="fa fa-angle-right"></i>Assignment I</a></li>
                                    <li><a href="assignment2viewsub.php"><i class="fa fa-angle-right"></i>Assignment II</a></li>
                                    <li><a href="univviewsub.php"><i class="fa fa-angle-right"></i>University Exam</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>View Questions</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="CIA1viewquestions.php"><i class="fa fa-angle-right"></i>CIA I</a></li>
                                    <li><a href="CIA2viewquestions.php"><i class="fa fa-angle-right"></i>CIA II</a></li>
                                    <li><a href="CIA3viewquestions.php"><i class="fa fa-angle-right"></i>CIA III</a></li>
                                    <li><a href="assignment1viewquestions.php"><i class="fa fa-angle-right"></i>Assignment I</a></li>
                                    <li><a href="assignment2viewquestions.php"><i class="fa fa-angle-right"></i>Assignment II</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </aside>
        </div>
        <!-- /.navbar-collapse -->
        <!-- main page -->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                   
                    <div class="panel-body widget-shadow">
                        <h4>Syllabus Entry</h4>
                        <form method = "GET" action="getsyllabus.php">
                            <div class="form-group">
                                <label for="Coursecode" class="col-sm-2 control-label">Course Name</label>
                                <div class="col-sm-8">
                                    <select name="coursecode"  class="form-control1" id="getcc">
                                        <option disabled>Select a course</option>
                                        <?php
                                             
                                                
                                                
                                               
                                                
                                                if ($mysqli->connect_errno) {
                                                      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                                                }
                                                $sql="SELECT coursename,coursecode from coursemaster";
                                                $result=$mysqli->query($sql);
                                                $counter=mysqli_num_rows($result);
                                                for($i=0;$i<$counter;$i++)
                                                {
                                                   $row=$result->fetch_assoc();
                                                   echo "<option value='".$row['coursecode']."'>".$row['coursename']."</option>";
                                                }
                                                
                                            ?>
                                    </select>
                                </div>
                                <input type="submit" class="btn red" value="Enter">
                            </div>
                            
                        </form>
                        </div>
                </div>
            </div>
        </div>
        <!-- Classie --><!-- for toggle left push menu script -->
        <script src="js/classie.js"></script>
        <script>
            var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
            	showLeftPush = document.getElementById( 'showLeftPush' ),
            	body = document.body;
            	
            showLeftPush.onclick = function() {
            	classie.toggle( this, 'active' );
            	classie.toggle( body, 'cbp-spmenu-push-toright' );
            	classie.toggle( menuLeft, 'cbp-spmenu-open' );
            	disableOther( 'showLeftPush' );
            };
            
            
            function disableOther( button ) {
            	if( button !== 'showLeftPush' ) {
            		classie.toggle( showLeftPush, 'disabled' );
            	}
            }
            
        </script>
        <!-- //Classie --><!-- //for toggle left push menu script -->
        <!-- side nav js -->
        <script src='js/SidebarNav.min.js' type='text/javascript'></script>
        <script>
            $('.sidebar-menu').SidebarNav()
        </script>
        <!-- //side nav js -->
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.js"> </script>
        <!-- //Bootstrap Core JavaScript -->
        <!--scrolling js-->
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <!--//scrolling js-->
        <script>
           function getCourseCode()
            {
               var e = document.getElementById("getcc");
               var strUser = e.options[e.selectedIndex].value;
               return strUser;   
            }
         </script>
    </body>
</html>
