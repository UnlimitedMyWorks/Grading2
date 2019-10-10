<?php
        session_start();
        if(!isset($_SESSION['staffid']))
            header("Location:index.php");
            include("config.php");
        $qno=(int)filter_input(INPUT_POST ,'add_qno');
        $qname=filter_input(INPUT_POST,'add_qn');
        $cocd=filter_input(INPUT_POST,'coursecode');
        
        $cono=filter_input(INPUT_POST,'add_cono');
        $cowt=(int)filter_input(INPUT_POST,'add_cowt');
        
        
        if($qno=="" OR $qname==""  OR $cono=="" OR $cowt=="")
        {
            echo "<script type='text/javascript'>window.location = 'assignment1qentry.php?coursecode=".$cocd."'';alert('Enter all The Details');</script>";
        }
        else
        {
            $sql1="INSERT INTO `assignment1questions`(`coursecode`, `qno`, `qname`,  `courseoutcomecode`, `weightage`) VALUES ('$cocd','$qno','$qname','$cono','$cowt')";
           echo $sql1;
            $result1=$mysqli->query($sql1);
            
            if($result1==true )
            {
               echo "<script>window.location = 'assignment1qentry.php?coursecode=".$cocd."'; alert('success entry');</script>" ;
            }
            else
            {
               echo "<script>window.location = 'assignment1qentry.php?coursecode=".$cocd."'; alert('failed');</script>";
            }
        }
?>