<?php
//load helper (some helper no need to load because it's already load in controller)
$this->load->helper('html');
// start document
echo doctype('html5');
?>

<html>
	<head>
		<title><?php echo @$page_title; ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta charset="utf-8" />
		<link href="<?php echo base_url(); ?>web-content/themes/default/style.css" media="screen" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<div class="container">
			<div class="header">
				<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>web-content/themes/default/images/logo.png" alt="Vee's manga reader" /></a>
			</div><!--.header-->
			<div class="navigation">
				<a href="<?php echo base_url(); ?>">Home</a>
			</div><!--.navigation-->
			<div class="content">