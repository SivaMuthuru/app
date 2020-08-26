<!doctype html>
	<?php 
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

	$sqlM = "SELECT gci_id FROM guest_check_in WHERE gci_room_id ='".$room_id."' AND gci_location_id='".$location_id."'  AND gci_room_stage='checkin' ";
	$resultM = mysqli_query($conn, $sqlM);

	if (mysqli_num_rows($resultM) > 0) {
		while($rowM = mysqli_fetch_assoc($resultM)) {
			
			$sqlMS = "SELECT guests_id FROM guests WHERE guests_guest_checkin_id ='".$rowM['gci_id']."'";
			$resultMS = mysqli_query($conn, $sqlMS);
			
			while($rowMS = mysqli_fetch_assoc($resultMS)) {
				if(isset($rowMS['guests_id']) && $rowMS['guests_id']!=""){
					$guest_id = $rowMS['guests_id'];
				}else{
					$guest_id = 0;
				}
			}
		}	
	}else{
		//header('Location: contact_us.php?lid='.$location_id.'&rid='.$room_id.'');
	}		

	?>

<html>
<head>

<!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="scrollyeah/default.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<style>
body{ font-family: "Times New Roman", Times, serif;}

 
.btn {
  background-color: #fff;
  border: none;
  color: #000;
  padding: 12px 16px;
  font-size: 16px;
  cursor: pointer;
}
@media screen and (max-width: 414px) {
.btn {
    background-color: #fff;
    border: none;
    color: #000;
    padding: 12px 16px;
    font-size: 14px;
    cursor: pointer;
}
img {
    vertical-align: middle;
    width: 21px;
}
}
@media screen and (max-width: 412px) {
.btn {
    background-color: #fff;
    border: none;
    color: #000;
    padding: 12px 16px;
    font-size: 14px;
    cursor: pointer;
}
img {
    vertical-align: middle;
    width: 21px;
}
}
@media screen and (max-width: 375px) {
 .btn {
    background-color: #fff;
    border: none;
    color: #000;
    padding: 12px 16px;
    font-size: 11px;
    cursor: pointer;
}
img {
    vertical-align: middle;
    width: 24px;
}
}

</style>
</head>
<div class="container-fluid">
 <div class="row">
<img src="HOTELIMAGE.jpeg" alt="Chania" width="100%" class="img-responsive" style="">
</div>
</div>
<div class="container-fluid" style="background-color:#e5e5e5;">
<p class="otp_t" style="color:purple;font-size:16px">Please Login in Our Mobile App with <b style="font-size:22px">OTP:2461</b></p>
<div class="row play_store_icon">
	<div class="col-sm-6 col-xs-6 col-sm-6 padd_r5">
       <div class="ott1 text-right">
          <a href="https://play.google.com/store/apps/details?id=risolve.smartguest&hl=en" ><img  class="img-responsive" src="google_pay.png"> </a>        
      </div>
    </div>
	<div class="col-sm-6 col-xs-6 col-sm-6 padd_l5">
       <div class="ott1 text-left">
         <a href="https://play.google.com/store/apps/details?id=risolve.smartguest&hl=en" ><img  class="img-responsive" src="ios.png"> </a>          
      </div>
    </div>
</div>
</div>
<div class="container-fluid" style="background-color:#fc6f2a">
	<div class="row" style="padding:20px">
		<div class="col-sm-2 col-xs-2"><a href="dashboard.php?lid=<?php if(isset($location_id) && $location_id!=""){echo $location_id;}?>&rid=<?php if(isset($room_id) && $room_id!=""){echo $room_id;}?>" ><i class="fa fa-arrow-left" aria-hidden="true" style="width:100px;color:#fff;font-size:30px"></i></a></div>
		<div class="col-sm-10 col-xs-10">
			<p style="color:#fff;font-size:20px">Updates: Requests & Orders</p>
		</div>
	</div>
