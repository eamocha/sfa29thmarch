<div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.php"><?php echo $pic;?></a></p>
              	  <h5  class="centered"><?php echo $_SESSION['f_name']?></h5>
                  	  <h5 style="font-size:9px; padding:0px" class="centered"><?php $user_role=$_SESSION['user_role'];
					  get_role($user_role) ?></h5>
                      <!--menu items-->
              	  	<?php if($_SESSION['user_role']==1){?>
                     <li class="sub-menu">
                      <a  <?php if($file=='index'||$file=='routes'||$file=='today_route_clients'||$file=='stock_report'||$file=='deliveries'){?> class="active"<?php }?> href="index.php" >
                  <i class=" fa fa-bar-chart-o"></i>Routes </a>                  </li> <?php }?>
                  
                  <li style="padding-top:0px !important; margin-top:0px" class="mt">
                      <a <?php if($file=='index'&& $_SESSION['user_role']!=1){?> class="active"<?php }?>
                       href="<?php if($_SESSION['user_role']==1){?> sales_dashboard.php<?php echo '"';} else{ ?>index.php"><?php }?>
                          <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                      </a>
                  </li>
                  
                                 
                  
                  
                  
                  
                 

                 <?php if($_SESSION['user_role']==4){//operations?>
                 <li class="sub-menu">
                   <a <?php if($file=='index'){?> class="active"<?php }?> href="operations_dashboard.php" >
                     <i class="fa fa-tasks"></i>
                   <span><?php echo get_role($_SESSION['user_role'])?></span></a> </li>
                   
                   
                   
                   
                   
                   
				
				<?php } if($_SESSION['user_role']==3){?>

                      
                        
                <li><a href="level_users.php">  <i class="fa fa-user"></i>Users</a></li>
                
                
                
                        
                        
                        
                        
                        
                        
                        
                  <?php }  if($_SESSION['user_role']==2){?>
                 
                <li><a href="level_users.php">  <i class="fa fa-user"></i>Users</a></li>
                
                
                  <?php } if($_SESSION['user_role']==4){?>
                <li class="sub-menu">
                        <a  <?php if($file=='users'||$file=='calender'||$file=='inbox'||$file=='todo_list'||$file=='faq'||$file=='file_upload'){?> class="active"<?php }?> href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Configurations</span>
                        </a>
                        <ul class="sub">
                          <li><a  href="users.php">Users</a></li>
                          
                          <li><a  href="all_stock_details.php">Products</a></li>
                          <li><a  href="regions.php">Regions</a></li>
                           
                          <li><a  href="trucks.php">Trucks</a></li>  
                           <li><a  href="outlet_classification.php">Outlet classification</a></li>  
                             <li><a  href="survey_questions.php">Survey Questions</a></li>  <li><a  href="settings.php">Other settings</a></li>                  
                          <li><a href="faq.php">Help</a></li>
                          
                        </ul>
                </li>
                <?php }if($_SESSION['user_role']==5){?>
                
                <li class="sub-menu">
                        <a  <?php if($file=='warehouse_dashboard'||$file=='preordered_stcok'||$file=='sold_stock'||$file=='stock'||$file=='pricing_table'){?> class="active"<?php }?> href="warehouse_dashboard.php" >
                          <i class="fa fa-book"></i>
                        <span><?php echo get_role(5)?></span></a> </li> 
                
                
                
                
                
                  <?php }if($_SESSION['user_role']==5||$_SESSION['user_role']==6){?>
                <li class="sub-menu">
                        <a  <?php if($file=='users'||$file=='calender'||$file=='inbox'||$file=='todo_list'||$file=='faq'||$file=='file_upload'){?> class="active"<?php }?> href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Configurations</span>
                        </a>
                        <ul class="sub">
                          <li><a  href="users.php">Users</a></li>
                          
                         
                          <li><a  href="distributors.php">Regions</a></li>
                           
                          <li><a  href="trucks.php">Trucks</a></li>  
                              
                          <li><a href="faq.php">Help</a></li>
                          
                        </ul>
                </li>
                  <?php }?>
              </ul>
              <!-- sidebar menu end-->
          </div>