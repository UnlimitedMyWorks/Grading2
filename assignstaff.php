<?php include("header.php");require("config.php");?>
<div id="page-wrapper">
<div class="main-page">
    <div class="tables">
        <h2 class="title1">Assign Staff To Class</h2>
        <div class="panel-body widget-shadow">
            <h4></h4>
            <form method = "post">
                <div class="form-group">
                    <div class = "row">
                        <label for="Course Outcome No" class="col-sm-2 control-label">Staff</label>
                        <div class="col-sm-8">
                            <select name= "staffid" class="form-control1">
                            <?php 
                                $sql="SELECT `staffid`,`name` from staffmaster";
                                $result=$mysqli->query($sql);
                                for($i=0;$i<mysqli_num_rows($result);$i++)
                                {
                                    $row=$result->fetch_assoc();
                                    echo "<option value='".$row['staffid']."'>".$row['name']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class = "row">
                        <label for="Course Outcome No" class="col-sm-2 control-label">Course </label>
                        <div class="col-sm-8">
                            <select name= "coursecode" class="form-control1">
                            <?php 
                                $sql="SELECT coursecode,coursename from coursemaster";
                                $result=$mysqli->query($sql);
                                for($i=0;$i<mysqli_num_rows($result);$i++)
                                {
                                    $row=$result->fetch_assoc();
                                    echo "<option value='".$row['coursecode']."'>".$row['coursename']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class = "row">
                            <label for="coursename" class="col-sm-2 control-label">Class</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1"  name= "class" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class = "row">
                            <label for="coursename" class="col-sm-2 control-label">Semester</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1"  name= "sem" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class = "row">
                            <label for="coursename" class="col-sm-2 control-label">Department</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1"  name= "department" required="">
                            </div>
                        </div>
                    </div>
                    <button type = "submit" class = "btn btn-danger" name="assignsubmit">Submit</button>
                    <a href="files/classmapping.csv" download="classmapping.csv">Download Class Mapping </a>
            </form>
            </div>
        </div>
    </div>
</div>
<?PHP
    if(isset($_POST['assignsubmit']))
    {
        $staffid=$_POST['staffid'];
        $coursecode=$_POST['coursecode'];
        $class=$_POST['class'];
        $department=$_POST['department'];
        $sem=$_POST['sem'];
        $sql="SELECT * from classmapping where staffid='".$staffid."' AND class='".$class."' AND department='".$department."' AND sem='".$sem."'";
        $result=$mysqli->query($sql);
        $sql="SELECT coursename from coursemaster WHERE coursecode='" .$coursecode."'";
        $row=($mysqli->query($sql))->fetch_assoc();
        $coursename=$row['coursename'];
        $sql="INSERT INTO classmapping VALUES ('$staffid','$coursecode','$coursename','$class','$sem','$department')";
        $result=$mysqli->query($sql);
        if($result)
        {
            echo "<script>alert('Staff succesfully Assigned to Class!')</script>";
        }  
    }
    ?>
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
