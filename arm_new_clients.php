<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php';  $area_id=$_SESSION['area_id'];
	
   ?>
     <script type="text/javascript" src="assets/js/scripts.js" >     </script>

  
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
      *********************************************************************************************************************************************************** --> <!--sidebar start
      <aside>
          <?php //include 'side_menu.php'?>
      </aside>
      sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                <div class="col-lg-9 main-chart">
                  
                      <!--CUSTOM CHART START -->
                      <div class="border-head">
                        <?php include('submenu.php');?>
                         <h3 class="float_left">Unverified Outlets List</h3>
                      </div>
                      
                   <div  style="padding-bottom:20px" class="float_left">
  <form action="<?php $_SERVER['PHP_SELF']?>" method="post"><table ><tr> <td width="19">From</td>
                       <td width="19"><input type="text" class="form-control dpd1" value="<?php echo date("Y-m-d")?>"  id="from" name="from"></td>
                       <td width="40">To</td>
                      <td width="147"><input type="text" class="form-control dpd1"  value="<?php echo date("Y-m-d")?>" id="to" name="t"></td><td><select onchange="fetch_unverified_clients_in_area();" class="form-control sales_person_selection" id="user" name="user"></select></td><td>&nbsp;</td><td><a class="btn btn-small btn-success" onClick="fetch_unverified_clients_in_area()" id="submit" name="submit" >Search</a></td></tr></table></form> </div></span>
                     <!--start -->      <div >Outlets for <strong id="list_title"></strong></div>  
                   <!--start -->           
                <table width="100%" cellpadding='0' cellspacing='0' border='0' class='"table table-bordered table-striped table-condensed ' ><thead><tr><th width="0%"></th> <th >Outlet Name</th> <th width="9%">Opening T</th><th>closing T</th>
                              <th >channel</th>
                                  <th>Town/location</th>
                              <th  >Incharge &amp; Dsgn</th><th  class='hidden-phone'>Phone</th> <th  >No. of Qns</th><th class="pg" >Actions</th></tr></thead>
            <tbody id="unverified_clients_in_area_list">
                  <tr><td  colspan="7">     <img src="images/37.gif"> </tr>        </tbody>
                            </table>
  
  <?php include 'qplan.php';?>
 
                         
                </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                 <?Php if($user_role==1){include('home_right.php');
				  } else include('home_right2.php');
				  ?>
              </div><!--/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
     <?php include('footer.php');?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.min.js"></script>

  
	
	<script type="application/javascript">
       $(document).ready(function () {
	  
		  fetch_unverified_clients_in_area()
            
                       load_users();
  });
        
        
       
    </script>
    	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    	<script src="assets/js/advanced-form-components.js"></script>  
	




    
  </body>
</html>
