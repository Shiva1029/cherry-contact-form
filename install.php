<?php if( isset($_POST["adminEmail"]) && isset($_POST["max_msg_length"]) && isset($_POST["siteKey"]) && isset($_POST["secretKey"]) && isset($_POST["submissionTitle"]) ) { $js = "var reCaptcha_Key = '{$_POST['siteKey']}';
			 var Message_Max_Length = {$_POST['max_msg_length']};"; $jsInit = fopen("scripts/jsInit.js", "w") or die("Unable to create js file!"); fwrite($jsInit, $js); fclose($jsInit); $php = "<?php
		// Set here
		\$maxComment = {$_POST['max_msg_length']}; 
		\$adminEmail = '{$_POST['adminEmail']}';
		\$customTitle = '{$_POST['submissionTitle']}';
		\$reCaptchaSecretKey = '{$_POST['secretKey']}'; // Define Server Secret here. 
		?>"; $phpInit = fopen("scripts/phpInit.php", "w") or die("Unable to create php file!"); fwrite($phpInit, $php); fclose($phpInit); echo "<div class='container'><div class='row'><h1><b><font color='green'>Setup Completed Successfully! :)</font></b></h1></div></div>";} ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Install Cherry-Contact-Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.
com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<div class="page-header" style="text-align:center;">
    	<h1>Cherry Contact Form</h1>      
    </div>
<div class="row">
<form class="form-horizontal" role="form" method="POST" action="">
	<fieldset><legend>Contact Form Details</legend>
	    <div class="form-group">
	      <label class="control-label col-sm-2" for="email">Admin Email:</label>
	      <div class="col-sm-10">
	        <input type="email" class="form-control" id="email" name="adminEmail" placeholder="Enter email" required>
	      </div>
	    </div>
	     <div class="form-group">
	      <label class="control-label col-sm-2" for="submissionTitle">Submission Title:</label>
	      <div class="col-sm-10">
	        <input type="text" class="form-control" id="submissionTitle" name="submissionTitle" placeholder="Enter the Submission Title" required>
	      </div>
	    </div>
	    <div class="form-group">
	      <label class="control-label col-sm-2" for="num">Message Length:</label>
	      <div class="col-sm-10">          
	        <input type="number" class="form-control" id="num" name="max_msg_length" min="12" max="100000" placeholder="...Number">
	      </div>
	    </div>
        <legend>reCAPTCHA Details</legend>
          <a href="#" data-toggle="GoogleToolTip" title="Register your site at Google reCAPTCHA, to get the Site Key & the Secret Key."><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a>
		  <div class="form-group">
		  	<label class="control-label col-sm-2" for="siteKey">Site Key:</label>
	      <div class="col-sm-10">
	        <input type="text" class="form-control" id="siteKey" name="siteKey" placeholder="Enter the Site Key" required>
	      </div>
	      </div>
	     <div class="form-group">
	     	<label class="control-label col-sm-2" for="secretKey">Secret Key:</label>
	      <div class="col-sm-10">
	        <input type="text" class="form-control" id="secretKey" name="secretKey" placeholder="Enter the Secret Key" required>
	      </div>
	    </div>
	    <div class="form-group">        
	      <div class="col-sm-offset-2 col-sm-10">
	        <button type="submit" class="btn btn-info">Setup</button>
	      </div>
	    </div>
    </fieldset>
  </form>
</div>
</div>
</body>
<script>$(document).ready(function(){$('[data-toggle="GoogleToolTip"]').tooltip();});</script>
</html>