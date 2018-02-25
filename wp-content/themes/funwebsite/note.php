
// => Note

1. I have created a login page, how to like the page for going. 








<?php  

		$managementitem = new WP_Query(

			array(

				'post_type' => 'user_post',
				'posts_per_page' => 4,
				//'order' => 'ASC',

			)

		);

	?>

	

	<div>Your Posts</div>
	<ul>
		<?php while($managementitem -> have_posts()) : $managementitem -> the_post(); ?>
		<li><?php the_title() ."-".get_post_status( $ID ); ?></li>
		<li><?php the_content(); ?></li>
		<?php endwhile; ?>
	</ul>




<?php	

$args = array(

				'post_type' => 'user_post',
				'posts_per_page' => 4,
				//'order' => 'ASC',

			);
// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
	echo '<ul>';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		echo '<li>' . get_the_title() . '</li>';
		echo '<li>' . get_the_content() . '</li>';
	}
	echo '</ul>';
	//Restore original Post Data 
	wp_reset_postdata();
} else {
	// no posts found
}
?>
