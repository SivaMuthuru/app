
<?php
include "db.php";

if(isset($_GET['lid']) && $_GET['lid']!=""){
	$location_id = $_GET['lid'];
}else{
	$location_id = 0;
}
//echo $location_id;exit;
?> 
<!DOCTYPE html>
<html>

<!-- Latest compiled and minified Bootstrap CSS -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<style>
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
</style>

<div class = "container">
    <div class="panel-group" id="accordion">
	<?php 
	$sql = "SELECT * FROM restaurent_categories where status=1 and rc_location_id=".$location_id;
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			//echo "<pre>";print_r($row);exit;
			if(isset($row['menu_image']) && $row['menu_image']!=""){
				$menu_image = $base_url.$row['menu_image'];
			}else{
				$menu_image = 'img.jpg';
			}
	?>
		<div class="panel panel-default" style="margin-top:20px">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $row['id'];?>">
					<div class="row">
						<div class="col-sm-3 col-xs-4"><img src="<?php if(isset($menu_image) && $menu_image!=""){ echo $menu_image;}?>" width="100%" height="100px"/>
						</div>		  
						<div class="col-sm-7 col-xs-8"><?php echo $row['name'];?>
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
							<p><?php echo $i;?> items : <?php echo $dish_names;?></p>
							
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
							// output data of each row
								while($row3 = mysqli_fetch_assoc($result3)) {
									
								if(isset($row3['item_image']) && $row3['item_image']!=""){
									$item_image = $base_url.$row3['item_image'];
								}else{
									$item_image = 'img.jpg';
								}
									
						?>
						<div class="col-md-3 col-xs-6">
							<div class="thumbnail">
								<img src="<?php if(isset($item_image) && $item_image!=""){ echo $item_image;}?>" alt="Nature" style="width:100%;height:200px">
								<div class="caption">
									<p><i class="icon-dashboard"></i><?php echo $row3['item_name'];?></p>
									<?php if(isset($row3['cost']) && $row3['cost']!=""){ echo 'Rs '.$row3['cost'];}?> &nbsp;&nbsp;&nbsp;&nbsp;
								</div>
							</div>
						</div>
						<?php } }?>
					</div>
			  </div>
			</div>
		</div>
		
		<?php 
				}
			}
		?>
	</div>
	
</div> <!-- end container -->

<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</html>