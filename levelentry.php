<?php include('header.php');include("config.php");  ?>
<!-- main-page -->
<div id="page-wrapper">
<div class="main-page">
<div class="form-group">
<div class="row">
    <div class="form-group">
        <label for="Coursecode" class="col-sm-2 control-label">Course Name</label>
        <div class="col-sm-8">
            <input type="text" class ="form-control1" name ="coursename" value="<?php echo $_GET['coursename'];?>">
            <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
        </div>
    </div>
</div>
<div class="form-group">
    <form method="get" action="entercialevel.php">
        <div class="row">
            <label class="col-sm-8 control-label">Enter CIA LEVEL Entry</label>
            <div class="col-sm-2">
                <input type="hidden" class ="form-control1" name="coursename" value="<?php echo $_GET['coursename'];?>" >
            </div>
            <div class="col-sm-2">
            <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
                <div class="col-sm-2">
                </div>
                <input type="submit" class="form-control1" value="SUBMIT">
            </div>
        </div>
    </form>
</div>
<?php 
    $cname=$_GET['coursename'];
    $cname=strtolower($cname);
    $pos = strpos($cname, "lab");
    if($pos===false)
    {?>
<div class="form-group">
    <form method="get" action="assesmentcomponents.php">
        <div class="row">
            <label class="col-sm-4 control-label">Assignments</label>
            <label class="col-sm-2 control-label">No of Assignments</label>
            <div class="col-sm-2">
                <input type="text" class="form-control1" name="assignments"  required="">
            </div>
            <div class="col-sm-2">
                <input type="hidden" class ="form-control1" name ="coursename" value="<?php echo $_GET['coursename'];?>">
                <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
            </div>
            <div class="col-sm-2">
                <input type="submit" class="form-control1" value="SUBMIT">
            </div>
        </div>
    </form>
</div>
    <?php }?>
<div class="form-group">
    <form method="get" action="enterhclmapping.php">
        <div class="row">
            <label class="col-sm-4 control-label">CO HCL Mapping</label>
            <label class="col-sm-2 control-label">Enter No of CO's</label>
            <div class="col-sm-2">
                <input type="text" class="form-control1" name="noofCO" required="">
            </div>
            <div class="col-sm-2">
                <input type="hidden" class ="form-control1" name ="coursename" value="<?php echo $_GET['coursename'];?>">
                <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
            </div>
            <div class="col-sm-2">
                <input type="submit" class="form-control1" value="SUBMIT">
            </div>
        </div>
    </form>
</div>
<?php 
    $cname=$_GET['coursename'];
    $cname=strtolower($cname);
    $pos = strpos($cname, "lab");
    if($pos===false)
    {?>
<div class="form-group">
    <form method="get" action="enterseminar.php">
        <div class="row">
            <label class="col-sm-4 control-label">Seminars</label>
            <label class="col-sm-2 control-label">Enter No of Seminars</label>
            <div class="col-sm-2">
                <input type="text" class="form-control1" name="nosemonars" required="" >
            </div>
            <div class="col-sm-2">
                <input type="hidden" class ="form-control1" name ="coursename" value="<?php echo $_GET['coursename'];?>" >
                <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
            </div>
            <div class="col-sm-2">
                <input type="submit" class="form-control1" value="SUBMIT">
            </div>
        </div>
    </form>
</div>
<div class="form-group">
    <form method="get" action="enterquiz.php">
        <div class="row">
            <label class="col-sm-4 control-label">Quiz</label>
            <label class="col-sm-2 control-label">Enter No of Quizzes</label>
            <div class="col-sm-2">
                <input type="text" class="form-control1" name="nosemonars" required="" >
            </div>
            <div class="col-sm-2">
                <input type="hidden" class ="form-control1" name ="coursename" value="< <?php echo $_GET['coursename'];?>">
                <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
            </div>
            <div class="col-sm-2">
                <input type="submit" class="form-control1" value="SUBMIT">
            </div>
        </div>
    </form>
</div>
    <?php }?>
<div class="form-group">
    <form method="get" action="enterCOweightage.php">
        <div class="row">
            <label class="col-sm-8 control-label">Enter CO Weightage </label>
            <div class="col-sm-2">
                <input type="hidden" class ="form-control1" name ="coursename" value="<?php echo $_GET['coursename'];?>" >
                <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
            </div>
            <div class="col-sm-2">
                <input type="submit" class="form-control1" value="SUBMIT">
            </div>
        </div>
    </form>
</div>
<div class="form-group">
    <form method="get" action="enterpomapping.php">
        <div class="row">
            <label class="col-sm-8 control-label">Enter PO Mapping </label>
            <div class="col-sm-2">
                <input type="hidden" class ="form-control1" name ="coursename" value="<?php echo $_GET['coursename'];?>">
                <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
            </div>
            <div class="col-sm-2">
                <input type="submit" class="form-control1" value="SUBMIT">
            </div>
        </div>
    </form>
