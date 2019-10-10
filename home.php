<?php
    require("header.php")
    ?>
<!---mainpage---->
<div id="page-wrapper">
<div class="main-page">
<div class="tables">
<h2 class="title1">Welcome</h2>
<div class="panel-body widget-shadow">
    <?php
        $staffid=$_SESSION['staffid'];
        $sql="SELECT * from staffmaster where staffid='".$staffid."'";
        $result=$mysqli->query($sql);
        $row=$result->fetch_assoc();
        
        ?>
    <div class="form-group">
        <div class = "row">
            <label for="Course Outcome No" class="col-sm-2 control-label">Staff Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control1"  name= "add_cono" value="<?php echo $row['name'];?>" disabled>
            </div>
        </div>
        <div class="form-group">
            <div class = "row">
                <label for="Course Outcome No" class="col-sm-2 control-label">Designation</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control1"  name= "add_cono" value="<?php echo $row['designation'];?>" disabled>
                </div>
            </div>
            <div class="form-group">
                <div class = "row">
                    <label for="Course Outcome No" class="col-sm-2 control-label">Department</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control1"  name= "add_cono" value="<?php echo $row['department'];?>" disabled>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <th>Section</th>
                        <th>Semester</th>
                        <th>Coursename</th>
                        <th>Department</th>
                    </thead>
                    <?php
                        $staffid=$_SESSION['staffid'];
                        $sql="SELECT * from classmapping where staffid='".$staffid."'";
                        
                        $result=$mysqli->query($sql);
                        for($i=0;$i<mysqli_num_rows($result);$i++)
                        {
                            $row=$result->fetch_assoc();
                            echo "<tr>";
                            echo "<td>".$row['section']."</td>";
                            echo "<td>".$row['sem']."</td>";
                            echo "<td>".$row['coursename']."</td>";
                            echo "<td>".$row['department']."</td>";
                            echo "<tr>";
                        }
                        
                        ?>
                </table>
            </div>
            <?php if (file_exists("uploads/".$_SESSION['staffid']."_timetable.jpg"))
            {  ?>
            <div>
            <h3>Time Table</h3></br>
               <img src=<?php echo "uploads/".$_SESSION['staffid']."_timetable.jpg"?>>
            </div>
            <?php }?>
            <div class="form-group">
                <form  method="post" enctype="multipart/form-data">
                    <div class="row">
                        <label class="col-sm-5 control-label">Upload Time-Table</label>
                        <div class="col-sm-3">
                            <input type="file" name="file" size="50" />
                        </div>
                        <div class="col-sm-2">
                            <input type="hidden" class ="form-control1" name ="coursename" value="<?php echo $_GET['coursename'];?>">
                        </div>
                        <div class="col-sm-2">
                            <input type="submit" name="Uploadtt" value="Upload"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    if(isset($_POST['Uploadtt']))
     {       
            $root = getcwd();
           
            $targetfolder = $root."\uploads/";
            $targetfolder = $targetfolder .$_SESSION['staffid']."_timetable.jpg";
            $file_type=$_FILES['file']['type'];
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
            echo "<script>alert('You may only upload JPEGs files!');</script>";
            }
        }
        
    ?>	
<!---/mainpage--->
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
