<?php


function basic_default_wp_function() {

	add_theme_support( 'title-tag' );

}

add_action( 'after_setup_theme', 'basic_default_wp_function' );


function hello_world() {

	echo "Hello world";

}


/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home right sidebar',
		'id'            => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );


/**
* widget development
*/
class AuthorBio extends WP_Widget
{
	
	public function __construct()
	{
		parent::__construct( 

			$location = 'AuthorBio', 
			$name = __('Author Widget', 'test_domain'), 
			$type = [
				'description' => __('All information of Author', 'text_domain'),
			]

		);
	} 

	//=> end 


	public function widget( $args, $instance ) {

		// data get from database
		$title = $instance['title'];
		$company = $instance['company'];
		$designation = $instance['designation'];



		$widgetContain =  $args['before_title'] . "Name : " . $title . $args['after_title'] ;
		$widgetContain .=  $args['before_title'] . "Company : " . $company . $args['after_title'] ;
		$widgetContain .=  $args['before_title'] . "Designation : " . $designation . $args['after_title'] ;

		$widgetContain .= '<div class="mapImg">
						   		<img src="'.get_template_directory_uri()."/img/map.jpg".'" />
			  			   </div>
						  '; 

		echo $args['before_widget'] . $widgetContain . $args['after_widget'];

	}

	//=> end 


	public function form( $instance ) { 

		$title = $instance['title']; 
		$company = $instance['company'];
		$designation = $instance['designation'];


	?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Name:</label>
		</p>
		<p>
			<input 

				type="text" 
				class="widefat" 
				name="<?php echo $this->get_field_name('title'); ?>" 
				value="<?php echo $title ; ?>" 
				id="<?php echo $this->get_field_id('title'); ?>"
			> 

		</p>

		<p>
			<label for="">Company:</label>
		</p>
		<p>
			<input 

				type="text" 
				class="widefat" 
				name="<?php echo $this->get_field_name('company'); ?>" 
				id="<?php echo $this->get_field_id('company'); ?>" 
				value="<?php echo $company; ?>" 
			>
		</p>

		<p>
			<label for="">Designation</label>
		</p>

		<p>
			<input 

				type="text" 
				class="widefat" 
				name="<?php echo $this->get_field_name('designation'); ?>" 
				value="<?php echo $designation; ?>" 
				id="<?php echo $this->get_field_id('designation'); ?>" 
			>
		</p>

	<?php }


}


function author_bio() {

	register_widget( $widget_class = 'AuthorBio' );

}

add_action( 'widgets_init', 'author_bio' );