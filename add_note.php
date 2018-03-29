						<!-- MODALS -->
      				<div class="showback">
      					<!-- Button trigger modal -->
						<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
						Create Notification
						</button>
                        <!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Notification Details</h4>
						      </div>
						      <div class="modal-body">
						       
                 <form name="signupForm" id="signupForm" action="add_notification.php?uid=$<?php echo $user_id ?>" method="post">
                               <table class="notify" id="notify"  ><tr>
                                   <td>About</td><td><input type="text" class=" form-control" id="about" name="about"></td>
                               <td>Priority</td>
                               <td><select name="priority"><option value="1"> high</option><option value="2"> Medium</option><option value="3"> Low</option></select></td>
                               <td>To</td><td><select name="to"> <option value="1"> All</option><option value="2"> sales</option><option value="3"> operations</option><option value="4">Executive</option> </select></td></tr>
                               <tr>
                                 <td>Details</td>
                                 <td colspan="5">
                                 <textarea name="note" id="note" cols="45" rows="5"></textarea></td>
                               </tr>
                               
                               </table>
                         
                 </form>
                              <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        <button  type="submit" class="btn btn-primary">Save</button>
						      </div></form>
						    </div>
						  </div>
						</div>      				
      				</div><!-- /showback -->