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

$inst_email = $institution['email'];
$inst_name = $institution['name'];
$inst_subdomain = $institution['subdomain'];
$inst_phone = $institution['phone'];
$inst_address = $institution['address']."\n Email:".$inst_email." TEL: ".$inst_phone;

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ISMS - isms.com');
$pdf->SetTitle('Student List');
$pdf->SetSubject('ISMS');
$pdf->SetKeywords('ISMS, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . $inst_name, PDF_HEADER_STRING);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . $inst_name, $inst_address);

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
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
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
$st_name = isset($student) ? $student['surname'] . ' ' . $student['first_name'] . ' ' . $student['last_name'] : '';
$adm_no = $student['username'];
$gender = $student['gender'];
$batch = isset($student) ? $student['code'] . '-' . $student['arm'] . '(' . $student['session'] . ')' : '';
$session = $student['session'];
$principal_comment = $comment['principal']['comment'];
$class_teacher = $class_teacher['employees'];
$teacher_comment = $comment['teacher']['comment'];
$average = $summary['percentage'];
$position = $summary['position'];
$grade = $summary['grade'];
$roll_no = $summary['roll_no'];
$teacher = $subjects[0]['subject_teacher'];

if (isset($term_id) && ($term_id == 1)):
    $next_term = date('F j, Y', strtotime($student['second_term_start']));
    $term = 'First Term Report';
elseif (isset($term_id) && ($term_id == 2)):
    $term = 'Second Term Report';
    $next_term = date('F j, Y', strtotime($student['third_term_start']));
else:
    $term = 'Third Term Report';
endif;

$student_score = json_decode($behaviour_score['student_behavioural_score'], true);
unset($student_score['student_id']);
unset($student_score['grade_scale_id']);
unset($student_score['term_id']);

$present = $attendance_record['present'];
$absent = $attendance_record['absent'];
$late = $attendance_record['late'];

$student_info='
<style>
table {  
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 100%; 
    border-collapse: 
    collapse; border-spacing: 0; 
}
th {  
    border: 1px solid transparent; /* No more visible border */
    height: 15px;
    transition: all 0.3s;  /* Simple transition for hover effect */
    background-color: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
    font-size: 12px;
}
td {  
    border: 1px solid transparent; /* No more visible border */
    height: 15px;
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
$student_info.='
<table style="width: 100%;">
    <thead><tr><th class="field-label" colspan="4" style="text-align: center"><h3>Student Information</h3></th></tr></thead>
    <tbody>        
        <tr>
            <th class="field-label">Name</th>
            <td class="field-value">' . $st_name . '</td>  
            <th class="field-label">Exam</th>
            <td class="field-value">' . $term . '</td> 
                              
        </tr>
        <tr>
            <th class="field-label">Adm. No.</th>
            <td class="field-value">' . $adm_no . '</td>  
            <th class="field-label">Session</th>
            <td class="field-value">' . $session . '</td>  
        </tr>
        <tr>
            <th class="field-label">Gender</th>
            <td class="field-value">' . $gender . '</td>   
            <th class="field-label">Class</th>
            <td class="field-value">' . $batch . '</td> 
        </tr>
    </tbody>
</table>';
$pdf->writeHTML($student_info, true, false, true, false, '');
// create columns content
$left_column = '
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
    height: auto;
    transition: all 0.3s;  /* Simple transition for hover effect */
    background-color: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
    font-size: 12px;
}
td {  
    border: 1px solid transparent; /* No more visible border */
    height: 15px;
    transition: all 0.3s;  /* Simple transition for hover effect */
    background: red;
    text-align: center;
    font-size: 8px;
}
/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; }  
    
</style>';
$right_column = '
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
    height: 15px;
    transition: all 0.3s;  /* Simple transition for hover effect */
    background-color: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
    font-size: 12px;
}
td {  
    border: 1px solid transparent; /* No more visible border */
    height: 15px;
    transition: all 0.3s;  /* Simple transition for hover effect */
    background: red;
    text-align: left;
    font-size: 10px;
}
/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; }  
    
