<?php  
	
	/* Template Name: Login page*/

	global $wpdb;

	if (isset($_POST['regis'])) {

		$first_name = $wpdb->escape(trim($_POST['uname']));
		$user_email = $wpdb->escape(trim($_POST['uemail']));
		$role = $wpdb->escape(trim($_POST['urole']));
		$user_pass = $wpdb->escape(trim($_POST['upass']));


		if ( is_email( $user_email )) {

			$userdata = [

				'user_login' => $first_name, 
				'user_email' => $user_email,
				'user_pass' => $user_pass,
				'role' => $role
			];

			$user_id = wp_insert_user( $userdata );


			if (! is_wp_error( $user_id )) { ?>
			
				<script type="text/javascript">
					alert("User created ' <?php echo $user_id; ?> '");
				</script>

			<?php }

		} else {

			echo "Not a valid email address given";

		}



	}

	
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Dual Registration Form  Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />


<link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet" type="text/css" media="all"/>

<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>"> 

<!--web-fonts-->
<link href='//fonts.googleapis.com/css?family=Kotta+One' rel='stylesheet' type='text/css'>
<!--web-fonts-->

<!-- <script type="text/javascript" src="<?//php echo get_template_directory_uri(); ?>/js/my_custom_js.js"></script> -->

<?php wp_head(); ?>
</head>
<body>
		<!--header-->
		<div class="header">
			<h1>Dual Registration Form</h1>
		</div>
		<!--header-->
		<!---main-->
			<div class="main">
				<div class="main-section">
				<div class="registration-section">
					<h2>register or sign in</h2>
					<div class="social-icons">
						<a href="#"><i class="icon"></i><span>Sign in with twitter</span></a>
						<a href="#"><i class="icon1"></i><span>Sign in with facebook</span></a>
						<a href="#"><i class="icon2"></i><span>Sign in with google +</span></a>
					</div>
					<div class="register-form">
					<div class="login-form">

					<?php  

						$args = array(
							'echo'           => true,
							'remember'       => true,
							'redirect'       => ( 'http://localhost/project_10/dashboard' ),
							'form_id'        => 'loginform',
							'id_username'    => 'user_login',
							'id_password'    => 'user_pass',
							'id_remember'    => 'rememberme',
							'id_submit'      => 'wp-submit',
							'label_username' => __( '' ),
							'label_password' => __( '' ),
							'label_remember' => __( 'Remember Me' ),
							'label_log_in'   => __( 'Log In' ),
							'value_username' => '',
							'value_remember' => false
						);

						wp_login_form( $args  );

					?>


					</div>
					<div class="registration-form">

						<div class="error" id="error"></div>
						<div class="success" id="success"></div>

						<form method="POST" action="" id="form_register">
							<div class="ajax_msg"></div>
							<input type="text" placeholder="User name" name="uname" id="user_name">
							<input type="email" placeholder="Email" name="uemail" id="email_check">

							<?php global $wp_roles;

   							 	global $wp_roles;
     						 	$roles = $wp_roles->get_names();

						     ?> 
						     <select class="user_role">
							<?php foreach($roles as $role) { ?>
								
								<?php if ($role == "Editor" || $role == "Content Writer") { ?>
										<option value="<?php echo strtolower(str_replace(" ","_",$role)); ?>"><?php echo $role;?></option>
								<?php } ?>
							   
							<?php }//end foreach ?>
							</select>
							
							<!-- <select name="urole" class="select-field" id="user_role">
								<option>Select User</option>
								<option value="subscriber">Subscriber</option>
								<option value="contributor">Contributor</option>
								<option value="author">Author</option>
								<option value="editor">Editor</option>
								<option value="administrator">Administrator</option>
								<option value="administrator">Administrator</option>
							</select> -->

							
							<input type="password" placeholder="Password" name="upass" id="use_pass">
							<input type="button" value="submit" name="regis" id="submit_ajax" class="submitButton">
						</form>


					</div>
					<div class="clear"></div>
					</div>
					<p>forgot your password? click<a href="#"> here </a></p>
				</div>
			</div>
			<div class="footer">
			<p> &copy; 2016 Dual Registration Form . All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a> </p>
		</div>

		<!---main-->

	
<script type="text/javascript">
	
	jQuery(document).ready(function($) {
		jQuery("#submit_ajax").click(function(event) {
			
			event.preventDefault();
			

			var user_name = jQuery("#user_name").val();
			var user_email = jQuery("#email_check").val();
			var user_role = jQuery("#user_role").val();
			var use_pass = jQuery("#use_pass").val();


			if( user_name == '' || user_email == '' || user_role == '' || use_pass == '' ) {

				jQuery("#error").text('Ther are empty field... !!!').show();
				jQuery("#error").fadeOut(5000);

			} else {

				var name = jQuery("#user_name").val();
				var email = jQuery("#email_check").val();
				var role = jQuery(".user_role").val();
				var pass = jQuery("#use_pass").val();
				//console.log(email);

				//alert(email);

				jQuery.ajax({
					url: '<?php echo admin_url( "admin-ajax.php" ); ?>', 
					type: 'POST',
					data: {

						action: "email_check", 
						name: name,
						email: email,
						role: role,
						pass: pass,
					},
					success: function (data) {
	       				 console.log(data);


	       				 if (data == "match-email") {

	       					jQuery(".ajax_msg").text('The email is exists').css('color', '#ff0000').show();
	       					jQuery(".ajax_msg").fadeOut(5000);
	       					//jQuery("#form_register")[0].reset();

	       				 } 

	       				 if (data == "success") {

	       					jQuery(".ajax_msg").text('User inserted successfully').css('color', '#ff0000').show();
	       					jQuery(".ajax_msg").fadeOut(5000);
	       					jQuery("#form_register")[0].reset();

	       				 } 



	   				 }
				})
				

			}






		});
	});


</script>






<!-- <script type="text/javascript">
	
	jQuery(document).ready(function($) {

		jQuery("#email_check").change(function(event) {

			var email = jQuery("#email_check").val();
			//console.log(email);

			jQuery.ajax({
				url: '<?//php echo admin_url( "admin-ajax.php" ); ?>', 
				type: 'POST',
				data: {
					"email_check",email: email
				},
				success: function (data) {
       				 console.log(data);
   				 }
			})
			
			
		});

	});

</script> -->


<!-- <script type="text/javascript">
	
	jQuery(document).ready(function($) {

		jQuery("#submit_ajax").click(function(event) {

			var email = jQuery("#email_check").val();
			//console.log(email);

			jQuery.ajax({
				url: '<?php //echo admin_url( "admin-ajax.php" ); ?>', 
				type: 'POST',
				data: {
					action: "email_check", email: email
				},
				success: function (data) {
       				 console.log(data);

       				 if (data == "match-email") {
       				 	event.preventDefault();
       				 }
   				 }
			})
			
			
		});

	});

</script> -->









<?php wp_footer(); ?>	

</body>
</html>