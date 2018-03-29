<?php  include_once 'assets/lib/config.php';
  include_once 'assets/lib/functions.php';
   $subject = 'Distributor Stock for the last 3 days';
$from = 'eamocha@gmail.com';
 $daysInMonth=daysInMonth(date('Y'),date('m'));
 $today=date("Y-m-d");
  $jana=date("Y-m-d",strtotime("-1 days")); $juzi=date('Y-m-d',strtotime("-2 days"));
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n". 'Reply-To: '.$from."\r\n" .   'X-Mailer: PHP/' . phpversion();
  $date=$today;// date("Y-m-d"); 
 // test this : SELECT SUM(qty) as total FROM tbl_distributor_stock_levels a INNER JOIN tbl_products b on a.product_id=b.product_id  WHERE distributor_id=233 and date(date_taken)='2017-10-18' AND b.status=0
// Compose a simple HTML email message
ob_start();
?> <!DOCTYPE html>
<html>
<head>
<style>
body{
  font-size:11px;
	font-family: Calibri;
	}
	tfoot {color:black;
	font-size:14px;
	font-weight:bold;}
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
	
    text-align: left;
    padding: 8px;
	border:1px solid #CCC;
}
tr:nth-child(even){background-color: #f2f2f2}
</style>
</head>
<body> 
 
   <h2 style="text-align:center">Distributor stocks since <?php echo date('d.m.Y',strtotime("-2 days"));
   ?>.</h2>
   <p> Please click<a href="http://almasisfa.com/excel_distributor_stock.php"> here </a>to download an excel sheet showing Distributor Stocks for this month- MTD </p>
   
  	 
                                 <style>body{font-size:11px; font-family: Calibri;	}
	tfoot {color:black;	font-size:14px;	font-weight:bold;}
table {    border-collapse: collapse;    width: 100%;}
th, td {    text-align: left;    padding: 8px;	border:1px solid #CCC;}
tr:nth-child(even){background-color: #f2f2f2}
</style>
		 <table  id="content_table" class="table table-bordered table-striped table-condensed" >
                              <thead> 
  <tr>
   <th>#</th> <th>DISTRIBUTOR</th>
    <th >AD IN CHARGE</th>
    <th >CONTRIBUTION</th>
    <th >MONTH TARGET</th>
    <th >DAILY TARGET</th>
    <th >4 DAYS STOCK</th>
    <th >7 DAYS TGT</th>
    <th ><?php echo date('d.m.Y',strtotime($juzi));?></th>
    <th ><?php echo date('d.m.Y',strtotime($jana));?></th>
      <th ><?php echo date('d.m.Y',strtotime($today));?></th>

  </tr>
                     </thead>         <tbody>
		
										
         <?php 			
						 
		$arq=mysqli_query($mysqli,"SELECT area_name,area_id,arm_incharge FROM tbl_areas WHERE status=0  AND area_id NOT IN(8,14,23) order by region_id") or die(mysqli_error($mysqli));
							  while($ar=mysqli_fetch_array($arq)){ $d=1;
								  $id=$ar['area_id'];
								 $ttjuzi=0; $ttjana=0; $ttleo=0;
								   $dq=$mysqli->query("SELECT distributor_name,distributor_id,ad_incharge,distributor_contribution,this_month_target FROM tbl_distributors WHERE status=0 AND area_id=$id") or die(mysqli_error($mysqli));
								while($dr=mysqli_fetch_array($dq)){
								  $did=$dr['distributor_id'];
								 $ttjuzi+= $sumjuzi=sum_columns("tbl_distributor_stock_levels","qty","distributor_id=$did and  date(date_taken)='$juzi'"); 
								   $ttjana+=$sumjana=sum_columns("tbl_distributor_stock_levels","qty","distributor_id=$did and  date(date_taken)='$jana'");  
								 $ttleo+= $sumleo=sum_columns("tbl_distributor_stock_levels","qty","distributor_id=$did and  date(date_taken)='$today'");
								   ?>
                              <tr>
                                 <td><?php echo $d?></td>  <td><?php echo $dr['distributor_name']?></td> <td><?php echo get_name($dr['ad_incharge'])?></td>  <td><?php echo $dr['distributor_contribution']?></td>  <td><?php echo $dr['this_month_target']?></td><td><?php echo $dailyTarget= number_format($dr['this_month_target']/$daysInMonth,1)?></td> <td><?php echo 4*$dailyTarget?></td> <td><?php echo 7*$dailyTarget?></td></td>   <td><?php echo $sumjuzi?></td> <td><?php echo $sumjana?></td> <td><?php echo $sumleo?></td>  
							     </tr>
								 <?php $d++;} 
		?> <tr style="background-color:#F00; font-weight:bold; color:#FFF; text-transform:uppercase"><td colspan="2"><?php echo $ar['area_name']?></td><td colspan="6"><?php echo getColumnName("tbl_users","full_name","user_id=".$ar['arm_incharge'])?></td><td><?php echo $ttjuzi?></td> <td><?php echo $ttjana?></td> <td><?php echo $ttleo?></td> </tr>
        
         <?php }//end area?> </tbody>                                          
                          </table>
                <div style="text-align:center">The Server time the report was generated <?php echo date('Y-m-d h:i:s')?></dv>
                          
                          </body></html>
                          					  
                           <?php ////get all data for sending
						   $message=ob_get_clean(); echo $message;
 //Sending email
 $send_to_q=mysqli_query($mysqli,"SELECT email FROM `tbl_users` WHERE status=0 and user_id=1 and role IN(2,3,4,5) ")or die(mysqli_error($mysqli)); while($result=mysqli_fetch_array($send_to_q)){
						  $to=$result['email']; $title='Distributor Stock for the last 3 days: '.$today_constant;
					send_email($message ,$title,$to); 
						  }
						  ?>