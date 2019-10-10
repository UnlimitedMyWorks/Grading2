<?php 
    include('header.php');
    include("config.php");
    $coursename=$_GET['coursename'];
    $dept=$_GET['dept'];
?>
<!-- main-page -->
<div id="page-wrapper">
    <div class="main-page">
        
        <h2 class="title1">Enter CO and HCL mapping</h2>
        <div class="panel-body widget-shadow">
            <form method="POST">
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-2 control-label">No of Course Outcomes</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control1" name= "noofCOF" value='<?php echo filter_input(INPUT_GET,'noofCO'); ?>'>
                            <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Course Outcome Code</th>
                            <th>Course Outcome </th>
                            <th>Highest Cognitive Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $co=filter_input(INPUT_GET,'noofCO');
                            for($i=1;$i<=$co;$i++)
                            {
                                echo "<tr>";
                                echo "<td><input type='text' size='10' name='CO".$i."' value='CO".$i."' required=''></td>";
                                echo "<td><input type='text' size='50' name='COname".$i."' required=''></td>";
                                echo "<td><select name='hcl".$i."'>";
                                echo "<option value='K1'>K1-Remember</option><option value='K2'>K2-Understand</option><option value='K3'>K3-Apply</option><option value='K4'>K4-Analyse</option><option value='K5'>K5-Evaluate</option><option value='K6'>K6-Create</option>";
                                echo "<select></td>";
                                echo "</tr>"; 
                            }
                            
                            ?>
                    </tbody>
                </table>
                <div class ="form-group">
                    <div class = "row">
                        <div class = "col-md-12 text-center">
                            <button type = "submit" class = "btn btn-danger" name='coursename' value='<?php echo $coursename?>'>Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.main-page -->
<?php
    if(isset($_POST['coursename']))
    {
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        $staffid=$_SESSION['staffid'];
        $dept=$_POST['dept'];
        $coursename=filter_input(INPUT_POST,'coursename');
        $counter=filter_input(INPUT_POST,'noofCOF');  
        for($i=1;$i<=$counter;$i++)
        {
            $co=filter_input(INPUT_POST,'CO'.$i);
            $coname=filter_input(INPUT_POST,'COname'.$i);
            $hcl=filter_input(INPUT_POST,'hcl'.$i);
            $sql="SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept'";
            $result=$mysqli->query($sql);
            for($j=0;$j<mysqli_num_rows($result);$j++)
            {
                $row=$result->fetch_assoc();
                $coursecode=$row['coursecode'];
                $sql="INSERT INTO cohclmapping VALUES('$coursecode','$co','$coname','$hcl')";
                $mysqli->query($sql);
            }
        }
        echo "<script>alert('Success entry!!');window.location='levelentry.php?coursename=".urlencode($coursename)."&dept=".urldecode($dept)."'; </script>" ;
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
