<?php

include("../rssgm/config.php");

$keyword_dash = $_GET['keyword'];

$keyword_lowercase = str_replace("-", " ", $keyword_dash); 

$keyword = ucwords($keyword_lowercase);

$keyword_feed = str_replace("-", "+", $keyword_dash); 

?>

<?php

$reqfilename = $keyword_dash;

   $cachefile = "../cache/".$reqfilename.".html";
   $cachetime = 1080 * 60; // 1 week
   // Serve from the cache if it is younger than $cachetime
   if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
     include($cachefile);
     echo "<!-- Cached ".date('jS F Y H:i', filemtime($cachefile))." -->\n";
     exit;
   }
   ob_start(); // start the output buffer
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="alternate" type="application/rss+xml" title="RSS 1.0" href="sitemap.xml" />
<title><?php echo $keyword; ?> at <?php echo $mysitename; ?></title>
<meta name="keywords" content="<?php echo $keyword; ?>">
<meta name="description" content="Good information about <?php echo $keyword; ?> at <?php echo $mysitename; ?>">
<meta name="ROBOTS" content="ALL">
<style type="text/css" media="all">@import "rssgm/style.css";</style>
</head>

<body>
<div id="main">
	<div id="left_column">
		<div id="title">
			<p><?php echo $mysitename; ?></p>
			<p></p>
		</div>
		<a href="<?php echo $site;?>">Home</a><br>
		<a href="<?php echo $site;?>/sitemap.php">Sitemap</a><br>
<?php include("../rssgm/random.php"); ?>

	</div>
	
	<div id="right_column">
		<div class="right_title">
			<h3>Special Offers</h3>
			<p align=center>
<?php echo chitikaAds("160x600"); ?>
			</p>
		</div>
		<div class="info">
			<p>Copyright &copy; <?php echo date("Y"); ?></p>
			<p><?php echo $mysitename; ?></p>
			<p>All Rights Reserved</p>
		</div>
	</div>
		
	<div id="middle_column">
		
		<div class="content_out">
			<div class="content_in">
<?php echo googleAds("300x250_as"); ?>

<p><?php include("../rssgm/articles.php"); ?></p>

		 	</p>
		 </div>
	 </div>	

<!-- google_ad_section_start -->
		<div class="content_out">
			<div class="content_in">
		 		<h3><?php echo $keyword; ?> News</h3><br>
		 		<p>
<?php include("../rssgm/rss.php"); ?>
		 		</p>
		 	</div>
		</div>
		
		<div class="content_out">
			<div class="content_in">
		 		<h3><?php echo $keyword; ?> Links</h3>
		 		<p>
<?php include("../rssgm/serp.php"); ?>
		 		</p>
<!-- google_ad_section_end -->
		 	</div>
		</div>
	</div>
</div>
</body>
</html>


<?php
   $fp = fopen($cachefile, 'w'); // open the cache file for writing
   fwrite($fp, ob_get_contents()); // save the contents of output buffer to the file
   fclose($fp); // close the file
   ob_end_flush(); // Send the output to the browser
   //call the rss_gen.php
   include ('rss_gen.php');
?>
