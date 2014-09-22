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
<script src="jquery-1.11.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$.valHooks.textarea = {
		get: function( elem ) {
			return elem.value.replace( /\r?\n/g, "\r\n" );
		}
	};
	function formval() {
		var qname = $.trim($('#query-name').val());
		var qmail = $.trim($('#query-email').val());
		var qtext = $.trim($('#query-text').val());
		var qtype = $('#query-type').val();
		var errorstr = "";
		var haserrors = false;
		var re = /^[A-Z0-9._%+!#-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/i;
		if(qname == "") {
			haserrors = true;
			errorstr += "\n* Name must not be blank";
		}
		if(qmail == "") {
			haserrors = true;
			errorstr += "\n* Email must not be blank";
		} else if (qmail.search(re) == -1) {
			haserrors = true;
			errorstr += "\n* Email must be well-formed";
		}
		if(qtext == "") {
			haserrors = true;
			errorstr += "\n* Query text must not be blank";
		}
		if(haserrors == true) {
			alert("Please fill out the form completely before submitting.\n" + errorstr);
		}
		return !haserrors;
	}
	var tmt;
	$(tmt = setInterval(function(){
		$("#cursor").toggle();
	},500));
	$(document).ready(function() {
		$("form#ndaquery").on("submit", function() {
			//alert("Clicked");
			event.preventDefault;
			if (formval()) {
				/*var qname = $.trim($('#query-name').val());
				var qmail = $.trim($('#query-email').val());
				var qtext = $.trim($('#query-text').val());
				var qtype = $('#query-type').val();*/
				alert($('#ndaquery').serialize());
			}
			return false;
		});
	});
</script>
</head>
<body class="query">
<?php if($post) { ?>
	<h1>Posted!</h1>
	<p>Name: <?php xecho($name); ?></p>
	<p>Email: <?php xecho($email); ?></p>
<?php } else { ?>
	<h1>Send a Work Query:</h1>
	<form name="ndaquery" id="ndaquery" method="POST" action="">
	<div class="form-row">
		<div class="form-cell form-cell-left">
			Your name:
		</div>
		<div class="form-cell form-cell-right">
			<input type="text" name="query-name" size="40" value="">
		</div>
	</div>
	<div class="form-row">
		<div class="form-cell form-cell-left">
			Your email address: 
		</div>
		<div class="form-cell form-cell-right">
			<input type="text" name="query-email" size="40" value="">
		</div>
	</div>
    <div class="form-row">
    	<div class="form-cell form-cell-left">
        	Query type:
        </div>
        <div class="form-cell form-cell-right">
        	<select id="query-type">
            	<option value="WordPress Plugin">WordPress Plugin</option>
                <option value="Software Setup">Web Software Setup</option>
                <option value="Custom Web Software">Custom Web Software</option>
                <option value="Retainer">Retainer</option>
            </select>
        </div>
    </div>
    <div class="form-row">
    	<div class="form-cell form-cell-left">
        	Query description:<br>
            Please let me know as many details as you can! If you've chosen a retainer, I'll help you decide what level is best for you based on your needs.
        </div> 
        <div class="form-cell form-cell-right">
        	<textarea id="query-text" name="query-text" rows="10" cols="72">
			</textarea>
    	</div>
    </div>    
    <div class="form-row">
    	<div class="form-cell form-cell-left">
        	Sending this query is not a work agreement! If we agree to work together, I'll email you a contract.<br>
            I do ask for a 50% deposit when the contract is signed.
        </div>
    	<div class="form-cell form-cell-right">
			<input type="submit" id="form-submit" style="clear: both;" value="Send Query">
        </div>
    </div>
	</form>
<?php } ?>
	
</body>
</html>