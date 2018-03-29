<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $user_id=$_SESSION['u_id']; $qid=$_REQUEST['id']; 
	$optionType=getColumnName(" tbl_survey_questions "," q_type ", " survey_qID=$qid ");

	 ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>
  <script type="text/javascript" >
  var question=<?php echo $qid?>;
  var optionType="<?php echo $optionType?>";
 
  
  
      $(window).load(function(e) {
		//  alert(question);
		  if(optionType=="Number"){fetch_number_options(question);} 
		  else   if(optionType=="CheckBox"){fetch_options(question);} 
		  else   if(optionType=="Radio"){fetch_options(question);} 
		
		 });

		  
 </script>
  </head>
  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
         <?php include 'notifications.php'?>
        </header>
      <!--header end-->
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** --> <!--sidebar start
      <aside>
          <?php //include 'side_menu.php'?>
      </aside>
      sidebar end-->
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  <div class="col-lg-12 main-chart">
                    <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <?php include('submenu.php'); $date=date('Y-m-d'); ?>
                         <h3 class="float_left">Survey Question:   <?php echo  getColumnName(" tbl_survey_questions "," question ", " survey_qID=$qid ")?></h3>
                      </div>
                    
                     <!--start -->           
                   <section id="unseen">
                      <select name="region" class="filters" id="region"><option>Select Region</option></select> | <select class="filters" name="area" id="area" ><option>Select Area</option></select> | <select class="filters" id="cluster" name="cluster"><option>Select Cluster</option></select> | <select class="filters" name="distributor" id="distributor"> <option>Select Distributor</option></select> | <select class="filters" name="route" id="route"> <option>Select Route</option></select>
                      <hr>
                   Has Electricity   <select id="has_electricity"><option>Yes</option><option>No</option></select> |  Active outlet  <select id="has_electricity"><option>Yes</option><option>No</option></select> |  Location occassion   <select id="has_electricity"><option>Yes</option><option>No</option></select> |  Has Asset   <select id="has_electricity"><option>Yes</option><option>No</option></select> |  Channel Type   <select id="has_electricity"><option>Yes</option><option>No</option></select> |  Time of Opening   <select id="has_electricity"><option>Yes</option><option>No</option></select> |  Sales Othe Beverages   <select id="has_electricity"><option>Yes</option><option>No</option></select> |  Opening time   <select id="has_electricity"><option>Yes</option><option>No</option></select> |  Closing time   <select id="has_electricity"><option>Yes</option><option>No</option></select> 
               <hr>
               
               
                  <div class="row content-panel">
							<div class="panel-heading">
								<ul class="nav nav-tabs nav-justified">
									<li class="active">
										<a data-toggle="tab" href="#answers_dashboard">Summary</a>
									</li>
                                    <li >
										<a data-toggle="tab" href="#spread_on_map">Spread of the outlets on Map </a>
									</li>
									<li>
										<a data-toggle="tab" href="#raw_data" class="contact-map">Raw Data</a>
									</li>
                                    
                                 
								</ul>
							</div><!--/panel-heading -->
							
							<div class="panel-body">
								<div class="tab-content">
									<div id="answers_dashboard" class="tab-pane active">
										<!--start tab-->
                                                                                                            
                   <?php if($optionType=="Number"||$optionType=="CheckBox"||$optionType=="Radio"){?>
                    <table class="table table-bordered  table-condensed" >
                    <tr><td colspan="2"> <a data-toggle="modal" class="btn btn-success btn-sm" href="#myModal">Add Option</a></td><td colspan="2"></td></tr>
                    <tr>
                    <th width="5">#</td> <th>Option</th> 
                    <th>Tally</th>
                    </tr>
                    <tbody id="options_list">
                   <tr> <td colspan="3"> Loading <img src="images/37.gif"></td></tr>
                    </tbody></table>
                    <?php 
						}else
					echo "<h1 style='color:red'>Please check the Raw data tab!!!</h1>";?>
                   
                   
                                        <!-- end tab1-->
                                        </div>
                                      <div id="spread_on_map" class="tab-pane">
																																		                                    
											
										
									</div><!--/tab-pane -->
                                    
									
									<div id="raw_data" class="tab-pane">
                                    <!-----------------------start------------------------- -->
                                    <span id="raw_data_results"></span>
                                    <?php 
									
						 
							$results=$mysqli->query("SELECT count(survey_id) as t_records FROM `tbl_survey` where `q_id`=$qid")or die(mysqli_error($mysqli));
$total_records = $results->fetch_object();
$total_groups = ceil($total_records->t_records/$items_per_group);
$results->close(); ?>

<script type="text/javascript">
$(document).ready(function() {
	var track_load = 0; //total loaded record group(s)
	var loading  = false; //to prevents multipal ajax loads
	var total_groups = <?php echo $total_groups; ?>; //total record group(s)
	var total=<?php echo $total_records->t_records?>;
	var pergroup=<?php echo $items_per_group=100?>;
	var dt=<?php echo $qid?>;
	loading_data('#raw_data_results',"survey_answers.php?qid="+dt+'&mode=survey',track_load,loading,total_groups,total,pergroup);
		
});
</script>
<!-----------------------end--------------------------->
                                    
                                    <img src="images/ajax-loader.gif"/> Loading..............
										  <div class="animation_image" style="display:none" align="center"><img src="images/ajax-loader.gif">loading...</div>
									                                    
									</div><!--/tab-pane -->
                                    
									
                                   
                               
								
							  </div><!--/tab-pane -->
								</div><!-- /tab-content -->
							
							</div><!--/panel-body -->
                         

<div>

</div>
 
                    </section>

                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
           
                  <!----------------------->
                  
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog ">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel"><?php echo  getColumnName(" tbl_survey_questions "," question ", " survey_qID=$qid ")?> Options</h4>
						      </div>
						      <div class="modal-body">
 <form class="cmxform form-horizontal"  onSubmit="return false" id="add_question_optionform" name="add_question_optionform"   >
                                <table>
                                    <tr>
                                      <td>Option <input type="hidden" value="<?php echo $qid?>" name="main_question_id" id="main_question_id">
                                    
                                       <input class="form-control" type="text" name="choice" id="choice">
                                      </td>
                                      <td>remarks<input class="form-control" type="text" id="remarks" name="remarks" /></td>
                                    </tr>
                                </table> 
                                <div class="modal-footer">
                               
                                        <input type="hidden" value="<?php $_SESSION['u_id']?>" name="user_id" id="user_id"/>
                                        
                                         
                                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button> <button class="btn btn-success" data-dismiss="modal" onClick="add_question_option()" type="submit">Save</button>
                                       
          </div>
                            </form>
						    </div>
						  </div>
						</div>      				
      				</div><!-- /showback -->
                  <!-------------------------->

              </div><!--/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
     <?php include('footer.php');?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->

    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
   	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	

	


    
  </body>
</html>
