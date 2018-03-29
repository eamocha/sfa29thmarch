
						<!-- Modal -->
						<div class="modal fade" id="routeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog ">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Route Details</h4>
						      </div>
						      <div class="modal-body">
 <form name="areaform" action="add_region_process.php?mode=route" method="post" id="areaform" >
                               <table id="add_regions"  ><tr>
                                   <td>Route Name</td>
                                   <td><input type="text" class=" form-control" id="name" name="name"></td>
                                   <td>Distributor</td>
                                   <td><select class=" form-control"  id="distributor" name="distributor">
                                     <?php echo distributor_selection()?>
                                   </select></td>
                                   </tr>
                                 <tr>
                                   <td>Cluster</td>
                                   <td><select class=" form-control"  id="cluster" name="cluster">
                                     <?php echo cluster_selection()?>
                                   </select></td>
                                   <td>Area</td>
                                   <td><select class=" form-control"  id="area" name="area">
                                     <?php echo area_selection()?>
                                   </select></td>
                                   </tr>  
                                 <tr>
                                   <td>Region</td>
                                   <td><select class=" form-control"  id="region" name="region">
                                     <?php echo region_selection()?>
                                   </select></td>
                                   <td> Incharge</td>
                                   <td><input type="tel" class="form-control"  id="incharge" name="incharge" /></td>
                                 </tr>
                                 <tr>
                                   <td>Description</td>
                                   <td><input type="text" class=" form-control" id="description" name="description" /></td>
                                   <td>&nbsp;</td>
                                   <td>&nbsp;</td>
                                 </tr>
                                 <tr>
                                   <td>Days</td>
                                   <td><select id="day1" name="day1"><?php echo days_selection()?></select></td>
                                   <td>AND</td>
                                   <td><select id="day2" name="day2"><?php echo days_selection()?></select></td>
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