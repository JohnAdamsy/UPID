
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
<style>
    
    #map { position:absolute; width:29%; height:32%}
  </style>
  
<div class="tile-half">
	<div class="tile large">
		<h3><?php echo $graphTitle ?></h3>
		<div class="filter">
			<h4 class="selected">map</h4>
			<h4>chart</h4>
			<h4>list</h4>
		</div>
	</div>
	<div class="tile small">
		<h3>incoming alerts</h3>
		<div class="filter">
			<h4 class="selected">chart</h4>
			<h4>list</h4>
		</div>
	</div>
</div>
<div class="tile-half">
	<div class="tile small">
		<h3><?php echo $reports?></h3>
	</div>
	<div class="tile small">
		<h3>map</h3>
		<div class="filter">
			<h4 class="selected">map</h4>
			<h4>chart</h4>
			<h4>list</h4>
		</div>
		<div id="map">
			
		</div>
	</div>
	<div class="tile small">
		<h3>resources</h3>
		<div class="filter">
			<h4 class="selected">chart</h4>
			<h4>list</h4>
		</div>
	</div>
</div>

<script>
        $(document).ready(function() {
            var map = L.mapbox.map('map', 'examples.map-4l7djmvo')
    .setView([1.283, 36.817], 6);

        });             
        </script>
        
        
        

