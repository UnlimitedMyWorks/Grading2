<?php include('header.php');include("config.php");?>
<div id="page-wrapper">
<div class="main-page">
<div class="tables">
<div class="panel-body widget-shadow">
<h4>Course delivery Plan Database </h4>
<table class='table'>
<thead>
<tr>
<th>Course Name</th>
<th>Department</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<?php
                                $sql="SELECT DISTINCT coursecode from programmmeoutcomemapping";
                                $result=$mysqli->query($sql);
                                for($i=0;$i<mysqli_num_rows($result);$i++)
                                {
                                    $row=$result->fetch_assoc();
                                    $coursecode=$row['coursecode'];
                                    $sql1="SELECT coursename,dept from coursemaster where coursecode='$coursecode'";
                                    $result1=$mysqli->query($sql1);
                                    $row1=$result1->fetch_assoc();
                                    echo"<tr><td>".$row1['coursename']."</td><td>".$row1['dept']."</td><td>Completed</td></tr>";
                                    
                                } 
                            ?>
<?php
                                $sql="SELECT DISTINCT coursemaster.coursecode,coursemaster.coursename,coursemaster.dept FROM programmmeoutcomemapping,coursemaster WHERE coursemaster.coursecode NOT IN (SELECT programmmeoutcomemapping.coursecode from programmmeoutcomemapping)";
                                $result=$mysqli->query($sql);
                                for($i=0;$i<mysqli_num_rows($result);$i++)
                                {
                                    $row=$result->fetch_assoc();
                                    echo"<tr><td>".$row['coursename']."</td><td>".$row['dept']."</td><td>Not Completed</td></tr>";
                                    
                                }     
                            ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<script src="js/classie.js"></script>
<script>var menuLeft=document.getElementById("cbp-spmenu-s1"),showLeftPush=document.getElementById("showLeftPush"),body=document.body;showLeftPush.onclick=function(){classie.toggle(this,"active");classie.toggle(body,"cbp-spmenu-push-toright");classie.toggle(menuLeft,"cbp-spmenu-open");disableOther("showLeftPush")};function disableOther(a){if(a!=="showLeftPush"){classie.toggle(showLeftPush,"disabled")}}</script>
<script src='js/SidebarNav.min.js' type='text/javascript'></script>
<script>$(".sidebar-menu").SidebarNav();</script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
