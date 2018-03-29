<?php
require('fpdf.php');
require('../../assets/lib/functions.php');
require('../../assets/lib/config.php');// configure to point to your connection script.
//$title="Listed Outlets: ";//.get_region_no_link($region_id);

$region_id=$_REQUEST['region_id'];
$user_id=$_REQUEST['uid'];
$what=$_REQUEST['tag'];


$email=getColumnName("tbl_users"," email ", " user_id=$user_id and status=0");
$title="Listed Outlets: ".get_region_no_link($region_id);


class PDF extends FPDF

{

//Page header

function Header()

{ global $region_id,$title;
   //Logo
    $this->Image('http://www.bluerangeautomation.com/ventas/images/logo.png',10,8,33);
	//topic
	$this->SetFont('Arial','B',12);
$this->SetX(70);
$this->SetTextColor(0,39,12);
$this->Cell(40,10,$title);
	// Add date report ran
$this->SetFont('Arial','I',10);

$date =  date("F j, Y H:i:sa");
$this->SetX(70);
$this->Cell(40,20,'Report date: '.$date);
//$this->Rect(10,32,190,0);
 
   }
 
//Page footer
function Footer(){
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().' of {nb}',0,0,'C');
}
}



$pdf = new PDF();
//$pdf->open();
$pdf->AddPage();
$pdf->AliasNbPages();   // necessary for x of y page numbers to appear in document
$pdf->SetAutoPageBreak(false);
 
// document properties
$pdf->SetAuthor('DMS');
$pdf->SetTitle('Disribution Management System');



$pdf->SetTextColor(0,0,0);//black color
 

$pdf->SetDrawColor(0, 0, 0); //black
 

//table header

$pdf->SetFillColor(170, 170, 170); //gray

$pdf->setFont("Arial","B","9");

$pdf->setXY(10, 30); 
$pdf->Cell(10, 10,"No. " , 1, 0, "L", 1);
$pdf->Cell(40, 10, "Name", 1, 0, "L", 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
$pdf->Cell(35, 10, "Channel", 1, 0, "L", 1);
$pdf->Cell(40, 10, "Place", 1, 0, "L", 1);
$pdf->Cell(28, 10, "Incharge", 1, 0, "L", 1); 
$pdf->Cell(26, 10, "Phone", 1, 0, "L", 1); 
$pdf->Cell(16, 10, "Type", 1, 0, "L", 1); 
 
$y = 40; $x = 10;  $pdf->setXY($x, $y);
 

$pdf->setFont("Arial","","9"); 

$query_result = "SELECT * FROM tbl_dealers  WHERE region_id=$region_id and status=0 order by business_name "; 
$result = mysql_query($query_result, $connection) or die(mysql_error());
$i=1;
 while($row = mysql_fetch_array($result))
{

        $pdf->Cell(10, 8, $i, 1);
		$pdf->Cell(40, 8, $row['business_name'], 1);   
        $pdf->Cell(35, 8, channel_type($row['channel']), 1);
        $pdf->Cell(40, 8, reduce_str($row['town'],23), 1);
        $pdf->Cell(28, 8, $row['owner_name'], 1);
        $pdf->Cell(26, 8, $row['phone'], 1);
		$pdf->Cell(16, 8, get_outlet_type($row['type_of_outlet']), 1);
		  
        $y += 8;    
        if ($y > 260)    // When you need a page break
		{
            $pdf->AddPage();
            $y = 30;	
		}
       $pdf->setXY($x, $y);
	   $i++;///counter
}
//$pdf->Output("file.pdf","F");
//$pdf->Output();
 // compress("file.pdf");
//send_mail_withAttachment("file.pdf","eric.atinga@usalamaforum.org","Attached find ".$title);


// email stuff (change data below)
$to = $email;
$from = "info@kingbeverage.co.ke";
$subject = $title;
$message = "<p>Please see the attachment.</p>";


// attachment name
$filename =get_region_no_link($region_id).".pdf";


// encode data (puts attachment in proper format)
$pdfdoc = $pdf->Output($filename, "S");

email_file($pdfdoc,$filename,$from,$to,$subject,$message);


?>
