<?php

echo '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Easy ICD-Browser</title>
    <link rel="stylesheet" href="BasePageLayout/layout.css">
    <link rel="stylesheet" href="BasePageLayout/jquery-ui.min.css">
</head>
<body>
	<nav class="navbar background">
		<div class="logo">
			<img src="BasePageLayout/logo.png" alt="Logo">
		</div>
		<ul class="nav-list">
			<li><a href="index.php">Home</a></li>
			<li><a href="https://github.com/MaximalBenedikt/ICD-Browser" target=”_blank”>View Sourcecode on Github</a></li>
		</ul>
		<div class="rightnav">
			<form action="index.php" method="get">
				<input type="text" name="entity" id="search" placeholder="ICD Link or ID" min="5">
				<input type="submit" class="btn btn-sm" value="Open ICD-Content">
			</form>
		</div>
	</nav>';
?>