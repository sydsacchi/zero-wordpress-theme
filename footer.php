	<div class="clear"></div>
</div>
<footer id="footer" role="contentinfo">
	<div class="wrapper">
		<div id="footer-sidebar" class="secondary">
			<div id="footer-sidebar1">
				<?php
				if(is_active_sidebar('footer-sidebar-1')){
				dynamic_sidebar('footer-sidebar-1');
				}
				?>
			</div>
			<div id="footer-sidebar2">
				<?php
				if(is_active_sidebar('footer-sidebar-2')){
				dynamic_sidebar('footer-sidebar-2');
				}
				?>
			</div>
			<div id="footer-sidebar3">
				<?php
				if(is_active_sidebar('footer-sidebar-3')){
				dynamic_sidebar('footer-sidebar-3');
				}
				?>
			</div>
		</div>
	</div>
	<div id="copyright">
		<div class="wrapper">
			<?php if( get_theme_mod( 'footer_text_block') != "" ) { ?>
				<?php echo get_theme_mod( 'footer_text_block'); ?>
			<?php } else { ?>
				<p align="center"><small>Copyright &copy; 2017 · Zero Theme · By: <a href="https://www.sidneysacchi.com" target="_blank" title="Web Design &amp; Web Consulting">Sidney Sacchi</a></small></p>
			<?php } ?>
		</div>
	</div>
</footer>
</div>
<?php wp_footer(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/20bab3463a.js"></script>
<script>
jQuery(document).ready(function(){
    $("#toggle").click(function(){
        jQuery(".toggleContent").toggle(400);
		jQuery(".special").style('width:100%');
    });
});

jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() < 400) {
      $('.scrolled').css({"position":"absolute","top":"-100px"});
	  jQuery('.scrolled').hide();
    } else {
      $('.scrolled').css({"position":"fixed","top":"0","z-index":"99999"});
      jQuery('.scrolled').show();
    }
  });
</script>
</body>
</html>