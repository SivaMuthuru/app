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

?>
<head>
  <title>Risolve SmartGuest</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

<div class="container" style="background-color:#fc6f2a">
	<div class="row" style="padding:20px">
		<div class="col-sm-2 col-xs-2"><a href="dashboard.php?lid=<?php if(isset($location_id) && $location_id!=""){echo $location_id;}?>&rid=<?php if(isset($room_id) && $room_id!=""){echo $room_id;}?>" ><i class="fa fa-arrow-left" aria-hidden="true" style="width:100px;color:#fff;font-size:30px"></i></a></div>
		<div class="col-sm-10 col-xs-10">
		<p style="color:#fff;font-size:20px">Contact Front Desk</p>
		</div>
	</div>
</div>
				
	<div class="container" style="padding:10px">
	<p style="margin-top:10px;font-weight:900">Contact To Front Desk</p>	
	</div>
  
	<div class="container">
		
	           <p> Please contact to front desk for room CheckIn</p>             
		
	</div>

</body>

</html>