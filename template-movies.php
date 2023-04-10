<?php
/*
Template Name: Movies Template
*/
?>
<?php
while ( have_posts() ) : the_post(); ?>

    <div class="movie-content">
        <?php the_content(); ?>
    </div>

    <div class="movie-title">
        <h2><?php the_title(); ?></h2>
    </div>

<?php endwhile; // End of the loop.
?>
