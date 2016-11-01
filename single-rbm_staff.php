<?php
/*
 * Template Name: RBM Staff Template
 */

 get_header();?>

<div id="primary">
  <div id="content" role="main">
      <?php
        $mypost = array( 'post_type'=>'rbm_staff' );
        $loop = new WP_Query( $mypost );
      ?>
      <?php while( $loop->have_posts() ) : $loop->the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="entry-header" style="background-image: url(<?php the_post_thumbnail_url('full'); ?>); background-position: center center; background-size: cover;">
            <h1 class="entry-title">
              <?php the_title(); ?><br>
              <span><?php echo esc_html( get_post_meta( get_the_ID(), 'rbm_staff_title', true ) ) ; ?></span>
          </h1>
          </header>
          <div class="entry-content">
            <div class="container">
              <div class="row">
                <div class="col-xs-12 col-sm-9 col-sm-push-9">
                  <?php the_content(); ?>
                </div>
              </div>
            </div>
          </div>
        </article>
      <?php endwhile; ?>
  </div>
</div>

<?php wp_reset_query(); ?>
<?php get_footer(); ?>
