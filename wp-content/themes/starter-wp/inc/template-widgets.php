<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class Starter_WP {

	public function __construct() {
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
	}

	/**
	 * Register widget area.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
	 */
	public function widgets_init() {

		/**
		 * The main theme sidebar
		 */
		$sidebar_args['sidebar'] = array(
			'name'        => __( 'Sidebar', 'starter-wp' ),
			'id'          => 'sidebar-1',
			'description' => __( 'Add widgets here to appear in your sidebar.', 'starter-wp' )
		);
        /**
		 * Sets the number of allowed widget areas
		 */
		$header_widget_areas = apply_filters( 'starter_wp_header_widget_areas', 4 );

		for ( $i = 1; $i <= intval( $header_widget_areas ); $i++ ) {

			$header = sprintf( 'Header_%d', $i );

			$sidebar_args[ $header ] = array(
				'name'        => sprintf( __( 'Header %d', 'starter-wp' ), $i ),
				'id'          => sprintf( 'header-%d', $i ),
				'description' => sprintf( __( 'Add widgets here to appear in header %d.', 'starter-wp' ), $i )
			);

		}
		/**
		 * Sets the number of allowed widget areas
		 */
		$footer_widget_areas = apply_filters( 'starter_wp_footer_widget_areas', 4 );

		for ( $i = 1; $i <= intval( $footer_widget_areas ); $i++ ) {

			$footer = sprintf( 'footer_%d', $i );

			$sidebar_args[ $footer ] = array(
				'name'        => sprintf( __( 'Footer %d', 'starter-wp' ), $i ),
				'id'          => sprintf( 'footer-%d', $i ),
				'description' => sprintf( __( 'Add widgets here to appear in footer %d.', 'starter-wp' ), $i )
			);

		}

		foreach ( $sidebar_args as $sidebar => $args ) {

			$widget_tags = array(
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>'
			);

			/**
			 * Dynamically generated filter hooks. Allow changing widget wrapper and title tags. See the list below.
			 *
			 * starter_wp_sidebar_widget_tags
			 *
			 * starter_wp_footer_1_widget_tags
			 * starter_wp_footer_2_widget_tags
			 * starter_wp_footer_3_widget_tags
             * starter_wp_footer_4_widget_tags
			 */
			$filter_hook = sprintf( 'starter_wp_%s_widget_tags', $sidebar );
			$widget_tags = apply_filters( $filter_hook, $widget_tags );

			if ( is_array( $widget_tags ) ) {
				register_sidebar( $args + $widget_tags );
			}

		}

	}

}
new Starter_WP();

/**
 * Recent Posts Widget Class
 */
