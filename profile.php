<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  include'profile_process.php'; $user_id=$_SESSION['u_id'];  
     ?>     
     <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-fileupload/bootstrap-fileupload.css" />

<script type="text/javascript" src="assets/js/scripts.js" >     </script>
   
  <script type="text/javascript" >
      $(window).load(function(e) {
		  $(".form-control").hide();
		  $("#pass").click(function(){
			   $(".form-control").show();
			  });
		 
		  fetch_clients();
	assign_salesperson();
  
        
 //load select boxes
 		load_users();
		
		 });
  
 </script>

  </head>
  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
         <?php include 'notifications.php'?>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <?php include 'side_menu.php' ; $q=mysqli_query($mysqli,"SELECT * FROM `tbl_users` WHERE `user_id`=$user_id")or die(mysqli_error($mysqli));
$r=mysqli_fetch_array($q);?>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
     

      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row" id="pdfthis">
                  <div class="col-lg-9 main-chart">
                  
                      <!--CUSTOM CHART START -->
                      <div class="border-head " id="dontpdf">
                       
                         <h3 class="float_left">My Profile: <?php echo $_SESSION['f_name'];?></h3>
                         
                      </div>  
                     
                     <!--start -->           
                   <section id="pdfthis">
                            <table border="0" width="100%" class="  table-striped table-condensed">
                              <thead>
                              <tr>
                                <th><form action="upload_image.php" method="post" id="image_profile" enctype="multipart/form-data"><div class="col-md-9">
                          <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-preview thumbnail" style="max-width: 200px; max-height: 200px; line-height: 20px;"><?php echo $pic;?></div>
                            <div> <span class="btn btn-theme02 btn-file"> <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span> <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>  
                              <input type="file" name="image1" class="default" />
                            </span><span class=" fileupload-exists">  | <button  type="submit"><i class="fa fa-save"></i> Save</button> </span></div>
                          </div>
                        </div></form></th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>#</th>
                                <th class="numeric">&nbsp;</th>
                              </tr>
                              <tr>
                                <th>Logins</th>
                                <th><?php logins($user_id)?>
                                </th>
                                <th>&nbsp;</th>
                                <th> Registration Date</th>
                                <th><?php echo $r['date_registered'];?></th>
                                <th class="numeric">&nbsp;</th>
                              </tr>
                              <tr>
                                <th>Email</th>
                                <th><?php echo $_SESSION['email'];?></th>
                                <th>&nbsp;</th>
                                <th>Gender</th>
                                <th><?php  if($r['gender']==1) echo "Male"; else echo 'Female';?></th>
                                <th class="numeric">&nbsp;</th>
                              </tr>
                              <tr>
                                <th>Description</th>
                                <th><?php echo $r['description'];?></th>
                                <th>&nbsp;</th>
                                 <th>Mobile Number</th>
                                <th><?php echo $r['mobile'];?></th>
                               
                                <th class="numeric">&nbsp;</th>
                              </tr>
                              <form id="password_change" method="post" action="change_pass.php"><tr>
                                 <th><span class="fa fa-lock">Passord</span></th>
                                <th><span class="fa fa-exchange"></span><i id="pass" >Change</i></th>
                                <th><input type="password" name="old_pass"  placeholder="Old Password"class="form-control pass" id="old_pass"></th>
                                <th><input type="password" name="new_pass" placeholder="New Password" class="form-control pass" id="new_pass"></th>
                                <th><input class="form-control" type="submit" value="change"/></th>
                                <th class="numeric">&nbsp;</th>
                              </tr></form>
                              </thead>
                              <tbody>
                           
                               </tbody>
                          </table>
                          </section>
 
                         
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->       <span id="dontpdf">           
                 <?Php if($user_role==1){include('home_right.php');
				  } else include('home_right2.php');
				  ?></span>
              </div><!--/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
     <?php include('footer.php');?>
      <!--footer end-->
  </section>
    	<script type="text/javascript" src="assets/js/bootstrap-fileupload/bootstrap-fileupload.js"></script>	
    <script src="assets/js/bootstrap.min.js"></script>
    
	

    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	

 




 <!-- js placed at the end of the document so the pages load faster -->
    <!-- <script src="assets/js/jquery.js"></script> -->
	


    
  </body>
</html>

