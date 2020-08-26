<?php
session_start();

	function search($array, $search_list) { 
		// Create the result array 
		$result = array(); 
		// Iterate over each array element 
		foreach ($array as $key => $value) { 
			// Iterate over each search condition 
			foreach ($search_list as $k => $v) { 
				// If the array element does not meet 
				// the search condition then continue 
				// to the next element 
				if (!isset($value[$k]) || $value[$k] != $v) 
				{ 
				// Skip two loops 
					continue 2; 
				} 
			} 
			// Append array element's key to the 
			//result array 
			$result[] = $value; 
		} 
		// Return result  
		return $result; 
	} 
	
	if(isset($_POST["action"]) && $_POST["action"]=="add")
	{
	  
		if(isset($_SESSION["cart"]))
		{
			if(isset($_POST["product_id"]) && $_POST["product_id"]!=""){
				$search_items = array('item_id'=>$_POST["product_id"], 'item_variants'=>$_POST["product_variants"], 'item_suggestions'=>$_POST["product_suggestions"]);  
				$res = search($_SESSION["cart"], $search_items); 
				
				if(count($res) > 0){
					foreach($_SESSION["cart"] as $keys => $values){
						if($values["item_id"] == $_POST["product_id"] && $values["item_variants"] == $_POST["product_variants"] && $values["item_suggestions"] == $_POST["product_suggestions"])
						{
							$_SESSION["cart"][$keys]['item_quantity'] = $_POST["product_quantity"];
						}
					}
				}else{
					$count = count($_SESSION["cart"]);
					$item_array = array(
						'item_id'			=>	$_POST["product_id"],
						'item_name'			=>	$_POST["product_name"],
						'item_price'		=>	$_POST["product_price"],
						'item_src'		    =>	$_POST["product_src"],
						'item_suggestions'	=>	$_POST["product_suggestions"],
						'item_variants' 	=>	$_POST["product_variants"],
						'item_quantity'		=>	$_POST["product_quantity"]
					);
					$_SESSION["cart"][$count] = $item_array;
				}
			}
		} else {
			if(isset($_POST["product_id"]) && $_POST["product_id"]!=""){
				$item_array = array(
					'item_id'			=>	$_POST["product_id"],
					'item_name'			=>	$_POST["product_name"],
					'item_price'		=>	$_POST["product_price"],
					'item_src'		    =>	$_POST["product_src"],
					'item_suggestions'	=>	$_POST["product_suggestions"],
					'item_variants' 	=>	$_POST["product_variants"],
					'item_quantity'		=>	$_POST["product_quantity"]
				);
				$_SESSION["cart"][0] = $item_array;
			}
		}
			
	}else if(isset($_POST["action"]) && $_POST["action"]=="delete"){
		
		if(isset($_POST["sno"]) && $_POST["sno"]!=""){
			unset($_SESSION["cart"][$_POST["sno"]]);
		}
		
	}
?>