<?php
require('Roman.php');
$roman = new Roman();
$result = '';
$message = '';
$class = 'alert-success';

if (isset($_POST['submit'])) {
	$result = $roman->calculate();
}

if (isset($result['message'])) {
	$message = $result['message'];
	$class = 'alert-danger';
} elseif (isset($result['result'])) {
	$message = 'The calculated value is '.$result['result'];
}
?>
<html>
	<head>
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap.css.map" rel="stylesheet">
		<link href="css/custom.css" rel="stylesheet">
	</head>
	<body>
	    <div class="container">
			<?php if (!empty($message)) { ?>
	    	<div class="alert <?php echo $class; ?> alert-dismissible fade in" role="alert">
	    		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><?php echo $message; ?>
	    	</div>
	    	<?php } ?>
			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" id="roman-form">
				<div class="form-group required">
			    	<label for="first-number">Enter the first roman number:</label>
					<input type="text" class="form-control" name="first" id="first-number" value="<?php echo isset($_POST['first'])?$_POST['first']:''; ?>" required>
			  	</div>
			  	<div class="form-group required">
			    	<label for="second-number">Enter the second roman number:</label>
					<input type="text" class="form-control" name="second" id="second-number" value="<?php echo isset($_POST['second'])?$_POST['second']:''; ?>" required>
			  	</div>
			  	<div class="form-group required">
			    	<label for="operator">Enter the operator(+-/*):</label>
					<input type="text" class="form-control" name="operator" id="operator" value="<?php echo isset($_POST['operator'])?$_POST['operator']:''; ?>" required>
			  	</div>
			  	<input type="submit" name="submit" class="btn btn-default">
				<button id="js-submit-button" class="btn btn-default">Js Submit</button>
			</form>
			<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
			<script type="text/javascript" src="js/bootstrap.min.js"></script>
			<script type="text/javascript" src="js/custom.js"></script>
		</div>
	</body>
</html>