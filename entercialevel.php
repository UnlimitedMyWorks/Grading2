<?php 
    include('header.php');
    include("config.php");
    $coursename=filter_input(INPUT_GET,'coursename');
    $staffid=$_SESSION['staffid'];
    $dept=$_GET['dept'];
    $sql="SELECT * from examcomponents where coursecode =(SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept')";
    echo $sql;
    $res=$mysqli->query($sql);
    if(mysqli_num_rows($res)==0)
    {
        $sql="SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept'";
        $result=$mysqli->query($sql);
        for($i=0;$i<mysqli_num_rows($result);$i++)
        {
            $row=$result->fetch_assoc();
            $coursecode=$row['coursecode'];
            $cname=$coursename;
            $cname=strtolower($cname);
            $pos = strpos($cname, "lab");
            if($pos===false)
            {
                $sql1="INSERT INTO examcomponents VALUES ('$coursecode','CIA1')";
                $sql2="INSERT INTO examcomponents VALUES ('$coursecode','CIA2')";
                $sql3="INSERT INTO examcomponents VALUES ('$coursecode','CIA3')";
                $sql4="INSERT INTO examcomponents VALUES ('$coursecode','University')";
                $mysqli->query($sql1);
                $mysqli->query($sql2);
                $mysqli->query($sql3);
                $mysqli->query($sql4);
            }
            else{
                $sql1="INSERT INTO examcomponents VALUES ('$coursecode','CIA1')";
                $sql2="INSERT INTO examcomponents VALUES ('$coursecode','CIA2')";
                $sql4="INSERT INTO examcomponents VALUES ('$coursecode','University')";
                echo $sql1;
                $mysqli->query($sql1);
                $mysqli->query($sql2);
                $mysqli->query($sql4);
            }
            
        }
    }
    
?>
<!-- main content start-->
<div id="page-wrapper">
<div class="main-page">
    <form method="post">
        <div class="form-group">
            <div class="row">
                <label class="col-sm-6 control-label">Course Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control1" name="coursename" value="<?php echo $_GET['coursename'];?>" >
                    <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Assesment Components</th>
                        <th>Target Level</th>
                        <th>LEVEL 1</th>
                        <th>LEVEL 2</th>
                        <th>LEVEL 3
                        <th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql="SELECT DISTINCT exams from examcomponents where coursecode =(SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept')";
                        $result=$mysqli->query($sql);

                        for($i=0;$i<mysqli_num_rows($result);$i++)
                        {
                            $row=$result->fetch_assoc();
                            if($i!=mysqli_num_rows($result)-1)
                            {
                                echo "<tr>";
                                echo "<td>".$row['exams']."</td>";
                                echo "<td> <input type='text' class ='form-control1' name=target_level_".$row['exams']." required=''></td>";
                                echo "<td><input type='text' class ='form-control1' name=level_1_".$row['exams']." required='' ></td>";
                                echo " <td><input type='text' class ='form-control1' name=level_2_".$row['exams']." required=''></td>";
                                echo " <td><input type='text' class ='form-control1' name=level_3_".$row['exams']." required=''></td>";
                                echo "</tr>";
                            }
                            else
                            {
                                echo "<tr>";
                                echo "<td>University</td>";
                                echo "<td> <input type='text' class ='form-control1' name=target_level_".$row['exams']." required=''></td>";
                                echo " <td><input type='text' class ='form-control1' name=level_1_".$row['exams']." required=''></td>";
                                echo " <td><input type='text' class ='form-control1' name=level_2_".$row['exams']." required=''></td>";
                                echo " <td><input type='text' class ='form-control1' name=level_3_".$row['exams']." required=''></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                </tbody>
            </table>
            <div class="col-sm-2">
                <input type="submit" class="form-control1" name='levelsubmit'>
            </div>
    </form>
    </div>
</div>
<!-- Classie --><!-- for toggle left push menu script -->
<?php
    if(isset($_POST['levelsubmit']))
    {    
        if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        $coursename=$_POST['coursename'];
        $staffid=$_SESSION['staffid'];
        
        $dept=$_POST['dept'];
        $sql="SELECT DISTINCT exams from examcomponents where coursecode = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept')";
        $result=$mysqli->query($sql);
        for($i=0;$i<mysqli_num_rows($result);$i++)
        {
            $row=$result->fetch_assoc();
            $exam=$row['exams'];   
            $target_level=filter_input(INPUT_POST,'target_level_'.$exam);
            $level_1=filter_input(INPUT_POST,'level_1_'.$exam);
            $level_2=filter_input(INPUT_POST,'level_2_'.$exam);
            $level_3=filter_input(INPUT_POST,'level_3_'.$exam);
            $sql1="SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept'";
            $result1=$mysqli->query($sql1);
            for($j=0;$j<mysqli_num_rows($result1);$j++)
            {
                $row=$result1->fetch_assoc();
                $coursecode=$row['coursecode'];
                $sql1="INSERT INTO assesmentweightagecomponents(`coursecode`, `assesmentcomponents`, `target_level`, `L1`, `L2`, `L3`) VALUES ('$coursecode','$exam','$target_level','$level_1','$level_2','$level_3')";
                $mysqli->query($sql1);
            }   
               
        }
        
        echo "<script>alert('Success entry!!');window.location='levelentry.php?coursename=".urlencode($coursename)."&dept=".urldecode($dept)."'</script>";
    }
?>
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
