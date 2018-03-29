
    <script type="text/javascript">

$(document).ready(function(e) {
	//hiding and showing
	$('.notify').hide();
	
	
	$('#create_notification').click(function(){
		$('.notify').show();
		});

});

    </script>
     
	<style type="text/css">
table tr td{
	 background-color:#FFF;
margin:5px;
padding-top:20px;
padding-left:10px;}
tr th{
	background-color:inherit;
	 margin:5px;
	 padding-left:10px;}
	 
table{
	padding:5px;
	margin:5px;
	}
	
	.border{
		border-bottom:1px solid #c9cdd7;
		}
		tr .thin{
			padding:5px}
	tr .color{ background:none repeat scroll 0 0 #4ecdc4 !important}
	input[type='select']{
		width:auto}
</style>

<div class="col-lg-9 main-chart"><?php include('submenu.php');?>
                  
                     <table width="100%" class="table table-bordered table-striped table-condensed"><tr><th colspan="4"> <!--CUSTOM CHART START -->
                      <div class="border-head"><a href="routes.php">&lt;&lt;Go Back</a>
                        <h3>Outlet Name:  <?php 
					  
					  echo business_name($dealer_id).' - '.date("d/m/Y")?> - Survey/Merchandize </h3>
                      </div></th></tr>
                      <tr style="border-bottom: 1px solid #090">
                        <td colspan="4">&nbsp; </td></tr><form id="checkin" enctype="multipart/form-data"  method="post" name="checkin" action="process_checkin1.php?dearler_id=<?php echo $dealer_id ?>&plan_id=<?php echo $plan_id?>">
                      <tr style="padding-top:20px; margin-top:20px">
                        <td width="31%">Are there outside advertising?</td>
                        <td width="31%"><input type="radio" name="inside_advert" id="inside_advert" checked="checked" value="1" />
                          Yes
                          <input type="radio" name="inside_advert" id="inside_advert" value="2" />
                          No</td>
                        <td width="23%"> Are there Inside adverting?</td>
                        <td width="15%"><input type="radio" name="outside_advert" id="outside_advert"  checked="checked" value="1" />
                          Yes
                          <input type="radio" name="outside_advert" id="outside_advert" value="2" />
                          No</td>
                      </tr>
                      <tr style="padding-top:20px; margin-top:20px">
                        <td>Is the product chilled?</td>
                        <td><input type="radio" name="chilled" id="chilled" checked="checked" value="1" />
                          Yes
                            <input type="radio" name="chilled" id="chilled" value="2" />
                          No</td>
                        <td>Did you do merchandazing</td>
                        <td><input type="radio" name="mechandazing" id="mechandazing" checked="checked" value="1" />
                          Yes
                          <input type="radio" name="mechandazing" id="mechandazing" value="2" />
                          No</td>
                      </tr>
                      <tr style="padding-top:20px; margin-top:20px">
                        <td>Are  there light panels</td>
                        <td><input type="radio" name="light_pannels" id="light_pannels" checked="checked" value="1" />
                          Yes
                            <input type="radio" name="light_pannels" id="light_pannels" value="2" />
                          No</td>
                        <td>Coasters?</td>
                        <td><input type="radio" name="Coasters" id="Coasters" checked="checked" value="1" />
                          Yes
                          <input type="radio" name="Coasters" id="Coasters2" value="2" />
                          No</td>
                      </tr>
                       <tr style="padding-top:20px; margin-top:20px">
                         <td>Are there branded glasses</td>
                         <td><input type="radio" name="glasses" id="glasses" checked="checked" value="1" />
                           Yes
                           <input type="radio" name="glasses" id="glasses" value="2" />
                           No </td>
                         <td>Bar runners?</td>
                         <td><input type="radio" name="brunners" id="brunners" checked="checked" value="1" />
                           Yes
                             <input type="radio" name="brunners" id="brunners" value="2" />
                           No</td>
                       </tr>
                       <tr style="padding-top:20px; margin-top:20px">
                         <td>Neon Signs</td>
                         <td><input type="radio" name="neon" id="neon" checked="checked" value="1" />
Yes
  <input type="radio" name="neon" id="neon2" value="2" />
No </td>
                         <td>Running Promotion</td>
                         <td><input type="radio" name="prom" id="prom" checked="checked" value="1" />
Yes
  <input type="radio" name="prom" id="prom2" value="2" />
No</td>
                       </tr>
                      <tr style="padding-top:20px; margin-top:20px">
                        <td><div class="col-md-9">
                          <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div> <span class="btn btn-theme02 btn-file"> <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span> <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                              <input type="file" name="image1" class="default">
                            </span> </div>
                          </div>
                        </div></td>
                        <td><div class="col-md-9">
                          <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div> <span class="btn btn-theme02 btn-file"> <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span> <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                              <input type="file" name="image2" class="default">
                            </span></div>
                          </div>
                        </div></td>
                        <td><div class="col-md-9">
                          <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div> <span class="btn btn-theme02 btn-file"> <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span> <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                              <input type="file" name="image3" class="default">
                            </span></div>
                          </div>
                        </div></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr style="padding-top:20px; margin-top:20px">
                        <td>Remarks</td>
                        <td colspan="2"><textarea name="survey_remarks" id="survey_remarks" cols="25" rows=""></textarea></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr style="padding-top:20px; margin-top:20px">
                        <td><input type="hidden" name="long" id="long"/></td>
                        <td><input type="hidden" name="lat" id="lat"/>
                          <input type="hidden" name="did" id="did" value="<?php echo $dealer_id;?>"/></td>
                        <td><button  id="create_notification"type="button" class="btn btn-warning">Create Nofication</button></td>
                        <td>
                          <button type="submit" name="save_next" class="btn btn-success btn-sm">Save &amp; Return </button></td>
                      </tr>
                        </form>
                       <!--Deliver products-->
  </table>
                 <div class="modal-body notification">
						       
                 <form name="signupForm" id="signupForm" action="add_notification.php?uid=$<?php echo $user_id ?>" method="post">
                               <table class="notify" id="notify"  style="margin:auto;"><tr>
                                   <td>About</td><td><input type="text" class=" form-control" id="about" name="about"></td>
                               <td>Priority</td>
                               <td><select name="priority"><option value="1"> high</option><option value="2"> Medium</option><option value="3"> Low</option></select></td>
                               <td>To</td><td><select name="to"> <option value="0"> All</option><option value="1"> sales</option><option value="3"> operations</option><option value="5">Executive</option> </select></td></tr>
                               <tr>
                                 <td>Details</td>
                                 <td colspan="5">
                                 <textarea name="note" id="note" cols="45" rows="5"></textarea></td>
                               </tr>
                               <tr>
                                 <td>&nbsp;</td>
                                 <td colspan="5">     <div class="modal-footer"><input type="hidden" value="<?php //echo $oid;?>" name="uid" />
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        <button  type="submit" class="btn btn-primary">Save</button>
                              </div></td>
                               </tr>
                               </table>
                         
                 </form>
  </div>
</div>