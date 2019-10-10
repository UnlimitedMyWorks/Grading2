<?php include('header.php');include("config.php");
   $staffid=$_SESSION['staffid'];
   $sem=$_POST['sem'];
   $sec=$_POST['section'];
   $coursecode=$_POST['coursecode'];
   $dept=$_POST['department'];
   $sql="SELECT * FROM classmapping where staffid='$staffid' and sem='$sem' and section='$sec' and department='$dept' and coursecode='$coursecode'";
   echo $sql;
   $result=$mysqli->query($sql);
   if(mysqli_num_rows($result)==0)
   {
       echo "<script>alert('Select Proper Class!!');window.location.href='CIA3viewsub.php';  </script>";
   }
?>
      <!-- main page -->
      <div id="page-wrapper">
      <div class="main-page">
      <div class="tables">
         <h2 class="title1">CIA III</h2>
         <div class="panel-body widget-shadow">
           <div style="overflow-x:auto;"> 
            <table class="table">
               <thead>
                  <tr>
                     <th>Reg_no</th>
                     <th>Name</th>
                     
                     <?php
                           $coursecode=filter_input( INPUT_POST ,'coursecode');
                           
                           
                          
                           $search="Reg_no,student_name,";
                           if ($mysqli->connect_errno) {
                               echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                           }
                           if($coursecode=="CSE201")
                           {
                              $group=$_POST['group'];
                              $sql="SELECT qno,courseoutcomecode FROM `cia3questions` WHERE coursecode='".$coursecode."' and groupforfirstyear='$group' ORDER BY CAST(qno AS UNSIGNED)";
                           }
                           else
                           {
                              $sql="SELECT qno,courseoutcomecode FROM `cia3questions` WHERE coursecode='".$coursecode."' ORDER BY CAST(qno AS UNSIGNED)";
                           }
                           $result = $mysqli ->query($sql);
                           $counter = mysqli_num_rows($result);
                           for($i=0;$i<$counter;$i++)
                           {  
                              $row=$result->fetch_assoc();
                              echo "<th>Q".$row['qno']."(".$row['courseoutcomecode'].")</th>";
                              $search.="q".$row['qno'].",";
                           }
                           $search=substr($search,0,-1);
                           
                           $sem=$_POST['sem'];
                           $section=$_POST['section'];
                           $dept=$_POST['department'];
                          
                     ?>
                  </tr>
               </thead>
               <tbody>
                  <?php   
                        
                        
                       
                        
                        $staffid=$_SESSION['staffid'];
                        if ($mysqli->connect_errno) {
                           echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                        }
                        $sql="SELECT $search FROM `cia3` where coursecode='".$coursecode."' AND sem=".$sem." AND dept='".$dept."' AND section='".$section."' AND staffid='$staffid'";
                        
                        $result = $mysqli ->query($sql);
                        display_data($result);
                     ?>
               </tbody>
            </table>
            </div>
         
         
         </div>
      </div>
      <?php
         function display_data($data) {
            $output="";
            foreach($data as $key => $var) {
                 
                  
                    $output .= '<tr>';
                    foreach($var as $col => $val) {
                       
                        if($val!=NULL){
                           $output .= '<td>' . $val . '</td>';   
                        }
                     
                    }
                    $output .= '</tr>';
                  
                  
            }
           
            echo $output;
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
