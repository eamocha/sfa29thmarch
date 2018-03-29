
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog ">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Query Details</h4>
						      </div>
						      <div class="modal-body">
 <form class="cmxform form-horizontal"  onSubmit="return false" id="add_query_form" name="add_query_form"   >
                                <table><tr>
                                  <td colspan="3"><label for="query">Question Details</label>
                                  
                                    <textarea required="required" style="width:100%" name="question" id="question"  ></textarea></td>
                                  </tr>
                                  <tr><td><label>Type of answer?</label><br />
                                    <select id="query_type" name="query_type"><option value="EditText">Explanation required</option><option value="Radio">Dropdown/Single option</option><option value="CheckBox">Multiple Answers</option><option value="Number">Number required</option></select></td>
                                    
                                    <td colspan="2"><label>Category?</label>
                                        <select id="category" name="category">
                                         <?php select_qn_categories()?>
                                        </select>
                                    </p></td>
                                  </tr>
                                    <tr>
                                    
                                      <td><label>Support Details</label>
                                        <select id="support_details" name="support_details" ><option value="Nothing">Nothing</option><option value="Photos">Photos</option><option value="Description">Description</option><option value="Both">Both</option></select></td>  <td><label>Apply For</label>
                                    
                                        <select id="red_eds_dosa" name="red_eds_dosa">
                                          <?php red_eds_dosa()?>
                                          </select>
                                      </td>
                                      <td><label>ON/OFF</label>
                                        <select name="onOf" id="onOf">
                                          <option value="0">Yes</option>
                                          <option value="1">No</option>
                                      </select></td>
                                    </tr>
                                    <tr>
                                      <td><label>Select Region</label>
                                        <select name="region" id="reggion">
                                          <option value="0"> All</option>
                                          <?php echo region_selection()?>
                                      </select></td>
                                      <td><label>Compulsory</label>
                                        <input  required="required" name="required" id="required" value="1" type="checkbox" /> Yes</td>
                                      <td><label>Channel Type</label>
                                        <select name="channel" id="channel">
                                          <?php echo channel_selection()?>
                                      </select></td>
                                    </tr>
                                    <tr height="40px">
                                      <td><label>Score  for Gold</label>
                                      <input  required="required" type="number" id="score_gold" name="score_gold" /></td>
                                      <td><label>Scor for Silver</label>
                                      <input  required="required" type="number" id="score_silver" name="score_silver" /></td>
                                      <td><label>Score for Bronze</label>
                                      <input  required="required" type="number" id="amnt_bronze" name="score_bronze" /></td>
                                    </tr>
                                    <tr height="40px">
                                      <td colspan="3"><span id="opts"> <label>Options(Separated by semicolons eg Yes;No;Dont Know</label><textarea required="required" cols="30" name="options" id="options"></textarea> </span></td>
                                    </tr>
                                </table> 
                                <div class="modal-footer">
                               
                                        <input  required="required" type="hidden" value="<?php $_SESSION['u_id']?>" name="user_id" id="user_id"/>
                                        
                                         
                                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button> <button class="btn btn-success" data-dismiss="modal" onClick="add_question()" type="submit">Save</button>
                                       
          </div>
                            </form>
                            
                            <script type="text/javascript">
                            </script>
						    </div>
						  </div>
						</div>      				
      				</div><!-- /showback -->