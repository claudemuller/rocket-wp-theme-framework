<?php
/**
 * sidebar-footer.php
 *
 * The footer sidebar
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
    <aside class="footer-sidebar" role="complementary">
        <div class="row">
            <?php dynamic_sidebar( 'sidebar-2' ); ?>
        </div>
    </aside> <!-- /.footer-sidebar -->
<?php endif; ?>