</div>
<?php 
    $cname=$_GET['coursename'];
    $cname=strtolower($cname);
    $pos = strpos($cname, "lab");
    if($pos===false)
    {?>
<div class="form-group">
<form method="post" enctype="multipart/form-data">
    <div class="row">
        <label class="col-sm-5 control-label">Upload Prerequisites</label>
        <div class="col-sm-3">
            <input type="file" name="file" size="50" />
        </div>
        <div class="col-sm-2">
                <input type="hidden" class ="form-control1" name ="coursename" value="<?php echo $_GET['coursename'];?>">
                <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
            </div>
        <div class="col-sm-2">
            <input type="submit" name="UploadPrereq" value="Upload"/>
        </div>
</form>
</div>
<div class="form-group">
<form  method="post" enctype="multipart/form-data">
    <div class="row">
        <label class="col-sm-5 control-label">Upload Concept Map</label>
        <div class="col-sm-3">
            <input type="file" name="file" size="50" />
        </div>
        <div class="col-sm-2">
                <input type="hidden" class ="form-control1" name ="coursename" value="<?php echo $_GET['coursename'];?>">
                <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
            </div>
        <div class="col-sm-2">
            <input type="submit" name="UploadCmap" value="Upload"/>
        </div>
</form>
</div>
    <?php }?>
<div class="form-group">
    <form  method="post" enctype="multipart/form-data">
        <div class="row">
            <label class="col-sm-5 control-label">Upload Syllabus Page 1</label>
            <div class="col-sm-3">
                <input type="file" name="file" size="50" />
            </div>
            <div class="col-sm-2">
                <input type="hidden" class ="form-control1" name ="coursename" value="<?php echo $_GET['coursename'];?>">
                <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
            </div>
            <div class="col-sm-2">
                <input type="submit" name="Uploadsbus1" value="Upload"/>
            </div>
        </div>
    </form>
</div>
<div class="form-group">
    <form  method="post" enctype="multipart/form-data">
        <div class="row">
            <label class="col-sm-5 control-label">Upload Syllabus Page 2</label>
            <div class="col-sm-3">
                <input type="file" name="file" size="50" />
            </div>
            <div class="col-sm-2">
                <input type="hidden" class ="form-control1" name ="coursename" value="<?php echo $_GET['coursename'];?>">
                <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
            </div>
            <div class="col-sm-2">
                <input type="submit" name="Uploadsbus2" value="Upload"/>
            </div>
        </div>
    </form>
</div>
<div class="form-group">
    <form  method="post" enctype="multipart/form-data">
        <div class="row">
            <label class="col-sm-5 control-label">Upload Syllabus Page 3</label>
            <div class="col-sm-3">
                <input type="file" name="file" size="50" />
            </div>
            <div class="col-sm-2">
                <input type="hidden" class ="form-control1" name ="coursename" value="<?php echo $_GET['coursename'];?>">
                <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
            </div>
            <div class="col-sm-2">
                <input type="submit" name="Uploadsbus3" value="Upload"/>
            </div>
        </div>
    </form>
</div>
<div class="form-group">
    <form method="POST" action="viewall.php">
        <div class="row">
            <label class="col-sm-8 control-label">VIEW ALL DETAILS</label>
            
            
            <div class="col-sm-2">
                <input type="hidden" class ="form-control1" name ="coursename" value="<?php echo $_GET['coursename'];?>">
                <input type="hidden" class ="form-control1" name="dept" value="<?php echo $_GET['dept'];?>" >
            </div>
            <div class="col-sm-2">
                <input type="submit" class="form-control1" value="SUBMIT">
            </div>
        </div>
    </form>
