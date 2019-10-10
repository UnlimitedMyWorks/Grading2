<?php 
    require("header.php");include("config.php");
?>
<div id="page-wrapper">
        <div class="main-page">
            <div class="tables">
                <h2 class="title1">View Subjects</h2>
                <div class="panel-body widget-shadow">
                    <h4></h4>
                    <form method = "post" action="#">
                        <div style="overflow-x:auto;"> 
                            <table class="table">
                                <thead>
                                    <th>Coursecode</th>
                                    <th>Course Name</th>
                                    <th>Course Catogory</th>
                                    <th>Credits</th> 
                                </thead>
                                <tbody>
                                    <?php
                                        
                                        
                                       
                                        
                                        if ($mysqli->connect_errno) {
                                        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                                        }
                                        $sql="SELECT * FROM `coursemaster` ORDER BY `coursecode` ASC ";
                                        $result=$mysqli->query($sql);
                                        for($i=0;$i<mysqli_num_rows($result);$i++)
                                        {
                                            $row=$result->fetch_assoc();
                                            echo "<tr>";
                                            echo "<td>".$row['coursecode']."</td>";
                                            echo "<td>".$row['coursename']."</td>";
                                            echo "<td>".$row['coursecategory']."</td>";
                                            echo "<td>".$row['credits']."</td>";
                                            echo "<td><button type = 'submit' class = 'btn btn-warning' name='edit' value='".$row['coursecode']."'>Edit</button></td>";
                                            echo "<td><button type = 'submit' class = 'btn btn-danger' name='delete' value='".$row['coursecode']."'>Delete</button></td>";
                                            echo "</tr>";
                                        }
                                        
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <?php
                    if(isset($_POST['delete']))
                    {
                        $coursecode=$_POST['delete'];
                        $sql="DELETE from coursemaster where coursecode='".$coursecode."'";
                        $mysqli->query($sql);
                        
                    }
                    if(isset($_POST['edit']))
                    {
                        $coursecode=$_POST['delete'];
                        echo $coursecode;
                        echo "<script>window.location = 'editsubject.php?coursecode=".$coursecode."';</script>";
                    }
                ?>
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
   </body>
</html>