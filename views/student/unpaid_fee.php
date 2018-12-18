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

$pdf->Write(0, 'Unpaid Fees', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// NON-BREAKING ROWS (nobr="true")

$unpaid_fee_table = '<table id="fee_management_table"  border="1" cellspacing="3" cellpadding="4">';
$unpaid_fee_table.= '<thead>';
$unpaid_fee_table.= '<tr>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Batch</th>
                        <th>Created</th>
                        <th>Charged</th>
                        <th>Discount</th>
                        <th>Paid</th>
                        <th>Balance</th>
                    </tr>';

$unpaid_fee_table.= '</thead>';
$unpaid_fee_table.= '<tbody>';
foreach ($fees as $fee):
    $fee_name = $fee['fee_name'];
    $description = $fee['description'];
    $start_date = date('F j, Y',strtotime($fee['start_date']));
    $due_date = date('F j, Y',strtotime($fee['due_date']));
    $status = $fee['status']==1?'Active':'';
    $session = $fee['code'] . '-' . $fee['arm'] . '(' . $fee['session'] . ')';
    $created_at = date('F j, Y',strtotime($fee['created_at']));
    $amount = $fee['amount'];
    $discount = $fee['discount'];
    $amount_paid = $fee['amount_paid'];
    $balance = $fee['amount']- $fee['amount_paid'];
    $unpaid_fee_table.='<tr>
                            <td>'.$fee_name.'</td>
                            <td>'.$description.'</td>
                            <td>'.$start_date.'</td>
                            <td>'.$due_date.'</td>
                            <td>'.$status.'</td>
                            <td>'.$session.'</td>
                            <td>'.$created_at.'</td>
                            <td>'.$amount.'</td>
                            <td>'.$discount.'</td>
                            <td>'.$amount_paid.'</td>
                            <td>'.$balance.'</td>                    
                        </tr>';
endforeach;
$unpaid_fee_table.= '</tbody>';
$unpaid_fee_table.= '</table>';


$pdf->writeHTML($unpaid_fee_table, true, false, false, false, '');

// -----------------------------------------------------------------------------
// reset pointer to the last page
$pdf->lastPage();
//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+