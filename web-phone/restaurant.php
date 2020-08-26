<!doctype html>
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

?>

<html>
<head>
<title>Risolve Smart Guest</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,300&display=swap" rel="stylesheet">

<link rel="stylesheet" href="scrollyeah/scrollyeah.css"/>

<script src="scrollyeah/scrollyeah.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <style>
  body{font-family: 'Open Sans', sans-serif;background-color:#e5e5e5}
  .abc{
	  text-align:justify;
  }
.otp_t{
text-align:center;
color:#5506F3;
font-weight:800;
margin-top:2px;
}
.ott{
 border-radius:10px !important;
 background-color:#fff !important;
 height:150px !important
 }

p.abc{text-align:justify;
color:#222}


</style>
</head>

<body>
    <div class="container-fluid">
		<div class="container-fluid" style="background-color:#fc6f2a">
			<div class="row" style="padding:5px">
				<div class="col-sm-2 col-xs-2"><a href="dashboard.php?lid=<?php if(isset($location_id) && $location_id!=""){echo $location_id;}?>&rid=<?php if(isset($room_id) && $room_id!=""){echo $room_id;}?>" ><i class="fa fa-arrow-left" aria-hidden="true" style="width:100px;color:#fff;font-size:30px"></i></a></div>
				<div class="col-sm-10 col-xs-10">
				<p style="color:#fff;font-size:20px">Restaurant Menu</p>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
			<img src="HOTELIMAGE.jpeg" alt="Chania" width="100%" class="img-responsive" style="">
			</div>
		</div>
		<div class="container-fluid" style="background-color:#e5e5e5;">
			<p class="otp_t" style="color:purple;font-size:16px">Mobile App Login <b style="font-size:20px">OTP : <?php if(isset($guests_otp) && $guests_otp!=""){echo $guests_otp;}?></b></p>
			<div class="row play_store_icon" style="margin-bottom:10px">
				<div class="col-sm-6 col-xs-6 col-sm-6 padd_r5">
				   <div class="ott1 text-right">
					  <a href="https://play.google.com/store/apps/details?id=risolve.smartguest" target="_blank"  ><img  class="img-responsive" src="google_pay.png"> </a>        
				  </div>
				</div>
				<div class="col-sm-6 col-xs-6 col-sm-6 padd_l5">
				   <div class="ott1 text-left">
					 <a href="https://apps.apple.com/in/app/risolve-smartguest/id1481207845" target="_blank" ><img  class="img-responsive" src="ios.png"> </a>         
				  </div>
				</div>
			</div>
		</div><!-- app images closed-->
		<div class="panel-group" id="accordion">
			
			<?php 
				$url = 'http://risolvehm.com/api/guest/getcategories/'.$location_id;
				$ch = curl_init();  
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
				$dist_output=curl_exec($ch);
				curl_close($ch);
				$getcategories = json_decode($dist_output);
				//echo "<pre>";print_r($getcategories->content);exit;
			?>
			<?php 
				foreach($getcategories->content AS $key => $categories){
			?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php if(isset($categories->category_id) && $categories->category_id!=""){ echo $categories->category_id;} ?>">
						<div class="row">
							<div class="col-sm-3 col-xs-4">
								<img src="<?php if(isset($categories->menu_image) && $categories->menu_image!=""){ echo $categories->menu_image;} ?>"  class="img-responsive">
							</div>
							<div class="col-sm-9 col-xs-8" ><?php if(isset($categories->category_name) && $categories->category_name!=""){ echo $categories->category_name;} ?>
								<br/>
								<br/>
								<p><?php if(isset($categories->dishes_count) && $categories->dishes_count!=""){ echo $categories->dishes_count;} ?> items: <?php 
									if(isset($categories->dish_names) && $categories->dish_names!=""){
										$string = (strlen($categories->dish_names) > 25) ? substr($categories->dish_names,0,22).'...' : $categories->dish_names;
										echo $string;
									} 
								?>
							</div>
						</div>
					</a>
					</h4>
				</div>
				<?php 
					$form_data = array(
						"category_id" => $categories->category_id,
						"location_id" => $location_id
					);	
					$ch = curl_init('http://risolvehm.com/api/guest/dishes_list_by_category');
					$form_data1 = json_encode($form_data); 
					// $authorization = "Authorization: Bearer ".$token; // Prepare the authorisation token
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' )); 
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
					curl_setopt($ch, CURLOPT_POSTFIELDS, $form_data1); // Set the posted fields
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
					$result = curl_exec($ch); // Execute the cURL statement
					curl_close($ch); // Close the cURL connection
					$transaction = json_decode($result);
					//echo "<pre>";print_r($transaction->content);exit;
				?>
				
					<div id="collapse_<?php if(isset($categories->category_id) && $categories->category_id!=""){ echo $categories->category_id;} ?>" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row" onclick="showModel('<?php if(isset($categories->category_id) && $categories->category_id!=""){ echo $categories->category_id;} ?>');">
							<?php 
								foreach($transaction->content AS $key => $dish){
							?>
								<div class="col-md-3 col-xs-6" style="padding-right: 3px;padding-left: 3px;">
									<div class="thumbnail">

									<img src="<?php if(isset($dish->dish_image) && $dish->dish_image!=""){ echo $dish->dish_image;} ?>" alt="Nature" class="img-responsive">
										<div class="caption">
											<p class="coffee" style="font-size: 18px;"><i class="icon-dashboard"></i><?php if(isset($dish->dish_name) && $dish->dish_name!=""){ echo $dish->dish_name;} ?></p>
											Rs:<?php if(isset($dish->dish_cost) && $dish->dish_cost!=""){ echo $dish->dish_cost;} ?>
											
											<input type="hidden" id="hidden_item_id_<?php if(isset($categories->category_id) && $categories->category_id!=""){ echo $categories->category_id;} ?>"  value="0">
											<input type="hidden" id="hidden_item_name_<?php if(isset($categories->category_id) && $categories->category_id!=""){ echo $categories->category_id;} ?>"  value="<?php if(isset($dish->dish_name) && $dish->dish_name!=""){ echo $dish->dish_name;} ?>">
											<input type="hidden" id="hidden_item_price_<?php if(isset($categories->category_id) && $categories->category_id!=""){ echo $categories->category_id;} ?>"  value="<?php if(isset($dish->dish_cost) && $dish->dish_cost!=""){ echo $dish->dish_cost;} ?>">
											<input type="hidden" id="hidden_item_src_<?php if(isset($categories->category_id) && $categories->category_id!=""){ echo $categories->category_id;} ?>"  value="<?php if(isset($dish->dish_image) && $dish->dish_image!=""){ echo $dish->dish_image;} ?>">
											
											
											<div style="float:right">
												<button class="btn btn-sm btn-success mx-2" onClick="showModel('<?php if(isset($categories->category_id) && $categories->category_id!=""){ echo $categories->category_id;} ?>');" >-</button>
													<span id="cart_id_<?php if(isset($categories->category_id) && $categories->category_id!=""){ echo $categories->category_id;} ?>" >0</span>
												<button class="btn btn-sm btn-success mx-2" onClick="showModel('<?php if(isset($categories->category_id) && $categories->category_id!=""){ echo $categories->category_id;} ?>');" >+</button>
											</div>
										</div>
									</div>
								</div>
									<?php } ?>
							</div>

						</div>
					</div>
				
				
			</div>
			<?php } ?>
		</div>
	</div>
	
					<!-- The Modal -->
	<div class="modal" id="myModalOne">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Dish Details</h4>
					<button type="button" class="close" onclick="closeModel();" >&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body" id="model_show_div" >
				</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" onclick="closeModel()" >Close</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" id="myModalTwo">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">View Cart </h4>
						<button type="button" class="close" onclick="closeViewCartModel();" >&times;</button>
					</div>
				<!-- Modal body -->
				<div class="modal-body" id="model_show_div" >
					<a href="cart.php?lid=<?php if(isset($location_id) && $location_id!=""){echo $location_id;}?>&rid=<?php if(isset($room_id) && $room_id!=""){echo $room_id;}?>">View Cart</a> 
				</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" onclick="closeViewCartModel()" >Close</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script>
	function closeModel(){
		$('#hidden_id').val('');
		$('#myModalOne').hide();
	}
	function closeViewCartModel(){
		$('#myModalTwo').hide();
	}
	
	
	function showModel(id){
		$('#model_show_div').html('');
		var item_name = $("#hidden_item_name_"+id).val();
		var item_price = $("#hidden_item_price_"+id).val();	
		
		var item_src = $("#hidden_item_src_"+id).val();	
		
		var cart_count = $("#hidden_item_id_"+id).val();

		var html ="";
		
		$.ajax({
			url:"item_details.php",
			method:"POST",
			data:'product_id='+id,
			success:function(data)
			{
				
				var result = $.parseJSON(data);
				html+='<img src="'+result.content[0].dish_image+'" alt="Nature" style="width:100%;height:200px"><br><br>';
						
				if(result.content[0].variants.length !=0){		
					html+='<p style="color:red;" > <strong>Please select a dish of your choice</strong></p>';
					var i = 0;
					$.each(result.content[0].variants, function(propName, propVal) {
						if(i==0){
							
							html+='<input type="radio" id="hidden_item_variant_'+id+'" checked name="variant" value="'+propVal.item_variant_id+'"> <label for="'+propVal.variant_name+'"> '+propVal.variant_name+' - '+propVal.varient_price+' '+result.content[0].dish_currency+'</label><br>';
						}else{
							html+='<input type="radio" id="hidden_item_variant_'+id+'" name="variant" value="'+propVal.item_variant_id+'"> <label for="'+propVal.variant_name+'"> '+propVal.variant_name+' - '+propVal.varient_price+' Rupees</label><br>';
						}
						i++;
					});	
				}else{
					html+='<input type="hidden" id="hidden_item_variant_'+id+'" value="">';  
				}					
				if(result.content[0].flavours.length !=0){
					html+='<p style="color:red;"><strong>Select a flavor for your dish</strong></p>';
					var m=0;
					$.each(result.content[0].flavours, function(propName, propVal) {
						if(m==0){
							html+='<input type="radio" id="hidden_item_suggestion_'+id+'" name="suggestion" checked value="'+propVal.dish_suggestion_id+'"> <label for="'+propVal.suggestion+'"> '+propVal.suggestion+'</label><br>';
						}else{
							html+='<input type="radio" id="hidden_item_suggestion_'+id+'" name="suggestion" value="'+propVal.dish_suggestion_id+'"> <label for="'+propVal.suggestion+'"> '+propVal.suggestion+'</label><br>';
						}
						m++;
						
					});		
				}else{
					html+='<input type="hidden" id="hidden_item_suggestion_'+id+'" value="">';  
				}
				html+='<div >';
				html+='<div style="float:right">';
						html+='<button class="btn btn-sm btn-success mx-2" onClick="plusMinus('+id+', 0);">-</button>';
						html+='<span id="popup_hidden_count_'+id+'" > '+cart_count+' </span>';
						html+='<button class="btn btn-sm btn-success mx-2" onClick="plusMinus('+id+', 1);">+</button>';
					html+='</div>';
				html+='<button id="save-note-btn" class="btn btn-primary" title="Save" onClick="saveCart('+id+');">Add To Cart</button>'; 
				html+='</div>'; 
				$('#model_show_div').html(html);					
			}
		});

		$("#myModalOne").show();

	}
	
	function saveCart(id){
		var item_name = $("#hidden_item_name_"+id).val();
		var item_price = $("#hidden_item_price_"+id).val();	
		var item_src = $("#hidden_item_src_"+id).val();	
		var item_suggestion = $("#hidden_item_suggestion_"+id+":checked").val();
		var item_variant = $("#hidden_item_variant_"+id+":checked").val();
		if(item_suggestion==null || item_suggestion==""){
			item_suggestion = '';
		}
		if(item_variant==null || item_variant=="" ){
			item_variant = '';
		}
		
		var cart_count = $("#hidden_item_id_"+id).val();
		if(cart_count==0){
			cart_count=1;
		}
		
		$.ajax({
			url:"save_cart.php",
			method:"POST",
			data:'product_id='+id+'&product_name='+item_name+'&product_price='+item_price+'&product_src='+item_src+'&product_quantity='+cart_count+'&product_variants='+item_variant+'&product_suggestions='+item_suggestion+'&action=add',
			success:function(data)
			{
				$("#myModalOne").hide();
				
				$('#myModalTwo').show();	
			}
		});
		
	}
	function plusMinus(id, inc){
		
		var item_count = $("#hidden_item_id_"+id).val();
		var ci_count =  0;
		if(inc==0){
			ci_count =  parseInt(item_count)-1;
		}else if(inc==1){
			ci_count =  parseInt(item_count)+1;
		}
		if(ci_count<0){
			ci_count =  0;
		}
		$("#cart_id_"+id).text(ci_count);
		$("#hidden_item_id_"+id).val(ci_count);
		$("#popup_hidden_count_"+id).text(ci_count);
	}
	
</script>