class starter_wp_recent_posts_widget extends WP_Widget {

//Register widget with WordPress.
function __construct() {
    parent::__construct(
        'starter_wp_recent_posts_widget', // Base ID
        esc_html__('Starter WP Recent Posts', 'starter-wp'), // Name
        array('description' => esc_html__('An extended version of the recent posts widget.', 'starter-wp' ),) // Args
    );
}
//Front-end display of widget.

function widget($args, $instance) {
        $number = isset( $instance['number']  ) ? esc_attr( $instance['number']) : '';
        $date = isset( $instance['date'] ) ? esc_attr( $instance['date']) : '';
        $img = isset( $instance['img'] ) ? esc_attr( $instance['img']) : '';
        $post = isset( $instance['post'] ) ? esc_attr( $instance['post']) : '';
        $cat = isset( $instance['cat'] ) ? esc_attr( $instance['cat']) : '';
        $excerpt = isset( $instance['excerpt'] ) ? esc_attr( $instance['excerpt']) : '';

        $query = new WP_Query( apply_filters( 'widget_posts_args',
                                array( 'posts_per_page' => $number,
                                    'no_found_rows' => true,
                                    'post_status' => 'publish',
                                    'ignore_sticky_posts' => true,
                                    'post_type' => $post
                                    ))
                             );
?>
<?php echo $args['before_widget']; ?>
    <?php if ( ! empty( $instance['title'] ) ) {
        echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    }  ?>
    <ul class="recent-posts-list">
        <?php if ($query->have_posts()) :
            while ( $query->have_posts() ) : $query->the_post(); ?>
        <li>
            <?php if ( $img ) : ?>
            <?php if ( has_post_thumbnail()) {
                echo "<div class='post-image'>";
                   echo "<a href='". get_the_permalink() ."'>";
                        the_post_thumbnail('thumbnail' , array( 'class' => 'post-img' ) );
                    echo "</a>";
                echo "</div>";
            }  ?>
            <?php endif; ?>
            <div class='post-title'>
                <a class="title" href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>">
                    <?php if ( get_the_title() ) the_title(); else the_ID(); ?>
                </a>
            </div>
            <?php if ( $date ) : ?>
                <span class="post-date">
                    <?php echo get_the_date(); ?>
                </span>
            <?php endif; ?>
            <?php if ( $excerpt ) : ?>
                <span class="post-excerpt">
                    <?php echo get_the_excerpt(); ?>
                </span>
            <?php endif; ?>
        </li>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
        <?php endif; ?>

    </ul>
    <?php echo $args['after_widget']; ?>

<?php }
// Back-end widget form.
public function form( $instance ) {
    $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
    $number = isset( $instance['number'] ) ? esc_attr( $instance['number'] ) : '';
    $date = isset( $instance['date'] ) ? esc_attr( $instance['date'] ) : '';
    $post = isset( $instance['post'] ) ? esc_attr( $instance['post'] ) : '';
    $img = isset( $instance['img'] ) ? esc_attr( $instance['img'] ) : '';
    $excerpt = isset( $instance['excerpt'] ) ? esc_attr( $instance['excerpt'] ) : '';
?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:' , 'starter-wp' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'post' ); ?>"><?php esc_html_e( 'Post type:' , 'starter-wp' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'post' ); ?>" name="<?php echo $this->get_field_name( 'post' ); ?>" type="text" value="<?php echo $post; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to show:' , 'starter-wp' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
    </p>
    <p>
        <input class="checkbox" type="checkbox" value="1" <?php checked( '1', $date ); ?> id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" />

        <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php esc_html_e( 'Display post date?', 'starter-wp' ); ?></label>
    </p>
    <p>
        <input class="checkbox" type="checkbox" value="1" <?php checked( '1', $img ); ?> id="<?php echo $this->get_field_id( 'img' ); ?>" name="<?php echo $this->get_field_name( 'img' ); ?>" />

        <label for="<?php echo $this->get_field_id( 'img' ); ?>"><?php esc_html_e( 'Display post image?', 'starter-wp' ); ?></label>
    </p>
    <p>
        <input class="checkbox" type="checkbox" value="1" <?php checked( '1', $excerpt ); ?> id="<?php echo $this->get_field_id( 'excerpt' ); ?>" name="<?php echo $this->get_field_name( 'excerpt' ); ?>" />

        <label for="<?php echo $this->get_field_id( 'excerpt' ); ?>"><?php esc_html_e( 'Display post excerpt?', 'starter-wp' ); ?></label>
    </p>
<?php
}
//Sanitize widget form values as they are saved.
public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['post'] = ( ! empty( $new_instance['post'] ) ) ? strip_tags( $new_instance['post'] ) : '';
    $instance['excerpt'] = ( ! empty( $new_instance['excerpt'] ) ) ? strip_tags( $new_instance['excerpt'] ) : '';
    $instance['img'] = ( ! empty( $new_instance['img'] ) ) ? strip_tags( $new_instance['img'] ) : '';
    $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
    $instance['date'] = ( ! empty( $new_instance['date'] ) ) ? strip_tags( $new_instance['date'] ) : '';
    return $instance;
}

} // Class ends here

//Load the widget
function starter_wp_recent_posts_widget() {
    register_widget( 'starter_wp_recent_posts_widget' );
}
add_action( 'widgets_init','starter_wp_recent_posts_widget');

