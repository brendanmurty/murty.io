<?php

function list_items($pages_object,$type='all',$mode='all'){
	$i=0;
	$l='';
	$t='';
	$items=array();

	if($type=='posts'){
		$f=$pages_object->find('post/');
	}elseif($type=='links'){
		$f=$pages_object->find('link/');
	}else{
		$f=$pages_object->find('link/','post/');
	}

	if($mode=='all'){
		$f=$f->children()->visible()->sortBy($sort='date',$dir='desc');
	}elseif($mode=='latest'){
		$f=$f->children()->visible()->sortBy($sort='date',$dir='desc')->slice('0','1');
	}elseif($mode=='featured'){
		$f=$f->children()->visible()->sortBy($sort='date',$dir='desc')->slice('0','20');
	}else{
		$f=$f->children()->visible()->filterBy('tags',$mode,',')->sortBy($sort='date',$dir='desc');
		$mode='taglist';
	}

	// Extract details of the relevant content items
	foreach($f as $item){
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

	// Add third-party activity to the items list
	if($type=='all' && $mode!='taglist'){
		load_thirdparty_classes();

		// Twitter
		$tweets = twitter_tweets_data('brendanmurty', '5', '');
		if($tweets){
			foreach($tweets as $tweet){
				$item_date = date_human(date('j M y', strtotime($tweet->{'created_at'})));
				$item_date_specific = date('D M d H:i:s Y', strtotime($tweet->{'created_at'}));
				$items[$i]['date'] = $item_date_specific;
				$items[$i]['content'] = '<li class="twitter"><a href="https://twitter.com/brendanmurty/status/'.$tweet->{'id_str'}.'" title="View this post on Twitter"><span class="summary">'.$tweet->{'text'}.'</span><span class="label"><span class="fa fa-twitter"></span>Posted '.$item_date.'</span></a></li>';
				$i++;
			}
		}

		// GitHub
		$github = new Github\Client();
		if ($github) {
			try{
				$events = $github->api('user')->publicEvents('brendanmurty');
			} catch (Exception $e) {
				$events = '';
			}

			if ($events) {
				foreach ($events as $event) {
					if ($event['type'] == 'PushEvent' && isset($event['payload']['commits'])) {
						// Commit
						$event_date = date_human(date('j M y', strtotime($event['created_at'])));
						$event_date_specific = date('D M d H:i:s Y', strtotime($event['created_at']));
						$event_message = $event['payload']['commits']['0']['message'];
						$event_url = $event['payload']['commits']['0']['url'];
						$event_url = str_replace('api.github.com/repos', 'github.com', $event_url);
						$event_url = str_replace('/commits', '/commit', $event_url);

						if ($event_url != '') {
							$item_content = '<li class="github github-commit"><a href="'.$event_url.'" title="View this commit on GitHub">';
							$item_content .= '<span class="summary">'.$event['repo']['name'];
							if($event_message){
								$item_content .= ': '.excerpt($event_message, 120);
							}
							$item_content .= '</span><span class="label"><span class="fa fa-github"></span>Authored '.$event_date.'</span></a></li>';

							$items[$i]['date'] = $event_date_specific;
							$items[$i]['content'] = $item_content;
							$item_content = '';
							$i++;
						}
					} elseif($event['type'] == 'WatchEvent') {
						// Star
						$event_date = date_human(date('j M y', strtotime($event['created_at'])));
						$event_date_specific = date('D M d H:i:s Y', strtotime($event['created_at']));
						$event_url = $event['repo']['url'];
						$event_url = str_replace('api.github.com/repos', 'github.com', $event_url);
						$event_repo = $event['repo']['name'];

						$item_content = '<li class="github github-star"><a href="'.$event_url.'" title="View this repository on GitHub">';
						$item_content .= '<span class="summary">'.$event['repo']['name'];
						$repo_parts = explode('/', $event['repo']['name']);
						try{
							$repo = $github->api('repo')->show($repo_parts[0], $repo_parts[1]);
						}catch(Exception $e){
							$repo = '';
						}
						if($repo){
							if(array_key_exists('description', $repo)){
								if($repo['description'] != '') $item_content .= ': '.excerpt($repo['description'], 120);
							}
						}
						$item_content .= '</span><span class="label"><span class="fa fa-github"></span>Starred '.$event_date.'</span></a></li>';

						$items[$i]['date'] = $event_date_specific;
						$items[$i]['content'] = $item_content;
						$i++;
					}
				}
			}
		}

		// Instagram
		$instagram = new \Instagram($GLOBALS['auth_instagram_client'], $GLOBALS['auth_instagram_secret'], '');
		if ($instagram) {
			// Show posts by "brendan.murty"
			$instagram_results = $instagram->getUserMedia('990505523', '10');
			if ($instagram_results) {
				$post_items = '';
				$i = 0;
				foreach ($instagram_results->data as $post) {
					if ($post) {
						$post_date = date_human(date('j M y', $post->created_time));
						$post_date_specific = date('D M d H:i:s Y', $post->created_time);
						$items[$i]['date'] = $post_date_specific;
						$items[$i]['content'] = '<li class="instagram instagram-post"><a href="'.$post->link.'" title="View this post on Instagram"><img src="'.$post->images->standard_resolution->url.'" /><span class="summary">';

						if ($post->caption && array_key_exists('text', $post->caption)) {
							$items[$i]['content'] .= excerpt($post->caption->text, 90);
						} else {
							$items[$i]['content'] .= 'Post by @' . $post->user->username;
						}

						$items[$i]['content'] .= '</span><span class="label"><span class="fa fa-instagram"></span>Posted '.$post_date.'</span></a></li>';
						$i++;
					}
				}
			}

			// Show posts liked by "brendan.murty"
			$instagram->setAccessToken($GLOBALS['auth_instagram_user']);
			$liked = $instagram->getUserLikes('10');
			if ($liked) {
				foreach ($liked->data as $like) {
					if ($like) {
						$like_date = date_human(date('j M y', $like->created_time));
						$like_date_specific = date('D M d H:i:s Y', $like->created_time);
						$items[$i]['date'] = $like_date_specific;
						$items[$i]['content'] = '<li class="instagram instagram-liked"><a href="'.$like->link.'" title="View this post on Instagram"><img src="'.$like->images->standard_resolution->url.'" /><span class="summary">';

						if($like->caption && array_key_exists('text', $like->caption)){
							$items[$i]['content'] .= excerpt($like->caption->text, 90);
						} else {
							$items[$i]['content'] .= 'Liked by @' . $post->user->username;
						}

						$items[$i]['content'] .= '</span><span class="label"><span class="fa fa-instagram"></span>Liked '.$like_date.'</span></a></li>';
						$i++;
					}
				}
			}
		}
	}

	// Order the items by date
	foreach ($items as $key => $part) {
		$items_sorted[$key] = strtotime($part['date']);
	}
	array_multisort($items_sorted, SORT_DESC, $items);

	// Construct the final list output
	$t='<ul class="item-listing item-listing-'.$type.'">';
	for ($j=0; $j < count($items); $j++){
		$t.=$items[$j]['content'];
	}
	$t.='</ul>';

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
