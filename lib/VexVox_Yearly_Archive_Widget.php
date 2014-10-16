<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 10/14/14
 * Time: 11:16 PM
 */

class VexVox_Yearly_Archive_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct( 'widget_vexvox_yearly_archive', __( 'Archives (Yearly)', 'vexvox' ), array(
			'classname'   => 'widget_vexvox_yearly_archive',
			'description' => __( 'A yearly archive of your site\'s Posts.', 'vexvox' ),
		) );
	}

	public function widget( $args, $instance ) {
		$title = !empty( $instance['title'] ) ? $instance['title'] : translate( 'Calendar', 'vexvox' );
		echo $args['before_widget'];
		?>
		<h3><?php echo $title; ?></h3>
		<ul>
			<?php wp_get_archives(array('type' => 'yearly')); ?>
		</ul>
	<?php
		echo $args['after_widget'];

	}

	public function update( $new_instance, $instance ) {
		$instance['title']  = strip_tags( $new_instance['title'] );

		return $instance;
	}

	public 	function form( $instance ) {
		$title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'vexvox' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>

	<?php
	}
}