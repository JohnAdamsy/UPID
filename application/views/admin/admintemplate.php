<html>
	<head>
		<?php
		$this -> load -> view('sections/head');
		?>
	</head>
	<body>
		<header>
			<a href="<?php echo base_url(); ?>"><img src='<?php echo base_url()?>assets/images/uPID_logo.png' /></a>
			<div class="nav">
				<ul>
					<li>
						<a href="<?php echo base_url();?>c_admin/alertcat" >Alert Categories</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>c_admin/alerttype" > Alert Types</a>
					</li>
					<li >
						<a href="<?php echo base_url();?>c_admin/country">Countries</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>c_admin/location" > Alert Location</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>c_admin/resource" > Resources</a>
					</li>
				</ul>
			</div>
		</header>
		<div class="content">
			<?php

			$this -> load -> view($contentView);
		?>
		</div>
		
<div class="footer">
	<!-- Attach JavaScript files -->

  		
</div>
	</body>
</html>