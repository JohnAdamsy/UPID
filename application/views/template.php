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
					<li id="poverty">
						<a >POVERTY</a>
					</li>
					<li id="crime">
						<a>CRIME</a>
					</li>
					<li id="incidents">
						<a>INCIDENTS</a>
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