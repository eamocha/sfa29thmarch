
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-lg">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Users Details</h4>
						      </div>
						      <div class="modal-body">
						       
                  <form name="signupForm" action="" method="post" onsubmit="return false" id="signupForm" >
                
                               <table id="add_users"  style="margin:auto;"><tr><td>Name</td><td><input type="text" class=" form-control" id="full_name" name="full_name"></td><td>Email</td><td><input type="email" class=" form-control" id="email" name="email"></td><td> Phone No</td><td><input type="tel" class="form-control"  id="tel" name="tel"></td></tr>
                               <tr><td>Password</td><td><input  type="password" class=" form-control" id="password" name="password"></td><td>Confirm Password</td><td><input type="password"  class=" form-control" id="cpassword" name="cpassword"></td><td>Role</td><td><select class=" form-control"  id="role" name="role"><?php echo roles_selection()?></select></td></tr>
                               <tr><td>Emp No</td><td> <input type=" text" class="form-control" name="empno" id="empno"></td>
                               <td>Region</td><td><select class=" form-control"  id="region" name="region">
							   <?php echo region_selection()?>
                               </select></td>
                               <td>Area</td>
                               <td><select type="text"  class="form-control" id="area" name="area"><option>Select </option><?php echo area_selection()?></select></td></tr>
                               <tr>
                                 
                               <td>Sub area</td>
                               <td><select class=" form-control"  id="cluster" name="cluster">
                               <?php   echo cluster_selection()?>
							   
                               </select></td>
                               <td>Distributor</td>
                               <td><select type="text"  class="form-control" name="distributor" id="distributor"><?php echo distributor_selection()?></select></td><td>Description</td>
                                 <td> <input type=" text" class="form-control" name="description" id="description"></td></tr></table>
                              <div class="modal-footer">
						        <button type="reset" class="btn btn-default" data-dismiss="modal">Reset</button>
						        <button  data-dismiss="modal" type="submit" id="submit" class="btn btn-success" onClick="add_user();" >Save</button>
						      </div></form>
						    </div>
						  </div>
						</div>      				
      				</div><!-- /showback -->