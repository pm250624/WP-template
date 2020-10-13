<?php
/**
 * Team Member block
 *
 * @package      Custom Blocks
 * @author       Bonkaroo
 * @since        1.0.0
 * @license      GPL-2.0+
**/

global $wpdb;
$sectionTitle = get_field('data_description');

//$colcss ="col-sm-4";
$colcss ="col-md-6";


?>

<!-- CSS code -->

<style type="text/css">
table {
margin: 8px;
max-width: 500;
}

th {
font-family: Arial, Helvetica, sans-serif;
font-size: .7em;
background: #666;
color: #FFF;
padding: 2px 6px;
border-collapse: separate;
border: 1px solid #000;
}

td {
font-family: Arial, Helvetica, sans-serif;
font-size: .7em;
border: 1px solid #DDD;
}


.scrollit {
    overflow:scroll;
    height:500px;
    max-width: 500;
    background-color: powderblue;
}

.btn-group button {
  background-color: #4CAF50; /* Green background */
  /* border: 1px solid green; Green border */
  color: white; /* White text */
  /*padding: 10px 24px;  Some padding */
  cursor: pointer; /* Pointer/hand icon */
  float: left; /* Float the buttons side by side */
  font-family: Arial, Helvetica, sans-serif;
  font-size: .7em;
  border: 1px solid #DDD;
}

/* Clear floats (clearfix hack) */
.btn-group:after {
  content: "";
  clear: both;
  display: table;
}

.btn-group button:not(:last-child) {
  border-right: none; /* Prevent double borders */
}

/* Add a background color on hover */
.btn-group button:hover {
  background-color: #3e8e41;
}

.column2 {
  width: 45%;
  padding: 40px;
  column-gap: 10px;
  column-width: 500px;
  column-count: 2;
}

.column {
  float: left;
  width: 50%;
  padding: 40px;
  column-gap: 10px;
  column-width: 500px;
  column-count: 2;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}


p {
  font-size: 18px;
}


</style>



<div class="section-devider"> 
<h1  style="text-align:center"><?php echo ($sectionTitle); ?><h1>
<hr>

<div class="parent-wrapper">


  <div class="<?php echo $colcss; ?>" style="background-color:#aaa;">
    
<?php 
      $inDataSet1 = 7;
     displayTable1 ($inDataSet1);

?>
  
       
</div>
<div class="<?php echo $colcss; ?>" id="ajax-target" style="background-color:#bbb;">

	<?php $inStateCd = 0;
	displayTable ($inStateCd); ?>

</div>
</div>
<?php

// echo '<pre>';
//     print_r( get_field('post_objects')  );
// echo '</pre>';
// die;





/* ************************************************ */


?>










