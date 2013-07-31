<!--div class="MySplitter">
	<div id="TopSplitter">
		<div>
			fdfsdfsdfsdfsdf
		</div>
		<div>
			fsdfsdfsdfsdfs
		</div>

	</div>

	<div id="BottomSplitter">
		

	</div>
</div-->

	    <script>
	$(function () {
        $('#graph_display').highcharts({
            title: {
                text: '<?php echo $chartTitle; ?>',
                x: -20 //center
            },
            subtitle: {
                text: 'UPID',
                x: -20
            },
            xAxis: {
                categories: <?php echo $categories; ?>
            },
            yAxis: {
                title: {
                    text: '<?php echo $yAxis; ?>'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },credits: {
		enabled: false
		},
            series: <?php echo$resultArray?>
        });
    });
</script>
<div class="tile-half">
	<div class="tile large">

		<h3><?php echo $graphTitle ?></h3>
		<div class="filter">
			<h4 class="selected" id="map">map</h4>
			<h4 id="chart">chart</h4>
			<h4 id="list">list</h4>
		</div>
		<div id="graph_display">
			
		</div>
	</div>
	<div class="tile small">
		<h3>incoming alerts</h3>
		<a class="btn" href="<?php echo base_url().'c_incident/addIncident'; ?>">Add Incident</a>
		<div class="filter">
			<h4 class="selected">chart</h4>
			<h4>list</h4>
		</div>
		<div style="margin-top:30px;">
			<?php echo $summaries; ?>
		</div>
	</div>
</div>
<div class="tile-half">
	<div class="tile small">
		<h3><?php echo $reports?></h3>
		<a class="btn" href="<?php echo base_url().'c_reports/addReport'; ?>">Add Report</a>
		<?php echo $filed_reports; ?>
	</div>
		
	<div class="tile small">
		<h3>map</h3>
		<div class="filter">
			<h4 class="selected">map</h4>
			<h4>chart</h4>
			<h4>list</h4>
		</div>
		<div id="mapbox">
		</div>
	</div>
	
	<div class="tile small">
		<h3>resources</h3>
		<div class="filter">
			<h4 class="selected">chart</h4>
			<h4>list</h4>
		</div>
		<a class="btn" href="<?php echo base_url().'c_resource/addResource'; ?>">Add Resource</a>
		<?php echo $resource_reports;?>
	</div>
</div>

<script>

var map = L.mapbox.map('mapbox', 'examples.map-vyofok3q')
    .setView([-1.31008, 36.81333], 17);

L.mapbox.markerLayer({
    // this feature is in the GeoJSON format: see geojson.org
    // for the full specification
    type: 'Feature',
    geometry: {
        type: 'Point',
        // coordinates here are in longitude, latitude order because
        // x, y is the standard for GeoJSON and many formats
        coordinates: [36.81333, -1.31008]
    },
    properties: {
        title: 'Strathmore University',
        description: 'Student Center',
        // one can customize markers by adding simplestyle properties
        // http://mapbox.com/developers/simplestyle/
        'marker-size': 'small',
        'marker-color': '#f0a'
    }
}).addTo(map);
</script>
        
 
