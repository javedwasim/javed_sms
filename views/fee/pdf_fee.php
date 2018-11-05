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

$pdf->Write(0, 'Student Fees', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// NON-BREAKING ROWS (nobr="true")
$html = '<table border="1" cellspacing="3" cellpadding="4">';
$html  .= "
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Batch</th>
                    <th>Title</th>
                    <th>Amount</th>
                    <th>Total</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            ";
foreach ($payments as $payment):
    $session = $payment['session'];
    $session = $payment['code']. ' '.$payment['arm'].'($session)';
    $first_name = $payment['first_name'];
    $last_name = $payment['last_name'];
    $code = $payment['code'];
    $arm = $payment['arm'];
    $title = $payment['title'];
    $amount = $payment['amount'];
    $amount_paid = $payment['amount_paid'];
    $fee_type = $payment['fee_type'];
    $status = $payment['status'];
    $date = $payment['date'];
    $class = '';
    if($payment['status']=='1'){
        $fstatus = '<span class="badge badge-danger">pending</span>';
    }elseif($payment['status']=='2'){
        $fstatus = '<span class="badge badge-danger">completed</span>';
    }else{
        $fstatus = '<span class="badge badge-warning" >fee due</span>';
        $class = 'bgcolor="#FFFF00"';
    }
$html .= "<tr>
            <td>$first_name.$last_name</td>
            <td>$session</td>
            <td>$title</td>
            <td>$amount</td>
            <td>$amount_paid</td>
            <td>$fee_type</td>
            <td $class>$fstatus</td>
            <td>$date</td>
         </tr>";
endforeach;

$html .="</tbody></table>";

$pdf->writeHTML($html, true, false, false, false, '');

// -----------------------------------------------------------------------------
// reset pointer to the last page
$pdf->lastPage();
//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+