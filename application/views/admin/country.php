
<div class="right" style="float: left; width: 60%; ">
	<table border="1" width="90%">
		<thead>
			<th>#</th>
			<th>Country Name</th>
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
		<td>".$value['countryName']."</td>
		<td><a href='".base_url()."c_admin/edit/country/".$value['upidCountryID']."'>Edit</a></td>
		<td><a href='".base_url()."c_admin/deletecountry/".$value['upidCountryID']."' onclick= \"return confirm('Are you sure you want to delete?')\">Delete</a></td>
		</tr>";	
		}
		?>	
			
		</tbody>
	</table>
	
</div>
<div class="right" style="float: left; width: 40%; ">
	<form action="<?php echo base_url(); ?>c_admin/addcountry" method="post">
		<table border="0">
			<tr>
				<td>Country name:</td><td><input type="text" name="country" /></td>
				</tr>
				<tr>
				<td colspan="2"><input type="submit" value="Save Country" />
				</td>
			</tr>
		</table>
	</form>
	</div>