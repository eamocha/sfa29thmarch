<?php
require('fpdf.php');
require('../../assets/lib/functions.php');
require('../../assets/lib/config.php');// configure to point to your connection script.
//$title="Listed Outlets: ";//.get_region_no_link($region_id);

$region_id=$_REQUEST['region_id'];
$user_id=$_REQUEST['uid'];
//$what=$_REQUEST['tag'];

$email=getColumnName("tbl_users"," email ", " user_id=$user_id and status=0");
$title="Day's Report: ".get_region_no_link($region_id)."-".get_name($user_id);;
$date=date("Y-m-d");


class PDF extends FPDF

{

//Page header

function Header()

{ global $region_id,$title;
   //Logo
    $this->Image('http://kingbevdms.com/images/king.png',10,8,33);
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
///fisrt page
 $pdf->SetFont('Arial','B',16);
 $recX=27;$recH=27; $Xs=10;$Ys=30; $Xn=40; $Yn=40;
$pdf->Rect($Xs,$Ys,$recX,$recH);
$pdf->Text($Xs+3,$Ys+5,"Visited");
$pdf->Text($Xs+10,$Ys+18,visited_today($user_id,$date));

$pdf->Rect($Xn,$Ys,$recX,$recH);
$pdf->Text($Xn+3,$Ys+5,"Listed");
$pdf->Text($Xn+10,$Ys+18,outlets_added_in_day($user_id,$date));
//
$pdf->Rect($Xn+30,$Ys,$recX,$recH);
$pdf->Text($Xn+33,$Ys+5,"Stock");
$pdf->Text($Xn+33,$Ys+10,"Loaded");
$pdf->Text($Xn+43,$Ys+18, stock_given_id_aday($user_id,$date));

$pdf->Rect($Xn+60,$Ys,$recX,$recH);
$pdf->Text($Xn+63,$Ys+5,"Stock ");
$pdf->Text($Xn+61,$Ys+10,"Available");
$pdf->Text($Xn+70,$Ys+18,days_stock_levels($user_id,$date,""));

$pdf->Rect($Xn+90,$Ys,$recX,$recH);
$pdf->Text($Xn+93,$Ys+5,"Stock ");
$pdf->Text($Xn+91,$Ys+10,"Sold");
$pdf->Text($Xn+100,$Ys+18,user_sell_out_in_day($user_id,$date));
/////
$pdf->Rect($Xn+120,$Ys,$recX,$recH);
$pdf->Text($Xn+121,$Ys+5,"Payments");
$pdf->Text($Xn+130,$Ys+18,user_paymentsInAday($date,$user_id));


$pdf->AliasNbPages();   // necessary for x of y page numbers to appear in document
$pdf->SetAutoPageBreak(false);
 
// document properties
$pdf->SetAuthor('Eric Atinga');
$pdf->SetTitle('Disribution Management System');

$pdf->SetTextColor(0,0,0);//black color
 

$pdf->SetDrawColor(0, 0, 0); //black
 $pdf->SetX(70);//to reset the left margin of the Title
$pdf->Cell(10,120,"Visit Details");
//table header

$pdf->SetFillColor(170, 170, 170); //gray

$pdf->setFont("Arial","B","9");

$pdf->setXY(10, 80); 
$pdf->Cell(10, 10,"No " , 1, 0, "L", 1);
$pdf->Cell(40, 10, "Outlet", 1, 0, "L", 1);   // CHANGE THESE TO REPRESENT YOUR FIELDS
$pdf->Cell(35, 10, "Visit Time", 1, 0, "L", 1);
$pdf->Cell(40, 10, "Stock", 1, 0, "L", 1);
$pdf->Cell(28, 10, "Sale Out", 1, 0, "L", 1); 
$pdf->Cell(20, 10, "Paid", 1, 0, "L", 1); 
$pdf->Cell(20, 10, "Next Visit", 1, 0, "L", 1); 
 
$y = 90; $x = 10;  $pdf->setXY($x, $y);
 

$pdf->setFont("Arial","","9"); 


$query_result = "SELECT * FROM `tbl_route_plan` rp LEFT JOIN tbl_dealers d on d.dealer_id=rp.dealer_id where DATE(startdate)='$date' and visted=1 and assigned_to=$user_id"; 
$result = mysqli_query($mysqli,$query_result) or die(mysqli_error($mysqli));
$i=1;
 while($row = mysqli_fetch_array($result))
{
	

        $pdf->Cell(10, 8, $i, 1);
		$pdf->Cell(40, 8, $row['business_name'], 1);   
        $pdf->Cell(35, 8, $row['date_visted'], 1);
        $pdf->Cell(40, 8, stock_take_per_outlet($user_id,$date), 1);
        $pdf->Cell(28, 8, day_outlet_sales($row['dealer_id'],$date), 1);
        $pdf->Cell(20, 8, dealer_total_paymentsInAday($date,$row['dealer_id']), 1);
		$pdf->Cell(20, 8, next_visit_date($row['dealer_id'],$date), 1);
		  
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
$pdf->Output();
 
 /*

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
*/

?>
