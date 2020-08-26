<?php
//Include database configuration file
include "db.php";
?>
<?php

if(isset($_POST['product_id']) && $_POST['product_id']!="" ){
		$dish_id = $_POST['product_id'];
		//$dish_id = 13;
		$dishes=array();
		$dishes_list = array();
		$dishes_list["dishes"] = array();
		
		$sql = "SELECT * FROM restaurents r LEFT JOIN restaurent_categories rc ON r.item_type=rc.id  LEFT JOIN restaurent_sub_categories rs ON r.sub_category_id=rs.rsc_id  where r.id='".$dish_id."' ";		
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($details = mysqli_fetch_assoc($result)) {
				//echo "<pre>";print_r($details);exit;		
				$dishes["dish_id"] = $dish_id;
				$dishes["dish_name"] = $details['item_name'];
				if(isset($details['item_image']) && $details['item_image']!=""){
					$dishes["dish_image"] = $base_url.$details['item_image'];
				}else{
					$dishes["dish_image"] = "";
				}
				$dishes["dish_description"] = $details['item_description'];
				$dishes["dish_category"] = $details['name'];
				$dishes["dish_cost"] = $details['cost'];
				$dishes["dish_messure"] = $details['messure'];
				$dishes["dish_probable_time"] = $details['probable_time'];
				$dishes["dish_frequently_ordered"] = $details['frequently_ordered'];
				$dishes["dish_currency"] = $details['currency'];
				$dishes["dish_available_time"] = $details['available_time'];
				$dishes["dish_closing_time"] = $details['closing_time'];
				$dishes["dish_status"] = $details['item_status'];
				$dishes["dish_start_time_slot2"] = $details['start_time_slot2'];
				$dishes["dish_end_time_slot2"] = $details['end_time_slot2'];
				$dishes["dish_start_time_slot3"] = $details['start_time_slot3'];
				$dishes["dish_end_time_slot3"] = $details['end_time_slot3'];
				
				$variants=array();
				$dishes["variants"]=array();
				
				$sql2 = "SELECT * FROM item_variants WHERE item_varient_item='".$dish_id."'";		
				$result2 = mysqli_query($conn, $sql2);
				if (mysqli_num_rows($result2) > 0) {
					while($variant = mysqli_fetch_assoc($result2)) {
						$variants['item_variant_id'] = $variant['item_variant_id'];
						$variants['item_variant_item'] = $variant['item_varient_item'];
						$variants['variant_name'] = $variant['varient_name'];
						$variants['varient_price'] = $variant['varient_price'];
						array_push($dishes["variants"], $variants);
					}
				}
				
				$flavours=array();
				$dishes["flavours"]=array();

				$sql3 = "SELECT * FROM item_suggestions WHERE item_id='".$dish_id."'";		
				$result3 = mysqli_query($conn, $sql3);
				if (mysqli_num_rows($result3) > 0) {
					while($flavour = mysqli_fetch_assoc($result3)) {
						$flavours['dish_suggestion_id'] = $flavour['item_suggestion_id'];
						$flavours['dish_id'] = $flavour['item_id'];
						$flavours['suggestion'] = $flavour['suggestion'];
						array_push($dishes["flavours"], $flavours);
					}
				}
				
				array_push($dishes_list["dishes"], $dishes);
				
			}
			
			
		}
		$details = array("status"=>500, 'content'=>$dishes_list["dishes"]);
		echo json_encode($details);
}
?>
