<?php
/*
 * Template Name: RBM Staff Template
 */

$facebook = esc_html( get_post_meta( get_the_ID(), 'rbm_facebook', true ) ) ;
$twitter = esc_html( get_post_meta( get_the_ID(), 'rbm_twitter', true ) ) ;
$email = esc_html( get_post_meta( get_the_ID(), 'rbm_email', true ) ) ;
$linkedin = esc_html( get_post_meta( get_the_ID(), 'rbm_linkedin', true ) ) ;
$skill_string = esc_html(get_post_meta( get_the_ID(), 'rbm_skillset', true));
$skill_array = explode(',', $skill_string);
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
                    <h3>Expert In:</h3>
                    <?php if(in_array('mkt-plan', $skill_array)) { ?>
                      <a href="/services/marketing-planning-tactics/" data-toggle="tooltip" data-placement="bottom" data-original-title="Marketing Planning & Tactics">
                        <img src="http://reachbeyondmarketing.com/wp-content/uploads/2015/09/icon-marketing-planning-and-tactics.svg">
                      </a>
                      <?php } ?>
                    <?php if(in_array('branding', $skill_array)) { ?>
                      <a href="/services/branding-logo-design/" data-toggle="tooltip" data-placement="bottom" data-original-title="Branding & Logo Design">
                        <img src="http://reachbeyondmarketing.com/wp-content/uploads/2015/09/icon-branding-and-logo-design.svg">
                      </a>
                      <?php } ?>
                    <?php if(in_array('web-dev', $skill_array)) { ?>
                      <a href="/services/website-design-development/" data-toggle="tooltip" data-placement="bottom" data-original-title="Website Design & Development">
                        <img src="http://reachbeyondmarketing.com/wp-content/uploads/2015/09/icon-website-design-and-development.svg">
                      </a>
                      <?php } ?>
                    <?php if(in_array('sem', $skill_array)) { ?>
                      <a href="/services/search-engine-marketing/" data-toggle="tooltip" data-placement="bottom" data-original-title="Search Engine Marketing">
                        <img src="http://reachbeyondmarketing.com/wp-content/uploads/2015/09/icon-search-engine-marketing.svg">
                      </a>
                      <?php } ?>
                    <?php if(in_array('photo-video', $skill_array)) { ?>
                      <a href="/services/photography-video-production/" data-toggle="tooltip" data-placement="bottom" data-original-title="Video Production">
                        <img src="http://reachbeyondmarketing.com/wp-content/uploads/2015/09/icon-photography-and-video-production.svg">
                      </a>
                      <?php } ?>
                    <?php if(in_array('social', $skill_array)) { ?>
                      <a href="/services/reputation-management-social-media/" data-toggle="tooltip" data-placement="bottom" data-original-title="Social Media & Reputation Management">
                        <img src="http://reachbeyondmarketing.com/wp-content/uploads/2015/09/icon-reputation-management-and-social-media.svg">
                      </a>
                      <?php } ?>
                    <?php if(in_array('copy', $skill_array)) { ?>
                      <a href="/services/copywriting-content-development/" data-toggle="tooltip" data-placement="bottom" data-original-title="Copywriting & Content Development">
                        <img src="http://reachbeyondmarketing.com/wp-content/uploads/2015/09/icon-copywriting-and-content-development.svg">
                      </a>
                      <?php } ?>
                    <?php if(in_array('print', $skill_array)) { ?>
                      <a href="/services/print-design/" data-toggle="tooltip" data-placement="bottom" data-original-title="Print Design">
                        <img src="http://reachbeyondmarketing.com/wp-content/uploads/2015/09/icon-brochure-and-stationary-design.svg">
                      </a>
                      <?php } ?>
                    <?php if(in_array('ads', $skill_array)) { ?>
                      <a href="/services/media-buying-local-advertising/" data-toggle="tooltip" data-placement="bottom" data-original-title="Media Buying & Local Advertising">
                        <img src="http://reachbeyondmarketing.com/wp-content/uploads/2015/09/icon-media-buying-and-local-advertising.svg">
                      </a>
                      <?php } ?>
                  </div>
                  <div class="connect--team-member">
                    <h3>Connect With <?php echo the_title(); ?></h3>
                    <?php if ($facebook != '') {?>
                      <a href="<?php echo $facebook; ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="Follow <?php echo the_title(); ?>">
                        <img src="http://reachbeyondmarketing.com/wp-content/uploads/2015/09/reach-beyond-icon-facebook.svg">
                      </a>
                    <?php } ?>
                    <?php if ($twitter != '') {?>
                      <a href="<?php echo $twitter; ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="Follow <?php echo the_title(); ?>">
                        <img src="http://reachbeyondmarketing.com/wp-content/uploads/2015/09/reach-beyond-icon-twitter.svg">
                      </a>
                    <?php } ?>
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
