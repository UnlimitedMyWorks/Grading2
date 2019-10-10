<?php
    include("config.php");
    $totalsql="";
    $sql="SELECT DISTINCT coursecode,coursename,dept from coursemaster";
    $upperresult=$mysqli->query($sql);
    for($x=0;$x<mysqli_num_rows($upperresult);$x++)
    {
        echo "</br>".$x."</br>";
        $upperrow=$upperresult->fetch_assoc();
        $coursecode=$upperrow['coursecode'];
        if($coursecode!="CSE201")
        {
        //echo "</br>".$coursecode."</br>";
            if ($coursecode == "CSE201") {
                $sql = "SELECT DISTINCT courseoutcomecode FROM cia1questions  where coursecode=" . "'" . $coursecode . "' and groupforfirstyear='$group' ORDER BY courseoutcomecode ASC";
            } else {
                $sql = "SELECT DISTINCT courseoutcomecode FROM cia1questions  where coursecode=" . "'" . $coursecode . "' ORDER BY courseoutcomecode ASC";
                
            }
            echo $sql;
            $result = $mysqli->query($sql);
            if($result)
            {
                $ctr    = mysqli_num_rows($result);
                for ($i = 0; $i <$ctr; $i++) 
                {
                    $row = $result->fetch_assoc();
                    if ($coursecode == "CSE201") {
                        $sql = "select qno from cia1questions where courseoutcomecode='" . $row['courseoutcomecode'] . "' AND  coursecode='" . $coursecode . "' and groupforfirstyear='$group'";
                    } else {
                        $sql = "select qno from cia1questions where courseoutcomecode='" . $row['courseoutcomecode'] . "' AND  coursecode='" . $coursecode . "'";
                    }
                    echo $sql;
                    $result1 = $mysqli->query($sql);
                    $sco    = "UPDATE cia1 set " . $row['courseoutcomecode'] . "=";
                    for ($j = 0; $j < mysqli_num_rows($result1); $j++) {
                        if ($j != mysqli_num_rows($result1) - 1) {
                            $row1 = $result1->fetch_assoc();
                            $sco .= "q" . $row1['qno'] . "+";
                        } else {
                            $row1 = $result1->fetch_assoc();
                            $sco .= "q" . $row1['qno'] . " where staffid='" . $staffid . "' AND coursecode='" . $coursecode . "'";
                            
                            $totalsql .= $sco . ";";
                            
                        }
                        
                    }
                    
                }
                    
                
                
            }
            if($coursecode!="CSE201")
            { 
            if ($coursecode == "CSE201") {
                $sql = "SELECT DISTINCT courseoutcomecode FROM cia2questions  where coursecode=" . "'" . $coursecode . "' and groupforfirstyear='$group' ORDER BY courseoutcomecode ASC";
            } else {
                $sql = "SELECT DISTINCT courseoutcomecode FROM cia2questions  where coursecode=" . "'" . $coursecode . "' ORDER BY courseoutcomecode ASC";
                
            }
            echo $sql;
            $result = $mysqli->query($sql);
            if($result)
            {
                $ctr    = mysqli_num_rows($result);
                for ($i = 0; $i <$ctr; $i++) 
                {
                    $row = $result->fetch_assoc();
                    if ($coursecode == "CSE201") {
                        $sql = "select qno from cia2questions where courseoutcomecode='" . $row['courseoutcomecode'] . "' AND  coursecode='" . $coursecode . "' and groupforfirstyear='$group'";
                    } else {
                        $sql = "select qno from cia2questions where courseoutcomecode='" . $row['courseoutcomecode'] . "' AND  coursecode='" . $coursecode . "'";
                    }
                    echo $sql;
                    $result1 = $mysqli->query($sql);
                    $sco    = "UPDATE cia2 set " . $row['courseoutcomecode'] . "=";
                    for ($j = 0; $j < mysqli_num_rows($result1); $j++) {
                        if ($j != mysqli_num_rows($result1) - 1) {
                            $row1 = $result1->fetch_assoc();
                            $sco .= "q" . $row1['qno'] . "+";
                        } else {
                            $row1 = $result1->fetch_assoc();
                            $sco .= "q" . $row1['qno'] . " where staffid='" . $staffid . "' AND coursecode='" . $coursecode . "'";
                            
                            $totalsql .= $sco . ";";
                            
                        }
                        
                    }
                    
                }
                
                
                
            }
            
        }
        if($coursecode!="CSE201")
        {
        if ($coursecode == "CSE201") {
            $sql = "SELECT DISTINCT courseoutcomecode FROM cia3questions  where coursecode=" . "'" . $coursecode . "' and groupforfirstyear='$group' ORDER BY courseoutcomecode ASC";
        } else {
            $sql = "SELECT DISTINCT courseoutcomecode FROM cia3questions  where coursecode=" . "'" . $coursecode . "' ORDER BY courseoutcomecode ASC";
            
        }
        echo $sql;
        $result = $mysqli->query($sql);
        if($result)
        {
            $ctr    = mysqli_num_rows($result);
            for ($i = 0; $i <$ctr; $i++) 
            {
                $row = $result->fetch_assoc();
                if ($coursecode == "CSE201") {
                    $sql = "select qno from cia3questions where courseoutcomecode='" . $row['courseoutcomecode'] . "' AND  coursecode='" . $coursecode . "' and groupforfirstyear='$group'";
                } else {
                    $sql = "select qno from cia3questions where courseoutcomecode='" . $row['courseoutcomecode'] . "' AND  coursecode='" . $coursecode . "'";
                }
                echo $sql;
                $result1 = $mysqli->query($sql);
                $sco    = "UPDATE cia3 set " . $row['courseoutcomecode'] . "=";
                for ($j = 0; $j < mysqli_num_rows($result1); $j++) {
                    if ($j != mysqli_num_rows($result1) - 1) {
                        $row1 = $result1->fetch_assoc();
                        $sco .= "q" . $row1['qno'] . "+";
                    } else {
                        $row1 = $result1->fetch_assoc();
                        $sco .= "q" . $row1['qno'] . " where staffid='" . $staffid . "' AND coursecode='" . $coursecode . "'";
                        
                        $totalsql .= $sco . ";";
                        
                    }
                    
                }
                
            }
            
            
            
        }
        
    }  
}}
        echo $totalsql;
        $result = $mysqli->multi_query($totalsql);
?>        