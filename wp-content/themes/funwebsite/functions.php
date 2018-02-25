<?php


function project_scripts() {

	wp_register_script( 'theme_js', get_template_directory_uri() . '/js/my_custom_js.js', array( 'jquery' ));

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'theme_js' );
}

add_action( 'wp_enqueue_scripts', 'project_scripts' );


function my_default_function() {

	add_theme_support( 'title-tag' );

}

add_action( 'after_setup_theme', 'my_default_function' );

function testing($pass_value) {

	echo "<pre>";
	var_dump($pass_value);
	exit();
}


// => for ajax checking email


function email_check() {

	//print_r($_POST);

	$name = $_POST['name'];
	$email = $_POST['email'];
	$role = $_POST['role'];
	$pass = $_POST['pass'];



	if ( email_exists( $email )) {
		
		echo "match-email";

	} else {

		$userdata = [

				'user_login' => $name, 
				'user_email' => $email,
				'user_pass' => $pass,
				'role' => $role
			];

			$user_id = wp_insert_user( $userdata );

			echo "success";

	}

	 // Don't forget to stop execution afterward.
    wp_die();

}


add_action( 'wp_ajax_email_check', 'email_check' );
add_action( 'wp_ajax_nopriv_email_check', 'email_check' );


// => for ajax checking email 


function email_checking() {

	echo "<pre>";
	print_r($_POST);
}



function get_user_role() {
    global $current_user;

    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);

    return $user_role;
}


/*-------------------/This is started my code here/--------------------------*/

/**
 * Registers a new post type
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 */
function user_post_register_name() {

	$labels = array(
		'name'               => __( 'User post', 'text-domain' ),
		'singular_name'      => __( 'User post', 'text-domain' ),
		'add_new'            => _x( 'Add New User post', 'text-domain', 'text-domain' ),
		'add_new_item'       => __( 'Add New User post', 'text-domain' ),
		'edit_item'          => __( 'Edit Singular Name', 'text-domain' ),
		'new_item'           => __( 'New Singular Name', 'text-domain' ),
		'view_item'          => __( 'View Singular Name', 'text-domain' ),
		'search_items'       => __( 'Search Plural Name', 'text-domain' ),
		'not_found'          => __( 'No Plural Name found', 'text-domain' ),
		'not_found_in_trash' => __( 'No Plural Name found in Trash', 'text-domain' ),
		'parent_item_colon'  => __( 'Parent Singular Name:', 'text-domain' ),
		'menu_name'          => __( 'User post', 'text-domain' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => null,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => true,
		'capability_type'     => 'post',
		'supports'            => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'custom-fields',
			'trackbacks',
			'comments',
			'revisions',
			'page-attributes',
			'post-formats',
		),
	);

	register_post_type( 'user_post', $args );
}

add_action( 'after_setup_theme' , 'user_post_register_name' );



function user_post_function() {

	$user_id = get_current_user_id();
	
	//print_r($_POST);

	$title = $_POST['title'];
	$content = $_POST['content'];

	$id = wp_insert_post(

			array(

				'post_title'=> $title, 
				'post_type'=>'user_post', 
				'post_content'=> $content, 
				'post_author'=> $user_id,
				'post_status'=> 'publish'
			)

		);


	// Don't forget to stop execution afterward.
	wp_die();

}


add_action( 'wp_ajax_user_post_function', 'user_post_function' );
add_action( 'wp_ajax_nopriv_user_post_function', 'user_post_function' );




function user_post_status_function() {

	$user_id = get_current_user_id();

	//print_r($user_id);

	print_r($_POST);

	/*$id = wp_insert_post( 

		array(

				'post_title'=> $title, 
				'post_type'=>'user_post', 
				'post_content'=> $content, 
				'post_author'=> $user_id,
				'post_status'=> 'publish'
			)

	);*/


	// Don't forget to stop execution afterward.
	wp_die();

}

add_action( 'wp_ajax_user_post_status_function', 'user_post_status_function' );
add_action( 'wp_ajax_nopriv_user_post_status_function', 'user_post_status_function' );



/*function new_subscriber_function() {

	$user_id = get_current_user_id();

	$title = $_POST['title'];
	$content = $_POST['content'];

	$id = wp_insert_post(

		array(

			'post_title'=> $title, 
			'post_type'=> 'subscrib', 
			'post_content'=> $content,
			'post_author'=> $user_id

		)

	);


	// Don't forget to stop execution afterward.
	wp_die();

}

add_action( 'wp_ajax_user_new_subscriber_function', 'new_subscriber_function' );
add_action( 'wp_ajax_nopriv_user_new_subscriber_function', 'new_subscriber_function' );*/








/*add_role( $role, $display_name, $capabilities );

add_role(
    'Content_Writer',
    __( 'content Writer' ),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
    )
);*/


//remove_role( 'content Writer' );


/*if (get_role( 'Custom Editor' )) {

	remove_role( 'custom_editor' );

}*/


// => insert role in database


/*$result = add_role(
    'content_writer',
    __( 'Content Writer' ),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
    )
);



if ( null !== $result ) {
    echo 'Yay! New role Content Writer created!';
}
else {
    echo 'Oh... the Content Writer role already exists.';
}*/

//remove_role( 'Content_Writer' );