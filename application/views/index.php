<div class="row">
	<div class="col-md-8 "><div class="tile ">

		<h3><?php echo $graphTitle ?></h3>
		<div class="filter">
			<h4 class="selected" id="map">map</h4>
			<h4 id="chart">chart</h4>
			<h4 id="list">list</h4>
		</div>
		<div id="graph_display">
			<?php $this->load->view("charts/chart_line");?>
		</div></div>
	</div>
	<div class="col-md-4 "><div class="tile ">
		<h3>incoming alerts</h3>
		
		<div class="filter">
			<h4 class="selected">chart</h4>
			<h4>list</h4>
		</div>
			<?php echo $summaries; ?>
		
		<a class='btn btn-default'  href="<?php echo base_url() . 'c_incident/addIncident'; ?>"><i class="fa fa-plus"></i>Add Incident</a>
	</div>
</div>
</div>
<div class="row">
	<div class="col-md-4 "><div class="tile ">
		<h3><?php echo $reports?></h3>
		
		<?php echo $filed_reports; ?>
		<a class='btn btn-default' href="<?php echo base_url() . 'c_reports/addReport'; ?>"><i class="fa fa-plus"></i>Add Report</a>
	</div>
		</div>
	<div class="col-md-4 ">
		<div class="tile ">
		<h3>map</h3>
		<div class="filter">
			<h4 class="selected">map</h4>
			<h4>chart</h4>
			<h4>list</h4>
		</div>
		<div id="mapbox">
		</div>
	</div>
	</div>
	<div class="col-md-4 "><div class="tile ">
		<h3>resources</h3>
		<div class="filter">
			<h4 class="selected">chart</h4>
			<h4>list</h4>
		</div>
	
		<?php echo $resource_reports; ?>
			<a class='btn btn-default' href="<?php echo base_url() . 'c_resource/addResource'; ?>"><i class="fa fa-plus"></i>Add Resource</a>
	</div>
</div></div>

<script>
	var map = L.mapbox.map('mapbox', 'examples.map-vyofok3q').setView([-1.31008, 36.81333], 17);

	L.mapbox.markerLayer({
		// this feature is in the GeoJSON format: see geojson.org
		// for the full specification
		type : 'Feature',
		geometry : {
			type : 'Point',
			// coordinates here are in longitude, latitude order because
			// x, y is the standard for GeoJSON and many formats
			coordinates : [36.81333, -1.31008]
		},
		properties : {
			title : 'Strathmore University',
			description : 'Student Center',
			// one can customize markers by adding simplestyle properties
			// http://mapbox.com/developers/simplestyle/
			'marker-size' : 'small',
			'marker-color' : '#f0a'
		}
	}).addTo(map); 
</script>
        
 
