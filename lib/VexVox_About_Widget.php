<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 10/14/14
 * Time: 11:16 PM
 */

class VexVox_About_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct( 'widget_vexvox_about', __( 'About', 'vexvox' ), array(
			'classname'   => 'widget_vexvox_about',
			'description' => __( 'A description of the site that appears on every page.', 'vexvox' ),
		) );
	}

	public function widget( $args, $instance ) {
		$title = !empty( $instance['title'] ) ? $instance['title'] : translate( 'Calendar', 'vexvox' );
		$description = !empty( $instance['description'] ) ? $instance['description'] : '<p>A description of this WordPress site goes here.</p>';
		echo $args['before_widget'];
		echo <<< ABOUT
<h3>$title</h3>
$description
ABOUT;
		echo $args['after_widget'];

	}

	public function update( $new_instance, $instance ) {
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['description']  = wp_kses_post( $new_instance['description'] );

		return $instance;
	}

	public 	function form( $instance ) {
		$title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
		$description = empty( $instance['description'] ) ? '' : $instance['description'];
		?>
		<p><label class="form-label" for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'vexvox' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php _e( 'Description:', 'vexvox' ); ?></label><br/>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_html( $description ); ?></textarea></p>
	<?php
	}
}