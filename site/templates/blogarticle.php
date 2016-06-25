<?php
snippet('header');
$post_date = $page->date('j M y');
$post_tags = post_tags($page,'inline');
?>
<article class="item item-post">
	<ul class="about">
		<li class="date">Saved <?php echo $post_date ?></li>
		<li class="tags"><?php echo $post_tags ?></li>
	</ul>
	<?php echo markdown($page->text()) ?>
</article>
<?php snippet('footer') ?>
