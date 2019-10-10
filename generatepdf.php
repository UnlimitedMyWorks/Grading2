<?php

session_start();
if (!isset($_SESSION['staffid'])) {
    header("Location:index.php");
}
$staffid = $_SESSION['staffid'];
require('mc_table.php');
$coursecode = filter_input(INPUT_POST, 'coursecode');
require("config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$ay         = $_POST['Academicyear'];
$reg        = $_POST['regulation'];
$section    = $_POST['section'];
$sem        = $_POST['sem'];
$coursename = strtoupper($_POST['coursename']);
$pdf        = new PDF_MC_Table();
$pdf->AddPage();
$pdf->Rect(5, 5, 200, 287, 'D'); //For A4
$pdf->SetFont('Times', 'B', 16);
if (file_exists("images/image.png"))
    $pdf->Image('images/image.png', 25, 10, -150);
$pdf->Ln(60);
$pdf->Write(5, '                                            Course Delivery plan      ');
$pdf->Ln(10);
$pdf->SetWidths(array(
    90,
    90
));
$pdf->SetFont('Times', '', 14);
$pdf->Row(array(
    "Academic Year",
    $ay
));
$pdf->Row(array(
    "Year/Sem/ Sec",
    $sem . "/" . $section
));
$pdf->Row(array(
    "Course Code",
    $coursecode
));
$pdf->Row(array(
    "Course Name",
    $coursename
));
$pdf->Row(array(
    "Regulation",
    $reg
));
$sql    = "SELECT credits from coursemaster where coursecode='" . $coursecode . "'";
$result = $mysqli->query($sql);
$row    = $result->fetch_assoc();
$pdf->Row(array(
    "Course Credit",
    $row['credits']
));
$sql    = "SELECT `name` from staffmaster where staffid='" . $staffid . "'";
$result = $mysqli->query($sql);
$row    = $result->fetch_assoc();
$pdf->Row(array(
    "Course Faculty",
    $row['name']
));
$pdf->Ln(10);
if (file_exists('uploads/' . $_SESSION['staffid'] . '_timetable.jpg')) {
$pdf->Image('uploads/' . $_SESSION['staffid'] . '_timetable.jpg', 30, NULL, 150);
}
$pdf->Ln(10);
$pos = strpos($coursename, "LAB");
if ($pos === false) {
    $pdf->Write(5, 'Tentative dates for Continuous Internal Assessments (CIA)');
    $pdf->Ln(10);
    $pdf->Write(5, 'CIA I        :' . $_POST['CIAIfrom'] . ' to ' . $_POST['CIAIto']);
    $pdf->Ln(5);
    $pdf->Write(5, 'CIA II       :' . $_POST['CIAIIfrom'] . ' to ' . $_POST['CIAIIto']);
    $pdf->Ln(5);
    $pdf->Write(5, 'CIA III      :' . $_POST['CIAIIIfrom'] . ' to ' . $_POST['CIAIIIto']);
}

//Page 1 Ends

$sql        = "SELECT coursename from coursemaster where coursecode='" . $coursecode . "'";
$result     = $mysqli->query($sql);
$row        = $result->fetch_assoc();
$coursename = strtoupper($row['coursename']);
if (file_exists("uploads/" . $coursecode . "_prereq.jpg")) {
    $pdf->AddPage();
    $pdf->SetFont('Times', 'B', 15);
    $pdf->Write(10, 'PRE-REQUISITE CHART');
    $pdf->Image("uploads/" . $coursecode . "_prereq.jpg", 10, 20, 200);
}
//Page Ends
$pos = strpos($coursename, "LAB");
if ($pos === false) {
    $pdf->AddPage();
    $pdf->SetFont('Times', 'B', 15);
    $pdf->SetWidths(array(
        90,
        90
    ));
    $pdf->Ln(100);
    $pdf->Row(array(
        " MODE OF DELIVERY                                  ",
        "ASSESSMENT COMPONENTS                                        "
    ));
    $pdf->SetFont('Times', '', 12);
    $pdf->Row(array(
        "MD 1. Oral presentation",
        "AC 1. CIA"
    ));
    $pdf->Row(array(
        "MD 2. Tutoria",
        "AC 2. Assignment"
    ));
    $pdf->Row(array(
        "MD 3. Hands on/Demonstration",
        "AC 3. Course Seminar"
    ));
    $pdf->Row(array(
        "MD 4. Seminar/Guest lecture",
        "AC 4. Course Quiz"
    ));
    $pdf->Row(array(
        "MD 5. Videos",
        "AC 5. Case Study"
    ));
    $pdf->Row(array(
        "",
        "AC 6. Record Work"
    ));
    $pdf->Row(array(
        "",
        "AC 7. Lab / Mini Project"
    ));
    $pdf->Row(array(
        "",
        "AC 8. Lab Model Exam"
    ));
}

//Page 2 Ends

if (file_exists('uploads/' . $coursecode . '__conceptmap.jpg')) {
    $pdf->AddPage();
    $pdf->Image('uploads/' . $coursecode . '__conceptmap.jpg', 0, 0, 200, 280);
}
/* i aknow im tatti fow wha the actions i doo but this is extremely booring so i dont know what to do so suck a dick lick my ball sack i dont know i am writing some shitty eminem lyrics.*/
$pdf->AddPage('L');
$pdf->SetFont('Times', 'B', 14);
$pdf->Write(5, 'COURSE OUTCOMES:');
$pdf->Ln(5);
$pdf->Write(5, 'After successful completion o the course, the students should be able to');
$pdf->Ln(10);
$pdf->SetFont('Times', '', 14);
$pdf->SetWidths(array(
    220,
    54
));
$pdf->Row(array(
    "      Course Outcomes                                           ",
    "                                           Highest Cognitive Level"
));
$pdf->SetWidths(array(
    50,
    170,
    54
));
$sql    = "SELECT * FROM cohclmapping WHERE coursecode='" . $coursecode . "'";
$result = $mysqli->query($sql);
for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    $row = $result->fetch_assoc();
    $pdf->Row(array(
        $row['coursecode'] . $row['courseoutcomecode'],
        $row['courseoutcome'],
        $row['highcoglevel']
    ));
}
$pdf->Ln(10);
$pdf->SetFont('Times', 'B', 14);
$pdf->Write(5, 'MAPPING OF COURSE OUTCOMES WITH PROGRAM OUTCOMES:');
$pdf->Ln(10);

