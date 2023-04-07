

<div class="text-white">

<div class="bg-info row">
	<div class="">
		<div class="">
			<div class="d-flex justify-content-between ">
				<div class="">
					<h4>Liên hệ chúng tôi</h4>
					<ul>
						<li><span>ĐT: 0123456789</span></li>
						<li><span>Email: hpham7399@gmail.com</span></li>
						<li><span>Đc: ĐH Cần Thơ, 3/2 Ninh Kiều, Cần Thơ</span></li>
					</ul>
				</div>
				<div class="social-icons">
					<h4>Theo dõi chúng tôi</h4>
					<ul>
						<li class="facebook"><a href="#" target="_blank"> </a></li>
						<li class="twitter"><a href="#" target="_blank"> </a></li>
						<li class="googleplus"><a href="#" target="_blank"> </a></li>
						<li class="contact"><a href="#" target="_blank"> </a></li>
						<div class="clear"></div>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
			/*
				var defaults = {
					containerID: 'toTop', // fading element id
					containerHoverID: 'toTopHover', // fading element hover id
					scrollSpeed: 1200,
					easingType: 'linear' 
				};
				*/

		$().UItoTop({
			easingType: 'easeOutQuart'
		});

	});
</script>

<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
<a href="#" id="toTop1" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
<link href="css/flexslider.css" rel='stylesheet' type='text/css' />
<script defer src="js/jquery.flexslider.js"></script>
<script type="text/javascript">
	$(function() {
		SyntaxHighlighter.all();
	});
	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "slide",
			start: function(slider) {
				$('body').removeClass('loading');
			}
		});
	});
</script>
</body>


</div>