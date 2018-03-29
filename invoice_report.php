<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> <?php require 'header.php'; ?>
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
			 <div class="col-lg-12 mt">
			 
				<div class="row content-panel">
					<div class="col-lg-10 col-lg-offset-1">
						<div class="invoice-body">
							<div class="pull-left"> 
								<h1>DASHIO</h1>
								<address>
								<strong>Admin Theme, Inc.</strong><br>
								795 Asome Ave, Suite 850<br>
								New York, 94447<br>
								<abbr title="Phone">P:</abbr> (123) 456-7890
								</address>
							</div><!-- /pull-left -->
							
							<div class="pull-right">
								<h2>invoice</h2>
							</div><!--/pull-right -->
							
							<div class="clearfix"></div>
							<br>
							<br>
							<br>
							<div class="row">
								<div class="col-md-9">
									<h4>Paul Smith</h4>
									<address>
									<strong>Enterprise Corp.</strong><br>
									234 Great Ave, Suite 600<br>
									San Francisco, CA 94107<br>
									<abbr title="Phone">P:</abbr> (123) 456-7890
									</address>
								</div><!--/col-md-9 -->
								<div class="col-md-3"><br>
									<div>
										<div class="pull-left"> INVOICE NO : </div>
										<div class="pull-right"> 000283 </div>
										<div class="clearfix"></div>
									</div>
								<div><!-- /col-md-3 -->
								<div class="pull-left"> INVOICE DATE : </div>
								<div class="pull-right"> 15/03/14 </div>
								<div class="clearfix"></div>
							</div><!--/row -->
							<br>
							<div class="well well-small green">
								<div class="pull-left"> Total Due : </div>
								<div class="pull-right"> 8,000 USD </div>
								<div class="clearfix"></div>
							</div>
						</div><!-- /invoice-body -->
					</div><!--/col-lg-10 -->
					<table class="table">
						<thead>
						<tr>
						<th style="width:60px" class="text-center">QTY</th>
						<th class="text-left">DESCRIPTION</th>
						<th style="width:140px" class="text-right">UNIT PRICE</th>
						<th style="width:90px" class="text-right">TOTAL</th>
						</tr>
						</thead>
							<tbody>
								<tr>
								<td class="text-center">1</td>
								<td>Flat Pack Heritage</td>
								<td class="text-right">$429.00</td>
								<td class="text-right">$429.00</td>
								</tr>
								<tr>
								<td class="text-center">2</td>
								<td>Carry On Suitcase</td>
								<td class="text-right">$300.00</td>
								<td class="text-right">$600.00</td>
								</tr>
								<tr>
								<td colspan="2" rowspan="4" ><h4>Terms and Conditions</h4>
									<p>Thank you for your business. We do expect payment within 21 days, so please process this invoice within that time. There will be a 1.5% interest charge per month on late invoices.</p>
								<td class="text-right"><strong>Subtotal</strong></td>
								<td class="text-right">$1029.00</td>
								</tr>
								<tr>
								<td class="text-right no-border"><strong>Shipping</strong></td>
								<td class="text-right">$0.00</td>
								</tr>
								<tr>
								<td class="text-right no-border"><strong>VAT Included in Total</strong></td>
								<td class="text-right">$0.00</td>
								</tr>
								<tr>
								<td class="text-right no-border"><div class="well well-small green"><strong>Total</strong></div></td>
								<td class="text-right"><strong>$1029.00</strong></td>
								</tr>
							</tbody>
					</table>
					<br>
					<br>
		</div><!--/col-lg-12 mt -->
				
			
	</section><!--/wrapper -->
  </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2014 - Alvarez.is
              <a href="invoice.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--script for this page-->
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
