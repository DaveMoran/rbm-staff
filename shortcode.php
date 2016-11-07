<?php

//Create a test shortcode

function test_shortcode() {
  $args = array(
    'post_type' => 'rbm_staff'
  );
  $query = new WP_Query($args);
  if($query->have_posts()) {
    while($query->have_posts()) {
      $query->the_post();
      $secondaryIMG = esc_html( get_post_meta( get_the_ID(), 'rbm_secondary_img', true ) ) ;
      ?>
      <div class="col-xs-6 col-md-4">
        <a href="<?php echo the_permalink(); ?>">
          <div class="threshold-link--grid" style="background: url('<?php echo $secondaryIMG; ?>') center top no-repeat;  backgorund-size: cover;">
            <h3><?php echo the_title(); ?></h3>
            <div class="tl--g---about-description">
              <p><?php echo esc_html( get_post_meta( get_the_ID(), 'rbm_staff_title', true ) ) ; ?></p>
              <img src="/wp-content/uploads/2015/09/icon-right.svg">
            </div>
          </div>
        </a>
      </div>
      <?php
      wp_reset_postdata();
    }
  } else {
    echo "No Staff Members work here";
  }
}

add_shortcode('test', 'test_shortcode');
