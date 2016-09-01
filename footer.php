<?php
/**
 * footer.php
 *
 * The template for displaying the footer
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

        </div>
    </div> <!-- /.container -->

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <?php get_sidebar( 'footer' ); ?>

            <div class="copyright">
                <p>
                    &copy; <?php echo date( 'Y' ); ?>
                    <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
                    <?php _e( 'All rights reserved.', 'rocket' ); ?>
                </p>
            </div>
        </div>
    </footer> <!-- /.site-footer -->

    <?php wp_footer(); ?>

</body>
</html>
