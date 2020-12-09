		<!-- Notifications Box/Pop-Up Start --> 
		<div id="notificationsbox">
			<h4>Alertas</h4>
			<ul>
<?php
	foreach($alerts as $alert): 
?>
	 			<li>
					<a href="#" title=""><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>icons/icon_square_close.png" alt="Close" class="closenot"></a>
					<h5><?=$alert["name"]?></h5>
					<p><?=$alert["description"]?></p>
				</li>
<?php
	endforeach; 
?>
<!--			<li>
					<a href="#" title=""><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>icons/icon_square_close.png" alt="Close" class="closenot"></a>
					<h5><a href="#" title="">New member registration</a></h5>
					<p>Jackson Michael joined on 16.12.2010</p>
				</li>
				<li>
					<a href="#" title=""><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>icons/icon_square_close.png" alt="Close" class="closenot"></a>
					<h5><a href="#" title="">New blog post created</a></h5>
					<p>New post created on 15.12.2010</p>
				</li>
				<li>
					<a href="#" title=""><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>icons/icon_square_close.png" alt="Close" class="closenot"></a>
					<h5><a href="#" title="">New group created</a></h5>
					<p>“Web Design” group created on 12.12.2010</p>
				</li>
				<li>
					<a href="#" title=""><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>icons/icon_square_close.png" alt="Close" class="closenot"></a>
					<h5><a href="#" title="">1 new private message</a></h5>
					<p>New message from Joe sent on 21.11.2010</p>
				</li>
				<li>
					<a href="#" title=""><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>icons/icon_square_close.png" alt="Close" class="closenot"></a>
					<h5><a href="#" title="">New member registration</a></h5>
					<p>Graham joined on 20.11.2010</p>
				</li> 
			</ul> -->
			<p class="loadmore"><a href="#" title="">No hay m&aacute;s alertas</a></p>	 
		</div>
		<!-- Notifications Box/Pop-Up End -->
<?php 
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'timeout.php');
?>