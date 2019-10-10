<?php
include('header.php');
include("config.php");
?>
<div id="page-wrapper">
    <div class="main-page">
        <div class="tables">
            <h2 class="title1">ALL Subjects Attainment</h2>
            <div class="panel-body widget-shadow">
                <div style="overflow-x:auto;">
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Department</th>
                                <th>CO1</th>
                                <th>CO2</th>
                                <th>CO3</th>
                                <th>CO4</th>
                                <th>CO5</th>
                                <th>CO6</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql="SELECT DISTINCT coursecode,coursename,dept FROM coursemaster where coursecategory != 'semi theory semi lab'";
                                $allresult=$mysqli->query($sql);
                                for($x=0;$x<mysqli_num_rows($allresult);$x++)
                                {
                                    $flag=0;
                                    $allrow=$allresult->fetch_assoc();
                                    $coursename=strtolower($allrow['coursename']);
                                    if(strpos($coursename,"lab"))
                                        $flag=1;
                                    else
                                        $flag=0;
                                    echo "<tr><td>".$allrow['coursename']."</td><td>".$allrow['dept']."</td>";
                                    $coursecode=$allrow['coursecode'];
                                    $colevel=0;
                                    $level=0;
                                    $dept=$allrow['dept'];
                                    $sql="SELECT  * FROM university where coursecode='$coursecode' AND grade <= (SELECT DISTINCT target_level from assesmentweightagecomponents where coursecode='$coursecode' AND assesmentcomponents='University') OR coursecode='$coursecode' AND grade = 'S'";
                                    $result=$mysqli->query($sql);
                                    $num=mysqli_num_rows($result);
                                    $sql="SELECT * from university where coursecode='$coursecode'";
                                    $result=$mysqli->query($sql);
                                    $den=mysqli_num_rows($result);
                                    $sql="SELECT L1,L2,L3 from assesmentweightagecomponents where coursecode='$coursecode' AND assesmentcomponents='University'";
                                    $result2=$mysqli->query($sql);
                                    $row2=$result2->fetch_assoc();
                                    if($den==0)
                                        $colevel+=0;
                                    else
                                    {
                                        $per=$num/$den*100;
                                        if($per>=$row2['L1'] and $per<$row2['L2'])
                                        {
                                            $level=1;
                                        }
                                        else if($per>=$row2['L2'] and $per<$row2['L3'])
                                        {
                                            $level=2;
                                        }
                                        else if($per>=$row2['L3'])
                                        {
                                            $level=3;
                                        }
                                        else{
                                            $level=0;
                                        }
                                    }
                                    $temp=$level;
                                    $sql="SELECT DISTINCT courseoutcomecode from cohclmapping where coursecode='$coursecode'";
                                    $result=$mysqli->query($sql);
                                    for($i=0;$i<mysqli_num_rows($result);$i++)
                                    {
                                        $row=$result->fetch_assoc();
                                        $co=$row['courseoutcomecode'];
                                        $colevel=$temp;
                                        $sql="SELECT DISTINCT `assesment_components`,`$co` FROM `coevaluationweightage` WHERE coursecode='$coursecode' AND $co!='0' AND assesment_components != 'University'";
                                        $result1=$mysqli->query($sql);
                                        for($j=0;$j<mysqli_num_rows($result1);$j++)
                                        {
                                            $row1=$result1->fetch_assoc();
                                            $exam=$row1['assesment_components'];
                                            $multiplier=$row1[$co]/100;
                                            $sql="SELECT * from $exam WHERE coursecode='$coursecode' AND dept='$dept'";
                                            $examresult=$mysqli->query($sql);
                                            $sql="SELECT DISTINCT target_level,L1,L2,L3 from assesmentweightagecomponents where coursecode='$coursecode' and assesmentcomponents='$exam' AND target_level !=''  AND assesmentcomponents !='University'";
                                            $result2=$mysqli->query($sql);
                                            $row2=$result2->fetch_assoc();
                                            $nummultiply=$row2['target_level']/100;
                                            $sql="SELECT SUM(weightage) AS marks FROM $exam"."questions where coursecode='$coursecode' and courseoutcomecode='$co'";
                                            $result3=$mysqli->query($sql);
                                            if($result3)
                                            {
                                                $row3=$result3->fetch_assoc();
                                                if($flag==1)
                                                {
                                                    $sql="SELECT COUNT(qno) AS nofq FROM $exam"."questions where coursecode='$coursecode' AND courseoutcomecode='$co'";
                                                    
                                                    $noq=$mysqli->query($sql);
                                                    $nofq=$noq->fetch_assoc();
                                                    $targetlevel=$row3['marks']*$nummultiply/$nofq['nofq'];
                                                    
                                                }
                                                else{
                                                    $targetlevel=$row3['marks']*$nummultiply;
                                                }
                                                $sql="SELECT * from $exam where coursecode='$coursecode' AND $co >= '$targetlevel' AND dept='$dept'";
                                                
                                                $tgcross=$mysqli->query($sql);
                                                $num=mysqli_num_rows($tgcross);
                                                $den=mysqli_num_rows($examresult);
                                                if($den==0)
                                                    $colevel+=0;
                                                else
                                                {
                                                    $per=$num/$den*100;
                                                    if($per>=$row2['L1'] and $per<$row2['L2'])
                                                    {
                                                        $level=1;
                                                        $colevel+=$level*$multiplier;
                                                    }
                                                    else if($per>=$row2['L2'] and $per<$row2['L3'])
                                                    {
                                                        $level=2;
                                                        $colevel+=$level*$multiplier;
                                                    }
                                                    else if($per>=$row2['L3'])
                                                    {
                                                        $level=3;
                                                        $colevel+=$level*$multiplier;
                                                    }
                                                    else{
                                                        $level=0;
                                                        $colevel+=$level*$multiplier;
                                                    }
                                                } 
                                            }
                                            
                                        }
                                        echo "<td>".($colevel/2)."</td>";
                                    }
                                    echo"</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
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
   </body>
</html>

