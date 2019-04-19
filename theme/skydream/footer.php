<?php defined('ROOT') OR exit('No direct script access allowed'); ?>
</div>
</div>
</section>
<footer>
	<?php $core->callHook('footer'); ?>
	<div class="footer-1">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="h5-widget rs">
						<h5>Réseaux sociaux</h5>
					</div>
					<?php $core->callHook('endFrontBody'); ?>
				</div>
				<div class="col-md-4">
					<div class="h5-widget dn">
						<h5>Dernières news</h5>
					</div>
					<?php $core->callHook('newsfooter'); ?>
				</div>
				<div class="col-md-4">
					<div class="h5-widget p">
						<h5>Partenaires</h5>
					</div>
					- <a href="https://www.mycraftsite.fr.nf/" target="_blank">Arnaud Dupont</a><br>
					- <a href="https://www.facebook.com/99kocms/" target="_blank">99ko CMS</a><br>
					- <a href="http://www.name.tld/" target="_blank">name</a>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-2">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					CMS utilisé <a target='_blank' href='https://github.com/99kocms/'>99ko</a> - Thème
					<?php show::theme(); ?>
					fait
					avec <i class="fa fa-heart" style="color: red;margin:0 2px;"></i> par <a
						href="https://www.mycraftsite.fr.nf">Arnaud Dupont</a>
				</div>
				<div class="col-md-6">
					<div class="float">
						<a href="<?php echo $core->makeUrl('index');?>">Accueil</a> -
						<a href="<?php echo $core->makeUrl('news');?>">News</a> -
						<a href="<?php echo $core->makeUrl('contact');?>">Contact</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $core->callHook('endFooter'); ?>
</footer>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.7/js/mdb.min.js"></script>
</body>

</html>