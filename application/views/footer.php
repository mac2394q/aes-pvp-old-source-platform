	</body>
</html>
<script type="text/javascript">
	var d = new Date();
	var startTime = d.getTime();
	var nowTime = 0;
	var difTime = 0;
	var initialTime = <?=TIMEOUT?> * 60 * 1000;
	var thruTime = 0;
	var minutes = 0;
	var seconds = 0;
	var warnSent = false;
	
	window.setInterval(function() {
		var n = new Date();
		nowTime = n.getTime();

		difTime = nowTime - startTime;
		thruTime = initialTime - difTime;

		// Obtain minutes thru
		minutes = Math.floor(Math.floor(thruTime / 1000) / 60);
		seconds = Math.floor((thruTime - (minutes * 60 * 1000)) / 1000);

		if (thruTime <= (<?=TIMEWARN?> * 60 * 1000) && !warnSent) {
			$.titleAlert("Sesion a Punto de Expirar");
			$("#timeoutbox").bPopup();
		}
		
		if (thruTime > 0) {
			if(seconds >= 10) {
				$("#remainingTime").text(minutes + ":" + seconds);
			} else {
				$("#remainingTime").text(minutes + ":0" + seconds);
			}
		} else {
			location.replace('<?=SITE_URL?>auth/logout');
		} 
	}, 1000);

	$(document).ready(function(){
   		$("a.timeout").bind('click', function(){
   			$.ajax({
   				url: "<?=SITE_URL?>auth/extend",
   				success: function(){
   					$("#remainingTime").text("<?=TIMEOUT?>:00");
   					initialTime = <?=TIMEOUT?> * 60 * 1000;
   					$("#timeoutbox").close();
   				}
   			});
		});
	});
</script>