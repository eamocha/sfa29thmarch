
						<!-- Modal -->
						<div class="modal fade" id="distributorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog ">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Distributor Details</h4>
						      </div>
						      <div class="modal-body">
 <form name="areaform" action="add_region_process.php?mode=distributor" method="post" id="areaform" >
                               <table id="add_regions"  ><tr>
                                   <td>Distributor Name</td>
                                   <td><input type="text" class=" form-control" id="name" name="name"></td>
                                   <td>Cluster</td>
                                   <td><select class=" form-control"  id="cluster" name="cluster">
                                     <?php echo cluster_selection()?>
                                   </select></td>
                                   </tr><tr>
                                     <td>Area</td>
                                     <td><select class=" form-control"  id="area" name="area">
                                       <?php echo area_selection()?>
                                     </select></td>
                                     <td>Region</td>
                                     <td><select class=" form-control"  id="region" name="region">
                                       <?php echo region_selection()?>
                                     </select></td>
                                   </tr>  
                                 <tr>
                                   <td> Incharge</td>
                                   <td><input type="tel" class="form-control"  id="incharge" name="incharge" /></td>
                                     <td>Description</td>
                                     <td><input type="text" class=" form-control" id="description" name="description" /></td>
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