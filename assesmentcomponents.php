<?php
    include('header.php');
    include("config.php");
    $assignment=filter_input(INPUT_GET,'assignments');
    $coursename=filter_input(INPUT_GET,'coursename');
    $staffid=$_SESSION['staffid'];
    $dept=$_GET['dept'];
    $sql="SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept'";
    $result=$mysqli->query($sql);
    for($j=0;$j<mysqli_num_rows($result);$j++)
    {
        $row=$result->fetch_assoc();
        $coursecode=$row['coursecode'];
        $sql1="SELECT DISTINCT exams where examcomponents like 'Assignment%' AND coursecode='".$coursecode."'";
        $res=$mysqli->query($sql1);
        if(!$res)
        {
          for($i=1;$i<=$assignment;$i++)
            $sql="INSERT INTO examcomponents VALUES ('$coursecode','Assignment".$i."')";
            $mysqli->query($sql);
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
                    <input type="text" class="form-control1" name="coursename" value="<?php echo $coursename ?>" >
                </div>
            </div>
            <div class="row">
                <label class="col-sm-6 control-label">NO Of Assignments</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control1" name="noass" value="<?php echo $assignment ?>" >
                    <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Assesment Components</th>
                        <th>Target Level(%)</th>
                        <th>LEVEL 1(%)</th>
                        <th>LEVEL 2(%)</th>
                        <th>LEVEL 3(%)
                        <th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for($i=1;$i<=$assignment;$i++)
                        {
                            echo "<tr>";
                            echo "<td>Assignment ".$i."</td>";
                            echo "<td> <input type='text' class ='form-control1' name=target_level".$i." ></td>";
                            echo " <td><input type='text' class ='form-control1' name=level_1".$i." ></td>";
                            echo " <td><input type='text' class ='form-control1' name=level_2".$i." ></td>";
                            echo " <td><input type='text' class ='form-control1' name=level_3".$i." ></td>";
                            echo "</tr>";
                        }
                        ?>
                </tbody>
            </table>
            <div class="col-sm-2">
                <input type="submit" class="form-control1" name="submit" >
            </div>
    </form>
    </div>
</div>
<?php
    if(isset($_POST['submit']))
    {
      $assignments=filter_input(INPUT_POST,'noass');
      $coursename=filter_input(INPUT_POST,'coursename');
      $staffid=$_SESSION['staffid'];
      $dept=$_POST['dept'];
        for($i=1;$i<=$assignments;$i++)
        {
            $assignment="Assignment".$i;
            $target_level=filter_input(INPUT_POST,'target_level'.$i);
            $level_1=filter_input(INPUT_POST,'level_1'.$i);
            $level_2=filter_input(INPUT_POST,'level_2'.$i);
            $level_3=filter_input(INPUT_POST,'level_3'.$i);
            $sql="SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept'";
            $result=$mysqli->query($sql);
            for($j=0;$j<mysqli_num_rows($result);$j++)
            {
                $row=$result->fetch_assoc();
                $coursecode=$row['coursecode'];
                $sql1="INSERT INTO assesmentweightagecomponents(`coursecode`, `assesmentcomponents`, `target_level`, `L1`, `L2`, `L3`) VALUES ('$coursecode','$assignment','$target_level','$level_1','$level_2','$level_3')";
                $mysqli->query($sql1);
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
</body>
</html>
