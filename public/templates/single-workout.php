<?php
  get_header();

  if(have_posts()): while(have_posts()): the_post();

    $fitplan_workout_pic = get_post_meta(get_the_ID(), '_fitplan_workout_pic', true);
    $fitplan_workout_desc = get_post_meta(get_the_ID(), '_fitplan_workout_desc', true);
    $fitplan_workout_url = get_post_meta(get_the_ID(), '_fitplan_workout_url', true);
    //$fitplan_workout_color = get_post_meta($post->ID, '_fitplan_workout_color');

    $picture = wp_get_attachment_image_src($fitplan_workout_pic, "large");
?>
  <div class="fitplan-workout">

    <h1><?php the_title(); ?></h1>

    <?php if($fitplan_workout_pic != ""): ?>
    <p>
      <img src="<?php echo $picture[0]; ?>" width="<?php echo $picture[1]; ?>" height="<?php echo $picture[2]; ?>" alt="<?php the_title(); ?>">
    </p>
    <?php endif; ?>

    <div class="wp-content">
      <?php echo $fitplan_workout_desc; ?>
    </div>

    <?php if($fitplan_workout_url != ""): ?>
    <p><a href="<?php echo $fitplan_workout_url; ?>" target="_blank"><?php _e('Visit official page', 'fitness-schedule'); ?></a></p>
    <?php endif; ?>

  </div>

<?php
  endwhile; endif;

  get_footer();
?>
