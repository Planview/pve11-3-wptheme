<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Planview Enterprise 11.3
 */
?>


    <footer class="site-footer">
      <div class="container">
        <ul class="list-inline text-center">
            <li>
                <a href="mailto:newrelease@planview.com">Need Help? Contact Us</a>
            </li>
            <?php if (is_user_logged_in()) : ?>
                <li>
                    <a href="<?php echo wp_logout_url( home_url() ); ?>" rel="nofollow">Log Out</a>
                </li>
            <?php endif; ?>
        </ul>
        <p class="text-center pv-footer"><a href="http://www.planview.com/"><span class="pv-logo bg-size">Planview</span></a></p>
        <p class="copyright text-center"><?php printf(__('&copy; %s Planview, Inc., All Rights Reserved.', 'pve_113'), date('Y')); ?></p>
      </div>
    </footer>

<?php wp_footer(); ?>

</body>
</html>
