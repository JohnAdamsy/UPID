<div class="row">
	<div class="col-md-8">
		<div class="tile ">
			<h3><?php echo $graphTitle;?></h3>
			<div class="filter">
				<h4 class="selected" id="map">map</h4>
				<h4 id="chart">chart</h4>
				<h4 id="list">list</h4>
			</div>
			<div id="graph_display">
				<?php $this -> load -> view("charts/chart_line");?>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="tile ">
			<h3>incoming alerts</h3>
			<a data-toggle="modal" href="<?php echo site_url("c_front/modal/alerts");?>" data-target="#myModal" class='modal_btn btn btn-default'><i class="fa fa-plus"></i>Submit Alert</a>
			<div class="table-responsive">
				<?php echo $summaries;?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="tile ">
			<h3>reports</h3>
			<a data-toggle="modal" href="<?php echo site_url("c_front/modal/reports");?>" data-target="#myModal" class='modal_btn btn btn-default'><i class="fa fa-plus"></i>Add Report</a>
			<div class="table-responsive">
				<?php echo $filed_reports;?>
			</div>
		</div>
	</div>
	<div class="col-md-4 ">
		<div class="tile">
			<h3>map</h3>
			<div class="filter">
				<h4 class="selected">map</h4>
				<h4>chart</h4>
				<h4>list</h4>
			</div>
			<div id="map-canvas" style="width:100%;height:86%;"></div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="tile ">
			<h3>resources</h3>
			<div class="filter">
				<h4 class="selected">chart</h4>
				<h4>list</h4>
			</div>
			<a data-toggle="modal" href="<?php echo site_url("c_front/modal/resource");?>" data-target="#myModal" class='modal_btn btn btn-default'><i class="fa fa-plus"></i>Add Resource</a>
			<div class="table-responsive">
				<?php echo $resource_reports;?>
			</div>
		</div>
	</div>
</div>
<!-- Map Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form class="form-horizontal" action="<?php echo base_url() . 'c_front/save';?>" id="modal_action" method="post">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title">UPID</h4>
				</div>
				<div class="modal-body"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						Close
					</button>
					<button type="button" class="btn btn-primary">
						Save changes
					</button>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		// Note: This example requires that you consent to location sharing when
		// prompted by your browser. If you see a blank space instead of the map, this
		// is probably because you have denied permission for location sharing.

		var map;

		function detectBrowser() {
			var useragent = navigator.userAgent;
			var mapdiv = document.getElementById("map-canvas");

			if(useragent.indexOf('iPhone') != -1 || useragent.indexOf('Android') != -1) {
				mapdiv.style.width = '100%';
				mapdiv.style.height = '100%';
			} else {
				mapdiv.style.width = '600px';
				mapdiv.style.height = '800px';
			}
		}

		function initialize() {
			var mapOptions = {
				zoom : 12
			};
			map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

			// Try HTML5 geolocation
			if(navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
					$('.modal').on('shown', function() {
						google.maps.event.trigger(map, 'resize');

						// also redefine center
						map.setCenter(pos);

					});

					map.setCenter(pos);

					var marker = new google.maps.Marker({
						position : pos,
						map : map,
						title : 'You are here!'
					});
				}, function() {
					handleNoGeolocation(true);
				});
			} else {
				// Browser doesn't support Geolocation
				handleNoGeolocation(false);
				var marker = new google.maps.Marker({
					position : pos,
					map : map,
					title : 'Geolocation not supported'
				});
			}

		}

		function handleNoGeolocation(errorFlag) {
			if(errorFlag) {
				var content = 'Error: The Geolocation service failed.';
			} else {
				var content = 'Error: Your browser doesn\'t support geolocation.';
			}

			var options = {
				map : map,
				position : new google.maps.LatLng(0, 0),
				content : content
			};

			var infowindow = new google.maps.InfoWindow(options);
			map.setCenter(options.position);
		}


		google.maps.event.addDomListener(window, 'load', initialize);

		$(".dataTablesi").dataTable({
			"sPaginationType" : "full_numbers",
			"bStateSave" : true,
			"bInfo" : true,
			"sScrollX" : "100%",
			"bScrollCollapse" : true,
			"sScrollY" : "200px",
			"bDestroy" : true,
			"bFilter" : false,
			"bInfo" : false,
			"bLengthChange" : false,
			"iDisplayLength" : 5
		});

	});

</script>