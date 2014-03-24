
<div class="right" style="float: left; width: 60%; ">
	<table border="1" width="90%">
		<thead>
			<th>#</th>			
			<th>Type Name</th>
			<th>Category</th>
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
		<td>".$value['alertTypeName']."</td>
		<td>".$value['categoryName']."</td>
		<td><a href='".base_url()."c_admin/edit/alerttype/".$value['alertTypeID']."'>Edit</a></td>
		<td><a href='".base_url()."c_admin/deletealerttype/".$value['alertTypeID']."' onclick= \"return confirm('Are you sure you want to delete?')\">Delete</a></td>
		</tr>";	
		}
		?>	
			
		</tbody>
	</table>
	
</div>
<div class="right" style="float: left; width: 40%; ">
	<form action="<?php echo base_url(); ?>c_admin/addalerttype" method="post">
		<table border="0">
			<tr>
				<td>Alert Type name:</td><td><input type="text" name="alerttype" /></td>
				</tr>
				<tr>
				<td>Category:</td><td>
					<select name="alertcategory">
					<option selected="selected">Categories</option>
					<?php foreach ($country as $key => $value) {
						
						echo "<option value=".$value['alertCategoryID'].">".$value['categoryName']."</option>";
					} ?>
					</select>
				</td>
				</tr>
				<tr>
				<td colspan="2"><input type="submit" value="Save Category" />
				</td>
			</tr>
		</table>
	</form>
	</div>