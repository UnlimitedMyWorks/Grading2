<?php 
    include('header.php');
    include("config.php");
    
?>
<div id="page-wrapper">
    <div class="main-page">
    <div class="panel-body widget-shadow">
        <div class="tables">
        <table class="table">                
        <thead>
            <tr>
                <th>Staff Name</th>
                <th>Course name</th>
                <th>Semester</th>
                <th>Class</th>
                <th>Progress</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT DISTINCT classmapping.coursecode,classmapping.coursename, classmapping.sem, classmapping.department FROM `classmapping` ORDER by classmapping.coursecode ASC,classmapping.department ASC";
                $result=$mysqli->query($sql);
                for($i=0;$i<mysqli_num_rows($result);$i++)
                {
                    $row=$result->fetch_assoc();
                    $cocd=$row['coursecode'];
                    $dept=$row['department'];
                    $sec=$row['section'];
                    $sem=$row['sem'];
                    $staffid=$row['staffid'];
                    $sql1="SELECT * from university where sem='$sem' and coursecode='$cocd'";
                    $result1=$mysqli->query($sql1);
                    
                    if(mysqli_num_rows($result1)>0)
                        echo "<tr><td>".$row['coursename']."</td><td>".$row['sem']."</td><td>".$row['department']."</td><td>Completed</td></tr>";
                    else
                        echo "<tr><td>".$row['coursename']."</td><td>".$row['sem']."</td><td>".$row['department']."</td><td>NOT Completed</td></tr>";
                }            
            ?>
        </tbody>
        </table>
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