</div>
<?php 
	$form_data = array(
		"guest_id" => $guest_id,
		"location_id" => $location_id,
		"room_id" => $room_id
	);
	$ch = curl_init('http://risolvehm.com/api/guest/orders_requests');
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
?>
<?php 
	if(isset($transaction->orders) && count($transaction->orders)!=0){
?>
<div class="container" style="background-color:#ccc;padding:2px 5px">
	<?php 
		foreach($transaction->orders AS $key => $order){		
	?>
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:3px">
		<div class="col-sm-5 col-xs-5">
			<b>Order Id : <?php if(isset($order->order_id) && $order->order_id!=""){ echo $order->order_id;}?></b>
			</br>
			<b><?php if(isset($order->display_date) && $order->display_date!=""){ echo $order->display_date;}?></b>
		</div>
		<div class="col-sm-2 col-xs-2">
			<img src="room service-or.png" width="50px" height="50px" >
		</div>
		<div class="col-sm-5 col-xs-5">
			<b>From : Room <?php if(isset($order->room_name) && $order->room_name!=""){ echo $order->room_name;}?></b>
			</br>
			<b>To : <?php if(isset($order->department_name) && $order->department_name!=""){ echo $order->department_name;}?></b>
		</div>
	</div>
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:3px">
		<div class="col-sm-12 col-xs-12">
			<p><b>Status: </b> <?php if(isset($order->order_status) && $order->order_status!=""){ echo $order->order_status;}?></p>
		</div>
	</div>
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:3px">
		<div class="col-sm-12 col-xs-12">
			<b>Guest</b>
			<p><?php if(isset($order->item_names) && $order->item_names!=""){ echo $order->item_names;}?></p>
		</div>
		<!--<div class="col-sm-4">
			<img src="img.jpg" style="width:100px">
		</div>-->
	</div>
	<div class="row" style="padding:5px">
		<div class="col-sm-4 col-xs-4 col-md-4">
			<button class="btn btn-default btn-lg btn-block" style=""><img src="images/arrow.png" width="40px" height="40px" > Maximize</button>
		</div>
		<div class="col-sm-4 col-xs-4 col-md-4">
			<button class="btn btn-default btn-lg btn-block" style=""><img src="images/cancel.png" width="40px" height="40px" > Close</button> 
		</div>
		<div class="col-sm-4 col-xs-4 col-md-4">
			<button class="btn btn-default btn-lg btn-block" style=""><img src="images/chat.png" width="40px" height="40px" > Chat</button>
		</div>
	</div>
	<?php
	}
	?>
</div>
<?php
	}
?>

<?php 
	if(isset($transaction->requests) && count($transaction->requests)!=0){
?>

<div class="container" style="background-color:#ccc;padding:2px 5px">
	<?php 
		foreach($transaction->requests AS $key => $requests){		
	?>
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:1px">
		<div class="col-sm-4 col-xs-4">
			<b>Request ID : <?php if(isset($requests->request_id) && $requests->request_id!=""){ echo $requests->request_id;}?></b>
			</br>
			<b><?php if(isset($requests->display_date) && $requests->display_date!=""){ echo $requests->display_date;}?></b>
		</div>
		<div class="col-sm-4 col-xs-4">
			<img src="hk-single.png" width="50px" height="50px">
		</div>
		<div class="col-sm-4 col-xs-4">
			<b>From : Room <?php if(isset($requests->room_name) && $requests->room_name!=""){ echo $requests->room_name;}?></b>
			</br>
			<b>To : <?php if(isset($requests->department_name) && $requests->department_name!=""){ echo $requests->department_name;}?></b>
		</div>
	</div>
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:1px">
		<div class="col-sm-4">
		<p><b>Status: </b> <?php if(isset($requests->status) && $requests->status!=""){ echo $requests->status;}?></p>
		</div>
	</div>
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:1px">
		<div class="col-sm-8">
			<b>Guest</b>
			<p><?php if(isset($requests->request) && $requests->request!=""){ echo $requests->request;}?></p>
		</div>
		<!--<div class="col-sm-4">
			<img src="img.jpg" style="width:100px">
		</div>-->
	</div>
	
	<div class="row" style="padding:5px">
		<div class="col-sm-4 col-xs-4">
			<button class="btn btn-default btn-lg btn-block" style=""><img src="images/arrow.png" width="40px" height="40px" > Maximize</button>
		</div>
		<div class="col-sm-4 col-xs-4">
			<button class="btn btn-default btn-lg btn-block" style=""><img src="images/cancel.png" width="40px" height="40px" > Close</button> 
		</div>
		<div class="col-sm-4 col-xs-4">
			<button class="btn btn-default btn-lg btn-block" style=""><img src="images/chat.png" width="40px" height="40px" > Chat</button>
		</div>
	</div>
	<?php
		}
	?>
</div>
<?php
	}
?>
</body>
</html>
<!-- Latest compiled and minified JavaScript -->