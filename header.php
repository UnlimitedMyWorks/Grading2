<?php
    session_start();
    if(!isset($_SESSION['staffid']))
    {
        header("Location:index.php");
    }
    include("config.php");
    if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        
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
                            <li class="header"><img src="images/image.png" height="75" width="200"> </li>
                            <?php 
                            if($_SESSION['role']=="SU")
                            {?>
                            <li class="treeview">
                                <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Subjects</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="addsubject.php"><i class="fa fa-angle-right"></i>Add Subject</a></li>
                                    <li><a href="viewsubjects.php"><i class="fa fa-angle-right"></i>View Subjects</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Staff</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="addstaff.php"><i class="fa fa-angle-right"></i>Add Staff</a></li>
                                    <li><a href="viewstaff.php"><i class="fa fa-angle-right"></i>View Staff</a></li>
                                    <li><a href="assignstaff.php"><i class="fa fa-angle-right"></i>Assign Staff</a></li>
                                    <li><a href="viewassignedstaff.php"><i class="fa fa-angle-right"></i>View Assigned Staff</a></li>
                                    <li><a href="grantaccess.php"><i class=" fa fa-angle-right"></i>Assign Courseadmin</a></li>
                                    <li><a href="removeaccess.php"><i class=" fa fa-angle-right"></i>Remove Courseadmin</a></li>
                                    <li><a href="viewcourseadmin.php"><i class=" fa fa-angle-right"></i>View Courseadmin</a></li>
                                </ul>
                            </li>
                            <?php }?>
                            <li class="treeview">
                                <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Course Delivery Plan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="syllabusviewsub.php"><i class="fa fa-angle-right"></i>Generate Course Delivery Plan</a></li>
                                    <?php $sql="SELECT * FROM courseadmin where staffid='".$_SESSION['staffid']."'";
                                        
                                            $result=$mysqli->query($sql);
                                            if(mysqli_num_rows($result)>0)
                                            {
                                            ?>
                                    <li><a href="levelentrysub.php"><i class="fa fa-angle-right"></i>Enter course details</a></li>
                                    <?php }?>
                                    <?php if($_SESSION['role']=="SU"){?>
                                    <li><a href="viewcompleted.php"><i class="fa fa-angle-right"></i>Completed Subjects</a></li>
                                    <?php }?>
                                </ul>
                            </li>
                            <?php $sql="SELECT * FROM courseadmin where staffid='".$_SESSION['staffid']."'";
                                        
                                            $result=$mysqli->query($sql);
                                            if(mysqli_num_rows($result)>0)
                                            {
                                            ?>
                            <li class="treeview">
                                <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Question Entry</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="CIA1sub.php"><i class="fa fa-angle-right"></i>CIA I</a></li>
                                    <li><a href="CIA2sub.php"><i class="fa fa-angle-right"></i>CIA II</a></li>
                                    <li><a href="CIA3sub.php"><i class="fa fa-angle-right"></i>CIA III</a></li>
                                    <li><a href="assignment1selectsub.php"><i class="fa fa-angle-right"></i>Assignment I</a></li>
                                    <li><a href="assignment2selectsub.php"><i class="fa fa-angle-right"></i>Assignment II</a></li>
                                </ul>
                                </li>
                                <?php }?>
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
                                    <li><a href="assignment1sub.php"><i class="fa fa-angle-right"></i>Assignment I</a></li>
                                    <li><a href="assignment2sub.php"><i class="fa fa-angle-right"></i>Assignment II</a></li>
                                    <?php if($_SESSION['role']!="U"){?>
                                    <li><a href="univselectsubject.php"><i class="fa fa-angle-right"></i>University Exam</a></li>
                                    <?php }?>
                                </ul>
                            </li>
                            
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
                                    <?php 
                                        $sql="SELECT * FROM courseadmin where staffid='".$_SESSION['staffid']."'";
                                        $result=$mysqli->query($sql);
                                        if(mysqli_num_rows($result)>0)
                                        {
                                    ?>
                                    <li><a href="univviewsub.php"><i class="fa fa-angle-right"></i>University Exam</a></li>
                                    <?php }?>
                                </ul>
                            </li>
                            
                            <?php 
                            if($_SESSION['role']=="SU")
                            {?>
                            <li class="treeview">
                                <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Status</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="viewcia1status.php"><i class="fa fa-angle-right"></i>CIA 1</a></li>
                                    <li><a href="viewcia2status.php"><i class="fa fa-angle-right"></i>CIA 2</a></li>
                                    <li><a href="viewcia3status.php"><i class="fa fa-angle-right"></i>CIA 3</a></li>
                                    <li><a href="viewuniversitystatus.php"><i class=" fa fa-angle-right"></i>University</a></li>
                                    
                                </ul>
                            </li>
                            <?php }?>
                            <li class="treeview">
                                <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Attainment</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="attsubselect.php"><i class="fa fa-angle-right"></i>View Final Attainment</a></li>
                                    <?php if($_SESSION['role']=="SU")
                                    {?>
                                        <li><a href="viewallattainment.php"><i class="fa fa-angle-right"></i>View All Attainment</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="programeoutcomes.php">
                                <i class="fa fa-laptop"></i>
                                <span>View Program Outcomes</span>
                                <i class="fa fa-angle-left pull-right"></i>
                                </a>
                            </li>   
                        </ul>
                    </div>
                </nav>
            </aside>
        </div>
        <div class="sticky-header header-section ">
			<div class="header-left">
				
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				
				<!--notification menu end -->
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">
				
				
				
				
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									
									<div class="user-name">
                                        <p><?php $staffid=$_SESSION['staffid'];
                                                    $result=$mysqli->query("SELECT `name`,`designation` from staffmaster where staffid='".$staffid."'"); 
                                                    $row=$result->fetch_assoc();
                                                    echo $row['name'];?></p>
                                                    <p><?php echo $row['designation'];?></p>
										
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								
								<li> <a href="home.php"><i class="fa fa-suitcase"></i>Profile</a> </li> 
								<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>