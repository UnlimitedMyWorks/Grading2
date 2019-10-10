<?php include("header.php");include("config.php");?>
<div id="page-wrapper">
<div class="main-page">
<div class="tables">
<h2 class="title1">Add Staff</h2>
<div class="panel-body widget-shadow">
<h4></h4>
<form method = "post" action="#">
    <div class ="grids widget-shadow">
        <div class="form-group">
            <div class = "row">
                <label for="Coursecode" class="col-sm-2 control-label">Staff Code</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control1"  name= "staffid" required="">
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class = "row">
                    <label for="coursename" class="col-sm-2 control-label">Staff Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control1"  name= "staffname" required="">
                    </div>
                </div>
                </div>
                <div class="form-group">
                <div class = "row">
                    <label for="coursename" class="col-sm-2 control-label">Designation</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control1"  name= "designation" required="">
                    </div>
                </div>
                </div>
                <div class="form-group">
                <div class = "row">
                    <label for="coursename" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control1"  name= "email" required="">
                    </div>
                </div>
                </div>
                    <div class="form-group">
                        <div class = "row">
                            <label for="coursename" class="col-sm-2 control-label">School</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1"  name= "school" required="">
                             </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class = "row">
                            <label for="Course Outcome " class="col-sm-2 control-label">Department</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1"  name= "department" required="">
                            </div>
                        </div>
                    </div>
                    <a href="files/staffmaster(1).csv" download="staffmaster.csv">Download staffmaster</a>
                    <button type = "submit" class = "btn btn-danger" name="staffsubmit">Submit</button>
                </form>
            </div>
        </div>  
        </div>
    </div>
<?php
    $coursecode=filter_input(INPUT_GET,'coursecode');
    
    
   
    
    if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    if(isset($_POST['staffsubmit']))
    {
        $staffid=$_POST['staffid'];
        $sql="SELECT staffid from staffmaster where staffid='".$staffid."'";
        if(mysqli_num_rows($mysqli->query($sql))>0)
        {
            echo "<script>alert('Staff Already Exists!');</script>";
        }
        else{
            $staffname=$_POST['staffname'];
            $designation=$_POST['designation'];
            $school=$_POST['school'];
            $department=$_POST['department'];
            $email=$_POST['email'];
            $sql="INSERT into staffmaster VALUES('$staffid','$staffname','$designation','$school','$email','$department','U')";
            $result=$mysqli->query($sql);
            echo $sql;
            if($result)
            {
                echo "<script>alert('Staff Added Succesfully');</script>";
            }
        }
    }
    
    ?>
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
</body>
</html>
