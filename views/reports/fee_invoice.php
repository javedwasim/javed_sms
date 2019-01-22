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
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , '');

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

$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

$fee_name = $result['fee']['fee_name'];
$description = $result['fee']['description'];
$due_date = $result['fee']['due_date'];
$amount_paid = $result['fee']['amount_paid'];
$charged = $result['fee']['amount'];
$paid_at = date('F j, y',strtotime($result['fee']['created_at']));
if(!empty($first_name)){
    $student_name = $student['first_name'].' '.$student['surname'].'('.$student['username'].')';

}else{
    $students = $result['student_list'];
    $student_list = '';
    $counter = 1;
    foreach($students as $student){
        $student_list.=$student['first_name'].' '.$student['surname'].'('.$student['username'].')';
        if(count($students)>$counter){
            $student_list .= ', ';
        }
        $counter++;
    }
    $student_name = $student_list;
}

$username = $student['username'];
$fee_id = $result['fee']['id'];
$institution = $institution['name'];
//print_r($institution); die();

$student_info='
<style>
table {  
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 100%; 
    border-collapse: 
    collapse; border-spacing: 0; 
    border: 1px solid black;
}
th {  
    border: 1px solid transparent; /* No more visible border */
    height: 30px;
    transition: all 0.3s;  /* Simple transition for hover effect */    
    font-weight: bold;
    font-size: 16px;
}
td {  
    border: 1px solid transparent; /* No more visible border */
    height: 30px;
    transition: all 0.3s;  /* Simple transition for hover effect */
    background: red;
    text-align: center;
    font-size: 16px;
}
/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; }  
    .field-value{
        border: none;
    }
</style>';
$student_info.='
<table style="width: 100%; ">
    <thead>
        <tr>
        <th class="field-label" colspan="4" style="text-align: center;background-color: #DFDFDF;  ">
            <h1>Receipt</h1></th>
        </tr>
    </thead>
    <tbody>     
        <tr>            
            <td class="field-value" colspan="5"></td>                               
        </tr>
        <tr>
            <th class="field-value">REFERENCE</th>
            <td class="field-value">'.$fee_id.'</td>
            <td class="field-value" colspan="2">'.$institution.'</td> 
                              
        </tr>
        <tr>
            <th class="field-value">Student</th>
            <td class="field-value">'.$student_name.'</td>  
            <td class="field-value" colspan="2"></td> 
        </tr>
        <tr>
            <th class="field-value">Date</th>
            <td class="field-value">'.$paid_at.'</td>   
            <td class="field-value" colspan="2"></td> 
        </tr>
    </tbody>
</table>';
$pdf->writeHTML($student_info, true, false, true, false, '');

$fee_table ='<style>
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
    font-size: 16px;
}
td {  
    border: 1px solid transparent; /* No more visible border */
    height: 30px;
    transition: all 0.3s;  /* Simple transition for hover effect */
    background: red;
    text-align: left;
    font-size: 16px;
}
/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; }  
    
</style>';

$fee_table .= '<table style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Desc</th>
                        <th>Due Date</th>
                        <th>Charged</th>
                        <th>Paid</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>'.$fee_name.'</td>
                            <td>'.$description.'</td>
                            <td>'.$due_date.'</td>
                            <td>'.$charged.'</td>
                            <td>'.$amount_paid.'</td>                            
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th>TOTAL PAID</th>
                            <th>'.$amount_paid.'</th>
                        </tr>
                        
                    </tbody>
                </table>';


$pdf->writeHTML($fee_table, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();
//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+