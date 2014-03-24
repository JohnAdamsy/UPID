
<div class="right" style="float: left; width: 60%; ">
	<table border="1" width="90%">
		<thead>
			<th>#</th>
			<th>Category Name</th>
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
		<td>".$value['categoryName']."</td>
		<td><a href='".base_url()."c_admin/edit/alert/".$value['alertCategoryID']."'>Edit</a></td>
		<td><a href='".base_url()."c_admin/deletealertcat/".$value['alertCategoryID']."' onclick= \"return confirm('Are you sure you want to delete?')\">Delete</a></td>
		</tr>";	
		}
		?>	
			
		</tbody>
	</table>
	
</div>
<div class="right" style="float: left; width: 40%; ">
	<form action="<?php echo base_url(); ?>c_admin/addalertcat" method="post">
		<table border="0">
			<tr>
				<td>Alert Category name:</td><td><input type="text" name="alertcategory" /></td>
				</tr>
				<tr>
				<td colspan="2"><input type="submit" value="Save Category" />
					<!-- Button to trigger modal -->
<!-- Button to trigger modal -->
<a data-target="#myModal" role="button" class="btn" data-toggle="modal">Launch demo modal</a>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Save changes</button>
  </div>
</div>
					
				</td>
			</tr>
		</table>
	</form>
	</div>