</style>';
$left_column .= '<!-- EXAMPLE OF CSS STYLE -->
<table style="width: 100%;">
    <thead>
        <tr><th colspan="6"><h3 style="text-align: center">Score Sheet</h3></th></tr>
        <tr>
            <th>Subjects</th>
            <th scope="col">1st</th>
            <th scope="col">2nd</th>
            <th scope="col">Final</th>
            <th scope="col">Total</th>
            <th scope="col">Teachers</th>
        </tr>
    </thead>
    <tbody>';
foreach ($subjects as $subject):
    $score = explode(',', $subject['st_score']);
    $subjects = $subject['sbj_name'];
    $final = isset($score[0]) && !empty($score[0]) ? $score[0] : 'EX';
    $second = isset($score[1]) ? $score[1] : 'EX';
    $first = isset($score[2]) ? $score[2] : 'EX';
    $total = isset($score[0]) && isset($score[1]) && isset($score[2]) ? $score[0] + $score[1] + $score[2] : 'EX';;
    $teacher = $subject['subject_teacher'];
    $left_column .= '<tr>
                <td>' . $subjects . '</td>
                <td>' . $first . '</td>
                <td>' . $second . '</td>
                <td>' . $final . '</td>
                <td>' . $total . '</td>
                <td>' . $teacher . '</td>
            </tr>';
endforeach;
$left_column .= '</tbody></table>';

$right_column .= '<table style="width: 100%;">
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
if (!empty($student_score)) {
    foreach ($student_score as $key => $value):
        $right_column .=
            '<tr>
               <td>' . str_replace('_', ' ', ucfirst($key)) . '</td>';
                foreach ($scale as $s): $s_name = $s['name'];
                    if ($s["id"] == $value):
                        $right_column .= '<td>' . $s_name . '</td>';
                    endif;
                endforeach;
        $right_column .= '</tr>';
    endforeach;
}
$right_column .= '</tbody></table>';

//$right_column = '<b>RIGHT COLUMN</b> right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column right column';

// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// get current vertical position
$y = $pdf->getY();

// set color for background
$pdf->SetFillColor(255, 255, 255);

// set color for text
$pdf->SetTextColor(0, 63, 127);

// write the first column
$pdf->writeHTMLCell(120, '', '', $y, $left_column, 0, 0, 1, true, 'J', true);

// set color for background
$pdf->SetFillColor(255, 255, 255);

// set color for text
$pdf->SetTextColor(127, 31, 0);

// write the second column
$pdf->writeHTMLCell(60, '', '', '', $right_column, 0, 1, 1, true, 'J', true);


