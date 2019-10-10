<?php include('header.php');include("config.php");
    $staffid=$_SESSION['staffid'];
    $sem=$_GET['sem'];
    $sec=$_GET['section'];
    $cocd=filter_input(INPUT_GET,'coursecode');
    $dept=$_GET['department'];
    $sql="SELECT * FROM classmapping where staffid='$staffid' and sem='$sem' and section='$sec' and department='$dept' and coursecode='$cocd'";
    echo $sql;
    $result=$mysqli->query($sql);
    if(mysqli_num_rows($result)==0)
    {
        echo "<script>alert('Select Proper Class!!');window.location.href='syllabusviewsub.php';  </script>";
    }
?>
<!-- main-page -->
<div id="page-wrapper">
    <div class="main-page">
        <div class="form-group">
            <div class="row">
                <div class="form-group">
                    <label for="Coursecode" class="col-sm-2 control-label">Course Name</label>
                    <div class="col-sm-8">
                        <input type="text" class ="form-control1" name ="coursename" value="<?php
                            $coursecode=filter_input(INPUT_GET,'coursecode');
                            
                            
                            
                            
                            
                            if ($mysqli->connect_errno) {
                                  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                            }
                            $sql="SELECT DISTINCT  coursename from coursemaster where coursecode='".$coursecode."'";
                            $result=$mysqli->query($sql);
                            $counter=mysqli_num_rows($result);
                            for($i=0;$i<$counter;$i++)
                            {
                               $row=$result->fetch_assoc();
                               echo $row['coursename'];
                            }
                            
                            ?>">
                    </div>
                </div>
            </div>
            <div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-2 control-label">Section</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control1" name= "section" value="<?php echo $_GET['section']?>">
                        </div>
                        <label class="col-sm-2 control-label">Semester</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control1" name= "year" value="<?php echo $_GET['sem']?>">
                        </div>
                    </div>
                </div>
                <?php 
                    $cname=$row['coursename'];
                    $cname=strtolower($cname);
                    $pos = strpos($cname, "lab");
                    if($pos===false)
                    {?>
                <div class="row">
                <form class="form-horizontal"  method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
                        <!-- Form Name -->
                        <legend>Upload Coursedelivery plan </legend>
                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton"> <a href="files/coursedeliveryplan.csv" download="coursedeliveryplan.csv">Download csv template</a></label>
                            
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>
                        
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                            </div>
                        </div>
                    </fieldset>
                    <input type="hidden" class="form-control1" name= "sem" value="<?php echo $_GET['sem']?>">
            <input type="hidden" class="form-control1" name= "section" value="<?php echo $_GET['section']?>">
            <input type="hidden" class ="form-control1" name ="coursecode" value="<?php echo filter_input(INPUT_GET,'coursecode');?>">

                </form>
            </div>
             <?php }?>
        
    <div class="form-group">
        <form method="POST" action="generatepdf.php">
        <?php 
                    $cname=$row['coursename'];
                    $cname=strtolower($cname);
                    $pos = strpos($cname, "lab");
                    if($pos===false)
                    {?>
        <div class="row">
            <label class="col-sm-2 control-label" name="Unit 2 "value="Unit1">CIA I</label>
            <label class="col-sm-2 control-label" name="Unit 2 "value="Unit1">FROM</label>
            <div class="col-sm-2">
                <input type="date" class ="form-control1" name="CIAIfrom">
            </div>
            <label class="col-sm-2 control-label" name="Unit 2 "value="Unit1">TO</label>
            <div class="col-sm-2">
                <input type="date" class ="form-control1" name="CIAIto">
            </div>
        </div>
        <div class="row">
            <label class="col-sm-2 control-label" name="Unit 2 "value="Unit1">CIA II</label>
            <label class="col-sm-2 control-label" name="Unit 2 "value="Unit1">FROM</label>
            <div class="col-sm-2">
                <input type="date" class ="form-control1" name="CIAIIfrom">
            </div>
            <label class="col-sm-2 control-label" name="Unit 2 "value="Unit1">TO</label>
            <div class="col-sm-2">
                <input type="date" class ="form-control1" name="CIAIIto">
            </div>
        </div>
        <div class="row">
            <label class="col-sm-2 control-label" name="Unit 2 "value="Unit1">CIA III</label>
            <label class="col-sm-2 control-label" name="Unit 2 "value="Unit1">FROM</label>
            <div class="col-sm-2">
                <input type="date" class ="form-control1" name="CIAIIIfrom">
            </div>
            <label class="col-sm-2 control-label" name="Unit 2 "value="Unit1">TO</label>
            <div class="col-sm-2">
                <input type="date" class ="form-control1" name="CIAIIIto">
            </div>
        </div>
        <?php }?>

            <div class="row">

                <label class="col-sm-8 control-label">GENERATE PDF</label>
                <div class="col-sm-2">
                    <input type="hidden" class ="form-control1" name="coursecode" value="<?php echo filter_input(INPUT_GET,'coursecode') ?>" >
                </div>
                <div class="col-sm-2">
                    <input type="submit" class="form-control1" name="SUBMIT">
                </div>
            </div>
            <input type="hidden" class="form-control1" name= "sem" value="<?php echo $_GET['sem']?>">
            <input type="hidden" class="form-control1" name= "section" value="<?php echo $_GET['section']?>">
            <input type="hidden" class ="form-control1" name ="coursename" value="<?php
                $coursecode=filter_input(INPUT_GET,'coursecode');
                
                
                
                
                
                if ($mysqli->connect_errno) {
                      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }
                $sql="SELECT DISTINCT coursename from coursemaster where coursecode='".$coursecode."'";
                $result=$mysqli->query($sql);
                $counter=mysqli_num_rows($result);
                for($i=0;$i<$counter;$i++)
                {
                   $row=$result->fetch_assoc();
                   echo $row['coursename'];
                }
                
                ?>">
            <input type="hidden" class="form-control1" name= "Academicyear" value="<?php echo $_GET['Academicyear']?>">
            <input type="hidden" class="form-control1" name= "regulation" value="<?php echo $_GET['regulation']?>">
        </form>
    </div>
    </form>
