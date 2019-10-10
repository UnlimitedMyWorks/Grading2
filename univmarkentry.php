<?php include('header.php');include("config.php");
    
    ?>
        <!-- main page -->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                   
                    <div class="panel-body widget-shadow">
                    <div class="row">
                <form class="form-horizontal"  method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
                        <!-- Form Name -->
                        <legend>Upload University  Marks </legend>
                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton"> <a href="files/univmarkentry.csv" download="univmarkentry.csv">Download csv template</a></label>
                            
                        </div>
                        <form class="form-horizontal"  method="post" name="upload_excel" enctype="multipart/form-data">
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
                    
                        <input type="hidden" name="sem" value="<?php echo $_POST['sem'];?>">
                        <input type="hidden" name="coursecode" value="<?php echo $_POST['coursecode'];?>">
                        <input type="hidden" name="dept" value="<?php echo $_POST['department'];?>">
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
<?php
     if(isset($_POST["Import"])){
        $staffid=$_SESSION['staffid'];
        $sem=$_POST['sem'];
        $coursecode=$_POST['coursecode'];
        $dept=$_POST['dept'];
        $filename=$_FILES["file"]["tmp_name"];   
        $ln=0;
         if($_FILES["file"]["size"] > 0)
         {
             $count=0;
             $sql="SELECT * from university where sem='$sem' and dept='$dept' AND coursecode='$coursecode'";
             $result=$mysqli->query($sql);
             if($result)
                 $mysqli->query("DELETE from university where sem='$sem' and dept='$dept' AND coursecode='$coursecode'");
            $file = fopen($filename, "r");
                $count++;
                while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
                {
                        if($ln==0)
                        {
                            $ln=1;
                        }
                        else{

                            $sql2="INSERT INTO `university`(`Reg_no`, `student_name`, `coursecode`, `sem`, `dept`, `grade`) VALUES ('$getData[0]','$getData[1]','$coursecode','$sem','$dept','$getData[2]')";
                            $result = $mysqli->query($sql2);  
                        }      
                 
                       
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
