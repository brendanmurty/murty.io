<?php

snippet('header');

print '<article>' . list_posts($pages, 'latest') . '</article>';

snippet('footer');

?>
