<?php

snippet('header');

print '<article>' . list_pages($pages, 'latest') . '</article>';

snippet('footer');

?>
