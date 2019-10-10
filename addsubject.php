<?php include("header.php");include("config.php");?>
<div id="page-wrapper">
<div class="main-page">
<div class="tables">
<h2 class="title1">Add Subject</h2>
<div class="panel-body widget-shadow">
<h4></h4>
<form method = "post" >
    <div class ="grids widget-shadow">
        <div class="form-group">
            <div class = "row">
                <label for="Coursecode" class="col-sm-2 control-label">Coursecode</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control1"  name= "coursecode" required="">
                </div>
            </div>
            <div class="form-group">
                <div class = "row">
                    <label for="coursename" class="col-sm-2 control-label">Course Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control1"  name= "coursename" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class = "row">
                        <label for="Course Outcome No" class="col-sm-2 control-label">Course Catogory</label>
                        <div class="col-sm-8">
                            <select name= "ctype">
                                <option value="Theory">Theory</option>
                                <option value="Lab">Lab</option>
                                <option value="Semi Theory Semi Lab">Semi Theory Semi Lab</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class = "row">
                            <label for="Course Outcome " class="col-sm-2 control-label">Credits</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control1"  name= "credits">
                            </div>
                        </div>
                    </div>
                    <a href="files/studentmaster.csv" download="studentmaster.csv">Download Coursemaster</a>
                    <button type = "submit" class = "btn btn-danger" name="coursesubmit">Submit</button>
        </form>
        
        
    </div>  
    
</div>
</div>

<?php
    if(isset($_POST['coursesubmit']))
    {

            $coursecode=filter_input(INPUT_GET,'coursecode');
            
            if(isset($_POST['coursesubmit']))
            {
                $coursecode=$_POST['coursecode'];
                $sql="SELECT coursecode from coursemaster where coursecode='".$coursecode."'";
                if(mysqli_num_rows($mysqli->query($sql))>0)
                {
                    echo "<script>alert('Course Already Exits!');</script>";
                }
                else{
                    $coursename=$_POST['coursename'];
                    $credits=$_POST['credits'];
                    $coursetype=$_POST['ctype'];
                    $sql="INSERT into coursemaster VALUES('$coursecode','$coursename','$coursetype','$credits')";
                    $result=$mysqli->query($sql);
                    if($result)
                    {
                        echo "<script>alert('Course Added Succesfully');</script>";
                    }
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
