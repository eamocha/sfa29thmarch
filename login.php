<?php session_start();
if(isset($_SESSION['u_id'])){
header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    


    <title>DMS - <?php echo basename($_SERVER["REQUEST_URI"], ".php") ?></title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
   
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <script type="text/javascript" src="assets/js/jquery-1.8.3.min.js" ></script>
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script  type="text/javascript">
       
 $(document).ready(function()
{ // binds form submission and fields to the validation engine
			//$("#login_form").validationEngine('attach');
			//proccess form
	$("#login_form").submit(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
	
		$.post("assets/lib/ajax_login.php",{ uname:$('#username').val(),pword:$('#password').val(),rand:Math.random() } ,function(data)
		
        {
		  if(data=='yes') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Logging in.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
			  	 //redirect to secure page
				 document.location='index.php';
			  });
			  
			});
		  } 
		  else  if(data=='cpd') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('please change password.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  {  	 //redirect to secure page
				 document.location='forgot.php?mode=1';
			  });
			  
			});
		  } 
		  else 
		  { 
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Incorrect Login details...').addClass('messageboxerror').fadeTo(900,1);
			});		
          }
				
        }); 
 		return false; //not to post the  form physically
	});
	//now call the ajax also focus move from 
	/*$("#password").blur(function()
	{
		$("#login_form").trigger('submit');
	});*/
});
</script>
  </head>

  <body >

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" id="login_form" action="" method="post">
		    <p style="text-align:center; padding:2px" ><img src="images/logo.png" width="200"></p>
		        <div class="login-wrap" style=" margin: 10px auto 0; max-width: 300px;">
		            <input style="width:100%" type="text" class="validate[required,custom[email]] form-control" id="username" placeholder="User ID" autofocus>
		            <br>
		            <input style="width:100%" type="password" id="password" class="form-control" placeholder="Password">
		            <label class="checkbox"><span class="pull-right">
	                    <a  href="forgot.php"> Forgot Password?</a>
		
	                </span>
		            </label>
		            <button class="btn btn-success btn-block " type="submit"><i class="fa fa-lock validate_user"></i> SIGN IN</button>
		            
		            <div class="registration" id="msgbox">
		               
	              </div>
		        </div>        
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
   
   <script type="text/javascript">
   $(document).ready(function(e) {

	    $("#login_form").validationEngine();

});   </script>
   
    <?php include("validation.php");?>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
   

  </body>
</html>
