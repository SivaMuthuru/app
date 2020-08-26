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
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="scrollyeah/default.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<style>
		<style>

.badge:after{
content:attr(value);
font-size:12px;
background:red;
border-radius:50%;
padding:5px;
position:relative;
left:13px;
top:-15px;
opacity:0.9;
}
.badge {
  
    min-width: 10px;
    padding: 11px 11px;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    background-color: #777;
    border-radius: 50%;
}

p.abc{text-align:justify;
color:#222}


#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
.panel-heading .accordion-toggle:after {
    /* symbol for "opening" panels */
    font-family: 'Glyphicons Halflings';  /* essential for enabling glyphicon */
    content: "\e114";    /* adjust as needed, taken from bootstrap.css */
    float: right;        /* adjust as needed */
    color: grey;         /* adjust as needed */
	margin-top: -36px;
}
.panel-heading .accordion-toggle.collapsed:after {
    /* symbol for "collapsed" panels */
    content: "\e080";    /* adjust as needed, taken from bootstrap.css */
}
   h2 {
            margin-top: 2rem;
        }

        h3 {
            margin-top: 1rem;
        }

        /*noinspection CssUnusedSymbol*/
        .input-group, input.test-value-input {
            max-width: 150px;
        }

        .code {
            background-color: #f1f2f3;
            font-family: Courier, monospace;
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
    text-align: left;
  }
  
  .header-right {
    float: none;
  }
}
.btn-group-sm>.btn, .btn-sm {
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1;
    border-radius: 3px;
}		
.item {
    position:relative;
	float:right;
    padding-top:20px;
    display:inline-block;
}