</div>
</div>
</div>
<!-- /.main-page -->
<?php
     if(isset($_POST["Import"])){
        $staffid=$_SESSION['staffid'];
        $sem=$_POST['sem'];
        $sec=$_POST['section'];
        $coursecode=$_POST['coursecode'];
        $filename=$_FILES["file"]["tmp_name"];   
        if($mysqli->query("SELECT * from `coursedeliveryplan` where coursecode='".$coursecode."' and sem='".$sem."' and section='".$sec."'")) 
            $mysqli->query("DELETE from `coursedeliveryplan` where coursecode='".$coursecode."' and sem='".$sem."' and section='".$sec."'");
         if($_FILES["file"]["size"] > 0)
         {
            $file = fopen($filename, "r");
              while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
               {
                 $sql = "INSERT into `coursedeliveryplan` (`staffid`, `section`, `sem`, `coursecode`, `unit`, `unitname`, `sno`, `proposed_period`, `topic`, `pertaining_co`, `hcl`, `md`, `delivery_resources`, `learning_outcomes`)
                       values ('".$staffid."','".$sec."','".$sem."','".$coursecode."','".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."','".$getData[7]."','".$getData[8]."','".$getData[9]."')";
                       $result = $mysqli->query($sql);         
                       
               }
               if(!isset($result))
               {
                    echo "<script type=\"text/javascript\">
                   alert(\"Invalid File:Please Upload CSV File.\");
                   
                   </script>";    
               }
               else {
                   echo "<script type=\"text/javascript\">
                   alert(\"CSV File has been successfully Imported.\");
                   
               </script>";
               }
          
               fclose($file);  
         }
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
    		classie.toggle( showLeftPush, '' );
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
