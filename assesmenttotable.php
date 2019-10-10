<?php
    session_start();
    if(!$_SESSION['staffid'])
      header("Location:index.php");
    include("config.php");
    $sql="SELECT assesmentcomponents from assesmentweightagecomponents where coursecode='".$coursecode."'";
    $result=$mysqli->query($sql);
    for($i=1;$i<=filter_input(INPUT_GET,'noass');$i++)
    {   
        $assignment="Assignment".$i;
        $target_level=filter_input(INPUT_GET,'target_level'.$i);
        $level_1=filter_input(INPUT_GET,'level_1'.$i);
        $level_2=filter_input(INPUT_GET,'level_2'.$i);
        $level_3=filter_input(INPUT_GET,'level_3'.$i);
        $sql1="INSERT INTO assesmentweightagecomponents(`coursecode`, `assesmentcomponents`, `target_level`, `L1`, `L2`, `L3`) VALUES ('$coursecode','$assignment','$target_level','$level_1','$level_2','$level_3')";
        $mysqli->query($sql1);
    }
    echo '<br /><a href="getsyllabus.php?coursecode='.filter_input(INPUT_GET,'coursecode').'">Go Back To Unit </a>';
?>