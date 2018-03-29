
    <script type="text/javascript">

$(document).ready(function(e) {
	//hiding and showing
	

    var rowCount = document.getElementById('tblAppend').rows.length;
	no_rows();
	$("#Products").change(function(){
		$("#no_rows").remove();});
	function no_rows(){
	if(rowCount==1){ $("#tblAppend").append("<tr id='no_rows'><td colspan='6'>No products Yet</td></tr>");} else{
	}
		}
		//for the order empty order
		
		

	
});
//change
        function change() {
		var sel_val = document.getElementById("Products").value;
	        $("#tblAppend").append("<tr class='border thin'><td>"+sel_val+"</td>  <td><select  class='form-control' type='text' name='crates2' id='crates4'>    <option value='1'>1</option><option value='1'>2</option><option value='1'>3</option><option value='1'>8</option> <option value='1'>4</option><option value='1'>5</option> <option value='1'>6</option><option value='1'>7</option></select></td><td><select  class='form-control'  type='text' name='sbottlers2' id='sbottlers3'><option value='1'>1</option> <option value='1'>2</option> <option value='1'>3</option>  <option value='1'>8</option> <option value='1'>4</option> <option value='1'>5</option> <option value='1'>6</option><option value='1'>7</option></select></td><td>500</td></tr>");
                  }
				   

    </script>
	<style type="text/css">
table tr td{
	 background-color:#FFF;
margin:5px;
padding-top:20px;
padding-left:10px;}
tr th{
	background-color:inherit;
	 margin:5px;
	 padding-left:10px;}
	 
table{
	padding:5px;
	margin:5px;
	}
	
	.border{
		border-bottom:1px solid #c9cdd7;
		}
		tr .thin{
			padding:5px}
	tr .color{ background:none repeat scroll 0 0 #4ecdc4 !important}
	input[type='select']{
		width:auto}
</style>

<div class="col-lg-9 main-chart">
                   <?php include('submenu.php');?>
                     <table width="100%"><tr><th colspan="4"> <!--CUSTOM CHART START -->
                      <div class="border-head"><h3>Outlet Name:  <?php 
					echo business_name($dealer_id)?> </h3>
                      </div></th></tr>
                      
                     
                       <!--Deliver products-->
                      <tr id="deliver" class="deliver">
                        <td>Take stock & make delivery</td>
                        <td></td>
                        <td></td>
                        <td><div class="btn-group">
						  <button type="button" class="btn btn-theme03">Action</button>
						  <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
						    <span class="caret"></span>
						     </button>
						  <ul class="dropdown-menu" role="menu">
						    <li><a href="#">Print Receipt</a></li>
						    <li><a href="#">Credit Note</a></li>
						    <li><a href="#">Invoice</a></li>
						    <li class="divider"></li>
						    <li><a href="#">Partial Payment</a></li>
						  </ul>
						</div>      				</td>
                       </tr>
                     
  </table>
  <table class="deliver table table-bordered table-striped table-condensed" id="tblAppend" width="100%"><tr class="modal-header thin color"  >
                        <th>SKU</th>
                        <th>Packaging</th>
                        <th>Av.stock</th>
                        <th>#.ordered</th>
                        <th># to deliver </th>  <th>Price </th>
                      </tr><form action="process_delivery.php?oid=<?php echo $oid;?>" method="post" >
                      <input type="hidden" name="dealer_id" value="<?php echo $dealer_id?>" />
                     
                     <?php $q=mysqli_query($mysqli,"SELECT p.product_code as pcode, p.product_name as pname, o.quantity as qty, p.s_price as price,o.order_id as oid, o.order_details_id as odi FROM `tbl_orders_details` o left join tbl_products p on o.product_id=p.product_id WHERE order_id=$oid") or die(mysqli_error($mysqli));
					 if(mysqli_num_rows($q)==0){ echo '<tr><td colspan=5>No products to list</td></tr>';} else{
                     while($r=mysqli_fetch_array($q)){
						 ?>
						<tr><td><?php echo $r['pcode'] ?></td><td><?php echo $r['pname'] ?></td>
						<td><select class="" name="available_stock"><script type="text/javascript">
						for(i=0;i<200;i++){
							 document.write("<option val='"+i+"'>"+i+"</option>")
						}
                        </script></select></td><td><?php echo $r['qty']*$r['price'] ?></td><td><select class="" name="available_stock"><script type="text/javascript">
						for(i=0;i<200;i++){
							 document.write("<option val='"+i+"'>"+i+"</option>")
						}
                        </script></select></td><td><input type="checkbox"  value="<?php echo $r['odi']; ?>" name="selection[]" /></td></tr> <?php
						 	 }}?>
                      <tr><td>Remarks</td><td  colspan="4"><textarea cols="80" class="form-control" id="remarks" name="remarks"></textarea></td><td><input type="submit" class="btn btn-success btn-sm" value="Deliver & print receipt" /></td></tr>
                  </form>  </table>         
                      
                 
                  
                 
                  </div>