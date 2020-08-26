<!DOCTYPE html>
<html lang="en">
<?php 
session_start();

include "db.php";
if(isset($_GET['lid']) && $_GET['lid']!=""){
	$location_id = $_GET['lid'];
}else{
	$location_id = 0;
}

if(isset($_GET['rid']) && $_GET['rid']!=""){
	$room_id = $_GET['rid'];
}else{
	$room_id = 0;
}
$guest_id = 0;
$guests_otp = '1234';

$sqlM = "SELECT gci_id FROM guest_check_in WHERE gci_room_id ='".$room_id."' AND gci_location_id='".$location_id."'  AND gci_room_stage='checkin' ";
$resultM = mysqli_query($conn, $sqlM);

if (mysqli_num_rows($resultM) > 0) {
	while($rowM = mysqli_fetch_assoc($resultM)) {
		
		$sqlMS = "SELECT guests_id, guests_otp FROM guests WHERE guests_guest_checkin_id ='".$rowM['gci_id']."'";
		$resultMS = mysqli_query($conn, $sqlMS);
		
		while($rowMS = mysqli_fetch_assoc($resultMS)) {
			if(isset($rowMS['guests_id']) && $rowMS['guests_id']!=""){
				$guest_id = $rowMS['guests_id'];
				$guests_otp = $rowMS['guests_otp'];
			}else{
				$guest_id = 0;
				$guests_otp = '1234';
			}
		}
	}	
}else{
	//header('Location: contact_us.php?lid='.$location_id.'&rid='.$room_id.'');
}		


if(isset($_POST['submit'])){
	
	if(isset($_POST['preorder']) && $_POST['preorder']!='')
	{
		$preorder = $_POST['preorder'];
	} else {
		$preorder = 'NO';
	}
	
	if(isset($_POST['preorder_time']) && $_POST['preorder_time']!='')
	{
		$preorder_time = $_POST['preorder_time'];
	} else {
		$preorder_time = '';
	}
	
	if(isset($_POST['preorder_delivary_time']) && $_POST['preorder_delivary_time']!='')
	{
		$preorder_delivary_time = $_POST['preorder_delivary_time'];
	} else {
		$preorder_delivary_time = "";
	}
	if(isset($_POST['cooking_instructions']) && $_POST['cooking_instructions']!='')
	{
		$special_instructions = $_POST['cooking_instructions'];
	} else {
		$special_instructions = '';
	}
	
	if(isset($_POST['posted_by']) && $_POST['posted_by']!='')
	{
		$posted_by = $_POST['posted_by'];
	} else {
		$posted_by = 0;
	}
	
	$query = "INSERT INTO orders (location_id, room_id, dep_id, time, date, preorder, preorder_time, preorder_delivary_time, special_instructions, status, order_guest_id, posted_by)
	VALUES ('".$location_id."', '".$room_id."', '8', '".date('H:i:s')."', '".date('Y-m-d')."', '".$preorder."', '".$preorder_time."', '".$preorder_delivary_time."', '".$special_instructions."', 'NOT DELIVERED', '".$guest_id."', '".$posted_by."')";

	if (mysqli_query($conn, $query)) {
		
		$last_id = mysqli_insert_id($conn);
		
			foreach($_SESSION["cart"] as $keys => $values){
				$variant_name ="";
				$variant_price ="";
				if(isset($values['item_variants']) && $values['item_variants']!=""){
					$sql5 = "SELECT * FROM item_variants where item_variant_id='".$values['item_variants']."' ";		
					$result5 = mysqli_query($conn, $sql5);
					if (mysqli_num_rows($result5) > 0) {
						while($variant = mysqli_fetch_assoc($result5)) {
							$variant_name = $variant['varient_name'];
							$variant_price = $variant['varient_price'];
						}
					}
				}
				
				$suggestion_name ="";
				if(isset($values['item_suggestions']) && $values['item_suggestions']!=""){
					$sql21 = "SELECT * FROM item_suggestions where item_suggestion_id='".$values['item_suggestions']."' ";		
					$result21 = mysqli_query($conn, $sql21);
					if (mysqli_num_rows($result21) > 0) {
						while($suggestion = mysqli_fetch_assoc($result21)) {
							$suggestion_name = $suggestion['suggestion'];
						}
					}
				}
				
				if(isset($variant_price) && $variant_price!="" ){ 
					$price = $variant_price;
				}else{
					$price = $values['item_price'];
				}
				
				if(isset($variant_name) && $variant_name!=""){ 
					$itemname = $variant_name; 
				}else{ 
					$itemname = $values['item_name'];
				}

				$order_item_query = "INSERT INTO order_items (order_id, item, time, price, units, item_id, variant_id, variant_name, suggested)
				VALUES ('".$last_id."', '".$itemname."', now(), '".$price."', '".$values['item_quantity']."', '".$values['item_id']."', '".$values['item_variants']."', '".$variant_name."', '".$values['item_suggestions']."')";
				
				if (mysqli_query($conn, $order_item_query)) {
					
				}
			}

			unset($_SESSION["cart"]);	
	} else {
		echo "<script> alert('Something Wrong');</script> ";
	}
}
?>
<head>
  <title>Risolve Smart Guest</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="scrollyeah/default.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
