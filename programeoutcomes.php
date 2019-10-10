<?php 
    include('header.php');
    include("config.php");
    ?>
<div id="page-wrapper">
<div class="main-page">
   
        <div class="panel-body widget-shadow">
        
        <h2 align='center'>CSE</h2>
        <table class="table">
        <tr>
            <th>PO/PSO</th>
            <th>Description</th>
        </tr>
        <tr>
            <td>PO1</td>
            <td>Solve engineering problems by applying mathematical fundamentals,
algorithm design strategies and advanced programming techniques.</td>
        </tr>
        <tr>
            <td>PO2</td>
            <td>Design, experiment, evaluate and verify computing systems catering to the
industrial and societal needs</td>
        </tr>
        <tr>
            <td>PO3</td>
            <td>Develop and apply recent tools and technologies for optimal data storage,
retrieval, analysis, and deriving knowledge from raw data</td>
        </tr>
        <tr>
            <td>PO4</td>
            <td>Analyze and assess security, privacy, cost and quality parameters in
computing solutions.</td>
        </tr>
        <tr>
            <td>PO5</td>
            <td>Build software and energy efficient hardware solutions, with appropriate
interfaces for solving complex real-world engineering problems.</td>
        </tr>
        <tr>
            <td>PO6</td>
            <td>Develop solutions individually and communicate effectively with team
members and abide by the cyber laws, professional codes and ethics to achieve
the professional objectives.</td>
        </tr>
        <tr>
            <td>PO7</td>
            <td>Analyze the local and global societal impact of technology and of the related
legal, environmental and ethical issues in computer science when making
decisions regarding their personal and professional responsibilities.</td>
        </tr>
        <tr>
            <td>PO8</td>
            <td>Engage in lifelong learning and upgrade through independent study in the
broadest context of technological change.</td>
        </tr>
        <tr>
            <td>PSO1</td>
            <td>Ability to comprehend the problem and apply various programming skills to
develop innovative and quality software product for the changing business
needs.</td>
        </tr>
        <tr>
            <td>PSO2</td>
            <td>Able to provide acceptable technical solutions for multidisciplinary areas of
engineering by utilizing the skills of Data Analytics, Cloud Computing and
Machine Learning.</td>
        </tr>
        </table>
        <br>
        <br>
        <h2 align='center'>IT</h2>
        <table class="table">
        <tr>
            <th>PO/PSO</th>
            <th>Description</th>
        </tr>
        <tr>
            <td>PO1</td>
            <td>Employ fundamental knowledge in Mathematics, Science, Engineering,
Hardware and Software, to provide solutions to engineering problems</td>
        </tr>
        <tr>
            <td>PO2</td>
            <td>Analyze complex engineering problems and design computationally
efficient optimal algorithms, meeting the requirement specification</td>
        </tr>
        <tr>
            <td>PO3</td>
            <td>Build energy efficient information systems, through requirement analysis,
problem formulation, design, implementation, testing and documentation</td>
        </tr>
        <tr>
            <td>PO4</td>
            <td>Assess information systems and their consequent effects on the society,
health, safety, legal and cultural issues</td>
        </tr>
        <tr>
            <td>PO5</td>
            <td>Apply methods to design user interfaces and develop applications for mobile
devices to make cutting edge facilities available for under privileged and
differently abled people</td>
        </tr>
        <tr>
            <td>PO6</td>
            <td>Employ advanced software tools and technologies to extract, classify,
evaluate and interpret huge data, to develop innovative solutions for
business development, following the cyber security principles</td>
        </tr>
        <tr>
            <td>PO7</td>
            <td>Demonstrate knowledge and understanding of the project management
principles, and professional codes while working in teams for developing
software Systems</td>
        </tr>
        <tr>
            <td>PO8</td>
            <td>Recognize the need for continuous learning to formulate problems from real
world and to provide feasible solutions by employing latest research
innovations and technological changes</td>
        </tr>
        <tr>
            <td>PSO1</td>
            <td>Build web-based systems incorporating aesthetics in front end, optimization in web
search and security in information retrieval</td>
        </tr>
        <tr>
            <td>PSO2</td>
            <td>Create artificially intelligent systems for multidisciplinary applications using data
analytic techniques and advanced machine learning & deep learning algorithms to
enhance the quality of human life</td>
        </tr>
        </table>
        <br>
        <br>
        <h2 align='center'>ICT</h2>
        <table class="table">
        <tr>
            <td>PO1</td>
            <td>Solve engineering problems by employing the fundamental concepts of
Mathematics & Science, Algorithms and advanced programming techniques</td>
        </tr>
        <tr>
            <td>PO2</td>
            <td>Analyse, design, build and test software solutions for industrial and scientific
applications by employing latest tools and technologies</td>
        </tr>
        <tr>
            <td>PO3</td>
            <td>Develop cyber security solutions for diversified hardware and software
platforms</td>
        </tr>
        <tr>
            <td>PO4</td>
            <td>Apprise the recent developments in Engineering and Technology through
effective presentation and articulation</td>
        </tr>
        <tr>
            <td>PO5</td>
            <td>Recognize the need for continuous learning to be globally employable</td>
        </tr>
        <tr>
            <td>PO6</td>
            <td>Develop solutions addressing social, professional, cultural, and ethical issues
involved in the use of Information and Communication technology</td>
        </tr>
        <tr>
            <td>PO7</td>
            <td>Function effectively as an individual, and in culturally divergent teams to
achieve project objectives.</td>
        </tr>
        <tr>
            <td>PO8</td>
            <td>Apply professional, legal, environmental and ethical standards in engineering
practices while developing solutions</td>
        </tr>
        <tr>
            <td>PSO1</td>
            <td>Solve engineering problems by applying principles of Computing,
Communication and Information Sciences</td>
        </tr>
        <tr>
            <td>PSO2</td>
            <td>Integrate Information, Communication, and Security Technologies for
Data Acquisition, Storage and Processing.</td>
        </tr>
        </table>
        </div>
</div>
</div>
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
<script>
    function getCourseCode()
     {
        var e = document.getElementById("getcc");
        var strUser = e.options[e.selectedIndex].value;
        return strUser;   
     }
</script>
</body>
</html>