$grade_info='
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
    height: 15px;
    transition: all 0.3s;  /* Simple transition for hover effect */
    background-color: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
    font-size: 12px;
}
td {  
    border: 1px solid transparent; /* No more visible border */
    height: 15px;
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
$grade_info .= '<table style="width: 100%">
                <thead>
                    <tr>
                        <th colspan="2"><h3 style="text-align: center">Report Summary</h3></th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>Grade: Excellent(A):90-100, Very Good(B):80-89, Good(C):70-79,Pass(D):60-69, Fail(E):0-59</strong>
                        </td>
                    </tr>      
                </thead>
                 <tbody>
                    <tr><th>Average</th><td>' . round($average) . '%</td></tr>
                    <tr><th>Overall Report</th><td>' . $grade . '</td></tr>
                    <tr><th>Position in class</th><td>' . $position . '</td></tr>
                    <tr><th>No. in class</th><td>' . $roll_no . '</td></tr>
                </tbody>
                </table>';

$attendance_info='
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
    height: 15px;
    transition: all 0.3s;  /* Simple transition for hover effect */
    background-color: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
    font-size: 12px;
}
td {  
    border: 1px solid transparent; /* No more visible border */
    height: 15px;
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

$attendance_info.='<table style="width: 100%">
            <thead>
                <tr>
                    <th colspan="2"><h3 style="text-align: center">Attendance Report</h3></th>
                </tr>
            </thead>
            <tbody>
                <tr><th>Present</th><td>' . $present . '</td></tr>
                <tr><th>Absent</th><td>' . $absent . '</td></tr>
                <tr><th>Late</th><td>' . $late . '</td></tr>
                <tr><th>Percentage</th><td>' . round($present/($present+$absent+$late)*100) . '%</td></tr>                
            </tbody>
            </table>';
// get current vertical position
$pdf->writeHTMLCell(100, '', '', 180, $grade_info, 0, 0, 1, true, 'J', true);
// write the second column
$pdf->writeHTMLCell(80, '', '', '', $attendance_info, 0, 1, 1, true, 'J', true);

$p_comments = '
<style>
table {  
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 100%; 
    border-collapse: 
    collapse; border-spacing: 0; 
}
th {  
    border: 1px solid transparent; /* No more visible border */
    height: 15px;
    transition: all 0.3s;  /* Simple transition for hover effect */
    background-color: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
    font-size: 12px;
}
td {  
    border: 1px solid transparent; /* No more visible border */
    height: 15px;
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

$p_comments .= '<table>
                <thead>
                    <tr>
                        <th>Principal\'s comment —  </th>        
                    </tr>
                </thead>        
                <tbody>
                    <tr>
                        <td>' . $principal_comment . '</td>
                    </tr>
                </tbody>        
            </table>';
//$pdf->writeHTML($comments, true, false, true, false, true);
$pdf->writeHTMLCell(180, '', '', 215, $p_comments, 0, 1, 1, true, 'J', true);

$t_comments = '<style>
table {  
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 100%; 
    border-collapse: 
    collapse; border-spacing: 0; 
}
th {  
    border: 1px solid transparent; /* No more visible border */
    height: 15px;
    transition: all 0.3s;  /* Simple transition for hover effect */
    background-color: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
    font-size: 12px;
}
td {  
    border: 1px solid transparent; /* No more visible border */
    height: 15px;
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


$t_comments .= '<table style="width: 100%">
                <thead>
                    <tr>
                        <th>Class Teacher\'s comment — ' . $teacher . ' </th>        
                    </tr>
                </thead>        
                <tbody>
                    <tr>
                        <td>' . $teacher_comment . '</td>
                    </tr>
                </tbody>        
                </table>';


$pdf->writeHTMLCell(180, '', '', 225, $t_comments, 0, 1, 1, true, 'J', true);

$next_term_start = '<style>
table {  
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 100%; 
    border-collapse: 
    collapse; border-spacing: 0; 
}
th {  
    border: 1px solid transparent; /* No more visible border */
    height: 15px;
    transition: all 0.3s;  /* Simple transition for hover effect */
    background-color: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
    font-size: 12px;
}
td {  
    border: 1px solid transparent; /* No more visible border */
    height: 15px;
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

$next_term_start.='<table style="width: 100%">
                <thead>
                    <tr>
                        <th>Nexr Term Start </th>        
                    </tr>
                </thead>        
                <tbody>
                    <tr>
                        <td>' . $next_term . '</td>
                    </tr>
                </tbody>        
                </table>';

$pdf->writeHTMLCell(180, '', '', 240, $next_term_start, 0, 1, 1, true, 'J', true);

$signature='<table border="0" width="100%">
            <tbody>      
              <tr><td style="border: none;">&nbsp;</td></tr>
              <tr>
                <td height="64" style="font-family:Helvetica, Arial, sans-serif; border: none; font-size:18px; text-align:right; width: 55%; " >
                  <hr>
                  <em style="font-size:17px; font-weight:400; text-align: center">Principal</em>
                </td>
              </tr>
            </tbody>
          </table>';

//$pdf->writeHTML($comments, true, false, true, false, true);
$pdf->writeHTMLCell(180, '', '', 250, $signature, 0, 1, 1, true, 'J', true);

// -----------------------------------------------------------------------------
// reset pointer to the last page
$pdf->lastPage();
//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+