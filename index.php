<?php
include('library/config.php');
include('library/LIB_http.php');
include('library/LIB_parse.php');
include('library/LIB_rss.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
<meta name="author" content="Khairu Aqsara" />
<meta name="description" content="Indonesia Dalam Berita" />
<title>Indonesia Dalam Berita</title>
<link rel="stylesheet" href="assets/css/master.css" />
<link href='http://fonts.googleapis.com/css?family=Sancreek' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Germania+One' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Gudea' rel='stylesheet' type='text/css'>
<noscript>
<link rel="stylesheet" href="assets/css/mobile.min.css" />
</noscript>
<script>
var ADAPT_CONFIG = {
  path: 'assets/css/',
  dynamic: true,
  range: [
    '0px    to 760px  = mobile.min.css',
    '760px  to 980px  = 720.min.css',
    '980px  to 1280px = 960.min.css',
    '1280px to 1600px = 1200.min.css',
    '1600px to 1940px = 1560.min.css',
    '1940px to 2540px = 1920.min.css',
    '2540px           = 2520.min.css'
  ]
};
</script>
<script src="assets/js/adapt.min.js"></script>
</head>
<body>
	<div class="container_12">
	  <div class="grid_12">
		<h1 id="head">
		  Indonesia Dalam Berita
		</h1>
	  </div>
	  <div class="grid_12">
		<ul id="menu">
			<li><a href="index.php">Beranda</a></li>
			<li><a href="index.php?berita=nasional">Nasional</a></li>
			<li><a href="index.php?berita=politik">Politik</a></li>
			<li><a href="index.php?berita=kriminal">Kriminal</a></li>
			<li><a href="index.php?berita=hukum">Hukum</a></li>
			<li><a href="index.php?berita=bisnis">Bisnis</a></li>
			<li><a href="index.php?berita=ekonomi">Ekonomi</a></li>
			<li><a href="index.php?berita=teknologi">Teknologi</a></li>
			<li><a href="index.php?berita=internet">Internet</a></li>
			<li><a href="index.php?berita=dunia">Dunia</a></li>
			<li><a href="index.php?berita=hiburan">Hiburan</a></li>
			<li><a href="index.php?berita=olahraga">Olahraga</a></li>
			<li><a href="index.php?berita=sains">Sains</a></li>
			<li><a href="index.php?berita=security">Security</a></li>
			<li><a href="index.php?berita=security2">Offensive</a></li>
		</ul>
	  </div>
	  <div class="clear">&nbsp;</div>
	  <?php 
	  $news = preg_replace('/[\W]/','',$_GET['berita']);
	  switch($news){
		default:
		case'nasional':
		$rss = download_parse_rss(NASIONAL);
		break;
		case'politik':
			$rss = download_parse_rss(POLITIK);
		break;
		case'kriminal':
			$rss = download_parse_rss(KRIMINAL);
		break;
		case'hukum':
			$rss = download_parse_rss(HUKUM);
		break;
		case'bisnis':
			$rss = download_parse_rss(BISNIS);
		break;
		case'ekonomi':
			$rss = download_parse_rss(EKONOMI);
		break;
		case'teknologi':
			$rss = download_parse_rss(TEKNOLOGI);
		break;
		case'internet':
			$rss = download_parse_rss(INTERNET);
		break;
		case'dunia':
			$rss = download_parse_rss(DUNIA);
		break;
		case'hiburan':
			$rss = download_parse_rss(HIBURAN);
		break;
		case'olahraga':
			$rss = download_parse_rss(OLAHRAGA);
		break;
		case'sains':
			$rss = download_parse_rss(SAIN);
		break;
		case'security':
			$rss = download_parse_rss(SECURITY);
		break;
		case'security2':
			$rss = download_parse_rss(SF);
		break;
	  }
	  ?>
	  <?php display_rss_array($rss);?>
	  <div class="clear">&nbsp;</div>
	  <hr class="grid_12" />
	  <div class="clear">&nbsp;</div>
	  <div class="grid_3">
		<p>
		  <small>
			Licensed under <a href="http://www.gnu.org/licenses/gpl.html">GPL</a> and <a href="http://www.opensource.org/licenses/mit-license.php">MIT</a>.
		  </small>
		</p>
	  </div>
	  <div class="grid_6 align_center">
		<p>
		  <small>
			Powered by <a href="http://khairu.net">wenkhairu [at] khairu.net</a>
		  </small>
		</p>
	  </div>
	  <div class="grid_3 align_right">
		<p>
		  <small>
			Custom grids via <a href="http://grids.heroku.com/">SprySoft</a>.
		  </small>
		</p>
	  </div>
	</div>
</body>
</html>