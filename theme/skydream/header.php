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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.7/css/mdb.min.css" rel="stylesheet">
	<?php show::linkTags(); ?>
	<?php show::scriptTags(); ?>
	<link href="https://fonts.googleapis.com/css?family=PT+Sans+Caption|Permanent+Marker" rel="stylesheet">
	<?php eval($core->callHook('endFrontHead')); ?>
</head>

<body>
	<header>
		<div class="header-1"></div>
		<div class="header-2">
			<p class="logo"><a href="<?php show::siteUrl(); ?>"><?php show::siteName(); ?></a></p>
		</div>
		<div class="header-3">
			<nav class=" container navbar navbar-expand-lg">
				<button class="navbar-toggler" type="button" data-toggle="collapse"
					data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
					aria-label="Toggle navigation">
					<i class="fas fa-bars"></i>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<?php show::mainNavigation(); ?>
					</ul>
					<form class="form-inline">
						<?php $core->callHook('endIcone'); ?>
					</form>
				</div>
			</nav>
		</div>
	</header>
	<section class="container">
		<div class="row" id="body">
			<div id="content" class="<?php show::pluginId(); ?> col-md-12">
				<?php show::mainTitle(); ?>