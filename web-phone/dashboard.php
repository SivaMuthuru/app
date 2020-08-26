<!DOCTYPE html>
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

$query = "SELECT gci_id FROM guest_check_in WHERE gci_room_id ='".$room_id."' AND gci_location_id='".$location_id."'  AND gci_room_stage='checkin' ";
$queryResult = mysqli_query($conn, $query);

if (mysqli_num_rows($queryResult) > 0) {
	while($res = mysqli_fetch_assoc($queryResult)) {
		
		$sqlMS = "SELECT guests_id, guests_otp  FROM guests WHERE guests_guest_checkin_id ='".$res['gci_id']."'";
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
<title>Risolve Smart Guest</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,300&display=swap" rel="stylesheet">

<link rel="stylesheet" href="scrollyeah/scrollyeah.css"/>
<link rel="stylesheet" href="scrollyeah/default.css"/>
<script src="scrollyeah/scrollyeah.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<?php //ini_set('display_errors', 'Off'); ?>
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
<div class="container-fluid" style="background-color:#e5e5e5;">
  <div class="row" style="background-color:#fff;">
    <div class="col-xs-4" style="border-right:1px solid #ccc">
		<div class="msg">
          <center><a href="messages.php?lid=<?php if(isset($location_id) && $location_id!=""){echo $location_id;}?>&rid=<?php if(isset($room_id) && $room_id!=""){echo $room_id;}?>" ><img  src="sms.png" alt="sms" ></a></center>
          <div class="caption">Messages</div>
        
      </div>
    </div>
    <div class="col-xs-4" style="border-right:1px solid #ccc">
      <div class="msg">
          <center><a href="updates.php?lid=<?php if(isset($location_id) && $location_id!=""){echo $location_id;}?>&rid=<?php if(isset($room_id) && $room_id!=""){echo $room_id;}?>" ><img src="updates.png" alt="sms" ></a></center>
          <div class="caption">
           Updates
          </div>
      </div>
    </div>
    <div class="col-xs-4">
       <div class="msg">
          <center><a href="cart.php?lid=<?php if(isset($location_id) && $location_id!=""){echo $location_id;}?>&rid=<?php if(isset($room_id) && $room_id!=""){echo $room_id;}?>" ><img  src="add-to-cart.png" alt="sms" ></a></center>
          <div class="caption">Cart</div>
      </div>
    </div>
  </div>
</div>
<?php 
	$form_data = array(
		"language_id" => 1,
		"location_id" => $location_id
	);	
	$ch = curl_init('http://risolvehm.com/api/guest/onetouch');
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
<div class="container-fluid" style="background-color:#e5e5e5;padding:0px" >
	<h4 style="text-indent:15px;text-transform:uppercase;font-weight:700">One Touch Request</h4>
	<div class="scrollyeah ">
		<div class="item" onclick="get_order_popup()">
			<img class="a1" src="020-lunch.png" width="70%" height="auto" >
			<a href="#"class="item_a">Order Food & Beverages</a>
		</div>
		<?php
		foreach($transaction->content AS $key => $onetouch){
			if($key<=9){
		?>
		<div class="item" onclick="get_request_id('<?php echo $onetouch->department_id;?>', '<?php echo $onetouch->one_touch_command;?>', '<?php echo $onetouch->department_name;?>')"  ><img class="a1" src="<?php if(isset($onetouch->one_touch_command_image) && $onetouch->one_touch_command_image!=""){ echo $onetouch->one_touch_command_image;} ?>" width="70%" height="auto" >
			<a href="#" style="" class="item_a"><?php if(isset($onetouch->one_touch_button) && $onetouch->one_touch_button!=""){ echo $onetouch->one_touch_button;} ?></a>
		</div>
		<?php } } ?>

	</div>
</div>

<div class="scrollyeah container-fluid" style="background-color:#e5e5e5;padding:0px" >
	<div class="item" onclick="get_request_id('4', '', 'House Keeping')">
			<img class="a1" src="023-receptionist-1.png" width="70%" height="auto" >
			<a href="#"class="item_a">Send Room Attendant</a>
	</div>
	<?php
	foreach($transaction->content AS $key => $onetouch){
		if($key>9){
	?>
	
	<div class="item" onclick="get_request_id('<?php echo $onetouch->department_id;?>', '<?php echo $onetouch->one_touch_command;?>', '<?php echo $onetouch->department_name;?>')">
		<img class="a1" src="<?php if(isset($onetouch->one_touch_command_image) && $onetouch->one_touch_command_image!=""){ echo $onetouch->one_touch_command_image;}?>" width="70%" height="auto" >
		<a href="#" style="" class="item_a"><?php if(isset($onetouch->one_touch_button) && $onetouch->one_touch_button!=""){ echo $onetouch->one_touch_button;} ?></a>
	</div>
	<?php } } ?>
</div>

<div class="container" style="background-color:#e5e5e5;">
	<div class="row">
		<a href="restaurant.php?lid=<?php if(isset($location_id) && $location_id!=""){echo $location_id;}?>&rid=<?php if(isset($room_id) && $room_id!=""){echo $room_id;}?>" ><img class="img-responsive a" src="Digisoft-solutions.png" alt="" width="100%" style="height:150px"></a>
	</div>
</div>

<div class="container-fluid" style="background-color:#e5e5e5;padding:0px" >
	<h4 style="text-indent:15px;text-transform:uppercase;font-weight:700">Touch And Type</h4>
	
</div>
		<div class="container">
			<div class = "row">
				<div class = "col-xs-4" style="padding-right: 4px !important;padding-left: 4px !important;" onClick="post_request('2', 'Front Desk' )">
					<a href = "#" class = "thumbnail" style="margin-bottom: 10px !important;border-radius: 10px;text-decoration:none">
						<center><img src = "frontdesk.png" alt = "Generic placeholder thumbnail" style="width:50px">
						<p style="color:#161616;line-height:35px;font-weight: 600;">Front Desk</p></center>
					</a>
				</div>
				<div class = "col-xs-4" style="padding-right: 4px !important;padding-left: 4px !important;" onClick="get_order_popup()">
					<a href = "#" class = "thumbnail" style="margin-bottom: 10px !important;border-radius: 10px;text-decoration:none">
						<center><img src = "roomservice.png" alt = "Generic placeholder thumbnail" style="width:50px">
						<p style="color:#161616;line-height:35px;font-weight: 600;">Restaurant</p></center>
					</a>
				</div>
				<div class = "col-xs-4" style="padding-right: 4px !important;padding-left: 4px !important;" onClick="post_request('4', 'House Keeping' )">
					<a href = "#" class = "thumbnail" style="margin-bottom: 10px !important;border-radius: 10px;text-decoration:none;">
						<center><img src = "hk.png" alt = "Generic placeholder thumbnail" style="width:37px">
						<p style="color:#161616;line-height:35px;font-weight: 600;">House Keeping</p></center>
					</a>
				</div>
			</div>
		</div>

		<div class="container">
		    <div class = "row">
				<div class = "col-xs-4" style="padding-right: 4px !important;padding-left: 4px !important;" onClick="post_request('11', 'Maintenance' )">
					<a href = "#" class = "thumbnail" style="margin-bottom: 10px !important;border-radius: 10px;text-decoration:none">
						<center><img src = "maintenance.png" alt = "Generic placeholder thumbnail" style="width:50px">
						<p style="color:#161616;line-height:35px;font-weight: 600;">Maintenance</p></center>
					</a>
				</div>
				<div class = "col-xs-4" style="padding-right: 4px !important;padding-left: 4px !important;" onClick="post_request('4', 'House Keeping' )">
					<a href = "#" class = "thumbnail" style="margin-bottom: 10px !important;border-radius: 10px;text-decoration:none">
						<center><img src = "bell-boy-1.png" alt = "Generic placeholder thumbnail" style="width:50px">
						<p style="color:#161616;line-height:35px;font-weight: 600;">Attendant</p></center>
					</a>
				</div>
				<div class = "col-xs-4" style="padding-right: 4px !important;padding-left: 4px !important;" onClick="post_request('7', 'Travel Desk' )">
					<a href = "#" class = "thumbnail" style="margin-bottom: 10px !important;border-radius: 10px;text-decoration:none">
						<center><img src = "traveldesk.png" alt = "Generic placeholder thumbnail" style="width:45px">
						<p style="color:#161616;line-height:35px;font-weight: 600;">Travel Desk</p></center>
					</a>
				</div>
		    </div>
		</div>
     
		<div class="container" style="background-color:#e5e5e5;width:97%">
		  <div class="row" style="background-color:#fff;box-shadow: 1px 1px 1px 2px #ccc;border-radius: 4px;">
			<div class="col-xs-4" data-toggle="modal" data-target="#modalAppLogin" style="border-right:1px solid #ccc;padding-right: 4px !important;padding-left: 4px !important;">
				<div class="msg">
				  <center><img  src="guest complaints.png" alt="sms" style="width:45px !important"></center>
				  <div class="caption">Complaints</div>
				
			  </div>
			</div>
			<div class="col-xs-4" data-toggle="modal" data-target="#modalAppLogin" style="border-right:1px solid #ccc">
			  <div class="msg">
				 <center><img  src="like-4.png" alt="sms" style="width:40px !important"></center>
				  <div class="caption">
				   Feedbacks
				  </div>
			  </div>
			</div>
			<div class="col-xs-4" data-toggle="modal" data-target="#modalAppLogin">
			   <div class="msg">
				  <center><img  src="phone-receiver 2.png" alt="sms" style="width:45px !important"></center>
				  <div class="caption">Call -Chat</div>
			  </div>
			</div>
		  </div>
		</div>

<div class="container" style="background-color:#e5e5e5;width:97%" data-toggle="modal" data-target="#modalAppLogin">
	<div class="row">
		<img class="img-responsive a" src="amenitiesfacilities.png" alt="" width="100%" style="height:250px;">
	</div>
</div>


	<div class="modal fade" id="defaultModaladdrequest" tabindex="-1" role="dialog"  >

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
					<h4 class="modal-title" style= "font-size:20px;font-weight:700;text-transform:uppercase" id="defaultModalLabel"><center>Add <span id="department_name" ></span> Request</center></h4>
                </div>
                <div class="modal-body">
				<input type="hidden" name="id" id="id">
				<input type="hidden" name="department" id="department" value="">
				<input type="hidden" name="guest_room_id" id="guest_room_id" value="<?php if(isset($room_id) && $room_id!=""){echo $room_id;}?>">
				<input type="hidden" name="guest_id" id="guest_id" value="<?php if(isset($guest_id) && $guest_id!=""){echo $guest_id;}?>">
					<div class="row clearfix">
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

							<div class="form-group">
								<div class="form-line">
								<div class ="">Request:
								<input type="text" id="request_question" name="request_question"  class="form-control" style="font-size: 19px !important;" > 	
								</div>
								</div>
								<span id="req_err" style="color:red"></span>
								</div>
							</div>
						</div>
                </div>
				<input type="hidden" name="id" id="id">

               	
				 <div class="modal-footer">
				
                    <button type="button" class="btn btn-primary waves-effect float-left" style="float:left !important" onclick="add_request_guest();">ADD</button>
                    <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
               
            </div>
        </div>
    </div>
	<?php 
		$form_data2 = array(
			"location_id" => $location_id
		);	
		$ch = curl_init('http://risolvehm.com/api/guest/restaurent_dishes_list');
		$form_data12 = json_encode($form_data2); 
		// $authorization = "Authorization: Bearer ".$token; // Prepare the authorisation token
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' )); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
		curl_setopt($ch, CURLOPT_POSTFIELDS, $form_data12); // Set the posted fields
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
		$result2 = curl_exec($ch); // Execute the cURL statement
		curl_close($ch); // Close the cURL connection
		$transaction2 = json_decode($result2);
		//echo "<pre>";print_r($transaction2->content);exit;
	?>
	<div class="modal fade" id="orderModel"  tabindex="-1" role="dialog">

			<div class="modal-dialog">

				<div class="modal-content">

					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<center><h4 class="modal-title">Restaurant</h4></center>
					</div>

					<div class="modal-body">
						<div class="container">
							<input type="hidden" name="order_guest_room_id" id="order_guest_room_id" value="<?php if(isset($room_id) && $room_id!=""){echo $room_id;}?>">
							<input type="hidden" name="order_guest_id" id="order_guest_id" value="<?php if(isset($guest_id) && $guest_id!=""){echo $guest_id;}?>">
							<div class="row">
								<div class="col-sm-8 col-xs-6">
									<input type="text" class="form-control" name="tags"  id="tags" placeholder="Write a dish name"/>
									<!--<select class="form-control" name="itemname[]" id="itemname_<?php //echo $i;?>" >
										<option value="">--dish name--</option>
										<?php foreach($transaction2->content as $dishes){ ?>
										<option value="<?php echo $dishes->dish_id;?>" ><?php echo $dishes->dish_name;?></option>
										<?php } ?>
									</select>--> 	
								</div>
								<div class="col-sm-2 col-xs-4">
									<input type="number" class="form-control" name="count" min=1  max=10/ placeholder="qty">
								</div>
								<div class="col-sm-2 col-xs-2">
									<i class="fa fa-window-close" style="color:#F06726;border-radius:20px;font-size:30px" aria-hidden="true"></i>
								</div>
							</div>
						</div>
						
						<div class="mx-auto text-center" style="margin:10px 0px">
							<button id="button" name="button" class="btn btn-primary">ADD DISH</button>
						</div>
						<div class="container">
							<input type="text" class="form-control" style="margin-bottom:10px" name="name" placeholder="Cooking istructions" />
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-primary float-right" style="float:right;margint-top:10px;color:#fff;background-color:#F06726">ORDER</button>
					</div><!-- modal-footer ends -->

				</div><!-- modal-content ends -->

			</div><!-- modal-dialog ends -->

		</div><!-- modal ends -->
		
		
	<div class="modal fade" id="modalAppLogin">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">&times;</button>
					<center><h4 class="modal-title">Download App</h4></center>
				</div>
				
				<div class="modal-body">
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
					</div>

					<div class="modal-footer">
						<button class="btn btn-warning" data-dismiss="modal">
						Close
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!------------------------------Model------------------------>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script>
function add_request_guest() {
		var request_question = $('#request_question').val();
		var department = $('#department').val();
		var guest_room_id = $('#guest_room_id').val();
		var guest_id = $('#guest_id').val();
		var location_id = '<?php if(isset($location_id) && $location_id!=""){echo $location_id;}?>';
		var id = $('#hidden_req_id').val();
		var flag=true;
		if(request_question==""){
			$('#req_err').html('please enter request');
			$("#confirm-req-add").modal('hide');
			flag= false;
		}else{
			$('#dep_err').html('');
		}
		if(department==""){
			$('#dep_err').html('Please select department');
			flag= false;
		}else{
			$('#dep_err').html('');
		}
		if(guest_room_id==""){
			$('#room_err').html('Please select room');
			flag= false;
		}else{
			$('#room_err').html('');
		}
		if(flag==true){ 
			$.ajax({
				url: "save_request.php",
				data:'request_question='+request_question+'&department='+department+'&guest_room_id='+guest_room_id+'&location_id='+location_id+'&guest_id='+guest_id+'&action=add',
				type: "POST",
				format:"html",
				success:function(data){
				
					$("#defaultModaladdrequest").modal('hide');
					$('#department').val('');
					$('#request_question').val('');
					//$('#guest_room_id').val('');
					window.location.href = "updates.php?lid="+location_id+"&rid="+guest_room_id;
				}
			});
		}
	}	
	
	function add_request_popup(){
		var department = $('#department').val();
		var request_question = $('#request_question').val();
		var guest_room_id = $('#guest_room_id').val();
		if(department==""){
			$('#dep_err').html('please select department');
		}else{	
			$('#dep_err').html('');
			$('#confirm-req-add').modal('show');
		}
		if(request_question ==""){
			$('#req_err').html('please enter request');
		}else{	
			$('#req_err').html('');
			$('#confirm-req-add').modal('show');
		}
		if(guest_room_id ==""){
			$('#room_err').html('please select room');
		}else{   
			$('#room_err').html('');
			$('#confirm-req-add').modal('show');
		}
	}
	
	function get_request_id(dep_id, command, dep_name)
	{
		$('#department').val(dep_id);
		$('#request_question').val(command);
		$('#department_name').html(dep_name);
		$("#defaultModaladdrequest").modal('show');
	}
	
	function post_request(dep_id, dep_name)
	{
		if(dep_id==8){
		}else{
			$('#department').val(dep_id);
			$('#department_name').html(dep_name);
			$('#request_question').val("");
			$("#defaultModaladdrequest").modal('show');
		}
	}
	
	function get_order_popup()
	{
		//$('#request_question').val(command);
		//$('#department_name').html(dep_name);
		$("#orderModel").modal('show');
	}
	
</script>	

<script>
  $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
  </script>


</body>
</html>