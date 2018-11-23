<?php
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ISMS - isms.com');
$pdf->SetTitle('Student List');
$pdf->SetSubject('ISMS');
$pdf->SetKeywords('ISMS, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' Student List', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

$pdf->Write(0, 'Student Report', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// NON-BREAKING ROWS (nobr="true")
$st_name = isset($student)?$student['surname'].' '.$student['first_name'].' '.$student['last_name']:'';
$adm_no = $student['username'];
$gender = $student['gender'];
$batch = isset($student)?$student['code'].'-'.$student['arm'].'('.$student['session'].')':'';
$session = $student['session'];
$principal_comment = $comment['principal']['comment'];
$class_teacher = $class_teacher['employees'];
$teacher_comment = $comment['teacher']['comment'];

if(isset($term_id) && ($term_id==1)):
$next_term = date('F j, Y', strtotime($student['second_term_start']));
$term = 'First Term Report';
elseif(isset($term_id) && ($term_id==2)):
 $term = 'Second Term Report';
 $next_term =  date('F j, Y', strtotime($student['third_term_start']));
else:
 $term = 'Third Term Report';
endif;

$student_score = json_decode($behaviour_score['student_behavioural_score'],true);
unset($student_score['student_id']);
unset($student_score['grade_scale_id']);
unset($student_score['term_id']);

$present = $attendance_record['present'];
$absent = $attendance_record['absent'];
$late = $attendance_record['late'];

$html = '
<!-- EXAMPLE OF CSS STYLE -->
<style>
    table {  
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 640px; 
    border-collapse: 
    collapse; border-spacing: 0; 
}



th {  
    border: 1px solid transparent; /* No more visible border */
    height: 30px; 
    transition: all 0.3s;  /* Simple transition for hover effect */
    background-color: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
    font-size: 12px;
}

td {  
    border: 1px solid transparent; /* No more visible border */
    height: 30px; 
    transition: all 0.3s;  /* Simple transition for hover effect */
    background: red;
    text-align: center;
    font-size: 10px;
}

/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; }  
    
</style>


<table class="first" cellpadding="4" cellspacing="6">
    <thead><tr><th class="field-label" colspan="4" style="text-align: center"><h3>Student Information</h3></th></tr></thead>
    <tbody>        
        <tr>
            <th class="field-label">Name</th>
            <td class="field-value">'.$st_name.'</td>  
            <th class="field-label">Exam</th>
            <td class="field-value">'.$term.'</td> 
                              
        </tr>
        <tr>
            <th class="field-label">Adm. No.</th>
            <td class="field-value">'.$adm_no.'</td>  
            <th class="field-label">Session</th>
            <td class="field-value">'.$session.'</td>  
        </tr>
        <tr>
            <th class="field-label">Gender</th>
            <td class="field-value">'.$gender.'</td>   
            <th class="field-label">Class</th>
            <td class="field-value">'.$batch.'</td> 
        </tr>
    </tbody>
</table>

<table cellpadding="4" cellspacing="6">
    <thead>
        <tr><th colspan="6"><h3 style="text-align: center">Score Sheet</h3></th></tr>
        <tr>
            <th>Subjects</th>
            <th scope="col">Final</th>
            <th scope="col">2nd</th>
            <th scope="col">1st</th>
            <th scope="col">Total</th>
            <th scope="col">Teachers</th>
        </tr>
    </thead>
    <tbody>';
foreach ($subjects as $subject): $score = explode(',',$subject['st_score']);
 $subjects = $subject['sbj_name'];
 $final = isset($score[0])&&!empty($score[0])?$score[0]:'EX';
 $second = isset($score[1])?$score[1]:'EX';
 $first = isset($score[2])?$score[2]:'EX';
 $total = isset($score[0])&&isset($score[1])&&isset($score[2])?$score[0]+$score[1]+$score[2]:'EX';;
 $teacher = $subject['subject_teacher'];
$html.=  '<tr>
                <td>'.$subjects.'</td>
                <td>'.$final.'</td>
                <td>'.$second.'</td>
                <td>'.$first.'</td>
                <td>'.$total.'</td>
                <td>'.$teacher.'</td>
            </tr>';
endforeach;
$html.='</tbody></table>';
$html.='<table cellpadding="4" cellspacing="6">
        <thead>
            <tr>
                <th>Principal\'s comment —  </th>        
            </tr>
        </thead>        
        <tbody>
            <tr>
                <td>'.$principal_comment.'</td>
            </tr>
        </tbody>        
        </table>';
$html.='<table cellpadding="4" cellspacing="6">
        <thead>
            <tr>
                <th>Class Teacher\'s comment — '.$teacher.' </th>        
            </tr>
        </thead>        
        <tbody>
            <tr>
                <td>'.$teacher_comment.'</td>
            </tr>
        </tbody>        
        </table>';




// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// add a page
$pdf->AddPage();

$html = '
<!-- EXAMPLE OF CSS STYLE -->
<style>
    table {  
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 640px; 
    border-collapse: 
    collapse; border-spacing: 0; 
}



th {  
    border: 1px solid transparent; /* No more visible border */
    height: 30px; 
    transition: all 0.3s;  /* Simple transition for hover effect */
    background-color: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
    font-size: 12px;
}

td {  
    border: 1px solid transparent; /* No more visible border */
    height: 30px; 
    transition: all 0.3s;  /* Simple transition for hover effect */
    background: red;
    text-align: center;
    font-size: 10px;
}

/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; }  
    
</style>';

if(!empty($student_score)){
    $html.='<table cellpadding="4" cellspacing="6">
        <thead>
            <tr>
                <th colspan="2"><h3 style="text-align: center">Behaviour Report</h3></th>
            </tr>
            <tr>
                <th>Affective</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>';
    foreach ($student_score as $key=>$value):
        $html.='<tr>
            <td>'.ucfirst($key).'</td>';
        foreach($scale as $s): $s_name = $s['name'];
            if($s["id"] == $value):
                $html.='          <td>'.$s_name.'</td>';
            endif;
        endforeach;
        $html.=   '</tr>';
    endforeach;
    $html.=   '</tbody></table>';
}



$html.='<table id="batch" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th colspan="2"><h3 style="text-align: center">Attendance Report</h3></th>
                </tr>
            </thead>
            <tbody>
                <tr><th>Present</th><td>'.$present.'</td></tr>
                <tr><th>Absent</th><td>'.$absent.'</td></tr>
                <tr><th>Late</th><td>'.$late.'</td></tr>
            </tbody>
        </table>';
$pdf->writeHTML($html, true, false, true, false, '');
// -----------------------------------------------------------------------------
// reset pointer to the last page
$pdf->lastPage();
//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+