<?php

/**
 * Writes out a bootstrap modal
 */
function pve_113_modal($id, $title, $body, $size = '') { ?>
<div class="modal fade" id="<?php echo esc_attr( $id ); ?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="<?php echo esc_attr( $id ); ?>Label">
  <div class="modal-dialog <?php echo $size; ?>">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php _ex('Close', 'Modal close', 'pve_113'); ?></span></button>
        <h4 class="modal-title text-center" id="<?php echo esc_attr( $id ); ?>Label"><?php echo $title ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $body ?>
      </div>
    </div>
  </div>
</div>
<?php }

/**
 * Returns the body for the login modal
 */
function pve_113_login_modal_body() {
    $login_form = wp_login_form( array(
        'echo'           => false,
        'redirect'       => get_permalink(),
        'form_id'        => 'loginform',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in'   => __( 'Log In' ),
        'id_username'    => 'user_login',
        'id_password'    => 'user_pass',
        'id_remember'    => 'rememberme',
        'id_submit'      => 'wp-submit',
        'remember'       => true,
        'value_username' => NULL,
        'value_remember' => false
    ) );
    $lost_password_link = wp_lostpassword_url( get_permalink() );
    $lost_password_template =
        '<p class="text-center"><a href="%s" class="btn btn-default btn-sm" title="%s">%s</a></p>';
    $lost_password = sprintf(
        $lost_password_template,
        $lost_password_link,
        esc_attr__( 'Lost Your Password?', 'pve_113' ),
        __( 'Lost Your Password?', 'pve_113' )
    );
    return $login_form . $lost_password;
}
