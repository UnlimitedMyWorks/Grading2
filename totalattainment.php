<?php include("header.php"); include("config.php");?>
<div id="page-wrapper">
  <div class="main-page">
    <h2 class="title1">View total attainment
    </h2>
    <div class="panel-body widget-shadow">
      <h4>
      </h4>
      <div style= "overflow-x:auto">
        <table class="table">
          <thead>
            <tr>
              <?php
                $coursename=$_GET['coursename'];
                $dept=$_GET['department'];
                $sql="SELECT DISTINCT coursecode from coursemaster where coursename='$coursename' AND dept='$dept'";
                $result=$mysqli->query($sql);
                $row=$result->fetch_assoc();
                $coursecode=$row['coursecode'];
                $coursename=strtolower($coursename);
                if(strpos($coursename,"lab"))
                    $flag=1;
                else
                    $flag=0;
                $sql="SELECT DISTINCT courseoutcomecode from cohclmapping where coursecode='$coursecode'";
                $result=$mysqli->query($sql);
                for($i=0;$i<mysqli_num_rows($result);$i++)
                {
                    $row=$result->fetch_assoc();
                    echo "<th>".$row['courseoutcomecode']."</th>";
                }
            ?>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
                $colevel=0;
                $level=0;
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
                                                if($den != 0)
                                                {
                                                    $per=$num/$den*100;
                                                    if($per>=$row2['L1'] and $per<$row2['L2'])
                                                    {
                                                        $level=1;
                                                        $colevel+=($level*$multiplier);
                                                    }
                                                    else if($per>=$row2['L2'] and $per<$row2['L3'])
                                                    {
                                                        $level=2;
                                                        $colevel+=($level*$multiplier);
                                                    }
                                                    else if($per>=$row2['L3'])
                                                    {
                                                        $level=3;
                                                        $colevel+=($level*$multiplier);
                                                    }
                                                    else{
                                                        $level=0;
                                                        $colevel+=($level*$multiplier);
                                                    }
                                                } 
                                            }
                                            
                                        }
                                        echo "<td>".($colevel/2)."</td>";
                                    }
            ?>
            </tr>
          </tbody>
        </table>
      </div>
      </form>
  </div>
</div>
<!-- side nav js -->
<script src='js/SidebarNav.min.js' type='text/javascript'>
</script>
<script>
  $('.sidebar-menu').SidebarNav()
</script>
<!-- //side nav js -->
<!-- Classie -->
<!-- for toggle left push menu script -->
<script src="js/classie.js">
</script>
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
<!--scrolling js-->
<script src="js/jquery.nicescroll.js">
</script>
<script src="js/scripts.js">
</script>
<!--//scrolling js-->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"> </script>
<!-- //Bootstrap Core JavaScript -->
</body>
</html>
