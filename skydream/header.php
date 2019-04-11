<?php
defined('ROOT') OR exit('No direct script access allowed');
include_once(THEMES.$core->getConfigVal('theme').'/functions.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<?php eval($core->callHook('frontHead')); ?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php show::titleTag(); ?></title>
	<base href="<?php show::siteUrl(); ?>/" />
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
	<meta name="description" content="<?php show::metaDescriptionTag(); ?>" />
	<link rel="icon" href="<?php show::themeIcon(); ?>" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
		integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="theme/skydream/styles.css">
	<link href="https://fonts.googleapis.com/css?family=PT+Sans+Caption|Permanent+Marker" rel="stylesheet">
	<?php eval($core->callHook('endFrontHead')); ?>
</head>

<body>
	<header>
		<div class="header-1"></div>
		<p class="logo"><a href="<?php show::siteUrl(); ?>"><?php show::siteName(); ?></a></p>
		<nav class="navbar navbar-expand-lg">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<?php show::mainNavigation(); ?>
				</ul>
				<form class="form-inline">
					<?php $core->callHook('endFrontBody'); ?>
				</form>
			</div>
		</nav>
	</header>
	<section class="container">
		<?php show::mainTitle(); ?>