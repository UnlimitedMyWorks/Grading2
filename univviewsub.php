<?php require("header.php");include("config.php");?>
        <!-- main page -->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    
                    <div class="panel-body widget-shadow">
                        <h4>University Mark Entry</h4>
                        <form method = "GET" action="univviewmarks.php">
                            <div class="form-group">
                                <label for="Coursecode" class="col-sm-2 control-label">Course Name</label>
                                <div class="col-sm-8">
                                    <select name="coursecode"  class="form-control1" id="getcc">
                                        <option disabled>Select a course</option>
                                        <?php
                                                $staffid=$_SESSION['staffid'];
                                                
                                                
                                               
                                                
                                                if ($mysqli->connect_errno) {
                                                      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                                                }
                                                $sql="SELECT coursename,coursecode from classmapping where staffid='".$staffid."'";
                                                $result=$mysqli->query($sql);
                                                $counter=mysqli_num_rows($result);
                                                for($i=0;$i<$counter;$i++)
                                                {
                                                   $row=$result->fetch_assoc();
                                                   echo "<option value='".$row['coursecode']."'>".$row['coursename']."</option>";
                                                }
                                                
                                            ?>
                                    </select>
                                </div>
                               
                            </div>
                            <div class="clearfix">
                            </div>
                            <div class="clearfix">
                            </div>
                            
                                <div class="form-group">
                                <label for="Coursecode" class="col-sm-2 control-label">Semester</label>
                                <div class="col-sm-4">
                                    <select class="form-control1" name="sem">
                                        <?php
                                            $sql="SELECT DISTINCT sem from classmapping where staffid='".$staffid."'";
                                            $result=$mysqli->query($sql);
                                            for($i=0;$i<mysqli_num_rows($result);$i++)
                                            {
                                                $row=$result->fetch_assoc();
                                                echo "<option value='".$row['sem']."'>".$row['sem']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                   
                                
                                <div class="form-group">
                                <label for="Coursecode" class="col-sm-2 control-label">Department</label>
                                <div class="col-sm-4">
                                    <select class="form-control1" name="department">
                                    <?php
                                            $sql="SELECT DISTINCT department from classmapping where staffid='".$staffid."'";
                                            $result=$mysqli->query($sql);
                                            for($i=0;$i<mysqli_num_rows($result);$i++)
                                            {
                                                $row=$result->fetch_assoc();
                                                echo "<option value='".$row['department']."'>".$row['department']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                   
                                </div>
                            <input type="submit" class="btn danger" value="Enter">
                        </form>
                        </div>
                </div>
            </div>
        </div>
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
