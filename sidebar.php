<?php
/**
 * sidebar.php
 *
 * The primary sidebar
 *
 * @package RocketFramework
 * @author  Claude Müller <dev@mediarocket.co.za>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @version 0.1
 */
?>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
    <aside class="sidebar medium-4 columns" role="complementary">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </aside> <!-- /.sidebar -->
<?php endif; ?>
