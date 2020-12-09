<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
		
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'error.php');
?>
		<!-- Alternative Content Box Start -->
		 <div class="contentcontainer">
			<div class="headings altheading">
				<h2><?=LBL_HEADER?></h2>
			</div>
			<div class="contentbox">
				<form action="<?=SITE_URL?>catalog/savestatus/<?=$status["id"]?>" method="post">
					<p>
						<label for="name"><strong>Nombre:</strong></label>
						<input type="text" id="name" name="name" class="inputbox" value="<?=$status["name"]?>"> <br />
					</p>
					<p class="buttons">
						<input type="submit" value="<?=LBL_SAVE?>" class="btnalt">
						<input type="button" value="Regresar" class="btnalt" onclick="location.replace('<?=SITE_URL?>catalog/statuss');">
					</p>
				</form>
			</div>
			
		</div>
		<!-- Alternative Content Box End -->
<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>