$pdf->SetWidths(array(
    40,
    23,
    16,
    20,
    23,
    23,
    22,
    23,
    23,
    20,
    20,
    20
));
$pdf->Row(array("Course outcomes","CO Level","PO1","PO2","PO3","PO4","PO5","PO6","PO7","PO8","PSO1","PSO2"));
$pdf->SetFont('Times', '', 14);
$pdf->Ln(0);
$sql    = "SELECT * FROM `programmmeoutcomemapping` WHERE coursecode='" . $coursecode . "' ORDER BY `courseoutcomecode` ASC";
$result = $mysqli->query($sql);
for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    $row = $result->fetch_assoc();
    $pdf->Row(array(
        $row['coursecode'] . "." . $row['courseoutcomecode'],
        $row['hcl'],
        $row['PO1'],
        $row['PO2'],
        $row['PO3'],
        $row['PO4'],
        $row['PO5'],
        $row['PO6'],
        $row['PO7'],
        $row['PO8'],
        $row['PSO1'],
        $row['PSO2']
    ));
}

//Page Ends

$pdf->AddPage('L');
$pdf->SetFont('Times', 'B', 14);
$pdf->Write(5, 'ASSESSMENT WEIGHTAGE COMPONENTS:');
$pdf->Ln(10);
$pdf->SetWidths(array(
    100,
    54,
    102
));
$pdf->Row(array(
    "                  Assessment components",
    "    TARGET LEVEL %",
    "                    % OF STUDENTS                    LEVEL1                  LEVEL2            LEVEL3 "
));
$pdf->SetFont('Times', '', 14);
$pdf->SetWidths(array(
    100,
    54,
    34,
    34,
    34
));
$sql    = "SELECT DISTINCT `assesmentcomponents`,`target_level`,`L1`,`L2`,`L3` FROM `assesmentweightagecomponents` WHERE coursecode='" . $coursecode . "'";
$result = $mysqli->query($sql);
for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    $row = $result->fetch_assoc();
    $pdf->Row(array(
        $row['assesmentcomponents'],
        $row['target_level'],
        $row['L1'],
        $row['L2'],
        $row['L3']
    ));
}
$pdf->Ln(5);
$pdf->SetFont('Times', 'B', 14);
$pdf->Write(5, 'Note: Based on subject University Grade may be fixed either C or D.');
$pdf->Ln(10);
$pdf->Write(5, 'CO EVALUATION WEIGHTAGE:');
$pdf->Ln(5);
$pdf->SetWidths(array(
    75,
    25,
    25,
    25,
    25,
    25,
    25
));
$pdf->Row(array(
    "           Evaluation Process",
    "     CO1      ",
    "     CO2      ",
    "     CO3      ",
    "     CO4      ",
    "     CO5      ",
    "     CO6      "
));
$sql    = "SELECT * FROM `coevaluationweightage` WHERE coursecode='" . $coursecode . "'";
$result = $mysqli->query($sql);
$pdf->SetFont('Times', '', 14);
for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    $row = $result->fetch_assoc();
    $pdf->Row(array(
        $row['assesment_components'],
        $row['CO1'],
        $row['CO2'],
        $row['CO3'],
        $row['CO4'],
        $row['CO5'],
        $row['CO6']
    ));
}
//Page ends
if (file_exists('uploads/' . $coursecode . '__syllabus_PAGE1.jpg')) {
    $pdf->AddPage();
    $pdf->Image('uploads/' . $coursecode . '__syllabus_PAGE1.jpg', 0, 0, 200, 280);
}
if (file_exists('uploads/' . $coursecode . '__syllabus_PAGE2.jpg')) {
    $pdf->AddPage();
    $pdf->Image('uploads/' . $coursecode . '__syllabus_PAGE2.jpg', 0, 0, 200, 280);
}
if (file_exists('uploads/' . $coursecode . '__syllabus_PAGE3.jpg')) {
    $pdf->AddPage();
    $pdf->Image('uploads/' . $coursecode . '__syllabus_PAGE3.jpg', 0, 0, 200, 280);
}

