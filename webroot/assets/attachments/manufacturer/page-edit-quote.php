<?php


/**
 * Template Name: Edit Quote Page
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<script>
// CODE FROM http://stackoverflow.com/questions/1009808/enter-key-press-behaves-like-a-tab-in-javascript
// ASKED BY http://stackoverflow.com/users/42304/byron-whitlock
// EDITED BY http://stackoverflow.com/users/729242/maitreya
// ANSWERED BY http://stackoverflow.com/users/1470845/tcdona
// http://api.jquery.com/enabled-selector/

$('body').on('keydown', 'input, select', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button').filter(':visible:not([disabled])');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});
</script>

<script type="text/javascript">
            var ajaxSubmit = function(formEl) {
                // fetch where we want to submit the form to
                var url = $(formEl).attr('action');

                // fetch the data for the form
                var data = $(formEl).serializeArray();

if (errormessage=="") {

                // setup the ajax request
                $.ajax({
                    url: url,
		    type: "POST",
                    data: data,
                    dataType: 'json',
                    success: function(resp) {
			if(resp.success && resp.qid) {
                            alert('Quote has been copied. New Quote No. is: '+ resp.qid);
                        }
			else if(resp.success && resp.converted) {
                            alert('Quote is converted to order');
                        }
			else if(resp.success) {
                            alert('Changes have been Saved');
                        }
                    }
                });
}
errormessage="";
                // return false so the form does not actually
                // submit to the page
                return false;
            }
        </script>

	<div id="primary" class="site-content">
		<div id="content" role="main">

<?php
		$quote_id = htmlspecialchars($_GET["id"])-1000;
		$db = new wpdb('calcumrmeshit', 'Jq1xn7*6', 'calculator_mrmeshit', 'localhost:3306');
		$quotes = $db->get_results("SELECT * FROM wp_quotes WHERE id = $quote_id");
$user = new WP_User( $user_ID );
if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
	foreach ( $user->roles as $role )
?>

<header class="entry-header">
<?php if($role == "manufacturer") { ?> 
<h2 class="breadcrumb"><a href="../../my-quotes">My Quotes</a> | Edit Order</h2> <?php } else { ?> 
<h2 class="breadcrumb"><a href="../../quote">Quotes</a> | Edit Quote</h2> <?php } ?>
</header>

<?php
foreach ($quotes as $quote){}
if($quote->creator_id == get_current_user_id() ){
?>

<?php if(is_page( 212 )){ ?>
<link rel="stylesheet" href="/mrmeshit/wp-content/themes/twentytwelve/css/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>


<?php foreach ($quotes as $quote) {$mf_role = $quote->mf_role;} ?>

<p style="margin:0 0 10px 0; font-size:0.9em;">
	<?php if($role == "manufacturer") {echo "Manufacturer" . ' (as ' . ucwords($mf_role) . ')';} else {echo ucwords($role);} ?>: <strong><?php echo $current_user->user_firstname . ' ' . $current_user->user_lastname; ?></strong>
</p>	
<p style="margin:0 0 10px 0; font-size:0.9em;">Customer Name: <strong><?php foreach ($quotes as $quote) {echo $quote->customer_name;} ?></strong>
</p>		
<?php } ?>



<form method="post" action="/mrmeshit/wp-content/themes/twentytwelve/quote_edit_process.php" onSubmit="return ajaxSubmit(this);">

<?php if($role == "manufacturer") { ?><input type="hidden" value="<?php echo $mf_role;  ?>" name="manufacturer_role" /> <?php } ?>
<?php foreach ($quotes as $quote) {
	$visible_qid = $quote->id+1000; 
	echo '<p style="margin:0px 0 10px 0; font-size:0.9em;">Quote ID: <strong>'.$visible_qid.'</strong></p>';
	
if($role != "manufacturer") {
if ($quote->status==0){
		echo '<p style="margin:0px 0 20px 0; font-size:0.9em;">Status: <strong>Pending</strong></p>';
	} else if ($quote->status==1){
		echo '<p style="margin:0px 0 20px 0; font-size:0.9em;">Status: <strong>In Progress</strong></p>';
	} else if ($quote->status==2){
		echo '<p style="margin:0px 0 20px 0; font-size:0.9em;">Status: <strong>Complete</strong></p>';
	} else if ($quote->status==3){
		echo '<p style="margin:0px 0 20px 0; font-size:0.9em;">Status: <strong>Completed</strong></p>';
	} else if ($quote->status==4){
		echo '<p style="margin:0px 0 20px 0; font-size:0.9em;">Status: <strong>Expired</strong></p>';
	}
	
}} ?>

<?php if($role == "manufacturer") { ?>
<?php $status=$quote->status ; ?>
Status: <select style="margin:0 0 20px 0;" name="status">
<option <?php if($status=='0') echo "selected"; ?> value="0">Pending</option>
<option <?php if($status=='1') echo "selected"; ?> value="1">In Progress</option>
<option <?php if($status=='2') echo "selected"; ?> value="2">Complete</option>
<option <?php if($status=='3') echo "selected"; ?> value="3">Paid</option>
<option <?php if($status=='4') echo "selected"; ?> value="4">Expired</option>
</select>
<?php } ?>


<input name="quote-id" value="<?php echo $quote_id ?>" style="display:none;" />
<div id="accordion" style="font-size:0.8em !important;">  

  <h3 id="ui-accordion-accordion-header-1">Customer/Warranty Information</h3>
  <div>
<fieldset>
		<label for="order-date" style="width:100px; float:left; padding: 3px 0 0 10px; height:25px;">Quote Date:</label>
		<input id="order-date" style="width:70px; padding:2px 5px;" value="<?php foreach ($quotes as $quote) {echo $quote->order_date;} ?>" disabled />
	</fieldset>
<div style="float:left; width:300px; padding:10px;">
<fieldset>
    <label for="customer-name" style="width:100px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">Customer Name:</label>
    <input id="customer-name" name="customer-name" style="width:150px; padding:2px 5px;" value="<?php foreach ($quotes as $quote) {echo $quote->customer_name;} ?>" />
  </fieldset>
 <h4 style="margin:0 0 20px 0; font-weight:bold; font-size:12px;">Installation & Warranty Address</h4>
<fieldset>
    <label for="street" style="width:100px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">Street:</label>
    <input id="street" name="street" style="width:150px; padding:2px 5px;" value="<?php foreach ($quotes as $quote) {echo $quote->street;} ?>" />
  </fieldset>
<fieldset>
    <label for="suburb" style="width:100px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">Suburb:</label>
    <input id="suburb" name="suburb" style="width:150px; padding:2px 5px;" value="<?php foreach ($quotes as $quote) {echo $quote->suburb;} ?>" />
  </fieldset>
<fieldset>
    <label for="postcode" style="width:100px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">Postcode:</label>
    <input id="postcode" name="postcode" style="width:75px; padding:2px 5px;" value="<?php foreach ($quotes as $quote) {echo $quote->postcode;} ?>" />
  </fieldset>

  </div>
<div style="float:left; width:300px; margin-left:50px; margin-top:13px;">

 <h4 style="margin:0 0 20px 0; font-weight:bold; font-size:12px;">Contact Details</h4>

  <fieldset>
    <label for="mobile" style="width:120px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">Mobile:</label>
    <input id="mobile" name="mobile" style="width:150px; padding:2px 5px;" value="<?php foreach ($quotes as $quote) {echo $quote->mobile;} ?>" />
  </fieldset>

  <fieldset>
    <label for="phone" style="width:120px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">Home Phone:</label>
    <input id="phone" name="phone" style="width:150px; padding:2px 5px;" value="<?php foreach ($quotes as $quote) {echo $quote->phone;} ?>" />
  </fieldset>

  <fieldset>
    <label for="email" style="width:120px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">Email Address:</label>
    <input id="email" name="email" style="width:150px; padding:2px 5px;" value="<?php foreach ($quotes as $quote) {echo $quote->email;} ?>" />
  </fieldset>

  <fieldset>
    <label for="fax" style="width:120px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">Fax:</label>
    <input id="fax" name="fax" style="width:150px; padding:2px 5px;" value="<?php foreach ($quotes as $quote) {echo $quote->fax;} ?>" />
  </fieldset>

  
</div>

<div style="float:right; margin-top:13px;">

  <fieldset>    
    <textarea id="notes" name="notes" rows="5" cols="35" ><?php foreach ($quotes as $quote) {echo $quote->notes;} ?></textarea>
  </fieldset>
  
  <p style="font-size:12px;">
    Customer Notes
  </p>
</div>

</div>  
  <h3 id="ui-accordion-accordion-header-2">Powdercoating</h3>
  <div>

	<fieldset>
		<input style="float:left;  margin:4px 10px 0 0;" type="checkbox" value="yes" id="standard" name="standard" <?php if( "yes" == $quote->standard){echo 'checked';} ?> /><label for="standard" style="width:180px; float:left;  margin:0 ; padding: 3px 0 0 0; height:25px;">Panther Standard Colour Range</label> 
		<select style="width:150px; float:left;" name="standard-color">
<option></option>
		<?php 
		$standardColors = $db->get_results("SELECT name FROM wp_dropdowns WHERE type = 'Standard Color' ORDER BY name");
		foreach ($standardColors as $standardColor) {
			if( $quote->standard_color == $standardColor->name ) { echo '<option selected>'.$standardColor->name.'</option>'; }
			else { echo '<option>'.$standardColor->name.'</option>'; }
		}
?>
		</select>
		<input style="float:left;  margin:4px 10px 0 20px;" type="checkbox" value="yes" id="second-color-required" name="second-color-required" <?php if( "yes" == $quote->second_color_required){echo 'checked';} ?> /><label for="second-color-required" style="float:left;  margin:0 ; padding: 3px 0 0 0; height:25px;">Is a Second Powdercoat Required?</label> 
<div style="float:right; margin-top:-10px;">
<p style="font-size:12px;">
    Window and Door Suite Manufacturer
  </p>
  <fieldset>    
    <input style="width:205px; margin-top:10px;" id="window-door-suite-manufacturer" name="window-door-suite-manufacturer" value="<?php foreach ($quotes as $quote) {echo $quote->window_door_suite_manufacturer;} ?>" />
  </fieldset>
  
  
</div>
</fieldset>
	
<hr style="margin:20px 0;" />
	<p style="margin-bottom:10px;"><strong>Special Colour Powdercoatings</strong></p>
	<fieldset>
		<input style="float:left;  margin:4px 10px 0 0;" type="checkbox" value="yes" id="color1" name="color1"  <?php if( "yes" == $quote->color1){echo 'checked';} ?> /><label for="color1" style="width:70px; float:left;  margin:0 ; padding: 3px 0 0 0; height:25px;">Group 1</label> 
		<select style="width:250px; float:left;" name="color1-color">
			<option></option>
			<?php 
			$colors1 = $db->get_results("SELECT name FROM wp_dropdowns WHERE type = 'Color 1' ORDER BY name");
			foreach ($colors1 as $color1) {
			if( $quote->color1_color == $color1->name ){
    				echo '<option selected>'.$color1->name.'</option>';}
			else{ echo '<option>'.$color1->name.'</option>';}

			}
			?>
		</select>
	</fieldset>
<fieldset>
		<input style="float:left;  margin:4px 10px 0 0;" type="checkbox" value="yes" id="color2" name="color2" <?php if( "yes" == $quote->color2){echo 'checked';} ?> /><label for="color2" style="width:70px; float:left;  margin:0 ; padding: 3px 0 0 0; height:25px;">Group 2</label> 
		<select style="width:250px; float:left;" name="color2-color">
			<option></option>
			<?php 
			$colors2 = $db->get_results("SELECT name FROM wp_dropdowns WHERE type = 'Color 2' ORDER BY name");
			foreach ($colors2 as $color2) {
    				if( $quote->color2_color == $color2->name ){
    				echo '<option selected>'.$color2->name.'</option>';}
			else{ echo '<option>'.$color2->name.'</option>';}
			}
			?>
		</select>
	</fieldset>
	<fieldset>
		<input style="float:left;  margin:4px 10px 0 0;" type="checkbox" value="yes" id="color3" name="color3" <?php if( "yes" == $quote->color3){echo 'checked';} ?> /><label for="color3" style="width:70px; float:left;  margin:0 ; padding: 3px 0 0 0; height:25px;">Group 3</label> 
		<select style="width:250px; float:left;" name="color3-color">
			<option></option>
			<?php 
			$colors3 = $db->get_results("SELECT name FROM wp_dropdowns WHERE type = 'Color 3' ORDER BY name");
			foreach ($colors3 as $color3) {
    				if( $quote->color3_color == $color3->name ){
    				echo '<option selected>'.$color3->name.'</option>';}
			else{ echo '<option>'.$color3->name.'</option>';}
			}
			?>
		</select>
	</fieldset>
	<fieldset>
		<input style="float:left;  margin:4px 10px 0 0;" type="checkbox" value="yes" id="color4" name="color4" <?php if( "yes" == $quote->color4){echo 'checked';} ?> /><label for="color4" style="width:70px; float:left;  margin:0 ; padding: 3px 0 0 0; height:25px;">Group 4</label> 
		<select style="width:250px; float:left;" name="color4-color">
			<option></option>
			<?php 
			$colors4 = $db->get_results("SELECT name FROM wp_dropdowns WHERE type = 'Color 4' ORDER BY name");
			foreach ($colors4 as $color4) {
    				if( $quote->color4_color == $color4->name ){
    				echo '<option selected>'.$color4->name.'</option>';}
			else{ echo '<option>'.$color4->name.'</option>';}
			}
			?>
		</select>
	</fieldset>

  </div>
  <h3 id="ui-accordion-accordion-header-3">Order Details</h3>
  <div class="quote-details">
  	

<div class="ui-state-highlight" id="height-warning" style="display:none; padding:1px 2px; margin: 0 0 5px 0;">Midrail required for heights bigger than 2500!</div>
<div class="ui-state-highlight" id="width-warning" style="display:none; padding:1px 2px; margin: 0 0 5px 0;">Midrail required for widths bigger than 1300!</div>
	<div id="error" ></div>	
  	<table class="quote blue">
  		<tr>
  			<th style="width:50px;">No.</th>
  			<th style="width:35px;">QTY</th>
  			<th style="width:70px;">Security D/Grille Fibre</th>
  			<th style="width:65px;">316 SS-Gal- Pet</th>
  			<th style="width:70px;">Window or Door</th>
  			<th style="width:55px;">Window Frame Type</th>
  			<th style="width:140px;">Configuration</th>
  			<th style="min-width:100px;">Location / Notes</th>
  			<th style="width:46px;">Height mm</th>
  			<th style="width:46px;">Width mm</th>
  			<th style="width:35px;">Locks</th>
  			<th style="width:90px;">Lock Type</th>
  			<th colspan="2">Lock Handle Height</th>
  		</tr>
  		
  		<?php
$product_item_number[1] = $quote->product1_item_number;
$product_item_number[2] = $quote->product2_item_number;
$product_item_number[3] = $quote->product3_item_number;
$product_item_number[4] = $quote->product4_item_number;
$product_item_number[5] = $quote->product5_item_number;
$product_item_number[6] = $quote->product6_item_number;
$product_item_number[7] = $quote->product7_item_number;
$product_item_number[8] = $quote->product8_item_number;
$product_item_number[9] = $quote->product9_item_number;
$product_item_number[10] = $quote->product10_item_number;
$product_item_number[11] = $quote->product11_item_number;
$product_item_number[12] = $quote->product12_item_number;
$product_item_number[13] = $quote->product13_item_number;
$product_item_number[14] = $quote->product14_item_number;
$product_item_number[15] = $quote->product15_item_number;
$product_item_number[16] = $quote->product16_item_number;
$product_item_number[17] = $quote->product17_item_number;
$product_item_number[18] = $quote->product18_item_number;
$product_item_number[19] = $quote->product19_item_number;
$product_item_number[20] = $quote->product20_item_number;
$product_item_number[21] = $quote->product21_item_number;
$product_item_number[22] = $quote->product22_item_number;
$product_item_number[23] = $quote->product23_item_number;
$product_item_number[24] = $quote->product24_item_number;
$product_item_number[25] = $quote->product25_item_number;
$product_item_number[26] = $quote->product26_item_number;
$product_item_number[27] = $quote->product27_item_number;
$product_item_number[28] = $quote->product28_item_number;
$product_item_number[29] = $quote->product29_item_number;
$product_item_number[30] = $quote->product30_item_number;

$product_security_dgrille_fibre[1] = $quote->product1_security_dgrille_fibre;
$product_security_dgrille_fibre[2] = $quote->product2_security_dgrille_fibre;
$product_security_dgrille_fibre[3] = $quote->product3_security_dgrille_fibre;
$product_security_dgrille_fibre[4] = $quote->product4_security_dgrille_fibre;
$product_security_dgrille_fibre[5] = $quote->product5_security_dgrille_fibre;
$product_security_dgrille_fibre[6] = $quote->product6_security_dgrille_fibre;
$product_security_dgrille_fibre[7] = $quote->product7_security_dgrille_fibre;
$product_security_dgrille_fibre[8] = $quote->product8_security_dgrille_fibre;
$product_security_dgrille_fibre[9] = $quote->product9_security_dgrille_fibre;
$product_security_dgrille_fibre[10] = $quote->product10_security_dgrille_fibre;
$product_security_dgrille_fibre[11] = $quote->product11_security_dgrille_fibre;
$product_security_dgrille_fibre[12] = $quote->product12_security_dgrille_fibre;
$product_security_dgrille_fibre[13] = $quote->product13_security_dgrille_fibre;
$product_security_dgrille_fibre[14] = $quote->product14_security_dgrille_fibre;
$product_security_dgrille_fibre[15] = $quote->product15_security_dgrille_fibre;
$product_security_dgrille_fibre[16] = $quote->product16_security_dgrille_fibre;
$product_security_dgrille_fibre[17] = $quote->product17_security_dgrille_fibre;
$product_security_dgrille_fibre[18] = $quote->product18_security_dgrille_fibre;
$product_security_dgrille_fibre[19] = $quote->product19_security_dgrille_fibre;
$product_security_dgrille_fibre[20] = $quote->product20_security_dgrille_fibre;
$product_security_dgrille_fibre[21] = $quote->product21_security_dgrille_fibre;
$product_security_dgrille_fibre[22] = $quote->product22_security_dgrille_fibre;
$product_security_dgrille_fibre[23] = $quote->product23_security_dgrille_fibre;
$product_security_dgrille_fibre[24] = $quote->product24_security_dgrille_fibre;
$product_security_dgrille_fibre[25] = $quote->product25_security_dgrille_fibre;
$product_security_dgrille_fibre[26] = $quote->product26_security_dgrille_fibre;
$product_security_dgrille_fibre[27] = $quote->product27_security_dgrille_fibre;
$product_security_dgrille_fibre[28] = $quote->product28_security_dgrille_fibre;
$product_security_dgrille_fibre[29] = $quote->product29_security_dgrille_fibre;
$product_security_dgrille_fibre[30] = $quote->product30_security_dgrille_fibre;

$product_quantity_of_panels[1] = $quote->product1_quantity_of_panels;
$product_quantity_of_panels[2] = $quote->product2_quantity_of_panels;
$product_quantity_of_panels[3] = $quote->product3_quantity_of_panels;
$product_quantity_of_panels[4] = $quote->product4_quantity_of_panels;
$product_quantity_of_panels[5] = $quote->product5_quantity_of_panels;
$product_quantity_of_panels[6] = $quote->product6_quantity_of_panels;
$product_quantity_of_panels[7] = $quote->product7_quantity_of_panels;
$product_quantity_of_panels[8] = $quote->product8_quantity_of_panels;
$product_quantity_of_panels[9] = $quote->product9_quantity_of_panels;
$product_quantity_of_panels[10] = $quote->product10_quantity_of_panels;
$product_quantity_of_panels[11] = $quote->product11_quantity_of_panels;
$product_quantity_of_panels[12] = $quote->product12_quantity_of_panels;
$product_quantity_of_panels[13] = $quote->product13_quantity_of_panels;
$product_quantity_of_panels[14] = $quote->product14_quantity_of_panels;
$product_quantity_of_panels[15] = $quote->product15_quantity_of_panels;
$product_quantity_of_panels[16] = $quote->product16_quantity_of_panels;
$product_quantity_of_panels[17] = $quote->product17_quantity_of_panels;
$product_quantity_of_panels[18] = $quote->product18_quantity_of_panels;
$product_quantity_of_panels[19] = $quote->product19_quantity_of_panels;
$product_quantity_of_panels[20] = $quote->product20_quantity_of_panels;
$product_quantity_of_panels[21] = $quote->product21_quantity_of_panels;
$product_quantity_of_panels[22] = $quote->product22_quantity_of_panels;
$product_quantity_of_panels[23] = $quote->product23_quantity_of_panels;
$product_quantity_of_panels[24] = $quote->product24_quantity_of_panels;
$product_quantity_of_panels[25] = $quote->product25_quantity_of_panels;
$product_quantity_of_panels[26] = $quote->product26_quantity_of_panels;
$product_quantity_of_panels[27] = $quote->product27_quantity_of_panels;
$product_quantity_of_panels[28] = $quote->product28_quantity_of_panels;
$product_quantity_of_panels[29] = $quote->product29_quantity_of_panels;
$product_quantity_of_panels[30] = $quote->product30_quantity_of_panels;

$product_316_ss_gal_pet[1] = $quote->product1_316_ss_gal_pet;
$product_316_ss_gal_pet[2] = $quote->product2_316_ss_gal_pet;
$product_316_ss_gal_pet[3] = $quote->product3_316_ss_gal_pet;
$product_316_ss_gal_pet[4] = $quote->product4_316_ss_gal_pet;
$product_316_ss_gal_pet[5] = $quote->product5_316_ss_gal_pet;
$product_316_ss_gal_pet[6] = $quote->product6_316_ss_gal_pet;
$product_316_ss_gal_pet[7] = $quote->product7_316_ss_gal_pet;
$product_316_ss_gal_pet[8] = $quote->product8_316_ss_gal_pet;
$product_316_ss_gal_pet[9] = $quote->product9_316_ss_gal_pet;
$product_316_ss_gal_pet[10] = $quote->product10_316_ss_gal_pet;
$product_316_ss_gal_pet[11] = $quote->product11_316_ss_gal_pet;
$product_316_ss_gal_pet[12] = $quote->product12_316_ss_gal_pet;
$product_316_ss_gal_pet[13] = $quote->product13_316_ss_gal_pet;
$product_316_ss_gal_pet[14] = $quote->product14_316_ss_gal_pet;
$product_316_ss_gal_pet[15] = $quote->product15_316_ss_gal_pet;
$product_316_ss_gal_pet[16] = $quote->product16_316_ss_gal_pet;
$product_316_ss_gal_pet[17] = $quote->product17_316_ss_gal_pet;
$product_316_ss_gal_pet[18] = $quote->product18_316_ss_gal_pet;
$product_316_ss_gal_pet[19] = $quote->product19_316_ss_gal_pet;
$product_316_ss_gal_pet[20] = $quote->product20_316_ss_gal_pet;
$product_316_ss_gal_pet[21] = $quote->product21_316_ss_gal_pet;
$product_316_ss_gal_pet[22] = $quote->product22_316_ss_gal_pet;
$product_316_ss_gal_pet[23] = $quote->product23_316_ss_gal_pet;
$product_316_ss_gal_pet[24] = $quote->product24_316_ss_gal_pet;
$product_316_ss_gal_pet[25] = $quote->product25_316_ss_gal_pet;
$product_316_ss_gal_pet[26] = $quote->product26_316_ss_gal_pet;
$product_316_ss_gal_pet[27] = $quote->product27_316_ss_gal_pet;
$product_316_ss_gal_pet[28] = $quote->product28_316_ss_gal_pet;
$product_316_ss_gal_pet[29] = $quote->product29_316_ss_gal_pet;
$product_316_ss_gal_pet[30] = $quote->product30_316_ss_gal_pet;

$product_window_or_door[1] = $quote->product1_window_or_door;
$product_window_or_door[2] = $quote->product2_window_or_door;
$product_window_or_door[3] = $quote->product3_window_or_door;
$product_window_or_door[4] = $quote->product4_window_or_door;
$product_window_or_door[5] = $quote->product5_window_or_door;
$product_window_or_door[6] = $quote->product6_window_or_door;
$product_window_or_door[7] = $quote->product7_window_or_door;
$product_window_or_door[8] = $quote->product8_window_or_door;
$product_window_or_door[9] = $quote->product9_window_or_door;
$product_window_or_door[10] = $quote->product10_window_or_door;
$product_window_or_door[11] = $quote->product11_window_or_door;
$product_window_or_door[12] = $quote->product12_window_or_door;
$product_window_or_door[13] = $quote->product13_window_or_door;
$product_window_or_door[14] = $quote->product14_window_or_door;
$product_window_or_door[15] = $quote->product15_window_or_door;
$product_window_or_door[16] = $quote->product16_window_or_door;
$product_window_or_door[17] = $quote->product17_window_or_door;
$product_window_or_door[18] = $quote->product18_window_or_door;
$product_window_or_door[19] = $quote->product19_window_or_door;
$product_window_or_door[20] = $quote->product20_window_or_door;
$product_window_or_door[21] = $quote->product21_window_or_door;
$product_window_or_door[22] = $quote->product22_window_or_door;
$product_window_or_door[23] = $quote->product23_window_or_door;
$product_window_or_door[24] = $quote->product24_window_or_door;
$product_window_or_door[25] = $quote->product25_window_or_door;
$product_window_or_door[26] = $quote->product26_window_or_door;
$product_window_or_door[27] = $quote->product27_window_or_door;
$product_window_or_door[28] = $quote->product28_window_or_door;
$product_window_or_door[29] = $quote->product29_window_or_door;
$product_window_or_door[30] = $quote->product30_window_or_door;

$product_window_frame_type[1] = $quote->product1_window_frame_type;
$product_window_frame_type[2] = $quote->product2_window_frame_type;
$product_window_frame_type[3] = $quote->product3_window_frame_type;
$product_window_frame_type[4] = $quote->product4_window_frame_type;
$product_window_frame_type[5] = $quote->product5_window_frame_type;
$product_window_frame_type[6] = $quote->product6_window_frame_type;
$product_window_frame_type[7] = $quote->product7_window_frame_type;
$product_window_frame_type[8] = $quote->product8_window_frame_type;
$product_window_frame_type[9] = $quote->product9_window_frame_type;
$product_window_frame_type[10] = $quote->product10_window_frame_type;
$product_window_frame_type[11] = $quote->product11_window_frame_type;
$product_window_frame_type[12] = $quote->product12_window_frame_type;
$product_window_frame_type[13] = $quote->product13_window_frame_type;
$product_window_frame_type[14] = $quote->product14_window_frame_type;
$product_window_frame_type[15] = $quote->product15_window_frame_type;
$product_window_frame_type[16] = $quote->product16_window_frame_type;
$product_window_frame_type[17] = $quote->product17_window_frame_type;
$product_window_frame_type[18] = $quote->product18_window_frame_type;
$product_window_frame_type[19] = $quote->product19_window_frame_type;
$product_window_frame_type[20] = $quote->product20_window_frame_type;
$product_window_frame_type[21] = $quote->product21_window_frame_type;
$product_window_frame_type[22] = $quote->product22_window_frame_type;
$product_window_frame_type[23] = $quote->product23_window_frame_type;
$product_window_frame_type[24] = $quote->product24_window_frame_type;
$product_window_frame_type[25] = $quote->product25_window_frame_type;
$product_window_frame_type[26] = $quote->product26_window_frame_type;
$product_window_frame_type[27] = $quote->product27_window_frame_type;
$product_window_frame_type[28] = $quote->product28_window_frame_type;
$product_window_frame_type[29] = $quote->product29_window_frame_type;
$product_window_frame_type[30] = $quote->product30_window_frame_type;

$product_configuration[1] = $quote->product1_configuration;
$product_configuration[2] = $quote->product2_configuration;
$product_configuration[3] = $quote->product3_configuration;
$product_configuration[4] = $quote->product4_configuration;
$product_configuration[5] = $quote->product5_configuration;
$product_configuration[6] = $quote->product6_configuration;
$product_configuration[7] = $quote->product7_configuration;
$product_configuration[8] = $quote->product8_configuration;
$product_configuration[9] = $quote->product9_configuration;
$product_configuration[10] = $quote->product10_configuration;
$product_configuration[11] = $quote->product11_configuration;
$product_configuration[12] = $quote->product12_configuration;
$product_configuration[13] = $quote->product13_configuration;
$product_configuration[14] = $quote->product14_configuration;
$product_configuration[15] = $quote->product15_configuration;
$product_configuration[16] = $quote->product16_configuration;
$product_configuration[17] = $quote->product17_configuration;
$product_configuration[18] = $quote->product18_configuration;
$product_configuration[19] = $quote->product19_configuration;
$product_configuration[20] = $quote->product20_configuration;
$product_configuration[21] = $quote->product21_configuration;
$product_configuration[22] = $quote->product22_configuration;
$product_configuration[23] = $quote->product23_configuration;
$product_configuration[24] = $quote->product24_configuration;
$product_configuration[25] = $quote->product25_configuration;
$product_configuration[26] = $quote->product26_configuration;
$product_configuration[27] = $quote->product27_configuration;
$product_configuration[28] = $quote->product28_configuration;
$product_configuration[29] = $quote->product29_configuration;
$product_configuration[30] = $quote->product30_configuration;

$product_location_in_building[1] = $quote->product1_location_in_building;
$product_location_in_building[2] = $quote->product2_location_in_building;
$product_location_in_building[3] = $quote->product3_location_in_building;
$product_location_in_building[4] = $quote->product4_location_in_building;
$product_location_in_building[5] = $quote->product5_location_in_building;
$product_location_in_building[6] = $quote->product6_location_in_building;
$product_location_in_building[7] = $quote->product7_location_in_building;
$product_location_in_building[8] = $quote->product8_location_in_building;
$product_location_in_building[9] = $quote->product9_location_in_building;
$product_location_in_building[10] = $quote->product10_location_in_building;
$product_location_in_building[11] = $quote->product11_location_in_building;
$product_location_in_building[12] = $quote->product12_location_in_building;
$product_location_in_building[13] = $quote->product13_location_in_building;
$product_location_in_building[14] = $quote->product14_location_in_building;
$product_location_in_building[15] = $quote->product15_location_in_building;
$product_location_in_building[16] = $quote->product16_location_in_building;
$product_location_in_building[17] = $quote->product17_location_in_building;
$product_location_in_building[18] = $quote->product18_location_in_building;
$product_location_in_building[19] = $quote->product19_location_in_building;
$product_location_in_building[20] = $quote->product20_location_in_building;
$product_location_in_building[21] = $quote->product21_location_in_building;
$product_location_in_building[22] = $quote->product22_location_in_building;
$product_location_in_building[23] = $quote->product23_location_in_building;
$product_location_in_building[24] = $quote->product24_location_in_building;
$product_location_in_building[25] = $quote->product25_location_in_building;
$product_location_in_building[26] = $quote->product26_location_in_building;
$product_location_in_building[27] = $quote->product27_location_in_building;
$product_location_in_building[28] = $quote->product28_location_in_building;
$product_location_in_building[29] = $quote->product29_location_in_building;
$product_location_in_building[30] = $quote->product30_location_in_building;

$product_height[1] = $quote->product1_height;
$product_height[2] = $quote->product2_height;
$product_height[3] = $quote->product3_height;
$product_height[4] = $quote->product4_height;
$product_height[5] = $quote->product5_height;
$product_height[6] = $quote->product6_height;
$product_height[7] = $quote->product7_height;
$product_height[8] = $quote->product8_height;
$product_height[9] = $quote->product9_height;
$product_height[10] = $quote->product10_height;
$product_height[11] = $quote->product11_height;
$product_height[12] = $quote->product12_height;
$product_height[13] = $quote->product13_height;
$product_height[14] = $quote->product14_height;
$product_height[15] = $quote->product15_height;
$product_height[16] = $quote->product16_height;
$product_height[17] = $quote->product17_height;
$product_height[18] = $quote->product18_height;
$product_height[19] = $quote->product19_height;
$product_height[20] = $quote->product20_height;
$product_height[21] = $quote->product21_height;
$product_height[22] = $quote->product22_height;
$product_height[23] = $quote->product23_height;
$product_height[24] = $quote->product24_height;
$product_height[25] = $quote->product25_height;
$product_height[26] = $quote->product26_height;
$product_height[27] = $quote->product27_height;
$product_height[28] = $quote->product28_height;
$product_height[29] = $quote->product29_height;
$product_height[30] = $quote->product30_height;

$product_width[1] = $quote->product1_width;
$product_width[2] = $quote->product2_width;
$product_width[3] = $quote->product3_width;
$product_width[4] = $quote->product4_width;
$product_width[5] = $quote->product5_width;
$product_width[6] = $quote->product6_width;
$product_width[7] = $quote->product7_width;
$product_width[8] = $quote->product8_width;
$product_width[9] = $quote->product9_width;
$product_width[10] = $quote->product10_width;
$product_width[11] = $quote->product11_width;
$product_width[12] = $quote->product12_width;
$product_width[13] = $quote->product13_width;
$product_width[14] = $quote->product14_width;
$product_width[15] = $quote->product15_width;
$product_width[16] = $quote->product16_width;
$product_width[17] = $quote->product17_width;
$product_width[18] = $quote->product18_width;
$product_width[19] = $quote->product19_width;
$product_width[20] = $quote->product20_width;
$product_width[21] = $quote->product21_width;
$product_width[22] = $quote->product22_width;
$product_width[23] = $quote->product23_width;
$product_width[24] = $quote->product24_width;
$product_width[25] = $quote->product25_width;
$product_width[26] = $quote->product26_width;
$product_width[27] = $quote->product27_width;
$product_width[28] = $quote->product28_width;
$product_width[29] = $quote->product29_width;
$product_width[30] = $quote->product30_width;

$product_number_of_locks[1] = $quote->product1_number_of_locks;
$product_number_of_locks[2] = $quote->product2_number_of_locks;
$product_number_of_locks[3] = $quote->product3_number_of_locks;
$product_number_of_locks[4] = $quote->product4_number_of_locks;
$product_number_of_locks[5] = $quote->product5_number_of_locks;
$product_number_of_locks[6] = $quote->product6_number_of_locks;
$product_number_of_locks[7] = $quote->product7_number_of_locks;
$product_number_of_locks[8] = $quote->product8_number_of_locks;
$product_number_of_locks[9] = $quote->product9_number_of_locks;
$product_number_of_locks[10] = $quote->product10_number_of_locks;
$product_number_of_locks[11] = $quote->product11_number_of_locks;
$product_number_of_locks[12] = $quote->product12_number_of_locks;
$product_number_of_locks[13] = $quote->product13_number_of_locks;
$product_number_of_locks[14] = $quote->product14_number_of_locks;
$product_number_of_locks[15] = $quote->product15_number_of_locks;
$product_number_of_locks[16] = $quote->product16_number_of_locks;
$product_number_of_locks[17] = $quote->product17_number_of_locks;
$product_number_of_locks[18] = $quote->product18_number_of_locks;
$product_number_of_locks[19] = $quote->product19_number_of_locks;
$product_number_of_locks[20] = $quote->product20_number_of_locks;
$product_number_of_locks[21] = $quote->product21_number_of_locks;
$product_number_of_locks[22] = $quote->product22_number_of_locks;
$product_number_of_locks[23] = $quote->product23_number_of_locks;
$product_number_of_locks[24] = $quote->product24_number_of_locks;
$product_number_of_locks[25] = $quote->product25_number_of_locks;
$product_number_of_locks[26] = $quote->product26_number_of_locks;
$product_number_of_locks[27] = $quote->product27_number_of_locks;
$product_number_of_locks[28] = $quote->product28_number_of_locks;
$product_number_of_locks[29] = $quote->product29_number_of_locks;
$product_number_of_locks[30] = $quote->product30_number_of_locks;

$product_lock_type[1] = $quote->product1_lock_type;
$product_lock_type[2] = $quote->product2_lock_type;
$product_lock_type[3] = $quote->product3_lock_type;
$product_lock_type[4] = $quote->product4_lock_type;
$product_lock_type[5] = $quote->product5_lock_type;
$product_lock_type[6] = $quote->product6_lock_type;
$product_lock_type[7] = $quote->product7_lock_type;
$product_lock_type[8] = $quote->product8_lock_type;
$product_lock_type[9] = $quote->product9_lock_type;
$product_lock_type[10] = $quote->product10_lock_type;
$product_lock_type[11] = $quote->product11_lock_type;
$product_lock_type[12] = $quote->product12_lock_type;
$product_lock_type[13] = $quote->product13_lock_type;
$product_lock_type[14] = $quote->product14_lock_type;
$product_lock_type[15] = $quote->product15_lock_type;
$product_lock_type[16] = $quote->product16_lock_type;
$product_lock_type[17] = $quote->product17_lock_type;
$product_lock_type[18] = $quote->product18_lock_type;
$product_lock_type[19] = $quote->product19_lock_type;
$product_lock_type[20] = $quote->product20_lock_type;
$product_lock_type[21] = $quote->product21_lock_type;
$product_lock_type[22] = $quote->product22_lock_type;
$product_lock_type[23] = $quote->product23_lock_type;
$product_lock_type[24] = $quote->product24_lock_type;
$product_lock_type[25] = $quote->product25_lock_type;
$product_lock_type[26] = $quote->product26_lock_type;
$product_lock_type[27] = $quote->product27_lock_type;
$product_lock_type[28] = $quote->product28_lock_type;
$product_lock_type[29] = $quote->product29_lock_type;
$product_lock_type[30] = $quote->product30_lock_type;

$product_lock_handle_height[1] = $quote->product1_lock_handle_height;
$product_lock_handle_height[2] = $quote->product2_lock_handle_height;
$product_lock_handle_height[3] = $quote->product3_lock_handle_height;
$product_lock_handle_height[4] = $quote->product4_lock_handle_height;
$product_lock_handle_height[5] = $quote->product5_lock_handle_height;
$product_lock_handle_height[6] = $quote->product6_lock_handle_height;
$product_lock_handle_height[7] = $quote->product7_lock_handle_height;
$product_lock_handle_height[8] = $quote->product8_lock_handle_height;
$product_lock_handle_height[9] = $quote->product9_lock_handle_height;
$product_lock_handle_height[10] = $quote->product10_lock_handle_height;
$product_lock_handle_height[11] = $quote->product11_lock_handle_height;
$product_lock_handle_height[12] = $quote->product12_lock_handle_height;
$product_lock_handle_height[13] = $quote->product13_lock_handle_height;
$product_lock_handle_height[14] = $quote->product14_lock_handle_height;
$product_lock_handle_height[15] = $quote->product15_lock_handle_height;
$product_lock_handle_height[16] = $quote->product16_lock_handle_height;
$product_lock_handle_height[17] = $quote->product17_lock_handle_height;
$product_lock_handle_height[18] = $quote->product18_lock_handle_height;
$product_lock_handle_height[19] = $quote->product19_lock_handle_height;
$product_lock_handle_height[20] = $quote->product20_lock_handle_height;
$product_lock_handle_height[21] = $quote->product21_lock_handle_height;
$product_lock_handle_height[22] = $quote->product22_lock_handle_height;
$product_lock_handle_height[23] = $quote->product23_lock_handle_height;
$product_lock_handle_height[24] = $quote->product24_lock_handle_height;
$product_lock_handle_height[25] = $quote->product25_lock_handle_height;
$product_lock_handle_height[26] = $quote->product26_lock_handle_height;
$product_lock_handle_height[27] = $quote->product27_lock_handle_height;
$product_lock_handle_height[28] = $quote->product28_lock_handle_height;
$product_lock_handle_height[29] = $quote->product29_lock_handle_height;
$product_lock_handle_height[30] = $quote->product30_lock_handle_height;

$product_emergency_window[1] = $quote->product1_emergency_window;
$product_emergency_window[2] = $quote->product2_emergency_window;
$product_emergency_window[3] = $quote->product3_emergency_window;
$product_emergency_window[4] = $quote->product4_emergency_window;
$product_emergency_window[5] = $quote->product5_emergency_window;
$product_emergency_window[6] = $quote->product6_emergency_window;
$product_emergency_window[7] = $quote->product7_emergency_window;
$product_emergency_window[8] = $quote->product8_emergency_window;
$product_emergency_window[9] = $quote->product9_emergency_window;
$product_emergency_window[10] = $quote->product10_emergency_window;
$product_emergency_window[11] = $quote->product11_emergency_window;
$product_emergency_window[12] = $quote->product12_emergency_window;
$product_emergency_window[13] = $quote->product13_emergency_window;
$product_emergency_window[14] = $quote->product14_emergency_window;
$product_emergency_window[15] = $quote->product15_emergency_window;
$product_emergency_window[16] = $quote->product16_emergency_window;
$product_emergency_window[17] = $quote->product17_emergency_window;
$product_emergency_window[18] = $quote->product18_emergency_window;
$product_emergency_window[19] = $quote->product19_emergency_window;
$product_emergency_window[20] = $quote->product20_emergency_window;
$product_emergency_window[21] = $quote->product21_emergency_window;
$product_emergency_window[22] = $quote->product22_emergency_window;
$product_emergency_window[23] = $quote->product23_emergency_window;
$product_emergency_window[24] = $quote->product24_emergency_window;
$product_emergency_window[25] = $quote->product25_emergency_window;
$product_emergency_window[26] = $quote->product26_emergency_window;
$product_emergency_window[27] = $quote->product27_emergency_window;
$product_emergency_window[28] = $quote->product28_emergency_window;
$product_emergency_window[29] = $quote->product29_emergency_window;
$product_emergency_window[30] = $quote->product30_emergency_window;

$additional_item_number[1] = $quote->additional1_item_number;
$additional_item_number[2] = $quote->additional2_item_number;
$additional_item_number[3] = $quote->additional3_item_number;
$additional_item_number[4] = $quote->additional4_item_number;
$additional_item_number[5] = $quote->additional5_item_number;
$additional_item_number[6] = $quote->additional6_item_number;
$additional_item_number[7] = $quote->additional7_item_number;
$additional_item_number[8] = $quote->additional8_item_number;
$additional_item_number[9] = $quote->additional9_item_number;
$additional_item_number[10] = $quote->additional10_item_number;

$additional_per_meter[1] = $quote->additional1_per_meter;
$additional_per_meter[2] = $quote->additional2_per_meter;
$additional_per_meter[3] = $quote->additional3_per_meter;
$additional_per_meter[4] = $quote->additional4_per_meter;
$additional_per_meter[5] = $quote->additional5_per_meter;
$additional_per_meter[6] = $quote->additional6_per_meter;
$additional_per_meter[7] = $quote->additional7_per_meter;
$additional_per_meter[8] = $quote->additional8_per_meter;
$additional_per_meter[9] = $quote->additional9_per_meter;
$additional_per_meter[10] = $quote->additional10_per_meter;

$additional_name[1] = $quote->additional1_name;
$additional_name[2] = $quote->additional2_name;
$additional_name[3] = $quote->additional3_name;
$additional_name[4] = $quote->additional4_name;
$additional_name[5] = $quote->additional5_name;
$additional_name[6] = $quote->additional6_name;
$additional_name[7] = $quote->additional7_name;
$additional_name[8] = $quote->additional8_name;
$additional_name[9] = $quote->additional9_name;
$additional_name[10] = $quote->additional10_name;

$additional_l_item_number[1] = $quote->additional1_l_item_number;
$additional_l_item_number[2] = $quote->additional2_l_item_number;
$additional_l_item_number[3] = $quote->additional3_l_item_number;
$additional_l_item_number[4] = $quote->additional4_l_item_number;
$additional_l_item_number[5] = $quote->additional5_l_item_number;

$additional_l_per_length[1] = $quote->additional1_l_per_length;
$additional_l_per_length[2] = $quote->additional2_l_per_length;
$additional_l_per_length[3] = $quote->additional3_l_per_length;
$additional_l_per_length[4] = $quote->additional4_l_per_length;
$additional_l_per_length[5] = $quote->additional5_l_per_length;


$additional_l_name[1] = $quote->additional1_l_name;
$additional_l_name[2] = $quote->additional2_l_name;
$additional_l_name[3] = $quote->additional3_l_name;
$additional_l_name[4] = $quote->additional4_l_name;
$additional_l_name[5] = $quote->additional5_l_name;

$accessory_name[1] = $quote->accessory1_name;
$accessory_name[2] = $quote->accessory2_name;
$accessory_name[3] = $quote->accessory3_name;

$accessory_item_number[1] = $quote->accessory1_item_number;
$accessory_item_number[2] = $quote->accessory2_item_number;
$accessory_item_number[3] = $quote->accessory3_item_number;

$accessory_each[1] = $quote->accessory1_each;
$accessory_each[2] = $quote->accessory2_each;
$accessory_each[3] = $quote->accessory3_each;

$discount_re = $quote->discount_re;
$discount_wh = $quote->discount_wh;
$discount_d = $quote->discount_d;

$markup_d = $quote->markup_d;
$markup_wh = $quote->markup_wh;
$markup_d_ss = $quote->markup_d_ss;
$markup_wh_ss = $quote->markup_wh_ss;
$markup_d_dg = $quote->markup_d_dg;
$markup_wh_dg = $quote->markup_wh_dg;

$midrails_item_number = $quote->midrails_item_number;
$midrails_quantity = $quote->midrails_quantity;
$midrails_security_dgrille_fibre = $quote->midrails_security_dgrille_fibre;
$midrails_316_ssgal_pet = $quote->midrails_316_ssgal_pet;
$midrails_window_or_door = $quote->midrails_window_or_door;
$midrails_width = $quote->midrails_width;
$midrails_height = $quote->midrails_height;
$midrails_window_frame_type = $quote->midrails_window_frame_type;
$midrails_configuration = $quote->midrails_configuration;

$midrails2_item_number = $quote->midrails2_item_number;
$midrails2_quantity = $quote->midrails2_quantity;
$midrails2_security_dgrille_fibre = $quote->midrails2_security_dgrille_fibre;
$midrails2_316_ssgal_pet = $quote->midrails2_316_ssgal_pet;
$midrails2_window_or_door = $quote->midrails2_window_or_door;
$midrails2_width = $quote->midrails2_width;
$midrails2_height = $quote->midrails2_height;
$midrails2_window_frame_type = $quote->midrails2_window_frame_type;
$midrails2_configuration = $quote->midrails2_configuration;

$midrails3_item_number = $quote->midrails3_item_number;
$midrails3_quantity = $quote->midrails3_quantity;
$midrails3_security_dgrille_fibre = $quote->midrails3_security_dgrille_fibre;
$midrails3_316_ssgal_pet = $quote->midrails3_316_ssgal_pet;
$midrails3_window_or_door = $quote->midrails3_window_or_door;
$midrails3_width = $quote->midrails3_width;
$midrails3_height = $quote->midrails3_height;
$midrails3_window_frame_type = $quote->midrails3_window_frame_type;
$midrails3_configuration = $quote->midrails3_configuration;

$extra1_qty = $quote->extra1_qty;
$extra1_description = $quote->extra1_description;
$extra1_count = $quote->extra1_count;
$extra1_price = $quote->extra1_price;
$extra1_markup = $quote->extra1_markup;


$extra2_qty = $quote->extra2_qty;
$extra2_description = $quote->extra2_description;
$extra2_count = $quote->extra2_count;
$extra2_price = $quote->extra2_price;
$extra2_markup = $quote->extra2_markup;

$extra3_qty = $quote->extra3_qty;
$extra3_description = $quote->extra3_description;
$extra3_count = $quote->extra3_count;
$extra3_price = $quote->extra3_price;
$extra3_markup = $quote->extra3_markup;


$extra4_qty = $quote->extra4_qty;
$extra4_description = $quote->extra4_description;
$extra4_count = $quote->extra4_count;
$extra4_price = $quote->extra4_price;
$extra4_markup = $quote->extra4_markup;

$extra5_qty = $quote->extra5_qty;
$extra5_description = $quote->extra5_description;
$extra5_count = $quote->extra5_count;
$extra5_price = $quote->extra5_price;
$extra5_markup = $quote->extra5_markup;

$extra6_qty = $quote->extra6_qty;
$extra6_description = $quote->extra6_description;
$extra6_count = $quote->extra6_count;
$extra6_price = $quote->extra6_price;
$extra6_markup = $quote->extra6_markup;

$extra7_qty = $quote->extra7_qty;
$extra7_description = $quote->extra7_description;
$extra7_count = $quote->extra7_count;
$extra7_price = $quote->extra7_price;
$extra7_markup = $quote->extra7_markup;

$extra8_qty = $quote->extra8_qty;
$extra8_description = $quote->extra8_description;
$extra8_count = $quote->extra8_count;
$extra8_price = $quote->extra8_price;
$extra8_markup = $quote->extra8_markup;

$extra9_qty = $quote->extra9_qty;
$extra9_description = $quote->extra9_description;
$extra9_count = $quote->extra9_count;
$extra9_price = $quote->extra9_price;
$extra9_markup = $quote->extra9_markup;

$extra10_qty = $quote->extra10_qty;
$extra10_description = $quote->extra10_description;
$extra10_count = $quote->extra10_count;
$extra10_price = $quote->extra10_price;
$extra10_markup = $quote->extra10_markup;

$check_override_final_d = $quote->check_override_final_d;
$check_override_final_wh = $quote->check_override_final_wh;
$check_override_final_re = $quote->check_override_final_re;
$override_final_d = $quote->override_final_d;
$override_final_wh = $quote->override_final_wh;
$override_final_re = $quote->override_final_re;

$installation_cost_include_on_check_measure = $quote->installation_cost_include_on_check_measure;

  		$j=31;
		for($i = 1; $i<$j; $i++){ ?>
  		<tr class="product" id="product<?php echo $i; ?>" <?php if( $product_quantity_of_panels[$i] == '0'){echo 'style="display:none;"';} ?>>
  			<td><input class="product-item-number" id="product<?php echo $i; ?>-item-number" name="product<?php echo $i; ?>-item-number" style="width:30px;" value="<?php echo $product_item_number[$i]; ?>" /></td>
  			<td><select class="product-quantity-of-panels" id="product<?php echo $i; ?>-quantity-of-panels" name="product<?php echo $i; ?>-quantity-of-panels" style="width:40px;"><option></option><option value="1" <?php if( $product_quantity_of_panels[$i] == "1"){echo 'selected';} ?>>1</option><option value="2" <?php if( $product_quantity_of_panels[$i] == "2"){echo 'selected';} ?>>2</option><option value="3" <?php if( $product_quantity_of_panels[$i] == "3"){echo 'selected';} ?>>3</option><option value="4" <?php if( $product_quantity_of_panels[$i] == "4"){echo 'selected';} ?>>4</option><option value="5" <?php if( $product_quantity_of_panels[$i] == "5"){echo 'selected';} ?>>5</option><option value="6" <?php if( $product_quantity_of_panels[$i] == "6"){echo 'selected';} ?>>6</option><option value="7" <?php if( $product_quantity_of_panels[$i] == "7"){echo 'selected';} ?>>7</option><option value="8" <?php if( $product_quantity_of_panels[$i] == "8"){echo 'selected';} ?>>8</option><option value="9" <?php if( $product_quantity_of_panels[$i] == "9"){echo 'selected';} ?>>9</option><option value="10" <?php if( $product_quantity_of_panels[$i] == "10"){echo 'selected';} ?>>10</option><option <?php if( $product_quantity_of_panels[$i] == "11"){echo 'selected';} ?>>11</option><option <?php if( $product_quantity_of_panels[$i] == "12"){echo 'selected';} ?>>12</option><option <?php if( $product_quantity_of_panels[$i] == "13"){echo 'selected';} ?>>13</option><option <?php if( $product_quantity_of_panels[$i] == "14"){echo 'selected';} ?>>14</option><option <?php if( $product_quantity_of_panels[$i] == "15"){echo 'selected';} ?>>15</option></select></td>
  			<td><select class="product-security-dgrille-fibre" id="product<?php echo $i; ?>-security-dgrille-fibre" name="product<?php echo $i; ?>-security-dgrille-fibre"><option></option><option value="security" <?php if( $product_security_dgrille_fibre[$i] == "security"){echo 'selected';} ?>>Security</option><option value="dgrille" <?php if( $product_security_dgrille_fibre[$i] == "dgrille"){echo 'selected';} ?>>D/Grille</option><option value="fibre" <?php if( $product_security_dgrille_fibre[$i] == "fibre"){echo 'selected';} ?>>Fibre</option></select></td>
  			<td><select class="product-316-ss-gal-pet" id="product<?php echo $i; ?>-316-ss-gal-pet" name="product<?php echo $i; ?>-316-ss-gal-pet"><option></option><option <?php if( $product_316_ss_gal_pet[$i] == "316 S/S"){echo 'selected';} ?>>316 S/S</option><option <?php if( $product_316_ss_gal_pet[$i] == "Insect"){echo 'selected';} ?>>Insect</option><option <?php if( $product_316_ss_gal_pet[$i] == "Pet"){echo 'selected';} ?>>Pet</option></select></td>
  			<td><select class="product-window-or-door" id="product<?php echo $i; ?>-window-or-door" name="product<?php echo $i; ?>-window-or-door"><option></option><option value="window" <?php if( $product_window_or_door[$i] == "window"){echo 'selected';} ?>>Window</option><option value="door" <?php if( $product_window_or_door[$i] == "door"){echo 'selected';} ?>>Door</option></select></td>
  			<td><select class="product-window-frame-type" id="product<?php echo $i; ?>-window-frame-type" name="product<?php echo $i; ?>-window-frame-type"><option></option><option value="9mm" <?php if( $product_window_frame_type[$i] == "9mm"){echo 'selected';} ?>>9mm</option><option value="11mm" <?php if( $product_window_frame_type[$i] == "11mm"){echo 'selected';} ?>>11mm</option></select></td>
			<td><select class="product-configuration" id="product<?php echo $i; ?>-configuration" name="product<?php echo $i; ?>-configuration"><option></option><?php 
			$configurations = $db->get_results("SELECT name FROM wp_dropdowns WHERE type = 'Door Configuration' ORDER BY manual_sort,id");
			foreach ($configurations as $configuration) {
    				if( $product_configuration[$i] == $configuration->name ){
    				echo '<option selected>'.$configuration->name.'</option>';}
				else{ echo '<option>'.$configuration->name.'</option>';}
			}
			?></select></td>
  			<td><input class="product-location-in-building" style="width:100px; padding:1px 5px;" value="<?php echo $product_location_in_building[$i]; ?>" id="product<?php echo $i; ?>-location-in-building" name="product<?php echo $i; ?>-location-in-building" /></td>
  			<td><input class="product-height" style="width:40px; padding:1px 5px;" value="<?php echo $product_height[$i]; ?>" id="product<?php echo $i; ?>-height" name="product<?php echo $i; ?>-height" /></td>
  			<td><input class="widthupdate product-width" style="width:40px; padding:1px 5px;" value="<?php echo $product_width[$i]; ?>" id="product<?php echo $i; ?>-width" name="product<?php echo $i; ?>-width" /></td>
  			<td><select class="product-number-of-locks" style="width:40px;" id="product<?php echo $i; ?>-number-of-locks" name="product<?php echo $i; ?>-number-of-locks"><option></option><option value="-" <?php if( $product_number_of_locks[$i] == "-"){echo 'selected';} ?>>-</option><option value="1" <?php if( $product_number_of_locks[$i] == "1"){echo 'selected';} ?>>1</option><option value="2" <?php if( $product_number_of_locks[$i] == "2"){echo 'selected';} ?>>2</option><option value="3" <?php if( $product_number_of_locks[$i] == "3"){echo 'selected';} ?>>3</option><option value="4" <?php if( $product_number_of_locks[$i] == "4"){echo 'selected';} ?>>4</option><option value="5" <?php if( $product_number_of_locks[$i] == "5"){echo 'selected';} ?>>5</option><option value="6" <?php if( $product_number_of_locks[$i] == "6"){echo 'selected';} ?>>6</option><option value="7" <?php if( $product_number_of_locks[$i] == "7"){echo 'selected';} ?>>7</option><option value="8" <?php if( $product_number_of_locks[$i] == "8"){echo 'selected';} ?>>8</option><option value="9" <?php if( $product_number_of_locks[$i] == "9"){echo 'selected';} ?>>9</option><option value="10" <?php if( $product_number_of_locks[$i] == "10"){echo 'selected';} ?>>10</option></select></td>
  			<td><select class="product-lock-type" id="product<?php echo $i; ?>-lock-type" name="product<?php echo $i; ?>-lock-type"><option></option><option value="-" <?php if( $product_lock_type[$i] == "-"){echo 'selected';} ?>>-</option><option value="Single" <?php if( $product_lock_type[$i] == "Single"){echo 'selected';} ?>>Single</option><option value="Trple Hngd" <?php if( $product_lock_type[$i] == "Trple Hngd"){echo 'selected';} ?>>Trple Hngd</option><option value="Trple Sldng" <?php if( $product_lock_type[$i] == "Trple Sldng"){echo 'selected';} ?>>Trple Sldng</option></select></td>
  			<td style="width:40px;"><input class="product-lock-handle-height" style="width:40px; padding:1px 5px;" value="<?php echo $product_lock_handle_height[$i]; ?>" id="product<?php echo $i; ?>-lock-handle-height" name="product<?php echo $i; ?>-lock-handle-height" /></td>
  			<td style="padding: 0 !important; width:20px;"><a class="delete" href="#">X</a></td>
  		</tr><?php if (($role=='manufacturer' && $mf_role == 'distributor') || $role=="distributor") {?>
  		<tr class="prices" id="prices<?php echo $i; ?>" <?php if( $product_quantity_of_panels[$i] == '0'){echo 'style="display:none;"';} ?>>
  			<td colspan="14">
			<div class="value-holder">Dist.:<span class="product-distributor-price-incl-gst" id="product<?php echo $i; ?>-distributor-price-incl-gst"></span><input class="product-input-distributor-price-incl-gst" id="product<?php echo $i; ?>-distributor-price-incl-gst" name ="product<?php echo $i; ?>-distributor-price-incl-gst" style="display:none; width:50px;" /></div>
			<div class="value-holder">Sell:<span id="product<?php echo $i; ?>-distributor-sell-price" class="product-distributor-sell-price"></span></div>
			<div class="value-holder">Profit:<span id="product<?php echo $i; ?>-distributor-profit" class="product-distributor-profit"></span></div>
  			<div class="value-holder ee-holder"><span class="ee">Emergency Exit Window <input type="checkbox" id="product<?php echo $i; ?>-emergency-window" name="product<?php echo $i; ?>-emergency-window" class="product-emergency-window" value="1" <?php if($product_emergency_window[$i] == '1'){echo 'checked';} ?> /></span></div>
  			</td></tr><?php } if (($role=='manufacturer' && $mf_role == 'wholesaler') || $role=="wholesaler") {?> 		
  		<tr class="prices" id="prices<?php echo $i; ?>" <?php if( $product_quantity_of_panels[$i] == '0'){echo 'style="display:none;"';} ?>>
			<td colspan="14">
			<div class="value-holder">Whsle.:<span id="product<?php echo $i; ?>-wholesaler-price-incl-gst" class="product-wholesaler-price-incl-gst"> </span><input class="product-input-wholesaler-price-incl-gst" id="product<?php echo $i; ?>-wholesaler-price-incl-gst" name="product<?php echo $i; ?>-wholesaler-price-incl-gst" value="" style="display:none; width:50px;"/></div>
			<div class="value-holder">Sell:<span id="product<?php echo $i; ?>-wholesaler-sell-price" class="product-wholesaler-sell-price"></span></div>
			<div class="value-holder">Profit:<span id="product<?php echo $i; ?>-wholesaler-profit" class="product-wholesaler-profit"></span></div>
  			<div class="value-holder ee-holder"><span class="ee">Emergency Exit Window <input type="checkbox" id="product<?php echo $i; ?>-emergency-window" name="product<?php echo $i; ?>-emergency-window" class="product-emergency-window" value="1" <?php if($product_emergency_window[$i] == '1'){echo 'checked';} ?> /></span></div>
  			</td></tr><?php } if (($role=='manufacturer' && $mf_role == 'retailer') || $role=="retailer") {?>
  		<tr class="prices" id="prices<?php echo $i; ?>" <?php if( $product_quantity_of_panels[$i] == '0'){echo 'style="display:none;"';} ?>>
			<td colspan="14">
			<div class="value-holder">Price:<span class="product-retail-price-incl-gst" id="product<?php echo $i; ?>-retail-price-incl-gst"></span><input class="product-input-retail-price-incl-gst" id="product<?php echo $i; ?>-retail-price-incl-gst" name="product<?php echo $i; ?>-retail-price-incl-gst" value="" style="display:none; width:50px;" /></div>
			<div class="value-holder">Sell:<span id="product<?php echo $i; ?>-retail-sell-price" class="product-retail-sell-price"></span></div>
			<div class="value-holder">Profit:<span id="product<?php echo $i; ?>-retail-profit" class="product-retail-profit"></span></div>
  			<div class="value-holder ee-holder"><span class="ee">Emergency Exit Window <input type="checkbox" id="product<?php echo $i; ?>-emergency-window" name="product<?php echo $i; ?>-emergency-window" class="product-emergency-window" value="1" <?php if($product_emergency_window[$i] == '1'){echo 'checked';} ?> /></span></div>
  			</td></tr><?php } ?>  		
  		<tr class="addproduct" id="add<?php echo $i+1; ?>" <?php if( $product_quantity_of_panels[$i+1] == '0' && $flag_show != 1){echo 'style="display:table-row;"'; $flag_show='1';} ?>>
  			<td colspan="14"><?php if ( $i+1 != $j){ ?><span class="addspan" id="addspan<?php echo $i+1; ?>">Add next item</span>
				<span class="copyspan" id="copyspan<?php echo $i+1; ?>">Copy above line</span><?php } ?>
			</td>
  		</tr>
  		<?php } ?>
		<tr>
  			<th>No.</th>
  			<th>QTY</th>
  			<th>Security D/Grille Fibre</th>
  			<th>316 SS-Gal- Pet</th>
  			<th>Window or Door</th>
  			<th>Window Frame Type</th>
  			<th>Configuration</th>
  			<th>Height mm</th>
  			<th>Width mm</th>
			<td colspan="5" style="position:relative !important;"><div class="gradient-midrails-title"></div></td>
  		</tr>
	<tr class="mr" id="mr1">
  			<td><input id="mr-item-number" name="mr-item-number" style="width:30px;" value="<?php foreach ($quotes as $quote) {echo $midrails_item_number;} ?>" /></td>
  			<td><input id="mr-quantity-of-panels" name="mr-quantity-of-panels" style="width:30px; padding:1px 5px;" value="<?php foreach ($quotes as $quote) {echo $midrails_quantity;} ?>" /></td>
  			<td>
  				<select id="mr-security-dgrille-fibre" name="mr-security-dgrille-fibre">
					<option></option>
  					<option value="security" <?php if( $midrails_security_dgrille_fibre == "security"){echo 'selected';} ?>>Security</option>
  					<option value="dgrille" <?php if( $midrails_security_dgrille_fibre == "dgrille"){echo 'selected';} ?>>D/Grille</option>
  					<option value="fibre" <?php if( $midrails_security_dgrille_fibre == "fibre"){echo 'selected';} ?>>Fibre</option>
  				</select>
  			</td>
  			<td>
  				<select id="mr-316-ss-gal-pet" name="mr-316-ss-gal-pet">
				<option></option>
    				<option <?php if( $midrails_316_ssgal_pet == "316 S/S"){echo 'selected';} ?>>316 S/S</option>
    				<option <?php if( $midrails_316_ssgal_pet == "Insect"){echo 'selected';} ?>>Insect</option>
    				<option <?php if( $midrails_316_ssgal_pet == "Pet"){echo 'selected';} ?>>Pet</option>
    			</select>
  			</td>
  			<td>
  				<select id="mr-window-or-door" name="mr-window-or-door">
					<option></option>
  					<option value="window" <?php if( $midrails_window_or_door == "window"){echo 'selected';} ?>>Window</option>
  					<option value="door" <?php if( $midrails_window_or_door == "door"){echo 'selected';} ?>>Door</option>
  				</select>
  			</td>
			<td><input style="width:40px; padding:1px 5px;" id="mr-window-frame-type" name="mr-window-frame-type" value="<?php foreach ($quotes as $quote) {echo $midrails_window_frame_type;} ?>" /></td>
			<td><input  id="mr-configuration" name="mr-configuration" value="<?php foreach ($quotes as $quote) {echo $midrails_configuration;} ?>" style="width:150px;" /></td>
			<td><input style="width:40px; padding:1px 5px;" value="<?php foreach ($quotes as $quote) {echo $midrails_height;} ?>" id="mr-height" name="mr-height" /></td>
  			<td><input style="width:40px; padding:1px 5px;" value="<?php foreach ($quotes as $quote) {echo $midrails_width;} ?>" id="mr-width" name="mr-width" class="widthupdate" /></td>
			<td colspan="5"></td>
  		</tr>
<?php if (($role=='manufacturer' && $mf_role == 'distributor') || $role=="distributor") {?>
  		<tr class="prices-mr" id="prices-mr">
  			<td colspan="14">Dist.:<span id="mr-distributor-price-incl-gst"></span><input id="mr-distributor-price-incl-gst" name ="mr-distributor-price-incl-gst"  style="display:none; width:50px;" /></td>
  		</tr>
<?php } if (($role=='manufacturer' && $mf_role == 'wholesaler') || $role=="wholesaler") {?>
  		<tr class="prices-mr" id="prices-mr">
			<td colspan="14">Whsle.:<span id="mr-wholesaler-price-incl-gst"> </span><input id="mr-wholesaler-price-incl-gst" name ="mr-wholesaler-price-incl-gst"  style="display:none; width:50px;" /></td>
  		</tr>
<?php } if (($role=='manufacturer' && $mf_role == 'retailer') || $role=="retailer") {?>
  		<tr class="prices" id="prices-mr">
			<td colspan="14">Price:<span id="mr-retail-price-incl-gst"></span><input id="mr-retail-price-incl-gst" name ="mr-retail-price-incl-gst"  style="display:none; width:50px;" /></td>  			
  		</tr>
<?php } ?>
<tr class="addmidrails" id="addmr2" <?php if($midrails2_quantity=='0'){echo 'style="display:table-row;"';} ?>>
  			<td colspan="14">
				<span class="addspan" id="addspanmr2">Next Midrail</span>
			</td>
  		</tr>
<tr class="mr" id="mr2" <?php if($midrails2_quantity=='0'){echo 'style="display:none;"';} ?>>
  			<td><input id="mr2-item-number" name="mr2-item-number" style="width:30px;" value="<?php foreach ($quotes as $quote) {echo $midrails2_item_number;} ?>" /></td>
  			<td><input id="mr2-quantity-of-panels" name="mr2-quantity-of-panels" style="width:30px; padding:1px 5px;" value="<?php foreach ($quotes as $quote) {echo $midrails2_quantity;} ?>" /></td>
  			<td>
  				<select id="mr2-security-dgrille-fibre" name="mr2-security-dgrille-fibre">
					<option></option>
  					<option value="security" <?php if( $midrails2_security_dgrille_fibre == "security"){echo 'selected';} ?>>Security</option>
  					<option value="dgrille" <?php if( $midrails2_security_dgrille_fibre == "dgrille"){echo 'selected';} ?>>D/Grille</option>
  					<option value="fibre" <?php if( $midrails2_security_dgrille_fibre == "fibre"){echo 'selected';} ?>>Fibre</option>
  				</select>
  			</td>
  			<td>
  				<select id="mr2-316-ss-gal-pet" name="mr2-316-ss-gal-pet">
				<option></option>
    				<option <?php if( $midrails2_316_ssgal_pet == "316 S/S"){echo 'selected';} ?>>316 S/S</option>
    				<option <?php if( $midrails2_316_ssgal_pet == "Insect"){echo 'selected';} ?>>Insect</option>
    				<option <?php if( $midrails2_316_ssgal_pet == "Pet"){echo 'selected';} ?>>Pet</option>
    			</select>
  			</td>
  			<td>
  				<select id="mr2-window-or-door" name="mr2-window-or-door">
					<option></option>
  					<option value="window" <?php if( $midrails2_window_or_door == "window"){echo 'selected';} ?>>Window</option>
  					<option value="door" <?php if( $midrails2_window_or_door == "door"){echo 'selected';} ?>>Door</option>
  				</select>
  			</td>
<td>
				<input style="width:40px; padding:1px 5px;" id="mr2-window-frame-type" name="mr2-window-frame-type" value="<?php foreach ($quotes as $quote) {echo $midrails2_window_frame_type;} ?>" />
			</td>
			<td>
				<input id="mr2-configuration" name="mr2-configuration" value="<?php foreach ($quotes as $quote) {echo $midrails2_configuration;} ?>" style="width:150px;" />
			</td>
			<td><input style="width:40px; padding:1px 5px;" value="<?php foreach ($quotes as $quote) {echo $midrails2_height;} ?>" id="mr2-height" name="mr2-height" /></td>
  			<td><input style="width:40px; padding:1px 5px;" value="<?php foreach ($quotes as $quote) {echo $midrails2_width;} ?>" id="mr2-width" name="mr2-width" class="widthupdate" /></td>
			<td colspan="5">
			</td>
  		</tr>
<?php if (($role=='manufacturer' && $mf_role == 'distributor') || $role=="distributor") {?>
  		<tr class="prices-mr" id="prices-mr2" <?php if($midrails2_quantity=='0'){echo 'style="display:none;"';} ?>>
  			<td colspan="14">Dist.: <span id="mr2-distributor-price-incl-gst"></span><input id="mr2-distributor-price-incl-gst" name ="mr2-distributor-price-incl-gst"  style="display:none; width:50px;" /></td>
  		</tr>
<?php } if (($role=='manufacturer' && $mf_role == 'wholesaler') || $role=="wholesaler") {?>
  		<tr class="prices-mr" id="prices-mr2" <?php if($midrails2_quantity=='0'){echo 'style="display:none;"';} ?>>
			<td colspan="14">Whsle.:<span id="mr2-wholesaler-price-incl-gst"> </span><input id="mr2-wholesaler-price-incl-gst" name ="mr2-wholesaler-price-incl-gst"  style="display:none; width:50px;" /></td>
  		</tr>
<?php } if (($role=='manufacturer' && $mf_role == 'retailer') || $role=="retailer") {?>
  		<tr class="prices-mr" id="prices-mr2" <?php if($midrails2_quantity=='0'){echo 'style="display:none;"';} ?>>
			<td colspan="14">Price:<span id="mr2-retail-price-incl-gst"></span><input id="mr2-retail-price-incl-gst" name ="mr2-retail-price-incl-gst"  style="display:none; width:50px;" /></td>  			
  		</tr>
<?php } ?> 

<tr class="addmidrails" id="addmr3" <?php if($midrails2_quantity=='0'){echo 'style="display:none;"';} ?>>
  			<td colspan="14">
				<span class="addspan" id="addspanmr3">Next Midrail</span>
				<span class="removespan" id="removespanmr3">X</span></td>
  		</tr>
<tr class="mr" id="mr3" <?php if($midrails3_quantity=='0'){echo 'style="display:none;"';} ?>>
  			<td><input id="mr3-item-number" name="mr3-item-number" style="width:30px;" value="<?php foreach ($quotes as $quote) {echo $midrails3_item_number;} ?>" /></td>
  			<td><input id="mr3-quantity-of-panels" name="mr3-quantity-of-panels" style="width:30px; padding:1px 5px;" value="<?php foreach ($quotes as $quote) {echo $midrails3_quantity;} ?>" /></td>
  			<td>
  				<select id="mr3-security-dgrille-fibre" name="mr3-security-dgrille-fibre">
					<option></option>
  					<option value="security" <?php if( $midrails3_security_dgrille_fibre == "security"){echo 'selected';} ?>>Security</option>
  					<option value="dgrille" <?php if( $midrails3_security_dgrille_fibre == "dgrille"){echo 'selected';} ?>>D/Grille</option>
  					<option value="fibre" <?php if( $midrails3_security_dgrille_fibre == "fibre"){echo 'selected';} ?>>Fibre</option>
  				</select>
  			</td>
  			<td>
  				<select id="mr3-316-ss-gal-pet" name="mr3-316-ss-gal-pet">
				<option></option>
    				<option <?php if( $midrails3_316_ssgal_pet == "316 S/S"){echo 'selected';} ?>>316 S/S</option>
    				<option <?php if( $midrails3_316_ssgal_pet == "Insect"){echo 'selected';} ?>>Insect</option>
    				<option <?php if( $midrails3_316_ssgal_pet == "Pet"){echo 'selected';} ?>>Pet</option>
    			</select>
  			</td>
  			<td>
  				<select id="mr3-window-or-door" name="mr3-window-or-door">
					<option></option>
  					<option value="window" <?php if( $midrails3_window_or_door == "window"){echo 'selected';} ?>>Window</option>
  					<option value="door" <?php if( $midrails3_window_or_door == "door"){echo 'selected';} ?>>Door</option>
  				</select>
  			</td>
			<td>
				<input style="width:40px; padding:1px 5px;" id="mr3-window-frame-type" name="mr3-window-frame-type" value="<?php foreach ($quotes as $quote) {echo $midrails3_window_frame_type;} ?>" />
			</td>
			<td>
				<input id="mr3-configuration" name="mr3-configuration" value="<?php foreach ($quotes as $quote) {echo $midrails3_configuration;} ?>" style="width:150px;" />
			</td>
			<td><input style="width:40px; padding:1px 5px;" value="<?php foreach ($quotes as $quote) {echo $midrails3_height;} ?>" id="mr3-height" name="mr3-height" /></td>
  			<td><input style="width:40px; padding:1px 5px;" value="<?php foreach ($quotes as $quote) {echo $midrails3_width;} ?>" id="mr3-width" name="mr3-width" class="widthupdate" /></td>
			<td colspan="5">
			</td>
  		</tr>
<?php if (($role=='manufacturer' && $mf_role == 'distributor') || $role=="distributor") {?>
  		<tr class="prices-mr" id="prices-mr3" <?php if($midrails3_quantity=='0'){echo 'style="display:none;"';} ?>>
  			<td colspan="14">Dist.: <span id="mr3-distributor-price-incl-gst"></span><input id="mr3-distributor-price-incl-gst" name ="mr3-distributor-price-incl-gst"  style="display:none; width:50px;" /></td>
  		</tr>
<?php } if (($role=='manufacturer' && $mf_role == 'wholesaler') || $role=="wholesaler") {?>
		
  		<tr class="prices-mr" id="prices-mr3" <?php if($midrails3_quantity=='0'){echo 'style="display:none;"';} ?>>
			<td colspan="14">Whsle.:<span id="mr3-wholesaler-price-incl-gst"> </span><input id="mr3-wholesaler-price-incl-gst" name ="mr3-wholesaler-price-incl-gst"  style="display:none; width:50px;" /></td>
  		</tr>
<?php } if (($role=='manufacturer' && $mf_role == 'retailer') || $role=="retailer") {?>
  		<tr class="prices-mr" id="prices-mr3" <?php if($midrails3_quantity=='0'){echo 'style="display:none;"';} ?>>
			<td colspan="14">Price:<span id="mr3-retail-price-incl-gst"></span><input id="mr3-retail-price-incl-gst" name ="mr3-retail-price-incl-gst"  style="display:none; width:50px;" /></td>  			
  		</tr>
<?php } ?> 

<tr class="addmidrails" id="addmr4" <?php if($midrails3_quantity=='0'){echo 'style="display:none;"';} ?>>
  			<td colspan="14">				
				<span class="removespan" id="removespanmr4">X</span></td>
  		</tr>
</table>

</div>
<h3 id="ui-accordion-accordion-header-4">Additional Sections/Accessories and Installation </h3>
<div>

<table class="quote orange" style="width:45%; float:left; margin-right:40px;">
  		<tr>
  			<th>Item No.</th>
			<th>Per Meter</th>
  			<th>Additional Section</th>
  			<th>Price</th>  			
  		</tr>

<?php
  		$k=11;
		for($i = 1; $i<$k; $i++){ ?>
  		<tr <?php if ($eshown==1){ echo 'style="display:none;"'; $eflag=0; $eshown=1; }?> class="additional" id="additional<?php echo $i; ?>" name="additional<?php echo $i; ?>">
  			<td><input id="additional<?php echo $i; ?>-item-number" name="additional<?php echo $i; ?>-item-number" style="width:30px;" value="<?php echo $additional_item_number[$i]; ?>" /></td>
  			<td><input id="additional<?php echo $i; ?>-per-meter" name="additional<?php echo $i; ?>-per-meter" class="additional-per-meter" style="width:30px; padding:1px 5px;" value="<?php echo $additional_per_meter[$i]; ?>" /></td>

<?php if($additional_per_meter[$i+1]=='0' || $additional_per_meter[$i+1]=='' ){$eflag=1;} ?>
  			<td>
  				<select class="additional-name" id="additional<?php echo $i; ?>-name" name="additional<?php echo $i; ?>-name">
<option></option>
<?php 

$args = array( 'post_type' => 'parts', 'posts_per_page' => 1000 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();

if(get_post_meta($post->ID, 'wpcf-show-in-additional-dropdown', true) == '1' ){
if($additional_name[$i] == get_the_content()){
echo '<option selected>';	
the_content();
echo '</option>';
}

else{
echo '<option>';	
the_content();
echo '</option>';}	
}

endwhile;

			?>

  				</select>
  			</td>
  			<td><input class="additional-price" id="additional<?php echo $i; ?>-price" name="additional<?php echo $i; ?>-price" style="width:30px;" value="" /></td>
  		</tr>
		<?php if ($i>4){ ?>
		<tr class="addmeter" id="add-meter<?php echo $i+1; ?>" <?php if ($eflag==1 && $eshown!=1){ echo 'style="display:table-row;"'; $eflag=0; $eshown=1; }?>>
  			<td colspan="4">
				<?php if ($i!=10){ ?><span class="addspan" id="addspan<?php echo $i+1; ?>">Add next item</span><?php } ?>
				<?php if ($i!=5){ ?><span class="removespan" id="removespan<?php echo $i+1; ?>">X</span><?php } ?>
			</td>
  		</tr>
		<?php } ?>
		<?php } ?>


</table>







<table class="quote orange" style="width:45%; float:right;">
  		<tr>
  			<th>Item No.</th>
			<th>Per Full Length</th>
  			<th>Additional Section</th>
  			<th>Price</th>  			
  		</tr>

<?php
  		$k=6;
		for($i = 1; $i<$k; $i++){ ?>
  		<tr class="additional" id="additional<?php echo $i; ?>-l" name="additional<?php echo $i; ?>-l">
  			<td><input id="additional<?php echo $i; ?>-l-item-number" name="additional<?php echo $i; ?>-l-item-number" style="width:30px;" value="<?php echo $additional_l_item_number[$i]; ?>" /></td>
  			<td><input id="additional<?php echo $i; ?>-l-per-length" name="additional<?php echo $i; ?>-l-per-length" class="additional-per-meter" style="width:30px; padding:1px 5px;" value="<?php echo $additional_l_per_length[$i]; ?>" /></td>
  			<td>
  				<select class="additional-name" id="additional<?php echo $i; ?>-l-name" name="additional<?php echo $i; ?>-l-name">
<option></option>
<?php 

$args = array( 'post_type' => 'parts', 'posts_per_page' => 1000 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();

if(get_post_meta($post->ID, 'wpcf-show-in-additional-length-dropdown', true) == '1' ){
if($additional_l_name[$i] == get_the_content()){
echo '<option selected>';	
the_content();
echo '</option>';
}

else{
echo '<option>';	
the_content();
echo '</option>';}	
}

endwhile;

			?>

  				</select>
  			</td>
  			<td><input class="additional-price" id="additional<?php echo $i; ?>-l-price" name="additional<?php echo $i; ?>-l-price" style="width:30px;" value="" /></td>
  		</tr>
		<?php } ?>


</table>




<br clear="all" />





<table class="quote orange" style="width:45%; margin-top:20px; float:left;">
  		<tr>
  			<th>Item No.</th>
			<th>Each</th>
  			<th>Accessories</th>
  			<th>Price</th>  			
  		</tr>
<?php
  		$l=4;
		for($i = 1; $i<$l; $i++){ ?>
  		<tr class="accessory" id="accessory<?php echo $i; ?>" name="accessory<?php echo $i; ?>">
  			<td><input id="accessory<?php echo $i; ?>-item-number" name="accessory<?php echo $i; ?>-item-number" style="width:30px;" value="<?php echo $accessory_item_number[$i]; ?>" /></td>
  			<td>
				<select class="accessory-each" id="accessory<?php echo $i; ?>-each" name="accessory<?php echo $i; ?>-each" style="width:40px;">
					<option></option>
					<option value="1" <?php if( $accessory_each[$i] == "1"){echo 'selected';} ?>>1</option>
  					<option value="2" <?php if( $accessory_each[$i] == "2"){echo 'selected';} ?>>2</option>
					<option value="3" <?php if( $accessory_each[$i] == "3"){echo 'selected';} ?>>3</option>
					<option value="4" <?php if( $accessory_each[$i] == "4"){echo 'selected';} ?>>4</option>
					<option value="5" <?php if( $accessory_each[$i] == "5"){echo 'selected';} ?>>5</option>
					<option value="6" <?php if( $accessory_each[$i] == "6"){echo 'selected';} ?>>6</option>
  					<option value="7" <?php if( $accessory_each[$i] == "7"){echo 'selected';} ?>>7</option>
					<option value="8" <?php if( $accessory_each[$i] == "8"){echo 'selected';} ?>>8</option>
					<option value="9" <?php if( $accessory_each[$i] == "9"){echo 'selected';} ?>>9</option>
					<option value="10" <?php if( $accessory_each[$i] == "10"){echo 'selected';} ?>>10</option>
				</select>
			</td>
  			<td>
  				<select class="accessory-name" id="accessory<?php echo $i; ?>-name" name="accessory<?php echo $i; ?>-name">
					
<option></option>

<?php 
$args = array('order' => 'ASC', 'meta_key' => 'wpcf-order', 'orderby' => 'meta_value', 'post_type' => 'parts', 'posts_per_page' => 1000);
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
if(get_post_meta($post->ID, 'wpcf-show-in-accessories-dropdown', true) == '1' ){
if($accessory_name[$i] == get_the_content()){
echo '<option selected>';	
the_content();
echo '</option>';
}
else{
echo '<option>';	
the_content();
echo '</option>';}
}
endwhile;
?>
  				</select>
  			</td>
  			<td><input class="accessory-price" id="accessory<?php echo $i; ?>-price" name="accessory<?php echo $i; ?>-price" style="width:30px;" value="" /></td>
  		</tr>
		<?php } ?>


</table>

<table class="quote orange" style="width:45%; float:right; margin-top:20px;">
	
	<tr>
		<th>Qty</th>
		<th colspan="2">Add Custom Item<br />To be invoiced by the Manufacturer - Tick Box</th>
		<th>Cost</th>
		<th width="12%">Mark Up %</th>
		<th width="12%">Charged out at</th>
	</tr>
	<tr class="custom" id="custom1">
		<td><input id="extra1-qty" name="extra1-qty" style="width:20px;" value="<?php echo $extra1_qty; ?>" class="extra-qty" /></td>
		<td colspan="2"><input id="extra1-description" name="extra1-description" style="width:210px;" value="<?php echo $extra1_description; ?>" /><input name="extra1-count" id="extra1-count" type="checkbox" style="margin-left:10px;" value="yes" <?php if( $extra1_count == "yes"){echo 'checked';} ?> /></td>
		<td><input id="extra1-price" name="extra1-price" style="width:30px;" value="<?php echo $extra1_price; ?>" class="extra-price" /></td>
		<td><input name="extra1-markup" id="extra1-markup" style="width:30px;" value="<?php echo $extra1_markup; ?>" class="extra-markup" /></td>
		<td><input name="extra1-charged" id="extra1-charged" style="width:40px;" value="" class="extra-charged" disabled /></td>
	</tr>
	<tr class="custom" id="custom2">
		<td><input id="extra2-qty" name="extra2-qty" style="width:20px;" value="<?php echo $extra2_qty; ?>" class="extra-qty" /></td>
		<td colspan="2"><input id="extra2-description" name="extra2-description" style="width:210px;" value="<?php echo $extra2_description; ?>" /><input name="extra2-count" id="extra2-count" type="checkbox" style="margin-left:10px;" value="yes" <?php if( $extra2_count == "yes"){echo 'checked';} ?> /></td>
		<td><input id="extra2-price" name="extra2-price" style="width:30px;" value="<?php echo $extra2_price; ?>" class="extra-price" /></td>
		<td><input name="extra2-markup" id="extra2-markup" style="width:30px;" value="<?php echo $extra2_markup; ?>" class="extra-markup" /></td>
		<td><input name="extra2-charged" id="extra2-charged" style="width:40px;" value="" class="extra-charged" disabled /></td>
	</tr>
	<tr class="custom" id="custom3">
	<?php if($extra4_qty =='0' || $extra4_qty =='' ){$ecflag=1;} ?>
		<td><input id="extra3-qty" name="extra3-qty" style="width:20px;" value="<?php echo $extra3_qty; ?>" class="extra-qty" /></td>
		<td colspan="2"><input id="extra3-description" name="extra3-description" style="width:210px;" value="<?php echo $extra3_description; ?>" /><input name="extra3-count" id="extra3-count" type="checkbox" style="margin-left:10px;" value="yes" <?php if( $extra3_count == "yes"){echo 'checked';} ?> /></td>
		<td><input id="extra3-price" name="extra3-price" style="width:30px;" value="<?php echo $extra3_price; ?>" class="extra-price" /></td>
		<td><input name="extra3-markup" id="extra3-markup" style="width:30px;" value="<?php echo $extra3_markup; ?>" class="extra-markup" /></td>
		<td><input name="extra3-charged" id="extra3-charged" style="width:40px;" value="" class="extra-charged" disabled /></td>
	</tr>
	<tr class="addcustom" id="add-custom4" <?php if ($ecflag==1 && $ecshown!=1){ echo 'style="display:table-row;"'; $ecflag=0; $ecshown=1; }?>>
		<td colspan="6"><span class="addspan" id="addspan4">Add next item</span>
	</tr>
	<tr class="custom" id="custom4" <?php if ($ecshown==1){ echo 'style="display:none;"'; $ecflag=0; $ecshown=1; }?>>
	<?php if($extra5_qty =='0' || $extra5_qty =='' ){$ecflag=1;} ?>
		<td><input id="extra4-qty" name="extra4-qty" style="width:20px;" class="extra-qty" value="<?php echo $extra4_qty; ?>" /></td>
		<td colspan="2"><input id="extra4-description" name="extra4-description" style="width:210px;" value="<?php echo $extra4_description; ?>" /><input name="extra4-count" id="extra4-count" type="checkbox" style="margin-left:10px;" value="yes" <?php if( $extra4_count == "yes"){echo 'checked';} ?> /></td>
		<td><input id="extra4-price" name="extra4-price" style="width:30px;" class="extra-price" value="<?php echo $extra4_price; ?>" /></td>
		<td><input name="extra4-markup" id="extra4-markup" style="width:30px;" class="extra-markup" value="<?php echo $extra4_markup; ?>" /></td>
		<td><input name="extra4-charged" id="extra4-charged" style="width:40px;" class="extra-charged" disabled /></td>
	</tr>
	<tr class="addcustom" id="add-custom5" <?php if ($ecflag==1 && $ecshown!=1){ echo 'style="display:table-row;"'; $ecflag=0; $ecshown=1; }?>>
		<td colspan="6"><span class="addspan" id="addspan5">Add next item</span><span class="removespan" id="removespan5">X</span></td>
	</tr>
	<tr class="custom" id="custom5" <?php if ($ecshown==1){ echo 'style="display:none;"'; $ecflag=0; $ecshown=1; }?>>
	<?php if($extra6_qty =='0' || $extra6_qty =='' ){$ecflag=1;} ?>
		<td><input id="extra5-qty" name="extra5-qty" style="width:20px;" class="extra-qty" value="<?php echo $extra5_qty; ?>" /></td>
		<td colspan="2"><input id="extra5-description" name="extra5-description" style="width:210px;" value="<?php echo $extra5_description; ?>" /><input name="extra5-count" id="extra5-count" type="checkbox" style="margin-left:10px;" value="yes" <?php if( $extra5_count == "yes"){echo 'checked';} ?> /></td>
		<td><input id="extra5-price" name="extra5-price" style="width:30px;" class="extra-price" value="<?php echo $extra5_price; ?>" /></td>
		<td><input name="extra5-markup" id="extra5-markup" style="width:30px;" class="extra-markup" value="<?php echo $extra5_markup; ?>" /></td>
		<td><input name="extra5-charged" id="extra5-charged" style="width:40px;" class="extra-charged" disabled /></td>
	</tr>
	<tr class="addcustom" id="add-custom6" <?php if ($ecflag==1 && $ecshown!=1){ echo 'style="display:table-row;"'; $ecflag=0; $ecshown=1; }?>>
		<td colspan="6"><span class="addspan" id="addspan6">Add next item</span><span class="removespan" id="removespan6">X</span></td>
	</tr>
	<tr class="custom" id="custom6" <?php if ($ecshown==1){ echo 'style="display:none;"'; $ecflag=0; $ecshown=1; }?>>
	<?php if($extra7_qty =='0' || $extra7_qty =='' ){$ecflag=1;} ?>
		<td><input id="extra6-qty" name="extra6-qty" style="width:20px;" class="extra-qty" value="<?php echo $extra6_qty; ?>" /></td>
		<td colspan="2"><input id="extra6-description" name="extra6-description" style="width:210px;" value="<?php echo $extra6_description; ?>" /><input name="extra6-count" id="extra6-count" type="checkbox" style="margin-left:10px;" value="yes" <?php if( $extra6_count == "yes"){echo 'checked';} ?> /></td>
		<td><input id="extra6-price" name="extra6-price" style="width:30px;" class="extra-price" value="<?php echo $extra6_price; ?>" /></td>
		<td><input name="extra6-markup" id="extra6-markup" style="width:30px;" class="extra-markup" value="<?php echo $extra6_markup; ?>" /></td>
		<td><input name="extra6-charged" id="extra6-charged" style="width:40px;" class="extra-charged" disabled /></td>
	</tr>
	<tr class="addcustom" id="add-custom7" <?php if ($ecflag==1 && $ecshown!=1){ echo 'style="display:table-row;"'; $ecflag=0; $ecshown=1; }?>>
		<td colspan="6"><span class="addspan" id="addspan7">Add next item</span><span class="removespan" id="removespan7">X</span></td>
	</tr>
	<tr class="custom" id="custom7" <?php if ($ecshown==1){ echo 'style="display:none;"'; $ecflag=0; $ecshown=1; }?>>
	<?php if($extra8_qty =='0' || $extra8_qty =='' ){$ecflag=1;} ?>
		<td><input id="extra7-qty" name="extra7-qty" style="width:20px;" class="extra-qty" value="<?php echo $extra7_qty; ?>" /></td>
		<td colspan="2"><input id="extra7-description" name="extra7-description" style="width:210px;" value="<?php echo $extra7_description; ?>" /><input name="extra7-count" id="extra7-count" type="checkbox" style="margin-left:10px;" value="yes" <?php if( $extra7_count == "yes"){echo 'checked';} ?> /></td>
		<td><input id="extra7-price" name="extra7-price" style="width:30px;" class="extra-price" value="<?php echo $extra7_price; ?>" /></td>
		<td><input name="extra7-markup" id="extra7-markup" style="width:30px;" class="extra-markup" value="<?php echo $extra7_markup; ?>" /></td>
		<td><input name="extra7-charged" id="extra7-charged" style="width:40px;" class="extra-charged" disabled /></td>
	</tr>
	<tr class="addcustom" id="add-custom8" <?php if ($ecflag==1 && $ecshown!=1){ echo 'style="display:table-row;"'; $ecflag=0; $ecshown=1; }?>>
		<td colspan="6"><span class="addspan" id="addspan8">Add next item</span><span class="removespan" id="removespan8">X</span></td>
	</tr>
	<tr class="custom" id="custom8" <?php if ($ecshown==1){ echo 'style="display:none;"'; $ecflag=0; $ecshown=1; }?>>
	<?php if($extra9_qty =='0' || $extra9_qty =='' ){$ecflag=1;} ?>
		<td><input id="extra8-qty" name="extra8-qty" style="width:20px;" class="extra-qty" value="<?php echo $extra8_qty; ?>" /></td>
		<td colspan="2"><input id="extra8-description" name="extra8-description" style="width:210px;" value="<?php echo $extra8_description; ?>" /><input name="extra8-count" id="extra8-count" type="checkbox" style="margin-left:10px;" value="yes" <?php if( $extra8_count == "yes"){echo 'checked';} ?> /></td>
		<td><input id="extra8-price" name="extra8-price" style="width:30px;" class="extra-price" value="<?php echo $extra8_price; ?>" /></td>
		<td><input name="extra8-markup" id="extra8-markup" style="width:30px;" class="extra-markup" value="<?php echo $extra8_markup; ?>" /></td>
		<td><input name="extra8-charged" id="extra8-charged" style="width:40px;" class="extra-charged" disabled /></td>
	</tr>
	<tr class="addcustom" id="add-custom9" <?php if ($ecflag==1 && $ecshown!=1){ echo 'style="display:table-row;"'; $ecflag=0; $ecshown=1; }?>>
		<td colspan="6"><span class="addspan" id="addspan9">Add next item</span><span class="removespan" id="removespan9">X</span></td>
	</tr>
	<tr class="custom" id="custom9" <?php if ($ecshown==1){ echo 'style="display:none;"'; $ecflag=0; $ecshown=1; }?>>
	<?php if($extra10_qty =='0' || $extra10_qty =='' ){$ecflag=1;} ?>
		<td><input id="extra9-qty" name="extra9-qty" style="width:20px;" class="extra-qty" value="<?php echo $extra9_qty; ?>" /></td>
		<td colspan="2"><input id="extra9-description" name="extra9-description" style="width:210px;" value="<?php echo $extra9_description; ?>" /><input name="extra9-count" id="extra9-count" type="checkbox" style="margin-left:10px;" value="yes" <?php if( $extra9_count == "yes"){echo 'checked';} ?> /></td>
		<td><input id="extra9-price" name="extra9-price" style="width:30px;" class="extra-price" value="<?php echo $extra9_price; ?>" /></td>
		<td><input name="extra9-markup" id="extra9-markup" style="width:30px;" class="extra-markup" value="<?php echo $extra9_markup; ?>" /></td>
		<td><input name="extra9-charged" id="extra9-charged" style="width:40px;" class="extra-charged" disabled /></td>
	</tr>
	<tr class="addcustom" id="add-custom10" <?php if ($ecflag==1 && $ecshown!=1){ echo 'style="display:table-row;"'; $ecflag=0; $ecshown=1; }?>>
		<td colspan="6"><span class="addspan" id="addspan10">Add next item</span><span class="removespan" id="removespan10">X</span></td>
	</tr>
	<tr class="custom" id="custom10" <?php if ($ecshown==1){ echo 'style="display:none;"'; $ecflag=0; $ecshown=1; }?>>
	<?php if($extra11_qty =='0' || $extra11_qty =='' ){$ecflag=1;} ?>
		<td><input id="extra10-qty" name="extra10-qty" style="width:20px;" class="extra-qty" value="<?php echo $extra10_qty; ?>" /></td>
		<td colspan="2"><input id="extra10-description" name="extra10-description" style="width:210px;" value="<?php echo $extra10_description; ?>" /><input name="extra10-count" id="extra10-count" type="checkbox" style="margin-left:10px;" value="yes" <?php if( $extra10_count == "yes"){echo 'checked';} ?> /></td>
		<td><input id="extra10-price" name="extra10-price" style="width:30px;" class="extra-price" value="<?php echo $extra10_price; ?>" /></td>
		<td><input name="extra10-markup" id="extra10-markup" style="width:30px;" class="extra-markup" value="<?php echo $extra10_markup; ?>" /></td>
		<td><input name="extra10-charged" id="extra10-charged" style="width:40px;" class="extra-charged" disabled /></td>
	</tr>
	<tr class="addcustom" id="add-custom11" <?php if ($ecflag==1 && $ecshown!=1){ echo 'style="display:table-row;"'; $ecflag=0; $ecshown=1; }?>>
		<td colspan="6"><span class="removespan" id="removespan11">X</span></td>
	</tr>
</table>
<br clear="all" />


<hr style="margin:20px 0;" />
<div style="float:left; width:300px;">
<fieldset>
		<label for="installtion-required" style="width:180px; float:left; padding: 3px 0 0 0; height:25px;">Is Installation Required:</label>
		<input type="radio" name="installation-required" id="yes-installation" value="yes" <?php if( "yes" == $quote->installation_required){echo 'checked';} ?> /> Yes 
<input type="radio" name="installation-required" id="no-installation" value="no" <?php if( "no" == $quote->installation_required){echo 'checked';} ?> />No
</fieldset>
<fieldset>
		<label for="standard-installation-amount" style="width:180px; float:left; padding: 3px 0 0 0; height:25px;">Standard Installation Amount:</label> <span style="margin:3px 0 0 0; float:left;">$</span> <span style="margin:3px 0 0 0; float:left;" id="standard-installation-amount" name="standard-installation-amount"></span>		
</fieldset>
<fieldset>
		<label for="additional-installation-amount" style="width:180px; float:left; padding: 3px 0 0 0; height:25px;">Any Additional Installation Cost:</label> <span style="margin:3px 3px 0 0; float:left;">$</span> <input style="padding:1px 3px; width:40px; margin:3px 0 0 0; float:left;" id="additional-installation-amount" name="additional-installation-amount" value="<?php foreach ($quotes as $quote) {echo $quote->additional_installation_amount;} ?>" />
</fieldset>
<fieldset>
		<label for="total-installation-cost" style="width:180px; float:left; padding: 3px 0 0 0; height:25px;">INSTALLATION TOTAL:</label> <span style="margin:3px 0 0 0; float:left;">$</span><span style="margin:3px 0 0 0; float:left;" id="total-installation-cost" name="total-installation-cost"></span><input id="total-installation-cost" name="total-installation-cost"  style="display:none; width:50px;"/></fieldset>

<fieldset>
		<input id="installation-cost-include-on-check-measure" name="installation-cost-include-on-check-measure" type="checkbox" style="float:left; margin-left:0;" value="yes" <?php if($installation_cost_include_on_check_measure == 'yes'){echo 'checked ';} ?> /><label for="installation-cost-include-on-check-measure" style="width:180px; float:left; padding: 3px 0 0 0; height:25px;">Include on Check Measure Sheet</label></fieldset>

<fieldset>
<label for="freight-cost" style="width:180px; float:left; padding: 3px 0 0 0; height:25px;">Freight Cost (added to Install):</label> <span style="margin:3px 3px 0 0; float:left;">$</span><input id="freight-cost" name="freight-cost" style="padding:1px 3px; width:40px; margin:3px 0 0 0; float:left;" value="<?php foreach ($quotes as $quote) {echo $quote->freight_cost;} ?>" />
</fieldset>


</div>


<div style="float:right;">

<div style="float:left; margin-right: 10px;">

  <fieldset>    
    <textarea id="notes4" name="notes4" rows="5" cols="32" ><?php foreach ($quotes as $quote) {echo $quote->notes4;} ?></textarea>
  </fieldset>
  
  <p>
    Notes to Customer
  </p>
 </div>

<div style="float:left; margin-right:10px;">

  <fieldset>    
    <textarea id="notes2" name="notes2" rows="5" cols="32" ><?php foreach ($quotes as $quote) {echo $quote->notes2;} ?></textarea>
  </fieldset>
  
  <p>
    Notes to the Installer
  </p>
</div>


<div style="float:left;">
  <fieldset>    
    <textarea id="notes3" name="notes3" rows="5" cols="32" ><?php foreach ($quotes as $quote) {echo $quote->notes3;} ?></textarea>
  </fieldset>
    <p>
    Notes to Manufacturer
  </p>
<a href=" http://server2510.bw.ae/mrmeshit/send-file-to-manufacturer/?quote=<?php echo $visible_qid; ?>" class="send-mf" target="_blank">Send File to Manufacturer</a>

</div>

</div>

</div>
<h3 id="ui-accordion-accordion-header-5">Total Cost</h3>
<div>

<?php if ($role=='manufacturer') {?>
<div style="float:left; border: solid 1px #e1e1e1; padding:10px; background:#fafafa; margin:0 30px 0 0;">
<strong>Manufacturer</strong>
<fieldset style="margin-top:10px;">
		<label for="total" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">Total Cost:</label>
		<input id="total" style="width:50px; padding:2px 5px;" value="" disabled />
</fieldset>
<fieldset style="display:none;">
		<label for="discount" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">Discount:</label>
		<input id="discount" style="width:50px; padding:2px 5px;" value="" />
</fieldset>
<fieldset style="display:none;">
		<label for="discounted-amount" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">Discounted Amount:</label>
		<input id="discounted-amount" style="width:50px; padding:2px 5px;" value="" disabled />
</fieldset>
<fieldset style="display:none;">
		<label for="final-amount" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0; height:25px;">Total Sell Price:</label>
		<input id="final-amount" style="width:50px; padding:2px 5px; font-weight: bold; font-size:1.1em !important;" value="" disabled />
</fieldset>
</div>
<?php } ?>
<?php if (($role=='manufacturer' && $mf_role == 'distributor') || $role=="distributor") {?>
<div style="float:left; border: solid 1px #e1e1e1; padding:10px; background:#fafafa; margin:0 30px 0 0;">
<strong>Distributor</strong>
<fieldset style="display:none;">
		<label for="total-d" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">Total:</label>
		<input id="total-d" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<fieldset style="margin-top:10px; margin-bottom:5px;">
		<label for="total-d-p" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;">Screens Total:</label>
		<input id="total-d-p" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<!-- NEWLY ADD -->
<fieldset style="margin-bottom:5px;">
		<label for="total-d-mr" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;">Midrails Total:</label>
		<input id="total-d-mr" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<!-- NEWLY ADD ENDS -->
<!-- start add -->
<fieldset style="display:none;">
		<label for="total-d-p-ss" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">SS Total:</label>
		<input id="total-d-p-ss" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<fieldset style="display:none;">
		<label for="total-d-p-dg" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">D/G Total:</label>
		<input id="total-d-p-dg" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<!-- end add -->
<fieldset style="margin-bottom:10px;">
		<label for="total-d-aaem" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0;">Sections & Acc Total:</label>
		<input id="total-d-aaem" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<fieldset style="margin-bottom:5px;">
		<label for="total-d-buy-price" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;"><strong>Total Buy Price:</strong></label>
		<strong><input id="total-d-buy-price" style="width:50px; padding:2px 5px; font-weight: bold; font-size:1.1em !important;" disabled /></strong>
</fieldset>
<hr style="margin:10px 0; background:#333333 !important;" />
<fieldset style="margin-bottom:5px;">
		<label for="markup-d-ss" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;"><strong>S/S Marked Up %:</strong></label>
		<input id="markup-d-ss" name= "markup-d-ss" style="width:50px; padding:2px 5px;" value="<?php echo $markup_d_ss; ?>" />
</fieldset>
<fieldset style="margin-bottom:5px;">
		<label for="markedup-amount-d-ss" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;">SS Marked Up Amount:</label>
		<input id="markedup-amount-d-ss" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<hr style="margin:10px 0; background:#cccccc !important;" />
<fieldset style="margin-bottom:5px;">
		<label for="markup-d-dg" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;"><strong>DG Marked Up %:</strong></label>
		<input id="markup-d-dg" name= "markup-d-dg" style="width:50px; padding:2px 5px;" value="<?php echo $markup_d_dg; ?>" />
</fieldset>
<fieldset style="margin-bottom:5px;">
		<label for="markedup-amount-d-dg" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;">DG Marked Up Amount:</label>
		<input id="markedup-amount-d-dg" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<hr style="margin:10px 0; background:#cccccc !important;" />
<fieldset style="margin-bottom:5px;">
		<label for="markup-d" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;"><strong>Fibre Marked Up %:</strong></label>
		<input id="markup-d" name= "markup-d" style="width:50px; padding:2px 5px;" value="<?php echo $markup_d; ?>" />
</fieldset>
<fieldset style="margin-bottom:5px;">
		<label for="markedup-amount-d" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;">Fibre Marked Up Amount:</label>
		<input id="markedup-amount-d" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<hr style="margin:10px 0; background:#cccccc !important;" />
<fieldset style="margin-bottom:5px;">
		<label for="discount-d" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;"><strong>Discount %:</strong></label>
		<input id="discount-d" name="discount-d" style="width:50px; padding:2px 5px;" value="<?php echo $discount_d; ?>" />
</fieldset>
<fieldset style="margin-bottom:10px;">
		<label for="discounted-amount-d" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; ">Discounted Amount:</label>
		<input id="discounted-amount-d" style="width:50px; padding:2px 5px;" value="" disabled />
</fieldset>
<fieldset style="margin-bottom:10px;">
		<label for="installation-total-cost" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; ">Installation:</label>
		<input class="installation-total-cost" style="width:50px; padding:2px 5px;" value="" disabled />
</fieldset>
<fieldset style="margin-bottom:10px;">
		<label for="final-amount-d" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; "><strong>Total Sell Price:</strong></label>
		<strong><input id="final-amount-d" style="width:50px; padding:2px 5px; font-weight: bold; font-size:1.1em !important;" value="" disabled /></strong>
</fieldset>
<fieldset style="margin-bottom:5px;">
		<label for="profit-amount-d" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0; ">Profit (install not incl.):</label>
		<input id="profit-amount-d" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<hr style="margin:10px 0; background:#cccccc !important;" />
<fieldset>
<input name="check-override-final-d" id="check-override-final-d" type="checkbox" style="float:left;" value="yes" <?php if($check_override_final_d == 'yes'){echo 'checked ';} ?> /><lable style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0; height:25px;" for="check-override-final-d">Override Final Price</lable><br/>
</fieldset>
<fieldset>
<lable for="override-final-d" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0; height:25px;">Custom Quoted Amount:</lable><input name="override-final-d" id="override-final-d" type="text" style="width:50px; padding:2px 5px;" value="<?php echo $override_final_d; ?>" />
</fieldset>
</div>
<?php } ?>
<?php if (($role=='manufacturer' && $mf_role == 'wholesaler') || $role=="wholesaler") {?>
<div style="float:left; border: solid 1px #e1e1e1; padding:10px; background:#fafafa; margin:0 30px 0 0;">
<strong>Wholesaler</strong>
<fieldset style="display:none;">
		<label for="total-wh" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">Total:</label>
		<input id="total-wh" style="width:50px; padding:2px 5px;" value="" disabled />
</fieldset>
<fieldset style="margin-top:10px; margin-bottom:5px;">
		<label for="total-wh-p" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0; ">Screens Total:</label>
		<input id="total-wh-p" style="width:50px; padding:2px 5px;" value="" disabled />
</fieldset>
<!-- NEWLY ADD -->
<fieldset style="margin-bottom:5px;">
		<label for="total-wh-mr" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;">Midrails Total:</label>
		<input id="total-wh-mr" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<!-- NEWLY ADD ENDS -->
<!-- start add -->
<fieldset style="display:none;">
		<label for="total-wh-p-ss" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;">SS Total:</label>
		<input id="total-wh-p-ss" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<fieldset style="display:none;">
		<label for="total-wh-p-dg" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;">D/G Total:</label>
		<input id="total-wh-p-dg" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<!-- end add -->
<fieldset style="margin-bottom:10px;">
		<label for="total-wh-aaem" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0;">Sections & Acc Total:</label>
		<input id="total-wh-aaem" style="width:50px; padding:2px 5px;" value="" disabled />
</fieldset>
<fieldset style="margin-bottom:5px;">
		<label for="total-wh-buy-price" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;"><strong>Total Buy Price:</strong></label>
		<strong><input id="total-wh-buy-price" style="width:50px; padding:2px 5px; font-weight: bold; font-size:1.1em !important;" disabled /></strong>
</fieldset>
<hr style="margin:10px 0; background:#333333 !important;" />
<fieldset style="margin-bottom:5px;">
		<label for="markup-wh-ss" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;"><strong>S/S Marked Up %:</strong></label>
		<input id="markup-wh-ss" name= "markup-wh-ss" style="width:50px; padding:2px 5px;" value="<?php echo $markup_wh_ss; ?>" />
</fieldset>
<fieldset style="margin-bottom:5px;">
		<label for="markedup-amount-wh-ss" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;">SS Marked Up Amount:</label>
		<input id="markedup-amount-wh-ss" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<hr style="margin:10px 0; background:#cccccc !important;" />
<fieldset style="margin-bottom:5px;">
		<label for="markup-wh-dg" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;"><strong>DG Marked Up %:</strong></label>
		<input id="markup-wh-dg" name= "markup-wh-dg" style="width:50px; padding:2px 5px;" value="<?php echo $markup_wh_dg; ?>" />
</fieldset>
<fieldset style="margin-bottom:5px;">
		<label for="markedup-amount-wh-dg" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;">DG Marked Up Amount:</label>
		<input id="markedup-amount-wh-dg" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<hr style="margin:10px 0; background:#cccccc !important;" />
<fieldset style="margin-bottom:5px;">
		<label for="markup-wh" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;"><strong>Fibre Marked Up %:</strong></label>
		<input id="markup-wh" name="markup-wh" style="width:50px; padding:2px 5px;" value="<?php echo $markup_wh; ?>" />
</fieldset>

<fieldset style="margin-bottom:5px;">
		<label for="markedup-amount-wh" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0; ">Fibre Marked Up Amount:</label>
		<input id="markedup-amount-wh" style="width:50px; padding:2px 5px;" value="" disabled />
</fieldset>
<hr style="margin:10px 0; background:#cccccc !important;" />
<fieldset style="margin-bottom:5px;">
		<label for="discount-wh" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;"><strong>Discount %:</strong></label>
		<input id="discount-wh" name="discount-wh" style="width:50px; padding:2px 5px;" value="<?php echo $discount_wh; ?>" />
</fieldset>
<fieldset style="margin-bottom:10px;">
		<label for="discounted-amount-wh" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0;">Discounted Amount:</label>
		<input id="discounted-amount-wh" style="width:50px; padding:2px 5px;" value="" disabled />
</fieldset>
<fieldset style="margin-bottom:10px;">
		<label for="installation-total-cost" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; ">Installation:</label>
		<input class="installation-total-cost" style="width:50px; padding:2px 5px;" value="" disabled />
</fieldset>
<fieldset style="margin-bottom:10px;">
		<label for="final-amount-wh" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; "><strong>Total Sell Price:</strong></label>
		<strong><input id="final-amount-wh"  style="width:50px; padding:2px 5px; font-weight: bold; font-size:1.1em !important;" value="" disabled /></strong>
</fieldset>
<fieldset style="margin-bottom:5px;">
		<label for="profit-amount-wh" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0; ">Profit (install not incl.):</label>
		<input id="profit-amount-wh" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<hr style="margin:10px 0; background:#cccccc !important;" />
<fieldset>
<input name="check-override-final-wh" id="check-override-final-wh" type="checkbox" style="float:left;" value="yes" <?php if($check_override_final_wh == 'yes'){echo 'checked ';} ?> /><lable style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0; height:25px;" for="check-override-final-wh">Override Final Price</lable><br/>
</fieldset>
<fieldset>
<lable for="override-final-wh" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0; height:25px;">Custom Quoted Amount:</lable><input name="override-final-wh" id="override-final-wh" type="text" style="width:50px; padding:2px 5px;" value="<?php echo $override_final_wh; ?>" />
</fieldset>
</div>
<?php } ?>
<?php if (($role=='manufacturer' && $mf_role == 'retailer') || $role=="retailer") {?>
<div style="float:left; border: solid 1px #e1e1e1; padding:10px; background:#fafafa; margin:0 0 0 0;">
<strong>Retailer</strong>
<fieldset style="display:none;">
		<label for="total-re" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; height:25px;">Total:</label>
		<input id="total-re" style="width:50px; padding:2px 5px;" value="" disabled />
</fieldset>
<fieldset style="margin-top:10px; margin-bottom:5px;">
		<label for="total-re-p" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0;">Screens Total:</label>
		<input id="total-re-p" style="width:50px; padding:2px 5px;" value="" disabled />
</fieldset>
<!-- NEWLY ADD -->
<fieldset style="margin-bottom:5px;">
		<label for="total-re-mr" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0; ">Midrails Total:</label>
		<input id="total-re-mr" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<!-- NEWLY ADD ENDS -->
<!-- start add -->
<fieldset style="display:none;">
		<label for="total-re-p-ss" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; ">SS Total:</label>
		<input id="total-re-p-ss" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<fieldset style="display:none;">
		<label for="total-re-p-dg" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; ">D/G Total:</label>
		<input id="total-re-p-dg" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<!-- end add -->
<fieldset style="margin-bottom:10px;">
		<label for="total-re-aaem" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; ">Sections & Acc Total:</label>
		<input id="total-re-aaem" style="width:50px; padding:2px 5px;" value="" disabled />
</fieldset>
<fieldset style="margin-bottom:5px;">
		<label for="total-re-buy-price" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0; "><strong>Total Buy Price:</strong></label>
		<strong><input id="total-re-buy-price" style="width:50px; padding:2px 5px; font-weight: bold; font-size:1.1em !important;" disabled /></strong>
</fieldset>
<hr style="margin:10px 0; background:#333333 !important;" />
<fieldset style="margin-bottom:5px;">
		<label for="discount-re" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0; ">Discount %:</label>
		<input id="discount-re" name="discount-re" style="width:50px; padding:2px 5px;" value="<?php echo $discount_re; ?>" />
</fieldset>
<fieldset style="margin-bottom:10px;">
		<label for="discounted-amount-re" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; ">Discounted Amount:</label>
		<input id="discounted-amount-re" style="width:50px; padding:2px 5px;" value="" disabled />
</fieldset>
<fieldset style="margin-bottom:10px;">
		<label for="installation-total-cost" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; ">Installation:</label>
		<input class="installation-total-cost" style="width:50px; padding:2px 5px;" value="" disabled />
</fieldset>
<fieldset style="margin-bottom:10px;">
		<label for="final-amount-re" style="width:145px; float:left;  margin:0 0 10px 0; padding: 3px 0 0 0; "><strong>Total Sell Price:</strong></label>
		<strong><input id="final-amount-re" style="width:50px; padding:2px 5px; font-weight: bold; font-size:1.1em !important;" value="" disabled /></strong>
</fieldset>
<fieldset style="margin-bottom:5px;">
		<label for="profit-amount-re" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0; ">Profit (install not incl.):</label>
		<input id="profit-amount-re" style="width:50px; padding:2px 5px;" disabled />
</fieldset>
<hr style="margin:10px 0; background:#cccccc !important;" />
<fieldset>
<input name="check-override-final-re" id="check-override-final-re" type="checkbox" style="float:left;" value="yes" <?php if($check_override_final_re == 'yes'){echo 'checked ';} ?> /><lable style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0; height:25px;" for="check-override-final-re">Override Final Price</lable><br/>
</fieldset>
<fieldset>
<lable for="override-final-re" style="width:145px; float:left;  margin:0 0 0 0; padding: 3px 0 0 0; height:25px;">Custom Quoted Amount:</lable><input name="override-final-re" id="override-final-re" type="text" style="width:50px; padding:2px 5px;" value="<?php echo $override_final_re; ?>" />
</fieldset>
</div>
<?php } ?>

<br clear="all" />
<hr style="margin:20px 0; <?php if ($role != "manufacturer") { ?> display:none; <?php } ?>" />
<p style="margin:20px 0; color:#ffffff; <?php if ($role != "manufacturer") { ?> display:none; <?php } ?>">
	<strong>Master Calculator</strong> Only Visible by Manufacturer<br /><span id="calculate">Calculate</span>
</p>
<div style="float:right; width:250px; <?php if ($role != "manufacturer") { ?> display:none; <?php } ?>">
<?php 
		$mcs = $db->get_results("SELECT * FROM wp_mastercalculator WHERE id = 1");
		foreach ($mcs as $mc) {
    		
		
?>

<?php if ($role=='manufacturer' ) { ?>
	
<table class="quote gradient" style="width:100%;">
	<tr>
		<td colspan="3" style="text-align:center;"><strong>MASTER MARK UPS from Material Cost</strong> - Labour plus Overheads</td>
	</tr>
	<tr>
		<td style="text-align:center;">D.</td>
		<td style="text-align:center;">Wh.</td>
		<td style="text-align:center;">Re.</td>
	</tr>
	<tr>
		<td style="text-align:center;"><span id="mc-lo-list-1"><?php echo  $mc->mc_lo_list_1; ?></span>%</td>
		<td style="text-align:center;"><span id="mc-lo-list-2"><?php echo  $mc->mc_lo_list_2; ?></span>%</td>
		<td style="text-align:center;"><span id="mc-lo-list-3"><?php echo  $mc->mc_lo_list_3; ?></span>%</td>
	</tr>	
</table>

<table class="quote gradient" style="width:100%; margin:20px 0 0 0;">
	<tr>
		<td style="text-align:center;" colspan="2"><strong>Hourly Rate</strong></td>
		<td style="text-align:center;" colspan="3"><strong>Contracted Times/Order&Clean up</strong></td>
		<td style="text-align:center;"><strong>Mark up %</strong></td>
	</tr>
	<tr>
		<td>SD</td>
		<td style="text-align:center;"><span id="mc-lm-r-list-1"><?php echo  $mc->mc_lm_r_list_1; ?></span></td>
		<td style="text-align:center;">90</td>
		<td style="text-align:center;">0</td>
		<td style="text-align:center;"><span id="mc-lm-t-list-1"><?php echo  $mc->mc_lm_t_list_1; ?></span></td>
		<td style="text-align:center;"><span id="mc-lm-m-list-1"><?php echo  $mc->mc_lm_m_list_1; ?></span>%</td>
	</tr>
	<tr>
		<td>SW</td>
		<td style="text-align:center;"><span id="mc-lm-r-list-2"><?php echo  $mc->mc_lm_r_list_2; ?></span></td>
		<td style="text-align:center;">40</td>
		<td style="text-align:center;">5</td>
		<td style="text-align:center;"><span id="mc-lm-t-list-2"><?php echo  $mc->mc_lm_t_list_2; ?></span></td>
		<td style="text-align:center;"><span id="mc-lm-m-list-2"><?php echo  $mc->mc_lm_m_list_2; ?></span>%</td>
	</tr>
	<tr>
		<td>DGD</td>
		<td style="text-align:center;"><span id="mc-lm-r-list-3"><?php echo  $mc->mc_lm_r_list_3; ?></span></td>
		<td style="text-align:center;">90</td>
		<td style="text-align:center;">0</td>
		<td style="text-align:center;"><span id="mc-lm-t-list-3"><?php echo  $mc->mc_lm_t_list_3; ?></span></td>
		<td style="text-align:center;"><span id="mc-lm-m-list-3"><?php echo  $mc->mc_lm_m_list_3; ?></span>%</td>
	</tr>
	<tr>
		<td>DGW</td>
		<td style="text-align:center;"><span id="mc-lm-r-list-4"><?php echo  $mc->mc_lm_r_list_4; ?></span></td>
		<td style="text-align:center;">40</td>
		<td style="text-align:center;">10</td>
		<td style="text-align:center;"><span id="mc-lm-t-list-4"><?php echo  $mc->mc_lm_t_list_4; ?></span></td>
		<td style="text-align:center;"><span id="mc-lm-m-list-4"><?php echo  $mc->mc_lm_m_list_4; ?></span>%</td>
	</tr>
	<tr>
		<td>FD</td>
		<td style="text-align:center;"><span id="mc-lm-r-list-5"><?php echo  $mc->mc_lm_r_list_5; ?></span></td>
		<td style="text-align:center;" colspan="3"><span id="mc-lm-t-list-5"><?php echo  $mc->mc_lm_t_list_5; ?></span></td>
		<td style="text-align:center;"><span id="mc-lm-m-list-5"><?php echo  $mc->mc_lm-m-list_5; ?></span>%</td>
	</tr>
	<tr>
		<td>FW</td>
		<td style="text-align:center;"><span id="mc-lm-r-list-6"><?php echo  $mc->mc_lm_r_list_6; ?></span></td>
		<td style="text-align:center;" colspan="3"><span id="mc-lm-t-list-6"><?php echo  $mc->mc_lm_t_list_6; ?></span></td>		
		<td style="text-align:center;"><span id="mc-lm-m-list-6"><?php echo  $mc->mc_lm_m_list_6; ?></span>%</td>
	</tr>	
</table>
				

<table class="gradient" style="width:100%; margin:20px 0;">
	<tr>
		<td style="background:#afafaf;" colspan="2">SDSSS1220 2.4M BLK S/Steel Mesh Cost</td>
		<td style="background:#afafaf;"><span id="mc-list-1"><?php echo get_post_meta(154, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#afafaf;">SDGS1220-2.4M-BLK</td>
		<td style="background:#afafaf;">Gal Mesh Cost</td>
		<td style="background:#afafaf;"><span id="mc-list-2"><?php echo get_post_meta(404, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#99ccff; color:#000000;">Components - Rollers / Hinges</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-list-17"><?php echo get_post_meta(405, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>	
	<tr>
		<td style="background:#ffcc99;" colspan="2">SDF756MFN Door Frame</td>
		<td style="background:#ffcc99;"><span id="mc-list-3"><?php echo get_post_meta(406, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>	
	<tr>
		<td style="background:#ffcc99;" colspan="2">SDWFZ1155MFN Window Frame</td>
		<td style="background:#ffcc99;"><span id="mc-list-4"><?php echo get_post_meta(407, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#ff99cc;" colspan="2">SDF75CS Door Corner Stake</td>
		<td style="background:#ff99cc;"><span id="mc-list-5"><?php echo get_post_meta(164, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#ff99cc;" colspan="2">SDWFZC/S11 Window Cnr Stake</td>
		<td style="background:#ff99cc;"><span id="mc-list-6"><?php echo get_post_meta(162, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#ccffcc;" colspan="2">SDBLOCKMK2 NEW Security Locking Bloc</td>
		<td style="background:#ccffcc;"><span id="mc-list-7"><?php echo get_post_meta(165, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#ccffff;" colspan="2">SDTAPE 30MM Security Tape 30mm</td>
		<td style="background:#ccffff;"><span id="mc-list-8"><?php echo get_post_meta(166, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000; vertical-align:middle;" rowspan="5">Powder Coating</td>
		<td style="background:#99ccff; color:#000000;">Std</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-list-9"><?php echo  $mc->mc_list_9; ?></span></td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000;">Spec 1</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-list-10"><?php echo  $mc->mc_list_10; ?></span></td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000;">Spec 2</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-list-11"><?php echo  $mc->mc_list_11; ?></span></td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000;">Spec 3</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-list-12"><?php echo  $mc->mc_list_12; ?></span></td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000;">Spec 4</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-list-13"><?php echo  $mc->mc_list_13; ?></span></td>
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000; vertical-align:middle;" rowspan="3">Locks</td>
		<td style="background:#33cccc; color:#000000;">Single Lock</td>
		<td style="background:#33cccc; color:#000000;"><span id="mc-list-14"><?php echo get_post_meta(408, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">Trple Hngd</td>
		<td style="background:#33cccc; color:#000000;"><span id="mc-list-15"><?php echo get_post_meta(409, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">Trp Sliding</td>
		<td style="background:#33cccc; color:#000000;"><span id="mc-list-16"><?php echo get_post_meta(410, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>

	<tr>
		<td style="background:#ff99cc;" colspan="2">328026 - 6mm Spline 300M</td>
		<td style="background:#ff99cc;"><span id="mc-list-18"><?php echo get_post_meta(411, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#ff99cc;" colspan="2">445031- 7mm Security Grille</td>
		<td style="background:#ff99cc;"><span id="mc-list-19"><?php echo get_post_meta(412, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#ff99cc;" colspan="2">FS2 25MM Extruded Fibre</td>
		<td style="background:#ff99cc;"><span id="mc-list-20"><?php echo get_post_meta(413, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	
	<tr>
		<td style="background:#ff99cc;" colspan="2">Fibreglass Mesh Blk 76cmx50m</td>
		<td style="background:#ff99cc;"><span id="mc-list-21"><?php echo get_post_meta(414, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#ff99cc;" colspan="2">Abra Pet</td>
		<td style="background:#ff99cc;"><span id="mc-list-22"><?php echo get_post_meta(415, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#ff99cc;" colspan="2">FS2C Cnr for FS2 Frme</td>
		<td style="background:#ff99cc;"><span id="mc-list-23"><?php echo get_post_meta(416, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#ff99cc;" colspan="2">Screen Latch</td>
		<td style="background:#ff99cc;"><span id="mc-list-24"><?php echo get_post_meta(417, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#ffcc99;" colspan="2">Midrail Bottom</td>
		<td style="background:#ffcc99;"><span id="mc-list-25"><?php echo get_post_meta(419, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#ffcc99;" colspan="2">Midrail Top</td>
		<td style="background:#ffcc99;"><span id="mc-list-26"><?php echo get_post_meta(420, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#ccffcc;" colspan="2">6MM Spline X 300M</td>
		<td style="background:#ccffcc;"><span id="mc-list-27"><?php echo get_post_meta(421, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#ffff99;" colspan="2">Freight + Consumables</td>
		<td style="background:#ffff99;"><span id="mc-list-28"><?php echo get_post_meta(418, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#ffff99;" colspan="2">Q4750 Cross Brace</td>
		<td style="background:#ffff99;"><span id="mc-list-29"><?php echo get_post_meta(456, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
	<tr>
		<td style="background:#ffff99;" colspan="2">FMM Spline X 300M FW Midrails</td>
		<td style="background:#ffff99;"><span id="mc-list-30"><?php echo get_post_meta(457, 'wpcf-price-per-unit', true) ; ?></span></td>
	</tr>
</table>
<?php } else { ?>
<span id="mc-lo-list-1"><?php echo  $mc->mc_lo_list_1; ?></span>
<span id="mc-lo-list-2"><?php echo  $mc->mc_lo_list_2; ?></span>
<span id="mc-lo-list-3"><?php echo  $mc->mc_lo_list_3; ?></span>
<span id="mc-lm-r-list-1"><?php echo  $mc->mc_lm_r_list_1; ?></span>
<span id="mc-lm-t-list-1"><?php echo  $mc->mc_lm_t_list_1; ?></span>
<span id="mc-lm-m-list-1"><?php echo  $mc->mc_lm_m_list_1; ?></span>
<span id="mc-lm-r-list-2"><?php echo  $mc->mc_lm_r_list_2; ?></span>
<span id="mc-lm-t-list-2"><?php echo  $mc->mc_lm_t_list_2; ?></span>
<span id="mc-lm-m-list-2"><?php echo  $mc->mc_lm_m_list_2; ?></span>
<span id="mc-lm-r-list-3"><?php echo  $mc->mc_lm_r_list_3; ?></span>
<span id="mc-lm-t-list-3"><?php echo  $mc->mc_lm_t_list_3; ?></span>
<span id="mc-lm-m-list-3"><?php echo  $mc->mc_lm_m_list_3; ?></span>
<span id="mc-lm-r-list-4"><?php echo  $mc->mc_lm_r_list_4; ?></span>
<span id="mc-lm-t-list-4"><?php echo  $mc->mc_lm_t_list_4; ?></span>
<span id="mc-lm-m-list-4"><?php echo  $mc->mc_lm_m_list_4; ?></span>
<span id="mc-lm-r-list-5"><?php echo  $mc->mc_lm_r_list_5; ?></span>
<span id="mc-lm-t-list-5"><?php echo  $mc->mc_lm_t_list_5; ?></span>
<span id="mc-lm-m-list-5"><?php echo  $mc->mc_lm-m-list_5; ?></span>
<span id="mc-lm-r-list-6"><?php echo  $mc->mc_lm_r_list_6; ?></span>
<span id="mc-lm-t-list-6"><?php echo  $mc->mc_lm_t_list_6; ?></span>		
<span id="mc-lm-m-list-6"><?php echo  $mc->mc_lm_m_list_6; ?></span>
<span id="mc-list-1"><?php echo get_post_meta(154, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-2"><?php echo get_post_meta(404, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-17"><?php echo get_post_meta(405, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-3"><?php echo get_post_meta(406, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-4"><?php echo get_post_meta(407, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-5"><?php echo get_post_meta(164, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-6"><?php echo get_post_meta(162, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-7"><?php echo get_post_meta(165, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-8"><?php echo get_post_meta(166, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-9"><?php echo  $mc->mc_list_9; ?></span>
<span id="mc-list-10"><?php echo  $mc->mc_list_10; ?></span>
<span id="mc-list-11"><?php echo  $mc->mc_list_11; ?></span>
<span id="mc-list-12"><?php echo  $mc->mc_list_12; ?></span>
<span id="mc-list-13"><?php echo  $mc->mc_list_13; ?></span>
<span id="mc-list-14"><?php echo get_post_meta(408, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-15"><?php echo get_post_meta(409, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-16"><?php echo get_post_meta(410, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-18"><?php echo get_post_meta(411, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-19"><?php echo get_post_meta(412, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-20"><?php echo get_post_meta(413, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-21"><?php echo get_post_meta(414, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-22"><?php echo get_post_meta(415, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-23"><?php echo get_post_meta(416, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-24"><?php echo get_post_meta(417, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-25"><?php echo get_post_meta(419, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-26"><?php echo get_post_meta(420, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-27"><?php echo get_post_meta(421, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-28"><?php echo get_post_meta(418, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-29"><?php echo get_post_meta(456, 'wpcf-price-per-unit', true) ; ?></span>
<span id="mc-list-30"><?php echo get_post_meta(457, 'wpcf-price-per-unit', true) ; ?></span>
<?php } ?>
<?php } ?>
</div>

<div style="float:left; width:600px; <?php if ($role != "manufacturer") { ?> display:none; <?php } ?>">
<?php for($i = 1; $i<$j; $i++){ ?>
<table class="mastercalculator" id="pr<?php echo $i; ?>-mc-sd">
	<tr><td style="background:#ff6600; color:#000000;" colspan="4">Security</td></tr>
	<tr><td style="background:#ff6600; color:#000000;" colspan="2">Doors</td><td style="background:#99ccff; color:#000000;">Pwd Coat</td><td><span id="mc-sd-product<?php echo $i; ?>-pwd-coat-spec-1"></span></td></tr>
	<tr><td style="background:#00ff00;"><span id="mc-sd-product<?php echo $i; ?>-height"></span></td><td style="background:#ffff00;"><span id="mc-sd-product<?php echo $i; ?>-width"></span></td><td style="background:#99ccff; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-coat"></span></td><td><span id="mc-sd-product<?php echo $i; ?>-pwd-coat-spec-2"></span></td></tr>
	<tr><td>Mesh (H)</td><td>Mesh (W)</td><td>L/Mtrs</td><td><span id="mc-sd-product<?php echo $i; ?>-pwd-coat-spec-3"></span></td></tr>
	<tr><td style="background:#00ff00;"><span id="mc-sd-product<?php echo $i; ?>-mesh-height"></span></td><td style="background:#ffff00;"><span id="mc-sd-product<?php echo $i; ?>-mesh-width"></span></td><td style="background:#ffcc99; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-lmtrs"></span></td><td><span id="mc-sd-product<?php echo $i; ?>-pwd-coat-spec-4"></span></td></tr>
	<tr><td style="background:#33cccc; color:#000000;">SqM</td><td style="background:#33cccc; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-sqm"></span></td><td style="background:#99ccff; color:#000000;">$/SqM</td><td style="background:#99ccff; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-price-sqm"></span></td></tr>
	<tr><td colspan="2" style="background:#ffcc99; color:#000000;">75mm Sec Door Frame MF</td><td style="background:#ffcc99; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-window-frame-11mm-mfn"></span></td><td style="background:#ffcc99; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#ff99cc; color:#000000;">Door Corner Stake 4</td><td style="background:#ff99cc; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-window-cnr-stake-4"></span></td><td style="background:#ff99cc; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-window-cnr-stake-4-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#ccffcc; color:#000000;">Security Locking Bloc</td><td style="background:#ccffcc; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-security-locking-bloc"></span></td><td style="background:#ccffcc; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-security-locking-bloc-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#cc99ff; color:#000000;">Sec Door Tape 30mm</td><td style="background:#cc99ff; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-sec-door-tape-30mm"></span></td><td style="background:#cc99ff; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-sec-door-tape-30mm-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#99ccff; color:#000000;">Components-Wheels/Hinges</td><td style="background:#99ccff; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-components-wheels-hinges"></span></td><td style="background:#99ccff; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-components-wheels-hinges-calculated"></span></td></tr>
	<tr><td></td><td colspan="2" style="background:#ffff99; color:#000000;">Freight + Consumables</td><td style="background:#ffff99; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-freight-consumables"><?php echo $mc->mc_list_28; ?></span></td></tr>
	<tr><td></td><td colspan="2">Material Cost</td><td><span id="mc-sd-product<?php echo $i; ?>-material-cost"></span></td></tr>
	<tr><td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td><td style="background:#afafaf; color:#000000;"><span id="mc-sd-product<?php echo $i; ?>-labour-incl-cutting"></span></td></tr>
	<tr><td></td><td colspan="2">Total Cost</td><td><span id="mc-sd-product<?php echo $i; ?>-total-cost"></span></td></tr>
	<tr><td>Increase</td><td></td><td></td><td><span id="mc-sd-product<?php echo $i; ?>-cost-markedup"></td></tr>
</table>
<table class="mastercalculator" id="pr<?php echo $i; ?>-mc-sw">
	<tr><td style="background:#3366ff; color:#ffffff;" colspan="4">Security</td></tr>
	<tr><td style="background:#3366ff; color:#ffffff;" colspan="2">WINDOWS</td><td style="background:#99ccff; color:#000000;">Pwd Coat</td><td><span id="mc-sw-product<?php echo $i; ?>-pwd-coat-spec-1"></span></td></tr>
	<tr><td style="background:#00ff00;"><span id="mc-sw-product<?php echo $i; ?>-height"></span></td><td style="background:#ffff00;"><span id="mc-sw-product<?php echo $i; ?>-width"></span></td><td style="background:#99ccff; color:#000000;"><span id="mc-sw-product<?php echo $i; ?>-coat"></span></td><td><span id="mc-sw-product<?php echo $i; ?>-pwd-coat-spec-2"></span></td></tr>
	<tr><td>Mesh (H)</td><td>Mesh (W)</td><td>L/Mtrs</td><td><span id="mc-sw-product<?php echo $i; ?>-pwd-coat-spec-3"></span></td></tr>
	<tr><td style="background:#00ff00;"><span id="mc-sw-product<?php echo $i; ?>-mesh-height"></span></td><td style="background:#ffff00;"><span id="mc-sw-product<?php echo $i; ?>-mesh-width"></span></td><td style="background:#ffcc99; color:#000000;"><span id="mc-sw-product<?php echo $i; ?>-lmtrs"></span></td><td><span id="mc-sw-product<?php echo $i; ?>-pwd-coat-spec-4"></span></td></tr>
	<tr><td style="background:#33cccc; color:#000000;">SqM</td><td style="background:#33cccc; color:#000000;"><span id="mc-sw-product<?php echo $i; ?>-sqm"></span></td><td style="background:#99ccff; color:#000000;">$/SqM</td><td style="background:#99ccff; color:#000000;"><span id="mc-sw-product<?php echo $i; ?>-price-sqm"></span></td></tr>
	<tr><td colspan="2" style="background:#ffcc99; color:#000000;">Window Frame 11mm MFN</td><td style="background:#ffcc99; color:#000000;"><span id="mc-sw-product<?php echo $i; ?>-window-frame-11mm-mfn"></span></td><td style="background:#ffcc99; color:#000000;"><span id="mc-sw-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#ff99cc; color:#000000;">Window Cnr Stake-4</td><td style="background:#ff99cc; color:#000000;"><span id="mc-sw-product<?php echo $i; ?>-window-cnr-stake-4"></span></td><td style="background:#ff99cc; color:#000000;"><span id="mc-sw-product<?php echo $i; ?>-window-cnr-stake-4-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#ccffcc; color:#000000;">Security Locking Bloc</td><td style="background:#ccffcc; color:#000000;"><span id="mc-sw-product<?php echo $i; ?>-security-locking-bloc"></span></td><td style="background:#ccffcc; color:#000000;"><span id="mc-sw-product<?php echo $i; ?>-security-locking-bloc-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#cc99ff; color:#000000;">Sec Door Tape 30mm</td><td style="background:#cc99ff; color:#000000;"><span id="mc-sw-product<?php echo $i; ?>-sec-door-tape-30mm"></span></td><td style="background:#cc99ff; color:#000000;"><span id="mc-sw-product<?php echo $i; ?>-sec-door-tape-30mm-calculated"></span></td></tr>
	<tr><td></td><td></td><td></td><td></td></tr>
	<tr><td></td><td colspan="2" style="background:#ffff99; color:#000000;">Freight + Consumables</td><td style="background:#ffff99; color:#000000;"><span id="mc-sw-product<?php echo $i; ?>-freight-consumables"><?php echo $mc->mc_list_28; ?></span></td></tr>
	<tr><td></td><td colspan="2">Material Cost</td><td><span id="mc-sw-product<?php echo $i; ?>-material-cost"></span></td></tr>
	<tr><td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td><td style="background:#afafaf; color:#000000;"><span id="mc-sw-product<?php echo $i; ?>-labour-incl-cutting"></span></td></tr>
	<tr><td></td><td colspan="2">Total Cost</td><td><span id="mc-sw-product<?php echo $i; ?>-total-cost"></span></td></tr>
	<tr><td>Increase</td><td></td><td></td><td><span id="mc-sw-product<?php echo $i; ?>-cost-markedup"></td></tr>
</table>
<table class="mastercalculator" id="pr<?php echo $i; ?>-mc-dd">
	<tr><td style="background:#ff6600; color:#000000;" colspan="4">D/Grille</td></tr>
	<tr><td style="background:#ff6600; color:#000000;" colspan="2">Doors</td><td style="background:#99ccff; color:#000000;">Pwd Coat</td><td><span id="mc-dd-product<?php echo $i; ?>-pwd-coat-spec-1"></span></td></tr>
	<tr><td style="background:#00ff00;"><span id="mc-dd-product<?php echo $i; ?>-height"></span></td><td style="background:#ffff00;"><span id="mc-dd-product<?php echo $i; ?>-width"></span></td><td style="background:#99ccff; color:#000000;"><span id="mc-dd-product<?php echo $i; ?>-coat"></span></td><td><span id="mc-dd-product<?php echo $i; ?>-pwd-coat-spec-2"></span></td></tr>
	<tr><td>Mesh (H)</td><td>Mesh (W)</td><td>L/Mtrs</td><td><span id="mc-dd-product<?php echo $i; ?>-pwd-coat-spec-3"></span></td></tr>
	<tr><td style="background:#00ff00;"><span id="mc-dd-product<?php echo $i; ?>-mesh-height"></span></td><td style="background:#ffff00;"><span id="mc-dd-product<?php echo $i; ?>-mesh-width"></span></td><td style="background:#ffcc99; color:#000000;"><span id="mc-dd-product<?php echo $i; ?>-lmtrs"></span></td><td><span id="mc-dd-product<?php echo $i; ?>-pwd-coat-spec-4"></span></td></tr>
	<tr><td style="background:#33cccc; color:#000000;">SqM</td><td style="background:#33cccc; color:#000000;"><span id="mc-dd-product<?php echo $i; ?>-sqm"></span></td><td style="background:#99ccff; color:#000000;">$/SqM</td><td style="background:#99ccff; color:#000000;"><span id="mc-dd-product<?php echo $i; ?>-price-sqm"></span></td></tr>
	<tr><td colspan="2" style="background:#ffcc99; color:#000000;">75mm Sec Door Frame MF</td><td style="background:#ffcc99; color:#000000;"><span id="mc-dd-product<?php echo $i; ?>-window-frame-11mm-mfn"></span></td><td style="background:#ffcc99; color:#000000;"><span id="mc-dd-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#ff99cc; color:#000000;">Door Corner Stake 4</td><td style="background:#ff99cc; color:#000000;"><span id="mc-dd-product<?php echo $i; ?>-window-cnr-stake-4"></span></td><td style="background:#ff99cc; color:#000000;"><span id="mc-dd-product<?php echo $i; ?>-window-cnr-stake-4-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#ccffcc; color:#000000;">Security Locking Bloc</td><td style="background:#ccffcc; color:#000000;"><span id="mc-dd-product<?php echo $i; ?>-security-locking-bloc"></span></td><td style="background:#ccffcc; color:#000000;"><span id="mc-dd-product<?php echo $i; ?>-security-locking-bloc-calculated"></span></td></tr>
	<tr><td></td><td></td><td></td><td></td></tr>
	<tr><td colspan="2" style="background:#99ccff; color:#000000;">Components-Wheels/Hinges</td><td style="background:#99ccff; color:#000000;"><span id="mc-dd-product<?php echo $i; ?>-components-wheels-hinges"></span></td><td style="background:#99ccff; color:#000000;"><span id="mc-dd-product<?php echo $i; ?>-components-wheels-hinges-calculated"></span></td></tr>
	<tr><td></td><td colspan="2" style="background:#ffff99; color:#000000;">Freight + Consumables</td><td style="background:#ffff99; color:#000000;"><span id="mc-dd-product<?php echo $i; ?>-freight-consumables"><?php echo $mc->mc_list_28; ?></span></td></tr>
	<tr><td></td><td colspan="2">Material Cost</td><td><span id="mc-dd-product<?php echo $i; ?>-material-cost"></span></td></tr>
	<tr><td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td><td style="background:#afafaf; color:#000000;"><span id="mc-dd-product<?php echo $i; ?>-labour-incl-cutting"></span></td></tr>
	<tr><td></td><td colspan="2">Total Cost</td><td><span id="mc-dd-product<?php echo $i; ?>-total-cost"></span></td></tr>
	<tr><td>Increase</td><td></td><td></td><td><span id="mc-dd-product<?php echo $i; ?>-cost-markedup"></td></tr>
</table>
<table class="mastercalculator" id="pr<?php echo $i; ?>-mc-dw">
	<tr><td style="background:#3366ff; color:#ffffff;" colspan="4">D/Grille</td></tr>
	<tr><td style="background:#3366ff; color:#ffffff;" colspan="2">Windows</td><td style="background:#3366ff; color:#ffffff;">Pwd Coat</td><td><span id="mc-dw-product<?php echo $i; ?>-pwd-coat-spec-1"></span></td></tr>
	<tr><td style="background:#00ff00;"><span id="mc-dw-product<?php echo $i; ?>-height"></span></td><td style="background:#ffff00;"><span id="mc-dw-product<?php echo $i; ?>-width"></span></td><td style="background:#99ccff; color:#000000;"><span id="mc-dw-product<?php echo $i; ?>-coat"></span></td><td><span id="mc-dw-product<?php echo $i; ?>-pwd-coat-spec-2"></span></td></tr>
	<tr><td>Mesh (H)</td><td>Mesh (W)</td><td>L/Mtrs</td><td><span id="mc-dw-product<?php echo $i; ?>-pwd-coat-spec-3"></span></td></tr>
	<tr><td style="background:#00ff00;"><span id="mc-dw-product<?php echo $i; ?>-mesh-height"></span></td><td style="background:#ffff00;"><span id="mc-dw-product<?php echo $i; ?>-mesh-width"></span></td><td style="background:#ffcc99; color:#000000;"><span id="mc-dw-product<?php echo $i; ?>-lmtrs"></span></td><td><span id="mc-dw-product<?php echo $i; ?>-pwd-coat-spec-4"></span></td></tr>
	<tr><td style="background:#33cccc; color:#000000;">SqM</td><td style="background:#33cccc; color:#000000;"><span id="mc-dw-product<?php echo $i; ?>-sqm"></span></td><td style="background:#99ccff; color:#000000;">$/SqM</td><td style="background:#99ccff; color:#000000;"><span id="mc-dw-product<?php echo $i; ?>-price-sqm"></span></td></tr>
	<tr><td colspan="2" style="background:#ffcc99; color:#000000;">75mm Sec Door Frame MF</td><td style="background:#ffcc99; color:#000000;"><span id="mc-dw-product<?php echo $i; ?>-window-frame-11mm-mfn"></span></td><td style="background:#ffcc99; color:#000000;"><span id="mc-dw-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#ff99cc; color:#000000;">Door Corner Stake 4</td><td style="background:#ff99cc; color:#000000;"><span id="mc-dw-product<?php echo $i; ?>-window-cnr-stake-4"></span></td><td style="background:#ff99cc; color:#000000;"><span id="mc-dw-product<?php echo $i; ?>-window-cnr-stake-4-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#ccffcc; color:#000000;">Security Locking Bloc</td><td style="background:#ccffcc; color:#000000;"><span id="mc-dw-product<?php echo $i; ?>-security-locking-bloc"></span></td><td style="background:#ccffcc; color:#000000;"><span id="mc-dw-product<?php echo $i; ?>-security-locking-bloc-calculated"></span></td></tr>
	<tr><td></td><td></td><td></td><td></td></tr>
	<tr><td></td><td></td><td></td><td></td></tr>	
	<tr><td></td><td colspan="2" style="background:#ffff99; color:#000000;">Freight + Consumables</td><td style="background:#ffff99; color:#000000;"><span id="mc-dw-product<?php echo $i; ?>-freight-consumables"><?php echo $mc->mc_list_28; ?></span></td></tr>
	<tr><td></td><td colspan="2">Material Cost</td><td><span id="mc-dw-product<?php echo $i; ?>-material-cost"></span></td></tr>
	<tr><td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td><td style="background:#afafaf; color:#000000;"><span id="mc-dw-product<?php echo $i; ?>-labour-incl-cutting"></span></td></tr>
	<tr><td></td><td colspan="2">Total Cost</td><td><span id="mc-dw-product<?php echo $i; ?>-total-cost"></span></td></tr>
	<tr><td>Increase</td><td></td><td></td><td><span id="mc-dw-product<?php echo $i; ?>-cost-markedup"></td></tr>
</table>
<table class="mastercalculator" id="pr<?php echo $i; ?>-mc-fd">
	<tr><td style="background:#ff6600; color:#000000;" colspan="4">Fibre</td></tr>
	<tr><td style="background:#ff6600; color:#000000;" colspan="2">Doors</td><td style="background:#ff6600; color:#000000;">Pwd Coat</td><td><span id="mc-fd-product<?php echo $i; ?>-pwd-coat-spec-1"></span></td></tr>
	<tr><td style="background:#00ff00;"><span id="mc-fd-product<?php echo $i; ?>-height"></span></td><td style="background:#ffff00;"><span id="mc-fd-product<?php echo $i; ?>-width"></span></td><td style="background:#99ccff; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-coat"></span></td><td><span id="mc-fd-product<?php echo $i; ?>-pwd-coat-spec-2"></span></td></tr>
	<tr><td>Mesh (H)</td><td>Mesh (W)</td><td>L/Mtrs</td><td><span id="mc-fd-product<?php echo $i; ?>-pwd-coat-spec-3"></span></td></tr>
	<tr><td style="background:#00ff00;"><span id="mc-fd-product<?php echo $i; ?>-mesh-height"></span></td><td style="background:#ffff00;"><span id="mc-fd-product<?php echo $i; ?>-mesh-width"></span></td><td style="background:#ffcc99; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-lmtrs"></span></td><td><span id="mc-fd-product<?php echo $i; ?>-pwd-coat-spec-4"></span></td></tr>
	<tr><td style="background:#33cccc; color:#000000;">SqM</td><td style="background:#33cccc; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-sqm"></span></td><td style="background:#99ccff; color:#000000;">$/SqM</td><td style="background:#99ccff; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-price-sqm"></span></td></tr>
	<tr><td colspan="2" style="background:#ffcc99; color:#000000;">75mm Sec Door Frame MF</td><td style="background:#ffcc99; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-window-frame-11mm-mfn"></span></td><td style="background:#ffcc99; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#ff99cc; color:#000000;">Door Corner Stake 4</td><td style="background:#ff99cc; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-window-cnr-stake-4"></span></td><td style="background:#ff99cc; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-window-cnr-stake-4-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#ccffcc; color:#000000;">6MM Spline X 300M</td><td style="background:#ccffcc; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-security-locking-bloc"></span></td><td style="background:#ccffcc; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-security-locking-bloc-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#ccccff; color:#000000;">Screen Latch</td><td style="background:#ccccff; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-screen-latch"></span></td><td style="background:#ccccff; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-screen-latch-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#99ccff; color:#000000;">Components-Wheels/Hinges</td><td style="background:#99ccff; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-components-wheels-hinges"></span></td><td style="background:#99ccff; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-components-wheels-hinges-calculated"></span></td></tr>
	<tr><td></td><td colspan="2" style="background:#ffff99; color:#000000;">Freight + Consumables</td><td style="background:#ffff99; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-freight-consumables"><?php echo $mc->mc_list_28; ?></span></td></tr>
	<tr><td></td><td colspan="2">Material Cost</td><td><span id="mc-fd-product<?php echo $i; ?>-material-cost"></span></td></tr>
	<tr><td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td><td style="background:#afafaf; color:#000000;"><span id="mc-fd-product<?php echo $i; ?>-labour-incl-cutting"></span></td></tr>
	<tr><td></td><td colspan="2">Total Cost</td><td><span id="mc-fd-product<?php echo $i; ?>-total-cost"></span></td></tr>
	<tr><td>Increase</td><td></td><td></td><td><span id="mc-fd-product<?php echo $i; ?>-cost-markedup"></td></tr>
</table>
<table class="mastercalculator" id="pr<?php echo $i; ?>-mc-fw">
	<tr><td style="background:#3366ff; color:#ffffff;" colspan="4">Fibre</td></tr>
	<tr><td style="background:#3366ff; color:#ffffff;" colspan="2">Windows</td><td style="background:#3366ff; color:#ffffff;">Pwd Coat</td><td><span id="mc-fw-product<?php echo $i; ?>-pwd-coat-spec-1"></span></td></tr>
	<tr><td style="background:#00ff00;"><span id="mc-fw-product<?php echo $i; ?>-height"></span></td><td style="background:#ffff00;"><span id="mc-fw-product<?php echo $i; ?>-width"></span></td><td style="background:#99ccff; color:#000000;"><span id="mc-fw-product<?php echo $i; ?>-coat"></span></td><td><span id="mc-fw-product<?php echo $i; ?>-pwd-coat-spec-2"></span></td></tr>
	<tr><td>Mesh (H)</td><td>Mesh (W)</td><td>L/Mtrs</td><td><span id="mc-fw-product<?php echo $i; ?>-pwd-coat-spec-3"></span></td></tr>
	<tr><td style="background:#00ff00;"><span id="mc-fw-product<?php echo $i; ?>-mesh-height"></span></td><td style="background:#ffff00;"><span id="mc-fw-product<?php echo $i; ?>-mesh-width"></span></td><td style="background:#ffcc99; color:#000000;"><span id="mc-fw-product<?php echo $i; ?>-lmtrs"></span></td><td><span id="mc-fw-product<?php echo $i; ?>-pwd-coat-spec-4"></span></td></tr>
	<tr><td style="background:#33cccc; color:#000000;">SqM</td><td style="background:#33cccc; color:#000000;"><span id="mc-fw-product<?php echo $i; ?>-sqm"></span></td><td style="background:#99ccff; color:#000000;">$/SqM</td><td style="background:#99ccff; color:#000000;"><span id="mc-fw-product<?php echo $i; ?>-price-sqm"></span></td></tr>
	<tr><td colspan="2" style="background:#ffcc99; color:#000000;">FS2 25MM Extruded Fibre</td><td style="background:#ffcc99; color:#000000;"><span id="mc-fw-product<?php echo $i; ?>-window-frame-11mm-mfn"></span></td><td style="background:#ffcc99; color:#000000;"><span id="mc-fw-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#ff99cc; color:#000000;">FS2C Cnr for FS2 Frme</td><td style="background:#ff99cc; color:#000000;"><span id="mc-fw-product<?php echo $i; ?>-window-cnr-stake-4"></span></td><td style="background:#ff99cc; color:#000000;"><span id="mc-fw-product<?php echo $i; ?>-window-cnr-stake-4-calculated"></span></td></tr>
	<tr><td colspan="2" style="background:#ccffcc; color:#000000;">6MM Spline X 300M</td><td style="background:#ccffcc; color:#000000;"><span id="mc-fw-product<?php echo $i; ?>-security-locking-bloc"></span></td><td style="background:#ccffcc; color:#000000;"><span id="mc-fw-product<?php echo $i; ?>-security-locking-bloc-calculated"></span></td></tr>
	<tr><td></td><td></td><td></td><td></td></tr>
	<tr><td></td><td></td><td></td><td></td></tr>	
	<tr><td></td><td colspan="2" style="background:#ffff99; color:#000000;">Freight + Consumables</td><td style="background:#ffff99; color:#000000;"><span id="mc-fw-product<?php echo $i; ?>-freight-consumables"><?php echo $mc->mc_list_28; ?></span></td></tr>
	<tr><td></td><td colspan="2">Material Cost</td><td><span id="mc-fw-product<?php echo $i; ?>-material-cost"></span></td></tr>
	<tr><td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td><td style="background:#afafaf; color:#000000;"><span id="mc-fw-product<?php echo $i; ?>-labour-incl-cutting"></span></td></tr>
	<tr><td></td><td colspan="2">Total Cost</td><td><span id="mc-fw-product<?php echo $i; ?>-total-cost"></span></td></tr>
	<tr><td>Increase</td><td></td><td></td><td><span id="mc-fw-product<?php echo $i; ?>-cost-markedup"></td></tr>
</table>
<table class="result" id="result<?php echo $i; ?>">
	<tr><td><strong>Cost</strong></td><td><span id="mc-product<?php echo $i; ?>-result-cost"></span></td></tr>
	<tr><td><strong>Quantity</strong></td><td><span id="mc-product<?php echo $i; ?>-result-quantity"></span></td></tr>
	<tr><td><strong>Locks</strong></td><td><span id="mc-product<?php echo $i; ?>-result-locks"></span></td></tr>
	<tr><td><strong>Total</strong></td><td><span id="mc-product<?php echo $i; ?>-result-total"></span></td></tr>
</table><br clear="all" />
<?php } ?>

<hr style="margin:0 0 20px 0;" />
<strong style="color:#ffffff;">Midrails</strong>
<br clear="all" />


<table class="mastercalculator-mr" id="mr-mc-sd">
	<tr><td style="background:#ff6600; color:#000000;" colspan="4">Security</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#ff6600; color:#000000;" width="75%" colspan="3">Doors</td>
	</tr>
	<tr>
<td style="background:#99ccff; color:#000000;"><span id="mc-sd-mr-pwd-coat-spec-1"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-sd-mr-pwd-coat-spec-2"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-sd-mr-pwd-coat-spec-3"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-sd-mr-pwd-coat-spec-4"></span></td>
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-sd-mr-time-allocated-min">25</span></td>
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-sd-mr-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-sd-mr-markup">10</span>%</td>
		
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sd-mr-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-sd-mr-consumables">3.00</span></td>
		
	</tr>
	<tr>		
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail bottom SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sd-mr-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sd-mr-item-1-calculated"></span></td>
		
	</tr>
	<tr>
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail top SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sd-mr-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sd-mr-item-2-calculated"></span></td>
		
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">Security Locking Bloc</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-sd-mr-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-sd-mr-item-3-calculated"></span></td>
		
	</tr>
		
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-sd-mr-material-cost"></span></td>
		
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-sd-mr-labour-incl-cutting"></span></td>
		
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-sd-mr-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-sd-mr-cost-markedup"></td>
	</tr>
</table>

<table class="mastercalculator-mr" id="mr-mc-sw">
	
<tr><td style="background:#3366ff; color:#ffffff;" colspan="4">Security</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#3366ff; color:#ffffff;" width="75%" colspan="3">Windows</td>
	</tr>
	<tr>
<td style="background:#99ccff; color:#000000;"><span id="mc-sw-mr-pwd-coat-spec-1"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-sw-mr-pwd-coat-spec-2"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-sw-mr-pwd-coat-spec-3"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-sw-mr-pwd-coat-spec-4"></span></td>
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-sw-mr-time-allocated-min">25</span></td>
		
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-sw-mr-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-sw-mr-markup">10</span>%</td>
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sw-mr-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-sw-mr-consumables">3.00</span></td>
		
	</tr>
	<tr>		
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail bottom SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sw-mr-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sw-mr-item-1-calculated"></span></td>
		
	</tr>
	<tr>
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail top SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sw-mr-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sw-mr-item-2-calculated"></span></td>
		
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">Security Locking Bloc</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-sw-mr-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-sw-mr-item-3-calculated"></span></td>
		
	</tr>
		
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-sw-mr-material-cost"></span></td>
		
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-sw-mr-labour-incl-cutting"></span></td>
		
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-sw-mr-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-sw-mr-cost-markedup"></td>
		
	</tr>
</table>

<table class="mastercalculator-mr" id="mr-mc-dd">
	
<tr><td style="background:#ff6600; color:#000000;" colspan="4">D/Grille</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#ff6600; color:#000000;" width="75%" colspan="3">Doors</td>
	</tr>
	<tr>
<td style="background:#99ccff; color:#000000;"><span id="mc-dd-mr-pwd-coat-spec-1"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-dd-mr-pwd-coat-spec-2"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-dd-mr-pwd-coat-spec-3"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-dd-mr-pwd-coat-spec-4"></span></td>
		
		
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-dd-mr-time-allocated-min">15</span></td>
		
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-dd-mr-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-dd-mr-markup">10</span>%</td>
		
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dd-mr-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-dd-mr-consumables">2.00</span></td>
		
	</tr>
	<tr>		
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail bottom SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dd-mr-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dd-mr-item-1-calculated"></span></td>
		
	</tr>
	<tr>
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail top SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dd-mr-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dd-mr-item-2-calculated"></span></td>
		
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">6MM Spline X 300M</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-dd-mr-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-dd-mr-item-3-calculated"></span></td>
		
	</tr>
		
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-dd-mr-material-cost"></span></td>
		
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-dd-mr-labour-incl-cutting"></span></td>
		
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-dd-mr-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-dd-mr-cost-markedup"></td>
		
	</tr>
</table>


<table class="mastercalculator-mr" id="mr-mc-dw">
	
<tr><td style="background:#3366ff; color:#ffffff;" colspan="4">D/Grille</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#3366ff; color:#ffffff;" width="75%" colspan="3">Windows</td>
	</tr>
	<tr>
<td style="background:#99ccff; color:#000000;"><span id="mc-dw-mr-pwd-coat-spec-1"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-dw-mr-pwd-coat-spec-2"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-dw-mr-pwd-coat-spec-3"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-dw-mr-pwd-coat-spec-4"></span></td>
		
		
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-dw-mr-time-allocated-min">15</span></td>
		
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-dw-mr-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-dw-mr-markup">10</span>%</td>
		
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dw-mr-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-dw-mr-consumables">2.00</span></td>
		
	</tr>
	<tr>		
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail bottom SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dw-mr-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dw-mr-item-1-calculated"></span></td>
		
	</tr>
	<tr>
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail top SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dw-mr-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dw-mr-item-2-calculated"></span></td>
		
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">6MM Spline X 300M</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-dw-mr-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-dw-mr-item-3-calculated"></span></td>
		
	</tr>
		
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-dw-mr-material-cost"></span></td>
		
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-dw-mr-labour-incl-cutting"></span></td>
		
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-dw-mr-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-dw-mr-cost-markedup"></td>
		
	</tr>
</table>



<table class="mastercalculator-mr" id="mr-mc-fd">
	
<tr><td style="background:#ff6600; color:#000000;" colspan="4">Fibre</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#ff6600; color:#000000;" width="75%" colspan="3">Doors</td>
	</tr>
	<tr>
<td style="background:#99ccff; color:#000000;"><span id="mc-fd-mr-pwd-coat-spec-1"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-fd-mr-pwd-coat-spec-2"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-fd-mr-pwd-coat-spec-3"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-fd-mr-pwd-coat-spec-4"></span></td>
		
		
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-fd-mr-time-allocated-min">10</span></td>
		
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-fd-mr-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-fd-mr-markup">10</span>%</td>
		
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fd-mr-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-fd-mr-consumables">1.00</span></td>
		
	</tr>
	<tr>		
		<td colspan="2" style="background:#ff6600; color:#000000;">Midrail</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fd-mr-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fd-mr-item-1-calculated"></span></td>
		
	</tr>
	<tr>
		<td colspan="2" style="background:#ff6600; color:#000000;">Tee ???</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fd-mr-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fd-mr-item-2-calculated"></span></td>
		
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">6MM Spline X 300M</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-fd-mr-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-fd-mr-item-3-calculated"></span></td>
		
	</tr>
		
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-fd-mr-material-cost"></span></td>
		
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-fd-mr-labour-incl-cutting"></span></td>
		
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-fd-mr-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-fd-mr-cost-markedup"></td>
		
	</tr>
</table>


<table class="mastercalculator-mr" id="mr-mc-fw">
	
<tr><td style="background:#3366ff; color:#ffffff;" colspan="4">Fibre</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#3366ff; color:#ffffff;" width="75%" colspan="3">Windows</td>
	</tr>
	<tr>
<td style="background:#99ccff; color:#000000;"><span id="mc-fw-mr-pwd-coat-spec-1"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-fw-mr-pwd-coat-spec-2"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-fw-mr-pwd-coat-spec-3"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-fw-mr-pwd-coat-spec-4"></span></td>
		
		
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-fw-mr-time-allocated-min">5</span></td>
		
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-fw-mr-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-fw-mr-markup">0</span>%</td>
		
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fw-mr-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-fw-mr-consumables">1.00</span></td>
		
	</tr>



	
	

	<tr>		
		<td colspan="2" style="background:#ff6600; color:#000000;">Midrail</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fw-mr-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fw-mr-item-1-calculated"></span></td>
		
	</tr>
	<tr>
		<td colspan="2" style="background:#ff6600; color:#000000;">Tee ???</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fw-mr-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fw-mr-item-2-calculated"></span></td>
		
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">6MM Spline X 300M</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-fw-mr-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-fw-mr-item-3-calculated"></span></td>
		
	</tr>
		
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-fw-mr-material-cost"></span></td>
		
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-fw-mr-labour-incl-cutting"></span></td>
		
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-fw-mr-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-fw-mr-cost-markedup"></td>
		
	</tr>
</table>

<table class="result" id="result-mr">

	<tr>
		<td><strong>Cost</strong></td>
		<td><span id="mc-mr-result-cost"></span></td>
	</tr>
	<tr>
		<td><strong>Quantity</strong></td>
		<td><span id="mc-mr-result-quantity"></span></td>
	</tr>
	<tr>
		<td><strong>Total</strong></td>
		<td><span id="mc-mr-result-total"></span></td>
	</tr>


</table>
<br clear="all" />








<table class="mastercalculator-mr" id="mr2-mc-sd">
	
<tr><td style="background:#ff6600; color:#000000;" colspan="4">Security</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#ff6600; color:#000000;" width="75%" colspan="3">Doors</td>
	</tr>
	<tr>
<td style="background:#99ccff; color:#000000;"><span id="mc-sd-mr2-pwd-coat-spec-1"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-sd-mr2-pwd-coat-spec-2"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-sd-mr2-pwd-coat-spec-3"></span></td>
<td style="background:#99ccff; color:#000000;"><span id="mc-sd-mr2-pwd-coat-spec-4"></span></td>
		
		
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-sd-mr2-time-allocated-min">25</span></td>
		
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-sd-mr2-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-sd-mr2-markup">10</span>%</td>
		
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sd-mr2-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-sd-mr2-consumables">3.00</span></td>
		
	</tr>



	
	

	<tr>		
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail bottom SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sd-mr2-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sd-mr2-item-1-calculated"></span></td>
		
	</tr>
	<tr>
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail top SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sd-mr2-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sd-mr2-item-2-calculated"></span></td>
		
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">Security Locking Bloc</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-sd-mr2-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-sd-mr2-item-3-calculated"></span></td>
		
	</tr>
		
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-sd-mr2-material-cost"></span></td>
		
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-sd-mr2-labour-incl-cutting"></span></td>
		
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-sd-mr2-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-sd-mr2-cost-markedup"></td>
		
	</tr>
</table>


<table class="mastercalculator-mr" id="mr2-mc-sw">
	<tr><td style="background:#3366ff; color:#ffffff;" colspan="4">Security</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#3366ff; color:#ffffff;" width="75%" colspan="3">Windows</td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sw-mr2-pwd-coat-spec-1"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sw-mr2-pwd-coat-spec-2"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sw-mr2-pwd-coat-spec-3"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sw-mr2-pwd-coat-spec-4"></span></td>
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-sw-mr2-time-allocated-min">25</span></td>
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-sw-mr2-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-sw-mr2-markup">10</span>%</td>
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sw-mr2-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-sw-mr2-consumables">3.00</span></td>
	</tr>
	<tr>		
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail bottom SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sw-mr2-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sw-mr2-item-1-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail top SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sw-mr2-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sw-mr2-item-2-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">Security Locking Bloc</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-sw-mr2-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-sw-mr2-item-3-calculated"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-sw-mr2-material-cost"></span></td>
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-sw-mr2-labour-incl-cutting"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-sw-mr2-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-sw-mr2-cost-markedup"></td>
	</tr>
</table>
<table class="mastercalculator-mr" id="mr2-mc-dd">
	<tr><td style="background:#ff6600; color:#000000;" colspan="4">D/Grille</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#ff6600; color:#000000;" width="75%" colspan="3">Doors</td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dd-mr2-pwd-coat-spec-1"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dd-mr2-pwd-coat-spec-2"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dd-mr2-pwd-coat-spec-3"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dd-mr2-pwd-coat-spec-4"></span></td>
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-dd-mr2-time-allocated-min">15</span></td>
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-dd-mr2-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-dd-mr2-markup">10</span>%</td>
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dd-mr2-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-dd-mr2-consumables">2.00</span></td>
	</tr>
	<tr>		
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail bottom SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dd-mr2-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dd-mr2-item-1-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail top SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dd-mr2-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dd-mr2-item-2-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">6MM Spline X 300M</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-dd-mr2-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-dd-mr2-item-3-calculated"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-dd-mr2-material-cost"></span></td>
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-dd-mr2-labour-incl-cutting"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-dd-mr2-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-dd-mr2-cost-markedup"></td>
	</tr>
</table>
<table class="mastercalculator-mr" id="mr2-mc-dw">
	<tr><td style="background:#3366ff; color:#ffffff;" colspan="4">D/Grille</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#3366ff; color:#ffffff;" width="75%" colspan="3">Windows</td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dw-mr2-pwd-coat-spec-1"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dw-mr2-pwd-coat-spec-2"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dw-mr2-pwd-coat-spec-3"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dw-mr2-pwd-coat-spec-4"></span></td>
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-dw-mr2-time-allocated-min">15</span></td>
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-dw-mr2-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-dw-mr2-markup">10</span>%</td>
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dw-mr2-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-dw-mr2-consumables">2.00</span></td>
	</tr>
	<tr>		
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail bottom SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dw-mr2-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dw-mr2-item-1-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail top SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dw-mr2-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dw-mr2-item-2-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">6MM Spline X 300M</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-dw-mr2-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-dw-mr2-item-3-calculated"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-dw-mr2-material-cost"></span></td>
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-dw-mr2-labour-incl-cutting"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-dw-mr2-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-dw-mr2-cost-markedup"></td>
	</tr>
</table>
<table class="mastercalculator-mr" id="mr2-mc-fd">
	<tr><td style="background:#ff6600; color:#000000;" colspan="4">Fibre</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#ff6600; color:#000000;" width="75%" colspan="3">Doors</td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fd-mr2-pwd-coat-spec-1"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fd-mr2-pwd-coat-spec-2"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fd-mr2-pwd-coat-spec-3"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fd-mr2-pwd-coat-spec-4"></span></td>
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-fd-mr2-time-allocated-min">10</span></td>
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-fd-mr2-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-fd-mr2-markup">10</span>%</td>
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fd-mr2-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-fd-mr2-consumables">1.00</span></td>
	</tr>
	<tr>		
		<td colspan="2" style="background:#ff6600; color:#000000;">Midrail</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fd-mr2-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fd-mr2-item-1-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ff6600; color:#000000;">Tee ???</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fd-mr2-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fd-mr2-item-2-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">6MM Spline X 300M</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-fd-mr2-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-fd-mr2-item-3-calculated"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-fd-mr2-material-cost"></span></td>
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-fd-mr2-labour-incl-cutting"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-fd-mr2-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-fd-mr2-cost-markedup"></td>
	</tr>
</table>
<table class="mastercalculator-mr" id="mr2-mc-fw">
	<tr><td style="background:#3366ff; color:#ffffff;" colspan="4">Fibre</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#3366ff; color:#ffffff;" width="75%" colspan="3">Windows</td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fw-mr2-pwd-coat-spec-1"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fw-mr2-pwd-coat-spec-2"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fw-mr2-pwd-coat-spec-3"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fw-mr2-pwd-coat-spec-4"></span></td>
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-fw-mr2-time-allocated-min">10</span></td>
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-fw-mr2-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-fw-mr2-markup">10</span>%</td>
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fw-mr2-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-fw-mr2-consumables">1.00</span></td>
	</tr>
	<tr>		
		<td colspan="2" style="background:#ff6600; color:#000000;">Midrail</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fw-mr2-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fw-mr2-item-1-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ff6600; color:#000000;">Tee ???</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fw-mr2-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fw-mr2-item-2-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">6MM Spline X 300M</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-fw-mr2-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-fw-mr2-item-3-calculated"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-fw-mr2-material-cost"></span></td>
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-fw-mr2-labour-incl-cutting"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-fw-mr2-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-fw-mr2-cost-markedup"></td>
	</tr>
</table>
<table class="result" id="result-mr2">
	<tr>
		<td><strong>Cost</strong></td>
		<td><span id="mc-mr2-result-cost"></span></td>
	</tr>
	<tr>
		<td><strong>Quantity</strong></td>
		<td><span id="mc-mr2-result-quantity"></span></td>
	</tr>
	<tr>
		<td><strong>Total</strong></td>
		<td><span id="mc-mr2-result-total"></span></td>
	</tr>
</table>
<br clear="all" />
<table class="mastercalculator-mr" id="mr3-mc-sd">
	<tr><td style="background:#ff6600; color:#000000;" colspan="4">Security</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#ff6600; color:#000000;" width="75%" colspan="3">Doors</td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sd-mr3-pwd-coat-spec-1"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sd-mr3-pwd-coat-spec-2"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sd-mr3-pwd-coat-spec-3"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sd-mr3-pwd-coat-spec-4"></span></td>
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-sd-mr3-time-allocated-min">25</span></td>
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-sd-mr3-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-sd-mr3-markup">10</span>%</td>
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sd-mr3-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-sd-mr3-consumables">3.00</span></td>
	</tr>
	<tr>		
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail bottom SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sd-mr3-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sd-mr3-item-1-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail top SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sd-mr3-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sd-mr3-item-2-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">Security Locking Bloc</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-sd-mr3-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-sd-mr3-item-3-calculated"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-sd-mr3-material-cost"></span></td>
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-sd-mr3-labour-incl-cutting"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-sd-mr3-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-sd-mr3-cost-markedup"></td>
	</tr>
</table>
<table class="mastercalculator-mr" id="mr3-mc-sw">
	<tr><td style="background:#3366ff; color:#ffffff;" colspan="4">Security</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#3366ff; color:#ffffff;" width="75%" colspan="3">Windows</td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sw-mr3-pwd-coat-spec-1"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sw-mr3-pwd-coat-spec-2"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sw-mr3-pwd-coat-spec-3"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sw-mr3-pwd-coat-spec-4"></span></td>
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-sw-mr3-time-allocated-min">25</span></td>
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-sw-mr3-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-sw-mr3-markup">10</span>%</td>
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-sw-mr3-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-sw-mr3-consumables">3.00</span></td>
	</tr>
	<tr>		
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail bottom SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sw-mr3-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sw-mr3-item-1-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail top SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sw-mr3-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-sw-mr3-item-2-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">Security Locking Bloc</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-sw-mr3-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-sw-mr3-item-3-calculated"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-sw-mr3-material-cost"></span></td>
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-sw-mr3-labour-incl-cutting"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-sw-mr3-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-sw-mr3-cost-markedup"></td>
	</tr>
</table>
<table class="mastercalculator-mr" id="mr3-mc-dd">
	<tr><td style="background:#ff6600; color:#000000;" colspan="4">D/Grille</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#ff6600; color:#000000;" width="75%" colspan="3">Doors</td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dd-mr3-pwd-coat-spec-1"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dd-mr3-pwd-coat-spec-2"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dd-mr3-pwd-coat-spec-3"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dd-mr3-pwd-coat-spec-4"></span></td>
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-dd-mr3-time-allocated-min">15</span></td>
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-dd-mr3-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-dd-mr3-markup">10</span>%</td>
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dd-mr3-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-dd-mr3-consumables">2.00</span></td>
	</tr>
	<tr>		
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail bottom SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dd-mr3-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dd-mr3-item-1-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail top SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dd-mr3-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dd-mr3-item-2-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">6MM Spline X 300M</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-dd-mr3-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-dd-mr3-item-3-calculated"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-dd-mr3-material-cost"></span></td>
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-dd-mr3-labour-incl-cutting"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-dd-mr3-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-dd-mr3-cost-markedup"></td>
	</tr>
</table>
<table class="mastercalculator-mr" id="mr3-mc-dw">
	<tr><td style="background:#3366ff; color:#ffffff;" colspan="4">D/Grille</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#3366ff; color:#ffffff;" width="75%" colspan="3">Windows</td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dw-mr3-pwd-coat-spec-1"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dw-mr3-pwd-coat-spec-2"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dw-mr3-pwd-coat-spec-3"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dw-mr3-pwd-coat-spec-4"></span></td>
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-dw-mr3-time-allocated-min">15</span></td>
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-dw-mr3-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-dw-mr3-markup">10</span>%</td>
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-dw-mr3-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-dw-mr3-consumables">2.00</span></td>
	</tr>
	<tr>		
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail bottom SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dw-mr3-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dw-mr3-item-1-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ffcc99; color:#000000;">Sec mid rail top SBK</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dw-mr3-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-dw-mr3-item-2-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">6MM Spline X 300M</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-dw-mr3-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-dw-mr3-item-3-calculated"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-dw-mr3-material-cost"></span></td>
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-dw-mr3-labour-incl-cutting"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-dw-mr3-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-dw-mr3-cost-markedup"></td>
	</tr>
</table>
<table class="mastercalculator-mr" id="mr3-mc-fd">
	<tr><td style="background:#ff6600; color:#000000;" colspan="4">Fibre</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#ff6600; color:#000000;" width="75%" colspan="3">Doors</td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fd-mr3-pwd-coat-spec-1"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fd-mr3-pwd-coat-spec-2"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fd-mr3-pwd-coat-spec-3"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fd-mr3-pwd-coat-spec-4"></span></td>
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-fd-mr3-time-allocated-min">10</span></td>
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-fd-mr3-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-fd-mr3-markup">10</span>%</td>
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fd-mr3-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-fd-mr3-consumables">1.00</span></td>
	</tr>
	<tr>		
		<td colspan="2" style="background:#ff6600; color:#000000;">Midrail</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fd-mr3-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fd-mr3-item-1-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ff6600; color:#000000;">Tee ???</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fd-mr3-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fd-mr3-item-2-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">6MM Spline X 300M</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-fd-mr3-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-fd-mr3-item-3-calculated"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-fd-mr3-material-cost"></span></td>
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-fd-mr3-labour-incl-cutting"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-fd-mr3-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-fd-mr3-cost-markedup"></td>
	</tr>
</table>
<table class="mastercalculator-mr" id="mr3-mc-fw">
	<tr><td style="background:#3366ff; color:#ffffff;" colspan="4">Fibre</td></tr>
	<tr>
		<td style="background:#99ccff; color:#000000;" width="25%">Pwd Coat</td>
		<td style="background:#3366ff; color:#ffffff;" width="75%" colspan="3">Windows</td>
	</tr>
	<tr>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fw-mr3-pwd-coat-spec-1"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fw-mr3-pwd-coat-spec-2"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fw-mr3-pwd-coat-spec-3"></span></td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fw-mr3-pwd-coat-spec-4"></span></td>
	</tr>
	<tr>
		<td colspan="3">Time Allocated/mins</td>
		<td><span id="mc-fw-mr3-time-allocated-min">10</span></td>
	</tr>
	<tr>
		<td>Rail (W)</td>
		<td style="background:#ffff00;"><span id="mc-fw-mr3-width"></span></td>
		<td>Mark Up</td>
		<td><span id="mc-fw-mr3-markup">10</span>%</td>
	</tr>
	<tr>
		<td style="background:#33cccc; color:#000000;">L/M</td>
		<td style="background:#99ccff; color:#000000;"><span id="mc-fw-mr3-lm"></span></td>
		<td style="background:#ffff99; color:#000000;">Consumables</td>
		<td style="background:#ffff99; color:#000000;"><span id="mc-fw-mr3-consumables">1.00</span></td>
	</tr>
	<tr>		
		<td colspan="2" style="background:#ff6600; color:#000000;">Midrail</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fw-mr3-item-1"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fw-mr3-item-1-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ff6600; color:#000000;">Tee ???</td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fw-mr3-item-2"></span></td>
		<td style="background:#ffcc99; color:#000000;"><span id="mc-fw-mr3-item-2-calculated"></span></td>
	</tr>
	<tr>
		<td colspan="2" style="background:#ccffcc; color:#000000;">6MM Spline X 300M</td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-fw-mr3-item-3"></span></td>
		<td style="background:#ccffcc; color:#000000;"><span id="mc-fw-mr3-item-3-calculated"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Material Cost</td>
		<td><span id="mc-fw-mr3-material-cost"></span></td>
	</tr>
	<tr>
		<td colspan="3" style="background:#afafaf; color:#000000;">Labour incl./Cutting</td>
		<td style="background:#afafaf; color:#000000;"><span id="mc-fw-mr3-labour-incl-cutting"></span></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="2">Total Cost</td>
		<td><span id="mc-fw-mr3-total-cost"></span></td>
	</tr>
	<tr>
		<td>Increase</td>
		<td></td>
		<td></td>
		<td><span id="mc-fw-mr3-cost-markedup"></td>
	</tr>
</table>
<table class="result" id="result-mr3">
	<tr>
		<td><strong>Cost</strong></td>
		<td><span id="mc-mr3-result-cost"></span></td>
	</tr>
	<tr>
		<td><strong>Quantity</strong></td>
		<td><span id="mc-mr3-result-quantity"></span></td>
	</tr>
	<tr>
		<td><strong>Total</strong></td>
		<td><span id="mc-mr3-result-total"></span></td>
	</tr>
</table>
</div>

</div> 
</div>

<?php foreach ($quotes as $quote) {
	if ($role == "manufacturer" || $quote->status==0){?>
	<input id="save_quote" type="submit" name="form_submit" value="Save Changes" style="margin-top:20px; float:left;" />
<input id="save_as_a_new_quote" type="submit" name="form_submit" value="Save As a New Quote" style="margin-top:20px; float:left; margin-left:10px;" />
<?php if ($quote->status==0){ ?><input id="quote_order" type="submit" name="form_submit" value="Save Changes & Convert to Order" style="margin-top:20px; float:left; margin-left:10px;" /> <?php } ?>
<?php	
	}
	if ( $role != "manufacturer" && ($quote->status==1 || $quote->status==2 ||$quote->status==3 || $quote->status==4)){
?>		
<input id="save_as_a_new_quote" type="submit" name="form_submit" value="Save As a New Quote" style="margin-top:20px; float:left; margin-left:10px;" />
<?php
	} 
} ?>
<div style="float:left; margin-top:4px; margin-left:10px;">


<?php foreach ($quotes as $quote) { 

if ($quote->status==1 || $quote->status==2 || $quote->status==3 || $quote->status==4){ ?>

		<label for="orderin-date" style="width:80px; margin:20px 5px 10px 20px; padding: 3px 0 0 0; height:25px;">Order Date:</label>
		<input id="orderin-date" style="width:70px; padding:2px 5px; margin:20px 0 10px 0;" value="<?php echo $quote->orderin_date; ?>" disabled />

<?php }
else{
?>
		<label for="orderin-date" style="width:80px; margin:20px 5px 10px 20px; padding: 3px 0 0 0; height:25px;">Order Date:</label>
		<input id="orderin-date" style="width:70px; padding:2px 5px; margin:20px 0 10px 0;" value="<?php echo date('d/m/Y'); ?>" disabled />


<?php }

 } ?>
		<label for="required-date" style="width:100px; margin:20px 5px 10px 20px; padding: 3px 0 0 0; height:25px;">Required Date:</label>
		<input id="required-date" name="required-date" style="width:70px; padding:2px 5px; margin:20px 0 10px 0;" value="<?php foreach ($quotes as $quote) {echo $quote->required_date;} ?>" />

</div>



</form>
<style>
	.quote{
		width:100%;
	}	
	.quote th{
		padding:5px 2px;
		border:1px #e1e1e1 solid;
		font-weight:bold;
		font-size:0.9em;
	}
	.quote td{
		padding:0 2px 0;
		border:1px #e1e1e1 solid;
		background:#eeeeee;
	}
	.quote .prices td span, .quote .prices-mr td span{
		padding:0 30px 0 5px;
		font-size:1.1em;
		font-weight:normal;
	}
	.quote .prices td, .quote .prices-mr td{
		font-size:0.9em;
		padding: 0 2px 0 2px;		
	}
	.quote td input{
		padding:1px 4px;	
	}

	.mastercalculator {
		width:300px;
		float: left;
		margin:0 20px 20px 0;
		display:none;
	}
	.mastercalculator td {
		padding:4px 2px 2px;
		border:1px #e1e1e1 solid;
		background:#ffffff;
		text-align:center;
	}

	.mastercalculator-mr {
		width:300px;
		float: left;
		margin:0 20px 20px 0;
		display:none;
	}
	.mastercalculator-mr td {
		padding:4px 2px 2px;
		border:1px #e1e1e1 solid;
		background:#ffffff;
		text-align:center;
	}
	.result {
		width:15%;
		display:none;
	}
	.result td {
		padding:4px 2px 2px;
		border:1px #e1e1e1 solid;
		background:#eeeeee;
	}
	.ui-button{
		width:67px;
	}

	.addproduct, .addmidrails, .addmeter, .addcustom{		
		display:none;
	}
	.addproduct td, .addmidrails td, .addmeter td, .addcustom td {		
		text-align:center;		
		background:#eeeeee;
		color:#ff5555;
		font-weight:bold;
		font-size:0.9em;
	}
	.addspan, .copyspan {font-size:1.05em;}
	.addspan, .copyspan , #calculate {
		cursor:pointer;
	}
	.copyspan {margin-left:20px;}
	.removespan {
		position:relative;
		top:-16px;
		right:-350px;
		cursor:pointer;
	}
	.removespan#removespan2 {
		display:none !important;
	}
	.addmeter td, .addcustom td {position:relative; border:0 !important; background:none !important;}
	.addmeter .removespan, .addcustom .removespan {
		right:4px;
		position:absolute;
	}
	
	.ui-icon-triangle-1-e, .ui-icon-triangle-1-s {float:left;}
	.ee {color:#ffffff; font-size:1em !important;}
	.ee input {position:relative; top:2px;}
	.quote .prices td{
		color: #ffffff !important;
		font-size: 0.85em !important;
	}
	.quote .prices-mr td{
		color: #ffffff !important;
		font-size: 0.85em !important;
	}
	.quote td input, .quote td select{
		font-weight: bold;	
	}
	.quote .mr td:last-child{
		background-color:#eeeeee !important;
	}
	.quote .value-holder{float:left; width:150px; padding:2px 5px; border-right:#05355e 1px solid;}
	.quote .value-holder.ee-holder{float:left; width:180px; border-right:0;}
	.quote .value-holder.ee-holder input{margin:0;}
	.delete{		
		color:#ff0000 !important; 
		cursor:pointer; 
		padding:6px;
		font-size:0.8em;
		top:-2px;
		position:relative;
	}
	.delete:hover{
		text-decoration:none;
		background:#ff0000 !important; 
		color:#ffffff !important;
	}
	
</style>
<script>
var costSecurity = 0;
$('.product-security-dgrille-fibre').on("change",function(){
var flagSecurity = 0;
costSecurity = 0;
$( ".product-security-dgrille-fibre" ).each(function() {
  	if($( this ).val()== "security" ){flagSecurity += 1;}
});
if(flagSecurity>0){costSecurity=8;} else {costSecurity=0;}
});

$("#product1-security-dgrille-fibre").trigger("change");
$( "#required-date" ).datepicker({ dateFormat: "dd/mm/yy" });
var resortIds = function(){
	for (var i=0 ; i<31; i++){
		var j = i+1;
		var k = i+2;
		$( ".product-item-number:eq(" + i + ")" ).attr("id","product" + j + "-item-number").attr("name","product" + j + "-item-number");
		$( ".product-quantity-of-panels:eq(" + i + ")" ).attr("id","product" + j + "-quantity-of-panels").attr("name","product" + j + "-quantity-of-panels");
		$( ".product-security-dgrille-fibre:eq(" + i + ")" ).attr("id","product" + j + "-security-dgrille-fibre").attr("name","product" + j + "-security-dgrille-fibre");
		$( ".product-316-ss-gal-pet:eq(" + i + ")" ).attr("id","product" + j + "-316-ss-gal-pet").attr("name","product" + j + "-316-ss-gal-pet");
		$( ".product-window-or-door:eq(" + i + ")" ).attr("id","product" + j + "-window-or-door").attr("name","product" + j + "-window-or-door");
		$( ".product-window-frame-type:eq(" + i + ")" ).attr("id","product" + j + "-window-frame-type").attr("name","product" + j + "-window-frame-type");
		$( ".product-configuration:eq(" + i + ")" ).attr("id","product" + j + "-configuration").attr("name","product" + j + "-configuration");
		$( ".product-location-in-building:eq(" + i + ")" ).attr("id","product" + j + "-location-in-building").attr("name","product" + j + "-location-in-building");
		$( ".product-height:eq(" + i + ")" ).attr("id","product" + j + "-height").attr("name","product" + j + "-height");
		$( ".product-width:eq(" + i + ")" ).attr("id","product" + j + "-width").attr("name","product" + j + "-width");
		$( ".product-number-of-locks:eq(" + i + ")" ).attr("id","product" + j + "-number-of-locks").attr("name","product" + j + "-number-of-locks");
		$( ".product-lock-type:eq(" + i + ")" ).attr("id","product" + j + "-lock-type").attr("name","product" + j + "-lock-type");
		$( ".product-lock-handle-height:eq(" + i + ")" ).attr("id","product" + j + "-lock-handle-height").attr("name","product" + j + "-lock-handle-height");
		$( ".product:eq(" + i + ")" ).attr("id","product" + j );
		$( ".prices:eq(" + i + ")" ).attr("id","prices" + j );
		$( ".addproduct:eq(" + i + ")" ).attr("id","add" + k );
		$( ".addproduct .addspan:eq(" + i + ")" ).attr("id","addspan" + k );
		$( ".addproduct .copyspan:eq(" + i + ")" ).attr("id","copyspan" + k );
<?php  if (($role=='manufacturer' && $mf_role == 'distributor') || $role=="distributor") {?>
		$( ".product-distributor-price-incl-gst:eq(" + i + ")" ).attr("id","product" + j + "-distributor-price-incl-gst");
		$( ".product-input-distributor-price-incl-gst:eq(" + i + ")" ).attr("id","product" + j + "-distributor-price-incl-gst").attr("name","product" + j + "-distributor-price-incl-gst");
		$( ".product-distributor-sell-price:eq(" + i + ")" ).attr("id","product" + j + "-distributor-sell-price");
		$( ".product-distributor-profit:eq(" + i + ")" ).attr("id","product" + j + "-distributor-profit");
		$( ".product-emergency-window:eq(" + i + ")" ).attr("id","product" + j + "-emergency-window").attr("name","product" + j + "-emergency-window");
<?php } if (($role=='manufacturer' && $mf_role == 'wholesaler') || $role=="wholesaler") {?>
		$( ".product-wholesaler-price-incl-gst:eq(" + i + ")" ).attr("id","product" + j + "-wholesaler-price-incl-gst");
		$( ".product-input-wholesaler-price-incl-gst:eq(" + i + ")" ).attr("id","product" + j + "-wholesaler-price-incl-gst").attr("name","product" + j + "-wholesaler-price-incl-gst");
		$( ".product-wholesaler-sell-price:eq(" + i + ")" ).attr("id","product" + j + "-wholesaler-sell-price");
		$( ".product-wholesaler-profit:eq(" + i + ")" ).attr("id","product" + j + "-wholesaler-profit");
		$( ".product-emergency-window:eq(" + i + ")" ).attr("id","product" + j + "-emergency-window").attr("name","product" + j + "-emergency-window");
<?php } if (($role=='manufacturer' && $mf_role == 'retailer') || $role=="retailer") {?>
		$( ".product-retail-price-incl-gst:eq(" + i + ")" ).attr("id","product" + j + "-retail-price-incl-gst");
		$( ".product-input-retail-price-incl-gst:eq(" + i + ")" ).attr("id","product" + j + "-retail-price-incl-gst").attr("name","product" + j + "-retail-price-incl-gst");
		$( ".product-retail-sell-price:eq(" + i + ")" ).attr("id","product" + j + "-retail-sell-price");
		$( ".product-retail-profit:eq(" + i + ")" ).attr("id","product" + j + "-retail-profit");
		$( ".product-emergency-window:eq(" + i + ")" ).attr("id","product" + j + "-emergency-window").attr("name","product" + j + "-emergency-window");
<?php } ?>
	}	
}

$( ".delete" ).on( "click", function() {
	var emptyRow = '<tr style="display:none;" class="product" id="product30"><td><input class="product-item-number" id="product30-item-number" name="product30-item-number" style="width:30px;" /></td><td><select class="product-quantity-of-panels" id="product30-quantity-of-panels" name="product30-quantity-of-panels" style="width:40px;"><option></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select></td><td><select class="product-security-dgrille-fibre" id="product30-security-dgrille-fibre" name="product30-security-dgrille-fibre"><option></option><option value="security">Security</option><option value="dgrille">D/Grille</option><option value="fibre">Fibre</option></select></td><td><select class="product-316-ss-gal-pet" id="product30-316-ss-gal-pet" name="product30-316-ss-gal-pet"><option></option><option>316 S/S</option><option>Insect</option><option>Pet</option></select></td><td><select class="product-window-or-door" id="product30-window-or-door" name="product30-window-or-door"><option></option><option value="window">Window</option><option value="door">Door</option></select></td><td><select class="product-window-frame-type" id="product30-window-frame-type" name="product30-window-frame-type"><option></option><option value="9mm">9mm</option><option value="11mm">11mm</option></select></td><td><select class="product-configuration" id="product30-configuration" name="product30-configuration"><option></option><?php foreach ($configurations as $configuration) { echo '<option>'.$configuration->name.'</option>';	} ?></select></td><td><input class="product-location-in-building" style="width:100px; padding:1px 5px;" value="" id="product30-location-in-building" name="product30-location-in-building" /></td><td><input class="product-height" style="width:40px; padding:1px 5px;" value="" id="product30-height" name="product30-height" /></td><td><input class="widthupdate product-width" style="width:40px; padding:1px 5px;" value="" id="product30-width" name="product30-width" /></td><td><select class="product-number-of-locks" style="width:40px;" id="product30-number-of-locks" name="product30-number-of-locks"><option></option><option>-</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select></td><td><select class="product-lock-type" id="product30-lock-type" name="product30-lock-type"><option></option><option>-</option><option>Single</option><option>Trple Hngd</option><option>Trple Sldng</option></select></td><td><input class="product-lock-handle-height" style="width:40px; padding:1px 5px;" value="" id="product30-lock-handle-height" name="product30-lock-handle-height" /></td><td style="padding: 0 !important;"><a class="delete" href="#">X</a></td></tr><?php if (($role=='manufacturer' && $mf_role == 'distributor') || $role=="distributor") {?><tr style="display:none;" class="prices" id="prices30"><td colspan="14"><div class="value-holder">Dist.:<span id="product30-distributor-price-incl-gst" class="product-distributor-price-incl-gst"></span><input class="product-input-distributor-price-incl-gst" id="product30-distributor-price-incl-gst" name ="product30-distributor-price-incl-gst" style="display:none; width:50px;" /></div><div class="value-holder">Sell:<span id="product30-distributor-sell-price" class="product-distributor-sell-price"></span></div><div class="value-holder">Profit:<span id="product30-distributor-profit" class="product-distributor-profit"></span></div><div class="value-holder ee-holder"><span class="ee">Emergency Exit Window <input type="checkbox" id="product30-emergency-window" name="product30-emergency-window" class="product-emergency-window" value="1" /></span></div></td></tr><?php } if (($role=='manufacturer' && $mf_role == 'wholesaler') || $role=="wholesaler") {?><tr style="display:none;" class="prices" id="prices30"><td colspan="14"><div class="value-holder">Whsle.:<span id="product30-wholesaler-price-incl-gst" class="product-wholesaler-price-incl-gst"> </span><input class="product-input-wholesaler-price-incl-gst" id="product30-wholesaler-price-incl-gst" name="product30-wholesaler-price-incl-gst" style="display:none; width:50px;"/></div><div class="value-holder">Sell:<span id="product30-wholesaler-sell-price" class="product-wholesaler-sell-price"></span></div><div class="value-holder">Profit:<span id="product30-wholesaler-profit" class="product-wholesaler-profit"></span></div><div class="value-holder ee-holder"><span class="ee">Emergency Exit Window <input type="checkbox" id="product30-emergency-window" name="product30-emergency-window" class="product-emergency-window" value="1" /></span></div></td></tr><?php } if (($role=='manufacturer' && $mf_role == 'retailer') || $role=="retailer") {?><tr style="display:none;" class="prices" id="prices30"><td colspan="14"><div class="value-holder">Ret.:<span id="product30-retail-price-incl-gst" class="product-retail-price-incl-gst"></span><input class="product-input-retail-price-incl-gst" id="product30-retail-price-incl-gst" name="product30-retail-price-incl-gst" style="display:none; width:50px;" /></div><div class="value-holder">Sell:<span id="product30-retail-sell-price" class="product-retail-sell-price"></span></div><div class="value-holder">Profit:<span id="product30-retail-profit" class="product-retail-profit"></span></div><div class="value-holder ee-holder"><span class="ee">Emergency Exit Window <input type="checkbox" id="product30-emergency-window" name="product30-emergency-window" class="product-emergency-window" value="1" /></span></div></td></tr><?php } ?><tr class="addproduct" id="add31"><td colspan="14"><span class="addspan" id="addspan31">Add next item</span><span class="copyspan" id="copyspan31">Copy above line</span></td></tr>';
	if ($( this ).parent().parent().next().next().attr('style')=='display: table-row;') {var lastVisible=1;}
	$( this ).parent().parent().next().remove();	
	$( this ).parent().parent().next().remove();
	if(lastVisible==1){
		$( this ).parent().parent().prev().show().next().remove();
	}
	else{
		$( this ).parent().parent().remove();
	}
	$(emptyRow).insertAfter($('.addproduct#add30'));
	resortIds();	
	$("#product1-item-number").trigger("change");
});


$( ".addproduct .addspan" ).on( "click", function() {$(this).parent().parent().hide().next().show().next().show().next().show();});
$( ".addproduct .copyspan" ).on( "click", function() {
$( this ).parent().parent().hide().next().show().next().show().next().show();
$( this ).parent().parent().next().find(".product-item-number" ).val($( this ).parent().parent().prev().prev().find(".product-item-number" ).val());
$( this ).parent().parent().next().find(".product-quantity-of-panels" ).val($( this ).parent().parent().prev().prev().find(".product-quantity-of-panels" ).val());
$( this ).parent().parent().next().find(".product-security-dgrille-fibre" ).val($( this ).parent().parent().prev().prev().find(".product-security-dgrille-fibre" ).val());
$( this ).parent().parent().next().find(".product-316-ss-gal-pet" ).val($( this ).parent().parent().prev().prev().find(".product-316-ss-gal-pet" ).val());
$( this ).parent().parent().next().find(".product-window-or-door" ).val($( this ).parent().parent().prev().prev().find(".product-window-or-door" ).val());
$( this ).parent().parent().next().find(".product-window-frame-type" ).val($( this ).parent().parent().prev().prev().find(".product-window-frame-type" ).val());
$( this ).parent().parent().next().find(".product-configuration" ).val($( this ).parent().parent().prev().prev().find(".product-configuration" ).val());
$( this ).parent().parent().next().find(".product-location-in-building" ).val($( this ).parent().parent().prev().prev().find(".product-location-in-building" ).val());
$( this ).parent().parent().next().find(".product-height" ).val($( this ).parent().parent().prev().prev().find(".product-height" ).val());
$( this ).parent().parent().next().find(".product-width" ).val($( this ).parent().parent().prev().prev().find(".product-width" ).val());
$( this ).parent().parent().next().find(".product-number-of-locks" ).val($( this ).parent().parent().prev().prev().find(".product-number-of-locks" ).val());
$( this ).parent().parent().next().find(".product-lock-type" ).val($( this ).parent().parent().prev().prev().find(".product-lock-type" ).val());
$( this ).parent().parent().next().find(".product-lock-handle-height" ).val($( this ).parent().parent().prev().prev().find(".product-lock-handle-height" ).val());
$( this ).parent().parent().next().find(".product-window-or-door" ).val($( this ).parent().parent().prev().prev().find(".product-window-or-door" ).val());
$( this ).parent().parent().next().find(".product-window-or-door" ).trigger("change");
});

<?php
$m = 11;
for($i = 5; $i<$m; $i++){ ?>
$( "#add-meter<?php echo $i+1; ?> #addspan<?php echo $i+1; ?>" ).on( "click", function() {$( "#additional<?php echo $i+1; ?>" ).show('slow');$( "#add-meter<?php echo $i+1; ?>" ).hide();$( "#add-meter<?php echo $i+2; ?>" ).show();});
$( "#add-meter<?php echo $i+1; ?> #removespan<?php echo $i+1; ?>" ).on( "click", function() {$( "#additional<?php echo $i; ?> :input" ).val("");$( "#additional<?php echo $i; ?>" ).hide();$( "#add-meter<?php echo $i+1; ?>" ).hide();$( "#add-meter<?php echo $i; ?>" ).show(); $("#product1-item-number").trigger("change");});
<?php } 
$m = 11;
for($i = 3; $i<$m; $i++){ ?>
$( "#add-custom<?php echo $i+1; ?> #addspan<?php echo $i+1; ?>" ).on( "click", function() {$( "#custom<?php echo $i+1; ?>" ).show('slow');$( "#add-custom<?php echo $i+1; ?>" ).hide();$( "#add-custom<?php echo $i+2; ?>" ).show();});
$( "#add-custom<?php echo $i+1; ?> #removespan<?php echo $i+1; ?>" ).on( "click", function() {$( "#custom<?php echo $i; ?> :text" ).val("");$( "#custom<?php echo $i; ?> :checkbox" ).prop('checked',false);$( "#custom<?php echo $i; ?>" ).hide();$( "#add-custom<?php echo $i+1; ?>" ).hide();$( "#add-custom<?php echo $i; ?>" ).show(); $("#product1-item-number").trigger("change");});
<?php } ?>
$( "#addmr2 #addspanmr2" ).on( "click", function() {$( "#mr2" ).show('slow');$( "#prices-mr2" ).show('slow');$( "#addmr2" ).hide();$( "#addmr3" ).show();});
$( "#addmr3 #addspanmr3" ).on( "click", function() {$( "#mr3" ).show('slow');$( "#prices-mr3" ).show('slow');$( "#addmr3" ).hide();$( "#addmr4" ).show();});
$( "#addmr4 #addspanmr4" ).on( "click", function() {$( "#mr4" ).show('slow');$( "#prices-mr4" ).show('slow');$( "#addmr4" ).hide();$( "#addmr5" ).show();});
$( "#addmr3 #removespanmr3" ).on( "click", function() {$( "#mr2 :input" ).val(""); $( "#mr2" ).hide();$( "#prices-mr2" ).hide();$( "#addmr3" ).hide();$( "#addmr2" ).show(); $("#product1-item-number").trigger("change");});
$( "#addmr4 #removespanmr4" ).on( "click", function() {$( "#mr3 :input" ).val(""); $( "#mr3" ).hide();$( "#prices-mr3" ).hide();$( "#addmr4" ).hide();$( "#addmr3" ).show(); $("#product1-item-number").trigger("change");});
<?php if($midrails3_quantity!='0'){ ?>
$( "#addmr4" ).show();
<?php } ?>

var installationType ;
var installationWindowDoor;
$( "#yes-installation" ).on( "click", function() { 
	$("#additional1-name").trigger("change");
	$("#product1-item-number").trigger("change");
});
$( "#ui-accordion-accordion-header-4" ).on( "click, ctrigger", function() {
var installationCost = 0;
<?php for($i = 1; $i<$j; $i++){ ?>
installationType = $("#product<?php echo $i; ?>-security-dgrille-fibre").val() ;
installationWindowDoor = $("#product<?php echo $i; ?>-window-or-door").val() ;
if ($("#product<?php echo $i; ?>-quantity-of-panels").val()>0) {
if( installationType == "fibre" && installationWindowDoor == "window") { installationCost = installationCost + (10*$("#product<?php echo $i; ?>-quantity-of-panels").val());}
if( installationType == "fibre" && installationWindowDoor == "door") { installationCost = installationCost + (25*$("#product<?php echo $i; ?>-quantity-of-panels").val());}
if( (installationType == "dgrille" || installationType == "security") && installationWindowDoor == "window") { installationCost = installationCost + (25*$("#product<?php echo $i; ?>-quantity-of-panels").val());}
if( (installationType == "dgrille" || installationType == "security") && installationWindowDoor == "door") { installationCost = installationCost + (55*$("#product<?php echo $i; ?>-quantity-of-panels").val());}
}
<?php } ?>
$( "#standard-installation-amount" ).html(installationCost);
if ($("#yes-installation").is(':checked')) {
	$( "#total-installation-cost" ).html(Number($( "#standard-installation-amount" ).html())+Number($( "#additional-installation-amount" ).val()));
	$( "input#total-installation-cost, .installation-total-cost" ).val(Number($( "#standard-installation-amount" ).html())+Number($( "#additional-installation-amount" ).val()));
}
if ($("#no-installation").is(':checked')) {
	$( "#total-installation-cost" ).html("0");
	$( "input#total-installation-cost, .installation-total-cost" ).val("0");
}});
$( "#no-installation" ).on( "click", function() { 
	$("#additional1-name").trigger("change");
	$( "#total-installation-cost" ).html("0");
});

$( "#additional-installation-amount" ).on( "change", function() { 
if ($("#yes-installation").is(':checked')) {
	$( "#total-installation-cost" ).html(Number($( "#standard-installation-amount" ).html())+Number($( "#additional-installation-amount" ).val()));
	$("#additional1-name").trigger("change");
}
if ($("#no-installation").is(':checked')) {
	$( "#total-installation-cost" ).html("0");
}});
$( "#freight-cost" ).on( "change", function() { 
	$("#additional1-name").trigger("change");
});
//	http://stackoverflow.com/questions/2675317/jquery-getting-the-second-level-parent-of-an-element 
//	http://stackoverflow.com/questions/1643227/get-selected-text-from-dropdownlist-using-jquery
//	http://stackoverflow.com/questions/986120/how-to-get-the-value-of-a-selected-radio-button-using-its-name-in-jquery
//	http://stackoverflow.com/questions/6654601/jquery-if-radio-button-is-checked

$( ".additional-per-meter, .additional-name" ).on( "change", function() { 
if ($(this).parent().parent().find(".additional-name").val()==''){$(this).parent().parent().find(".additional-price").val("");}	
<?php 
$args = array( 'post_type' => 'parts', 'posts_per_page' => 1000 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
if(get_post_meta($post->ID, 'wpcf-show-in-additional-dropdown', true) == '1' || 
get_post_meta($post->ID, 'wpcf-show-in-additional-length-dropdown', true) == '1' ){
echo 'if ($(this).parent().parent().find(".additional-name").val()=="'.get_the_content().'"){$(this).parent().parent().find(".additional-price").val(("'.get_post_meta($post->ID, 'wpcf-price-per-unit', true).'" * $(this).parent().parent().find(".additional-per-meter").val()).toFixed(2));}';
}
endwhile;
?>
});
$( ".accessory-name, .accessory-each" ).on( "change", function() { 
if ($(this).val()==''){$(this).parent().parent().find(".accessory-price").val("");}	
<?php 
$args = array( 'post_type' => 'parts', 'posts_per_page' => 1000 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
if(get_post_meta($post->ID, 'wpcf-show-in-accessories-dropdown', true) == '1' ){
echo 'if ($(this).parent().parent().find(".accessory-name").val()=="'.get_the_content().'"){$(this).parent().parent().find(".accessory-price").val(("'.get_post_meta($post->ID, 'wpcf-price-per-unit', true).'" * $(this).parent().parent().find(".accessory-each").val()).toFixed(2));}';
}
endwhile;
?>
});
$( "#calculate" ).on( "click", function() {

<?php // **************************MR-SD***************************?>

$( "#mc-sd-mr-width" ).html(Number($("#mr-width").val()));
$( "#mc-sd-mr-lm" ).html(Number($("#mc-sd-mr-width").html())/1000);
$( "#mc-sd-mr-item-1" ).html(Number($("#mc-list-25").html()));
$( "#mc-sd-mr-item-2" ).html(Number($("#mc-list-26").html()));
$( "#mc-sd-mr-item-3" ).html(Number($("#mc-list-7").html()));

$( "#mc-sd-mr-item-1-calculated" ).html((Number($("#mc-sd-mr-item-1").html())*$( "#mc-sd-mr-lm" ).html()).toFixed(2));
$( "#mc-sd-mr-item-2-calculated" ).html((Number($("#mc-sd-mr-item-2").html())*$( "#mc-sd-mr-lm" ).html()).toFixed(2));
$( "#mc-sd-mr-item-3-calculated" ).html((Number($("#mc-sd-mr-item-3").html())*$( "#mc-sd-mr-lm" ).html()*2).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-sd-mr-pwd-coat-spec-1").html(((Number($("#mc-sd-mr-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-sd-mr-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-sd-mr-pwd-coat-spec-2" ).html(((Number($("#mc-sd-mr-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-sd-mr-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-sd-mr-pwd-coat-spec-3" ).html(((Number($("#mc-sd-mr-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-sd-mr-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-sd-mr-pwd-coat-spec-4" ).html(((Number($("#mc-sd-mr-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-sd-mr-pwd-coat-spec-4").html('0.00');}

$( "#mc-sd-mr-material-cost" ).html(
(Number($("#mc-sd-mr-pwd-coat-spec-1").html())+
Number($("#mc-sd-mr-pwd-coat-spec-2").html())+
Number($("#mc-sd-mr-pwd-coat-spec-3").html())+
Number($("#mc-sd-mr-pwd-coat-spec-4").html())+
Number($( "#mc-sd-mr-consumables" ).html())+
Number($( "#mc-sd-mr-item-1-calculated" ).html())+
Number($( "#mc-sd-mr-item-2-calculated" ).html())+
Number($( "#mc-sd-mr-item-3-calculated" ).html())).toFixed(2));

$( "#mc-sd-mr-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-5").html())/60*$("#mc-sd-mr-time-allocated-min").html());
$( "#mc-sd-mr-total-cost" ).html((Number($("#mc-sd-mr-labour-incl-cutting").html())+Number($("#mc-sd-mr-material-cost").html())).toFixed(2));
$( "#mc-sd-mr-cost-markedup" ).html((
(Number($("#mc-sd-mr-total-cost").html())*
Number($("#mc-sd-mr-markup").html())/100) +
Number($("#mc-sd-mr-total-cost").html())).toFixed(2));



<?php // **************************MR-SW***************************?>
$( "#mc-sw-mr-width" ).html(Number($("#mr-width").val()));
$( "#mc-sw-mr-lm" ).html(Number($("#mc-sw-mr-width").html())/1000);
$( "#mc-sw-mr-item-1" ).html(Number($("#mc-list-25").html()));
$( "#mc-sw-mr-item-2" ).html(Number($("#mc-list-26").html()));
$( "#mc-sw-mr-item-3" ).html(Number($("#mc-list-7").html()));

$( "#mc-sw-mr-item-1-calculated" ).html((Number($("#mc-sw-mr-item-1").html())*$( "#mc-sw-mr-lm" ).html()).toFixed(2));
$( "#mc-sw-mr-item-2-calculated" ).html((Number($("#mc-sw-mr-item-2").html())*$( "#mc-sw-mr-lm" ).html()).toFixed(2));
$( "#mc-sw-mr-item-3-calculated" ).html((Number($("#mc-sw-mr-item-3").html())*$( "#mc-sw-mr-lm" ).html()*2).toFixed(2));


if ($( "#color1:checked" ).length==1){	$("#mc-sw-mr-pwd-coat-spec-1").html(((Number($("#mc-sw-mr-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-sw-mr-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-sw-mr-pwd-coat-spec-2" ).html(((Number($("#mc-sw-mr-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-sw-mr-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-sw-mr-pwd-coat-spec-3" ).html(((Number($("#mc-sw-mr-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-sw-mr-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-sw-mr-pwd-coat-spec-4" ).html(((Number($("#mc-sw-mr-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-sw-mr-pwd-coat-spec-4").html('0.00');}

$( "#mc-sw-mr-material-cost" ).html(
(Number($("#mc-sw-mr-pwd-coat-spec-1").html())+
Number($("#mc-sw-mr-pwd-coat-spec-2").html())+
Number($("#mc-sw-mr-pwd-coat-spec-3").html())+
Number($("#mc-sw-mr-pwd-coat-spec-4").html())+
Number($( "#mc-sw-mr-consumables" ).html())+
Number($( "#mc-sw-mr-item-1-calculated" ).html())+
Number($( "#mc-sw-mr-item-2-calculated" ).html())+
Number($( "#mc-sw-mr-item-3-calculated" ).html())).toFixed(2));

$( "#mc-sw-mr-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-5").html())/60*$("#mc-sw-mr-time-allocated-min").html());
$( "#mc-sw-mr-total-cost" ).html((Number($("#mc-sw-mr-labour-incl-cutting").html())+Number($("#mc-sw-mr-material-cost").html())).toFixed(2));
$( "#mc-sw-mr-cost-markedup" ).html((
(Number($("#mc-sw-mr-total-cost").html())*
Number($("#mc-sw-mr-markup").html())/100) +
Number($("#mc-sw-mr-total-cost").html())).toFixed(2));

<?php // **************************MR-DD***************************?>

$( "#mc-dd-mr-width" ).html(Number($("#mr-width").val()));
$( "#mc-dd-mr-lm" ).html(Number($("#mc-dd-mr-width").html())/1000);
$( "#mc-dd-mr-item-1" ).html(Number($("#mc-list-25").html()));
$( "#mc-dd-mr-item-2" ).html(Number($("#mc-list-26").html()));
$( "#mc-dd-mr-item-3" ).html(Number($("#mc-list-27").html()));

$( "#mc-dd-mr-item-1-calculated" ).html((Number($("#mc-dd-mr-item-1").html())*$( "#mc-dd-mr-lm" ).html()).toFixed(2));
$( "#mc-dd-mr-item-2-calculated" ).html((Number($("#mc-dd-mr-item-2").html())*$( "#mc-dd-mr-lm" ).html()).toFixed(2));
$( "#mc-dd-mr-item-3-calculated" ).html((Number($("#mc-dd-mr-item-3").html())*$( "#mc-dd-mr-lm" ).html()).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-dd-mr-pwd-coat-spec-1").html(((Number($("#mc-dd-mr-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-dd-mr-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-dd-mr-pwd-coat-spec-2" ).html(((Number($("#mc-dd-mr-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-dd-mr-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-dd-mr-pwd-coat-spec-3" ).html(((Number($("#mc-dd-mr-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-dd-mr-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-dd-mr-pwd-coat-spec-4" ).html(((Number($("#mc-dd-mr-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-dd-mr-pwd-coat-spec-4").html('0.00');}

$( "#mc-dd-mr-material-cost" ).html(
(Number($("#mc-dd-mr-pwd-coat-spec-1").html())+
Number($("#mc-dd-mr-pwd-coat-spec-2").html())+
Number($("#mc-dd-mr-pwd-coat-spec-3").html())+
Number($("#mc-dd-mr-pwd-coat-spec-4").html())+
Number($( "#mc-dd-mr-consumables" ).html())+
Number($( "#mc-dd-mr-item-1-calculated" ).html())+
Number($( "#mc-dd-mr-item-2-calculated" ).html())+
Number($( "#mc-dd-mr-item-3-calculated" ).html())).toFixed(2));

$( "#mc-dd-mr-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-3").html())/60*$("#mc-dd-mr-time-allocated-min").html());
$( "#mc-dd-mr-total-cost" ).html((Number($("#mc-dd-mr-labour-incl-cutting").html())+Number($("#mc-dd-mr-material-cost").html())).toFixed(2));
$( "#mc-dd-mr-cost-markedup" ).html((
(Number($("#mc-dd-mr-total-cost").html())*
Number($("#mc-dd-mr-markup").html())/100) +
Number($("#mc-dd-mr-total-cost").html())).toFixed(2));

<?php // **************************MR-DW***************************?>

$( "#mc-dw-mr-width" ).html(Number($("#mr-width").val()));
$( "#mc-dw-mr-lm" ).html(Number($("#mc-dw-mr-width").html())/1000);
$( "#mc-dw-mr-item-1" ).html(Number($("#mc-list-25").html()));
$( "#mc-dw-mr-item-2" ).html(Number($("#mc-list-26").html()));
$( "#mc-dw-mr-item-3" ).html(Number($("#mc-list-27").html()));

$( "#mc-dw-mr-item-1-calculated" ).html((Number($("#mc-dw-mr-item-1").html())*$( "#mc-dw-mr-lm" ).html()).toFixed(2));
$( "#mc-dw-mr-item-2-calculated" ).html((Number($("#mc-dw-mr-item-2").html())*$( "#mc-dw-mr-lm" ).html()).toFixed(2));
$( "#mc-dw-mr-item-3-calculated" ).html((Number($("#mc-dw-mr-item-3").html())*$( "#mc-dw-mr-lm" ).html()).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-dw-mr-pwd-coat-spec-1").html(((Number($("#mc-dw-mr-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-dw-mr-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-dw-mr-pwd-coat-spec-2" ).html(((Number($("#mc-dw-mr-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-dw-mr-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-dw-mr-pwd-coat-spec-3" ).html(((Number($("#mc-dw-mr-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-dw-mr-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-dw-mr-pwd-coat-spec-4" ).html(((Number($("#mc-dw-mr-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-dw-mr-pwd-coat-spec-4").html('0.00');}

$( "#mc-dw-mr-material-cost" ).html(
(Number($("#mc-dw-mr-pwd-coat-spec-1").html())+
Number($("#mc-dw-mr-pwd-coat-spec-2").html())+
Number($("#mc-dw-mr-pwd-coat-spec-3").html())+
Number($("#mc-dw-mr-pwd-coat-spec-4").html())+
Number($( "#mc-dw-mr-consumables" ).html())+
Number($( "#mc-dw-mr-item-1-calculated" ).html())+
Number($( "#mc-dw-mr-item-2-calculated" ).html())+
Number($( "#mc-dw-mr-item-3-calculated" ).html())).toFixed(2));

$( "#mc-dw-mr-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-5").html())/60*$("#mc-dw-mr-time-allocated-min").html());
$( "#mc-dw-mr-total-cost" ).html((Number($("#mc-dw-mr-labour-incl-cutting").html())+Number($("#mc-dw-mr-material-cost").html())).toFixed(2));
$( "#mc-dw-mr-cost-markedup" ).html((
(Number($("#mc-dw-mr-total-cost").html())*
Number($("#mc-dw-mr-markup").html())/100) +
Number($("#mc-dw-mr-total-cost").html())).toFixed(2));

<?php // **************************MR-FD***************************?>

$( "#mc-fd-mr-width" ).html(Number($("#mr-width").val()));
$( "#mc-fd-mr-lm" ).html(Number($("#mc-fd-mr-width").html())/1000);
$( "#mc-fd-mr-item-1" ).html(Number($("#mc-list-3").html()));
$( "#mc-fd-mr-item-2" ).html(Number($("#mc-list-5").html()));
$( "#mc-fd-mr-item-3" ).html(Number($("#mc-list-27").html()));

$( "#mc-fd-mr-item-1-calculated" ).html((Number($("#mc-fd-mr-item-1").html())*$( "#mc-fd-mr-lm" ).html()).toFixed(2));
$( "#mc-fd-mr-item-2-calculated" ).html((Number($("#mc-fd-mr-item-2").html())*2).toFixed(2));
$( "#mc-fd-mr-item-3-calculated" ).html((Number($("#mc-fd-mr-item-3").html())*$( "#mc-fd-mr-lm" ).html()*2).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-fd-mr-pwd-coat-spec-1").html(((Number($("#mc-fd-mr-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-fd-mr-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-fd-mr-pwd-coat-spec-2" ).html(((Number($("#mc-fd-mr-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-fd-mr-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-fd-mr-pwd-coat-spec-3" ).html(((Number($("#mc-fd-mr-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-fd-mr-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-fd-mr-pwd-coat-spec-4" ).html(((Number($("#mc-fd-mr-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-fd-mr-pwd-coat-spec-4").html('0.00');}

$( "#mc-fd-mr-material-cost" ).html(
(Number($("#mc-fd-mr-pwd-coat-spec-1").html())+
Number($("#mc-fd-mr-pwd-coat-spec-2").html())+
Number($("#mc-fd-mr-pwd-coat-spec-3").html())+
Number($("#mc-fd-mr-pwd-coat-spec-4").html())+
Number($( "#mc-fd-mr-consumables" ).html())+
Number($( "#mc-fd-mr-item-1-calculated" ).html())+
Number($( "#mc-fd-mr-item-2-calculated" ).html())+
Number($( "#mc-fd-mr-item-3-calculated" ).html())).toFixed(2));

$( "#mc-fd-mr-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-5").html())/60*$("#mc-fd-mr-time-allocated-min").html());
$( "#mc-fd-mr-total-cost" ).html((Number($("#mc-fd-mr-labour-incl-cutting").html())+Number($("#mc-fd-mr-material-cost").html())).toFixed(2));
$( "#mc-fd-mr-cost-markedup" ).html((
(Number($("#mc-fd-mr-total-cost").html())*
Number($("#mc-fd-mr-markup").html())/100) +
Number($("#mc-fd-mr-total-cost").html())).toFixed(2));



<?php // **************************MR-FW***************************?>

$( "#mc-fw-mr-width" ).html(Number($("#mr-width").val()));
$( "#mc-fw-mr-lm" ).html(Number($("#mc-fw-mr-width").html())/1000);
$( "#mc-fw-mr-item-1" ).html(Number($("#mc-list-29").html()));
$( "#mc-fw-mr-item-2" ).html("0.1");
$( "#mc-fw-mr-item-3" ).html(Number($("#mc-list-30").html()));

$( "#mc-fw-mr-item-1-calculated" ).html((Number($("#mc-fw-mr-item-1").html())*$( "#mc-fw-mr-lm" ).html()).toFixed(2));
$( "#mc-fw-mr-item-2-calculated" ).html((Number($("#mc-fw-mr-item-2").html())*2).toFixed(2));
$( "#mc-fw-mr-item-3-calculated" ).html((Number($("#mc-fw-mr-item-3").html())*$( "#mc-fw-mr-lm" ).html()*2).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-fw-mr-pwd-coat-spec-1").html(((Number($("#mc-fw-mr-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-fw-mr-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-fw-mr-pwd-coat-spec-2" ).html(((Number($("#mc-fw-mr-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-fw-mr-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-fw-mr-pwd-coat-spec-3" ).html(((Number($("#mc-fw-mr-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-fw-mr-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-fw-mr-pwd-coat-spec-4" ).html(((Number($("#mc-fw-mr-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-fw-mr-pwd-coat-spec-4").html('0.00');}

$( "#mc-fw-mr-material-cost" ).html(
(Number($("#mc-fw-mr-pwd-coat-spec-1").html())+
Number($("#mc-fw-mr-pwd-coat-spec-2").html())+
Number($("#mc-fw-mr-pwd-coat-spec-3").html())+
Number($("#mc-fw-mr-pwd-coat-spec-4").html())+
Number($( "#mc-fw-mr-consumables" ).html())+
Number($( "#mc-fw-mr-item-1-calculated" ).html())+
Number($( "#mc-fw-mr-item-2-calculated" ).html())+
Number($( "#mc-fw-mr-item-3-calculated" ).html())).toFixed(2));

$( "#mc-fw-mr-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-5").html())/60*$("#mc-fw-mr-time-allocated-min").html());
$( "#mc-fw-mr-total-cost" ).html((Number($("#mc-fw-mr-labour-incl-cutting").html())+Number($("#mc-fw-mr-material-cost").html())).toFixed(2));
$( "#mc-fw-mr-cost-markedup" ).html((
(Number($("#mc-fw-mr-total-cost").html())*
Number($("#mc-fw-mr-markup").html())/100) +
Number($("#mc-fw-mr-total-cost").html())).toFixed(2));

<?php // **************************MR2-SD***************************?>

$( "#mc-sd-mr2-width" ).html(Number($("#mr2-width").val()));
$( "#mc-sd-mr2-lm" ).html(Number($("#mc-sd-mr2-width").html())/1000);
$( "#mc-sd-mr2-item-1" ).html(Number($("#mc-list-25").html()));
$( "#mc-sd-mr2-item-2" ).html(Number($("#mc-list-26").html()));
$( "#mc-sd-mr2-item-3" ).html(Number($("#mc-list-7").html()));

$( "#mc-sd-mr2-item-1-calculated" ).html((Number($("#mc-sd-mr2-item-1").html())*$( "#mc-sd-mr2-lm" ).html()).toFixed(2));
$( "#mc-sd-mr2-item-2-calculated" ).html((Number($("#mc-sd-mr2-item-2").html())*$( "#mc-sd-mr2-lm" ).html()).toFixed(2));
$( "#mc-sd-mr2-item-3-calculated" ).html((Number($("#mc-sd-mr2-item-3").html())*$( "#mc-sd-mr2-lm" ).html()*2).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-sd-mr2-pwd-coat-spec-1").html(((Number($("#mc-sd-mr2-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-sd-mr2-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-sd-mr2-pwd-coat-spec-2" ).html(((Number($("#mc-sd-mr2-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-sd-mr2-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-sd-mr2-pwd-coat-spec-3" ).html(((Number($("#mc-sd-mr2-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-sd-mr2-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-sd-mr2-pwd-coat-spec-4" ).html(((Number($("#mc-sd-mr2-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-sd-mr2-pwd-coat-spec-4").html('0.00');}

$( "#mc-sd-mr2-material-cost" ).html(
(Number($("#mc-sd-mr2-pwd-coat-spec-1").html())+
Number($("#mc-sd-mr2-pwd-coat-spec-2").html())+
Number($("#mc-sd-mr2-pwd-coat-spec-3").html())+
Number($("#mc-sd-mr2-pwd-coat-spec-4").html())+
Number($( "#mc-sd-mr2-consumables" ).html())+
Number($( "#mc-sd-mr2-item-1-calculated" ).html())+
Number($( "#mc-sd-mr2-item-2-calculated" ).html())+
Number($( "#mc-sd-mr2-item-3-calculated" ).html())).toFixed(2));

$( "#mc-sd-mr2-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-5").html())/60*$("#mc-sd-mr2-time-allocated-min").html());
$( "#mc-sd-mr2-total-cost" ).html((Number($("#mc-sd-mr2-labour-incl-cutting").html())+Number($("#mc-sd-mr2-material-cost").html())).toFixed(2));
$( "#mc-sd-mr2-cost-markedup" ).html((
(Number($("#mc-sd-mr2-total-cost").html())*
Number($("#mc-sd-mr2-markup").html())/100) +
Number($("#mc-sd-mr2-total-cost").html())).toFixed(2));

<?php // **************************MR2-SW***************************?>

$( "#mc-sw-mr2-width" ).html(Number($("#mr2-width").val()));
$( "#mc-sw-mr2-lm" ).html(Number($("#mc-sw-mr2-width").html())/1000);
$( "#mc-sw-mr2-item-1" ).html(Number($("#mc-list-25").html()));
$( "#mc-sw-mr2-item-2" ).html(Number($("#mc-list-26").html()));
$( "#mc-sw-mr2-item-3" ).html(Number($("#mc-list-7").html()));

$( "#mc-sw-mr2-item-1-calculated" ).html((Number($("#mc-sw-mr2-item-1").html())*$( "#mc-sw-mr2-lm" ).html()).toFixed(2));
$( "#mc-sw-mr2-item-2-calculated" ).html((Number($("#mc-sw-mr2-item-2").html())*$( "#mc-sw-mr2-lm" ).html()).toFixed(2));
$( "#mc-sw-mr2-item-3-calculated" ).html((Number($("#mc-sw-mr2-item-3").html())*$( "#mc-sw-mr2-lm" ).html()*2).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-sw-mr2-pwd-coat-spec-1").html(((Number($("#mc-sw-mr2-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-sw-mr2-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-sw-mr2-pwd-coat-spec-2" ).html(((Number($("#mc-sw-mr2-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-sw-mr2-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-sw-mr2-pwd-coat-spec-3" ).html(((Number($("#mc-sw-mr2-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-sw-mr2-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-sw-mr2-pwd-coat-spec-4" ).html(((Number($("#mc-sw-mr2-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-sw-mr2-pwd-coat-spec-4").html('0.00');}

$( "#mc-sw-mr2-material-cost" ).html(
(Number($("#mc-sw-mr2-pwd-coat-spec-1").html())+
Number($("#mc-sw-mr2-pwd-coat-spec-2").html())+
Number($("#mc-sw-mr2-pwd-coat-spec-3").html())+
Number($("#mc-sw-mr2-pwd-coat-spec-4").html())+
Number($( "#mc-sw-mr2-consumables" ).html())+
Number($( "#mc-sw-mr2-item-1-calculated" ).html())+
Number($( "#mc-sw-mr2-item-2-calculated" ).html())+
Number($( "#mc-sw-mr2-item-3-calculated" ).html())).toFixed(2));

$( "#mc-sw-mr2-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-5").html())/60*$("#mc-sw-mr2-time-allocated-min").html());
$( "#mc-sw-mr2-total-cost" ).html((Number($("#mc-sw-mr2-labour-incl-cutting").html())+Number($("#mc-sw-mr2-material-cost").html())).toFixed(2));
$( "#mc-sw-mr2-cost-markedup" ).html((
(Number($("#mc-sw-mr2-total-cost").html())*
Number($("#mc-sw-mr2-markup").html())/100) +
Number($("#mc-sw-mr2-total-cost").html())).toFixed(2));

<?php // **************************MR2-DD***************************?>

$( "#mc-dd-mr2-width" ).html(Number($("#mr2-width").val()));
$( "#mc-dd-mr2-lm" ).html(Number($("#mc-dd-mr2-width").html())/1000);
$( "#mc-dd-mr2-item-1" ).html(Number($("#mc-list-25").html()));
$( "#mc-dd-mr2-item-2" ).html(Number($("#mc-list-26").html()));
$( "#mc-dd-mr2-item-3" ).html(Number($("#mc-list-27").html()));

$( "#mc-dd-mr2-item-1-calculated" ).html((Number($("#mc-dd-mr2-item-1").html())*$( "#mc-dd-mr2-lm" ).html()).toFixed(2));
$( "#mc-dd-mr2-item-2-calculated" ).html((Number($("#mc-dd-mr2-item-2").html())*$( "#mc-dd-mr2-lm" ).html()).toFixed(2));
$( "#mc-dd-mr2-item-3-calculated" ).html((Number($("#mc-dd-mr2-item-3").html())*$( "#mc-dd-mr2-lm" ).html()).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-dd-mr2-pwd-coat-spec-1").html(((Number($("#mc-dd-mr2-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-dd-mr2-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-dd-mr2-pwd-coat-spec-2" ).html(((Number($("#mc-dd-mr2-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-dd-mr2-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-dd-mr2-pwd-coat-spec-3" ).html(((Number($("#mc-dd-mr2-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-dd-mr2-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-dd-mr2-pwd-coat-spec-4" ).html(((Number($("#mc-dd-mr2-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-dd-mr2-pwd-coat-spec-4").html('0.00');}

$( "#mc-dd-mr2-material-cost" ).html(
(Number($("#mc-dd-mr2-pwd-coat-spec-1").html())+
Number($("#mc-dd-mr2-pwd-coat-spec-2").html())+
Number($("#mc-dd-mr2-pwd-coat-spec-3").html())+
Number($("#mc-dd-mr2-pwd-coat-spec-4").html())+
Number($( "#mc-dd-mr2-consumables" ).html())+
Number($( "#mc-dd-mr2-item-1-calculated" ).html())+
Number($( "#mc-dd-mr2-item-2-calculated" ).html())+
Number($( "#mc-dd-mr2-item-3-calculated" ).html())).toFixed(2));

$( "#mc-dd-mr2-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-3").html())/60*$("#mc-dd-mr2-time-allocated-min").html());
$( "#mc-dd-mr2-total-cost" ).html((Number($("#mc-dd-mr2-labour-incl-cutting").html())+Number($("#mc-dd-mr2-material-cost").html())).toFixed(2));
$( "#mc-dd-mr2-cost-markedup" ).html((
(Number($("#mc-dd-mr2-total-cost").html())*
Number($("#mc-dd-mr2-markup").html())/100) +
Number($("#mc-dd-mr2-total-cost").html())).toFixed(2));

<?php // **************************MR2-DW***************************?>

$( "#mc-dw-mr2-width" ).html(Number($("#mr2-width").val()));
$( "#mc-dw-mr2-lm" ).html(Number($("#mc-dw-mr2-width").html())/1000);
$( "#mc-dw-mr2-item-1" ).html(Number($("#mc-list-25").html()));
$( "#mc-dw-mr2-item-2" ).html(Number($("#mc-list-26").html()));
$( "#mc-dw-mr2-item-3" ).html(Number($("#mc-list-27").html()));

$( "#mc-dw-mr2-item-1-calculated" ).html((Number($("#mc-dw-mr2-item-1").html())*$( "#mc-dw-mr2-lm" ).html()).toFixed(2));
$( "#mc-dw-mr2-item-2-calculated" ).html((Number($("#mc-dw-mr2-item-2").html())*$( "#mc-dw-mr2-lm" ).html()).toFixed(2));
$( "#mc-dw-mr2-item-3-calculated" ).html((Number($("#mc-dw-mr2-item-3").html())*$( "#mc-dw-mr2-lm" ).html()).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-dw-mr2-pwd-coat-spec-1").html(((Number($("#mc-dw-mr2-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-dw-mr2-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-dw-mr2-pwd-coat-spec-2" ).html(((Number($("#mc-dw-mr2-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-dw-mr2-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-dw-mr2-pwd-coat-spec-3" ).html(((Number($("#mc-dw-mr2-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-dw-mr2-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-dw-mr2-pwd-coat-spec-4" ).html(((Number($("#mc-dw-mr2-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-dw-mr2-pwd-coat-spec-4").html('0.00');}

$( "#mc-dw-mr2-material-cost" ).html(
(Number($("#mc-dw-mr2-pwd-coat-spec-1").html())+
Number($("#mc-dw-mr2-pwd-coat-spec-2").html())+
Number($("#mc-dw-mr2-pwd-coat-spec-3").html())+
Number($("#mc-dw-mr2-pwd-coat-spec-4").html())+
Number($( "#mc-dw-mr2-consumables" ).html())+
Number($( "#mc-dw-mr2-item-1-calculated" ).html())+
Number($( "#mc-dw-mr2-item-2-calculated" ).html())+
Number($( "#mc-dw-mr2-item-3-calculated" ).html())).toFixed(2));

$( "#mc-dw-mr2-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-5").html())/60*$("#mc-dw-mr2-time-allocated-min").html());
$( "#mc-dw-mr2-total-cost" ).html((Number($("#mc-dw-mr2-labour-incl-cutting").html())+Number($("#mc-dw-mr2-material-cost").html())).toFixed(2));
$( "#mc-dw-mr2-cost-markedup" ).html((
(Number($("#mc-dw-mr2-total-cost").html())*
Number($("#mc-dw-mr2-markup").html())/100) +
Number($("#mc-dw-mr2-total-cost").html())).toFixed(2));

<?php // **************************MR2-FD***************************?>

$( "#mc-fd-mr2-width" ).html(Number($("#mr2-width").val()));
$( "#mc-fd-mr2-lm" ).html(Number($("#mc-fd-mr2-width").html())/1000);
$( "#mc-fd-mr2-item-1" ).html(Number($("#mc-list-3").html()));
$( "#mc-fd-mr2-item-2" ).html(Number($("#mc-list-5").html()));
$( "#mc-fd-mr2-item-3" ).html(Number($("#mc-list-27").html()));

$( "#mc-fd-mr2-item-1-calculated" ).html((Number($("#mc-fd-mr2-item-1").html())*$( "#mc-fd-mr2-lm" ).html()).toFixed(2));
$( "#mc-fd-mr2-item-2-calculated" ).html((Number($("#mc-fd-mr2-item-2").html())*2).toFixed(2));
$( "#mc-fd-mr2-item-3-calculated" ).html((Number($("#mc-fd-mr2-item-3").html())*$( "#mc-fd-mr2-lm" ).html()*2).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-fd-mr2-pwd-coat-spec-1").html(((Number($("#mc-fd-mr2-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-fd-mr2-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-fd-mr2-pwd-coat-spec-2" ).html(((Number($("#mc-fd-mr2-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-fd-mr2-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-fd-mr2-pwd-coat-spec-3" ).html(((Number($("#mc-fd-mr2-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-fd-mr2-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-fd-mr2-pwd-coat-spec-4" ).html(((Number($("#mc-fd-mr2-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-fd-mr2-pwd-coat-spec-4").html('0.00');}

$( "#mc-fd-mr2-material-cost" ).html(
(Number($("#mc-fd-mr2-pwd-coat-spec-1").html())+
Number($("#mc-fd-mr2-pwd-coat-spec-2").html())+
Number($("#mc-fd-mr2-pwd-coat-spec-3").html())+
Number($("#mc-fd-mr2-pwd-coat-spec-4").html())+
Number($( "#mc-fd-mr2-consumables" ).html())+
Number($( "#mc-fd-mr2-item-1-calculated" ).html())+
Number($( "#mc-fd-mr2-item-2-calculated" ).html())+
Number($( "#mc-fd-mr2-item-3-calculated" ).html())).toFixed(2));

$( "#mc-fd-mr2-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-5").html())/60*$("#mc-fd-mr2-time-allocated-min").html());
$( "#mc-fd-mr2-total-cost" ).html((Number($("#mc-fd-mr2-labour-incl-cutting").html())+Number($("#mc-fd-mr2-material-cost").html())).toFixed(2));
$( "#mc-fd-mr2-cost-markedup" ).html((
(Number($("#mc-fd-mr2-total-cost").html())*
Number($("#mc-fd-mr2-markup").html())/100) +
Number($("#mc-fd-mr2-total-cost").html())).toFixed(2));

<?php // **************************MR2-FW***************************?>

$( "#mc-fw-mr2-width" ).html(Number($("#mr2-width").val()));
$( "#mc-fw-mr2-lm" ).html(Number($("#mc-fw-mr2-width").html())/1000);
$( "#mc-fw-mr2-item-1" ).html(Number($("#mc-list-3").html()));
$( "#mc-fw-mr2-item-2" ).html(Number($("#mc-list-5").html()));
$( "#mc-fw-mr2-item-3" ).html(Number($("#mc-list-27").html()));

$( "#mc-fw-mr2-item-1-calculated" ).html((Number($("#mc-fw-mr2-item-1").html())*$( "#mc-fw-mr2-lm" ).html()).toFixed(2));
$( "#mc-fw-mr2-item-2-calculated" ).html((Number($("#mc-fw-mr2-item-2").html())*2).toFixed(2));
$( "#mc-fw-mr2-item-3-calculated" ).html((Number($("#mc-fw-mr2-item-3").html())*$( "#mc-fw-mr2-lm" ).html()*2).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-fw-mr2-pwd-coat-spec-1").html(((Number($("#mc-fw-mr2-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-fw-mr2-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-fw-mr2-pwd-coat-spec-2" ).html(((Number($("#mc-fw-mr2-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-fw-mr2-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-fw-mr2-pwd-coat-spec-3" ).html(((Number($("#mc-fw-mr2-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-fw-mr2-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-fw-mr2-pwd-coat-spec-4" ).html(((Number($("#mc-fw-mr2-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-fw-mr2-pwd-coat-spec-4").html('0.00');}

$( "#mc-fw-mr2-material-cost" ).html(
(Number($("#mc-fw-mr2-pwd-coat-spec-1").html())+
Number($("#mc-fw-mr2-pwd-coat-spec-2").html())+
Number($("#mc-fw-mr2-pwd-coat-spec-3").html())+
Number($("#mc-fw-mr2-pwd-coat-spec-4").html())+

Number($( "#mc-fw-mr2-consumables" ).html())+
Number($( "#mc-fw-mr2-item-1-calculated" ).html())+
Number($( "#mc-fw-mr2-item-2-calculated" ).html())+
Number($( "#mc-fw-mr2-item-3-calculated" ).html())).toFixed(2));

$( "#mc-fw-mr2-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-5").html())/60*$("#mc-fw-mr2-time-allocated-min").html());
$( "#mc-fw-mr2-total-cost" ).html((Number($("#mc-fw-mr2-labour-incl-cutting").html())+Number($("#mc-fw-mr2-material-cost").html())).toFixed(2));
$( "#mc-fw-mr2-cost-markedup" ).html((
(Number($("#mc-fw-mr2-total-cost").html())*
Number($("#mc-fw-mr2-markup").html())/100) +
Number($("#mc-fw-mr2-total-cost").html())).toFixed(2));

<?php // **************************MR3-SD***************************?>

$( "#mc-sd-mr3-width" ).html(Number($("#mr3-width").val()));
$( "#mc-sd-mr3-lm" ).html(Number($("#mc-sd-mr3-width").html())/1000);
$( "#mc-sd-mr3-item-1" ).html(Number($("#mc-list-25").html()));
$( "#mc-sd-mr3-item-2" ).html(Number($("#mc-list-26").html()));
$( "#mc-sd-mr3-item-3" ).html(Number($("#mc-list-7").html()));

$( "#mc-sd-mr3-item-1-calculated" ).html((Number($("#mc-sd-mr3-item-1").html())*$( "#mc-sd-mr3-lm" ).html()).toFixed(2));
$( "#mc-sd-mr3-item-2-calculated" ).html((Number($("#mc-sd-mr3-item-2").html())*$( "#mc-sd-mr3-lm" ).html()).toFixed(2));
$( "#mc-sd-mr3-item-3-calculated" ).html((Number($("#mc-sd-mr3-item-3").html())*$( "#mc-sd-mr3-lm" ).html()*2).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-sd-mr3-pwd-coat-spec-1").html(((Number($("#mc-sd-mr3-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-sd-mr3-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-sd-mr3-pwd-coat-spec-2" ).html(((Number($("#mc-sd-mr3-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-sd-mr3-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-sd-mr3-pwd-coat-spec-3" ).html(((Number($("#mc-sd-mr3-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-sd-mr3-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-sd-mr3-pwd-coat-spec-4" ).html(((Number($("#mc-sd-mr3-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-sd-mr3-pwd-coat-spec-4").html('0.00');}

$( "#mc-sd-mr3-material-cost" ).html(
(Number($("#mc-sd-mr3-pwd-coat-spec-1").html())+
Number($("#mc-sd-mr3-pwd-coat-spec-2").html())+
Number($("#mc-sd-mr3-pwd-coat-spec-3").html())+
Number($("#mc-sd-mr3-pwd-coat-spec-4").html())+
Number($( "#mc-sd-mr3-consumables" ).html())+
Number($( "#mc-sd-mr3-item-1-calculated" ).html())+
Number($( "#mc-sd-mr3-item-2-calculated" ).html())+
Number($( "#mc-sd-mr3-item-3-calculated" ).html())).toFixed(2));

$( "#mc-sd-mr3-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-5").html())/60*$("#mc-sd-mr3-time-allocated-min").html());
$( "#mc-sd-mr3-total-cost" ).html((Number($("#mc-sd-mr3-labour-incl-cutting").html())+Number($("#mc-sd-mr3-material-cost").html())).toFixed(2));
$( "#mc-sd-mr3-cost-markedup" ).html((
(Number($("#mc-sd-mr3-total-cost").html())*
Number($("#mc-sd-mr3-markup").html())/100) +
Number($("#mc-sd-mr3-total-cost").html())).toFixed(2));

<?php // **************************MR3-SW***************************?>

$( "#mc-sw-mr3-width" ).html(Number($("#mr3-width").val()));
$( "#mc-sw-mr3-lm" ).html(Number($("#mc-sw-mr3-width").html())/1000);
$( "#mc-sw-mr3-item-1" ).html(Number($("#mc-list-25").html()));
$( "#mc-sw-mr3-item-2" ).html(Number($("#mc-list-26").html()));
$( "#mc-sw-mr3-item-3" ).html(Number($("#mc-list-7").html()));

$( "#mc-sw-mr3-item-1-calculated" ).html((Number($("#mc-sw-mr3-item-1").html())*$( "#mc-sw-mr3-lm" ).html()).toFixed(2));
$( "#mc-sw-mr3-item-2-calculated" ).html((Number($("#mc-sw-mr3-item-2").html())*$( "#mc-sw-mr3-lm" ).html()).toFixed(2));
$( "#mc-sw-mr3-item-3-calculated" ).html((Number($("#mc-sw-mr3-item-3").html())*$( "#mc-sw-mr3-lm" ).html()*2).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-sw-mr3-pwd-coat-spec-1").html(((Number($("#mc-sw-mr3-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-sw-mr3-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-sw-mr3-pwd-coat-spec-2" ).html(((Number($("#mc-sw-mr3-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-sw-mr3-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-sw-mr3-pwd-coat-spec-3" ).html(((Number($("#mc-sw-mr3-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-sw-mr3-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-sw-mr3-pwd-coat-spec-4" ).html(((Number($("#mc-sw-mr3-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-sw-mr3-pwd-coat-spec-4").html('0.00');}

$( "#mc-sw-mr3-material-cost" ).html(
(Number($("#mc-sw-mr3-pwd-coat-spec-1").html())+
Number($("#mc-sw-mr3-pwd-coat-spec-2").html())+
Number($("#mc-sw-mr3-pwd-coat-spec-3").html())+
Number($("#mc-sw-mr3-pwd-coat-spec-4").html())+
Number($( "#mc-sw-mr3-consumables" ).html())+
Number($( "#mc-sw-mr3-item-1-calculated" ).html())+
Number($( "#mc-sw-mr3-item-2-calculated" ).html())+
Number($( "#mc-sw-mr3-item-3-calculated" ).html())).toFixed(2));

$( "#mc-sw-mr3-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-5").html())/60*$("#mc-sw-mr3-time-allocated-min").html());
$( "#mc-sw-mr3-total-cost" ).html((Number($("#mc-sw-mr3-labour-incl-cutting").html())+Number($("#mc-sw-mr3-material-cost").html())).toFixed(2));
$( "#mc-sw-mr3-cost-markedup" ).html((
(Number($("#mc-sw-mr3-total-cost").html())*
Number($("#mc-sw-mr3-markup").html())/100) +
Number($("#mc-sw-mr3-total-cost").html())).toFixed(2));

<?php // **************************MR3-DD***************************?>

$( "#mc-dd-mr3-width" ).html(Number($("#mr3-width").val()));
$( "#mc-dd-mr3-lm" ).html(Number($("#mc-dd-mr3-width").html())/1000);
$( "#mc-dd-mr3-item-1" ).html(Number($("#mc-list-25").html()));
$( "#mc-dd-mr3-item-2" ).html(Number($("#mc-list-26").html()));
$( "#mc-dd-mr3-item-3" ).html(Number($("#mc-list-27").html()));

$( "#mc-dd-mr3-item-1-calculated" ).html((Number($("#mc-dd-mr3-item-1").html())*$( "#mc-dd-mr3-lm" ).html()).toFixed(2));
$( "#mc-dd-mr3-item-2-calculated" ).html((Number($("#mc-dd-mr3-item-2").html())*$( "#mc-dd-mr3-lm" ).html()).toFixed(2));
$( "#mc-dd-mr3-item-3-calculated" ).html((Number($("#mc-dd-mr3-item-3").html())*$( "#mc-dd-mr3-lm" ).html()).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-dd-mr3-pwd-coat-spec-1").html(((Number($("#mc-dd-mr3-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-dd-mr3-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-dd-mr3-pwd-coat-spec-2" ).html(((Number($("#mc-dd-mr3-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-dd-mr3-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-dd-mr3-pwd-coat-spec-3" ).html(((Number($("#mc-dd-mr3-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-dd-mr3-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-dd-mr3-pwd-coat-spec-4" ).html(((Number($("#mc-dd-mr3-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-dd-mr3-pwd-coat-spec-4").html('0.00');}

$( "#mc-dd-mr3-material-cost" ).html(
(Number($("#mc-dd-mr3-pwd-coat-spec-1").html())+
Number($("#mc-dd-mr3-pwd-coat-spec-2").html())+
Number($("#mc-dd-mr3-pwd-coat-spec-3").html())+
Number($("#mc-dd-mr3-pwd-coat-spec-4").html())+
Number($( "#mc-dd-mr3-consumables" ).html())+
Number($( "#mc-dd-mr3-item-1-calculated" ).html())+
Number($( "#mc-dd-mr3-item-2-calculated" ).html())+
Number($( "#mc-dd-mr3-item-3-calculated" ).html())).toFixed(2));

$( "#mc-dd-mr3-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-3").html())/60*$("#mc-dd-mr3-time-allocated-min").html());
$( "#mc-dd-mr3-total-cost" ).html((Number($("#mc-dd-mr3-labour-incl-cutting").html())+Number($("#mc-dd-mr3-material-cost").html())).toFixed(2));
$( "#mc-dd-mr3-cost-markedup" ).html((
(Number($("#mc-dd-mr3-total-cost").html())*
Number($("#mc-dd-mr3-markup").html())/100) +
Number($("#mc-dd-mr3-total-cost").html())).toFixed(2));

<?php // **************************MR3-DW***************************?>

$( "#mc-dw-mr3-width" ).html(Number($("#mr3-width").val()));
$( "#mc-dw-mr3-lm" ).html(Number($("#mc-dw-mr3-width").html())/1000);
$( "#mc-dw-mr3-item-1" ).html(Number($("#mc-list-25").html()));
$( "#mc-dw-mr3-item-2" ).html(Number($("#mc-list-26").html()));
$( "#mc-dw-mr3-item-3" ).html(Number($("#mc-list-27").html()));

$( "#mc-dw-mr3-item-1-calculated" ).html((Number($("#mc-dw-mr3-item-1").html())*$( "#mc-dw-mr3-lm" ).html()).toFixed(2));
$( "#mc-dw-mr3-item-2-calculated" ).html((Number($("#mc-dw-mr3-item-2").html())*$( "#mc-dw-mr3-lm" ).html()).toFixed(2));
$( "#mc-dw-mr3-item-3-calculated" ).html((Number($("#mc-dw-mr3-item-3").html())*$( "#mc-dw-mr3-lm" ).html()).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-dw-mr3-pwd-coat-spec-1").html(((Number($("#mc-dw-mr3-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-dw-mr3-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-dw-mr3-pwd-coat-spec-2" ).html(((Number($("#mc-dw-mr3-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-dw-mr3-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-dw-mr3-pwd-coat-spec-3" ).html(((Number($("#mc-dw-mr3-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-dw-mr3-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-dw-mr3-pwd-coat-spec-4" ).html(((Number($("#mc-dw-mr3-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-dw-mr3-pwd-coat-spec-4").html('0.00');}

$( "#mc-dw-mr3-material-cost" ).html(
(Number($("#mc-dw-mr3-pwd-coat-spec-1").html())+
Number($("#mc-dw-mr3-pwd-coat-spec-2").html())+
Number($("#mc-dw-mr3-pwd-coat-spec-3").html())+
Number($("#mc-dw-mr3-pwd-coat-spec-4").html())+
Number($( "#mc-dw-mr3-consumables" ).html())+
Number($( "#mc-dw-mr3-item-1-calculated" ).html())+
Number($( "#mc-dw-mr3-item-2-calculated" ).html())+
Number($( "#mc-dw-mr3-item-3-calculated" ).html())).toFixed(2));

$( "#mc-dw-mr3-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-5").html())/60*$("#mc-dw-mr3-time-allocated-min").html());
$( "#mc-dw-mr3-total-cost" ).html((Number($("#mc-dw-mr3-labour-incl-cutting").html())+Number($("#mc-dw-mr3-material-cost").html())).toFixed(2));
$( "#mc-dw-mr3-cost-markedup" ).html((
(Number($("#mc-dw-mr3-total-cost").html())*
Number($("#mc-dw-mr3-markup").html())/100) +
Number($("#mc-dw-mr3-total-cost").html())).toFixed(2));

<?php // **************************MR3-FD***************************?>

$( "#mc-fd-mr3-width" ).html(Number($("#mr3-width").val()));
$( "#mc-fd-mr3-lm" ).html(Number($("#mc-fd-mr3-width").html())/1000);
$( "#mc-fd-mr3-item-1" ).html(Number($("#mc-list-3").html()));
$( "#mc-fd-mr3-item-2" ).html(Number($("#mc-list-5").html()));
$( "#mc-fd-mr3-item-3" ).html(Number($("#mc-list-27").html()));

$( "#mc-fd-mr3-item-1-calculated" ).html((Number($("#mc-fd-mr3-item-1").html())*$( "#mc-fd-mr3-lm" ).html()).toFixed(2));
$( "#mc-fd-mr3-item-2-calculated" ).html((Number($("#mc-fd-mr3-item-2").html())*2).toFixed(2));
$( "#mc-fd-mr3-item-3-calculated" ).html((Number($("#mc-fd-mr3-item-3").html())*$( "#mc-fd-mr3-lm" ).html()*2).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-fd-mr3-pwd-coat-spec-1").html(((Number($("#mc-fd-mr3-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-fd-mr3-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-fd-mr3-pwd-coat-spec-2" ).html(((Number($("#mc-fd-mr3-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-fd-mr3-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-fd-mr3-pwd-coat-spec-3" ).html(((Number($("#mc-fd-mr3-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-fd-mr3-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-fd-mr3-pwd-coat-spec-4" ).html(((Number($("#mc-fd-mr3-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-fd-mr3-pwd-coat-spec-4").html('0.00');}

$( "#mc-fd-mr3-material-cost" ).html(
(Number($("#mc-fd-mr3-pwd-coat-spec-1").html())+
Number($("#mc-fd-mr3-pwd-coat-spec-2").html())+
Number($("#mc-fd-mr3-pwd-coat-spec-3").html())+
Number($("#mc-fd-mr3-pwd-coat-spec-4").html())+
Number($( "#mc-fd-mr3-consumables" ).html())+
Number($( "#mc-fd-mr3-item-1-calculated" ).html())+
Number($( "#mc-fd-mr3-item-2-calculated" ).html())+
Number($( "#mc-fd-mr3-item-3-calculated" ).html())).toFixed(2));

$( "#mc-fd-mr3-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-5").html())/60*$("#mc-fd-mr3-time-allocated-min").html());
$( "#mc-fd-mr3-total-cost" ).html((Number($("#mc-fd-mr3-labour-incl-cutting").html())+Number($("#mc-fd-mr3-material-cost").html())).toFixed(2));
$( "#mc-fd-mr3-cost-markedup" ).html((
(Number($("#mc-fd-mr3-total-cost").html())*
Number($("#mc-fd-mr3-markup").html())/100) +
Number($("#mc-fd-mr3-total-cost").html())).toFixed(2));

<?php // **************************MR3-FW***************************?>

$( "#mc-fw-mr3-width" ).html(Number($("#mr3-width").val()));
$( "#mc-fw-mr3-lm" ).html(Number($("#mc-fw-mr3-width").html())/1000);
$( "#mc-fw-mr3-item-1" ).html(Number($("#mc-list-3").html()));
$( "#mc-fw-mr3-item-2" ).html(Number($("#mc-list-5").html()));
$( "#mc-fw-mr3-item-3" ).html(Number($("#mc-list-27").html()));

$( "#mc-fw-mr3-item-1-calculated" ).html((Number($("#mc-fw-mr3-item-1").html())*$( "#mc-fw-mr3-lm" ).html()).toFixed(2));
$( "#mc-fw-mr3-item-2-calculated" ).html((Number($("#mc-fw-mr3-item-2").html())*2).toFixed(2));
$( "#mc-fw-mr3-item-3-calculated" ).html((Number($("#mc-fw-mr3-item-3").html())*$( "#mc-fw-mr3-lm" ).html()*2).toFixed(2));

if ($( "#color1:checked" ).length==1){	$("#mc-fw-mr3-pwd-coat-spec-1").html(((Number($("#mc-fw-mr3-lm").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-fw-mr3-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-fw-mr3-pwd-coat-spec-2" ).html(((Number($("#mc-fw-mr3-lm").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-fw-mr3-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-fw-mr3-pwd-coat-spec-3" ).html(((Number($("#mc-fw-mr3-lm").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-fw-mr3-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-fw-mr3-pwd-coat-spec-4" ).html(((Number($("#mc-fw-mr3-lm").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-fw-mr3-pwd-coat-spec-4").html('0.00');}

$( "#mc-fw-mr3-material-cost" ).html(
(Number($("#mc-fw-mr3-pwd-coat-spec-1").html())+
Number($("#mc-fw-mr3-pwd-coat-spec-2").html())+
Number($("#mc-fw-mr3-pwd-coat-spec-3").html())+
Number($("#mc-fw-mr3-pwd-coat-spec-4").html())+
Number($( "#mc-fw-mr3-consumables" ).html())+
Number($( "#mc-fw-mr3-item-1-calculated" ).html())+
Number($( "#mc-fw-mr3-item-2-calculated" ).html())+
Number($( "#mc-fw-mr3-item-3-calculated" ).html())).toFixed(2));

$( "#mc-fw-mr3-labour-incl-cutting" ).html(Number($("#mc-lm-r-list-5").html())/60*$("#mc-fw-mr3-time-allocated-min").html());
$( "#mc-fw-mr3-total-cost" ).html((Number($("#mc-fw-mr3-labour-incl-cutting").html())+Number($("#mc-fw-mr3-material-cost").html())).toFixed(2));
$( "#mc-fw-mr3-cost-markedup" ).html((
(Number($("#mc-fw-mr3-total-cost").html())*
Number($("#mc-fw-mr3-markup").html())/100) +
Number($("#mc-fw-mr3-total-cost").html())).toFixed(2));















<?php for($i = 1; $i<$j; $i++){ ?>
//*************SD**********************
$( "#mc-sd-product<?php echo $i; ?>-height" ).html($("#product<?php echo $i; ?>-height").val());
$( "#mc-sd-product<?php echo $i; ?>-width" ).html($("#product<?php echo $i; ?>-width").val());
$( "#mc-sd-product<?php echo $i; ?>-coat" ).html(((Number($("#mc-sd-product<?php echo $i; ?>-height").html()) + Number($("#mc-sd-product<?php echo $i; ?>-width").html()))*2/5000).toFixed(1));
$( "#mc-sd-product<?php echo $i; ?>-mesh-height" ).html(Number($("#mc-sd-product<?php echo $i; ?>-height").html()) - 110 );
$( "#mc-sd-product<?php echo $i; ?>-mesh-width" ).html(Number($("#mc-sd-product<?php echo $i; ?>-width").html()) - 110 );
$( "#mc-sd-product<?php echo $i; ?>-lmtrs" ).html(((Number($("#mc-sd-product<?php echo $i; ?>-height").html()) + Number($("#mc-sd-product<?php echo $i; ?>-width").html()))*2/1000).toFixed(1));
$( "#mc-sd-product<?php echo $i; ?>-sqm" ).html(((Number($("#mc-sd-product<?php echo $i; ?>-mesh-height").html()) * Number($("#mc-sd-product<?php echo $i; ?>-mesh-width").html()))/1000000).toFixed(3));
$( "#mc-sd-product<?php echo $i; ?>-price-sqm" ).html(((Number($("#mc-sd-product<?php echo $i; ?>-sqm").html()) * Number($("#mc-list-1").html()))).toFixed(2));
$( "#mc-sd-product<?php echo $i; ?>-window-frame-11mm-mfn" ).html($("#mc-list-3").html());
$( "#mc-sd-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated" ).html(((Number($("#mc-sd-product<?php echo $i; ?>-lmtrs").html()) * Number($("#mc-sd-product<?php echo $i; ?>-window-frame-11mm-mfn").html()))).toFixed(2));
$( "#mc-sd-product<?php echo $i; ?>-window-cnr-stake-4" ).html($("#mc-list-5").html());
$( "#mc-sd-product<?php echo $i; ?>-window-cnr-stake-4-calculated" ).html((Number($("#mc-sd-product<?php echo $i; ?>-window-cnr-stake-4").html()) * 4).toFixed(2));
$( "#mc-sd-product<?php echo $i; ?>-security-locking-bloc" ).html($("#mc-list-7").html());
$( "#mc-sd-product<?php echo $i; ?>-security-locking-bloc-calculated" ).html(((Number($("#mc-sd-product<?php echo $i; ?>-lmtrs").html()) * Number($("#mc-sd-product<?php echo $i; ?>-security-locking-bloc").html()))).toFixed(2));
$( "#mc-sd-product<?php echo $i; ?>-sec-door-tape-30mm" ).html($("#mc-list-8").html());
$( "#mc-sd-product<?php echo $i; ?>-sec-door-tape-30mm-calculated" ).html(((4 * Number($("#mc-sd-product<?php echo $i; ?>-sec-door-tape-30mm").html()))).toFixed(2));
$( "#mc-sd-product<?php echo $i; ?>-components-wheels-hinges" ).html($("#mc-list-17").html());
$( "#mc-sd-product<?php echo $i; ?>-components-wheels-hinges-calculated" ).html(((Number($("#mc-sd-product<?php echo $i; ?>-lmtrs").html()) * Number($("#mc-sd-product<?php echo $i; ?>-components-wheels-hinges").html()))).toFixed(2));
if ($( "#color1:checked" ).length==1){	$("#mc-sd-product<?php echo $i; ?>-pwd-coat-spec-1").html(((Number($("#mc-sd-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-sd-product<?php echo $i; ?>-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-sd-product<?php echo $i; ?>-pwd-coat-spec-2" ).html(((Number($("#mc-sd-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-sd-product<?php echo $i; ?>-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-sd-product<?php echo $i; ?>-pwd-coat-spec-3" ).html(((Number($("#mc-sd-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-sd-product<?php echo $i; ?>-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-sd-product<?php echo $i; ?>-pwd-coat-spec-4" ).html(((Number($("#mc-sd-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-sd-product<?php echo $i; ?>-pwd-coat-spec-4").html('0.00');}
$( "#mc-sd-product<?php echo $i; ?>-material-cost" ).html((
Number($("#mc-sd-product<?php echo $i; ?>-pwd-coat-spec-1").html())+ 
Number($("#mc-sd-product<?php echo $i; ?>-pwd-coat-spec-2").html())+
Number($("#mc-sd-product<?php echo $i; ?>-pwd-coat-spec-3").html())+
Number($("#mc-sd-product<?php echo $i; ?>-pwd-coat-spec-4").html())+
Number($("#mc-sd-product<?php echo $i; ?>-price-sqm").html())+
Number($("#mc-sd-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated").html())+
Number($("#mc-sd-product<?php echo $i; ?>-window-cnr-stake-4-calculated").html())+
Number($("#mc-sd-product<?php echo $i; ?>-security-locking-bloc-calculated").html())+
Number($("#mc-sd-product<?php echo $i; ?>-sec-door-tape-30mm-calculated").html())+
Number($("#mc-sd-product<?php echo $i; ?>-components-wheels-hinges-calculated").html())+
Number($("#mc-sd-product<?php echo $i; ?>-freight-consumables").html())).toFixed(2));
$( "#mc-sd-product<?php echo $i; ?>-labour-incl-cutting" ).html(((Number($("#mc-lm-r-list-1").html()) /60 * Number($("#mc-lm-t-list-1").html()))).toFixed(2));
$( "#mc-sd-product<?php echo $i; ?>-total-cost" ).html(((Number($("#mc-sd-product<?php echo $i; ?>-labour-incl-cutting").html()) + Number($("#mc-sd-product<?php echo $i; ?>-material-cost").html()))).toFixed(2));
$( "#mc-sd-product<?php echo $i; ?>-cost-markedup" ).html(((Number($("#mc-sd-product<?php echo $i; ?>-total-cost").html()) * (1 + (Number($("#mc-lm-m-list-1").html())/100)))).toFixed(2));
//*************SW********************
$( "#mc-sw-product<?php echo $i; ?>-height" ).html($("#product<?php echo $i; ?>-height").val());
$( "#mc-sw-product<?php echo $i; ?>-width" ).html($("#product<?php echo $i; ?>-width").val());
$( "#mc-sw-product<?php echo $i; ?>-coat" ).html(((Number($("#mc-sw-product<?php echo $i; ?>-height").html()) + Number($("#mc-sw-product<?php echo $i; ?>-width").html()))*2/5000).toFixed(1));
$( "#mc-sw-product<?php echo $i; ?>-mesh-height" ).html(Number($("#mc-sw-product<?php echo $i; ?>-height").html()) - 45 );
$( "#mc-sw-product<?php echo $i; ?>-mesh-width" ).html(Number($("#mc-sw-product<?php echo $i; ?>-width").html()) - 45 );
$( "#mc-sw-product<?php echo $i; ?>-lmtrs" ).html(((Number($("#mc-sw-product<?php echo $i; ?>-height").html()) + Number($("#mc-sw-product<?php echo $i; ?>-width").html()))*2/1000).toFixed(1));
$( "#mc-sw-product<?php echo $i; ?>-sqm" ).html(((Number($("#mc-sw-product<?php echo $i; ?>-mesh-height").html()) * Number($("#mc-sw-product<?php echo $i; ?>-mesh-width").html()))/1000000).toFixed(3));
$( "#mc-sw-product<?php echo $i; ?>-price-sqm" ).html(((Number($("#mc-sw-product<?php echo $i; ?>-sqm").html()) * Number($("#mc-list-1").html()))).toFixed(2));
$( "#mc-sw-product<?php echo $i; ?>-window-frame-11mm-mfn" ).html($("#mc-list-4").html());
$( "#mc-sw-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated" ).html(((Number($("#mc-sw-product<?php echo $i; ?>-lmtrs").html()) * Number($("#mc-sw-product<?php echo $i; ?>-window-frame-11mm-mfn").html()))).toFixed(2));
$( "#mc-sw-product<?php echo $i; ?>-window-cnr-stake-4" ).html($("#mc-list-6").html());
$( "#mc-sw-product<?php echo $i; ?>-window-cnr-stake-4-calculated" ).html((Number($("#mc-sw-product<?php echo $i; ?>-window-cnr-stake-4").html()) * 4).toFixed(2));
$( "#mc-sw-product<?php echo $i; ?>-security-locking-bloc" ).html($("#mc-list-7").html());
$( "#mc-sw-product<?php echo $i; ?>-security-locking-bloc-calculated" ).html(((Number($("#mc-sw-product<?php echo $i; ?>-lmtrs").html()) * Number($("#mc-sw-product<?php echo $i; ?>-security-locking-bloc").html()))).toFixed(2));
$( "#mc-sw-product<?php echo $i; ?>-sec-door-tape-30mm" ).html($("#mc-list-8").html());
$( "#mc-sw-product<?php echo $i; ?>-sec-door-tape-30mm-calculated" ).html(((Number($("#mc-sw-product<?php echo $i; ?>-lmtrs").html()) * Number($("#mc-sw-product<?php echo $i; ?>-sec-door-tape-30mm").html()))).toFixed(2));
if ($( "#color1:checked" ).length==1){	$("#mc-sw-product<?php echo $i; ?>-pwd-coat-spec-1").html(((Number($("#mc-sw-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-sw-product<?php echo $i; ?>-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-sw-product<?php echo $i; ?>-pwd-coat-spec-2" ).html(((Number($("#mc-sw-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-sw-product<?php echo $i; ?>-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-sw-product<?php echo $i; ?>-pwd-coat-spec-3" ).html(((Number($("#mc-sw-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-sw-product<?php echo $i; ?>-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-sw-product<?php echo $i; ?>-pwd-coat-spec-4" ).html(((Number($("#mc-sw-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-sw-product<?php echo $i; ?>-pwd-coat-spec-4").html('0.00');}
$( "#mc-sw-product<?php echo $i; ?>-material-cost" ).html((
Number($("#mc-sw-product<?php echo $i; ?>-pwd-coat-spec-1").html())+ 
Number($("#mc-sw-product<?php echo $i; ?>-pwd-coat-spec-2").html())+
Number($("#mc-sw-product<?php echo $i; ?>-pwd-coat-spec-3").html())+
Number($("#mc-sw-product<?php echo $i; ?>-pwd-coat-spec-4").html())+
Number($("#mc-sw-product<?php echo $i; ?>-price-sqm").html())+
Number($("#mc-sw-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated").html())+
Number($("#mc-sw-product<?php echo $i; ?>-window-cnr-stake-4-calculated").html())+
Number($("#mc-sw-product<?php echo $i; ?>-security-locking-bloc-calculated").html())+
Number($("#mc-sw-product<?php echo $i; ?>-sec-door-tape-30mm-calculated").html())+
Number($("#mc-sw-product<?php echo $i; ?>-freight-consumables").html())).toFixed(2));
$( "#mc-sw-product<?php echo $i; ?>-labour-incl-cutting" ).html(((Number($("#mc-lm-r-list-2").html()) /60 * Number($("#mc-lm-t-list-2").html()))).toFixed(2));
$( "#mc-sw-product<?php echo $i; ?>-total-cost" ).html(((Number($("#mc-sw-product<?php echo $i; ?>-labour-incl-cutting").html()) + Number($("#mc-sw-product<?php echo $i; ?>-material-cost").html()))).toFixed(2));
$( "#mc-sw-product<?php echo $i; ?>-cost-markedup" ).html(((Number($("#mc-sw-product<?php echo $i; ?>-total-cost").html()) * (1 + (Number($("#mc-lm-m-list-2").html())/100)))).toFixed(2));
//*************DD**********************
$( "#mc-dd-product<?php echo $i; ?>-height" ).html($("#product<?php echo $i; ?>-height").val());
$( "#mc-dd-product<?php echo $i; ?>-width" ).html($("#product<?php echo $i; ?>-width").val());
$( "#mc-dd-product<?php echo $i; ?>-coat" ).html(((Number($("#mc-dd-product<?php echo $i; ?>-height").html()) + Number($("#mc-dd-product<?php echo $i; ?>-width").html()))*2/5000).toFixed(1));
$( "#mc-dd-product<?php echo $i; ?>-mesh-height" ).html(Number($("#mc-dd-product<?php echo $i; ?>-height").html()) - 115 );
$( "#mc-dd-product<?php echo $i; ?>-mesh-width" ).html(Number($("#mc-dd-product<?php echo $i; ?>-width").html()) - 115 );
$( "#mc-dd-product<?php echo $i; ?>-lmtrs" ).html(((Number($("#mc-dd-product<?php echo $i; ?>-height").html()) + Number($("#mc-dd-product<?php echo $i; ?>-width").html()))*2/1000).toFixed(1));
$( "#mc-dd-product<?php echo $i; ?>-sqm" ).html(((Number($("#mc-dd-product<?php echo $i; ?>-mesh-height").html()) * Number($("#mc-dd-product<?php echo $i; ?>-mesh-width").html()))/1000000).toFixed(3));
$( "#mc-dd-product<?php echo $i; ?>-price-sqm" ).html(((Number($("#mc-dd-product<?php echo $i; ?>-sqm").html()) * Number($("#mc-list-19").html())+ Number($("#mc-list-20").html()))).toFixed(2));
$( "#mc-dd-product<?php echo $i; ?>-window-frame-11mm-mfn" ).html($("#mc-list-3").html());
$( "#mc-dd-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated" ).html(((Number($("#mc-dd-product<?php echo $i; ?>-lmtrs").html()) * Number($("#mc-dd-product<?php echo $i; ?>-window-frame-11mm-mfn").html()))).toFixed(2));
$( "#mc-dd-product<?php echo $i; ?>-window-cnr-stake-4" ).html($("#mc-list-5").html());
$( "#mc-dd-product<?php echo $i; ?>-window-cnr-stake-4-calculated" ).html((Number($("#mc-dd-product<?php echo $i; ?>-window-cnr-stake-4").html()) * 4).toFixed(2));
$( "#mc-dd-product<?php echo $i; ?>-security-locking-bloc" ).html($("#mc-list-18").html());
$( "#mc-dd-product<?php echo $i; ?>-security-locking-bloc-calculated" ).html(((Number($("#mc-dd-product<?php echo $i; ?>-lmtrs").html()) * Number($("#mc-dd-product<?php echo $i; ?>-security-locking-bloc").html()))).toFixed(2));
$( "#mc-dd-product<?php echo $i; ?>-components-wheels-hinges" ).html($("#mc-list-17").html());
$( "#mc-dd-product<?php echo $i; ?>-components-wheels-hinges-calculated" ).html(((4 * Number($("#mc-dd-product<?php echo $i; ?>-components-wheels-hinges").html()))).toFixed(2));
if ($( "#color1:checked" ).length==1){	$("#mc-dd-product<?php echo $i; ?>-pwd-coat-spec-1").html(((Number($("#mc-dd-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-dd-product<?php echo $i; ?>-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-dd-product<?php echo $i; ?>-pwd-coat-spec-2" ).html(((Number($("#mc-dd-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-dd-product<?php echo $i; ?>-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-dd-product<?php echo $i; ?>-pwd-coat-spec-3" ).html(((Number($("#mc-dd-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-dd-product<?php echo $i; ?>-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-dd-product<?php echo $i; ?>-pwd-coat-spec-4" ).html(((Number($("#mc-dd-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-dd-product<?php echo $i; ?>-pwd-coat-spec-4").html('0.00');}
$( "#mc-dd-product<?php echo $i; ?>-material-cost" ).html((
Number($("#mc-dd-product<?php echo $i; ?>-pwd-coat-spec-1").html())+ 
Number($("#mc-dd-product<?php echo $i; ?>-pwd-coat-spec-2").html())+
Number($("#mc-dd-product<?php echo $i; ?>-pwd-coat-spec-3").html())+
Number($("#mc-dd-product<?php echo $i; ?>-pwd-coat-spec-4").html())+
Number($("#mc-dd-product<?php echo $i; ?>-price-sqm").html())+
Number($("#mc-dd-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated").html())+
Number($("#mc-dd-product<?php echo $i; ?>-window-cnr-stake-4-calculated").html())+
Number($("#mc-dd-product<?php echo $i; ?>-security-locking-bloc-calculated").html())+
Number($("#mc-dd-product<?php echo $i; ?>-components-wheels-hinges-calculated").html())+
Number($("#mc-dd-product<?php echo $i; ?>-freight-consumables").html())).toFixed(2));
$( "#mc-dd-product<?php echo $i; ?>-labour-incl-cutting" ).html(((Number($("#mc-lm-r-list-3").html()) /60 * Number($("#mc-lm-t-list-3").html()))).toFixed(2));
$( "#mc-dd-product<?php echo $i; ?>-total-cost" ).html(((Number($("#mc-dd-product<?php echo $i; ?>-labour-incl-cutting").html()) + Number($("#mc-dd-product<?php echo $i; ?>-material-cost").html()))).toFixed(2));
$( "#mc-dd-product<?php echo $i; ?>-cost-markedup" ).html(((Number($("#mc-dd-product<?php echo $i; ?>-total-cost").html()) * (1 + (Number($("#mc-lm-m-list-3").html())/100)))).toFixed(2));
//*************DW**********************
$( "#mc-dw-product<?php echo $i; ?>-height" ).html($("#product<?php echo $i; ?>-height").val());
$( "#mc-dw-product<?php echo $i; ?>-width" ).html($("#product<?php echo $i; ?>-width").val());
$( "#mc-dw-product<?php echo $i; ?>-coat" ).html(((Number($("#mc-dw-product<?php echo $i; ?>-height").html()) + Number($("#mc-dw-product<?php echo $i; ?>-width").html()))*2/5000).toFixed(1));
$( "#mc-dw-product<?php echo $i; ?>-mesh-height" ).html(Number($("#mc-dw-product<?php echo $i; ?>-height").html()) - 50 );
$( "#mc-dw-product<?php echo $i; ?>-mesh-width" ).html(Number($("#mc-dw-product<?php echo $i; ?>-width").html()) - 50 );
$( "#mc-dw-product<?php echo $i; ?>-lmtrs" ).html(((Number($("#mc-dw-product<?php echo $i; ?>-height").html()) + Number($("#mc-dw-product<?php echo $i; ?>-width").html()))*2/1000).toFixed(1));
$( "#mc-dw-product<?php echo $i; ?>-sqm" ).html(((Number($("#mc-dw-product<?php echo $i; ?>-mesh-height").html()) * Number($("#mc-dw-product<?php echo $i; ?>-mesh-width").html()))/1000000).toFixed(3));
$( "#mc-dw-product<?php echo $i; ?>-price-sqm" ).html(((Number($("#mc-dw-product<?php echo $i; ?>-sqm").html()) * Number($("#mc-list-19").html())+ Number($("#mc-list-20").html()))).toFixed(2));
$( "#mc-dw-product<?php echo $i; ?>-window-frame-11mm-mfn" ).html($("#mc-list-4").html());
$( "#mc-dw-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated" ).html(((Number($("#mc-dw-product<?php echo $i; ?>-lmtrs").html()) * Number($("#mc-dw-product<?php echo $i; ?>-window-frame-11mm-mfn").html()))).toFixed(2));
$( "#mc-dw-product<?php echo $i; ?>-window-cnr-stake-4" ).html($("#mc-list-6").html());
$( "#mc-dw-product<?php echo $i; ?>-window-cnr-stake-4-calculated" ).html((Number($("#mc-dw-product<?php echo $i; ?>-window-cnr-stake-4").html()) * 4).toFixed(2));
$( "#mc-dw-product<?php echo $i; ?>-security-locking-bloc" ).html($("#mc-list-18").html());
$( "#mc-dw-product<?php echo $i; ?>-security-locking-bloc-calculated" ).html(((Number($("#mc-dw-product<?php echo $i; ?>-lmtrs").html()) * Number($("#mc-dw-product<?php echo $i; ?>-security-locking-bloc").html()))).toFixed(2));
if ($( "#color1:checked" ).length==1){	$("#mc-dw-product<?php echo $i; ?>-pwd-coat-spec-1").html(((Number($("#mc-dw-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-dw-product<?php echo $i; ?>-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-dw-product<?php echo $i; ?>-pwd-coat-spec-2" ).html(((Number($("#mc-dw-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-dw-product<?php echo $i; ?>-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-dw-product<?php echo $i; ?>-pwd-coat-spec-3" ).html(((Number($("#mc-dw-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-dw-product<?php echo $i; ?>-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-dw-product<?php echo $i; ?>-pwd-coat-spec-4" ).html(((Number($("#mc-dw-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-dw-product<?php echo $i; ?>-pwd-coat-spec-4").html('0.00');}
$( "#mc-dw-product<?php echo $i; ?>-material-cost" ).html((
Number($("#mc-dw-product<?php echo $i; ?>-pwd-coat-spec-1").html())+ 
Number($("#mc-dw-product<?php echo $i; ?>-pwd-coat-spec-2").html())+
Number($("#mc-dw-product<?php echo $i; ?>-pwd-coat-spec-3").html())+
Number($("#mc-dw-product<?php echo $i; ?>-pwd-coat-spec-4").html())+
Number($("#mc-dw-product<?php echo $i; ?>-price-sqm").html())+
Number($("#mc-dw-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated").html())+
Number($("#mc-dw-product<?php echo $i; ?>-window-cnr-stake-4-calculated").html())+
Number($("#mc-dw-product<?php echo $i; ?>-security-locking-bloc-calculated").html())+
Number($("#mc-dw-product<?php echo $i; ?>-freight-consumables").html())).toFixed(2));
$( "#mc-dw-product<?php echo $i; ?>-labour-incl-cutting" ).html(((Number($("#mc-lm-r-list-4").html()) /60 * Number($("#mc-lm-t-list-4").html()))).toFixed(2));
$( "#mc-dw-product<?php echo $i; ?>-total-cost" ).html(((Number($("#mc-dw-product<?php echo $i; ?>-labour-incl-cutting").html()) + Number($("#mc-dw-product<?php echo $i; ?>-material-cost").html()))).toFixed(2));
$( "#mc-dw-product<?php echo $i; ?>-cost-markedup" ).html(((Number($("#mc-dw-product<?php echo $i; ?>-total-cost").html()) * (1 + (Number($("#mc-lm-m-list-4").html())/100)))).toFixed(2));
//*************FD**********************
$( "#mc-fd-product<?php echo $i; ?>-height" ).html($("#product<?php echo $i; ?>-height").val());
$( "#mc-fd-product<?php echo $i; ?>-width" ).html($("#product<?php echo $i; ?>-width").val());
$( "#mc-fd-product<?php echo $i; ?>-coat" ).html(((Number($("#mc-fd-product<?php echo $i; ?>-height").html()) + Number($("#mc-fd-product<?php echo $i; ?>-width").html()))*2/5000).toFixed(1));
$( "#mc-fd-product<?php echo $i; ?>-mesh-height" ).html(Number($("#mc-fd-product<?php echo $i; ?>-height").html()) );
$( "#mc-fd-product<?php echo $i; ?>-mesh-width" ).html(Number($("#mc-fd-product<?php echo $i; ?>-width").html()) );
$( "#mc-fd-product<?php echo $i; ?>-lmtrs" ).html(((Number($("#mc-fd-product<?php echo $i; ?>-height").html()) + Number($("#mc-fd-product<?php echo $i; ?>-width").html()))*2/1000).toFixed(1));
$( "#mc-fd-product<?php echo $i; ?>-sqm" ).html(((Number($("#mc-fd-product<?php echo $i; ?>-mesh-height").html()) * Number($("#mc-fd-product<?php echo $i; ?>-mesh-width").html()))/1000000).toFixed(3));
if ($("#product<?php echo $i; ?>-316-ss-gal-pet :selected").text()=='Pet'){ $( "#mc-fd-product<?php echo $i; ?>-price-sqm" ).html(((Number($("#mc-fd-product<?php echo $i; ?>-sqm").html()) * Number($("#mc-list-22").html()))).toFixed(2));} else {$( "#mc-fd-product<?php echo $i; ?>-price-sqm" ).html(((Number($("#mc-fd-product<?php echo $i; ?>-sqm").html()) * Number($("#mc-list-21").html()))).toFixed(2));}
$( "#mc-fd-product<?php echo $i; ?>-window-frame-11mm-mfn" ).html($("#mc-list-3").html());
$( "#mc-fd-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated" ).html(((Number($("#mc-fd-product<?php echo $i; ?>-lmtrs").html()) * Number($("#mc-fd-product<?php echo $i; ?>-window-frame-11mm-mfn").html()))).toFixed(2));
$( "#mc-fd-product<?php echo $i; ?>-window-cnr-stake-4" ).html($("#mc-list-5").html());
$( "#mc-fd-product<?php echo $i; ?>-window-cnr-stake-4-calculated" ).html((Number($("#mc-fd-product<?php echo $i; ?>-window-cnr-stake-4").html()) * 4).toFixed(2));
$( "#mc-fd-product<?php echo $i; ?>-security-locking-bloc" ).html($("#mc-list-18").html());
$( "#mc-fd-product<?php echo $i; ?>-security-locking-bloc-calculated" ).html(((Number($("#mc-fd-product<?php echo $i; ?>-lmtrs").html()) * Number($("#mc-fd-product<?php echo $i; ?>-security-locking-bloc").html()))).toFixed(2));
$( "#mc-fd-product<?php echo $i; ?>-screen-latch" ).html($("#mc-list-24").html());
$( "#mc-fd-product<?php echo $i; ?>-screen-latch-calculated" ).html($( "#mc-fd-product<?php echo $i; ?>-screen-latch" ).html());
$( "#mc-fd-product<?php echo $i; ?>-components-wheels-hinges" ).html($("#mc-list-17").html());
$( "#mc-fd-product<?php echo $i; ?>-components-wheels-hinges-calculated" ).html(((4 * Number($("#mc-fd-product<?php echo $i; ?>-components-wheels-hinges").html()))).toFixed(2));
if ($( "#color1:checked" ).length==1){	$("#mc-fd-product<?php echo $i; ?>-pwd-coat-spec-1").html(((Number($("#mc-fd-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-fd-product<?php echo $i; ?>-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-fd-product<?php echo $i; ?>-pwd-coat-spec-2" ).html(((Number($("#mc-fd-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-fd-product<?php echo $i; ?>-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-fd-product<?php echo $i; ?>-pwd-coat-spec-3" ).html(((Number($("#mc-fd-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-fd-product<?php echo $i; ?>-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-fd-product<?php echo $i; ?>-pwd-coat-spec-4" ).html(((Number($("#mc-fd-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-fd-product<?php echo $i; ?>-pwd-coat-spec-4").html('0.00');}
$( "#mc-fd-product<?php echo $i; ?>-material-cost" ).html((
Number($("#mc-fd-product<?php echo $i; ?>-pwd-coat-spec-1").html())+ 
Number($("#mc-fd-product<?php echo $i; ?>-pwd-coat-spec-2").html())+
Number($("#mc-fd-product<?php echo $i; ?>-pwd-coat-spec-3").html())+
Number($("#mc-fd-product<?php echo $i; ?>-pwd-coat-spec-4").html())+
Number($("#mc-fd-product<?php echo $i; ?>-price-sqm").html())+
Number($("#mc-fd-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated").html())+
Number($("#mc-fd-product<?php echo $i; ?>-window-cnr-stake-4-calculated").html())+
Number($("#mc-fd-product<?php echo $i; ?>-security-locking-bloc-calculated").html())+
Number($("#mc-fd-product<?php echo $i; ?>-screen-latch-calculated").html())+
Number($("#mc-fd-product<?php echo $i; ?>-components-wheels-hinges-calculated").html())+
Number($("#mc-fd-product<?php echo $i; ?>-freight-consumables").html())).toFixed(2));
$( "#mc-fd-product<?php echo $i; ?>-labour-incl-cutting" ).html(((Number($("#mc-lm-r-list-5").html()) /60 * Number($("#mc-lm-t-list-5").html()))).toFixed(2));
$( "#mc-fd-product<?php echo $i; ?>-total-cost" ).html(((Number($("#mc-fd-product<?php echo $i; ?>-labour-incl-cutting").html()) + Number($("#mc-fd-product<?php echo $i; ?>-material-cost").html()))).toFixed(2));
$( "#mc-fd-product<?php echo $i; ?>-cost-markedup" ).html(((Number($("#mc-fd-product<?php echo $i; ?>-total-cost").html()) * (1 + (Number($("#mc-lm-m-list-5").html())/100)))).toFixed(2));
//*************FW**********************
$( "#mc-fw-product<?php echo $i; ?>-height" ).html($("#product<?php echo $i; ?>-height").val());
$( "#mc-fw-product<?php echo $i; ?>-width" ).html($("#product<?php echo $i; ?>-width").val());
$( "#mc-fw-product<?php echo $i; ?>-coat" ).html(((Number($("#mc-fw-product<?php echo $i; ?>-height").html()) + Number($("#mc-fw-product<?php echo $i; ?>-width").html()))*2/5000).toFixed(1));
$( "#mc-fw-product<?php echo $i; ?>-mesh-height" ).html(Number($("#mc-fw-product<?php echo $i; ?>-height").html()) );
$( "#mc-fw-product<?php echo $i; ?>-mesh-width" ).html(Number($("#mc-fw-product<?php echo $i; ?>-width").html()) );
$( "#mc-fw-product<?php echo $i; ?>-lmtrs" ).html(((Number($("#mc-fw-product<?php echo $i; ?>-mesh-height").html()) + Number($("#mc-fw-product<?php echo $i; ?>-mesh-width").html()))*2/1000).toFixed(1));
$( "#mc-fw-product<?php echo $i; ?>-sqm" ).html(((Number($("#mc-fw-product<?php echo $i; ?>-mesh-height").html()) * Number($("#mc-fw-product<?php echo $i; ?>-mesh-width").html()))/1000000).toFixed(3));
if ($("#product<?php echo $i; ?>-316-ss-gal-pet :selected").text()=='Pet'){	$( "#mc-fw-product<?php echo $i; ?>-price-sqm" ).html(((Number($("#mc-fw-product<?php echo $i; ?>-sqm").html()) * Number($("#mc-list-22").html()))).toFixed(2)); } else { $( "#mc-fw-product<?php echo $i; ?>-price-sqm" ).html(((Number($("#mc-fw-product<?php echo $i; ?>-sqm").html()) * Number($("#mc-list-21").html()))).toFixed(2));}
$( "#mc-fw-product<?php echo $i; ?>-window-frame-11mm-mfn" ).html($("#mc-list-20").html());
$( "#mc-fw-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated" ).html(((Number($("#mc-fw-product<?php echo $i; ?>-lmtrs").html()) * Number($("#mc-fw-product<?php echo $i; ?>-window-frame-11mm-mfn").html()))).toFixed(2));
$( "#mc-fw-product<?php echo $i; ?>-window-cnr-stake-4" ).html($("#mc-list-23").html());
$( "#mc-fw-product<?php echo $i; ?>-window-cnr-stake-4-calculated" ).html((Number($("#mc-fw-product<?php echo $i; ?>-window-cnr-stake-4").html()) * 4).toFixed(2));
$( "#mc-fw-product<?php echo $i; ?>-security-locking-bloc" ).html($("#mc-list-18").html());
$( "#mc-fw-product<?php echo $i; ?>-security-locking-bloc-calculated" ).html(((Number($("#mc-fw-product<?php echo $i; ?>-lmtrs").html()) * Number($("#mc-fw-product<?php echo $i; ?>-security-locking-bloc").html()))).toFixed(2));
if ($( "#color1:checked" ).length==1){	$("#mc-fw-product<?php echo $i; ?>-pwd-coat-spec-1").html(((Number($("#mc-fw-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-10").html()))).toFixed(2));} else {$("#mc-fw-product<?php echo $i; ?>-pwd-coat-spec-1").html('0.00');}
if ($( "#color2:checked" ).length==1){ $( "#mc-fw-product<?php echo $i; ?>-pwd-coat-spec-2" ).html(((Number($("#mc-fw-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-11").html()))).toFixed(2));} else {$("#mc-fw-product<?php echo $i; ?>-pwd-coat-spec-2").html('0.00');}
if ($( "#color3:checked" ).length==1){ $( "#mc-fw-product<?php echo $i; ?>-pwd-coat-spec-3" ).html(((Number($("#mc-fw-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-12").html()))).toFixed(2));} else {$("#mc-fw-product<?php echo $i; ?>-pwd-coat-spec-3").html('0.00');}
if ($( "#color4:checked" ).length==1){ $( "#mc-fw-product<?php echo $i; ?>-pwd-coat-spec-4" ).html(((Number($("#mc-fw-product<?php echo $i; ?>-coat").html()) * Number($("#mc-list-13").html()))).toFixed(2));} else {$("#mc-fw-product<?php echo $i; ?>-pwd-coat-spec-4").html('0.00');}
$( "#mc-fw-product<?php echo $i; ?>-material-cost" ).html((
Number($("#mc-fw-product<?php echo $i; ?>-pwd-coat-spec-1").html())+ 
Number($("#mc-fw-product<?php echo $i; ?>-pwd-coat-spec-2").html())+
Number($("#mc-fw-product<?php echo $i; ?>-pwd-coat-spec-3").html())+
Number($("#mc-fw-product<?php echo $i; ?>-pwd-coat-spec-4").html())+
Number($("#mc-fw-product<?php echo $i; ?>-price-sqm").html())+
Number($("#mc-fw-product<?php echo $i; ?>-window-frame-11mm-mfn-calculated").html())+
Number($("#mc-fw-product<?php echo $i; ?>-window-cnr-stake-4-calculated").html())+
Number($("#mc-fw-product<?php echo $i; ?>-security-locking-bloc-calculated").html())+
Number($("#mc-fw-product<?php echo $i; ?>-freight-consumables").html())).toFixed(2));
$( "#mc-fw-product<?php echo $i; ?>-labour-incl-cutting" ).html(((Number($("#mc-lm-r-list-6").html()) /60 * Number($("#mc-lm-t-list-6").html()))).toFixed(2));
$( "#mc-fw-product<?php echo $i; ?>-total-cost" ).html(((Number($("#mc-fw-product<?php echo $i; ?>-labour-incl-cutting").html()) + Number($("#mc-fw-product<?php echo $i; ?>-material-cost").html()))).toFixed(2));
$( "#mc-fw-product<?php echo $i; ?>-cost-markedup" ).html(((Number($("#mc-fw-product<?php echo $i; ?>-total-cost").html()) * (1 + (Number($("#mc-lm-m-list-6").html())/100)))).toFixed(2));
//*************************************RESULTS****************************************

<?php } ?>
}); 
$( "#ui-accordion-accordion-header-5" ).on( "click, ctrigger", function() {
$("#discounted-amount").val(($(this).val()*$("#total").val()/100).toFixed(2));
$("#final-amount").val(($("#total").val() - $("#discounted-amount").val()).toFixed(0));
$("#calculate").trigger('click');
if ($("#mr-window-or-door :selected").text()=='Window' && $("#mr-security-dgrille-fibre :selected").text()=='Security'){
		$("#mr-mc-sd").hide(); $("#mr-mc-sw").show(); $("#mr-mc-dd").hide(); $("#mr-mc-dw").hide(); $("#mr-mc-fd").hide(); $("#mr-mc-fw").hide(); $("#result-mr").show();
		$( "#mc-mr-result-cost" ).html($( "#mc-sw-mr-cost-markedup" ).html());
	}
	if ($("#mr-window-or-door :selected").text()=='Door'  && $("#mr-security-dgrille-fibre :selected").text()=='Security'){
		$("#mr-mc-sw").hide(); $("#mr-mc-sd").show(); $("#mr-mc-dd").hide(); $("#mr-mc-dw").hide(); $("#mr-mc-fd").hide(); $("#mr-mc-fw").hide(); $("#result-mr").show();
		$( "#mc-mr-result-cost" ).html($( "#mc-sd-mr-cost-markedup" ).html());}
	if ($("#mr-window-or-door :selected").text()=='Door'  && $("#mr-security-dgrille-fibre :selected").text()=='D/Grille'){
		$("#mr-mc-sw").hide(); $("#mr-mc-sd").hide(); $("#mr-mc-dd").show(); $("#mr-mc-dw").hide(); $("#mr-mc-fd").hide(); $("#mr-mc-fw").hide(); $("#result-mr").show();
		$( "#mc-mr-result-cost" ).html($( "#mc-dd-mr-cost-markedup" ).html());}
	if ($("#mr-window-or-door :selected").text()=='Window'  && $("#mr-security-dgrille-fibre :selected").text()=='D/Grille'){
		$("#mr-mc-sw").hide(); $("#mr-mc-sd").hide(); $("#mr-mc-dw").show(); $("#mr-mc-dd").hide(); $("#mr-mc-fd").hide(); $("#mr-mc-fw").hide(); $("#result-mr").show();
		$( "#mc-mr-result-cost" ).html($( "#mc-dw-mr-cost-markedup" ).html());}
	if ($("#mr-window-or-door :selected").text()=='Door'  && $("#mr-security-dgrille-fibre :selected").text()=='Fibre'){
		$("#mr-mc-sw").hide(); $("#mr-mc-sd").hide(); $("#mr-mc-fd").show(); $("#mr-mc-dw").hide(); $("#mr-mc-dd").hide(); $("#mr-mc-fw").hide(); $("#result-mr").show();
		$( "#mc-mr-result-cost" ).html($( "#mc-fd-mr-cost-markedup" ).html());}
	if ($("#mr-window-or-door :selected").text()=='Window'  && $("#mr-security-dgrille-fibre :selected").text()=='Fibre'){
		$("#mr-mc-sw").hide(); $("#mr-mc-sd").hide(); $("#mr-mc-fw").show(); $("#mr-mc-dw").hide(); $("#mr-mc-fd").hide(); $("#mr-mc-dd").hide(); $("#result-mr").show();
		$( "#mc-mr-result-cost" ).html($( "#mc-fw-mr-cost-markedup" ).html());}
	if ($("#mr-window-or-door :selected").text()==''){$("#mr-mc-sw").hide(); $("#mr-mc-sd").hide(); $("#mr-mc-dd").hide(); $("#mr-mc-dw").hide(); $("#mr-mc-fd").hide(); $("#mr-mc-fw").hide(); $("#result-mr").hide();}
$( "#mc-mr-result-quantity" ).html($( "#mr-quantity-of-panels" ).val());
$( "#mc-mr-result-total" ).html(((Number($( "#mc-mr-result-cost" ).html()) * Number($("#mc-mr-result-quantity").html())) ).toFixed(2) );
$( "#mr-distributor-price-incl-gst" ).html( ((100 + Number($( "#mc-lo-list-1" ).html()))/100* $( "#mc-mr-result-total" ).html()).toFixed(2) );
$( "input#mr-distributor-price-incl-gst" ).val( ((100 + Number($( "#mc-lo-list-1" ).html()))/100* $( "#mc-mr-result-total" ).html()).toFixed(2) );
$( "#mr-wholesaler-price-incl-gst" ).html( ((100 + Number($( "#mc-lo-list-2" ).html()))/100* $( "#mc-mr-result-total" ).html()).toFixed(2) );
$( "input#mr-wholesaler-price-incl-gst" ).val( ((100 + Number($( "#mc-lo-list-2" ).html()))/100* $( "#mc-mr-result-total" ).html()).toFixed(2) );
$( "#mr-retail-price-incl-gst" ).html( ((100 + Number($( "#mc-lo-list-3" ).html()))/100* $( "#mc-mr-result-total" ).html()).toFixed(2) );
$( "input#mr-retail-price-incl-gst" ).val( ((100 + Number($( "#mc-lo-list-3" ).html()))/100* $( "#mc-mr-result-total" ).html()).toFixed(2) );
if ($("#mr2-window-or-door :selected").text()=='Window' && $("#mr2-security-dgrille-fibre :selected").text()=='Security'){
		$("#mr2-mc-sd").hide(); $("#mr2-mc-sw").show(); $("#mr2-mc-dd").hide(); $("#mr2-mc-dw").hide(); $("#mr2-mc-fd").hide(); $("#mr2-mc-fw").hide(); $("#result-mr2").show();
		$( "#mc-mr2-result-cost" ).html($( "#mc-sw-mr2-cost-markedup" ).html());
	}
	if ($("#mr2-window-or-door :selected").text()=='Door'  && $("#mr2-security-dgrille-fibre :selected").text()=='Security'){
		$("#mr2-mc-sw").hide(); $("#mr2-mc-sd").show(); $("#mr2-mc-dd").hide(); $("#mr2-mc-dw").hide(); $("#mr2-mc-fd").hide(); $("#mr2-mc-fw").hide(); $("#result-mr2").show();
		$( "#mc-mr2-result-cost" ).html($( "#mc-sd-mr2-cost-markedup" ).html());}
	if ($("#mr2-window-or-door :selected").text()=='Door'  && $("#mr2-security-dgrille-fibre :selected").text()=='D/Grille'){
		$("#mr2-mc-sw").hide(); $("#mr2-mc-sd").hide(); $("#mr2-mc-dd").show(); $("#mr2-mc-dw").hide(); $("#mr2-mc-fd").hide(); $("#mr2-mc-fw").hide(); $("#result-mr2").show();
		$( "#mc-mr2-result-cost" ).html($( "#mc-dd-mr2-cost-markedup" ).html());}
	if ($("#mr2-window-or-door :selected").text()=='Window'  && $("#mr2-security-dgrille-fibre :selected").text()=='D/Grille'){
		$("#mr2-mc-sw").hide(); $("#mr2-mc-sd").hide(); $("#mr2-mc-dw").show(); $("#mr2-mc-dd").hide(); $("#mr2-mc-fd").hide(); $("#mr2-mc-fw").hide(); $("#result-mr2").show();
		$( "#mc-mr2-result-cost" ).html($( "#mc-dw-mr2-cost-markedup" ).html());}
	if ($("#mr2-window-or-door :selected").text()=='Door'  && $("#mr2-security-dgrille-fibre :selected").text()=='Fibre'){
		$("#mr2-mc-sw").hide(); $("#mr2-mc-sd").hide(); $("#mr2-mc-fd").show(); $("#mr2-mc-dw").hide(); $("#mr2-mc-dd").hide(); $("#mr2-mc-fw").hide(); $("#result-mr2").show();
		$( "#mc-mr2-result-cost" ).html($( "#mc-fd-mr2-cost-markedup" ).html());}
	if ($("#mr2-window-or-door :selected").text()=='Window'  && $("#mr2-security-dgrille-fibre :selected").text()=='Fibre'){
		$("#mr2-mc-sw").hide(); $("#mr2-mc-sd").hide(); $("#mr2-mc-fw").show(); $("#mr2-mc-dw").hide(); $("#mr2-mc-fd").hide(); $("#mr2-mc-dd").hide(); $("#result-mr2").show();
		$( "#mc-mr2-result-cost" ).html($( "#mc-fw-mr2-cost-markedup" ).html());}
	if ($("#mr2-window-or-door :selected").text()==''){$("#mr2-mc-sw").hide(); $("#mr2-mc-sd").hide(); $("#mr2-mc-dd").hide(); $("#mr2-mc-dw").hide(); $("#mr2-mc-fd").hide(); $("#mr2-mc-fw").hide(); $("#result-mr2").hide();}
$( "#mc-mr2-result-quantity" ).html($( "#mr2-quantity-of-panels" ).val());
$( "#mc-mr2-result-total" ).html(((Number($( "#mc-mr2-result-cost" ).html()) * Number($("#mc-mr2-result-quantity").html())) ).toFixed(2) );
$( "#mr2-distributor-price-incl-gst" ).html( ((100 + Number($( "#mc-lo-list-1" ).html()))/100* $( "#mc-mr2-result-total" ).html()).toFixed(2) );
$( "input#mr2-distributor-price-incl-gst" ).val( ((100 + Number($( "#mc-lo-list-1" ).html()))/100* $( "#mc-mr2-result-total" ).html()).toFixed(2) );
$( "#mr2-wholesaler-price-incl-gst" ).html( ((100 + Number($( "#mc-lo-list-2" ).html()))/100* $( "#mc-mr2-result-total" ).html()).toFixed(2) );
$( "input#mr2-wholesaler-price-incl-gst" ).val( ((100 + Number($( "#mc-lo-list-2" ).html()))/100* $( "#mc-mr2-result-total" ).html()).toFixed(2) );
$( "#mr2-retail-price-incl-gst" ).html( ((100 + Number($( "#mc-lo-list-3" ).html()))/100* $( "#mc-mr2-result-total" ).html()).toFixed(2) );
$( "input#mr2-retail-price-incl-gst" ).val( ((100 + Number($( "#mc-lo-list-3" ).html()))/100* $( "#mc-mr2-result-total" ).html()).toFixed(2) );
if ($("#mr3-window-or-door :selected").text()=='Window' && $("#mr3-security-dgrille-fibre :selected").text()=='Security'){
		$("#mr3-mc-sd").hide(); $("#mr3-mc-sw").show(); $("#mr3-mc-dd").hide(); $("#mr3-mc-dw").hide(); $("#mr3-mc-fd").hide(); $("#mr3-mc-fw").hide(); $("#result-mr3").show();
		$( "#mc-mr3-result-cost" ).html($( "#mc-sw-mr3-cost-markedup" ).html());
	}
	if ($("#mr3-window-or-door :selected").text()=='Door'  && $("#mr3-security-dgrille-fibre :selected").text()=='Security'){
		$("#mr3-mc-sw").hide(); $("#mr3-mc-sd").show(); $("#mr3-mc-dd").hide(); $("#mr3-mc-dw").hide(); $("#mr3-mc-fd").hide(); $("#mr3-mc-fw").hide(); $("#result-mr3").show();
		$( "#mc-mr3-result-cost" ).html($( "#mc-sd-mr3-cost-markedup" ).html());}
	if ($("#mr3-window-or-door :selected").text()=='Door'  && $("#mr3-security-dgrille-fibre :selected").text()=='D/Grille'){
		$("#mr3-mc-sw").hide(); $("#mr3-mc-sd").hide(); $("#mr3-mc-dd").show(); $("#mr3-mc-dw").hide(); $("#mr3-mc-fd").hide(); $("#mr3-mc-fw").hide(); $("#result-mr3").show();
		$( "#mc-mr3-result-cost" ).html($( "#mc-dd-mr3-cost-markedup" ).html());}
	if ($("#mr3-window-or-door :selected").text()=='Window'  && $("#mr3-security-dgrille-fibre :selected").text()=='D/Grille'){
		$("#mr3-mc-sw").hide(); $("#mr3-mc-sd").hide(); $("#mr3-mc-dw").show(); $("#mr3-mc-dd").hide(); $("#mr3-mc-fd").hide(); $("#mr3-mc-fw").hide(); $("#result-mr3").show();
		$( "#mc-mr3-result-cost" ).html($( "#mc-dw-mr3-cost-markedup" ).html());}
	if ($("#mr3-window-or-door :selected").text()=='Door'  && $("#mr3-security-dgrille-fibre :selected").text()=='Fibre'){
		$("#mr3-mc-sw").hide(); $("#mr3-mc-sd").hide(); $("#mr3-mc-fd").show(); $("#mr3-mc-dw").hide(); $("#mr3-mc-dd").hide(); $("#mr3-mc-fw").hide(); $("#result-mr3").show();
		$( "#mc-mr3-result-cost" ).html($( "#mc-fd-mr3-cost-markedup" ).html());}
	if ($("#mr3-window-or-door :selected").text()=='Window'  && $("#mr3-security-dgrille-fibre :selected").text()=='Fibre'){
		$("#mr3-mc-sw").hide(); $("#mr3-mc-sd").hide(); $("#mr3-mc-fw").show(); $("#mr3-mc-dw").hide(); $("#mr3-mc-fd").hide(); $("#mr3-mc-dd").hide(); $("#result-mr3").show();
		$( "#mc-mr3-result-cost" ).html($( "#mc-fw-mr3-cost-markedup" ).html());}
	if ($("#mr3-window-or-door :selected").text()==''){$("#mr3-mc-sw").hide(); $("#mr3-mc-sd").hide(); $("#mr3-mc-dd").hide(); $("#mr3-mc-dw").hide(); $("#mr3-mc-fd").hide(); $("#mr3-mc-fw").hide(); $("#result-mr3").hide();}
$( "#mc-mr3-result-quantity" ).html($( "#mr3-quantity-of-panels" ).val());
$( "#mc-mr3-result-total" ).html(((Number($( "#mc-mr3-result-cost" ).html()) * Number($("#mc-mr3-result-quantity").html())) ).toFixed(2) );
$( "#mr3-distributor-price-incl-gst" ).html( ((100 + Number($( "#mc-lo-list-1" ).html()))/100* $( "#mc-mr3-result-total" ).html()).toFixed(2) );
$( "input#mr3-distributor-price-incl-gst" ).val( ((100 + Number($( "#mc-lo-list-1" ).html()))/100* $( "#mc-mr3-result-total" ).html()).toFixed(2) );
$( "#mr3-wholesaler-price-incl-gst" ).html( ((100 + Number($( "#mc-lo-list-2" ).html()))/100* $( "#mc-mr3-result-total" ).html()).toFixed(2) );
$( "input#mr3-wholesaler-price-incl-gst" ).val( ((100 + Number($( "#mc-lo-list-2" ).html()))/100* $( "#mc-mr3-result-total" ).html()).toFixed(2) );
$( "#mr3-retail-price-incl-gst" ).html( ((100 + Number($( "#mc-lo-list-3" ).html()))/100* $( "#mc-mr3-result-total" ).html()).toFixed(2) );
$( "input#mr3-retail-price-incl-gst" ).val( ((100 + Number($( "#mc-lo-list-3" ).html()))/100* $( "#mc-mr3-result-total" ).html()).toFixed(2) );
	<?php for($i = 1; $i<$j; $i++){ ?>
	if ($("#product<?php echo $i; ?>-window-or-door :selected").text()=='Window' && $("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text()=='Security'){
		$("#pr<?php echo $i; ?>-mc-sd").hide(); $("#pr<?php echo $i; ?>-mc-sw").show(); $("#pr<?php echo $i; ?>-mc-dd").hide(); $("#pr<?php echo $i; ?>-mc-dw").hide(); $("#pr<?php echo $i; ?>-mc-fd").hide(); $("#pr<?php echo $i; ?>-mc-fw").hide(); $("#result<?php echo $i; ?>").show();
		$( "#mc-product<?php echo $i; ?>-result-cost" ).html($( "#mc-sw-product<?php echo $i; ?>-cost-markedup" ).html());
	}
	if ($("#product<?php echo $i; ?>-window-or-door :selected").text()=='Door'  && $("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text()=='Security'){
		$("#pr<?php echo $i; ?>-mc-sw").hide(); $("#pr<?php echo $i; ?>-mc-sd").show(); $("#pr<?php echo $i; ?>-mc-dd").hide(); $("#pr<?php echo $i; ?>-mc-dw").hide(); $("#pr<?php echo $i; ?>-mc-fd").hide(); $("#pr<?php echo $i; ?>-mc-fw").hide(); $("#result<?php echo $i; ?>").show();
		$( "#mc-product<?php echo $i; ?>-result-cost" ).html($( "#mc-sd-product<?php echo $i; ?>-cost-markedup" ).html());}
	if ($("#product<?php echo $i; ?>-window-or-door :selected").text()=='Door'  && $("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text()=='D/Grille'){
		$("#pr<?php echo $i; ?>-mc-sw").hide(); $("#pr<?php echo $i; ?>-mc-sd").hide(); $("#pr<?php echo $i; ?>-mc-dd").show(); $("#pr<?php echo $i; ?>-mc-dw").hide(); $("#pr<?php echo $i; ?>-mc-fd").hide(); $("#pr<?php echo $i; ?>-mc-fw").hide(); $("#result<?php echo $i; ?>").show();
		$( "#mc-product<?php echo $i; ?>-result-cost" ).html($( "#mc-dd-product<?php echo $i; ?>-cost-markedup" ).html());}
	if ($("#product<?php echo $i; ?>-window-or-door :selected").text()=='Window'  && $("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text()=='D/Grille'){
		$("#pr<?php echo $i; ?>-mc-sw").hide(); $("#pr<?php echo $i; ?>-mc-sd").hide(); $("#pr<?php echo $i; ?>-mc-dw").show(); $("#pr<?php echo $i; ?>-mc-dd").hide(); $("#pr<?php echo $i; ?>-mc-fd").hide(); $("#pr<?php echo $i; ?>-mc-fw").hide(); $("#result<?php echo $i; ?>").show();
		$( "#mc-product<?php echo $i; ?>-result-cost" ).html($( "#mc-dw-product<?php echo $i; ?>-cost-markedup" ).html());}
	if ($("#product<?php echo $i; ?>-window-or-door :selected").text()=='Door'  && $("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text()=='Fibre'){
		$("#pr<?php echo $i; ?>-mc-sw").hide(); $("#pr<?php echo $i; ?>-mc-sd").hide(); $("#pr<?php echo $i; ?>-mc-fd").show(); $("#pr<?php echo $i; ?>-mc-dw").hide(); $("#pr<?php echo $i; ?>-mc-dd").hide(); $("#pr<?php echo $i; ?>-mc-fw").hide(); $("#result<?php echo $i; ?>").show();
		$( "#mc-product<?php echo $i; ?>-result-cost" ).html($( "#mc-fd-product<?php echo $i; ?>-cost-markedup" ).html());}
	if ($("#product<?php echo $i; ?>-window-or-door :selected").text()=='Window'  && $("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text()=='Fibre'){
		$("#pr<?php echo $i; ?>-mc-sw").hide(); $("#pr<?php echo $i; ?>-mc-sd").hide(); $("#pr<?php echo $i; ?>-mc-fw").show(); $("#pr<?php echo $i; ?>-mc-dw").hide(); $("#pr<?php echo $i; ?>-mc-fd").hide(); $("#pr<?php echo $i; ?>-mc-dd").hide(); $("#result<?php echo $i; ?>").show();
		$( "#mc-product<?php echo $i; ?>-result-cost" ).html($( "#mc-fw-product<?php echo $i; ?>-cost-markedup" ).html());}
	if ($("#product<?php echo $i; ?>-window-or-door :selected").text()==''){$("#pr<?php echo $i; ?>-mc-sw").hide(); $("#pr<?php echo $i; ?>-mc-sd").hide(); $("#pr<?php echo $i; ?>-mc-dd").hide(); $("#pr<?php echo $i; ?>-mc-dw").hide(); $("#pr<?php echo $i; ?>-mc-fd").hide(); $("#pr<?php echo $i; ?>-mc-fw").hide(); $("#result<?php echo $i; ?>").hide();}
	$( "#mc-product<?php echo $i; ?>-result-quantity" ).html($( "#product<?php echo $i; ?>-quantity-of-panels" ).val());
if ($( "#product<?php echo $i; ?>-lock-type :selected" ).text()=="Single"){$( "#mc-product<?php echo $i; ?>-result-locks" ).html(Number($( "#product<?php echo $i; ?>-number-of-locks" ).val()) * Number($("#mc-list-14").html()));} 
else if($( "#product<?php echo $i; ?>-lock-type :selected" ).text()=="Trple Hngd"){$( "#mc-product<?php echo $i; ?>-result-locks" ).html(Number($( "#product<?php echo $i; ?>-number-of-locks" ).val()) * Number($("#mc-list-15").html()));} 
else if($( "#product<?php echo $i; ?>-lock-type :selected" ).text()=="Trple Sldng") {$( "#mc-product<?php echo $i; ?>-result-locks" ).html(Number($( "#product<?php echo $i; ?>-number-of-locks" ).val()) * Number($("#mc-list-16").html()));} 
else {$( "#mc-product<?php echo $i; ?>-result-locks" ).html('0.00');}
$( "#mc-product<?php echo $i; ?>-result-total" ).html(((Number($( "#mc-product<?php echo $i; ?>-result-cost" ).html()) * Number($("#mc-product<?php echo $i; ?>-result-quantity").html())) + Number($("#mc-product<?php echo $i; ?>-result-locks").html())).toFixed(2) );
$( "#product<?php echo $i; ?>-distributor-price-incl-gst" ).html( ((100 + Number($( "#mc-lo-list-1" ).html()))/100* $( "#mc-product<?php echo $i; ?>-result-total" ).html()).toFixed(2) );
$( "input#product<?php echo $i; ?>-distributor-price-incl-gst" ).val( ((100 + Number($( "#mc-lo-list-1" ).html()))/100* $( "#mc-product<?php echo $i; ?>-result-total" ).html()).toFixed(2) );
$( "#product<?php echo $i; ?>-wholesaler-price-incl-gst" ).html( ((100 + Number($( "#mc-lo-list-2" ).html()))/100* $( "#mc-product<?php echo $i; ?>-result-total" ).html()).toFixed(2) );
$( "input#product<?php echo $i; ?>-wholesaler-price-incl-gst" ).val( ((100 + Number($( "#mc-lo-list-2" ).html()))/100* $( "#mc-product<?php echo $i; ?>-result-total" ).html()).toFixed(2) );
$( "#product<?php echo $i; ?>-retail-price-incl-gst" ).html( ((100 + Number($( "#mc-lo-list-3" ).html()))/100* $( "#mc-product<?php echo $i; ?>-result-total" ).html()).toFixed(2) );
$( "input#product<?php echo $i; ?>-retail-price-incl-gst" ).val( ((100 + Number($( "#mc-lo-list-3" ).html()))/100* $( "#mc-product<?php echo $i; ?>-result-total" ).html()).toFixed(2) );
if($( "#product<?php echo $i; ?>-emergency-window" ).is(":checked")) {
$( "#product<?php echo $i; ?>-distributor-price-incl-gst" ).html( (Number($( "#product<?php echo $i; ?>-distributor-price-incl-gst" ).html()) + Number(140)).toFixed(2) );
$( "input#product<?php echo $i; ?>-distributor-price-incl-gst" ).val( (Number($( "input#product<?php echo $i; ?>-distributor-price-incl-gst" ).val()) + Number(140)).toFixed(2) );
$( "#product<?php echo $i; ?>-wholesaler-price-incl-gst" ).html( (Number($( "#product<?php echo $i; ?>-wholesaler-price-incl-gst" ).html()) + Number(140)).toFixed(2)  );
$( "input#product<?php echo $i; ?>-wholesaler-price-incl-gst" ).val( (Number($( "input#product<?php echo $i; ?>-wholesaler-price-incl-gst" ).val()) + Number(140)).toFixed(2) );
$( "#product<?php echo $i; ?>-retail-price-incl-gst" ).html( (Number($( "#product<?php echo $i; ?>-retail-price-incl-gst" ).html()) + Number(140)).toFixed(2)  );
$( "input#product<?php echo $i; ?>-retail-price-incl-gst" ).val( (Number($( "input#product<?php echo $i; ?>-retail-price-incl-gst" ).val()) + Number(140)).toFixed(2) );
}
	<?php } ?>
<?php if ($role == "manufacturer") { ?>
$("#total").val((
Number(
Number($("#extra1-charged").val()) +
Number($("#extra2-charged").val()) +
Number($("#extra3-charged").val()) +
Number($("#extra4-charged").val()) +
Number($("#extra5-charged").val()) +
Number($("#extra6-charged").val()) +
Number($("#extra7-charged").val()) +
Number($("#extra8-charged").val()) +
Number($("#extra9-charged").val()) +
Number($("#extra10-charged").val()) +
Number($("#mc-mr-result-total").html()) +
Number($("#mc-mr2-result-total").html()) +
Number($("#mc-mr3-result-total").html()) +
<?php for($i = 1; $i<30; $i++){ ?> Number($("#mc-product<?php echo $i; ?>-result-total").html()) + <?php }
 ?>Number($("#mc-product<?php echo $j-1; ?>-result-total").html()) +
<?php for($i = 1; $i<10; $i++){ ?> Number($("#additional<?php echo $i; ?>-price").val()) + <?php } ?> +
Number($("#additional<?php echo $i; ?>-price").val()) +
<?php for($i = 1; $i<5; $i++){ ?> Number($("#additional<?php echo $i; ?>-l-price").val()) + <?php } ?> +
Number($("#additional<?php echo $i; ?>-l-price").val()) +
<?php for($i = 1; $i<3; $i++){ ?> Number($("#accessory<?php echo $i; ?>-price").val()) + <?php } ?> +
Number($("#accessory<?php echo $i; ?>-price").val())
)).toFixed(2));
<?php } if (($role=='manufacturer' && $mf_role == 'distributor') || $role=="distributor") {?>
$("#total-d").val(( ((100 + Number($( "#mc-lo-list-1" ).html()))/100)*
Number(
Number($("#mc-mr-result-total").html()) +
Number($("#mc-mr2-result-total").html()) +
Number($("#mc-mr3-result-total").html()) +
<?php for($i = 1; $i<30; $i++){ ?> Number($("#mc-product<?php echo $i; ?>-result-total").html()) + <?php } ?>Number($("#mc-product<?php echo $j-1; ?>-result-total").html()) 
)
+
Number (
<?php for($i = 1; $i<10; $i++){ ?> Number($("#additional<?php echo $i; ?>-price").val()) + <?php } ?> +
Number($("#additional<?php echo $i; ?>-price").val()) +
<?php for($i = 1; $i<5; $i++){ ?> Number($("#additional<?php echo $i; ?>-l-price").val()) + <?php } ?> +
Number($("#additional<?php echo $i; ?>-l-price").val()) +
<?php for($i = 1; $i<3; $i++){ ?> Number($("#accessory<?php echo $i; ?>-price").val()) + <?php } ?> +
Number($("#accessory<?php echo $i; ?>-price").val()) +
Number($("#extra1-charged").val()) +
Number($("#extra2-charged").val()) +
Number($("#extra3-charged").val()) +
Number($("#extra4-charged").val()) +
Number($("#extra5-charged").val()) +
Number($("#extra6-charged").val()) +
Number($("#extra7-charged").val()) +
Number($("#extra8-charged").val()) +
Number($("#extra9-charged").val()) +
Number($("#extra10-charged").val()) +
Number($("#freight-cost").val()))).toFixed(2));

$("#total-d-p").val(( (100 + Number($( "#mc-lo-list-1" ).html()))/100*
Number(
<?php for($i = 1; $i<30; $i++){ ?> Number($("#mc-product<?php echo $i; ?>-result-total").html()) + <?php } ?>Number($("#mc-product<?php echo $j-1; ?>-result-total").html())
//NEWLY REMOVE
)).toFixed(2));

//NEWLY ADDED
$("#total-d-mr").val(( (100 + Number($( "#mc-lo-list-1" ).html()))/100*
Number(
Number($("#mc-mr-result-total").html()) +
Number($("#mc-mr2-result-total").html()) +
Number($("#mc-mr3-result-total").html()))).toFixed(2));
//NEWLY ADD ENDS

/******/

var dtm = (100 + Number($( "#mc-lo-list-1" ).html()))/100;
$("#total-d-p-ss").val("0.00");
<?php for($i = 1; $i<31; $i++){ ?>	
if($("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text() == "Security"){
		$("#total-d-p-ss").val(Number(Number($("#total-d-p-ss").val())+Number(dtm*Number($("#mc-product<?php echo $i; ?>-result-total").html()))).toFixed(2)); 
}
<?php } ?>
//NEWLY REMOVE



$("#total-d-p-dg").val("0.00");
<?php for($i = 1; $i<31; $i++){ ?>	
if($("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text() == "D/Grille"){
		$("#total-d-p-dg").val(Number(Number($("#total-d-p-dg").val())+Number(dtm*Number($("#mc-product<?php echo $i; ?>-result-total").html()))).toFixed(2)); 
}
<?php } ?>
//NEWLY REMOVE


/****/

$("#total-d-aaem").val((
Number(
Number($("#extra1-charged").val()) +
Number($("#extra2-charged").val()) +
Number($("#extra3-charged").val()) +
Number($("#extra4-charged").val()) +
Number($("#extra5-charged").val()) +
Number($("#extra6-charged").val()) +
Number($("#extra7-charged").val()) +
Number($("#extra8-charged").val()) +
Number($("#extra9-charged").val()) +
Number($("#extra10-charged").val()) +
Number($("#freight-cost").val()) +
<?php for($i = 1; $i<10; $i++){ ?> Number($("#additional<?php echo $i; ?>-price").val()) + <?php } ?> +
Number($("#additional<?php echo $i; ?>-price").val()) +
<?php for($i = 1; $i<5; $i++){ ?> Number($("#additional<?php echo $i; ?>-l-price").val()) + <?php } ?> +
Number($("#additional<?php echo $i; ?>-l-price").val()) +
<?php for($i = 1; $i<3; $i++){ ?> Number($("#accessory<?php echo $i; ?>-price").val()) + <?php } ?> +
Number($("#accessory<?php echo $i; ?>-price").val()))).toFixed(2));

<?php } if (($role=='manufacturer' && $mf_role == 'wholesaler') || $role=='wholesaler') {?>
$("#total-wh").val(( ((100 + Number($( "#mc-lo-list-2" ).html()))/100)*
Number(

Number($("#mc-mr-result-total").html()) +
Number($("#mc-mr2-result-total").html()) +
Number($("#mc-mr3-result-total").html()) +
<?php for($i = 1; $i<30; $i++){ ?> Number($("#mc-product<?php echo $i; ?>-result-total").html()) + <?php } ?>Number($("#mc-product<?php echo $j-1; ?>-result-total").html())
) +
Number(
<?php for($i = 1; $i<10; $i++){ ?> Number($("#additional<?php echo $i; ?>-price").val()) + <?php } ?> +
Number($("#additional<?php echo $i; ?>-price").val()) +
<?php for($i = 1; $i<5; $i++){ ?> Number($("#additional<?php echo $i; ?>-l-price").val()) + <?php } ?> +
Number($("#additional<?php echo $i; ?>-l-price").val()) +
<?php for($i = 1; $i<3; $i++){ ?> Number($("#accessory<?php echo $i; ?>-price").val()) + <?php } ?> +
Number($("#accessory<?php echo $i; ?>-price").val())+
Number($("#extra1-charged").val()) +
Number($("#extra2-charged").val()) +
Number($("#extra3-charged").val()) +
Number($("#extra4-charged").val()) +
Number($("#extra5-charged").val()) +
Number($("#extra6-charged").val()) +
Number($("#extra7-charged").val()) +
Number($("#extra8-charged").val()) +
Number($("#extra9-charged").val()) +
Number($("#extra10-charged").val()) +
Number($("#freight-cost").val()) )).toFixed(2));

$("#total-wh-p").val(( (100 + Number($( "#mc-lo-list-2" ).html()))/100*
Number(
<?php for($i = 1; $i<30; $i++){ ?> Number($("#mc-product<?php echo $i; ?>-result-total").html()) + <?php } ?>Number($("#mc-product<?php echo $j-1; ?>-result-total").html())
//Newly Remove
)).toFixed(2));

//NEWLY ADDED
$("#total-wh-mr").val(( (100 + Number($( "#mc-lo-list-2" ).html()))/100*
Number(
Number($("#mc-mr-result-total").html()) +
Number($("#mc-mr2-result-total").html()) +
Number($("#mc-mr3-result-total").html()))).toFixed(2));
//NEWLY ADD ENDS

/******/

var dtm = (100 + Number($( "#mc-lo-list-2" ).html()))/100;
$("#total-wh-p-ss").val("0.00");
<?php for($i = 1; $i<31; $i++){ ?>	
if($("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text() == "Security"){
		$("#total-wh-p-ss").val(Number(Number($("#total-wh-p-ss").val())+Number(dtm*Number($("#mc-product<?php echo $i; ?>-result-total").html()))).toFixed(2)); 
}
<?php } ?>
//Newly Remove



$("#total-wh-p-dg").val("0.00");
<?php for($i = 1; $i<31; $i++){ ?>	
if($("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text() == "D/Grille"){
		$("#total-wh-p-dg").val(Number(Number($("#total-wh-p-dg").val())+Number(dtm*Number($("#mc-product<?php echo $i; ?>-result-total").html()))).toFixed(2)); 
}
<?php } ?>
//Newly Remove


/****/

$("#total-wh-aaem").val((
Number(
Number($("#extra1-charged").val()) +
Number($("#extra2-charged").val()) +
Number($("#extra3-charged").val()) +
Number($("#extra4-charged").val()) +
Number($("#extra5-charged").val()) +
Number($("#extra6-charged").val()) +
Number($("#extra7-charged").val()) +
Number($("#extra8-charged").val()) +
Number($("#extra9-charged").val()) +
Number($("#extra10-charged").val()) +
Number($("#freight-cost").val()) +
<?php for($i = 1; $i<10; $i++){ ?> Number($("#additional<?php echo $i; ?>-price").val()) + <?php } ?> +
Number($("#additional<?php echo $i; ?>-price").val()) +
<?php for($i = 1; $i<5; $i++){ ?> Number($("#additional<?php echo $i; ?>-l-price").val()) + <?php } ?> +
Number($("#additional<?php echo $i; ?>-l-price").val()) +
<?php for($i = 1; $i<3; $i++){ ?> Number($("#accessory<?php echo $i; ?>-price").val()) + <?php } ?> +
Number($("#accessory<?php echo $i; ?>-price").val()))).toFixed(2));

<?php } if (($role=='manufacturer' && $mf_role == 'retailer') || $role=='retailer') {?>
$("#total-re").val(( ((100 + Number($( "#mc-lo-list-3" ).html()))/100)*
Number(
Number($("#mc-mr-result-total").html()) +
Number($("#mc-mr2-result-total").html()) +
Number($("#mc-mr3-result-total").html()) +
<?php for($i = 1; $i<30; $i++){ ?> Number($("#mc-product<?php echo $i; ?>-result-total").html()) + <?php } ?>Number($("#mc-product<?php echo $j-1; ?>-result-total").html())
) +
Number(
<?php for($i = 1; $i<10; $i++){ ?> Number($("#additional<?php echo $i; ?>-price").val()) + <?php } ?> +
Number($("#additional<?php echo $i; ?>-price").val()) +
<?php for($i = 1; $i<5; $i++){ ?> Number($("#additional<?php echo $i; ?>-l-price").val()) + <?php } ?> +
Number($("#additional<?php echo $i; ?>-l-price").val()) +
<?php for($i = 1; $i<3; $i++){ ?> Number($("#accessory<?php echo $i; ?>-price").val()) + <?php } ?> +
Number($("#accessory<?php echo $i; ?>-price").val())+
Number($("#extra1-charged").val()) +
Number($("#extra2-charged").val()) +
Number($("#extra3-charged").val()) +
Number($("#extra4-charged").val()) +
Number($("#extra5-charged").val()) +
Number($("#extra6-charged").val()) +
Number($("#extra7-charged").val()) +
Number($("#extra8-charged").val()) +
Number($("#extra9-charged").val()) +
Number($("#extra10-charged").val()) +
Number($("#freight-cost").val()))).toFixed(2));

$("#total-re-p").val(( (100 + Number($( "#mc-lo-list-3" ).html()))/100*
Number(
<?php for($i = 1; $i<30; $i++){ ?> Number($("#mc-product<?php echo $i; ?>-result-total").html()) + <?php } ?>Number($("#mc-product<?php echo $j-1; ?>-result-total").html())
//NEWLY REMOVE
)).toFixed(2));

//NEWLY ADDED
$("#total-re-mr").val(( (100 + Number($( "#mc-lo-list-3" ).html()))/100*
Number(
Number($("#mc-mr-result-total").html()) +
Number($("#mc-mr2-result-total").html()) +
Number($("#mc-mr3-result-total").html()))).toFixed(2));
//NEWLY ADD ENDS

/******/

var dtm = (100 + Number($( "#mc-lo-list-3" ).html()))/100;
$("#total-re-p-ss").val("0.00");
<?php for($i = 1; $i<31; $i++){ ?>	
if($("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text() == "Security"){
		$("#total-re-p-ss").val(Number(Number($("#total-re-p-ss").val())+Number(dtm*Number($("#mc-product<?php echo $i; ?>-result-total").html()))).toFixed(2)); 
}
<?php } ?>
//NEWLY REMOVE



$("#total-re-p-dg").val("0.00");
<?php for($i = 1; $i<31; $i++){ ?>	
if($("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text() == "D/Grille"){
		$("#total-re-p-dg").val(Number(Number($("#total-re-p-dg").val())+Number(dtm*Number($("#mc-product<?php echo $i; ?>-result-total").html()))).toFixed(2)); 
}
<?php } ?>
//NEWLY REMOVE


/****/

$("#total-re-aaem").val((
Number(
Number($("#extra1-charged").val()) +
Number($("#extra2-charged").val()) +
Number($("#extra3-charged").val()) +
Number($("#extra4-charged").val()) +
Number($("#extra5-charged").val()) +
Number($("#extra6-charged").val()) +
Number($("#extra7-charged").val()) +
Number($("#extra8-charged").val()) +
Number($("#extra9-charged").val()) +
Number($("#extra10-charged").val()) +
Number($("#freight-cost").val()) +
<?php for($i = 1; $i<10; $i++){ ?> Number($("#additional<?php echo $i; ?>-price").val()) + <?php } ?> +
Number($("#additional<?php echo $i; ?>-price").val()) +
<?php for($i = 1; $i<5; $i++){ ?> Number($("#additional<?php echo $i; ?>-l-price").val()) + <?php } ?> +
Number($("#additional<?php echo $i; ?>-l-price").val()) +
<?php for($i = 1; $i<3; $i++){ ?> Number($("#accessory<?php echo $i; ?>-price").val()) + <?php } ?> +
Number($("#accessory<?php echo $i; ?>-price").val()))).toFixed(2));
<?php } ?>


<?php for($i = 1; $i<31; $i++){ ?>
if($( "#product<?php echo $i; ?>-emergency-window" ).is(":checked")) {
$("#total-d").val( (Number($("#total-d").val()) + Number(140)).toFixed(2) );
$("#total-d-p").val( (Number($("#total-d-p").val()) + Number(140)).toFixed(2) );
$("#total-wh").val( (Number($("#total-wh").val()) + Number(140)).toFixed(2) );
$("#total-wh-p").val( (Number($("#total-wh-p").val()) + Number(140)).toFixed(2) );
$("#total-re").val( (Number($("#total-re").val()) + Number(140)).toFixed(2) );
$("#total-re-p").val( (Number($("#total-re-p").val()) + Number(140)).toFixed(2) );
}
<?php } ?>

//NEWLY EDIT STARTS
$("#total-d-buy-price").val((Number($("#total-d-p").val()) + Number($("#total-d-mr").val()) + Number($("#total-d-aaem").val())).toFixed(2)); 
$("#total-wh-buy-price").val((Number($("#total-wh-p").val()) + Number($("#total-wh-mr").val()) + Number($("#total-wh-aaem").val())).toFixed(2)); 
$("#total-re-buy-price").val((Number($("#total-re-p").val()) + Number($("#total-re-mr").val()) + Number($("#total-re-aaem").val())).toFixed(2)); 
//NEWLY EDIT ENDS

$("#discounted-amount").val(($("#discount").val()*$("#total").val()/100).toFixed(2));
$("#final-amount").val(($("#total").val() - $("#discounted-amount").val()+
Number ($("#total-installation-cost").html())).toFixed(0));

$("#discounted-amount-d").val(($("#discount-d").val()*(Number($("#total-d-p").val())+Number($("#markedup-amount-d").val()))/100).toFixed(2));
/*start edit**/
$("#markedup-amount-d").val(($("#markup-d").val()*($("#total-d-p").val() - $("#total-d-p-ss").val() - $("#total-d-p-dg").val())/100).toFixed(2));
/*end edit**/

/*start**/
$("#markedup-amount-d-ss").val(($("#markup-d-ss").val()*$("#total-d-p-ss").val()/100).toFixed(2));
$("#markedup-amount-d-dg").val(($("#markup-d-dg").val()*$("#total-d-p-dg").val()/100).toFixed(2));
/*end**/

$("#final-amount-d").val(($("#total-d").val() - $("#discounted-amount-d").val()+ Number ($("#total-installation-cost").html()) ).toFixed(0));

$("#discounted-amount-wh").val(($("#discount-wh").val()*$("#total-wh-p").val()/100).toFixed(2));
/*start edit**/
$("#markedup-amount-wh").val(($("#markup-wh").val()*($("#total-wh-p").val()- $("#total-wh-p-ss").val() - $("#total-wh-p-dg").val())/100).toFixed(2));
/*end edit**/

/*start**/
$("#markedup-amount-wh-ss").val(($("#markup-wh-ss").val()*$("#total-wh-p-ss").val()/100).toFixed(2));
$("#markedup-amount-wh-dg").val(($("#markup-wh-dg").val()*$("#total-wh-p-dg").val()/100).toFixed(2));
/*end**/
$("#final-amount-wh").val((Number($("#total-wh").val()) + Number($("#markedup-amount-wh").val()) - $("#discounted-amount-wh").val()+
Number ($("#total-installation-cost").html())).toFixed(0));

$("#discounted-amount-re").val(($("#discount-re").val()*$("#total-re-p").val()/100).toFixed(2));
$("#final-amount-re").val(($("#total-re").val() - $("#discounted-amount-re").val()+
Number ($("#total-installation-cost").html())).toFixed(0));

calculateProfit();






$("#discount").change(function() {
$("#discounted-amount").val(($(this).val()*$("#total").val()/100).toFixed(2));
$("#final-amount").val(($("#total").val() - $("#discounted-amount").val()+ Number($("#total-installation-cost").html())).toFixed(0));
}
);

$("#discount-d").change(function() {
/*start edit**/
$("#discounted-amount-d").val(($(this).val()*(Number($("#total-d-p").val())+Number($("#markedup-amount-d").val())+Number($("#markedup-amount-d-ss").val())+Number($("#markedup-amount-d-dg").val()))/100).toFixed(2));
$("#final-amount-d").val(($("#total-d").val() - $("#discounted-amount-d").val() + Number($("#markedup-amount-d").val()) + Number($("#markedup-amount-d-ss").val()) + Number($("#markedup-amount-d-dg").val()) + Number($("#total-installation-cost").html())).toFixed(0));
/*end edit**/

calculateProfit();
calculateSellProfit(); 
}
);

$("#discount-wh").change(function() {
/*start edit**/
$("#discounted-amount-wh").val(($(this).val()*(Number($("#total-wh-p").val())+Number($("#markedup-amount-wh").val()) + +Number($("#markedup-amount-wh-ss").val()) + Number($("#markedup-amount-wh-dg").val()))/100).toFixed(2));
$("#final-amount-wh").val(($("#total-wh").val() - $("#discounted-amount-wh").val() + Number($("#markedup-amount-wh").val()) + Number($("#markedup-amount-wh-ss").val()) + Number($("#markedup-amount-wh-dg").val()) + Number($("#total-installation-cost").html())).toFixed(0));
/*end edit**/

calculateProfit();
calculateSellProfit(); 
}
);

$("#discount-re").change(function() {
$("#discounted-amount-re").val(($(this).val()*$("#total-re-p").val()/100).toFixed(2));
$("#final-amount-re").val(($("#total-re").val() - $("#discounted-amount-re").val()+ Number($("#total-installation-cost").html())).toFixed(0));
calculateProfit();
calculateSellProfit(); 
}
);



$("#markup-d").change(function() {
/*start edit**/
$("#markedup-amount-d").val(($(this).val()*($("#total-d-p").val() - $("#total-d-p-ss").val() - $("#total-d-p-dg").val())/100).toFixed(2));
/*end edit**/
$("#final-amount-d").val(($("#total-d").val() - $("#discounted-amount-d").val() + Number($("#markedup-amount-d").val()) + Number($("#total-installation-cost").html())).toFixed(0));
setTimeout(function(){$("#discount-d").trigger('change');},100);
});

/*start**/
$("#markup-d-ss").change(function() {
$("#markedup-amount-d-ss").val(($(this).val()*$("#total-d-p-ss").val()/100).toFixed(2));
setTimeout(function(){$("#discount-d").trigger('change');},100);
});

$("#markup-d-dg").change(function() {
$("#markedup-amount-d-dg").val(($(this).val()*$("#total-d-p-dg").val()/100).toFixed(2));
setTimeout(function(){$("#discount-d").trigger('change');},100);
});
/*end**/



$("#markup-wh").change(function() {
/*start edit**/
$("#markedup-amount-wh").val(($(this).val()*($("#total-wh-p").val()- $("#total-wh-p-ss").val() - $("#total-wh-p-dg").val())/100).toFixed(2));
/*end edit**/
$("#final-amount-wh").val(($("#total-wh").val() - $("#discounted-amount-wh").val() + Number($("#markedup-amount-wh").val()) + Number($("#total-installation-cost").html())).toFixed(0));
setTimeout(function(){$("#discount-wh").trigger('change');},100);
});


/*start**/
$("#markup-wh-ss").change(function() {
$("#markedup-amount-wh-ss").val(($(this).val()*$("#total-wh-p-ss").val()/100).toFixed(2));
setTimeout(function(){$("#discount-wh").trigger('change');},100);
});

$("#markup-wh-dg").change(function() {
$("#markedup-amount-wh-dg").val(($(this).val()*$("#total-wh-p-dg").val()/100).toFixed(2));
setTimeout(function(){$("#discount-wh").trigger('change');},100);
});
/*end**/
});

var calculateProfit = function(){
	$("#profit-amount-d").val(($("#final-amount-d").val() - $("#total-d-p").val() - $("#total-d-mr").val() - $("#total-d-aaem").val() - $("#total-installation-cost").text()).toFixed(2));
	$("#profit-amount-wh").val(($("#final-amount-wh").val() - $("#total-wh-p").val() - $("#total-wh-mr").val() - $("#total-wh-aaem").val()- $("#total-installation-cost").text()).toFixed(2));
	$("#profit-amount-re").val(($("#final-amount-re").val() - $("#total-re-p").val() - $("#total-re-mr").val() - $("#total-re-aaem").val()- $("#total-installation-cost").text()).toFixed(2));
	if($("#profit-amount-d").val()== "-0.00" || $("#profit-amount-d").val()=="-0.01"){$("#profit-amount-d").val("0.0");}
	if($("#profit-amount-wh").val()== "-0.00" || $("#profit-amount-wh").val()=="-0.01"){$("#profit-amount-wh").val("0.0");}
	if($("#profit-amount-re").val()== "-0.00" || $("#profit-amount-re").val()=="-0.01"){$("#profit-amount-re").val("0.0");}
}

$( ".extra-price, .extra-markup, .extra-qty" ).on( "change", function() { 
	$(this).parent().parent().find(".extra-charged").val( ($(this).parent().parent().find(".extra-price").val() * $(this).parent().parent().find(".extra-qty").val() * (100 + Number($(this).parent().parent().find(".extra-markup").val() ))/ 100 ).toFixed(2));
});
$( ".extra-price" ).trigger("change");

$(".quote input, .quote select").change(function() {
	$("#ui-accordion-accordion-header-4").trigger("ctrigger");
	$("#ui-accordion-accordion-header-5").trigger("ctrigger");
	$("#ui-accordion-accordion-header-3").trigger("ctrigger");

	$("#discount-d").trigger('change');
	$("#discount-wh").trigger('change');
	$("#discount-re").trigger('change');
	}
);



$.fn.togglepanels = function(){
  return this.each(function(){
    $(this).addClass("ui-accordion ui-accordion-icons ui-widget ui-helper-reset")
  .find("h3")
    .addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom")
    .hover(function() { $(this).toggleClass("ui-state-hover"); })
    .prepend('<span class="ui-icon ui-icon-triangle-1-e"></span>')
    .click(function() {
      $(this)
        .toggleClass("ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom")
        .find("> .ui-icon").toggleClass("ui-icon-triangle-1-e ui-icon-triangle-1-s").end()
        .next().slideToggle();
      return false;
    })
    .next()
      .addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom")
      .hide();
  });
};

$("#accordion").togglepanels();

$( "#color1" ).on( "click", function() { $("#product1-width").trigger('change'); });
$( "#color2" ).on( "click", function() { $("#product2-width").trigger('change'); });
$( "#color3" ).on( "click", function() { $("#product3-width").trigger('change'); });
$( "#color4" ).on( "click", function() { $("#product4-width").trigger('change'); });

var calculateSellProfit = function(){
<?php for($i = 1; $i<31; $i++){
if (($role=='manufacturer' && $mf_role == 'distributor') || $role=="distributor") {?>
//edit starts	
	if($("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text() == "Security"){
		$( "#product<?php echo $i; ?>-distributor-sell-price" ).html( ($("#product<?php echo $i; ?>-distributor-price-incl-gst" ).html()*(100 + Number($( "#markup-d-ss" ).val()))/100*(100 - Number($( "#discount-d" ).val()))/100).toFixed(2) );
	} else if($("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text() == "D/Grille"){
		$( "#product<?php echo $i; ?>-distributor-sell-price" ).html( ($("#product<?php echo $i; ?>-distributor-price-incl-gst" ).html()*(100 + Number($( "#markup-d-dg" ).val()))/100*(100 - Number($( "#discount-d" ).val()))/100).toFixed(2) );
	} else {
		$( "#product<?php echo $i; ?>-distributor-sell-price" ).html( ($("#product<?php echo $i; ?>-distributor-price-incl-gst" ).html()*(100 + Number($( "#markup-d" ).val()))/100*(100 - Number($( "#discount-d" ).val()))/100).toFixed(2) );
	}
//edit ends
$( "#product<?php echo $i; ?>-distributor-profit" ).html( Number(Number( $("#product<?php echo $i; ?>-distributor-sell-price" ).html())-Number($("#product<?php echo $i; ?>-distributor-price-incl-gst" ).html())).toFixed(2) );

<?php } if (($role=='manufacturer' && $mf_role == 'wholesaler') || $role=='wholesaler') {?>
//edit starts	
	if($("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text() == "Security"){
		$( "#product<?php echo $i; ?>-wholesaler-sell-price" ).html( ($("#product<?php echo $i; ?>-wholesaler-price-incl-gst" ).html()*(100 + Number($( "#markup-wh-ss" ).val()))/100*(100 - Number($( "#discount-wh" ).val()))/100).toFixed(2) );
	} else if($("#product<?php echo $i; ?>-security-dgrille-fibre :selected").text() == "D/Grille"){
		$( "#product<?php echo $i; ?>-wholesaler-sell-price" ).html( ($("#product<?php echo $i; ?>-wholesaler-price-incl-gst" ).html()*(100 + Number($( "#markup-wh-dg" ).val()))/100*(100 - Number($( "#discount-wh" ).val()))/100).toFixed(2) );
	} else {
		$( "#product<?php echo $i; ?>-wholesaler-sell-price" ).html( ($("#product<?php echo $i; ?>-wholesaler-price-incl-gst" ).html()*(100 + Number($( "#markup-wh" ).val()))/100*(100 - Number($( "#discount-wh" ).val()))/100).toFixed(2) );
	}
//edit ends	
$( "#product<?php echo $i; ?>-wholesaler-profit" ).html( Number(Number( $("#product<?php echo $i; ?>-wholesaler-sell-price" ).html())-Number($("#product<?php echo $i; ?>-wholesaler-price-incl-gst" ).html())).toFixed(2) );

<?php } if (($role=='manufacturer' && $mf_role == 'retailer') || $role=='retailer') {?>
$( "#product<?php echo $i; ?>-retail-sell-price" ).html( ($("#product<?php echo $i; ?>-retail-price-incl-gst" ).html()*(100 - Number($( "#discount-re" ).val()))/100).toFixed(2) );
$( "#product<?php echo $i; ?>-retail-profit" ).html( Number(Number( $("#product<?php echo $i; ?>-retail-sell-price" ).html())-Number($("#product<?php echo $i; ?>-retail-price-incl-gst" ).html())).toFixed(2) );
<?php } } ?>
}

 
	$(".additional-name").trigger("change");
	$(".accessory-name").trigger("change");
	$("#product1-item-number").trigger("change");


$( "#save_as_a_new_quote" ).on( "click", function() { $("form").attr("action","/mrmeshit/wp-content/themes/twentytwelve/quote_copy_process.php"); });
$( "#save_quote" ).on( "click", function() { $("form").attr("action","/mrmeshit/wp-content/themes/twentytwelve/quote_edit_process.php"); });
$( "#quote_order" ).on( "click", function() { 
if( confirm('Send Check Measure Sheet to Installer?') ) {
	$("form").attr("action","/mrmeshit/wp-content/themes/twentytwelve/quote_order_process.php?sendtoinstaller=yes");
}
else {
	$("form").attr("action","/mrmeshit/wp-content/themes/twentytwelve/quote_order_process.php"); 
}
});
</script>

<script>
	var errormessage="";
	var heightErrorNumber=0;
	var widthErrorNumber=0;
	$( '.product-height' ).on( "change", function() { 
		heightErrorNumber=0;
		$( ".product-height" ).each(function( index ) {
			if($( this ).val() > 2500){
				heightErrorNumber=1;
			}
		});	
		if(heightErrorNumber == 1){ $('#height-warning').show(); } 
		else { $('#height-warning').hide();}
 	});
	$( '.product-width' ).on( "change", function() { 
		widthErrorNumber=0;
		$( ".product-width" ).each(function( index ) {
			if($( this ).val() > 1300){
				widthErrorNumber=1;
			}
		});	
		if(widthErrorNumber == 1){ $('#width-warning').show(); } 
		else { $('#width-warning').hide();}
 	});
	$("#product1-height").trigger("change");
	$("#product1-width").trigger("change");
	$("#quote_order").on( "click", function() { 
		if( !$("#standard").is(":checked") && !$("#color1").is(":checked") && !$("#color2").is(":checked") && !$("#color3").is(":checked") && !$("#color4").is(":checked") ){		
			$( "#error" ).append("Colour not Chosen<br />");
			errormessage = 1;
		}

		if( $("#required-date").val()=="" ){		
			$( "#error" ).append("Do you want to request a Required Completion Date?<br />");
			errormessage = 1;
		}

		<?php
		$j=31;
		for($i = 1; $i<$j; $i++){ ?> if($("#product<?php echo $i; ?>-window-or-door").val() == "window" && $("#product<?php echo $i; ?>-quantity-of-panels").val() != ""){if($("#product<?php echo $i; ?>-window-frame-type").val() == "" ){ $( "#error" ).append("Window frame type is not selected.<br />"); errormessage = 1;}}<?php } ?>
	});
	$( "#save_quote, #save_as_a_new_quote, #quote_order" ).on( "click", function() { 
		<?php
			$j=31;
			for($i = 1; $i<$j; $i++){ ?>			
			if($("#product<?php echo $i; ?>-window-or-door").val() == "door"){		
				if($("#product<?php echo $i; ?>-number-of-locks").val() == "" ){ $( "#error" ).append("Door needs a lock.<br />"); errormessage = 1; }
				if($("#product<?php echo $i; ?>-lock-type").val() == "" ){ $( "#error" ).append("Lock type is not selected.<br />"); errormessage = 1; }
				if($("#product<?php echo $i; ?>-lock-handle-height").val() == "" ){	$( "#error" ).append("Lock handle height is empty. <br />"); errormessage = 1; } }
		<?php } ?>
		
		if(errormessage !=""){
    			$( "#error" ).dialog({
				modal: true,
				buttons: {
        				Ok: function() {
						$( this ).dialog( "close" );
        				}
      				},
				close: function( event, ui ) {$( "#error" ).html("");}
			});
		}
 	});


$(function() {

$('.product-window-or-door').each(function() {
if ($(this).val() == "door") {$(this).css("background","#ffd2bf");} 
else if ($(this).val() == "window") {$(this).css("background","#d1edff");} 
else {$(this).css("background","#fff");}
});
});



$('.product-window-or-door').on("change",function(){
if ($(this).val() == "door") {$(this).css("background","#ffd2bf");} 
else if ($(this).val() == "window") {$(this).css("background","#d1edff");} 
else {$(this).css("background","#fff");}});

$(window).bind('beforeunload',function(){
return 'All unsaved data will be lost.';
});
	
</script>

<?php } } ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>