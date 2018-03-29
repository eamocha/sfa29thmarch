
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog ">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Region Details</h4>
						      </div>
						      <div class="modal-body">
 <form name="regionsform" action="add_region_process.php?mode=region" method="post" id="regionsform" >
                               <table id="add_regions"  ><tr>
                                   <td>Region Name</td><td><input type="text" class=" form-control" id="region_name" name="region_name"></td>
                                   <td>Description</td><td><input type="text" class=" form-control" id="description" name="description"></td>
                               </tr><tr><td> Incharge</td><td><input type="tel" class="form-control"  id="tel" name="tel"></td><td></td><td></td></tr></table>
                              <div class="modal-footer">
						        <button type="reset" class="btn btn-default" data-dismiss="modal">Reset</button>
						        <button  type="submit" id="submit" class="btn btn-primary">Save</button>
					        </div></form>
						    </div>
						  </div>
						</div>      				
      				</div><!-- /showback -->