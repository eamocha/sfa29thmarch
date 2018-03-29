 <?php $q=mysqli_query($mysqli,"SELECT l.date_time as dt, u.full_name as name, l.description as descr,u.user_id as uid,pport FROM `tbl_logs` l LEFT JOIN tbl_users u on l.user_id=u.user_id order by log_id desc LIMIT 5") or die(mysqli_error($mysqli));
$num=mysqli_num_rows($q);?><li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.php#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-theme"><?php echo $num; ?></span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have <?php echo $num; ?> log details</p>
                            </li>
                            <?php while($row=mysql_fetch_array($q)){?>
                            <li>
                                <a href="logs.php#">
                                    <span class="photo"></span>
                                    <span class="subject">
                                    <span class="from"><?php echo $row['name'];?></span>
                                    <span class="time"><?php echo nicetime($row['dt']);?></span>
                                    </span>
                                    <span class="message">
                                       <?php echo $row['descr'];?>
                                    </span>
                                </a>
                            </li><?php } ?>
                       <li>
                                <a href="logs.php#">See all Logs</a>
                            </li>
                        </ul>
                    </li>