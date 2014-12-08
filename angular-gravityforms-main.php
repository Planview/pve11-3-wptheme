<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/Planview
 * @since      0.0.0
 *
 * @package    Angular_Gravity_Forms
 * @subpackage Angular_Gravity_Forms/public/partials
 */
?>
<div class="ng-gravityforms" id="ng-app" ng-app="ngGravityForms">
<div ng-controller="FormsCtrl">
<form ng-submit="submitForm()" ng-hide="showConfirm">
<?php if ( $this->get_config( 'title' ) ) : ?>
    <h3 class="sr-only"><?php echo $this->form['title']; ?></h3>
<?php endif; ?>

<div class="input-group">
<span class="input-group-addon hidden-xs">Ask the Presenters a Question</span>
<?php foreach ( $this->fields as $field ) :

    // Formatting for 'standard' form fields
    if ( in_array( $field['type'], array( 'text', 'email', 'number', 'select', 'multiselect', 'textarea' ) ) ) : ?>
            <label for="<?php echo $field['id'] ?>" class="sr-only"><?php echo $field['label'] ?></label>
            <?php printf( $field['template'], 'form-control' ); ?>
            <?php if ( $field['description'] ) : ?>
                <span class="help-block"><?php echo $field['description'] ?></span>
            <?php endif; ?>
    <?php


    // Formatting for radios and checkboxes
    elseif ( in_array( $field['type'], array( 'radio', 'checkbox' ) ) ) : ?>
        <div class="group_<?php echo $field['id'] ?>">
            <label for="<?php echo $field['id'] ?>"><?php echo $field['label'] ?></label>
            <?php foreach ( $field['template'] as $option ) : ?>
                <div class="<?php echo $field['type'] ?>">
                    <?php printf($option, ''); ?>
                </div>
            <?php endforeach; ?>
            <?php if ( $field['description'] ) : ?>
                <span class="help-block"><?php echo $field['description'] ?></span>
            <?php endif; ?>
        </div><?php


    // Hidden fields and user HTML don't need formatting
    elseif ( in_array( $field['type'], array( 'html', 'section', 'hidden' ) ) ) : ?>
        <?php printf( $field['template'], '' ); ?>
        <?php if ( $field['description'] ) : ?>
            <span class="help-block"><?php echo $field['description'] ?></span>
        <?php endif; ?>
    <?php endif;


endforeach; ?>
<span class="input-group-btn"><button type="submit" class="btn btn-success"><?php echo $this->form['button']['text']; ?></button></span></div>
</form>
<div ng-show="showConfirm" class="qa-confirm">
    <?php echo $this->get_confirmation(); ?>
</div>
</div>
</div>