$pos = strpos($coursename, "LAB");
if ($pos === false) {
    $sql    = "SELECT * FROM `coursedeliveryplan` where unit='UNIT1' AND coursecode='" . $coursecode . "' AND staffid='" . $staffid . "'";
    $result = $mysqli->query($sql);
    $pdf->AddPage('L');
    $pdf->SetFont('Times', 'B', 15);
    $pdf->Rect(5, 10, 287, 200, 'D');
    $pdf->Ln(3);
    $pdf->Write(5, '                                                                                                     UNIT 1');
    $pdf->SetFont('Times', 'B', 15);
    $pdf->Ln(10);
    $pdf->SetWidths(array(
        15,
        40,
        60,
        40,
        26,
        15,
        15,
        25,
        25
    ));
    $pdf->Row(array(
        "SNo",
        "Proposed Period",
        "Topic",
        "Actual Period",
        "Pertaining CO",
        "HCL",
        "MOD",
        "Delivery Resources",
        "Remarks"
    ));
    $pdf->SetFont('Times', '', 12);
    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        
        $row = $result->fetch_assoc();
        $pdf->Row(array(
            $row['sno'],
            $row['proposed_period'],
            $row['topic'],
            "",
            $row['pertaining_co'],
            $row['hcl'],
            $row['md'],
            $row['delivery_resources'],
            ""
        ));
    }
    $sql     = "SELECT DISTINCT learning_outcomes FROM `coursedeliveryplan` where unit='UNIT1'  AND coursecode='" . $coursecode . "' AND staffid='" . $staffid . "'";
    $result1 = $mysqli->query($sql);
    $lu      = '';
    for ($i = 1; $i <= mysqli_num_rows($result1); $i++) {
        $row = $result1->fetch_assoc();
        $lu .= $i . ". " . $row['learning_outcomes'] . "\n";
    }
    $pdf->SetWidths(array(
        55,
        206
    ));
    $pdf->Row(array(
        "Learning outcomes",
        $lu
    ));
    $pdf->SetWidths(array(
        55,
        103,
        103
    ));
    $pdf->Row(array(
        "Total no of hours:" . mysqli_num_rows($result),
        "Total no hours taken :",
        "Staff Signature"
    ));
    //Page Ends
    
    $sql    = "SELECT * FROM `coursedeliveryplan` where unit='UNIT2' AND coursecode='" . $coursecode . "' AND staffid='" . $staffid . "'";
    $result = $mysqli->query($sql);
    $pdf->AddPage('L');
    $pdf->SetFont('Times', 'B', 15);
    $pdf->Rect(5, 10, 287, 200, 'D');
    $pdf->Ln(3);
    $pdf->Write(5, '                                                                                                     UNIT 2');
    $pdf->SetFont('Times', 'B', 15);
    $pdf->Ln(10);
    $pdf->SetWidths(array(
        15,
        40,
        60,
        40,
        26,
        15,
        15,
        25,
        25
    ));
    $pdf->Row(array(
        "SNo",
        "Proposed Period",
        "Topic",
        "Actual Period",
        "Pertaining CO",
        "HCL",
        "MOD",
        "Delivery Resources",
        "Remarks"
    ));
    $pdf->SetFont('Times', '', 12);
    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        
        $row = $result->fetch_assoc();
        $pdf->Row(array(
            $row['sno'],
            $row['proposed_period'],
            $row['topic'],
            "",
            $row['pertaining_co'],
            $row['hcl'],
            $row['md'],
            $row['delivery_resources'],
            ""
        ));
    }
    $sql     = "SELECT DISTINCT learning_outcomes FROM `coursedeliveryplan` where unit='UNIT2' AND coursecode='" . $coursecode . "' AND staffid='" . $staffid . "'";
    $result1 = $mysqli->query($sql);
    $lu      = '';
    for ($i = 1; $i <= mysqli_num_rows($result1); $i++) {
        $row = $result1->fetch_assoc();
        $lu .= $i . ". " . $row['learning_outcomes'] . "\n";
    }
    $pdf->SetWidths(array(
        55,
        206
    ));
    $pdf->Row(array(
        "Learning outcomes",
        $lu
    ));
    $pdf->SetWidths(array(
        55,
        103,
        103
    ));
    $pdf->Row(array(
        "Total no of hours:" . mysqli_num_rows($result),
        "Total no hours taken :",
        "Staff Signature"
    ));
    //Page Ends
    
    $sql    = "SELECT * FROM `coursedeliveryplan` where unit='UNIT3' AND coursecode='" . $coursecode . "' AND staffid='" . $staffid . "'";
    $result = $mysqli->query($sql);
    $pdf->AddPage('L');
    $pdf->SetFont('Times', 'B', 15);
    $pdf->Rect(5, 10, 287, 200, 'D');
    $pdf->Ln(3);
    $pdf->Write(5, '                                                                                                     UNIT 3');
    $pdf->SetFont('Times', 'B', 15);
    $pdf->Ln(10);
    $pdf->SetWidths(array(
        15,
        40,
        60,
        40,
        26,
        15,
        15,
        25,
        25
    ));
    $pdf->Row(array(
        "SNo",
        "Proposed Period",
        "Topic",
        "Actual Period",
        "Pertaining CO",
        "HCL",
        "MOD",
        "Delivery Resources",
        "Remarks"
    ));
    $pdf->SetFont('Times', '', 12);
    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        
        $row = $result->fetch_assoc();
        $pdf->Row(array(
            $row['sno'],
            $row['proposed_period'],
            $row['topic'],
            "",
            $row['pertaining_co'],
            $row['hcl'],
            $row['md'],
            $row['delivery_resources'],
            ""
        ));
    }
    $sql     = "SELECT DISTINCT learning_outcomes FROM `coursedeliveryplan` where unit='UNIT3' AND coursecode='" . $coursecode . "' AND staffid='" . $staffid . "'";
    $result1 = $mysqli->query($sql);
    $lu      = '';
    for ($i = 1; $i <= mysqli_num_rows($result1); $i++) {
        $row = $result1->fetch_assoc();
        $lu .= $i . ". " . $row['learning_outcomes'] . "\n";
    }
    $pdf->SetWidths(array(
        55,
        206
    ));
    $pdf->Row(array(
        "Learning outcomes",
        $lu
    ));
    $pdf->SetWidths(array(
        55,
        103,
        103
    ));
    $pdf->Row(array(
        "Total no of hours:" . mysqli_num_rows($result),
        "Total no hours taken :",
        "Staff Signature"
    ));
    //Page Ends
    
    $sql    = "SELECT * FROM `coursedeliveryplan` where unit='UNIT4' AND coursecode='" . $coursecode . "' AND staffid='" . $staffid . "'";
    $result = $mysqli->query($sql);
    $pdf->AddPage('L');
    $pdf->SetFont('Times', 'B', 15);
    $pdf->Rect(5, 10, 287, 200, 'D');
    $pdf->Ln(3);
    $pdf->Write(5, '                                                                                                     UNIT 4');
    $pdf->SetFont('Times', 'B', 15);
    $pdf->Ln(10);
    $pdf->SetWidths(array(
        15,
        40,
        60,
        40,
        26,
        15,
        15,
        25,
        25
    ));
    $pdf->Row(array(
        "SNo",
        "Proposed Period",
        "Topic",
        "Actual Period",
        "Pertaining CO",
        "HCL",
        "MOD",
        "Delivery Resources",
        "Remarks"
    ));
    $pdf->SetFont('Times', '', 12);
    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        
        $row = $result->fetch_assoc();
        $pdf->Row(array(
            $row['sno'],
            $row['proposed_period'],
            $row['topic'],
            "",
            $row['pertaining_co'],
            $row['hcl'],
            $row['md'],
            $row['delivery_resources'],
            ""
        ));
    }
    $sql     = "SELECT DISTINCT learning_outcomes FROM `coursedeliveryplan` where unit='UNIT4' AND coursecode='" . $coursecode . "' AND staffid='" . $staffid . "'";
    $result1 = $mysqli->query($sql);
    $lu      = '';
    for ($i = 1; $i <= mysqli_num_rows($result1); $i++) {
        $row = $result1->fetch_assoc();
        $lu .= $i . ". " . $row['learning_outcomes'] . "\n";
    }
    $pdf->SetWidths(array(
        55,
        206
    ));
    $pdf->Row(array(
        "Learning outcomes",
        $lu
    ));
    $pdf->SetWidths(array(
        55,
        103,
        103
    ));
    $pdf->Row(array(
        "Total no of hours:" . mysqli_num_rows($result),
        "Total no hours taken :",
        "Staff Signature"
    ));
    
    $root         = getcwd();
    $targetfolder = $root . "\uploads/" . $coursecode . ".pdf";
    
}

$pdf->Output();

?>
 