*{
	margin:0;
	padding:0;
	box-sizing:border-box;
	 font-family: "Times New Roman", Times, serif;
  }
  .c1{
		font-size:60px
	}
	@media screen and (max-width: 375px and min-width:320px) {
  div.caption p {
    font-size: 8px;
	}
}

	@media screen and (max-width: 412px) {
  div.caption p {
    font-size: 8px;
  }
}

@media screen and (max-width: 375px) {
 .c1 {
   font-size:30px;
  }
  }
  <!-- @media screen and (max-width: 425px) {
 div.caption p {
   font-size:10px;
  }
  } -->
  
  @media only screen and (max-width: 320px) {
 .ofb p{
   font-size:7px !important;
   
  }
  }
  @media only screen and (max-width:768px){
	.ofb, .box{
		height:90px;
		font-size:10px;
		font-weight:600;
	}
  }
  @media only screen and (max-width:320px){
	.ht{
		font-size:3px;
	}
  }
  @media only screen and (max-width:320px){
	.msg{margin-right: -15px;
		
	}
  }

* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    
  }
  
  .header-right {
    float: none;
  }
}
 p.ww{
 word-wrap: break-word;
 }
 .ott{border-radius:10px;
 background-color:#fff;
 height:100px}
 .box{border:2px solid #61325e;border-radius:10px;background-color:#fff; word-wrap: break-word;height:100px}
ul li{list-style-type:none;}
@media screen and (max-width: 375px) {
 .c1 {
   font-size:30px;
  }
  .logo{
  width:80px !important;
  }
  a.logoname{font-size: 20px !important;
    margin: 20px 0 0 21px !important;
}
  }

</style>
</head>
<body>
<div class="container-fluid">
 <div class="row">
<img src="HOTELIMAGE.jpeg" alt="Chania" width="100%" class="img-responsive" style="">
</div>
</div>
<div class="container-fluid" style="background-color:#e5e5e5;">
<p class="otp_t" style="color:purple;font-size:16px">Mobile App Login <b style="font-size:20px">OTP : <?php if(isset($guests_otp) && $guests_otp!=""){echo $guests_otp;}?></b></p>
<div class="row play_store_icon">
	<div class="col-sm-6 col-xs-6 col-sm-6 padd_r5">
       <div class="ott1 text-right">
          <a href="https://play.google.com/store/apps/details?id=risolve.smartguest" target="_blank" ><img  class="img-responsive" src="google_pay.png"> </a>        
      </div>
    </div>
	<div class="col-sm-6 col-xs-6 col-sm-6 padd_l5">
       <div class="ott1 text-left">
         <a href="https://apps.apple.com/in/app/risolve-smartguest/id1481207845" target="_blank" ><img  class="img-responsive" src="ios.png"> </a>          
      </div>
    </div>
</div>
</div>
<div class="container" style="background-color:#fc6f2a">
	<div class="row" style="padding:5px">
		<div class="col-sm-2 col-xs-2"><a href="restaurant.php?lid=<?php if(isset($location_id) && $location_id!=""){echo $location_id;}?>&rid=<?php if(isset($room_id) && $room_id!=""){echo $room_id;}?>" ><i class="fa fa-arrow-left" aria-hidden="true" style="width:100px;color:#fff;font-size:30px"></i></a></div>
		<div class="col-sm-10 col-xs-10">
		<p style="color:#fff;font-size:20px">Restaurant Cart</p>
		</div>
	</div>
</div>
<?php 
			if(isset($_SESSION["cart"])){
				if(count($_SESSION["cart"]) !=""){
?>				
<form id="cart_form" name="" method="post">
<div class="container" style="padding:10px">
	<p style="margin-top:10px;font-weight:900">Cart Details</p>	
  </div>
  <div class="container" >
		<ul>
		<?php 
			if(isset($_SESSION["cart"])){

				foreach($_SESSION["cart"] as $keys => $values){
					//echo "<pre>";print_r($keys);exit;
					$variant_name ="";
					$variant_price ="";
					if(isset($values['item_variants']) && $values['item_variants']!=""){
						$sql = "SELECT * FROM item_variants where item_variant_id='".$values['item_variants']."' ";		
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							while($variant = mysqli_fetch_assoc($result)) {
								$variant_name = $variant['varient_name'];
								$variant_price = $variant['varient_price'];
							}
						}
					}
					
					$suggestion_name ="";
					if(isset($values['item_suggestions']) && $values['item_suggestions']!=""){
						$sql2 = "SELECT * FROM item_suggestions where item_suggestion_id='".$values['item_suggestions']."' ";		
						$result2 = mysqli_query($conn, $sql2);
						if (mysqli_num_rows($result2) > 0) {
							while($suggestion = mysqli_fetch_assoc($result2)) {
								$suggestion_name = $suggestion['suggestion'];
							}
						}
					}
				?>	
		
			<div class="row" style="margin-top:10px" id="li_list_<?php echo $keys; ?>">
				<li>
					<div class="col-sm-8 col-xs-6"><?php if(isset($variant_name) && $variant_name!=""){ echo $variant_name; }else{ echo $values['item_name'];} ?>  <?php if(isset($suggestion_name) && $suggestion_name!=""){ echo '( '.$suggestion_name.' )'; } ?>
					</div>		
					<div class="col-sm-4 col-xs-6"><button type="button" class="btn" onClick="plusMinus('<?php echo $keys; ?>', 0);">-</button>&nbsp;&nbsp;&nbsp; <span id="item_span_count_<?php echo $keys; ?>"><?php echo $values['item_quantity'];?></span> &nbsp;&nbsp;&nbsp;<button type="button" class="btn" onClick="plusMinus('<?php echo $keys; ?>', 1);" >+</button> &nbsp;&nbsp;<img onclick="deleteCart(<?php echo $keys; ?>);"  src="del.png" width="30px" height="30px">
					
					</div>
				</li>
			</div>

			<?php	
				}
			}else{
				echo 'cart is empty';exit;
			}
			?>
	
</ul>		
	</div>
	<div class="container">
		<div class="form-group">
			<label for="comment">Cooking Instructions</label>
			<textarea id="cooking_instructions" name="cooking_instructions"  placeholder="Please type your cooking instructions to restaurant" class="form-control" rows="3" ></textarea>
		</div> 
		
		
		
		<p style="font-weight:900"> View Details</p>
		<ul>
		
		<?php 

				$total_price =0;
			if(isset($_SESSION["cart"])){
	
				foreach($_SESSION["cart"] as $keys => $values){
					//echo "<pre>";print_r($keys);exit;
					$variant_name ="";
					$variant_price ="";
					
					$varient_total_price =0;
					if(isset($values['item_variants']) && $values['item_variants']!=""){
						$sql = "SELECT * FROM item_variants where item_variant_id='".$values['item_variants']."' ";		
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							while($variant = mysqli_fetch_assoc($result)) {
								$variant_name = $variant['varient_name'];
								$variant_price = $variant['varient_price'];
								$varient_total_price += $variant['varient_price']*$values['item_quantity'];
							}
						}
					}
					
					$suggestion_name ="";
					if(isset($values['item_suggestions']) && $values['item_suggestions']!=""){
						$sql2 = "SELECT * FROM item_suggestions where item_suggestion_id='".$values['item_suggestions']."' ";		
						$result2 = mysqli_query($conn, $sql2);
						if (mysqli_num_rows($result2) > 0) {
							while($suggestion = mysqli_fetch_assoc($result2)) {
								$suggestion_name = $suggestion['suggestion'];
							}
						}
					}
					
					if(isset($variant_price) && $variant_price!="" ){ 
						$total_price = $total_price + $varient_total_price;
					}else{
						$total_price = $total_price + $values['item_price']*$values['item_quantity'];
					}						
					
				?>


				<div class="row" style="margin-top:10px" id="li_list_details_<?php echo $keys; ?>" >
					<li>
						<div class="col-sm-8 col-xs-6"><?php if(isset($values['item_quantity']) && $values['item_quantity']!="" ){ echo $values['item_quantity'];} ?> * <?php if(isset($variant_name) && $variant_name!=""){ echo $variant_name; }else{ echo $values['item_name'];} ?>  <?php if(isset($suggestion_name) && $suggestion_name!=""){ echo '( '.$suggestion_name.' )'; } ?> 
						</div>		
						<div class="col-sm-4 col-xs-6"><?php if(isset($variant_price) && $variant_price!="" ){ echo  ' Rs '.$values['item_quantity']*$variant_price;}else{ echo  ' Rs '.$values['item_quantity']*$values['item_price'];} ?>
						</div>
					</li>
				</div>	
			<?php	
				}
			}
			?>
	
			
		</ul>
	
		<?php 			
		if(isset($_SESSION["cart"])){
		?>
		<p style="font-weight:900"> Bill Details</p>
		
		<div class="row" style="margin-top:10px">
		<ul>
		<li>
			<div class="col-sm-4 col-xs-6" style="font-weight:900">Total Bill 
			</div>		
			<div class="col-sm-4 col-xs-6"><?php echo 'Rs '.$total_price;?> <br> * Applicable Taxes may be extra
			</div>
		</li>
</ul>

</div>	                         
		
		<div style="float:right">
			  <input type="submit" id="submit" name="submit" class="btn btn-default" style="border:2px solid #FC6F2A;color:#FC6F2A" value="Order Now" >
		</div>
	<?php } ?>
  </div>
  </form>
<?php
		}else{
			echo "<br><center><b>CART IS EMPTY</b></center>";
		}
	}else{
		echo "<br><center><b>CART IS EMPTY</b></center>";
	}
	?>

</body>
<script>
	function deleteCart(sno){
		 $.ajax({
			url:"save_cart.php",
			method:"POST",
			data:'sno='+sno+'&action=delete',
			success:function(data)
			{
				$("#li_list_details_"+sno).remove();
				$("#li_list_"+sno).remove();
				location.reload();
			}
		}); 	
	}
	
	function plusMinus(id, inc){
		var item_count = $("#item_span_count_"+id).text();
		var ci_count =  0;
		if(inc==0){
			ci_count =  parseInt(item_count)-1;
		}else if(inc==1){
			ci_count =  parseInt(item_count)+1;
		}
		if(ci_count==0){
			ci_count =  0;
			deleteCart(id);
		}else{
			$("#item_span_count_"+id).text(ci_count);
		}
		
	}
</script>
</html>