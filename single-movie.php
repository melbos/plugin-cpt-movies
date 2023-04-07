<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <div class="movie-content">
                        <?php the_content(); ?>
                    </div><!-- .movie-content -->
                    <div class="movie-title">
                        <?php echo get_post_meta( get_the_ID(), 'movie_title', true ); ?>
                    </div><!-- .movie-title -->
                </div><!-- .entry-content -->
            </article><!-- #post-<?php the_ID(); ?> -->
        <?php endwhile; // End the loop. ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
