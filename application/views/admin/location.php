
<div class="right" style="float: left; width: 60%; ">
	<table border="1" width="90%">
		<thead>
			<th>#</th>			
			<th>Location Name</th>
			<th>Region</th>
			<th>Country</th>
			<th>Edit</th>
			<th>Delete</th>
		</thead>
		<tbody>
		<?php
		$num=0;
		foreach ($alertcat as $key => $value) {
			$num++;
		echo "<tr>
		<td>".$num."</td>
		<td>".$value['localityName']."</td>
		<td>".$value['regionName']."</td>
		<td>".$value['countryName']."</td>
		<td><a href='".base_url()."c_admin/edit/location/".$value['locationID']."'>Edit</a></td>
		<td><a href='".base_url()."c_admin/deletelocation/".$value['locationID']."' onclick= \"return confirm('Are you sure you want to delete?')\">Delete</a></td>
		</tr>";	
		}
		?>	
			
		</tbody>
	</table>
	
</div>
<div class="right" style="float: left; width: 40%; ">
	<form action="<?php echo base_url(); ?>c_admin/addlocation" method="post">
		<table border="0">
			<tr>
				<td>Locality name:</td><td><input type="text" name="location" /></td>
				</tr>
				<tr>
				<td>Region name:</td><td><input type="text" name="region" /></td>
				</tr>
				<tr>
				<td>Country:</td><td>
					<select name="country">
					<option selected="selected">Country</option>
					<?php foreach ($country as $key => $value) {
						
						echo "<option value=".$value['upidCountryID'].">".$value['countryName']."</option>";
					} ?>
					</select>
				</td>
				</tr>
				<tr>
				<td colspan="2"><input type="submit" value="Save Country" />
				</td>
			</tr>
		</table>
	</form>
	</div>