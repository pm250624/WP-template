<?php
/* enqueue script for parent theme stylesheeet */
function childtheme_parent_styles() {

 // enqueue style
 wp_enqueue_style( 'parent', get_template_directory_uri().'/style.css' );
}
add_action( 'wp_enqueue_scripts', 'childtheme_parent_styles');


function add_theme_scripts() {
	wp_enqueue_style( 'bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' );
	//wp_enqueue_style( 'external_css', 'https://unpkg.com/purecss@2.0.3/build/grids-responsive-min.css');
	wp_enqueue_style( 'swiper-style', get_template_directory_uri() . '-child/scripts/css/swiper-bundle.min.css');
	wp_enqueue_script( 'swiper-js', get_template_directory_uri() . '-child/scripts/js/swiper-bundle.min.js');
	wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'slug-ajax', get_template_directory_uri() . '-child/scripts/js/myjquery.js', array('jquery'), false, true );
		
		$jp = array(
			'nonce' => wp_create_nonce( 'nonce' ),
			'ajaxURL' => admin_url( 'admin-ajax.php' )
		); 
		wp_localize_script( 'slug-ajax', 'jp', $jp ); 


  }
  add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );


 




/**
 * Register Blocks
 * @package CoreFunctionality
 * @author	Bonkaroo
 * @since	1.0.0
 * @license	GPL-2.0
 * @link https://www.Bonkaroo.com
 **/

function pm_register_blocks() {
	
	if( ! function_exists( 'acf_register_block_type' ) )
		return;

	acf_register_block_type( array(
		'name'			=> 'action-post',
		'title'			=> ('Action Post'),
		'description'	=> ('Display post that has been designated an Action Post'),
		'render_template'	=> 'template-parts/block-action-post.php',
		'category'		=> 'formatting',
		'icon'			=> 'warning',
		'keywords'		=> array( 'action', 'alert'),
		'mode'			=> 'edit',
		'Supports'		=> array('alighfull' => true, 'mode' => false)
	));


	acf_register_block_type( array(
		'name'			=> 'displayPosts',
		'title'			=> ('Display Posts'),
		'description'	=> ('Display posts on page'),
		'render_template'	=> 'template-parts/displayPosts.php',
		'category'		=> 'formatting',
		'icon'			=> 'networking',
		'keywords'		=> array( 'posts', 'hyperlink'),
		'mode'			=> 'edit',
		'Supports'		=> array('alighfull' => true, 'mode' => false)
	));


	acf_register_block_type( array(
		'name'			=> 'slider',
		'title'			=> ('Slider'),
		'description'	=> ('Slider for ACF gallery'),
		'render_template'	=> 'template-parts/block-slider.php',
		'category'		=> 'formatting',
		'icon'			=> 'format-gallery',
		'keywords'		=> array( 'slider', 'gallery'),
		'mode'			=> 'edit',
		'Supports'		=> array('alighfull' => true, 'mode' => false)
	));


	acf_register_block_type( array(
		'name'			=> 'dataTable',
		'title'			=> ('Display dataTable'),
		'description'	=> ('Display dataTable in a page'),
		'render_template'	=> 'template-parts/dataTable.php',
		'category'		=> 'formatting',
		'icon'			=> 'media-spreadsheet',
		'keywords'		=> array( 'table', 'data'),
		'mode'			=> 'edit',
		'Supports'		=> array('alighfull' => true, 'mode' => false)
	));



}

add_action('acf/init', 'pm_register_blocks' );




/*
* Creating a function to create our CPT
*/
 
function pmm_register_post_types() {

	$textDomain ='twentytwenty';
 
	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Hyperlinks', 'Post Type General Name', $textDomain ),
			'singular_name'       => _x( 'Hyperlink', 'Post Type Singular Name', $textDomain ),
			'menu_name'           => __( 'Hyperlinks', $textDomain ),
			'view_item'           => __( 'View Links', $textDomain ),
			'add_new_item'        => __( 'Add new list of Hyperlinks', $textDomain ),
			'add_new'             => __( 'Add New', $textDomain ),
			'edit_item'           => __( 'Edit list', $textDomain ),
			'update_item'         => __( 'Update Hyperlinks', $textDomain ),
			'search_items'        => __( 'Search Hyperlinks', $textDomain ),
			'not_found'           => __( 'Not Found', $textDomain ),
			'not_found_in_trash'  => __( 'Not found in Trash', $textDomain ),
		);
		 
	// Set other options for Custom Post Type
		 
		$args = array(
			'label'               => __( 'links', $textDomain ),
			'description'         => __( 'Links to organizations that support women', $textDomain ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'revisions', 'custom-fields'),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'tag' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'show_in_custom_fields'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest' => true,
	 
		);
		 
		// Registering your Custom Post Type
		register_post_type( 'network_links', $args );
	 
	}
	 
	/* Hook into the 'init' action so that the function
	* Containing our post type registration is not 
	* unnecessarily executed. 
	*/
	 
	add_action( 'init', 'pmm_register_post_types', 0 );


	

/*
* Creating a function to display hyperlink custom post type
*/

