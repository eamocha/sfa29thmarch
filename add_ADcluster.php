						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog ">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">AD Cluster Details</h4>
						      </div>
						      <div class="modal-body">
 <form name="ad_clusterform" action="add_region_process.php?mode=ad_cluster" method="post" id="ad_clusterform" >
                               <table id="add_regions"  ><tr>
                                   <td>Name</td><td><input type="text" class=" form-control" id="name" name="name"></td>
                                   <td>Description</td><td><input type="text" class=" form-control" id="description" name="description"></td>
                               </tr><tr><td> Incharge</td><td><input type="text" class="form-control"  id="incharge" name="incharge"></td>
<td><input type="hidden" value="<?php echo $cluster?>" class="form-control"  id="cluster" name="cluster"></td><td></td></tr></table>
                              <div class="modal-footer">
						        <button type="reset" class="btn btn-default" data-dismiss="modal">Reset</button>
						        <button  type="submit" id="submit" class="btn btn-primary">Save</button>
					        </div></form>
						    </div>
						  </div>
						</div>      				
      				</div><!-- /showback -->