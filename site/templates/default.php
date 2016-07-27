<?php snippet('header') ?>
<article>
<?php

echo markdown($page->text());

if ($page->uri() == 'tag' && get('name')) {
    // List all posts tagged with the specified tag name
    echo list_posts($pages, get('name'));
}

?>
</article>
<?php snippet('footer') ?>
