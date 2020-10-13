<?php
/**
 * Team Member block
 *
 * @package      Custom Blocks
 * @author       Bonkaroo
 * @since        1.0.0
 * @license      GPL-2.0+
**/





// echo '<pre>';
// print_r(get_field('featured_post'));
// echo '</pre>';
// die();





$colcss ="pure-u-1 pure-u-xl-1-3";

$images = get_field('slider');
$size = 'medium_large'; // (thumbnail, medium, large, full or custom size)


/*
echo '<pre>';
    print_r( get_field('homepage_picture')  );
echo '</pre>';
die;
*/


?>

<!-- 

<div class="section-devider"> 

	<hr>
</div>

 -->

 

<div class="grid-container">
    <div class="swiper-container">
  		<div class="swiper-wrapper">

		  <?php foreach(  $images as $image_id ): ?>
			<?php $result = $image_id['sizes'][$size]; ?>
			<img class="swiper-slide" src="<?PHP echo $result; ?>" alt="<?= $image_id['alt'] ?>"  />
		  <?php endforeach; ?>
		
		</div>

		<!--<div class="swiper-pagination"></div>-->
		<!--<div class="swiper-scrollbar"></div>-->
		
		<!-- navigation buttons -->
		<div class="swiper-button-prev"></div>
    	<div class="swiper-button-next"></div>

		<hr>

	</div>	  



</div>




<?php


// echo '<pre>';
//     print_r( get_field('featured_post')  );
// echo '</pre>';
// die;







// echo '<pre>';
//     print_r( get_field('post_objects')  );
// echo '</pre>';
// die;





?>

















<!-- echo '<pre>';
    print_r( get_field('post_objects')  );
echo '</pre>';
die; -->





<?php 
// echo '<pre>';
// print_r(get_field('gallery'));
// echo '</pre>';
//die();
?>