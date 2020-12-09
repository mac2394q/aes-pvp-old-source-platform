<?php
	if (isset($success)){
		if (!$success){		
?>
		<!-- Green Status Bar Start -->
		<div class="status error">
			<p class="closestatus"><a href="#" title="Close">x</a></p>
			<p>
				<img src="<?=SITE_URL?><?=IMG_LOCATION?>icons/icon_error.png" alt="Error">
				<span><?=LBL_ERROR?></span> <?=$saveMessage?>
			</p>
		</div>
		<!-- Green Status Bar End -->
<?php
		} else { 
?>
		 <!-- Red Status Bar Start -->
		<div class="status success">
			<p class="closestatus"><a href="#" title="Close">x</a></p>
			<p>
				<img src="<?=SITE_URL?><?=IMG_LOCATION?>icons/icon_success.png" alt="&Eacute;xito">
				<span><?=LBL_SUCCESS?></span> <?=$saveMessage?>
			</p>
		</div>
		<!-- Red Status Bar End -->
<?php
		}
	} 
?>