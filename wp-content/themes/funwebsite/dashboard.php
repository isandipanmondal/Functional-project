<?php  

/*
	Template Name: dashboard
*/

	wp_head();

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>:: Dashboard page ::</title>
</head>
<body>

	<h1>Welcome to dashboard page</h1>
	<span style="float: right;">

		<?php  

			global $current_user;
			get_currentuserinfo();
			echo 'User name ' . $current_user->display_name ;
			echo " [" . get_user_role() . "]";

		?>
		<a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></span>

	<?php 

	 /* global $current_user;
      get_currentuserinfo();

      echo 'Username: ' . $current_user->user_login . "<br>";
      echo 'User email: ' . $current_user->user_email . "<br>";
      echo 'User level: ' . $current_user->user_level . "<br>";
      echo 'User first name: ' . $current_user->user_firstname . "<br>";
      echo 'User last name: ' . $current_user->user_lastname . "<br>";
      echo 'User display name: ' . $current_user->display_name . "<br>";
      echo 'User ID: ' . $current_user->ID . "<br>";*/

	?>

	<?php 

	  /*$user_info = get_userdata(1);
      echo 'Username: ' . $user_info->user_login . "<br>";
      echo 'User roles: ' . implode(', ', $user_info->roles) . "<br>";
      echo 'User ID: ' . $user_info->ID . "<br>";*/

	?>



	<?php  


		$userPost = new WP_Query (

			array(

				'post_type' => 'user_post',
				 'author'   => get_current_user_id(),
				//'posts_per_page' => '4'
				'post_status' => array( 'publish', 'draft')
			)

		)


	?>


	<?php  

		$user = wp_get_current_user();
		if ( in_array( 'editor', (array) $user->roles ) ) {
		    
		    $userPost = new WP_Query (

			array(

				'post_type' => 'user_post',
				 //'author'   => get_current_user_id(),
				//'posts_per_page' => '4'
				'post_status' => array( 'publish', 'draft')
			)

			)

			?>

			<ul>

				<?php while($userPost -> have_posts()) : $userPost -> the_post(); ?>
					<?php //echo "<pre>";print_r($userPost); ?>
				
					<li> 
						<h3>

						<a href="<?php the_permalink(get_the_ID()); ?>"><?php the_title(); ?></a> 

						<?php echo get_post_status( $ID ); ?>

							<form method="POST" action="" id="input_values">
								<input type="text" id="post_sta" name="post_sta" value="<?php echo get_the_ID(); ?>" readonly="readonly">
								<input type="button" name="submit" value="Accept" id="accept">  
							</form>

							<!-- <form method="POST">
								<input type="text" id="post_sta" name="post_sta" value="<?php //echo get_the_ID(); ?>" readonly="readonly">
								<input type="button" name="declined" value="Declined" id="declined">  
							</form> -->



							<!-- <?php 
							
									//if (get_post_status( $ID ) == 'draft') { ?> 
							
										<form method="POST">
											<input type="hidden" id="post_sta" name="post_sta" value="<?php //echo get_the_ID(); ?>" readonly="readonly">
											<input type="button" name="Accept" value="Accept" id="accept">  
										</form>
							
										
									<?php } //else { ?>
										<button>Declined</button> 
									<?php }
							
								?> -->


						</h3>
					</li>

				<?php endwhile; ?>

			</ul>

		<?php } // Editor section

	?>
	


	<?php  

		$user = wp_get_current_user();
		if ( in_array( 'content_writer', (array) $user->roles ) ) { 

			$userPost = new WP_Query (

			array(

				'post_type' => 'user_post',
				 'author'   => get_current_user_id(),
				//'posts_per_page' => '4'
				'post_status' => array( 'publish', 'draft')
			)

			)

			?>
		    

			<ul>

				<?php while($userPost -> have_posts()) : $userPost -> the_post(); ?>
				
					<li> <a href=""> <h3><?php echo  get_the_title()."-".get_post_status( $ID ); ?></a></h3></li>

				<?php endwhile; ?>

			</ul>



		<?php } // Content writer section

	?>

	
	

	<table border="1">
		<form action="" method="POST" id="post_id">
			<tr>
				<td>Article Title</td>
				<td><input type="text" name="title" id="title" style="width: 100%;"></td>
			</tr>
			<tr>
				<td>Description</td>
				<td><textarea name="content" id="content" cols="50" rows="5"></textarea></td>
			</tr>
			<tr>
				<td colspan="2"><input type="button" name="submit" value="Post" id="submit_post"></td>
			</tr>
		</form>
	</table>
	<div id="display"></div>



	<script> 

	</script>





	<script type="text/javascript">
		
		jQuery(document).ready(function($) {
			jQuery("#accept").click(function(event) {
				
				var pstatus = jQuery("input").$(this).val();


				//alert("1");
				console.log(pstatus);

				/*jQuery.ajax({
				  url: '<?php //echo admin_url( 'admin-ajax.php' ); ?>',
				  type: 'POST',
				  data: {

				  	action: "user_post_status_function",
				  	//postid: post_sta,

				  },
				  success: function(textStatus,data) {
				    console.log(data);
				  },
				  
				});*/
				
			});
		});


	</script>


	


	<script type="text/javascript">

		jQuery(document).ready(function($) {
			
			jQuery("#submit_post").click(function(event) {

				var tilte = jQuery("#title").val();
				var content = jQuery("#content").val();

				//alert(content);

				jQuery.ajax({
				  url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
				  type: 'POST',
				  //dataType: 'text',
				  data: {

				  	action: "user_post_function",
				  	title: tilte,
				  	content: content,

				  },
				  success: function(textStatus, data) {
				  	console.log(data);
				    jQuery("#display").text(data);
				    jQuery("#post_id")[0].reset();
				  },
				});

			});

		});

	</script>


	<?php wp_footer(); ?>
</body>
</html>