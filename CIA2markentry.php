<?php
include('header.php');
include("config.php");
if(isset($_POST['submit']))
{
  $staffid    = $_SESSION['staffid'];
  $sem        = $_POST['sem'];
  $sec        = $_POST['section'];
  $coursecode = $_POST['coursecode'];
  $dept       = $_POST['department'];
  $sql        = "SELECT * FROM classmapping where staffid='$staffid' and sem='$sem' and section='$sec' and department='$dept' and coursecode='$coursecode'";
  echo $sql;
  $result = $mysqli->query($sql);
  if (mysqli_num_rows($result) == 0) {
      
      echo "<script>alert('Select Proper Class!!');window.location.href='CIA2selectsubject.php';  </script>";
  }
}
?>
<!-- /.navbar-collapse -->
<!-- main page -->
<div id="page-wrapper">
  <div class="main-page">
    <div class="tables">
      <div class="panel-body widget-shadow">
        <div class="row">
          <form class="form-horizontal"  method="post" name="upload_excel" enctype="multipart/form-data">
            <fieldset>
              <!-- Form Name -->
              <legend>Upload CIA 2 Marks </legend>
              <!-- File Button -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="filebutton">
                 
                </label>
              </div>
              <form class="form-horizontal"  method="post" name="upload_excel" enctype="multipart/form-data">
                <?php
$coursecode = $_POST['coursecode'];
if ($coursecode == 'CSE201') {
?>
               <div class="form-group">
                  <div class = "row">
                    <label for="Course Outcome No" class="col-sm-4 control-label">Group A/B</label>
                    <label class="radio-inline">
                      <input type="radio" name="group" value='A'>Group A
                          
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="group" >Group B
                          
                        </label>
                      </div>
                    </div>
                    <?php
}
?>
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
                    <input type="hidden" name="class" value="
                      <?php
echo $_POST['section'];
?>">
                      <input type="hidden" name="sem" value="
                        <?php
echo $_POST['sem'];
?>">
                        <input type="hidden" name="coursecode" value="
                          <?php
echo $_POST['coursecode'];
?>">
                          <input type="hidden" name="dept" value="
                            <?php
echo $_POST['department'];
?>">
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
if (isset($_POST["Import"])) {
    $staffid    = $_SESSION['staffid'];
    $sem        = TRIM($_POST['sem']);
    $sec        = TRIM($_POST['class']);
    $coursecode = TRIM($_POST['coursecode']);
    $dept       = TRIM($_POST['dept']);
    $filename   = $_FILES["file"]["tmp_name"];
    $ln         = 0;
    $group      = $_POST['group'];
    if ($_FILES["file"]["size"] > 0) {
        $count  = 0;
        $sql    = "SELECT * from cia2 where sem='$sem' AND section='$sec' and dept='$dept' and coursecode='$coursecode'  AND staffid='$staffid'";
        $result = $mysqli->query($sql);
        if ($result)
            $mysqli->query("DELETE from cia2 where sem='$sem' AND section='$sec' and dept='$dept' and coursecode='$coursecode' AND staffid='$staffid'");
        $file = fopen($filename, "r");
        if ($coursecode == "CSE201") {
            $sql = "SELECT DISTINCT(qno) from cia2questions WHERE coursecode='$coursecode' and groupforfirstyear='$group' ORDER BY CAST(qno AS UNSIGNED)";
        } else {
            $sql = "SELECT DISTINCT(qno) from cia2questions WHERE coursecode='$coursecode' ORDER BY CAST(qno AS UNSIGNED)";
            
        }
        $totalsql  = '';
        $result    = $mysqli->query($sql);
        $ctr       = mysqli_num_rows($result);
        $insertsql = "INSERT INTO `cia2`(`Reg_no`, `student_name`, `coursecode`, `sem`, `section`, `dept`, `staffid`,";
        for ($i = 0; $i < $ctr; $i++) {
            $row = $result->fetch_assoc();
            if ($i < $ctr - 1)
                $insertsql .= "`q" . $row['qno'] . "`,";
            else
                $insertsql .= "`q" . $row['qno'] . "`) VALUES";
            $count++;
        }
        $count++;
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            if ($ln == 0) {
                $ln = 1;
            } else {
                
                $sql2 = " ('" . $getData[0] . "','" . $getData[1] . "','$coursecode','$sem','$sec','$dept','$staffid',";
                
                for ($i = 2; $i <= $count; $i++) {
                    if ($i != $count)
                        $sql2 .= "'" . $getData[$i] . "',";
                    else
                        $sql2 .= "'" . $getData[$i] . "')";
                }
                $totalsql .= $insertsql . $sql2 . ";";
                
            }
            
            
            
        }
        if (!isset($result)) {
            echo "
                <script type=\"text/javascript\">
                   alert(\"Invalid File:Please Upload CSV File.\");
                  
                   </script>";
        } else {
            if ($coursecode == "CSE201") {
                $sql = "SELECT DISTINCT courseoutcomecode FROM cia2questions  where coursecode=" . "'" . $coursecode . "' and groupforfirstyear='$group' ORDER BY courseoutcomecode ASC";
            } else {
                $sql = "SELECT DISTINCT courseoutcomecode FROM cia2questions  where coursecode=" . "'" . $coursecode . "' ORDER BY courseoutcomecode ASC";
                
            }
            
            $result = $mysqli->query($sql);
            $ctr    = mysqli_num_rows($result);
            for ($i = 0; $i < $ctr; $i++) {
                $row = $result->fetch_assoc();
                if ($coursecode == "CSE201") {
                    $sql = "select qno from cia2questions where courseoutcomecode='" . $row['courseoutcomecode'] . "' AND  coursecode='" . $coursecode . "' and groupforfirstyear='$group'";
                } else {
                    $sql = "select qno from cia2questions where courseoutcomecode='" . $row['courseoutcomecode'] . "' AND  coursecode='" . $coursecode . "'";
                }
                $result1 = $mysqli->query($sql);
                $sco    = "UPDATE cia2 set " . $row['courseoutcomecode'] . "=";
                for ($j = 0; $j < mysqli_num_rows($result1); $j++) {
                    if ($j != mysqli_num_rows($result1) - 1) {
                        $row1 = $result1->fetch_assoc();
                        $sco .= "q" . $row1['qno'] . "+";
                    } else {
                        $row1 = $result1->fetch_assoc();
                        $sco .= "q" . $row1['qno'] . " where staffid='" . $staffid . "' AND coursecode='" . $coursecode . "'";
                        
                        $totalsql .= $sco . ";";
                        
                    }
                    
                }
                
            }
            fclose($file);
            
            $result = $mysqli->multi_query($totalsql);
            if ($result)
                echo "<script>alert('CSV sucessfully Uploaded!!');window.location.href='CIA2selectsubject.php';  </script>";
            else
                echo "<script>alert('CSV not  sucessfully Uploaded!!');window.location.href='CIA2selectsubject.php';  </script>";
        }
        
        
    }
}
?>
                   <!-- Classie -->
                    <!-- for toggle left push menu script -->
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
                    <!-- //Classie -->
                    <!-- //for toggle left push menu script -->
                    <!-- side nav js -->
                    <script src='js/SidebarNav.min.js' type='text/javascript'></script>
                    <script>
    $('.sidebar-menu').SidebarNav()
</script>
                    <!-- //side nav js -->
                    <!-- Bootstrap Core JavaScript -->
                    <script src="js/bootstrap.js"></script>
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