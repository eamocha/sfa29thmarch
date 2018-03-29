
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-lg">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Outlet Details</h4>
						      </div>
						      <div class="modal-body">
						       
                 <form class="cmxform form-horizontal style-form"  onSubmit="return false" id="commentForm" method="post" action="">
                                <table id="add_users"><tr>
                                  <td>Outlet Name</td>
                                 <td><input class=" form-control" id="cname" name="cname" minlength="2" type="text" required /></td><td>Channel</td><td><select class="form-control " id="channel" name="channel" required ><?php category_select_list();?></select></td><td> Decision Maker</td><td><input placeholder="Name of person" class="form-control " id="decision_maker" type="phone" name="decision_maker" /></td></tr>
                               <tr>
                                 <td>Designation</td>
                                 <td><select class="form-control " id="designation" type="text" name="designation" required >
                                   <option value="1">Owner</option>
                                   <option value="2">Manager</option>
                                   <option value="3">Other</option>
                                 </select></td>
                                 <td>Type</td>
                                 <td><select name="type_of_outlet" id="type_of_outlet" class="form-control"><option value="0"> Outlet </option><option value="1"> Stockist </option></select></td>
                                 <td>Tel</td>
                                 <td><input type="text" class=" form-control" name="phone" id="phone" /></td>
                                 </tr>
                                 <tr>
                                 <td>Region</td>
                                 <td><select class="form-control" name="region_id" id="region_id"><option value="<?php echo $region_id=$_SESSION['region_id']?>"><?php echo region_name($region_id)?></option><?php echo region_selection();?>
                                 </select></td>
                                 <td>Town</td>
                                 <td><input class="form-control "  id="town" type="town" onFocus="geolocate()" name="town" /></td><td>Location</td><td><input type="text" class=" form-control" name="place_name" id="place_name"></td> 
                                 </tr>
                                 <tr>
                                   <td colspan="4">&nbsp;</td>
                                   <td align="right" colspan="2"><input type="hidden"  class=" form-control" id="lat" name="lat">
                                     </select>
                                     <input  type="hidden" class=" form-control" id="long" name="long">
                    
                                   <button class="btn btn-success" type="reset" data-dismiss="modal">Cancel</button>                 <button class="btn btn-success" onClick="add_client();" type="submit">Save</button></td>
                                  </tr>
                                </table>
                                  <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10"></div>
                              </div>
                            </form>
						    </div>
						  </div>
						</div>      				
      				</div><!-- /showback -->
                    
                    
                    
                   