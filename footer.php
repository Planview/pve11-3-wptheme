<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Planview Enterprise 11.3
 */
?>

	</div><!-- #content -->

	<footer class="site-footer">
      <div class="container">
        <p class="text-center pv-footer"><a href="http://planview.com"><span class="pv-logo">Planview</span></a></p>
        <p class="copyright text-center"><?php printf(__('&copy; %s Planview, Inc., All Rights Reserved.', 'pve_113'), date('Y')); ?></p>
      </div>
    </footer>

<?php wp_footer(); ?>

</body>
</html>
