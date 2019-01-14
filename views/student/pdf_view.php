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
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' Student List', PDF_HEADER_STRING);
$pdf->SetHeaderData(PDF_HEADER_LOGO, 12, PDF_HEADER_TITLE.' Student List', PDF_HEADER_STRING);

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

$pdf->Write(0, 'Student List', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// NON-BREAKING ROWS (nobr="true")

if(isset($students_fields) && !empty($students_fields)){
    $student_table = '<table border="1" cellpadding="2" cellspacing="2" align="center">';
    $student_table .= '<tr nobr="true">';
    $student_table .= "<th>Student Name</th>";
    foreach ($fields['student_fields'] as $field){
        if($field=='address_line'){
            $student_table .= "<th>Address</th>";
        }
        if($field=='batch_no'){
            $student_table .= "<th>Batch</th>";
        }
        if($field=='date_of_birth'){
            $student_table .= "<th>Date of birth</th>";
        }
        if($field=='email'){
            $student_table .= "<th>Email</th>";
        }
        if($field=='mobile_phone'){
            $student_table .= "<th>Mobile Phone</th>";
        }
        if($field=='phone'){
            $student_table .= "<th>Phone</th>";
        }
        if($field=='admission_date'){
            $student_table .= "<th>Admission Date</th>";
        }
        if($field=='blood_group'){
            $student_table .= "<th>Blood Group</th>";
        }
        if($field=='nationality'){
            $student_table .= "<th>Nationality</th>";
        }

        if($field=='created'){
            $student_table .= "<th>Registered Date</th>";
        }
    }
    $student_table .= "</tr>";
    foreach($students_fields as $field) {
        $student_table .= "<tr>";
        if(isset($field['first_name'])){
            $name = $field['first_name']." ".$field['last_name'];
            $student_table .= "<td>$name</td>";
        }
        if(isset($field['address_line'])){
            $address = $field['address_line'];
            $student_table .= "<td>$address</td>";
        }
        if(isset($field['batch_no']) ){
            $batch = $field['code'].'-'.$field['arm'].'('.$field['session'].')';
            $student_table .= "<td>$batch</td>";
        }

        if(isset($field['date_of_birth'])){
            $date_of_birth = date("l jS \of F Y",strtotime($field['date_of_birth']));
            $student_table .= "<td>$date_of_birth</td>";
        }
        if(isset($field['email'])){
            $email = $field['email'];
            $student_table .= "<td>$email</td>";
        }
        if(isset($field['mobile_phone'])){
            $mobile_phone = $field['mobile_phone'];
            $student_table .= "<td>$mobile_phone</td>";
        }
        if(isset($field['phone'])){
            $phone = $field['phone'];
            $student_table .= "<td>$phone</td>";
        }
        if(isset($field['admission_date'])){
            $admission_date = date("l jS \of F Y",strtotime($field['admission_date']));
            $student_table .= "<td>$admission_date</td>";
        }
        if(isset($field['blood_group'])){
            $blood_group = $field['blood_group'];
            $student_table .= "<td>$blood_group</td>";
        }
        if(isset($field['nationality'])){
            $nationality = $field['country_name'];
            $student_table .= "<td>$nationality</td>";
        }

        if(isset($field['created'])){
            $created = date("l jS \of F Y",strtotime($field['created']));
            $student_table .= "<td>$created</td>";
        }
        $student_table .= "</tr>";
    }

    $student_table.='</table>';

}else{
    $student_table = '<table border="1" cellpadding="2" cellspacing="2" align="center">';
    $student_table .= '<tr nobr="true">
                      <th>Name</th>
                      <th>Batch</th>
                      <th>Adm. date</th>
                     </tr>';

    foreach($students as $student) {
        $fullname = $student['surname'].' '.$student['first_name'];
        $batch = $student['code'].'-'.$student['arm'].'('.$student['session'].')';
        $admit_date = date('F d, Y', strtotime($student['admission_date']));
        $student_table .= "<tr>
                          <td>$fullname</td>
                          <td>$batch</td>
                          <td>$admit_date</td>
                         </tr>";
    }
    $student_table.='</table>';
}



$pdf->writeHTML($student_table, true, false, false, false, '');

// -----------------------------------------------------------------------------
// reset pointer to the last page
$pdf->lastPage();
//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+