function displayHyperPost ($post, $colcss ) {

	//$repeater = get_field('network_links');
	//$repeatNum = count($repeater);


					// collect the tags associated with the links
					$array1=[];
					while ( have_rows('network_links', $post) ) : the_row();
						$tag_ID  = get_sub_field('tag');
						$array1[] = $tag_ID;
					endwhile;

					//$numArray1=count($array1);
					$array1 = array_unique($array1);
					
					// print_r($array1); 

	?>		
					<div class="<?php echo $colcss; ?>">
					<h2><?php the_title(); ?></h2>
				
	<?php
								
					foreach ($array1 as &$tag_ID) {

						$tag = get_tag($tag_ID); 
						
	?>
						<h4><?php echo $tag->name; ?></h4> 

						<ul>
						
	<?php		

						while ( have_rows('network_links', $post) ) : the_row();

						if(  $tag_ID == get_sub_field('tag')): 
							$link=get_sub_field('link');     ?>						
						

							<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
							<h4><li><?php echo $link['title']; ?></li></h4></a>



							
						<?php endif; 

					    endwhile; ?>

						</ul>
							
			<?php	} //end foreach ?>


					</div>

<?php
	}   // End Function


// echo '<pre>';
//     print_r( get_field('post_objects')  );
// echo '</pre>';
// die;





?>



<?php

/*
* A function to display a table
*/

function displayTable ($inStateCd) {

global $wpdb;

$sqlStatementSubtitle = "SELECT * FROM coviddata_state_chg Where fips=".$inStateCd." and period_days=7";
$result = $wpdb->get_results( $sqlStatementSubtitle);

// echo '<pre>';
//     print_r(  $result );
// echo '</pre>';
// die;


$subTitle = $result[0]->description;

$sqlStatement="SELECT * FROM coviddata_state_chg_History_V Where fips=".$inStateCd." order by date_end desc";




?>



<div id="ajax-target2">

<?php
		//$wpdb->show_errors();
		$result = $wpdb->get_results( $sqlStatement);
		//$wpdb->print_error();

		//<p> <?php echo $print->date_end.', '.$print->period;	</p>
        $i=0;
		foreach ( $result as $print )   { 
		
			if ( $i==0 ): ?>
				<h3 style="text-align:center"> <?php echo $print->state.' Historical View'; ?></h3>
				<p style="text-align:center"> <?php echo $subTitle;	?></p>
				
				
				<div class="scrollit">

				<table>
				<tr>
				<th>Date</th>	
      			<th>TotCases</th>
	 			<th>NewCases</th>
				<th>Per100k</th>
     			<th>TotDead</th>
	 			<th>NewDead</th>
    			</tr>
			<?php endif; ?>


          <tr>
		  		  <td><?php echo $print->date_end; ?> </td>
				  <td> <?php echo $print->cases_end; ?> </td>
				  <td><?php echo $print->cases_chg; ?> </td>
				  <td><?php echo $print->casesPer100k; ?> </td>
                  <td> <?php echo $print->deaths_end; ?> </td>
				  <td> <?php echo $print->deaths_chg; ?> </td>  
          </tr>
			<?php $i=$i+1; 
			
		}
      ?>

</table>
</div>
</div>
<?php

	} // End function

// echo '<pre>';
//     print_r( get_field('post_objects')  );
// echo '</pre>';
// die;



add_action( 'wp_ajax_jp_ajax_test', 'slug_ajax_callback' );
add_action( 'wp_ajax_no_ppriv_jp_ajax_test', 'slug_ajax_callback' );
function slug_ajax_callback() {

	
	
	$nonce = $_GET['nonce'];
	//echo "nonce: ".$nonce;
	if ( wp_verify_nonce( $nonce, 'nonce' ) ) {

		$inStateCd =  $_GET["state"];
	
	    displayTable ($inStateCd);

		wp_die( "" );
	}
	else{
        wp_die( 'Nonce error' );
    }


 
}

?>






<?php

function displayTable1 ($inDataSet) {

global $wpdb;

$sqlStatement = "SELECT * FROM coviddata_state_chg Where period_days=".$inDataSet." order by date_end desc, section, casesPer100k desc";





// echo '<pre>';
//     print_r(  $result );
// echo '</pre>';
// die;


?>



<div id="ajax-target2a">

<?php
		//$wpdb->show_errors();
		$result = $wpdb->get_results( $sqlStatement);
		//$wpdb->print_error();

        $i=0;
foreach ( $result as $print )   { 

	if ( $i==0 ): ?>
		<h3 style="text-align:center" > <?php echo 'Current Day View';	?></h3>
		<p style="text-align:center" > <?php echo 'Date: '.date("M j", strtotime($print->date_end)).', Period: '.$print->period.'.';	?></p>


		<div class="scrollit">

		<table>
		<tr>
		 <th>State</th>
		  <th>TotCases</th>
		 <th>NewCases</th>
		<th>Per100k</th>
		 <th>TotDead</th>
		 <th>NewDead</th>
		 <th>Load</th>
		</tr>
	<?php endif; ?>


  <tr>
   
		  <td><?php echo $print->state; ?> </td>
		  <td> <?php echo $print->cases_end; ?> </td>
		  <td><?php echo $print->cases_chg; ?> </td>
		  <td><?php echo $print->casesPer100k; ?> </td>
		  <td> <?php echo $print->deaths_end; ?> </td>
		  <td> <?php echo $print->deaths_chg; ?> </td>
		  <td> <div ID=<?php echo $print->fips; ?> class="btn-group"><button ><?php echo $print->state_cd; ?>  </button></div> </td>
		 
		  
		  
  </tr>
	<?php $i=$i+1; 
	
}
?>

</table>
</div>


</div>
<?php

	} // End function

// echo '<pre>';
//     print_r( get_field('post_objects')  );
// echo '</pre>';
// die;


?>