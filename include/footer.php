		<footer>
			<p>&copy; Copyright It's a Pi <?=date('Y', time())?><a href="http://www.iubenda.com/privacy-policy/695504" class="iubenda-white iubenda-embed" title="Privacy Policy">Privacy Policy</a></p>
			<script type="text/javascript">
				var deleteMsg = document.getElementById("deleteMsg");
				deleteMsg.onClick(hideMsg(deleteMsg));
				function hideMsg(deleteMsg) {
					deleteMsg.style.display;
				}
				(function (w,d) {
					var loader = function () {
						var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0];
						s.src = "http://cdn.iubenda.com/iubenda.js";
						tag.parentNode.insertBefore(s,tag);
					};
					if(w.addEventListener){
						w.addEventListener("load", loader, false);
					}else if(w.attachEvent){
						w.attachEvent("onload", loader);
					}else{
						w.onload = loader;
					}
				})(window, document);
			</script>
		</footer>
