<?php
                       
                           $var=$_GET['coursecode'];
                           
                           
                          
                           
                           if ($mysqli->connect_errno) {
                              echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                           }
                           $sql="SELECT * FROM `cia2questions` where coursecode='".$var."'";
                           $result= $mysqli->query($sql);
                           $counter=mysqli_num_rows($result);
                           if($counter > 0)
                           {
                              for($i = 0; $i < $counter; $i++){
                                 $row = $result -> fetch_assoc();
                                       echo" <tr>";
                                       echo "      <td>".$row['qno']."</td>";
                                       echo "      <td>".$row['qname']."</td>";
                                       echo "      <td>".$row['coursecode']."</td>";
                                       echo "      <td>".$row['courseoutcomecode']."</td>";
                                       echo "      <td>".$row['weightage']."</td>";
                                       echo"</tr>";
                              }
                           }
                        
                    ?>