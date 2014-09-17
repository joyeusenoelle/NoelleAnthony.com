<!DOCTYPE HTML>
<?php
	@session_start();
	$token = md5(rand(1000,9999));
	$_SESSION['token'] = $token;
	function xsafe($data, $encoding='UTF-8') {
		return htmlspecialchars($data, ENT_QUOTES, $encoding);
	}
	
	function xecho($data, $encoding='UTF-8') {
		echo xsafe($data, $encoding);	
	}
	
	if ($_POST) {
		$post = true;	
		$name = xsafe($_POST['query_name']);
		$email = xsafe($_POST['query_email']);
	} else {
		$post = false;
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Noëlle Anthony - <?php if($post) { echo "Service Query submitted!"; } else { echo "Submit a Service Query!"; } ?></title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="jquery-1.9.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var tmt;
	$(tmt = setInterval(function(){
		$("#cursor").toggle();
	},500));
</script>
</head>
<body class="query">
<?php if($post) { ?>
	<h1>Posted!</h1>
	<p>Name: <?php xecho($name); ?></p>
	<p>Email: <?php xecho($email); ?></p>
<?php } else { ?>
	<h1>Post:</h1>
	<form name="ndaquery" method="POST" action="">
	<div class="form-row">
		<div class="form-cell form-cell-left">
			Your name:
		</div>
		<div class="form-cell form-cell-right">
			<input type="text" name="query_name" size="40" value="">
		</div>
	</div>
	<div class="form-row">
		<div class="form-cell form-cell-left">
			Your email address: 
		</div>
		<div class="form-cell form-cell-right">
			<input type="text" name="query_email" size="40" value="">
		</div>
	</div>
	<input type="submit">
	</form>
<?php } ?>
	
</body>
</html>