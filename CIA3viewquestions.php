<?php include('header.php');include("config.php");?>
      <!-- main content start-->
      <div id="page-wrapper">
         <div class="main-page">
            <h2 class="title1">CIA 3 Questions</h2>
            <form method = "post">
            <div class="form-group">
               <div class='row'>
               <label for="Coursecode" class="col-sm-2 control-label">Course Name</label>
									<div class="col-sm-7"><select name="coursecode"  class="form-control1" id="getcc" onclick="selectedCourseCode()" >
                              <option disabled>Select a course</option>
                                 <?php
                                     $staffid=$_SESSION['staffid'];      
                                                if ($mysqli->connect_errno) {
                                                      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                                                }
                                                if($_POST['coursecode']=="")
                                                {
                                                   $sql="SELECT coursename,coursecode from classmapping where staffid='".$staffid."'";
                                                   $result=$mysqli->query($sql);
                                                   $counter=mysqli_num_rows($result);
                                                   for($i=0;$i<$counter;$i++)
                                                   {
                                                   $row=$result->fetch_assoc();
                                                   echo "<option value='".$row['coursecode']."'>".$row['coursename']."</option>";
                                                   }
                                                }
                                                else{
                                                   $var=$_POST['coursecode'];
                                                   $sql="SELECT coursename,coursecode from classmapping where staffid='".$staffid."' and coursecode='".$var."'";
                                                   $result=$mysqli->query($sql);
                                                   $row=$result->fetch_assoc();  
                                                   echo "<option value='".$row['coursecode']."'>".$row['coursename']."</option>";
                                                   $sql="SELECT coursename,coursecode from classmapping where staffid='".$staffid."'";
                                                   $result=$mysqli->query($sql);
                                                   $counter=mysqli_num_rows($result);
                                                   for($i=0;$i<$counter;$i++)
                                                   {
                                                      $row=$result->fetch_assoc();
                                                      if($row['coursecode']!=$var)
                                                      echo "<option value='".$row['coursecode']."'>".$row['coursename']."</option>";
                                                   }
                                                }
                                                
                                 ?>
										</select>
                              
               </div>
               <button type = 'submit' class ='btn btn-danger' >View</button>
                              </div>
                              
                              <div class="form-group" id="displayhide">
                        <div class = "row">
                           <label for="Course Outcome No" class="col-sm-2 control-label">Group A/B</label> 
                           <label class="radio-inline">
                           <input type="radio" name="group" value='A'>Group A
                           </label>
                           <label class="radio-inline">
                           <input type="radio" name="group" >Group B
                           </label> 
                           
                        </div>
                     </div>
                           
                        </div>
                        
                                 </form>
            <form method="post" >
            
            <table class="table">

                <thead>
                    <tr>
                        <th>Q No</th>
                        <th>Question</th>
                        <th>Course Code</th>
                        <th>Course Outcome Code</th>
                        <th>Weightage</th>
                        <?php 
                           $sql="SELECT * FROM courseadmin where staffid='".$_SESSION['staffid']."'";
                           $result=$mysqli->query($sql);
                           $ca=mysqli_num_rows($result);
                           if($ca>0)
                           {
                        ?>
                        <th>Action</th>
                           <?php }?>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        if(isset($_POST['coursecode']))
                        {
                           $var=$_POST['coursecode'];
                           if ($mysqli->connect_errno) {
                              echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                           }
                           if($var=="CSE201")
                           {
                              $group=$_POST['group'];
                              $sql="SELECT * FROM `cia3questions` where coursecode='".$var."' and groupforfirstyear='$group' ORDER BY CAST(qno AS UNSIGNED)";
                           }
                           else
                           {
                              $sql="SELECT * FROM `cia3questions` where coursecode='".$var."' ORDER BY CAST(qno AS UNSIGNED)";
                           }
                           $result= $mysqli->query($sql);
                           $counter=mysqli_num_rows($result);
                           if($counter > 0)
                           {
                              for($i = 0; $i < $counter; $i++){
                                 $row = $result -> fetch_assoc();
                                       echo" <tr>";
                                       echo "      <td>".$row['qno']."</td>";
                                       echo "      <td>".$row['qname']."</td>";
                                       echo "      <td>".$row['coursecode']."</td>";
                                       echo "      <td>".$row['courseoutcomecode']."</td>";
                                       echo "      <td>".$row['weightage']."</td>";
                                       if($ca>0)
                                          echo " <td><button type = 'submit' class ='btn btn-danger' name='delqno' value='".$row['qno']."' >Delete</button></td>";
                                       echo"</tr>";
                              }
                           }
                        }
                    ?>
                </tbody>
            </table>
            <?php 
               if($ca>0)
               {
            ?>
            <div class = "row">
                        <div class = "col-md-12 text-center">
                          
                             
                                 <button type = "submit" class = "btn btn-danger" name="createtable" >Submit</button>
                              
                             
                              <input type="hidden" name="coursecode" value="<?php echo $_POST['coursecode']?>">
                              <button type = "submit" class = "btn btn-danger" name="delete" >DELETE ALL</button>
                              </form>
                        </div>
               <?php }?>
                     </div>
                        
         </div>
      </div>
      <?php
         if(isset($_POST['createtable']))
         {
                  if ($mysqli->connect_errno) {
                     echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
               }
               function merge($left, $right)
               {
                  $result=array();
                  $leftIndex=0;
                  $rightIndex=0;
                  $leftIndexMax=count($left);
                  $rightIndexMax=count($right);
                  while($leftIndex<$leftIndexMax && $rightIndex<$rightIndexMax)
                  {
                        if(strnatcmp ( $left[$leftIndex] , $right[$rightIndex] )<0)
                        {
                           $result[]=$left[$leftIndex];
                           $leftIndex++;
                        }
                        else if(strnatcmp ( $left[$leftIndex] , $right[$rightIndex] )>0)
                        {
                           $result[]=$right[$rightIndex];
                           $rightIndex++;
                        }
                        else{
                           $result[]=$left[$leftIndex];
                           $leftIndex++;
                           $result[]=$right[$rightIndex];
                           $rightIndex++;
                        }

                  }
                  while($leftIndex<$leftIndexMax)
                  {
                        $result[]=$left[$leftIndex];
                        $leftIndex++;
                  }
                  while($rightIndex<$rightIndexMax)
                  {
                        $result[]=$right[$rightIndex];
                        $rightIndex++;
                  }
                  $resultFinal=array_values(array_unique($result));
                  return $resultFinal;
               }
               $query = "SELECT DISTINCT(qno) from cia3questions ORDER BY CAST(qno AS UNSIGNED)";
               $result = $mysqli->query($query);
               $i = 0;
               while ($i < mysqli_num_rows($result))
               {
                  $row=$result->fetch_assoc(); 
                  $myarray[]="q".$row['qno'];
                     $i = $i + 1;
               }                              
               $query = "SELECT *  from cia3";
               $result = $mysqli->query($query);
               $j = 0;
               while ($j < mysqli_num_fields($result))
               {
                  $fld = mysqli_fetch_field($result);
                  $myarray1[]=$fld->name;
                     $j = $j + 1;
               }
               array_splice($myarray1, 0, 7);
               $resultFinal=merge($myarray1, $myarray);
               $sqlq="Create table cia3temp(
                  Reg_no INT(15),
                  student_name varchar(50),
                  coursecode varchar(15),
                  sem int(2),
                  section varchar(50),
                  dept varchar(30),
                  staffid varchar(10),";
               for($x=0;$x<count($resultFinal);$x++)
               {
                  if($x!=count($resultFinal)-1)
                  {
                        $sqlq.=$resultFinal[$x]." DECIMAL(5,2) DEFAULT 0 NOT NULL, ";
                  }
                  else
                  {
                        $sqlq.=$resultFinal[$x]." DECIMAL(5,2) DEFAULT 0 NOT NULL) ";
                  }
               }
               $result=$mysqli->query("SELECT 1 FROM cia3 LIMIT 1");
               if($result)
               {
                  $mysqli->query($sqlq);
                  $col="Reg_no,student_name,coursecode,sem,section,dept,staffid,";
                  for($x=0;$x<count($myarray1);$x++)
                  {
                        $col.=$myarray1[$x].",";
                  }
                  $col=substr($col,0,-1);
                  $sql="INSERT INTO cia3temp (".$col.") SELECT ".$col." FROM cia3";
                  $res=$mysqli->query($sql);
                  if($res)
                  {
                        $mysqli->query("DROP TABLE IF EXISTS cia3");
                        $mysqli->query("RENAME TABLE cia3temp to cia3");
                        $csv="Reg_no,Student_name,";
                        for($i=0;$i<7;$i++)
                           array_pop($resultFinal);
                        for($i=0;$i<count($resultFinal);$i++)
                        {
                           if($i<count($resultFinal)-1)
                           $csv.=$resultFinal[$i].",";
                           else
                           $csv.=$resultFinal[$i]."\n";
                        }   
                        $csv_handler = fopen ('files\cia3markentry.csv','w');
                           fwrite ($csv_handler,$csv);
                           fclose ($csv_handler);
                  }

               }
         }
         if(isset($_POST['delqno']))
         {
            $coursecode=$_POST['coursecode'];
            $qno=$_POST['delqno'];
            $mysqli->query("DELETE FROM cia3questions where coursecode='$coursecode' AND qno='$qno'");
            
           
         }
         if(isset($_POST['delete']))
         {
            $coursecode=$_POST['coursecode'];
            $mysqli->query("DELETE FROM cia3questions where coursecode='$coursecode'");
            echo "<script > window.location('cia3viewquestions.php');</script>";
         }
      ?><!-- Classie --><!-- for toggle left push menu script -->
     <script src="js/classie.js"></script>
     <script>
            
            function selectedCourseCode() {
            var x = document.getElementById("displayhide");
            var e = document.getElementById("getcc");
            var strUser = e.options[e.selectedIndex].value;
            
            if (strUser=='CSE201') {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
            }
        </script>
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