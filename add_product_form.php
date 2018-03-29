
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog ">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">SKU Details</h4>
						      </div>
						      <div class="modal-body">
 <form class="cmxform form-horizontal"  onSubmit="return false"id="add_products"name="add_products"   >
                                <table id="add_products"><tr>
                                  <td>Product/Brand
                                  <input class=" form-control" id="product" name="product"  required ></td>
                                  <td>Variant <select  id="variant" class="form-control" name="variant"><option value="0">Select Variant</option><?php echo product_variant_selection()?></select>
                                 </td>
                                <td>Flavour
                                        <select  class=" form-control" id="flavour" name="flavour"><option value="">select</option><?php echo flavours_selection() ?>
                                      </select></td> 
                                                               
                                   <tr>
                                     <td>Pack size
                                   <select class="form-control " id="pack_size"  name="pack_size" ><option value="0">Select size</option><?php echo pack_size_selection()?></select></td>
                                   
                                      
                                      <td >Package Container
                                   <select class ="form-control " id="pack_type" name="pack_type" required>
                                          <option value="RGB">RGB</option>
                                          <option value="PET">PET</option>
                                           <option value="Can">Can</option>
                                          <option value="Tetra">Tetra</option>
                                      </select></td>
                                       <td>  SKU Type
                                       <select  class=" form-control" id="sku_type" name="sku_type"><option>Select type</option><option value="Juice">Juice</option><option value="Soda">Soda</option> <option value="Malt">malt</option><option value="Water">water</option></select>  </td>
                                  </tr>
                                  <tr>
                                    <td> Number per case <input type="number" name="units_in_a_case" id="units_in_a_case" class="form-control"  />
                                      </td>
                                    
                                     <td>  Price Per Case
                                      <input  type="text" class=" form-control" id="s_price" name="s_price" /> 
                                      </td>
                                      
                                      <td >Remarks
                                      <input  type="text" class=" form-control" id="description" name="description" /></td>
                                  </tr>
                                   
                                </table> 
                                <div class="modal-footer">
                               
                                        <input type="hidden" value="<?php echo $_SESSION['u_id']?>" name="user_id" id="user_id"/>
                                        
                                         
                                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button> <button class="btn btn-success" onClick="add_product()" type="submit">Save</button>
                                       
                                      </div>
                            </form>
						    </div>
						  </div>
						</div>      				
      				</div><!-- /showback -->