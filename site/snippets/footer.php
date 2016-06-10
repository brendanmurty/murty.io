		</section>
		<?php
		// Configure the item actions elements
		$page_name = $page->uri();
		$nav_actions = '';

		if($page_name == 'post'){
			// Individual post page
			$nav_actions  = '<a class="twitter" href="http://twitter.com/share?url='.$page->url().'&amp;text='.urlencode($page->title()).'+by+%40brendanmurty">Share on Twitter</a>';
			$nav_actions .= '<a class="facebook" href="http://www.facebook.com/sharer.php?u='.$page->url().'&amp;t='.urlencode($page->title()).'+by+Brendan+Murty">Post to Facebook</a></li>';
		}elseif($page_name == 'about'){
			// About page
			$nav_actions  = '<a href="mailto:b@murty.io">Email me</a>';
			$nav_actions .= '<a href="/resume">View my resumé</a>';
		}

		if ($nav_actions != '') {
			echo '<nav class="actions">' . $nav_actions . '</nav>';
		}
        ?>
	</section>
</body>
</html>
