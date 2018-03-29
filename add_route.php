
						<!-- Modal -->
						<div class="modal fade" id="addRouteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog ">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Route Details</h4>
						      </div>
						      <div class="modal-body">
 <form name="add_routeForm" action="add_region_process.php?mode=add_route&distributor_id=<?php echo $distributor_id?>" method="post" id="add_routeForm" >
                               <table id=""  ><tr>
                                   <td>Name</td>
                                   <td><input type="text" class=" form-control" id="name" name="name" /></td>
                                   <td>Description</td>
                                   <td><input type="text" class=" form-control" id="description" name="description" /></td>
                                   </tr>
                               
                                 <tr>
                                   <td>Incharge</td>
                                   <td><input type="text" class=" form-control" id="incharge" name="incharge" /></td>
                                   <td>&nbsp;</td>
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr>
                                   <td>Week Day</td>
                                   <td><select class=" form-control" id="day3" name="day3">
                                     <?php echo days_selection()?>
                                   </select></td>
                                   <td>Week Day2</td>
                                   <td><select class=" form-control" id="day4" name="day3">
                                     <?php echo days_selection()?>
                                   </select></td>
                                 </tr>
                                 <tr>
                                   <td>&nbsp;</td>
                                   <td>&nbsp;</td>
                                   <td>&nbsp;</td>
                                   <td>&nbsp;</td>
                                 </tr>
                             </table>
                              <div class="modal-footer">
						        <button type="reset" class="btn btn-default" data-dismiss="modal">Reset</button>
						        <button  type="submit" id="submit" class="btn btn-primary">Save</button>
          </div></form>
						    </div>
						  </div>
						</div>      				
      				</div><!-- /showback -->