.notify-badge{
    position: absolute;
    right:-20px;
    top:10px;
    background:red;
    text-align: center;
    border-radius: 30px 30px 30px 30px;
    color:white;
    padding:5px 10px;
    font-size:20px;
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
          <a href="https://play.google.com/store/apps/details?id=risolve.smartguest" target="_blank"  ><img  class="img-responsive" src="google_pay.png"> </a>        
      </div>
    </div>
	<div class="col-sm-6 col-xs-6 col-sm-6 padd_l5">
       <div class="ott1 text-left">
         <a href="https://apps.apple.com/in/app/risolve-smartguest/id1481207845" target="_blank" ><img  class="img-responsive" src="ios.png"> </a>          
      </div>
    </div>
</div>
</div>

		<div class = "container-fluid">
			<div class="panel-heading"style="background-color:red">
				<div class="row" style="padding:5px">
					<div class="col-sm-2 col-xs-2"><a href="dashboard.php?lid=<?php if(isset($location_id) && $location_id!=""){echo $location_id;}?>&rid=<?php if(isset($room_id) && $room_id!=""){echo $room_id;}?>" ><i class="fa fa-arrow-left" aria-hidden="true" style="width:100px;color:#fff;font-size:30px"></i></a></div>
					<div class="col-sm-10 col-xs-10">
					<p style="color:#fff;font-size:20px">Restaurant</p>
					</div>
				</div>
			</div>
			<?php 
				$sql = "SELECT * FROM restaurent_categories where status=1 and rc_location_id=".$location_id;
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)) {
					//echo "<pre>";print_r($row);exit;
					if(isset($row['menu_image']) && $row['menu_image']!=""){
						$menu_image = $base_url.$row['menu_image'];
					}else{
						$menu_image = 'img.jpg';
					}
			?>
			<div class="panel-group" id="accordion">
				<div class="panel panel-default" style="margin-top:10px">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $row['id'];?>">
								<div class="row">
									<div class="col-sm-3 col-xs-3">
										<img src="<?php if(isset($menu_image) && $menu_image!=""){ echo $menu_image;}?>" width="100%" height="50px"/>
									</div>		  
									<div class="col-sm-9 col-xs-9" style="margin:0;padding:0;border:0;font-size: 100%;font-weight: normal;vertical-align: baseline;
									background: transparent;"><?php if(isset($row['name']) && $row['name']!=""){ echo $row['name']; } ?>
									<br/>
									<br/>
									<?php 
									$dish_names ='';

									$sql2 = "SELECT r.id, r.type, r.item_name, r.item_description, r.item_type, r.cost, r.currency, r.available_time, r.closing_time, r.item_status, r.messure, r.frequently_ordered, r.menu_status, r.sub_category_id, r.probable_time, r.start_time_slot2, r.end_time_slot2, r.start_time_slot3, r.end_time_slot3, r.item_image, rc.name FROM restaurents r LEFT JOIN restaurent_categories rc ON r.item_type=rc.id WHERE location_id='".$location_id."' AND item_type='".$row['id']."'";
									$result2 = mysqli_query($conn, $sql2);
									$i = 0;
									if (mysqli_num_rows($result2) > 0) {
									// output data of each row
									while($row2 = mysqli_fetch_assoc($result2)) {
									$dish_names.= $row2['item_name'].', ';
									$i ++;
									}
									$dish_names = rtrim($dish_names,", ");

									} 
									?>
									<p style="text-align:center;font-weight:500;color:#000"><?php echo $i;?> items : <?php echo $dish_names;?></p>
									</div>
								</div>
							</a>
						</h4>
					</div>
					<div id="collapse_<?php echo $row['id'];?>" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">
								<?php
								$sql3 = "SELECT r.id, r.type, r.item_name, r.item_description, r.item_type, r.cost, r.currency, r.available_time, r.closing_time, r.item_status, r.messure, r.frequently_ordered, r.menu_status, r.sub_category_id, r.probable_time, r.start_time_slot2, r.end_time_slot2, r.start_time_slot3, r.end_time_slot3, r.item_image, rc.name FROM restaurents r LEFT JOIN restaurent_categories rc ON r.item_type=rc.id WHERE location_id='".$location_id."' AND item_type='".$row['id']."'";
								$result3 = mysqli_query($conn, $sql3);
								if (mysqli_num_rows($result3) > 0) {
									while($row3 = mysqli_fetch_assoc($result3)) {
										if(isset($row3['item_image']) && $row3['item_image']!=""){
											$item_image = $base_url.$row3['item_image'];
										}else{
											$item_image = 'img.jpg';
										}

								?>
								<div class="col-md-4 col-xs-6">
									<div class="thumbnail" onclick="showModel('<?php echo $row3['id'];?>');">

										<img id="myImg" src="<?php if(isset($item_image) && $item_image!=""){ echo $item_image;}?>" alt="Nature" style="width:100%;height:100px">
										<div class="caption">
											<p class="coffee" style=""><i class="icon-dashboard"></i><?php echo $row3['item_name'];?></p>
											<p class="abc"> Description: <?php if(isset($row3['item_description']) && $row3['item_description']!=""){ echo $row3['item_description']; } ?></p>
											<b><?php if(isset($row3['cost']) && $row3['cost']!=""){ echo 'Rs '.$row3['cost'];}?></b>
											
											<input type="hidden" id="hidden_item_id_<?php echo $row3['id'];?>"  value="0">
											<input type="hidden" id="hidden_item_name_<?php echo $row3['id'];?>"  value="<?php echo $row3['item_name'];?>">
											<input type="hidden" id="hidden_item_price_<?php echo $row3['id'];?>"  value="<?php echo $row3['cost'];?>">
											<input type="hidden" id="hidden_item_src_<?php echo $row3['id'];?>"  value="<?php if(isset($item_image) && $item_image!=""){ echo $item_image;}?>">
											
											<div style="float:right;width:100px">
												<button class="btn btn-sm btn-success mx-1" onClick="showModel('<?php echo $row3['id'];?>');" >-</button>
												<span id="cart_id_<?php echo $row3['id'];?>" >0</span>
												<button class="btn btn-sm btn-success mx-1" onClick="showModel('<?php echo $row3['id'];?>');"  >+</button>
											</div>
										</div>

									</div>
								</div>
								<?php } }?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } }?>
				
				
 
  <div class="col-sm-12">
  	<div class="item" >
  		<a href="cart.php?lid=<?php if(isset($location_id) && $location_id!=""){echo $location_id;}?>&rid=<?php if(isset($room_id) && $room_id!=""){echo $room_id;}?>">
			<span class="notify-badge"><?php if(isset($_SESSION["cart"]) && $_SESSION["cart"]!=""){  echo COUNT($_SESSION["cart"]);}?></span>
      		<img src="add-to-cart.png" style="width:50px" style="border-radius:50%" alt="" />
		</a>
	</div>
</div>

		</div> <!-- end container -->
		
		
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
<!-- Latest compiled and minified JavaScript -->
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