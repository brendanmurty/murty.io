<?php

function list_posts($pages_object, $mode = 'all'){
	$i = 0;
	$l = '';
	$t = '';
	$items = array();

	$f = $pages_object->find('post/');

	if ($mode == 'all') {
		// Extract all visible posts
		$f = $f->children()->visible()->sortBy($sort='date',$dir='desc');
	} elseif ($mode == 'latest') {
		// Extract the single most recent visible post
		$f = $f->children()->visible()->sortBy($sort='date',$dir='desc')->slice('0','1');
	} elseif ($mode == 'featured') {
		// Extract the last 20 visible posts
		$f = $f->children()->visible()->sortBy($sort='date',$dir='desc')->slice('0','20');
	} else {
		// Extract all posts with the specified tag name
		$f = $f->children()->visible()->filterBy('tags',$mode,',')->sortBy($sort='date',$dir='desc');
		$mode = 'taglist';
	}

	// Extract details of the relevant content items
	foreach ($f as $item) {
		$item_type=explode('/',$item->uri());
		$item_type=$item_type['0'];
		$item_date=date_human($item->date('j M y'));
		$item_date_specific=$item->date('D M d H:i:s Y');
		$link=str_replace('http://b.murty.io', '', $item->url());
		$link_description='Read the full length post';
		$icon='file-text';
		if($item_type=='link'){
			$link_description='View this link\'s details';
			$icon='link';
		}
		$l='<li class="'.$item_type.'"><a href="'.$link.'" title="'.$link_description.'">';
		$l.='<span class="summary">'.html($item->title());
		if($item_type=='link'){
			$l.=': '.excerpt(html($item->text()), 120);
		}else{
			$l.=': '.excerpt($item->text(), 120);
		}
		$l.='</span><span class="label"><span class="fa fa-'.$icon.'"></span>Posted '.$item_date.'</span></a></li>';

		// Add this item to the items array
		$items[$i]['date'] = $item_date_specific;
		$items[$i]['content'] = $l;
		$i++;
	}

	// Order the items by date
	foreach ($items as $key => $part) {
		$items_sorted[$key] = strtotime($part['date']);
	}
	array_multisort($items_sorted, SORT_DESC, $items);

	// Construct the final list output
	$t = '<ul class="item-listing item-listing-' . $mode . '">';

	for ($j = 0; $j < count($items); $j++){
		$t .= $items[$j]['content'];
	}

	$t .= '</ul>';

	return $t;
}

function list_pages($pages_object, $site_object, $page_object) {
	$current = '/' . $page_object->uri();
	$pages = $pages_object->visible();
	$list = '<h1><a href="/" title="Go to the home page" aria-label="Go to the home page">' . $site_object->title() . '</a></h1>';
	$list .= '<ul>';
	foreach($pages as $page) {
		$link = '/' . $page->uri();
		$title = $page->title();

		if ($link == '/post') {
			$link = '/posts';
			$title = 'Posts';
		} elseif ($link == '/link') {
			$link = '/links';
			$title = 'Links';
		} elseif ($link == '/tag') {
			$link = '/tags';
			$title = 'Tags';
		}

		$list .= '<li';

		if ($link == $current || ($link == '/posts' && page_type($page_object) == 'post')) {
			$list .= ' class="current"';
		}

		$link_description = 'Go to the ' . $title . ' page';
		$list .= '><a href="' . $link . '" title="' . $link_description . '" aria-label="' . $link_description . '">' . $title . '</a></li>';
	}
	$list .= '</ul>';
	return $list;
}
?>
