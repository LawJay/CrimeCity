<div class="layer">
	<div class="header">
		<div class="logo">
			<a href="index.php?page=index"><img src="frontend/images/<?php echo $logo; ?>" height="100px" width="100px"/></a>
		</div>
		<div class="title">
			<h1><?php echo $title.$seperator.$description; ?></h1>
		</div>
<br>

		<?php
			require_once("frontend/templates/account-actions.php");
		?>
	</div>
</div>