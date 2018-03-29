<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="assets/js/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
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
        <!-- page start-->
        <div class="row mt">
            <div class="col-sm-3">
                <section class="panel">
                    <div class="panel-body">
                        <a href="mail_compose.php"  class="btn btn-compose">
                            <i class="fa fa-pencil"></i>  Compose Mail
                        </a>
                        <ul class="nav nav-pills nav-stacked mail-nav">
                            <li class="active"><a href="inbox.php"> <i class="fa fa-inbox"></i> Inbox  <span class="label label-theme pull-right inbox-notification">3</span></a></li>
                            <li><a href="#"> <i class="fa fa-envelope-o"></i> Send Mail</a></li>
                            <li><a href="#"> <i class="fa fa-exclamation-circle"></i> Important</a></li>
                            <li><a href="#"> <i class="fa fa-file-text-o"></i> Drafts <span class="label label-info pull-right inbox-notification">8</span></a></a></li>
                            <li><a href="#"> <i class="fa fa-trash-o"></i> Trash</a></li>
                        </ul>
                    </div>
                </section>

                <section class="panel">
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked labels-info ">
                            <li> <h4>Friends Online</h4>
                            <a href="#"></a></li>
                            <li><a href="#"><p>Offline</p></a></li>
                        </ul>
                        <a href="#"> + Add More</a>

                        <div class="inbox-body text-center inbox-action">
                            <div class="btn-group">
                                <a class="btn mini btn-default" href="javascript:;">
                                    <i class="fa fa-power-off"></i>
                                </a>
                            </div>
                            <div class="btn-group">
                                <a class="btn mini btn-default" href="javascript:;">
                                    <i class="fa fa-cog"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-sm-9">
                <section class="panel">
                    <header class="panel-heading wht-bg">
                       <h4 class="gen-case">Inbox (3)
                        <form action="#" class="pull-right mail-src-position">
                            <div class="input-append">
                                <input type="text" class="form-control " placeholder="Search Mail">
                            </div>
                        </form>
                       </h4>
                    </header>
                    <div class="panel-body minimal">
                        <div class="mail-option">
                            <div class="chk-all">
                                <div class="pull-left mail-checkbox">
                                    <input type="checkbox" class="">
                                </div>

                                <div class="btn-group">
                                    <a data-toggle="dropdown" href="#" class="btn mini all">
                                        All
                                        <i class="fa fa-angle-down "></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"> None</a></li>
                                        <li><a href="#"> Read</a></li>
                                        <li><a href="#"> Unread</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="btn-group">
                                <a data-original-title="Refresh" data-placement="top" data-toggle="dropdown" href="#" class="btn mini tooltips">
                                    <i class=" fa fa-refresh"></i>
                                </a>
                            </div>
                            <div class="btn-group hidden-phone">
                                <a data-toggle="dropdown" href="#" class="btn mini blue">
                                    More
                                    <i class="fa fa-angle-down "></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                    <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                </ul>
                            </div>
                            <div class="btn-group">
                                <a data-toggle="dropdown" href="#" class="btn mini blue">
                                    Move to
                                    <i class="fa fa-angle-down "></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                    <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                </ul>
                            </div>

                            <ul class="unstyled inbox-pagination">
                                <li><span>1-50 of 99</span></li>
                                <li>
                                    <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                                </li>
                                <li>
                                    <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="table-inbox-wrap ">
                            <table class="table table-inbox table-hover">
                        <tbody>
                        <tr class="unread">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="view-message  dont-show">&nbsp;</td>
                            <td class="view-message ">&nbsp;</td>
                            <td class="view-message  inbox-small-cells">&nbsp;</td>
                            <td class="view-message  text-right">&nbsp;</td>
                        </tr>
                        <tr class="unread">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="view-message dont-show">&nbsp;</td>
                            <td class="view-message">&nbsp;</td>
                            <td class="view-message inbox-small-cells"></td>
                            <td class="view-message text-right">&nbsp;</td>
                        </tr>
                        <tr class="unread">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="view-message dont-show">&nbsp;</td>
                            <td class="view-message">&nbsp;</td>
                            <td class="view-message inbox-small-cells"></td>
                            <td class="view-message text-right">&nbsp;</td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="view-message dont-show">&nbsp;</td>
                            <td class="view-message">&nbsp;</td>
                            <td class="view-message inbox-small-cells"></td>
                            <td class="view-message text-right">&nbsp;</td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="view-message dont-show">&nbsp;</td>
                            <td class="view-message">&nbsp;</td>
                            <td class="view-message inbox-small-cells"></td>
                            <td class="view-message text-right">&nbsp;</td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="view-message dont-show">&nbsp;</td>
                            <td class="view-message">&nbsp;</td>
                            <td class="view-message inbox-small-cells">&nbsp;</td>
                            <td class="view-message text-right">&nbsp;</td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="view-message dont-show">&nbsp;</td>
                            <td class="view-message">&nbsp;</td>
                            <td class="view-message inbox-small-cells">&nbsp;</td>
                            <td class="view-message text-right">&nbsp;</td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="view-message dont-show">&nbsp;</td>
                            <td class="view-message view-message">&nbsp;</td>
                            <td class="view-message inbox-small-cells"></td>
                            <td class="view-message text-right">&nbsp;</td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="view-message dont-show">&nbsp;</td>
                            <td class="view-message view-message">&nbsp;</td>
                            <td class="view-message inbox-small-cells"></td>
                            <td class="view-message text-right">&nbsp;</td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="view-message dont-show">&nbsp;</td>
                            <td class="view-message view-message">&nbsp;</td>
                            <td class="view-message inbox-small-cells"></td>
                            <td class="view-message text-right">&nbsp;</td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="view-message dont-show">&nbsp;</td>
                            <td class="view-message">&nbsp;</td>
                            <td class="view-message inbox-small-cells"></td>
                            <td class="view-message text-right">&nbsp;</td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="dont-show">&nbsp;</td>
                            <td class="view-message">&nbsp;</td>
                            <td class="view-message inbox-small-cells">&nbsp;</td>
                            <td class="view-message text-right">&nbsp;</td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="view-message dont-show">&nbsp;</td>
                            <td class="view-message">&nbsp;</td>
                            <td class="view-message inbox-small-cells">&nbsp;</td>
                            <td class="view-message text-right">&nbsp;</td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="dont-show">&nbsp;</td>
                            <td class="view-message view-message">&nbsp;</td>
                            <td class="view-message inbox-small-cells"></td>
                            <td class="view-message text-right">&nbsp;</td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="view-message dont-show">&nbsp;</td>
                            <td class="view-message">&nbsp;</td>
                            <td class="view-message inbox-small-cells"></td>
                            <td class="view-message text-right">&nbsp;</td>
                        </tr>
                        <tr class="">
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="inbox-small-cells">&nbsp;</td>
                            <td class="view-message dont-show">&nbsp;</td>
                            <td class="view-message">&nbsp;</td>
                            <td class="view-message inbox-small-cells"></td>
                            <td class="view-message text-right">&nbsp;</td>
                        </tr>
                        </tbody>
                        </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
			
			
			
			
		</section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2014 - Alvarez.is
              <a href="inbox.html#" class="go-top">
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
