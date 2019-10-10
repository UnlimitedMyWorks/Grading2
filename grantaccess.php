<?php include("header.php")?>
    <div id="page-wrapper">
        <div class="main-page">
            <div class="tables">
                <h2 class="title1">Grant Course Co-ordinator</h2>
                <div class="panel-body widget-shadow">
                    <h4></h4>
                    <form method = "post" >
                    
                    <div class="form-group">
                    <div class = "row">
                        <label for="Course Outcome No" class="col-sm-2 control-label">Staff </label>
                        <div class="col-sm-10">
                            <select name= "staff" class="form-control1">
                                <?php 
                                    $sql="SELECT `staffid`,`name` from staffmaster";
                                    $result=$mysqli->query($sql);
                                    for($i=0;$i<mysqli_num_rows($result);$i++)
                                    {
                                        $row=$result->fetch_assoc();
                                        echo "<option value='".$row['staffid']."'>".$row['name']."</option>";
                                    }

                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                         <div class = "row">
                        <label for="Course Outcome No" class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-4">
                            <select name= "coursename" class="form-control1">
                                <?php 
                                    $sql="SELECT coursename from coursemaster";
                                    $result=$mysqli->query($sql);
                                    for($i=0;$i<mysqli_num_rows($result);$i++)
                                    {
                                        $row=$result->fetch_assoc();
                                        echo "<option value='".$row['coursename']."'>".$row['coursename']."</option>";
                                    }

                                ?>
                            </select>
                        </div>
                        <label for="Course Outcome No" class="col-sm-2 control-label">Department</label>
                        <div class="col-sm-4">
                            <select name= "dept" class="form-control1">
                                <?php 
                                    $sql="SELECT DISTINCT dept from coursemaster";
                                    $result=$mysqli->query($sql);
                                    for($i=0;$i<mysqli_num_rows($result);$i++)
                                    {
                                        $row=$result->fetch_assoc();
                                        echo "<option value='".$row['dept']."'>".$row['dept']."</option>";
                                    }

                                ?>
                            </select>
                        </div>
                        <input type="submit" class="btn danger" name="Promote" value="Grant">
                    </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>
    <?php
        if(isset($_POST['Promote']))
        {
            $staffid=$_POST['staff'];
            $coursename=$_POST['coursename'];
            $dept=$_POST['dept'];
            $sql="SELECT * FROM courseadmin WHERE coursename='".$coursename."' and staffid='".$staffid."' and Department=''";
            $result=$mysqli->query($sql);
            
            if(mysqli_num_rows($result)>0)
                echo "<script>alert('Entry Already Exists!');</script>";
            else
            {
                $sql=$mysqli->query("INSERT INTO courseadmin values ('$dept','$coursename','$staffid')");
                if($sql)
                    echo "<script>alert('Sucessfully added!');</script>";
                else
                    echo "<script>alert('Entry Failed!');</script>";
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