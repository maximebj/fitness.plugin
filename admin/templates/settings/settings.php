<div class="wrap">
  <h1><?php _e('Settings', 'fitness-planning'); ?></h1>

  <form method="post" action="options.php">
    <?php settings_fields( 'myoption-group' ); ?>
    <?php do_settings_sections( 'myoption-group' ); ?>
    <?php submit_button(); ?>
  </form>
</div>
