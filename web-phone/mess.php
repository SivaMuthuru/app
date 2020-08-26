<!doctype html>
<html>
<head>
<title>Risolve Smart Guest</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="scrollyeah/default.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</head>

<body>
<div class="container" style="background-color:#fc6f2a">
	<div class="row" style="padding:10px">
		<div class="col-sm-2 col-xs-2"><a href="dashboard.php?lid=<?php if(isset($location_id) && $location_id!=""){echo $location_id;}?>&rid=<?php if(isset($room_id) && $room_id!=""){echo $room_id;}?>" ><i class="fa fa-arrow-left" aria-hidden="true" style="width:100px;color:#fff;font-size:30px"></i></a></div>
		<div class="col-sm-10 col-xs-10">
		<p style="color:#fff;font-size:20px"> Messages</p>
		</div>
	</div>
</div>
<div class="container">
 <div class="row">
<img src="HOTELIMAGE.jpeg" alt="Chania" width="100%" class="img-responsive" style="">
</div>
</div>
<div class="container" style="background-color:#e5e5e5;">
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

<div class="container" style="background-color:#ccc;padding:2px 5px">
	
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:1px;border-radius:5px 5px 0 0">
		<div class="col-sm-2 col-xs-5">
			<b>Request ID : 222</b>
			</br>
			<b>22 Jun , 10:19 pm</b>
		</div>
		<div class="col-sm-2 col-xs-2">
			<img src="roomservice.png" width="50px" height="50px">
		</div>
		<div class="col-sm-5 col-xs-5">
			<b>From : Room 202</b>
			</br>
			<b>To : Restaurent</b>
		</div>
	</div>
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:1px">
		<div class="col-sm-4">
		<p><b>Status: </b> sdsds</p>
		</div>
	</div>
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:1px;border-radius:0 0 5px 5px">
		<div class="col-sm-12">
			<b>Guest</b>
			<p>Item </p>
		</div>
		<!--<div class="col-sm-4">
			<img src="img.jpg" style="width:100px">
		</div>-->
	</div>
	
	<div class="row" style="padding:5px">
		<div class="col-sm-4 col-xs-4" style="padding-right: 9px;padding-left: 9px;">
			<button class="btn btn-default btn-lg btn-block" style="font-size:13px"><img src="arrow.png" width="20px" height="30px" > Maximize</button>
		</div>
		<div class="col-sm-4 col-xs-4" style="padding-right: 9px;padding-left: 9px;">
			<button class="btn btn-default btn-lg btn-block" style="font-size:13px"><img src="cancel.png" width="20px" height="30px" > Close</button> 
		</div>
	<div class="col-sm-4 col-xs-4" style="padding-right: 9px;padding-left: 9px;">
			<button class="btn btn-default btn-lg btn-block" style="font-size:13px"><img src="chat.png" width="20px" height="30px" >  Chat</button>
		</div>
	</div>
	
</div>

<div class="container" style="background-color:#ccc;padding:2px 5px">
	
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:1px;border-radius:5px 5px 0 0">
		<div class="col-sm-2 col-xs-5">
			<b>Request ID : 222</b>
			</br>
			<b>22 Jun , 10:19 pm</b>
		</div>
		<div class="col-sm-2 col-xs-2">
			<img src="roomservice.png" width="50px" height="50px">
		</div>
		<div class="col-sm-5 col-xs-5">
			<b>From : Room 202</b>
			</br>
			<b>To : Restaurent</b>
		</div>
	</div>
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:1px">
		<div class="col-sm-4">
		<p><b>Status: </b> sdsds</p>
		</div>
	</div>
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:1px;border-radius:0 0 5px 5px">
		<div class="col-sm-12">
			<b>Guest</b>
			<p>Item </p>
		</div>
		<!--<div class="col-sm-4">
			<img src="img.jpg" style="width:100px">
		</div>-->
	</div>
	
	<div class="row" style="padding:5px">
		<div class="col-sm-4 col-xs-4" style="padding-right: 9px;padding-left: 9px;">
			<button class="btn btn-default btn-lg btn-block" style="font-size:13px"><img src="arrow.png" width="20px" height="30px" > Maximize</button>
		</div>
		<div class="col-sm-4 col-xs-4" style="padding-right: 9px;padding-left: 9px;">
			<button class="btn btn-default btn-lg btn-block" style="font-size:13px"><img src="cancel.png" width="20px" height="30px" > Close</button> 
		</div>
	<div class="col-sm-4 col-xs-4" style="padding-right: 9px;padding-left: 9px;">
			<button class="btn btn-default btn-lg btn-block" style="font-size:13px"><img src="chat.png" width="20px" height="30px" >  Chat</button>
		</div>
	</div>
	
</div>

<div class="container" style="background-color:#ccc;padding:2px 5px">
	
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:1px;border-radius:5px 5px 0 0">
		<div class="col-sm-2 col-xs-5">
			<b>Request ID : 222</b>
			</br>
			<b>22 Jun , 10:19 pm</b>
		</div>
		<div class="col-sm-2 col-xs-2">
			<img src="roomservice.png" width="50px" height="50px">
		</div>
		<div class="col-sm-5 col-xs-5">
			<b>From : Room 202</b>
			</br>
			<b>To : Restaurent</b>
		</div>
	</div>
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:1px">
		<div class="col-sm-4">
		<p><b>Status: </b> sdsds</p>
		</div>
	</div>
	<div class="row" style="background-color:#fff;padding:2px 2px;margin:1px;border-radius:0 0 5px 5px">
		<div class="col-sm-12">
			<b>Guest</b>
			<p>Item </p>
		</div>
		<!--<div class="col-sm-4">
			<img src="img.jpg" style="width:100px">
		</div>-->
	</div>
	
	<div class="row" style="padding:5px">
		<div class="col-sm-4 col-xs-4" style="padding-right: 9px;padding-left: 9px;">
			<button class="btn btn-default btn-lg btn-block" style="font-size:13px"><img src="arrow.png" width="20px" height="30px" > Maximize</button>
		</div>
		<div class="col-sm-4 col-xs-4" style="padding-right: 9px;padding-left: 9px;">
			<button class="btn btn-default btn-lg btn-block" style="font-size:13px"><img src="cancel.png" width="20px" height="30px" > Close</button> 
		</div>
	<div class="col-sm-4 col-xs-4" style="padding-right: 9px;padding-left: 9px;">
			<button class="btn btn-default btn-lg btn-block" style="font-size:13px"><img src="chat.png" width="20px" height="30px" >  Chat</button>
		</div>
	</div>
	
</div>

</body>
</html>