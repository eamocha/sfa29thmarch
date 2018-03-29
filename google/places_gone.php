<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="../assets/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {   
      $.ajax({    //create an ajax request to load_page.php
        type: "GET",  url: "fetch_places.php",  dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#responsecontainer").html(response); 
            //alert(response);
        }
    });
	});

</script>
</head>

<body>
</body>
Where people
<div id="responsecontainer"></div>
</html>
