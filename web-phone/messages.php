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
$guests_otp = '1234';

$sqlM = "SELECT gci_id FROM guest_check_in WHERE gci_room_id ='".$room_id."' AND gci_location_id='".$location_id."'  AND gci_room_stage='checkin' ";
$resultM = mysqli_query($conn, $sqlM);
 
if (mysqli_num_rows($resultM) > 0) {
	while($rowM = mysqli_fetch_assoc($resultM)) {
		$sqlMS = "SELECT guests_id, guests_otp   FROM guests WHERE guests_guest_checkin_id ='".$rowM['gci_id']."'";
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
$location_name = "";
$location_logo = "";
$location_image = "";
$sqlM = "SELECT * FROM locations WHERE id='".$location_id."'";
$resultM = mysqli_query($conn, $sqlM);

if (mysqli_num_rows($resultM) > 0) {
	while($rowM = mysqli_fetch_assoc($resultM)) {

		if(isset($rowM['location_name']) && $rowM['location_name']!=""){
			$location_name = $rowM['location_name'];
		}
		if(isset($rowM['location_logo']) && $rowM['location_logo']!=""){
			$location_logo = 'http://risolvehm.digisoftbiz.ae/'.$rowM['location_logo'];
		}
		if(isset($rowM['location_image']) && $rowM['location_image']!=""){
			$location_image = $rowM['location_image'];
		}
	}	
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
		<p style="color:#fff;font-size:20px"> Messages</p>
		</div>
	</div>
</div>

<?php 
	$form_data = array(
		"guest_id" => '289',
		"location_id" => $location_id,
		"room_id" => $room_id
	);	
	$ch = curl_init('http://risolvehm.com/api/guest/messages_list');
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


<div class="container" style="background-color:#9e9e9e4f;padding:2px 5px;">

	<?php 
		foreach($transaction->content AS $key => $message){	
			//echo "<pre>";print_r($message);exit;
	?>
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:1px">
		<div class="col-sm-12 col-xs-12">
		<center><p><b>Message From : <?php if(isset($message->department_name) && $message->department_name!=""){ echo $message->department_name;}?> </b></p></center>
		</div>
	</div>
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:3px;">
		
		<div class="col-sm-1 col-xs-3">
			<?php if(isset($message->msg_image) && $message->msg_image!=""){ ?>
			<img src="<?php echo $message->msg_image;?>" width="70px" height="70px" >
		<?php } ?>
			
			
		</div>
		<div class="col-sm-8 col-xs-6">
			
			<b>Message : <?php if(isset($message->msg) && $message->msg!=""){ echo $message->msg;}?></b>
			
		</div>
		<div class="col-sm-3 col-xs-3">
			
			<b><?php if(isset($message->display_date) && $message->display_date!=""){ echo $message->display_date;}?></b>
		</div>
		
	</div>
	
	<div class="row" style="padding:5px">
		<div class="col-sm-6 col-xs-6" style="border-radius:10px 10px 10px 10px">
			<button class="btn btn-default btn-lg btn-block" style=""><img src="images/arrow.png" width="40px" height="40px" > Maximize</button>
		</div>
		<div class="col-sm-6 col-xs-6" style="border-radius:10px 10px 10px 10px">	
		<button class="btn btn-default btn-lg btn-block" style=""><img src="images/chat.png" width="40px" height="40px" > </i>Chat</button>
		</div>
	</div>
	<?php
		}
	?>	
</div>
</body>
</html>
<!-- Latest compiled and minified JavaScript -->