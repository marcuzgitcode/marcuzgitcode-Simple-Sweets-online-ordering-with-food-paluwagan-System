<?php
require('db.php');
session_start();
$fn=$_SESSION['SESS_NAME'];
$code=$_GET['on'];

    $typequery = mysqli_query($conn,"SELECT * FROM sales WHERE payment_ID='$code'");
    while($typedata = mysqli_fetch_array($typequery)){ 

        $invoice = $typedata['payment_ID'];
        $amount = $typedata['amount'];
        // $penalty = $typedata['penalty'];
        
        $myid=$typedata['customer_ID'];    
        $select = "SELECT * FROM customer WHERE customer_ID='$myid'";
        $query = mysqli_query($conn, $select);
        $query = mysqli_fetch_array($query);

        $lname = $query['lastName'];
        $fname = $query['firstName'];
        // $mname = $query['middlename'];

        $myid1=$typedata['product'];   
        $select = "SELECT * FROM menu WHERE menu_ID='$myid1'";
        $query1 = mysqli_query($conn, $select);
        $row = mysqli_fetch_array($query1);

        $lcode = $row['menu_ID'];
        $pamount = $row['price'];
        // $balance = $row['loan_balance'];

        // $myid2=$typedata['collector_code'];   
        // $select1 = "SELECT * FROM collector WHERE collector_code='$myid2'";
        // $query2 = mysqli_query($conn, $select1);
        // $row1 = mysqli_fetch_array($query2);

        // $clname = $row1['lastname'];
        // $cfname = $row1['firstname'];
        // $cmname = $row1['middlename'];

        // $mytype=$row['loantype'];  
        // $sql1 = "SELECT * FROM loantype WHERE id='$mytype'";
        // $qry1 = mysqli_query($conn, $sql1);
        // $result1 = mysqli_fetch_array($qry1);

        // $loantype = $result1['loantype'];

        // $mysched=$row['loan_code'];  
        // $sql2 = "SELECT * FROM loan_schedule WHERE loan_code='$mysched' AND paid=0 ORDER BY date(due_date) ASC limit 1";
        // $qry2 = mysqli_query($conn, $sql2);
        // $result2 = mysqli_fetch_array($qry2);

        // $loansched = $result2['due_date'];


}


require_once('TCPDF-main/tcpdf.php');

 /** 
  * 
 */
class PDF extends TCPDF{
    public function Header(){
        $imageFile = K_PATH_IMAGES. 'logo.png';
        $this->Image($imageFile, 9, 8, 9, '','PNG', '', 'C', false, 300, '', false, false,
        0, false, false, false);
        $this->Ln(2);
        $this->SetFont('helvetica', 'B', 6);
        $this->Cell(80,1,'SIMPLE SWEET CAKES AND KAKNIN(SSCK)',0,1,'C');
        $this->SetFont('helvetica', '', 5);
        $this->Cell(80,1,'Makabayan, Village, Sition DK, Libertad, Tungawan, Zamboanga Sibugay',0,1,'C');
        $this->Cell(80,1,'Reg. Pag. No. 9520-09003311/Tel. No. 333-2596',0,1,'C');
        $this->Ln(5);
        $this->SetFont('helvetica', 'B', 8);
        $this->Cell(80,1,'INVOICE',0,1,'C');
        $this->Ln(2);
        $this->SetFont('helvetica', 'B', 8);
        $this->Cell(80,1,'__________________________________________________',0,1,'L');


    }
    public function Footer(){
        $this->SetY(-10);
        
        $this->SetFont('helvetica', 'I', 6);
        date_default_timezone_set("Asia/Dhaka");
        $today = date("F j, Y/ g:i A", time());
        
        $this->Cell(10,5, 'Generation Date/Time: '.$today,0,0,'L');
        $this->Cell(70,5, 'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,false, 'R', 0, '', 0, false, 'T', 'M');


    }
}
// create new PDF document
$pdf = new PDF('p', 'mm', 'A6', true, 'UTF-8', false);

// set document information
// $pdf->SetCreator(PDF_CREATOR);
// $pdf->SetAuthor('Nicola Asuni');
// $pdf->SetTitle('TCPDF Example 001');
// $pdf->SetSubject('TCPDF Tutorial');
// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
// $pdf->setFooterData(array(0,64,0), array(0,64,128));

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

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
$pdf->Ln(8);
$pdf->SetFont('helvetica', '', 6);
$pdf->Cell(80,1,'CUSTOMER: ' .$lname.', '.$fname,0,1,'L');
$pdf->Ln(1);

$pdf->Cell(80,1,'Invoice No.: '.$invoice,0,1);
$pdf->Ln(1);
$pdf->Cell(80,1,'Loan Code: '.$lcode,0,1);

$pdf->Ln(2);
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(80,1,'__________________________________________________',0,1,'L');

$pdf->Ln(3);
$pdf->SetFont('helvetica', 'N', 8);
$pdf->Cell(65,1,'Amount Paid:',0,0);
$pdf->Cell(15,1,''.$amount,0,1);

$pdf->Ln(1);
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(65,1,'Amount:',0,0);
$pdf->Cell(15,1,''.$pamount,0,1);

// $pdf->Ln(1);
// $pdf->SetFont('helvetica', '', 8);
// $pdf->Cell(65,1,'Penalty:',0,0);
// $pdf->Cell(15,1,''.$penalty,0,1);

// $pdf->Ln(1);
// $pdf->SetFont('helvetica', '', 8);
// $pdf->Cell(65,1,'Balance:',0,0);
// $pdf->Cell(15,1,''.$balance,0,1);

// $pdf->Ln(2);
// $pdf->Cell(65,1,'Next Payment:',0,0);
// $pdf->Cell(15,1,''.$loansched,0,1);

$pdf->Ln(2);
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(80,1,'__________________________________________________',0,1,'L');

$pdf->Ln(3);
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(80,1,'Collected By: ',0,1);
$pdf->Ln(5);

// $pdf->Cell(53,1,'',0,0);
// $pdf->Cell(27,1,''.$clname.', ' .$cfname. ' '.$cmname,0,1);


// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('membership_form.pdf', 'I');