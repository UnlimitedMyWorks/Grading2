<?php include("header.php")?>
    <div id="page-wrapper">
        <div class="main-page">
            <div class="tables">
                <h2 class="title1">Remove Course Co-ordinator</h2>
                <div class="panel-body widget-shadow">
                    <h4></h4>
                    <form method = "post" >
                    
                    <div class="form-group">
                    <div class = "row">
                        <label for="Course Outcome No" class="col-sm-2 control-label">Staff</label>
                        <div class="col-sm-8">
                            <select name= "staff" class="form-control1">
                                <?php 
                                    $sql="SELECT staffmaster.staffid,staffmaster.name from staffmaster,courseadmin where staffmaster.staffid=courseadmin.staffid";
                                    $result=$mysqli->query($sql);
                                    for($i=0;$i<mysqli_num_rows($result);$i++)
                                    {
                                        $row=$result->fetch_assoc();
                                        echo "<option value='".$row['staffid']."'>".$row['name']."</option>";
                                    }

                                ?>
                            </select>
                        </div>
                        </div>
                        <div class="form-group">
                         <div class = "row">
                        <label for="Course Outcome No" class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-8">
                            <select name= "coursename" class="form-control1">
                                <?php 
                                    $sql="SELECT DISTINCT coursename from courseadmin";
                                    $result=$mysqli->query($sql);
                                    for($i=0;$i<mysqli_num_rows($result);$i++)
                                    {
                                        $row=$result->fetch_assoc();
                                        echo "<option value='".$row['coursename']."'>".$row['coursename']."</option>";
                                    }

                                ?>
                            </select>
                        </div>
                        <div>
                        <input type="submit" class="btn danger" name="Revoke" value="Revoke">
                   
                    </form>
                </div>
            </div>  
        </div>
    </div>
    <?php
        if(isset($_POST['Revoke']))
        {
            $staffid=$_POST['staff'];
            $coursename=$_POST['coursename'];
            $sql="DELETE FROM courseadmin where staffid='".$staffid."' AND coursename='".$coursename."'";
            echo $sql;
            $mysqli->query($sql);
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