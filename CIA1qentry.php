<?php include('header.php');include("config.php");?>
      <!-- main content start-->
      <div id="page-wrapper">
      <div class="main-page">
      <h2 class="title1">CIA I</h2>
      <form method="post">
         <div class ="grids widget-shadow">
         <div class="form-group">
         <div class = "row">
            <label for="Question No" class="col-sm-2 control-label">Question No</label>
            <div class="col-sm-8">
               <input type="text" class="form-control1"  name= "add_qno">
            </div>
         </div>
         <div class="form-group">
            <div class = "row">
               <label for="Question " class="col-sm-2 control-label">Question </label>
               <div class="col-sm-8">
                  <input type="text" class="form-control1"  name= "add_qn">
               </div>
            </div>
            
               
                  <div class="form-group">
                     <div class = "row">
                        <label for="Course Outcome No" class="col-sm-2 control-label">Course Outcome Number</label>
                        <div class="col-sm-8">
                        <select name='add_cono'>
                           <option value='CO1'>CO1</option>
                           <option value='CO2'>CO2</option>
                           <option value='CO3'>CO3</option>
                           <option value='CO4'>CO4</option>
                           <option value='CO5'>CO5</option>
                           <option value='CO6'>CO6</option>
                        </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class = "row">
                           <label for="Course Outcome Weightage " class="col-sm-2 control-label">Blooms Level</label>
                           <div class="col-sm-8">
                             <?php echo "<select name='hcl'>";
                                                echo "<option value='K1'>K1-Remember</option><option value='K2'>K2-Understand</option><option value='K3'>K3-Apply</option><option value='K4'>K4-Analyse</option><option value='K5'>K5-Evaluate</option><option value='K6'>K6-Create</option>";
                                                echo "<select>"; ?>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class = "row">
                           <label for="Course Outcome No" class="col-sm-2 control-label">Question Marks</label> 
                           <label class="radio-inline">
                           <input type="radio" name="PART" value='2' onclick="document.getElementById('add_cowt').value='<?php echo 2;?>';">Part A
                           </label>
                           <label class="radio-inline">
                           <input type="radio" name="PART" value='10'onclick=" document.getElementById('add_cowt').value=''">Part B
                           </label> 
                        </div>
                     </div>
                  
                     <div class="form-group">
                        <div class = "row">
                           <label for="Course Outcome Weightage " class="col-sm-2 control-label">Marks</label>
                           <div class="col-sm-8">
                              <input type="text" class="form-control1"  name= "add_cowt" id="add_cowt">
                           </div>
                        </div>
                     </div>
                     
                     <div class ="form-group">
                        <div class = "row">
                           <div class = "col-md-12 text-center">
                           <input type="hidden" name="groupforfirstyear" value=<?php echo $_GET['group'];?>>
                              <button type = "submit" class = "btn btn-danger" name="coursecode1" value="<?php echo filter_input(INPUT_GET,'coursecode') ?>">Submit</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
      </form>
      </div>  
      </div>
      <?php
      if(isset($_POST['coursecode1']))
        {
        
       
        
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        $qno=filter_input(INPUT_POST ,'add_qno');
        $qname=filter_input(INPUT_POST,'add_qn');
        $cocd=filter_input(INPUT_POST,'coursecode1');
        
        $cono=filter_input(INPUT_POST,'add_cono');
        $cowt=(int)filter_input(INPUT_POST,'add_cowt');
        

                     
                     
                     
                     if($cocd=='CSE201')
                     {
                        $group=$_POST['groupforfirstyear'];
                        $sql1="INSERT INTO `cia1questions`(`coursecode`, `qno`, `qname`,  `courseoutcomecode`, `groupforfirstyear`,`weightage`) VALUES ('$cocd','$qno','$qname','$cono','$group','$cowt')";
                     }
                     else
                     $sql1="INSERT INTO `cia1questions`(`coursecode`, `qno`, `qname`,  `courseoutcomecode`, `weightage`) VALUES ('$cocd','$qno','$qname','$cono','$cowt')";
            
          
            $result1=$mysqli->query($sql1);
            
            if($result1==true )
            {
               //echo "<script> alert('success entry');window.location = 'cia1qentry.php?coursecode=".$cocd."';</script>" ;
            }
            else
            {
               //echo "<script>window.location = 'cia1qentry.php?coursecode=".$cocd."'; </script>";
            }
        }
?>
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