</div>
<?php
    if(isset($_POST['UploadPrereq']))
     {       
            $root = getcwd();
            $staffid=$_SESSION['staffid'];
            $coursename=$_POST['coursename'];
            $dept=$_POST['dept'];
            $sql="SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept'";
            $result=$mysqli->query($sql);
            $row=$result->fetch_assoc();
            $coursecode=$row['coursecode'];
            $targetfolder = $root."\uploads/";
            $targetfolder = $targetfolder . $coursecode."_prereq.jpg";
            $file_type=$_FILES['file']['type'];
            if(file_exists('uploads/'. $coursecode.'_prereq.jpg'))
            {
                unlink('uploads/'. $coursecode.'_prereq.jpg.jpg');
            }
            if ($file_type=="image/jpeg" || $file_type=="image/jpg")
            {
                if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
                {
                    echo "<script>alert('The file ". basename( $_FILES['file']['name']). " is uploaded')</script>";
                    
                }
                else 
                {
                    echo "<script>alert('Problem uploading file')</script>";
                }
    
            }
            else 
            {
            echo "<script>alert('You may only upload  JPEGs files!')</script>";
            }
        }
        if(isset($_POST['UploadCmap']))
        {  
            $root = getcwd();
            $coursename=$_POST['coursename'];
            $staffid=$_SESSION['staffid'];
            $dept=$_POST['dept'];
            $sql="SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept'";
            $result=$mysqli->query($sql);
            $row=$result->fetch_assoc();
            $coursecode=$row['coursecode'];
            $targetfolder = $root."\uploads/";
            $targetfolder = $targetfolder.$coursecode."__conceptmap.jpg";
            $file_type=$_FILES['file']['type'];
            if(file_exists('uploads/'.$coursecode.'__conceptmap.jpg'))
            {
                unlink('uploads/'.$coursecode.'__conceptmap.jpg');
            }
            if ($file_type=="image/jpeg" || $file_type=="image/jpg")
            {
                if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
                {
                    echo "<script>alert('The file ". basename( $_FILES['file']['name']). " is uploaded')</script>";
                    
                }
                else 
                {
                    echo "<script>alert('Problem uploading file')</script>";
                }
    
            }
            else 
            {
            echo "<script>alert('You may only upload  JPEGs files!')</script>";
            }
        }
        if(isset($_POST['Uploadsbus1']))
        {       $root = getcwd();
            $coursename=$_POST['coursename'];
            $staffid=$_SESSION['staffid'];
            $dept=$_POST['dept'];
            $sql="SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept'";
            $result=$mysqli->query($sql);
            $row=$result->fetch_assoc();
            $coursecode=$row['coursecode'];
            $targetfolder = $root."\uploads/";
            $targetfolder = $targetfolder.$coursecode."__syllabus_PAGE1.jpg";
            $file_type=$_FILES['file']['type'];
            if(file_exists('uploads/'.$coursecode.'__syllabus_PAGE1.jpg'))
            {
                unlink('uploads/'.$coursecode.'__syllabus_PAGE1.jpg');
            }
            if ($file_type=="image/jpeg" || $file_type=="image/jpg")
            {
                if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
                {
                    echo "<script>alert('The file ". basename( $_FILES['file']['name']). " is uploaded')</script>";
                    
                }
                else 
                {
                    echo "<script>alert('Problem uploading file')</script>";
                }
    
            }
            else 
            {
            echo "<script>alert('You may only upload  JPEGs files!')</script>";
            }
        }
        if(isset($_POST['Uploadsbus2']))
        {       $root = getcwd();
            $coursename=$_POST['coursename'];
            $staffid=$_SESSION['staffid'];
            $dept=$_POST['dept'];
            $sql="SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept'";
            $result=$mysqli->query($sql);
            $row=$result->fetch_assoc();
            $coursecode=$row['coursecode'];
            $targetfolder = $root."\uploads/";
            $targetfolder = $targetfolder.$coursecode."__syllabus_PAGE2.jpg";
            $file_type=$_FILES['file']['type'];
            if(file_exists('uploads/'.$coursecode.'__syllabus_PAGE2.jpg'))
            {
                unlink('uploads/'.$coursecode.'__syllabus_PAGE2.jpg');
            }
            if ($file_type=="image/jpeg" || $file_type=="image/jpg")
            {
                if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
                {
                    echo "<script>alert('The file ". basename( $_FILES['file']['name']). " is uploaded')</script>";
                    
                }
                else 
                {
                    echo "<script>alert('Problem uploading file')</script>";
                }
    
            }
            else 
            {
            echo "<script>alert('You may only upload  JPEGs files!')</script>";
            }
        }
        if(isset($_POST['Uploadsbu3']))
        {       $root = getcwd();
            $coursename=$_POST['coursename'];
            $staffid=$_SESSION['staffid'];
            $dept=$_POST['dept'];
            $sql="SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' and dept='$dept'";
            $result=$mysqli->query($sql);
            $row=$result->fetch_assoc();
            $coursecode=$row['coursecode'];
            $targetfolder = $root."\uploads/";
            $targetfolder = $targetfolder.$coursecode."__syllabus_PAGE3.jpg";
            $file_type=$_FILES['file']['type'];
            if(file_exists('uploads/'.$coursecode.'__syllabus_PAGE3.jpg'))
            {
                unlink('uploads/'.$coursecode.'__syllabus_PAGE3.jpg');
            }
            if ($file_type=="image/jpeg" || $file_type=="image/jpg")
            {
                if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
                {
                    echo "<script>alert('The file ". basename( $_FILES['file']['name']). " is uploaded')</script>";
                    
                }
                else 
                {
                    echo "<script>alert('Problem uploading file')</script>";
                }
    
            }
            else 
            {
            echo "<script>alert('You may only upload  JPEGs files!')</script>";
            }
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
