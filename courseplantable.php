<?php
    session_start();
    if(!isset($_SESSION['staffid']))
        header("Location:index.php");
        $staffid=$_SESSION['staffid'];
    
        require("config.php");
   
    
    if ($mysqli->connect_errno) {
          echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $coursecode=filter_input(INPUT_GET,'coursecode');
    $hours=filter_input(INPUT_GET,'Hours');
    $unitname=filter_input(INPUT_GET,'unit_name');
    $unit=filter_input(INPUT_GET,'unitno');

    $learning_outcomes=filter_input(INPUT_GET,'learning_outcomes');
    if($learning_outcomes=="" OR $unitname=="" )
    {
        echo "<script>alert('Enter All the Details');window.location='coursedeliveryplan.php?coursecode=".$coursecode."&unit=".$unit."&hours=".$hours."'</script>";
    }
    for($i=0;$i<$hours;$i++)
    {
        $sno=filter_input(INPUT_GET,'sno'.$i);
        $topic=filter_input(INPUT_GET,'topic'.$i);
        $proposed_date=filter_input(INPUT_GET,'proposed_date'.$i);
        if($proposed_date=="" OR $topic=="")
        {
            echo "<script>alert('Enter All the Details');window.location='coursedeliveryplan.php?coursecode=".$coursecode."&unit=".$unit."&hours=".$hours."'</script>";
        }
        $pertaining_co=filter_input(INPUT_GET,'pertaining_co'.$i);
        $hcl=filter_input(INPUT_GET,'hcl'.$i);
        $mod=filter_input(INPUT_GET,'mod'.$i);
        $delivery_resources=filter_input(INPUT_GET,'delivery_resources'.$i);
        
        $sql="INSERT INTO `coursedeliveryplan`(`staffid`,`coursecode`, `unit`, `unitname`, `sno`, `proposed_period`, `topic`, `pertaining_co`, `hcl`, `md`, `delivery_resources`, `learning_outcomes`) VALUES ('$staffid','$coursecode','$unit','$unitname','$sno','$proposed_date','$topic','$pertaining_co','$hcl','$mod','$delivery_resources','$learning_outcomes')";
        $mysqli->query($sql);
        
    }
    echo '<br /><a href="getsyllabus.php?coursecode='.filter_input(INPUT_GET,'coursecode').'">Go Back To Unit </a>';
?>