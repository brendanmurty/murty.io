<?php snippet('header') ?>
<article>
<?php
echo markdown($page->text());
if ($page->uri() == 'tag' && get('name')) {
    // Tag detail page
    echo list_items($pages, 'all', get('name'));
}
?>
</article>
<?php snippet('footer') ?>
