
<?php 
    require("header.php");include("config.php");
?>
<div id="page-wrapper">
        <div class="main-page">
            <div class="tables">
                <h2 class="title1">View Staff</h2>
                <div class="panel-body widget-shadow">
                    <h4></h4>
                    <form method = "post" action="#">
                        <div style="overflow-x:auto;"> 
                            <table class="table">
                                <thead>
                                    <th>Staff ID</th>
                                    <th>Staff Name</th>
                                    <th>Designation</th>
                                    <th>School</th> 
                                    <th>Email</th>
                                    <th>Department</th>
                                </thead>
                                <tbody>
                                    <?php
                                        
                                        $sql="SELECT * FROM `staffmaster` ORDER BY `staffid` ASC ";
                                        $result=$mysqli->query($sql);
                                        for($i=0;$i<mysqli_num_rows($result);$i++)
                                        {
                                            $row=$result->fetch_assoc();
                                            echo "<tr>";
                                            echo "<td>".$row['staffid']."</td>";
                                            echo "<td>".$row['name']."</td>";
                                            echo "<td>".$row['designation']."</td>";
                                            echo "<td>".$row['school']."</td>";
                                            echo "<td>".$row['email']."</td>";
                                            echo "<td>".$row['department']."</td>";
                                            
                                            echo "<td><button type = 'submit' class = 'btn btn-danger' name='delete' value='".$row['staffid']."'>Delete</button></td>";
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
                        $staffid=$_POST['delete'];
                        $sql="DELETE from staffmaster where staffid='".$staffid."'";
                        $mysqli->query($sql);
                        
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