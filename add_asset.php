
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-md">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Asset Details</h4>
						      </div>
						      <div class="modal-body">
				     <form class="cmxform form-horizontal style-form"  onSubmit="return false" id="commentForm"   >
                                <table><tr>
                                  <td>Asset Type</td>
                                 <td><input class=" form-control" id="name" name="name" minlength="2" type="text" required /></td>
                                 <td> Description</td>
                                 <td><textarea class ="form-control " id="description" name="description" required="required"></textarea></td>
                                 </tr>
                               </table>
                                 <div class="modal-footer">
						        <button type="reset" class="btn btn-default" data-dismiss="modal">Reset</button>
						        <button  data-dismiss="modal" type="submit" id="submit" class="btn btn-success" onClick="add_asset_type();" >Save</button>
						      </div>
                            </form>
                             </div>
						  </div>
						</div>      				
      				</div><!-- /showback -->