<?php // include ("assets/lib/config.php"); include ("assets/lib/functions.php");
$user_role=0;
if(isset($_SESSION['user_role'])) $user_role=$_SESSION['user_role'];


$sel=$mysqli->query("SELECT n.`title` as about, n.priority as pr, u.full_name as full_name, n.date_time as dt FROM `tbl_notification` n left join tbl_users u on u.user_id= n.`from` WHERE n.`status`=0 and n.to=$user_role OR n.to=0 order by notification_id desc")or die(mysqli_error($mysqli));
 $num=mysqli_num_rows($sel);
?>
  <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="notifications.php#">
                            <i class="fa fa-bell-o"></i>
                            <span class="badge bg-important"><?php echo $num?></span> </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-yellow"></div>
                            <li>
                                <p class="yellow">You have <?php if($num==0) echo 'no'; else echo $num?> new notifications</p>
                            </li>
                                   <?php while($r=mysqli_fetch_array($sel)) {?> 
                                    <li>
                                <a href="index.php#">
                                    <?php if($r['pr']==2){?><span class="label label-danger"><i class="fa fa-bolt"></i></span><?php } else if($r['pr']==1){?><span class="label label-danger"><i class="fa fa-bolt"></i></span><?php } else {?>  <span class="label label-success"><i class="fa fa-plus"></i></span><?php }?>
                                    <?php echo $r['about'] . " .By " . $r['full_name']?>
                                    <div class="small italic"><?php echo nicetime($r['dt'])?></div>
                                </a>
                            </li>               
                            
					<?php }?>
                    <li>
                                <a href="view_notifications.php">See all notifications</a>
                            </li>
                        </ul>
                    </li>
                    
                    
                      
                     <li id="header_notification_bar" class="dropdown" >
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
                       
                    </li>
                    <!----/// end users -->
                   
                      <li id="header_notification_bar" class="dropdown" >
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-question-circle"></i>
                            <span class="badge bg-important">Qns</span> </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-yellow"></div>
                            <li>
                                <a href="survey_questions.php">All Questions</a>
                            </li>
                             <li>
                                <a href="survey_questions.php">EDS qns</a>
                            </li>
                             <li>
                                <a href="survey_questions.php">Dosa</a>
                            </li>
                             <li>
                                <a href="survey_questions.php">RED</a>
                            </li>
                                                    </ul>
                       
                    </li> <!---- end users -->
                    
                     <li class="sub-menu">
                      <a href="regions.php" >
                          <i class=" fa fa-sitemap"></i>
                          <span>Regions</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="all_stock_details.php" >
                          <i class=" fa fa-bar-chart-o"></i>
                          <span>SKUs</span>
                      </a>
                  </li>
                       <li class="sub-menu">
                      <a href="trucks.php" >
                          <i class=" fa fa-truck"></i>
                          <span>Trucks</span>
                      </a>
                       </li>
                        <li class="sub-menu">
                      <a href="outlet_classification.php">
                          <i class="fa fa-tasks"></i>
                          <span>Channels</span>
                      </a> 
                  </li>
                    <li class="sub-menu">
                      <a href="settings.php" >
                          <i class="fa fa-cogs"></i>
                          <span> settings</span>
                      </a> 
                  </li>
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
                  </li><li class="sub-menu">
                      <a href="stocking_settings.php" >
                          <i class="fa fa-question"></i>
                          <span>Stocking standards</span>
                      </a> 
                  </li>
                </ul>
                <!--  notification end -->