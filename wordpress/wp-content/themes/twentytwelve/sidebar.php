<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #secondary -->
		            <ul id="social" style="float:right; right: 20px; margin-top:280px; bottom: 0px; width: 200px">
            	<a href="https://plus.google.com/116394624873652483578" rel="publisher" target="_blank";><img src="../../../gfx/socialGooglePlus.png" /></a>
            	<a href="https://twitter.com/NKSoftbd" target="_blank"><img src="../../../gfx/socialTwitter.png" /></a>
                <a href="http://www.facebook.com/pages/NKSoft/1410359892514176" target="_blank"><img src="../../../gfx/socialFaceBook.png" /></a>
                <a href="http://www.linkedin.com/groups/NKSoft-NetKnowledge-Technologies-LLC-5177159?home&gid=5177159&trk=anet_ug_hm" target="_blank"><img src="../../../gfx/socialLinkedIn.png" /></a>
                
            </ul>

	<?php endif; ?>