<?php defined('ROOT') OR exit('No direct script access allowed'); ?>
</div>
</div>
</section>
<footer>
	<div class="footer-1">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="h5-widget">
						<h5>Réseaux sociaux</h5>
					</div>
					<?php $core->callHook('endFrontBody'); ?>
				</div>
				<div class="col-md-4">
					<?php $core->callHook('newsfooter'); ?>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</div>
	<?php $core->callHook('footer'); ?>
	<div class="footer-2">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<a target='_blank' href='https://github.com/99kocms/'>CMS utilisé 99ko</a> - Thème
					<?php show::theme(); ?>
					fait
					avec <i class="fa fa-heart" style="color: red;margin:0 2px;"></i> par <a
						href="https://www.mycraftsite.fr.nf">Arnaud Dupont</a>
				</div>
				<div class="col-md-6">
					<span class="float">
						<a href="/index.php">Accueil</a>
						<a href="/index.php?p=news">News</a>
						<a href="/index.php?p=contact">Contact</a>
					</span>
				</div>
			</div>
		</div>
	</div>
	<?php $core->callHook('endFooter'); ?>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
	integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
	integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
	integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
</body>

</html>