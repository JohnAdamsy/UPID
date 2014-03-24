<?php if($type=='alert'){ ?>
	<h1>Edit Alert Categories</h1>
	<form method="post" action="<?php echo base_url(); ?>c_admin/updatealertcat/<?php echo $alertcat['alertCategoryID']; ?>">
		<table width="100%">
			<tr>
				<td>Edit Alert Categories</td>
				<td><input type="text" value="<?php echo $alertcat['categoryName']; ?>" name="alertcategory" /></td>
			</tr>
			
			<tr>
				<td colspan="2"><center><input type="submit" name="submit" value="Edit Category" />&nbsp;</center></td>
			</tr>
		</table>
		
	</form>
	<button onclick="location.href='<?php echo base_url();?>c_admin/alertcat'">Return to Categories</button>
	</div>
	</div>
</div>
<?php } ?>
<?php if($type=='country'){ ?>
	<h1>Edit Country</h1>
	<form method="post" action="<?php echo base_url(); ?>c_admin/updatecountry/<?php echo $alertcat['upidCountryID']; ?>">
		<table width="100%">
			<tr>
				<td>Edit Alert Categories</td>
				<td><input type="text" value="<?php echo $alertcat['countryName']; ?>" name="country" /></td>
			</tr>
			
			<tr>
				<td colspan="2"><center><input type="submit" name="submit" value="Edit Country" />&nbsp;</center></td>
			</tr>
		</table>
		
	</form>
	<button onclick="location.href='<?php echo base_url();?>c_admin/country'">Return to Countries</button>
	</div>
	</div>
</div>
<?php } ?>


<?php if($type=='resource'){ ?>
	<h1>Edit Resource Categories</h1>
	<form method="post" action="<?php echo base_url(); ?>c_admin/updateresource/<?php echo $alertcat['resourceTypeID']; ?>">
		<table width="100%">
			<tr>
				<td>Edit Resource Categories</td>
				<td><input type="text" value="<?php echo $alertcat['resourceTypeName']; ?>" name="resource" /></td>
			</tr>
			
			<tr>
				<td colspan="2"><center><input type="submit" name="submit" value="Edit Resource" />&nbsp;</center></td>
			</tr>
		</table>
		
	</form>
	<button onclick="location.href='<?php echo base_url();?>c_admin/country'">Return to Countries</button>
	</div>
	</div>
</div>
<?php } ?>

<?php if($type=='resources'){ ?>
	<h1>Edit Resource</h1>
	<form method="post" action="<?php echo base_url(); ?>c_admin/updateresourcecat/<?php echo $alertcat['resourceId']; ?>">
		<table width="50%">
			<tr>
				<td>Resource Name:</td>
				<td><input type="text" value="<?php echo $alertcat['resourceName']; ?>" name="resource" /></td>
			</tr>
			<tr>
				<td>Ownership:</td>
				<td><select name="ownership">
					<option selected="selected">Ownership</option>
					<option value="public">Public</option>
					<option value="private">Private</option>
				</select></td>
			</tr>
	
	<tr>  
		<td>Additional Information</td>
		<td><textarea name="additionalInformation">
			<?php echo $alertcat['additionalInformation']; ?>
		</textarea></td></tr>
			
			<tr>
				<td colspan="2"><center><input type="submit" name="submit" value="Edit Resource" />&nbsp;</center></td>
			</tr>
		</table>
		
	</form>
	<button onclick="location.href='<?php echo base_url();?>c_admin/country'">Return to Countries</button>
	</div>
	</div>
</div>
<?php } ?>

<?php if($type=='location'){ ?>
	<h1>Edit Location</h1>
	<form method="post" action="<?php echo base_url(); ?>c_admin/updatelocation/<?php echo $alertcat['locationID']; ?>">
		<table width="100%">
			<tr>
				<td>Location</td>
				<td><input type="text" value="<?php echo $alertcat['localityName']; ?>" name="location" /></td>
			</tr>
			<tr>
				<td>Region</td>
				<td><input type="text" value="<?php echo $alertcat['regionName']; ?>" name="region" /></td>
			</tr><tr>
				<td>Country</td>
				<td><select name="country">
					
					<?php 
					echo "<option selected='selected' value=".$mycountry['upidCountryID'].">".$mycountry['countryName']."</option>";	
					foreach ($country as $key => $value) {	
						echo "<option value=".$value['upidCountryID'].">".$value['countryName']."</option>";
						
					} ?>
					</select></td>
			</tr>
			
			<tr>
				<td colspan="2"><center><input type="submit" name="submit" value="Edit Location" />&nbsp;</center></td>
			</tr>
		</table>
		
	</form>
	<button onclick="location.href='<?php echo base_url();?>c_admin/location'">Return to Locations</button>
	</div>
	</div>
</div>
<?php } ?>

<?php if($type=='alerttype'){ ?>
	<h1>Edit Alert Type</h1>
	<form method="post" action="<?php echo base_url(); ?>c_admin/updatealerttype/<?php echo $alertcat['alertTypeID']; ?>">
		<table width="100%">
			<tr>
				<td>Type Name</td>
				<td><input type="text" value="<?php echo $alertcat['alertTypeName']; ?>" name="alerttype" /></td>
			</tr>
				<td>Category</td>
				<td><select name="alertcategory">
					
					<?php 
					echo "<option selected='selected' value=".$mycountry['alertCategoryID'].">".$mycountry['categoryName']."</option>";	
					foreach ($country as $key => $value) {	
						echo "<option value=".$value['alertCategoryID'].">".$value['categoryName']."</option>";
						
					} ?>
					</select></td>
			</tr>
			
			<tr>
				<td colspan="2"><center><input type="submit" name="submit" value="Edit Location" />&nbsp;</center></td>
			</tr>
		</table>
		
	</form>
	<button onclick="location.href='<?php echo base_url();?>c_admin/location'">Return to Locations</button>
	</div>
	</div>
</div>
<?php } ?>