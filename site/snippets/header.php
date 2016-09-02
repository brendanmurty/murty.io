<?php

$css_update_date = "20160902b";

snippet('libs_general');
snippet('libs_tags');
snippet('libs_page');
snippet('libs_list');
snippet('libs_twitter');

$page_title = page_title(html($page->title()).' - '.html($site->title()), $page, $site);
$page_description = page_description($page);
$page_image = page_first_image('http://b.murty.io/assets/images/common/brendan-isla-rain.jpg', $page);
$page_type = page_type($page);
$page_name = page_name($page);

$body_extra = '';
if($page->title() == 'Find' && !isset($_GET['term'])){
    // Focus the search field on the search page
    $body_extra.=' onload="document.forms.searchform.term.focus();"';
}
$body_extra .= ' class="type_' . $page_type . ' name_' . $page_name . '"';

// Redirect "/post" to "/posts" when a certain post isn't requested
if ($page_name == "post" && $page->title() == "Post") {
    go("posts");
}

// Setup about text for the header and customise page titles
$header_about_content = '<h2>'.html($page->title()).'</h2>';
if ($page_type == 'home' || $page_name == 'resume') {
    $header_about_content = '';
} elseif ($page->uri() == 'tag' && get('name')) {
    $header_about_content='<h2 class="lighter">Tagged <em>' . tag_title(get('name')) . '</em></h2>';
} elseif ($page_name == 'about' || $page_name == 'contact') {
    $header_about_content = '<h2>' . ucfirst($page_name) . ' Brendan</h2>';
} elseif ($page_name == 'link') {
    $header_about_content = '<h2 class="lighter">Link: <em>' . html($page->title()) . '</em></h2>';
} elseif ($page_type == 'post' && $page_name != 'posts') {
    $header_about_content='<h2 class="lighter">Post: <em>' . html($page->title()) . '</em></h2>';
} elseif (isset ($_GET['term']) && $_GET['term'] != '') {
    $header_about_content = '<h2 class="lighter">Search for <em>' . $_GET['term'] . '</em></h2>';
}

// Only index page content for visible and main pages
$page_meta_robots = "noindex,follow";
if($page->isVisible() || $page_name == "home"){
    $page_meta_robots = "index,follow";
}
?><!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $page_title ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="author" content="<?php echo $site->author() ?>">
<meta name="description" property="og:description" content="<?php echo $page_description ?>">
<meta name="robots" content="<?php echo $page_meta_robots ?>">
<meta name="handheldfriendly" content="true">
<meta name="mobileoptimized" content="480">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="theme-color" content="#2B9CB2">
<meta name="google-site-verification" content="PDu5txmerBIQFL25egiXIxNeijFAFkVAH88blb0nGcU">
<meta name="p:domain_verify" content="bc7a37f5bb3bd7ed682192fab9cecd32">
<meta property="og:locale" content="en_gb">
<meta property="og:type" content="article">
<meta property="og:title" content="<?php echo $page_title ?>">
<meta property="og:url" content="<?php echo html($page->url()) ?>">
<meta property="og:image" content="<?php echo $page_image ?>">
<link href="http://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/assets/styles/brendanmurty.min.css?v=<?php echo $css_update_date ?>">
<link rel="shortcut icon" href="/assets/images/common/favicon.png">
<link rel="apple-touch-icon-precomposed" href="/assets/images/common/apple-touch-icon-precomposed.png">
<link rel="alternate" type="application/rss+xml" href="<?php echo url('/feed.xml') ?>" title="Brendan Murty">
<script src="https://use.fontawesome.com/c4caff9ff7.js"></script>
<!--[if lt IE 9]>
<script>
document.createElement('header');
document.createElement('nav');
document.createElement('section');
document.createElement('article');
document.createElement('aside');
document.createElement('footer');
document.createElement('hgroup');
</script>
<![endif]-->
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-710527-4']);
_gaq.push(['_trackPageview']);
(function(){
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
</head>
<body<?php echo $body_extra ?>>
    <section id="container">
        <nav class="pages">
            <?php echo list_pages($pages, $site, $page) ?>
        </nav>

        <?php if ($page_type == 'home' || $page_name == 'resume') { ?>
        <header>
            <a class="profile" href="/about" title="Learn more about me">
                <img src="/assets/images/common/brendan-isla-rain.jpg" height="200" width="200" alt="Profile picture of Brendan" />
            </a>

            <?php if ($page_type == 'home') { ?>
            <h2>
                Father of <a href="http://i.murty.io/">Isla</a>, partner of <a href="http://ellacondon.com/">Ella</a>, Web Developer at <a href="http://sentral.com.au/">Sentral</a>, creator of <a href="http://upcomingtasks.com/">UpcomingTasks</a> and <a href="http://schnitmydadsays.com/">SchnitMyDadSays</a> reviewer.
            </h2>
            <?php } ?>

            <?php if ($page_name != 'resume') { ?>
            <ul class="social">
                <li>
                    <a href="mailto:b@murty.io" title="Send me an email (b@murty.io)" aria-label="Send me an email (b@murty.io)"><span class="fa fa-envelope"></span></a>
                </li>
                <li>
                    <a href="https://github.com/brendanmurty" title="View my code on GitHub" aria-label="View my code on GitHub"><span class="fa fa-github"></span></a>
                </li>
                <li>
                    <a href="https://twitter.com/brendanmurty" title="View my Twitter profile" aria-label="View my Twitter profile"><span class="fa fa-twitter"></span></a>
                </li>
                <li>
                    <a href="https://au.linkedin.com/in/brendanmurty" title="Connect with me on LinkedIn" aria-label="Connect with me on LinkedIn"><span class="fa fa-linkedin-square"></span></a>
                </li>
                <li>
                    <a href="https://instagram.com/brendan.murty" title="View my Instagram posts" aria-label="View my Instagram posts"><span class="fa fa-instagram"></span></a>
                </li>
                <li>
                    <a href="http://steamcommunity.com/id/brendanmurty" title="Join me in a game on Steam" aria-label="Join me in a game on Steam"><span class="fa fa-steam-square"></span></a>
                </li>
            </ul>
            <?php } ?>
        </header>
        <?php } ?>

        <?php if($header_about_content != '') { echo '<section id="about">' . $header_about_content . '</section>'; } ?>

        <section id="content">
