

<?php 
    include('header.php');
    include("config.php");
    
    ?>
<!-- main-page -->
<div id="page-wrapper">
<div class="main-page">
<form method="post" action="" >
    <div class="form-group">
    <div class="row">
        <label class="col-sm-2 control-label">Course Code</label>
        <div class="col-sm-8">
            <input type="text" class="form-control1" name="coursecode" value= "<?php echo filter_input(INPUT_GET,'coursecode')?>">
        </div>
    </div>
    <div class="form-group">
    <div class="row">
        <label class="col-sm-2 control-label">UNIT</label>
        <div class="col-sm-8">
            <input type="text" class="form-control1" name="unitno" value= "<?php echo filter_input(INPUT_GET,'unit')?>">
        </div>
    </div>
    <div class="form-group">
    <div class="row">
        <label class="col-sm-2 control-label">Unit Name</label>
        <div class="col-sm-8">
            <input type="text" class="form-control1" placeholder="UNIT NAME" name= "unit_name" required="">
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <label class="col-sm-2 control-label">NO of hours</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1" name= "Hours" value="<?php echo filter_input(INPUT_GET,'hours') ?>">
            </div>
        </div>
        <div class="tables">
            <table class="table">
                <tr>
                    <?php
                        if ($mysqli->connect_errno) {
                              echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                        }  
                        ?>
                    <th>Sno</th>
                    <th>Topic</th>
                    <th>Proposed Date</th>
                    <th>Pertaining CO</th>
                    <th>Highest Cognitive Level</th>
                    <th>Mode Of Delivery</th>
                    <th>Delivery Resources</th>
                </tr>
                <?php
                    $ctr=filter_input(INPUT_GET,'hours');
                    for($i=0;$i<$ctr;$i++)
                    {   
                        $c=$i+1;
                        echo "<tr>";
                        echo "<td ><input type='text' size=1 name = 'sno".$i."' value='".$c."'></td>";
                        echo "<td><input type='text' size=15 name = 'topic".$i."' required=''></td>";
                        echo "<td ><input type='text' size=10 name = 'proposed_date".$i."' placeholder='YYYY/MM/DD' required=''></td>";
                        echo "<td><select name='pertaining_co".$i."' ><option value='CO1'>CO1</option>";
                        echo "<option value='CO2'>CO2</option><option value='CO3'>CO3</option><option value='CO4'>CO4</option><option value='CO5'>CO5</option><option value='CO6'>CO6</option>";
                        echo "<select></td>";
                       
                        echo "<td><select name='hcl".$i."' >";
                        echo "<option value='K1'>K1</option><option value='K2'>K2</option><option value='K3'>K3</option><option value='K4'>K4</option><option value='K5'>K5</option><option value='K6'>K6</option>";
                        echo "<select></td>";  
                        echo "<td><select name='mod".$i."' >";
                        $sql="SELECT `no` from modeofdelivery";
                        $result=$mysqli->query($sql);
                        for($j=0;$j<mysqli_num_rows($result);$j++)
                        {
                            $row=$result->fetch_assoc();
                            echo "<option value='".$row['no']."'>".$row['no']."</option>";
                        }
                        echo "<select></td>";
                        echo "<td><select name='delivery_resources".$i."' >";
                        echo "<option value='T1'>T1</option><option value='T2'>T2</option><option value='T3'>T3</option><option value='R1'>R1</option><option value='R2'>R2</option><option value='R3'>R3</option>";
                        echo "<select></td>";
                       
                        echo "</tr>";
                    }
                    ?>
            </table>
        </div>
        <input type="hidden" class="form-control1" name= "sem" value="<?php echo $_GET['sem']?>">
                            <input type="hidden" class="form-control1" name= "section" value="<?php echo $_GET['section']?>">
                            
                            <input type="hidden" class="form-control1" name= "Academicyear" value="<?php echo $_GET['Academicyear']?>">
                            <input type="hidden" class="form-control1" name= "regulation" value="<?php echo $_GET['regulation']?>">
        <div class="form-group">
            <div class="row">
                <label class="col-sm-2 control-label">Learning outcome</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="5" name="learning_outcomes"></textarea>
                </div>
            </div>
            <input type="submit" class="btn red" name="Enter">
</form>
</div>
</div>
<!-- /.main-page -->
<?php
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    if(isset($_POST['Enter']))
    {
        $section=$_POST['section'];
        $sem=$_POST['sem'];
        $ay=$_POST['Academicyear'];
        $reg=$_POST['regulation'];
        $coursecode=filter_input(INPUT_POST,'coursecode');
        $hours=filter_input(INPUT_POST,'Hours');
        $unitname=filter_input(INPUT_POST,'unit_name');
        $unit=filter_input(INPUT_POST,'unitno');
        $learning_outcomes=filter_input(INPUT_POST,'learning_outcomes');
        for($i=0;$i<$hours;$i++)
        {
            $sno=filter_input(INPUT_POST,'sno'.$i);
            $topic=filter_input(INPUT_POST,'topic'.$i);
            $proposed_date=filter_input(INPUT_POST,'proposed_date'.$i);
            if($proposed_date=="" OR $topic=="")
            {
                echo "<script>alert('Enter All the Details');window.location='coursedeliveryplan.php?coursecode=".$coursecode."&unit=".$unit."&hours=".$hours."'</script>";
            }
            $pertaining_co=filter_input(INPUT_POST,'pertaining_co'.$i);
            $hcl=filter_input(INPUT_POST,'hcl'.$i);
            $mod=filter_input(INPUT_POST,'mod'.$i);
            $delivery_resources=filter_input(INPUT_POST,'delivery_resources'.$i);
            $sql="INSERT INTO `coursedeliveryplan`(`staffid`,`section`,`sem`,`coursecode`, `unit`, `unitname`, `sno`, `proposed_period`, `topic`, `pertaining_co`, `hcl`, `md`, `delivery_resources`, `learning_outcomes`) VALUES ('$staffid','$section','$sem','$coursecode','$unit','$unitname','$sno','$proposed_date','$topic','$pertaining_co','$hcl','$mod','$delivery_resources','$learning_outcomes')";
            $mysqli->query($sql);
            
        }
        echo "<script>alert('Success entry!!');window.location.href='getsyllabus.php?coursecode=".urlencode($coursecode)."&sem=".urlencode($sem)."&section=".urlencode($section)."&Academicyear=".urlencode($ay)."&regulation=".urlencode($reg)."';</script>";
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

