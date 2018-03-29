
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
          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> Multiple Files Uploader</h3>
          	<div class="row mt">
				<div class="col-lg-12">
				
					<!-- The file upload form used as target for the file upload widget -->
					<form id="fileupload" action="http://jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
						<!-- Redirect browsers with JavaScript disabled to the origin page -->
					  <noscript>
					      <input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/">
					  </noscript>
				  
					  <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
					  <div class="row fileupload-buttonbar">
					      <div class="col-lg-8">
					          <!-- The fileinput-button span is used to style the file input field as button -->
					        <span class="btn btn-success fileinput-button">
					        <i class="glyphicon glyphicon-plus"></i>
					        <span>Add files...</span>
					        <input type="file" name="files[]" multiple>
					        </span>
					          <button type="submit" class="btn btn-theme start">
					              <i class="glyphicon glyphicon-upload"></i>
					              <span>Start upload</span>
					          </button>
					          <button type="reset" class="btn btn-theme02 cancel">
					              <i class="glyphicon glyphicon-ban-circle"></i>
					              <span>Cancel upload</span>
					          </button>
					          <button type="button" class="btn btn-theme04 delete">
					              <i class="glyphicon glyphicon-trash"></i>
					              <span>Delete</span>
					          </button>
					          <input type="checkbox" class="toggle">
					          <!-- The global file processing state -->
					          <span class="fileupload-process"></span>
					      </div><!-- /col-lg-7 -->
					      
					      <!-- The global progress state -->
					      <div class="col-lg-4 fileupload-progress fade">
					          <!-- The global progress bar -->
					          <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
					              <div class="progress-bar progress-bar-success" style="width:0%;">
					              </div>
					          </div>
					          <!-- The extended global progress state -->
					          <div class="progress-extended">
					              &nbsp;
					          </div>
					      </div><!-- /col-lg-5 -->
					  </div><!-- /row -->
					  
					  <!-- The table listing the files available for upload/download -->
					  <table role="presentation" class="table table-striped">
					      <tbody class="files">
					      </tbody>
					  </table>
				 </form>
				 
				 
				<br>
				<div class="content-panel">
				  <div class="panel-body">
				  		<h4>Demo Notes</h4>
				      <ul>
				          <li>The maximum file size for uploads in this demo is <strong>5 MB</strong> (default file size is unlimited).</li>
				          <li>Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in this demo (by default there is no file type restriction).</li>
				          <li>Uploaded files will be deleted automatically after <strong>5 minutes</strong> (demo setting).</li>
				          <li>You can <strong>drag &amp; drop</strong> files from your desktop on this webpage (see <a href="https://github.com/blueimp/jQuery-File-Upload/wiki/Browser-support">Browser support</a>).</li>
				          <li>Please refer to the <a href="https://github.com/blueimp/jQuery-File-Upload">project website</a> and <a href="https://github.com/blueimp/jQuery-File-Upload/wiki">documentation</a> for more information.</li>
				          <li>Built with Twitter's <a href="http://twitter.github.com/bootstrap/">Bootstrap</a> CSS framework and Icons from <a href="http://glyphicons.com/">Glyphicons</a>.</li>
				      </ul>
				  </div>
				</div><!--/panel -->
				
				<!-- The blueimp Gallery widget -->
				<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
				  <div class="slides"></div>
				  <h3 class="title"></h3>
				  <a class="prev">‹</a>
				  <a class="next">›</a>
				  <a class="close">×</a>
				  <a class="play-pause"></a>
				  <ol class="indicator"></ol>
				</div>
				
				</div>
             </div> 
			
		</section><!--/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <?php include 'footer.php'?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--script for this page-->
    
	<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
	<script src="assets/js/file-uploader/js/vendor/jquery.ui.widget.js"></script>
	<!-- The Templates plugin is included to render the upload/download listings -->
	<script src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
	<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js"></script>
	<!-- The Canvas to Blob plugin is included for image resizing functionality -->
	<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
	
	<!-- blueimp Gallery script -->
	<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="assets/js/file-uploader/js/jquery.iframe-transport.js"></script>
	<!-- The basic File Upload plugin -->
	<script src="assets/js/file-uploader/js/jquery.fileupload.js"></script>
	<!-- The File Upload processing plugin -->
	<script src="assets/js/file-uploader/js/jquery.fileupload-process.js"></script>
	<!-- The File Upload image preview & resize plugin -->
	<script src="assets/js/file-uploader/js/jquery.fileupload-image.js"></script>
	<!-- The File Upload audio preview plugin -->
	<script src="assets/js/file-uploader/js/jquery.fileupload-audio.js"></script>
	<!-- The File Upload video preview plugin -->
	<script src="assets/js/file-uploader/js/jquery.fileupload-video.js"></script>
	<!-- The File Upload validation plugin -->
	<script src="assets/js/file-uploader/js/jquery.fileupload-validate.js"></script>
	<!-- The File Upload user interface plugin -->
	<script src="assets/js/file-uploader/js/jquery.fileupload-ui.js"></script>
	<!-- The main application script -->
	<script src="assets/js/file-uploader/js/main.js"></script>
	<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
	<!--[if (gte IE 8)&(lt IE 10)]>
	<script src="assets/file-uploader/js/cors/jquery.xdr-transport.js"></script>
	<![endif]-->

  <!-- The template to display files available for upload -->
  <script id="template-upload" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
      <tr class="template-upload fade">
          <td>
              <span class="preview"></span>
          </td>
          <td>
              <p class="name">{%=file.name%}</p>
              <strong class="error text-danger"></strong>
          </td>
          <td>
              <p class="size">Processing...</p>
              <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
          </td>
          <td>
              {% if (!i && !o.options.autoUpload) { %}
              <button class="btn btn-primary start" disabled>
                  <i class="glyphicon glyphicon-upload"></i>
                  <span>Start</span>
              </button>
              {% } %}
              {% if (!i) { %}
              <button class="btn btn-warning cancel">
                  <i class="glyphicon glyphicon-ban-circle"></i>
                  <span>Cancel</span>
              </button>
              {% } %}
          </td>
      </tr>
      {% } %}
  </script>
  
  
  <!-- The template to display files available for download -->
  <script id="template-download" type="text/x-tmpl">
      {% for (var i=0, file; file=o.files[i]; i++) { %}
      <tr class="template-download fade">
          <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
          </td>
          <td>
              <p class="name">
                  {% if (file.url) { %}
                  <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                  {% } else { %}
                  <span>{%=file.name%}</span>
                  {% } %}
              </p>
              {% if (file.error) { %}
              <div><span class="label label-danger">Error</span> {%=file.error%}</div>
              {% } %}
          </td>
          <td>
              <span class="size">{%=o.formatFileSize(file.size)%}</span>
          </td>
          <td>
              {% if (file.deleteUrl) { %}
              <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
              <i class="glyphicon glyphicon-trash"></i>
              <span>Delete</span>
              </button>
              <input type="checkbox" name="delete" value="1" class="toggle">
              {% } else { %}
              <button class="btn btn-warning cancel">
                  <i class="glyphicon glyphicon-ban-circle"></i>
                  <span>Cancel</span>
              </button>
              {% } %}
          </td>
      </tr>
      {% } %}
  </script>    
    
    
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
