
						<!-- Modal -->
						<div class="modal fade" id="add_user_role" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-sm">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Role Details</h4>
						      </div>
						      <div class="modal-body">
						       
                  <form name="add_userroleForm" action="" method="post" onSubmit="return false" id="add_userroleForm" >
                
                               <table><tr><td>Name</td><td><input type="text" class=" form-control" id="role_name" name="role_name"></td></tr><tr>
                               <td>Description</td><td><input type="text" class=" form-control" id="description" name="description"></td></tr></table>
                              <div class="modal-footer">
                                <button type="reset" class="btn btn-default" data-dismiss="modal">Reset</button>
						        <button  data-dismiss="modal" type="submit" id="submit" class="btn btn-success" onClick="add_user_role();" >Save</button>
						      </div></form>
						    </div>
						  </div>
						</div>      				
      				</div><!-- /showback -->