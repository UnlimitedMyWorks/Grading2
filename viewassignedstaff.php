<?php include('header.php');include("config.php"); ?>

<div id="page-wrapper">
    <div class="main-page">
        <div class="tables">
            <h2 class="title1">Assigned Staff </h2>
            <div class="panel-body widget-shadow">
            <table class="table"> 
                <thead>
                    <tr>
                        <th>Staff Name</th>
                        <th>Course Name</th>
                        <th>Semester</th>
                        <th>Section</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT staffmaster.name,classmapping.staffid,classmapping.coursename,classmapping.sem,classmapping.section,classmapping.department FROM `classmapping`,staffmaster where staffmaster.staffid=classmapping.staffid ORDER by classmapping.sem ASC,classmapping.department ASC, classmapping.section ASC";
                        $result=$mysqli->query($sql);
                        for($i=0;$i<mysqli_num_rows($result);$i++)
                        {
                            $row=$result->fetch_assoc();
                            echo "<tr><td>".$row['name']."</td><td>".$row['coursename']."</td><td>".$row['sem']."</td><td>".$row['section']."</td><td>".$row['department']."</td><td><form method='POST'><input type='hidden' name='coursename' value='".$row['coursename']."'><input type='hidden' name='staffid' value='".$row['staffid']."'><input type='hidden' name='section' value='".$row['section']."'><input type='hidden' name='dept' value='".$row['department']."'><button type = 'submit' class = 'btn btn-danger' name='delete'>Delete</button></form></td></tr>";
                        }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<!---/mainpage--->
<?php
    if(isset($_POST['delete']))
    {
        $staffid=$_POST['staffid'];
        $coursename=$_POST['coursename'];
        $dept=$_POST['dept'];
        $section=$_POST['section'];
        $sql="DELETE from classmapping where staffid='$staffid' AND department='$dept' AND section='$section' AND coursename='$coursename'";
        $result=$mysqli->query($sql);
        if($result)
            echo "<script>alert('Sucessfully Deleted!!');window.location.href='viewassignedstaff.php';</script>";
        else    
            echo "<script>alert('Not Deleted!!');</script>";
        
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
