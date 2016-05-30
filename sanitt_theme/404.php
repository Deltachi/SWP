<?php get_header(); ?>
<section class="content" ng-controller="animationCtrl">
	<!-- <div class="container"> -->
	<?php //echo get_the_title(); //Debug?>
		<section>
			<article class="article welcome gray">
				<div class="container"> 
					 <h1 class="animate padding-after" style="text-align: center; padding-top:50px;"><img src="<?= get_bloginfo("template_url"); ?>/images/content/sadface.png" alt="" width="150" height="150"><br><br>Error  404</h1>
					<h2 class="animate" style="text-align: center">Hups, die von Ihnen gesuchte Seite existiert nicht.</h2>
					<br><br>
					<hr>
					<h3 class="animate text-muted padding-after" style="text-align: center"><small>Falls es sich hierbei um einen Fehler handelt, fragen Sie einfach bei uns nach! </small></h3>
				</div>
			</article>
		</section>
	<!--</div>.container-->
</section><!--.content-->
	
<?php //get_sidebar(); ?>
<?php get_footer(); ?>