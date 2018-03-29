	<style>
    .active{
		background-color:#ebebeb;
		
		}</style>
    <div class="btn-group float_right"><?php if($user_role==1) {//sales?>
						 <div class="btn-group">
					 <button type="button"  class="btn btn-default dropdown-toggle" data-toggle="dropdown">Routes
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
						      <li><a href="routes">Current Routes </a></li>
						      <li><a href="sales_past_routes">Past routes </a></li>
						    </ul>
						  </div> 
                         <a href="deliveries" ><span type="button" class="btn btn-default">Deliveries</span></a>
                          <a href="sales_preorder"> <span type="button" class="btn btn-default">Preorders</span></a>
						   <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Outlets
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
						      <li><a href="sales_add_client">Add </a></li>
                              <li><a href="prospecting">Prospecting outlets </a></li>
                               <li><a href="stockist_outlets">Distributors </a></li>
                              <li><a href="view_routes">Outlet Routes </a></li>
						      <li><a href="sales_clients_list">All outlets </a></li>
                              <li><a href="map_outlets" target="_blank">Map outlets </a></li>
                              
                                 
                               <li><a href="fullcalendar/index" target="_blank">Plan your route</a></li>
						    </ul>
						  </div>
                           <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Payments
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
						      
						      <li><a href="clients_collect_cash">Collect Cash </a></li><li><a href="past_payments">Past payments </a></li>
						    </ul>
						  </div>
						     					
      				<?php } else if($user_role==0) {//distributor  2?>
                    
						  <div class="btn-group">
					 <button type="button"  class="btn btn-default dropdown-toggle" data-toggle="dropdown">Routes
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
						      <li><a href="routes">Current Routes </a></li>
						      <li><a href="sales_past_routes">Past routes </a></li>
						    </ul>
						  </div> 
						  <a href="deliveries" ><span type="button" class="btn btn-default">Deliveries</span></a>
						  <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Outlets
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
						     <li><a href="sales_add_client">Add Outlet</a></li>
						      <li><a href="sales_clients_list">View Outlets</a></li>
                            
						    </ul>
						  </div>
                           <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Payments
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
						      <li><a href="clients_collect_cash">Collect Cash </a>
                              </li><li><a href="past_payments">Past payments </a></li>
						    </ul>
						  </div>
					
                    
						<?php }  else if($user_role!=1) {///operations?>
                         <!-- end item--> 
                           <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						     SFE Reports
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
                              <li><a href="daily_perfomance">Daily performance </a></li>
                               <li><a href="sfe">SFE </a></li>
                                    <li><a href="sfe_summary">SFE Summary</a></li>
						      <li><a href="route_completion">Route completion Report</a></li>
                          		<li><a href="fullcalendar/index">Staff Plans</a></li>
                            <li><a href="tsr_plan_lists">AD Day Plan</a></li>
                            <li><a href="monthly_plans">Monthly AD Plan Lists</a></li>
                              <li><a href="track_me?uid=1">Track People</a></li>
                               <li><a href="daily_sell_out_report">Daily sale out report</a></li>
                                  <li><a href="daily_sales_report_detailed">Daily sales report Detailed</a></li>
                                   <li><a href="route_completion_summary">Route completion Summary</a></li>
						    </ul>
						  </div>
                          <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Sales Reports
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
                        <li><a href="route_sales">Route Perfomance</a></li>
                         <li><a href="daily_sellOut">Daily sell Out Report(Distr)</a></li>
                           <li><a href="sellout_summary">Sell Out summary Report(area)</a></li>
                         <li><a href="area_monthlysellout_summary">Monthly SellOut summary Report(area)</a></li>
                        
                       <li><a href="sales_by_brand">By brand</a><a href="#"></a></li>
                       <li><a href="sales_by_outlet">By outlet</a><a href="#"></a></li>
                       <li><a href="sales_by_salesperson">By Salesperson</a><a href="#"></a></li>
                          <li><a href="sales_summary">By Sumary</a></li>
                          <li><a href="sales_per_region">By Region</a></li>
                           <li><a href="region_report">Region Route completion </a></li>
                       <li><a href="sales_per_month">Sales Per month </a></li>
                   
                       
						    </ul>
						  </div>
                      <!--- end this-->
                       <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Stock Reports
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
                             <li><a href="distributor_stocks">Distributor Stocks</a></li>
                         <li><a href="distributor_stock_persku">Stock Per Sku per Day</a></li>
                           <li><a href="distributor_stock_perbrand">Stock By Brand Per day</a></li>
                             <li><a href="distributor_stock_perpack">Per pack</a></li>
                               <li><a href="stock_summary">Skus list Sumary</a></li>
                         <li><a href="stock_status">SKu Status</a><a href="#"></a></li>
                         <li><a href="stock_sales">Sales</a></li>
                         <li><a href="tsr_stock_holding">AD Stock Holding</a></li>
                         <li><a href="stock_levels">By outlet</a></li>
						    </ul>
						  </div><!-- end this--->
                           <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Survey
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
                            
                         <li><a href="dosa_raw_data_per_distributor">DOSA Raw per Distributor</a></li>
                         <li><a href="dosa_summary">DOSA scores Summary</a></li>
               
                                 
                          <li><a href="stock_levels">EDS</a></li>
                            <li><a href="survey_report_operations">Marketing Materials Report</a></li>
						    </ul>
						  </div>
                                        
                          <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						     Work Book
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
                      
                       <li><a href="good_morning_meetings">Good Morning Meetings</a></li>
                       <li><a href="commecrialRoutinesTracker_web">Commercial routines Tracker</a></li>
                         <li><a href="verified_outletsReport">Status of Verification per area</a></li>
                           <li><a href="visit_objectives">Outlet Visit Objectives</a></li>
                            <li><a href="couching_plans">Couching plans</a></li>
                          <li><a href="workbook">Monthy</a></li>
                       <li><a href="month_daily">Weekly</a></li>
                            <li><a href="visits_monthly">monthly Visit report</a></li>
                                <li><a href="sales_monthly">Sales Visit report</a></li>

                       
						    </ul>
						  </div>
                          
                          <!-- end item--> 
                          <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Order Reports
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
						      <li><a href="upcoming_orders_report">Upcoming</a><a href="#"></a></li>
                         <li><a href="expired_orders_report">Expired Orders</a></li>
                         <li><a href="delivered_orders_report">Delivered</a></li>
                         <li><a href="order_rejected">Rejected</a><a href="#"></a></li>
                         <li><a href="orders_summary">Summary</a></li>
						    </ul>
						  </div>
                          <!-- end item--> 
                           
                          
                         
                       
                           <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Outlets
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
                            <li><a href="stockist_outlets">Stockists</a></li>
						      <li><a href="all_outlets">Outlets List</a></li>
                              <li><a href="map_all_outlets">View Outlets On map</a></li>
                              <li><a href="new_outlets">New statistics</a></li>
                              <li><a href="new_outlets_listing">New Outlets listing</a></li>
                                <li><a href="prospecting">Prospecting outlets</a></li>
                              <li><a href="outlet_categories">By categories</a></li>
                                 <li><a href="user_statistics">Daily registrations</a></li>
                              <li><a href="deleted_outlets">Deleted Outlets</a></li>
                              <li><a href="outlet_visit_status">Dormant Outlets</a></li>
						    </ul>
						  </div>
                          <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Assets
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
                         <li><a href="assets">assets</a></li>
                          <li><a href="faulty_assets">Faulty_assets</a></li>
                         <li><a href="assetreports">Categories</a></li>
                         <li><a href="assetby_region">By Region</a></li>
                         <li><a href="verified_assets">Verified assets</a></li>
                         <li><a href="photos">Asset photos</a></li>
                           <li><a href="asset_movement">Asset movements</a></li>
						    </ul>
						  </div>
                            <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Payments
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
						      <li><a href="clients_collect_cash">Collect Cash </a>
                               </li><li><a href="past_payments">Past payments </a></li>
                                 <li><a href="list_ofpayments">List of Payments</a></li>
                         <li><a href="payments_by_outlet">By Outlet</a></li>
                         <li><a href="payements_by_month">By  Month</a></li>
                          <li><a href="mode_of_payments">Mode of Payment</a></li>
						    </ul>
						  </div>
					<?php }  else if($user_role==0) {///warehouse 33?>
            			    <div class="btn-group active">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Inventory
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
						      <li><a href="add_product">Add new product</a></li>
                              <li><a href="issue">Issue stock </a></li>
                              <li><a href="inventory">View Inventory </a></li>
						      </ul>
						  </div> 
                           <div class="btn-group active">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Assets
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
						      <li><a href="add_asset">Add asset</a></li>
                              <li><a href="issue_asset">Issue Asset </a></li>
                              <li><a href="assets">View Assets </a></li>
						      </ul>
						  </div> 
                          <div class="btn-group active">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Pre orders
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
						      <li><a href="unapproved_orders">Unapproved Orders</a></li>
                              <li><a href="approved_orders">Approved orders </a></li>
						      <li><a href="executed_orders">Executed orders</a></li>
                              <li><a href="deleted_orders">Deleted orders</a></li>
                              <li><a href="rejected_orders">Declined orders</a></li>
                              
						    </ul>
						  </div>
                           <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Sales
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
						      <li><a href="#">per Individuals </a></li>
                              <li><a href="#">Time Period </a></li>
						      <li><a href="#">Per regions </a></li>
						    </ul>
						  </div>
                            <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Outlets
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
						     <li><a href="sales_add_client">Add Outlet</a></li>
						         <li><a href="user_statistics">Daily registrations</a></li>
                                 <li><a href="sales_clients_list">Verified outlets</a></li>
                                 <li><a href="map_all_outlets" target="_blank">Map outlets </a></li>
                               
                                    <li><a href="sales_clients_list">Deleted outlets</a></li>
						    </ul>
						  </div>
                         <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Payments
						      <span class="caret"></span>
						    </button>
						    <ul class="dropdown-menu">
						      <li><a href="clients_collect_cash">Collect Cash </a>
                              </li><li><a href="past_payments">My payments </a></li>
                              <li><a href="payment_history">Past payments </a></li>
						    </ul>
						  </div>
						  <?php }  else if($user_role==0) {//////11?>
            			    <div class="btn-group active">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Faulty Coolers and fridges
						     
						    </button>
						   
						  </div> 
                           <div class="btn-group active">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      Repaired Coolers
						    </button>
						   
						  </div> 
                          <div class="btn-group active">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						      All coolers
						    </button>
					
						  </div>
                           
                         <div class="btn-group">
						    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						       Summary statistics
                              
						    </button>
						   
						  </div>
						  <?php } ?>
                        </div><!--outer div-->
                        	