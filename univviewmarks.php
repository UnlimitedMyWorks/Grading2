<?php include('header.php');include("config.php");?>
      <!-- main page -->
      <div id="page-wrapper">
      <div class="main-page">
      <div class="tables">
         <h2 class="title1">University Grade</h2>
         <div class="panel-body widget-shadow">
           <div style="overflow-x:auto;"> 
            <table class="table">
               <thead>
                  <tr>
                     <th>S.No</th>
                     <th>Register Number</th>
                     <th>Name</th>
                     
                     <th>Grade</th>
                     <?php
                           $coursecode=filter_input( INPUT_POST ,'coursecode');
                           $dept=$_GET['department'];    
                     ?>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     if ($mysqli->connect_errno) {
                        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                     }
                     $sem=$_GET['sem'];
                     $coursecode=$_GET['coursecode'];
                     $dept=$_GET['department'];
                     $sql="SELECT `Reg_no`, `student_name`,`grade` FROM `university` where coursecode='".$coursecode."' and sem=".$sem." AND dept='".$dept."'";
                     $result = $mysqli ->query($sql); 
                     for($i=0;$i<mysqli_num_rows($result);$i++)
                     {
                        $row=$result->fetch_assoc();
                        echo "<tr><td>".($i+1)."</td><td>".$row['Reg_no']."</td><td>".$row['student_name']."</td><td>".$row['grade']."</td></tr>";
                     } 
                     ?>
               </tbody>
            </table>
            </div>
         
         
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
   </body>
</html>
