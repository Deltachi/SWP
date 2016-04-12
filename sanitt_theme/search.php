<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage sanitt_theme
 * @since Sanitt Theme 1.1
 */

get_header(); ?>

	<section id="primary" class="content-area" > <!-- ng-controller="animationCtrl" -->
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header container">
				<h2 class="page-title"><?php printf( __( 'Suchergebnisse für: %s', 'sanitt_theme' ), get_search_query() ); ?></h2>
			</header><!-- .page-header -->

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>
				
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<!-- <div class="post-header">
						<div class="date"><?php the_time( 'M j y' ); ?></div>
						<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<div class="author"><?php the_author(); ?></div>
					</div> -->
					<div class="entry clear">
						<?php if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail(); ?>
						<?php the_content(); ?>
						<?php edit_post_link(); ?>
						<?php wp_link_pages(); ?>
					</div><!--. entry-->
					<!-- <footer class="post-footer">
						<div class="comments"><?php comments_popup_link( 'Leave a Comment', '1 Comment', '% Comments' ); ?></div>
					</footer> -->
				</div><!-- .post-->
				<hr>
				<div class="container"><h3 style="text-align: center; color: gray;"><em>- nächster Eintrag -</em></h3></div>
				<hr>
				<?php
				/*
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'sanitt_theme' ),
				'next_text'          => __( 'Next page', 'sanitt_theme' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'sanitt_theme' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>
