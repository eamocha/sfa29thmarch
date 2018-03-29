<?php include 'assets/lib/config.php'; include 'auth.php'; include 'assets/lib/functions.php'; 
$items_per_group=3000;
if($_REQUEST)
{	//sanitize post value
	$group_number = filter_var($_REQUEST["group_no"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
		//throw HTTP error if group number is not valid
	if(!is_numeric($group_number)){
		header('HTTP/1.1 500 Invalid number!');
		exit();
	}	
	//get current starting point of records
	$position = ($group_number * $items_per_group);
	
	$total=$_REQUEST['total'];
	
	//mode
	if($_REQUEST['mode']=='survey'){
		$qid=$_REQUEST['qid'];
		
		////////////////////////////
		?>
		 <table class="table table-bordered  table-condensed" >
                            
                           <?php $option=array();
					   $i=1;
						   //get question type and display the anser
						$qtype=getColumnName(" tbl_survey_questions "," q_type ", " survey_qID=$qid ") ;
						  
						    $sq=mysqli_query($mysqli,"SELECT * FROM `tbl_survey` WHERE `q_id`=$qid")or die(mysqli_error($mysqli)); 
							if(mysqli_num_rows($sq)>0){
							while ($r=mysqli_fetch_array($sq)){
									
									$anwer=$r['answer'];
									 echo "<tr><td >";
									if($qtype=="CheckBox"){
										$option=checkbox_answers($qid);
										echo "<h4> ".$option[$anwer]."</h4>";
				//end inner while
									}////////////end fetching checkboxes
															
									else if($qtype=="Radio"){
										echo getColumnName(" tbl_question_options "," option_name ", " option_id=$anwer ") ;
										} 
										
										else{
									
								echo "<h4> $i. ".$r['answer']."</h4>";
								
								echo '<p style=" font-size: 10px;" > Region:'.region_name(get_user_region($r['by'])). " |By: ".get_name($r['by'])." | Outlet: ".business_name($r['dealer_id']).'<span style=" float:right">  <a data-toggle="modal" class="btn btn-success btn-sm href="#myModal"> Process</a></span></p></td></tr>';	$i++;}
								}
							
							}//end whille
								else{echo "<tr><td>No record found</td></tr>";}
								?>              
                              </table>
                          <?php
		
		/////////////////////
		
	}// end both the 'else' there are records ad the  mode..............................................................................................................................
	if($_REQUEST['mode']=='stock_levels'){
		
		}// end mode
	
	if($_REQUEST['mode']=='orders_summary'){
		
	
							
	}// end mode
	if($_REQUEST['mode']=='all_outlets'){//start mode all outlets
		
	}// end mode
	//******************************************************************************************************************
if($_REQUEST['mode']=='stock_levels'){
		
	
	}// end mode
	
	
	if($_REQUEST['mode']=='assets'){//start mode all outlets
		
							
                               
	}// end mode	//*******************************************************************************************************************************
if($_REQUEST['mode']=='prospectus'){//start mode all prospectus
		
							
                               
	}// end mode
if($_REQUEST['mode']=='deleted_outlets'){//start mode all outlets
		
							
                               
	}// end mode........................................................................................................................
	//start onother
	
if($_REQUEST['mode']=='region_categories'){//start mode all outlets
		
                               
	}// end mode


	if($_REQUEST['mode']=='upcoming_orders'){
		
	
	}// end mode
	}///post?>
								 
                                 
                                 
                                 
                                 
                                 
                                 