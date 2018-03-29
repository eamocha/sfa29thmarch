<?php session_start();
if(isset($_SESSION['u_id'])){
	if(isset($_REQUEST['mode'])){}
	else header("location:index.php");
}
include('assets/lib/config.php'); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">


    <title>DMS - <?php echo basename($_SERVER["REQUEST_URI"], ".php") ?></title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
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
	$("#forgot_form").submit(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Checking Details....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("process_forgot.php",{ uname:$('#username').val(),rand:Math.random() } ,function(data)
        {
		  if(data==1) //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Your new Password Has been sent to your email').addClass('messageboxok').fadeTo(900,1);
			});
		  }
		  else 
		  { //alert('Wrong details. Your Activities are monitored');
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Either the email address doesnt exisit or you were disabled...').addClass('messageboxerror').fadeTo(900,1);
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

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		     <?php if(isset($_REQUEST['mode']) && $_REQUEST['mode']==1){?> 
               <form class="form-login" id="changepassForm" action="" method="post">
		    <h2 style="text-align:center; padding:2px" > Please Change your password</h2>
		        <div class="login-wrap" style=" margin: 10px auto 0; max-width: 300px;">
		           
                    <input style="width:100%" type="text" readonly value="<?php echo $_SESSION['email']?>" class="form-control" id="username" placeholder="User Name">
		            <br>
                     <input style="width:100%" type="password" class="validate[required] form-control" id="new_password" placeholder="New Password" >
		            <br>
		            <input style="width:100%" type="password" id="cpassword" class="form-control validate[required,equals[new_password]]" placeholder="Confirm Password">
		           <div id="meter_wrapper">
 <div id="meter"></div>
</div><span id="pass_type"></span>
		            
		            <input class="btn btn-success btn-block "  value="Save" id="btnChangePass" type="submit"/> 		           
		
		        </div>
		      </form>	
             
             <?php } else {?><form class="form-login" id="forgot_form" action="" method="post">
		        <h2 class="form-login-heading">Forgot Password</h2>
		        <div class="login-wrap">
		            <p>Enter your e-mail address below to reset your password.</p>
		            <br>
		            <input type="text" id="username" class="form-control" placeholder="Your Email">
		            <label id="msgbox" class="">		               
		                
		            </label>
		            <button class="btn btn-success btn-block" type="submit"><i class="fa fa-lock"></i> Reset Password</button>
		            <hr>
		            <div >
		              <a href="login.php">Login</a>
	              </div>
                  </div></form><?php }?>

		
		          <!-- Modal -->
		          
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
 <script type="text/javascript">
 uid=<?php echo $_SESSION['u_id'];?>;
   $(document).ready(function(e) {

	    $("#changepassForm").validationEngine();
		 $("#new_password").keyup(function(){ check_pass(); });
		 $("#changepassForm").submit(function(e) {
			var p=$('#new_password').val();
			var cp=$('#cpassword').val();
			 if(uid<0)alert("Action Not allowed");else if(p.length<6) alert("Password is Too short. Make sure it is more than 6 letter long"); else if(p!=cp) alert("Please make sure the Passwords Match"); else{
		$.post("read.php",{ uname:$('#username').val(),uid:uid,pword:$('#new_password').val(),mode:"change_pass" } ,function(data)
		 { 
		  if(data.localeCompare("done")) //if correct login detail
		  {	 //redirect to secure page
		 document.location='index.php';
		  }
		  else { alert("Please re-enter the details again"); }
			  }); 
 		return false; //not to post the  form physically   
			 }//end else
        });//submit
});   </script>
   
    <?php include("validation.php");?>
  

</html>
