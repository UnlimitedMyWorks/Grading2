<?php 
    include('header.php');
    include("config.php");
    ?>
<div id="page-wrapper">
<div class="main-page">
   
        <div class="panel-body widget-shadow">
        <table class="table">
        <tr>
            <th>Coursename </th>
            <th>Staff</th>
            <th>Department</th>
        </tr>
            <?php
                $result=$mysqli->query("select a.Department, a.coursename, b.name from courseadmin a inner join staffmaster b on a.staffid=b.staffid ");
                for($i=0;$i<mysqli_num_rows($result);$i++)
                {
                    $row=$result->fetch_assoc();
                    echo "<tr><td>".$row['coursename']."</td><td>".$row['Department']."</td><td>".$row['name']."</td></tr>";
                }
            ?>
        </div>
        </div>
        </div>
        <!-- side nav js -->
<script src='js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //side nav js -->
	
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
		
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
	<!-- //Bootstrap Core JavaScript -->
   
</body>
</html>