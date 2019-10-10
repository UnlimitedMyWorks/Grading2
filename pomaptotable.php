<?php
     
     
    
     
     if ($mysqli->connect_errno) {
           echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
     }
     $coursecode=filter_input(INPUT_GET,'coursecode');
     $sql="SELECT courseoutcomecode,highcoglevel from cohclmapping WHERE coursecode='".$coursecode."'";
     $result=$mysqli->query($sql);
     $coursecode=filter_input(INPUT_GET,'coursecode');
     for($i=0;$i<mysqli_num_rows($result);$i++)
     {   
         $row=$result->fetch_assoc();
         $cocd=$row['courseoutcomecode'];
         $hcl=$row['highcoglevel'];
         $po1=filter_input(INPUT_GET,'add_'.$cocd.'_PO1');
         $po2=filter_input(INPUT_GET,'add_'.$cocd.'_PO2');
         $po3=filter_input(INPUT_GET,'add_'.$cocd.'_PO3');
         $po4=filter_input(INPUT_GET,'add_'.$cocd.'_PO4');
         $po5=filter_input(INPUT_GET,'add_'.$cocd.'_PO5');
         $po6=filter_input(INPUT_GET,'add_'.$cocd.'_PO6');
         $po7=filter_input(INPUT_GET,'add_'.$cocd.'_PO7');
         $pso1=filter_input(INPUT_GET,'add_'.$cocd.'_PSO1');
         $pso2=filter_input(INPUT_GET,'add_'.$cocd.'_PSO2');
         $sql1="INSERT INTO programmmeoutcomemapping VALUES('$coursecode','$cocd','$hcl','$po1','$po2','$po3','$po4','$po5','$po6','$po7','$pso1','$pso2')";
         $mysqli->query($sql1);
     }
     echo "<script>window.location='getsyllabus.php?coursecode=".$coursecode."'</script>";
?>