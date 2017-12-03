<?php
  get_header();

  if(have_posts()):
?>
  <div class="fitplan-coachs">

    <?php
      while(have_posts()):
        the_post();

        $fitplan_coach_pic = get_post_meta(get_the_ID(), '_fitplan_coach_pic', true);
        $fitplan_coach_bio = get_post_meta(get_the_ID(), '_fitplan_coach_bio', true);

        $picture = wp_get_attachment_image_src($fitplan_coach_pic, "large");
    ?>

    <article class="fitplan-coachs-teaser">

      <h1><?php the_title(); ?></h1>

      <?php if($fitplan_coach_pic != ""): ?>
      <p>
        <img src="<?php echo $picture[0]; ?>" width="<?php echo $picture[1]; ?>" height="<?php echo $picture[2]; ?>" alt="<?php the_title(); ?>">
      </p>
      <?php endif; ?>

      <div class="wp-content">
        <?php echo $fitplan_coach_bio; ?>
      </div>

      <p>
        <a href="<?php the_permalink(); ?>"><?php _e('Read more', 'fitness-planning'); ?></a>
      </p>

    </article>

  <?php endwhile; ?>

  </div>

  <?php the_posts_pagination(); ?>

<?php
  endif;

  get_footer();
?>
