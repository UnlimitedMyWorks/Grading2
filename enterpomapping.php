<?php 
    include('header.php');
    include("config.php");
    $coursename=$_GET['coursename'];
    $staffid=$_SESSION['staffid'];
    $dept=$_GET['dept'];
    ?>
        <!-- main-page -->
        <div id="page-wrapper">
            <div class="main-page">
                <form method="POST" >
                
                <div class="tables">
                <div class="form-group">
                    <div class="row">
                    <label class="col-sm-2 control-label">Course Name</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control1" placeholder="" name= "coursename" value='<?php echo $coursename?>'>
                    <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
                    </div>
                    <input type="hidden" class="form-control1" placeholder="" name= "dept" value='<?php echo $dept?>'>
                </div>
                    <table class="table">
                        
                            <tr>
                               
                                <th>Course outcome code</th>
                                <th>Level of CO</th>
                                <th>PO1</th>
                                <th>PO2</th>
                                <th>PO3</th>
                                <th>PO4</th>
                                <th>PO5</th>
                                <th>PO6</th>
                                <th>PO7</th>
                                <th>PO8</th>
                                <th>PSO1</th>
                                <th>PSO2</th>
                            </tr>
                        
                            <?php
                                $coursecode=filter_input(INPUT_GET,'coursecode');
                                $sql="SELECT DISTINCT courseoutcomecode,highcoglevel from cohclmapping where coursecode = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept') ORDER BY `courseoutcomecode` ASC";
                                $result=$mysqli->query($sql);
                                for($i=0;$i<mysqli_num_rows($result);$i++)
                                {   
                                    $row=$result->fetch_assoc();
                                    echo "<tr>";
                                    echo "<td >".$row['courseoutcomecode']."</td>";
                                    echo "<td>".$row['highcoglevel']."</td>";
                                    echo "<td><input type='text' size='2'  name = 'add_".$row['courseoutcomecode']."_PO1' required=''></td>";
                                    echo "<td><input type='text' size='2'  name = 'add_".$row['courseoutcomecode']."_PO2' required=''></td>"; 
                                    echo "<td><input type='text' size='2'  name = 'add_".$row['courseoutcomecode']."_PO3' required=''></td>"; 
                                    echo "<td><input type='text' size='2'  name = 'add_".$row['courseoutcomecode']."_PO4' required=''></td>"; 
                                    echo "<td><input type='text' size='2'  name = 'add_".$row['courseoutcomecode']."_PO5' required=''></td>"; 
                                    echo "<td><input type='text' size='2'  name = 'add_".$row['courseoutcomecode']."_PO6' required=''></td>";
                                    echo "<td><input type='text' size='2'  name = 'add_".$row['courseoutcomecode']."_PO7' required=''></td>";
                                    echo "<td><input type='text' size='2'  name = 'add_".$row['courseoutcomecode']."_PO8' required=''></td>"; 
                                    echo "<td><input type='text' size='2'  name = 'add_".$row['courseoutcomecode']."_PSO1' required=''></td>"; 
                                    echo "<td><input type='text' size='2'  name = 'add_".$row['courseoutcomecode']."_PSO2' required=''></td>";                               
                                    echo "</tr>";
                                }
                            ?>
                        
                    </table>
                </div>
                
                <input type="submit" class="btn red" name="Enter">
                </form>
            </div>
        </div>

        <!-- /.main-page -->
        <?php
            if(isset($_POST['Enter']))
            {
                if ($mysqli->connect_errno) {
                    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }
                $dept=$_POST['dept'];
                $sql="SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept'";
                $result=$mysqli->query($sql);
                for($i=0;$i<mysqli_num_rows($result);$i++)
                {
                    $row=$result->fetch_assoc();
                    $coursecode=$row['coursecode'];

                    $sql1="SELECT DISTINCT courseoutcomecode,highcoglevel from cohclmapping WHERE coursecode='".$coursecode."'";
                    $result1=$mysqli->query($sql1);
                    
                    for($j=0;$j<mysqli_num_rows($result1);$j++)
                    {   
                        $row1=$result1->fetch_assoc();
                        $cocd=$row1['courseoutcomecode'];
                        $hcl=$row1['highcoglevel'];
                        $po1=$_POST['add_'.$cocd.'_PO1'];
                        $po2=$_POST['add_'.$cocd.'_PO2'];
                        $po3=$_POST['add_'.$cocd.'_PO3'];
                        $po4=$_POST['add_'.$cocd.'_PO4'];
                        $po5=$_POST['add_'.$cocd.'_PO5'];
                        $po6=$_POST['add_'.$cocd.'_PO6'];
                        $po7=$_POST['add_'.$cocd.'_PO7'];
                        $po8=$_POST['add_'.$cocd.'_PO8'];
                        $pso1=$_POST['add_'.$cocd.'_PSO1'];
                        $pso2=$_POST['add_'.$cocd.'_PSO2'];
                        
                        $sql2="INSERT INTO programmmeoutcomemapping VALUES('$coursecode','$cocd','$hcl','$po1','$po2','$po3','$po4','$po5','$po6','$po7','$po8','$pso1','$pso2')";
                       
                        $mysqli->query($sql2);

                    }
                }
                echo "<script>alert('Success entry!!');window.location='levelentry.php?coursename=".urlencode($coursename)."&dept=".urldecode($dept)."';</script>";
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