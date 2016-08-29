<?
	$id = "0600";
	if (isset($_GET['id']))
	{
		$id = $_GET['id'];
	}

	$game = "sa1";
	if (isset($_GET['game']))
	{
		$t = $_GET['game'];
		if (in_array($t, array("dl1", "dl2", "dl3", "sa1", "sa2")))
		{
			$game = $t;
		}
	}

	$files = glob($game . "/bin-*.png");
	asort($files);

	$options = array();
	foreach($files as $f)
	{
		if (preg_match("/bin\-(\w+)\.png$/", $f, $matches))
		{
			$options[] = $matches[1];
		}
	}

	$games = array
	(
		"sa1" => array("title" => "Space Ace"),
		"sa2" => array("title" => "Space Ace 2"),
		"dl1" => array("title" => "Dragon's Lair"),	
		"dl2" => array("title" => "Dragon's Lair 2"),	
		"dl3" => array("title" => "Dragon's Lair 3"),	
	);

	$other_games = array_slice($games, 0);
	unset($other_games[$game]);

	$baseurl = "http://www.megidish.net/readysoft";
	$title = $games[$game]['title'];
?>
<html>
<head>
	<title><?= $title ?> - Online Animation Player - Megidish.net</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>
<body style="margin: 0px auto; text-align: center; padding: 0px 0px; width: 780px; background: #e5e5e5; min-height: 800px;">
	<div style="background-color: #fff; padding-top: 10px; width: 780px; text-align: center;">
		<h1 style="font-family: helvetica,sans-serif; font-size: 72px; color: #333; font-weight: bold; margin: 0px;">
			<?= $title ?>
		</h1>
		<div style="font-size: 12px; font-family: Arial; margin-top: 20px;">
			Other games:
			<?
				$first = true;
				foreach($other_games as $key=>$value)
				{
					if (!$first)
					{
						print " &middot; ";
					}

					$first = false;
					print "<a href='" . $baseurl . "/" . $key . "'>" . htmlspecialchars($value['title']) . "</a>";
				}
			?>
		</div>
		<div align="center" style="margin-top: 20px;">
			<div style="font-family: Arial; font-size: 14px; width: 650px; text-align: left;">
				<p>
				Readysoft Animation Player was a super fun project I made back in 2006, aiming to port
				Dragon's Lair &amp; Space Ace to modern and mobile platforms. The greatest thing about
				these games (aside the gameplay and superb Bluth animation,) is that they are available
				for every console, alive or dead, with new versions 
				<a href="http://www.amazon.com/Dragons-Lair-Blu-ray-Playstation-3/dp/B000IMUYRE">still being released</a>.
				</p>

				<p>
				I intend to publish a technical article about Readysoft's FMV engine, and compare different
				console versions. It's part of <a href="http://www.megidish.net/museum/">Gawd's Museum of Dissected Games</a>,
				and a detailed autopsy and source code will be uploaded later.
				</p>

				<p>&raquo; Change scenes by picking a different sequence from the list below. All five
				<em>Space Ace</em> and <em>Dragon's Lair</em> games are supported.
				</p>
			</div>
		</div>

		<div style="margin-top: 20px;">&nbsp;</div>

		<div align="center">
			<div style="width: 320px; height: 200px; padding: 10px; border: 10px solid #ccc;">
				<div id="viewport" style="width: 320px; height: 200px; overflow: hidden;"><img src="<?= $baseurl ?>/<?= $game ?>/bin-<?= $id ?>.png" style="position: relative; top: 0px; left: 0px;" height="200" id="image"></div>
			</div>

			<div style="font-size: 12px; font-family: Arial; margin-top: 20px; width: 500px; text-align: justify;">
			<?
				print "Scenes: ";
				foreach($options as $o)
				{
					print "<a href='?id=" . $o . "'>$o</a> ";
				}
			?>
			</div>
		</div>

		<script type="text/javascript">
		var im = document.getElementById("image");
		im.onload = function()
		{
			var w = im.width;
			var x = 0;
			setInterval(function() {
				x += 320;
				if (x >= w)
				{
					x = 0;
				}

				im.style.left = -x + "px";
			}, 125);
		};
		</script>

		<div style="background-color: #EEEEEE; margin: 40px 0px 0px 0px; padding: 14px;">
			<strong>Readysoft Animation Player</strong> made by <a href="http://www.megidish.net/">Gil Megidish</a>. I can be contacted at 
			<a href="mailto:gil@megidish.net">gil@megidish.net</a>. Warped out!
		</div>
	</div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-541540-2";
urchinTracker();
</script>
</body>
</html>
