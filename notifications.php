 <div class="sidebar-toggle-box">
                  <div class="" data-placement="right" data-original-title="Toggle Navigation">  </div>
              </div>
        
 
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                 <li id="header_notification_bar" class="dropdown" >
                        <a  href="index.php">
                            <i class="fa fa-home"></i>
                           </a>
                        
                       
                    </li>
                    <!----//end home-->
                     <!-- notification dropdown start-->
                   <?php  $user_role=$_SESSION['user_role'];   
				   if($user_role==4){
                include ('fetch_notifications.php'); 
				}else
				 if($user_role==3){
					     ?> <li id="header_notification_bar" class="dropdown" >
                        <a data-toggle="dropdown" class="dropdown-toggle" href="add_client.php#">
                            <i class="fa fa-users"></i>
                            <span class="badge bg-important">Users</span> </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-yellow"></div>
                            <li>
                                <a href="users.php">All Users</a>
                            </li>
                            <li>
                                <a href="users.php?user_status=1">Deleted Users</a>
                            </li>
                            <li>
                                <a href="profile.php">My Profile</a>
                            </li>
                            
                        </ul>
                       <!--------sother menu---------- -->
                       
                          <li class="sub-menu">
                      <a href="sales_contributions.php" >
                            <i class="fa fa-cogs"></i>
                          <span>Sales Contributions</span>
                      </a> 
                  </li><li class="sub-menu">
                      <a href="targets.php" >
                          <i class="fa fa-cogs"></i>
                          <span>Targerts</span>
                      </a> 
                  </li><!------------------ -->
                    </li>
                    <!----/// end users --><?php
					 } if($user_role==2){
						  ?> <li id="header_notification_bar" class="dropdown" >
                        <a data-toggle="dropdown" class="dropdown-toggle" href="add_client.php#">
                            <i class="fa fa-users"></i>
                            <span class="badge bg-important">Users</span> </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-yellow"></div>
                            <li>
                                <a href="users.php">All Users</a>
                            </li>
                            <li>
                                <a href="users.php?user_status=1">Deleted Users</a>
                            </li>
                            <li>
                                <a href="profile.php">My Profile</a>
                            </li>
                        </ul>
                        <!--------sother menu---------- -->
                       
                          <li class="sub-menu">
                      <a href="sales_contributions.php" >
                            <i class="fa fa-cogs"></i>
                          <span>Sales Contributions</span>
                      </a> 
                  </li><li class="sub-menu">
                      <a href="targets.php" >
                          <i class="fa fa-cogs"></i>
                          <span>Targerts</span>
                      </a> 
                  </li><!------------------ -->
                    </li>
                    <!----/// end users --><?php
						 
						 }
				?>
                    <!-- notification dropdown end -->
                    
            </div>
             <!--logou -->
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="assets/lib/logout.php">Logout</a></li>
            	</ul>
            </div>