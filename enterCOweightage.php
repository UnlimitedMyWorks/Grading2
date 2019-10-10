<?php 
    include('header.php');
    include("config.php");
    $coursename=$_GET['coursename'];
    $dept=$_GET['dept'];
    ?>
<!-- main page -->
<div id="page-wrapper">
    <div class="main-page">
        <form method="POST">
            <table class="table">
                <input type="hidden" class="form-control1" name="coursename" value="<?php echo $_GET['coursename'];?>" >
                <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
                <thead>
                    <tr>
                        <th>Exam</th>
                        <?php
                            $sql="SELECT DISTINCT `courseoutcomecode` FROM `cohclmapping` WHERE coursecode = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept') ORDER BY `courseoutcomecode` ASC";
                            $result=$mysqli->query($sql);
                            for($i=0;$i<mysqli_num_rows($result);$i++)
                            {
                                $row=$result->fetch_assoc();
                                echo "<th>".$row['courseoutcomecode']."</th>";
                            }
                            ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql="SELECT DISTINCT assesmentcomponents FROM `assesmentweightagecomponents`,`coursemaster` where assesmentweightagecomponents.coursecode = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept')";
                        
                        $result=$mysqli->query($sql);
                        $counter=mysqli_num_rows($result);
                        for($i=0;$i<$counter;$i++)
                        {
                           
                            $row=$result->fetch_assoc();
                            $sql1="SELECT DISTINCT `courseoutcomecode` FROM `cohclmapping` WHERE coursecode = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept')";
                            $result1=$mysqli->query($sql1);
                            if($row['assesmentcomponents']!='University')
                            {
                                echo "<tr>";
                                echo "<td>".$row['assesmentcomponents']."</td>";
                                for($j=0;$j<mysqli_num_rows($result1);$j++)
                                {
                                    $row1=$result1->fetch_assoc();
                                    echo "<td><input type='text' size='2'  name = 'add_".$row['assesmentcomponents']."_".$row1['courseoutcomecode']."'></td>";
                                }
                                echo "</tr>";
                            }
                            
                            
                        }
                        ?>
            </table>
            <div class ="form-group">
                <div class = "row">
                    <div class = "col-md-12 text-center">
                        <button type = "submit" class = "btn btn-danger" name="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<?php
    if(isset($_POST['submit']))
    {
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        $coursename=$_POST['coursename'];
        $dept=$_POST['dept'];
        $sql="SELECT DISTINCT courseoutcomecode from cohclmapping where coursecode = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept')";
        $intr="INSERT INTO coevaluationweightage(`coursecode`,`assesment_components`,";
        $result=$mysqli->query($sql);
        for($i=0;$i<mysqli_num_rows($result);$i++)
        {
            
            $co=0;
            $flag=0;
            $row=$result->fetch_assoc();
            if($i!=mysqli_num_rows($result)-1)
            {
                $intr.="`".$row['courseoutcomecode']."`,";
            }
            else{
                $intr.="`".$row['courseoutcomecode']."`) VALUES ";
            }
            $str=$intr;
            $sql1="SELECT DISTINCT assesmentcomponents from assesmentweightagecomponents where coursecode = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept')";
            $result1=$mysqli->query($sql1);
            for($j=0;$j<mysqli_num_rows($result1);$j++)
            {
                $row1=$result1->fetch_assoc();
                if($row1['assesmentcomponents']!="University")
                {
                    if( filter_input(INPUT_POST,'add_'.$row1['assesmentcomponents'].'_'.$row['courseoutcomecode'].'')==0)
                    {
                        $co+=0;
                    }    
                    else
                    {
                        $co+=filter_input(INPUT_POST,'add_'.$row1['assesmentcomponents'].'_'.$row['courseoutcomecode'].'');
                        
                    }  
                }  
            }
           
            if($co!=100)
                echo "<script>alert('SUM of CO".($i+1)." column wise should be 100');window.location='enterCOweightage.php?coursename=".urlencode($coursename)."';</script>";
            else
                $flag=1;
        }
        
        $staffid=$_SESSION['staffid'];
        $sql="SELECT Department from courseadmin where staffid='$staffid' and coursename='$coursename'";
        $result=$mysqli->query($sql);
        $row=$result->fetch_assoc();
        $dept=$row['Department'];
        if($flag==1)
        {
            $sql="SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept'";
            $result=$mysqli->query($sql);
            for($i=0;$i<mysqli_num_rows($result);$i++)
            {
                $row=$result->fetch_assoc();

                $coursecode=$row['coursecode'];
                
                $sql1="SELECT DISTINCT assesmentcomponents FROM `assesmentweightagecomponents` where coursecode='".$coursecode."'";
                $result1=$mysqli->query($sql1);
                $counter=mysqli_num_rows($result1);
                for($j=0;$j<$counter;$j++)
                {
                    $row1=$result1->fetch_assoc();
                    $exam=$row1['assesmentcomponents'];
                    if($row1['assesmentcomponents']!="University")
                     {
                        $intr.="('".$coursecode."',";
                        $intr.="'".$exam."',";
                     }  
                    $sql2="SELECT DISTINCT courseoutcomecode from cohclmapping where coursecode='".$coursecode."'";
                   
                    
                    $result2=$mysqli->query($sql2);
                    for($k=0;$k<mysqli_num_rows($result2);$k++)
                    {
                        $row2=$result2->fetch_assoc();
                        if($row1['assesmentcomponents']!="University")
                        {
                            $var=filter_input(INPUT_POST,'add_'.$row1['assesmentcomponents'].'_'.$row2['courseoutcomecode']);
                            
                            if($k!=mysqli_num_rows($result2)-1){
                                $intr.="'".$var."',";
                            }
                            else
                            {
                                $intr.="'".$var."')";
                            }
                        }
                    }
                  
                    
                    $mysqli->query($intr);
                    if($row1['assesmentcomponents']!="University")
                    $intr=$str;
                    
                }
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
