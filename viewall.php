<?php 
    include('header.php');
    include('config.php');
    $coursename=$_POST['coursename'];
    $dept=$_POST['dept'];
    ?>

<div id="page-wrapper">
    <div class="main-page">
    <form method="post">
        <table class="table">
            <h2>Target Levels</h2>
            <thead>
                <tr><th>Assesment Components</th>
                <th>Target Level(%)</th>
                <th>L1</th>
                <th>L2</th>
                <th>L3</th></tr>
            </thead>
            <tbody>
                <?php
                    $sql="SELECT  `assesmentcomponents`,`target_level`,`L1`,`L2`,`L3` FROM `assesmentweightagecomponents` WHERE coursecode = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept')";
                    $result=$mysqli->query($sql);
                    for($i=0;$i<mysqli_num_rows($result);$i++)
                    {
                        $row=$result->fetch_assoc();
                        echo "<tr><td>".$row['assesmentcomponents']."</td>";
                        echo "<td>".$row['target_level']."</td>";
                        echo "<td>".$row['L1']."</td>";
                        echo "<td>".$row['L2']."</td>";
                        echo "<td>".$row['L3']."</td></tr>";
                    }
                ?>       
            </tbody>
            
            <input type="hidden" name="coursename" value="<?php echo $coursename; ?>">
            <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_POST['dept'];?>" >
           
            </table>
            <div class = "col-md-12 text-center">
                <button type = "submit" class = "btn btn-danger" name="levelentry">Delete</button>
            </div>
            </form>
            <form method="post">
        <table class="table">
            <h2>CO HCL Mapping</h2>
                
                    <thead>
                        <tr>
                        <th>Course Outcome Code</th>
                        <th>Course Outcome</th>
                        <th>Hightest Cognitive Level</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql="SELECT  `courseoutcomecode`,`courseoutcome`,`highcoglevel` FROM cohclmapping WHERE coursecode  = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept')";
                        $result=$mysqli->query($sql);
                        for($i=0;$i<mysqli_num_rows($result);$i++)
                        {
                            $row=$result->fetch_assoc();
                            echo "<tr><td>".$row['courseoutcomecode']."</td>";
                            echo "<td>".$row['courseoutcome']."</td>";
                            echo "<td>".$row['highcoglevel']."</td></tr>";
                        }
                    ?>       
                    </tbody>
                    <input type="hidden" name="coursename" value="<?php echo $coursename; ?>">
                    <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_POST['dept'];?>" >
                    
                
        </table>
        <div class = "col-md-12 text-center">
                <button type = "submit" class = "btn btn-danger" name="cohcl">Delete</button>
            </div>
        </form>
        <table class="table">
        <form method="post">
            <h2>PO Mapping</h2>
            <thead>
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
            </thead>
            <tbody>
            <?php
                        $sql="SELECT  `courseoutcomecode`,`hcl`,`PO1`,`PO2`,`PO3`,`PO4`,`PO5`,`PO6`,`PO7`,`PO8`,`PSO1`,`PSO2` FROM `programmmeoutcomemapping` WHERE coursecode  = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept')";
                        $result=$mysqli->query($sql);
                        for($i=0;$i<mysqli_num_rows($result);$i++)
                        {
                            $row=$result->fetch_assoc();
                            echo "<tr><td>".$row['courseoutcomecode']."</td>";
                            echo "<td>".$row['hcl']."</td>";
                            echo "<td>".$row['PO1']."</td>";
                            echo "<td>".$row['PO2']."</td>";
                            echo "<td>".$row['PO3']."</td>";
                            echo "<td>".$row['PO4']."</td>";
                            echo "<td>".$row['PO5']."</td>";
                            echo "<td>".$row['PO6']."</td>";
                            echo "<td>".$row['PO7']."</td>";
                            echo "<td>".$row['PO8']."</td>";
                            echo "<td>".$row['PSO1']."</td>";
                            echo "<td>".$row['PSO2']."</td>";
                            echo "</tr>";
                        }
                    ?>        
            </tbody>
            <input type="hidden" name="coursename" value="<?php echo $coursename; ?>">
            <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_POST['dept'];?>" >
           
        </table>
        <div class = "col-md-12 text-center">
                <button type = "submit" class = "btn btn-danger" name="pomapping">Delete</button>
            </div>
        </form>
        <form method="post">
        <h2>CO Evaluation Weightage</h2>
        <table class="table">
        <thead>
                    <tr>
                        <th>Exam</th>
                        <th>CO1</th>
                        <th>CO2</th>
                        <th>CO3</th>
                        <th>CO4</th>
                        <th>CO5</th>
                        <th>CO6</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                            $sql="SELECT * FROM `coevaluationweightage` WHERE coursecode = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept') ";
                            $result=$mysqli->query($sql);
                           
                            for($i=0;$i<mysqli_num_rows($result);$i++)
                            {
                                $row=$result->fetch_assoc();
                                echo "<tr><td>".$row['assesment_components']."</td><td>".$row['CO1']."</td><td>".$row['CO2']."</td><td>".$row['CO3']."</td><td>".$row['CO4']."</td><td>".$row['CO5']."</td><td>".$row['CO6']."</td></tr>";
                            }
                            ?>    
                </tbody>
                <input type="hidden" name="coursename" value="<?php echo $coursename; ?>">
                <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_POST['dept'];?>" >
           
           </table>
           <div class = "col-md-12 text-center">
                   <button type = "submit" class = "btn btn-danger" name="cowtge">Delete</button>
               </div>
           </form>
    </div>
</div>
<?php
    if(isset($_POST['levelentry']))
    {
        $dept=$_POST['dept'];
        $mysqli->query("DELETE FROM `assesmentweightagecomponents` WHERE coursecode  = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept')");
        $mysqli->query("DELETE FROM `examcomponents` WHERE coursecode  = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept')");
        echo "<script>alert('Target Lavel Deleted!!');</script>";
        
    }
?>
<?php
    if(isset($_POST['cohcl']))
    {
        $dept=$_POST['dept'];
        $mysqli->query("DELETE FROM cohclmapping WHERE coursecode  = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept')");
        echo "<script>alert('Courseoutcomes Deleted!!!');</script>";
    }
?>
<?php
    if(isset($_POST['pomapping']))
    {
        $dept=$_POST['dept'];
        $mysqli->query("DELETE FROM `programmmeoutcomemapping` WHERE coursecode  = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept')");
        echo "<script>alert('Program Outcomes Deleted');</script>";
    }
?>
<?php
    if(isset($_POST['cowtge']))
    {
        $dept=$_POST['dept'];
        $mysqli->query("DELETE FROM `coevaluationweightage` WHERE coursecode  = (SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept')");
        echo "<script>alert('Program Outcomes Deleted');</script>";
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