
<?php 

	wp_head();

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>


	<style type="text/css">
		body ul {
			list-style: none;
		}

		.login {
			padding: 0 25px;
			border-radius: 10px;
		}

		.login h1 {
			color: blue;
		}

		.login a {
			float: right;
		}
	</style>
</head>
<body>

	<div class="login">
		<a href="<?php echo site_url('login') ?>"> Register / Login </a>
		<h1>Welcome to our website</h1>

	</div>


	<?php  


		$userPost = new WP_Query (

			array(

				'post_type' => 'user_post',
				//'posts_per_page' => '4'
				'post_status' => array( 'publish') //'draft'
			)

		)


	?>

	<ul>

		<?php while($userPost -> have_posts()) : $userPost -> the_post(); ?>

			<li> <h3><?php the_title()."_". get_post_status( $ID ) ; ?></h3></li>
			<li><?php the_content(); ?></li>

		<?php endwhile; ?>

	</ul>

<?php wp_footer(); ?>
</body>
</html>