<?php
/*
 * Template Name: RBM Staff Template
 */

$email = esc_html( get_post_meta( get_the_ID(), 'rbm_email', true ) ) ;
$linkedin = esc_html( get_post_meta( get_the_ID(), 'rbm_linkedin', true ) ) ;

 get_header();?>

<div id="primary">
  <div id="content" role="main">
      <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php // Weird conditional for background image
          $imgURL = '';
          if ( has_post_thumbnail() && ! post_password_required() ) :
            $imgURL = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
          endif;
          ?>
          <header class="entry-header" style="background-image: url('<?php echo $imgURL; ?>'); background-position: center center; background-size: cover;">
            <h1 class="entry-title">
              <?php the_title(); ?><br>
              <span><?php echo esc_html( get_post_meta( get_the_ID(), 'rbm_staff_title', true ) ) ; ?></span>
            </h1>
          </header>
          <div class="entry-content">
            <div class="container">
              <div class="row">
                <div class="col-xs-12 col-sm-9 col-sm-push-3">
                  <?php the_content(); ?>
                </div>
                <div class="col-xs-12 col-sm-3 col-sm-pull-9">
                  <div class="about--fun-fact-foto">
                    <img width="100%" src="<?php echo esc_html( get_post_meta( get_the_ID(), 'rbm_fun_img', true ) ) ; ?>">
                    <p>
                      <?php echo esc_html( get_post_meta( get_the_ID(), 'rbm_staff_fact', true ) ) ; ?>
                    </p>
                  </div>
                  <div class="connect--team-member">
                    <h3>Connect With <?php echo the_title(); ?></h3>
                    <?php if ($email != '') {?>
                      <a href="mailto:<?php echo $email; ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="Send <?php echo the_title(); ?> a Message">
                        <img src="http://reachbeyondmarketing.com/wp-content/uploads/2015/09/icon-envelope.svg">
                      </a>
                    <?php } ?>
                    <?php if ($linkedin != '') {?>
                      <a href="<?php echo $linkedin; ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" data-original-title="Connect with <?php echo the_title(); ?> on LinkedIn">
                        <img src="http://reachbeyondmarketing.com/wp-content/uploads/2015/09/reach-beyond-icon-linkedin.svg">
                      </a>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </article>
      <?php endwhile; ?>
  </div>
</div>

<?php get_footer(); ?>
