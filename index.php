
<?php
    require 'class.smtp.php';
    require 'class.phpmailer.php';
    require("config.php");

    session_start();
    if(isset($_SESSION['staffid']))
    {
        header("Location:home.php");
    }
    if(isset($_POST['staffloginButton'])) {
        $smtp = new SMTP();
        //$ec = $smtp->Connect("mail.sastra.edu", 587);
        //$ec = $smtp->Connect("ssl://smtp.gmail.com", 465);
        $staffid = $_POST['staffid'];
        $password = $_POST['password'];
        if(empty($staffid)) {$errors[] = "Enter a Staff ID.";}
        if(empty($password)) {$errors[] = "Enter your password.";}
        
        //if(empty($errors)) {
            //if($smtp->Connected()) {
               //$smtp->Hello("mail.sastra.edu");
                //$smtp->Hello("mail.google.com");
                //$present = $smtp->Authenticate($staffid, $password);
                                   
                                    if ($mysqli->connect_errno) {
                                          echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                                    }
               //if($present) {
                    $sql = $mysqli->query("select * from staffmaster where email='".$staffid."'");
                    
                    $row = $sql->fetch_assoc();
                    $_SESSION["staffid"] = $row['staffid'];
                    $_SESSION["staffname"] =$row['staffname'];
                    $_SESSION["role"] =$row['priveleges'];
                    header("Location:home.php");
                //}
               // else {
                //    $errors[] = "<font color='red'>Error: Invalid Email ID/Password. Please try again.</font>";
               // }
            //}
            //else {
            //    $errors[] = "<font color='red'>Error: Mail Server not responding (or) Please check your Shanmail ID.</font>";
            //}
        //}
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS-->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons CSS-->

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
<body >

		<!--left-fixed -navigation-->
    
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page login-page ">
				<h2 class="title1">Login</h2>
				<div class="widget-shadow">
					<div class="login-body">
						<form action="#" method="post">
							<input type="email" class="user" name="staffid" placeholder="Enter Your Email" >
							<input type="password" name="password" class="lock" placeholder="Password" >
							
							<input type="submit" name="staffloginButton" value="Sign In">
							<div id="info" style="color:red"><?php	if(empty($errors) === false){echo '<p>' . implode('</p><p>', $errors) . '</p>';	}?> </div>
						</form>
					</div>
				</div>
				
			</div>
		</div>
		
	</div>
	
	<!-- side nav js -->
	<script src='js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //side nav js -->
	
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
		
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
	<!-- //Bootstrap Core JavaScript -->
   
</body>
</html>