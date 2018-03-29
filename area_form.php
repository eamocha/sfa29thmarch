
						<!-- Modal -->
						<div class="modal fade" id="areaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog ">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Area Details</h4>
						      </div>
						      <div class="modal-body">
 <form  action="add_region_process.php?mode=area" method="post" id="areaForm" name="areaForm" >
                               <table id="add_regions"  ><tr>
                                   <td>Area Name</td><td><input type="text" class=" form-control" id="name" name="name"></td>
                                   <td></td><td>
                                   <input type="hidden"  name="region" id="region" value="<?php echo $_REQUEST['region_id'];?>"/></td>
                               </tr><tr><td> Incharge</td><td><Select class="form-control"  id="incharge" name="incharge"><?php echo select_ARMs($region_id)?></Select></td>
                               <td>Description</td><td><input type="text" class=" form-control" id="description" name="description"></td></tr></table>
                              <div class="modal-footer">
						        <button type="reset" class="btn btn-default" data-dismiss="modal">Reset</button>
						        <button  type="submit" id="submit" class="btn btn-primary">Save</button>
					        </div></form>
						    </div>
						  </div>
						</div>      				
      				</div><!-- /showback -->
                    
                    
                    
                    
                    
                    
                   	<!-- Modal -->
						<div class="modal fade" id="updateAreaForm" tabindex="-1" role="dialog" aria-labelledby="updateAreaForm" aria-hidden="true">
						  <div class="modal-dialog ">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal"  aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Area Details</h4>
						      </div>
						      <div class="modal-body">
 <form  action="" method="post" id="EditareaForm" name="EditareaForm" >
                               <table id="add_regions"  ><tr>
                                   <td>Area Name</td><td><input type="text" class=" form-control" id="name" name="name"></td>
                                   <td></td><td>
                                   <input type="hidden"  name="region" id="region" value="<?php echo $_REQUEST['region_id'];?>"/><!--<select class=" form-control"  id="region" name="region">
							  <?php // echo region_selection()?>
                               </select>--></td>
                               </tr><tr><td> Incharge</td><td><Select class="form-control"  id="incharge" name="incharge"><?php echo select_ARMs($region_id)?></Select></td>
                               <td>Description</td><td><input type="text" class=" form-control" id="description" name="description"></td></tr></table>
                              <div class="modal-footer">
						        <button type="reset" class="btn btn-default" data-dismiss="modal">Reset</button>
						        <button  type="submit" id="submit" class="btn btn-primary">Save</button>
					        </div></form>
						    </div>
						  </div>
						</div>      				
      				</div><!-- /showback -->
                     
                 