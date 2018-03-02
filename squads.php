<?
if(strpos($_SERVER['SERVER_NAME'], "docker")===false) {
	require_once("../vars.php");
	$db = new mymysqli("swgoh");
	error_reporting(0);
} else {
	require_once("../../vars.php");
	$db = new mymysqli("toodledo");
	error_reporting(E_ALL);
}

function translateName($short) {
	if($short=="rancor") return "The Pit (Rancor)";
	else if($short=="rancorh") return "The Pit (Rancor) HEROIC";
	else if($short=="aat") return "Tank Takedown (AAT)";
	else if($short=="aath") return "Tank Takedown (HAAT) HEROIC";
}

if(!empty($_GET['delete_by_jake'])) {
	$db->query("DELETE FROM swgoh_screenshot WHERE id='".$db->str($_GET['delete_by_jake'])."'");
}
?>
<html>
<head>
	<title>SWGOH Tools - Squad High Scores</title>
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="upload.css" media="screen" />
	<style>
	.swgoh_ad {
		position: absolute;
		left:0;
		top:90px;
		width:0;
		height:0px;
	}
	#ad {
		width:100%;
		height:60px;
	}
	#popImage {
		display: none;
		position: absolute;
		z-index: 1000;
		max-width: 90%;
		max-height: 90%;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		border: 3px solid black;
		border-radius: 10px;
		min-width: 200px;
		min-height: 200px;
	}
	#screen {
		display: none;
		position: absolute;
		z-index: 999;
		top:0;
		left:0;
		right:0;
		bottom:0;
		background-color: #fff;
		opacity: 0.8;
	}

	@media(min-width: 520px) { #top { padding-bottom:0px} #ad { height:90px;} .swgoh_ad { left:inherit; top:0; right:0; width: 328px; height: 90px; } }
	@media(min-width: 720px) { #top { padding-bottom:0px} #ad { height:90px;} .swgoh_ad { left:inherit; top:0; right:0; width: 528px; height: 90px; } }
	@media(min-width: 920px) { #top { padding-bottom:0px} #ad { height:90px;} .swgoh_ad { left:inherit; top:0; right:0; width: 728px; height: 90px; } }
	@media(min-width: 1200px) { #top { padding-bottom:0px} #ad { height:90px;} .swgoh_ad { left:inherit; top:0; right:0; width: 1000px; height: 90px; } }

	</style>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
   <script type="text/javascript">
   	$(function(){
  			$('.viewImage').on("click",function(e) {
  				var path = $(e.target).data("src");
  				$("#popImage").attr('src',path).show();
  				$("#screen").show();
  			});
  			$('#screen').on("click",function(e) {
  				$("#popImage").hide();
  				$("#screen").hide();
  			});
  			$('#popImage').on("click",function(e) {
  				$("#popImage").hide();
  				$("#screen").hide();
  			});
  		});
	</script>
</head>
<body>
	<div id="top">
		<a href="http://www.swgoh.life/index.html" id="logoClick"></a>
		<div id="ad">
		<!-- Swgoh.life -->
		<ins class="adsbygoogle swgoh_ad"
				 style="display:block"
				 data-ad-client="ca-pub-0176506581219642"
				 data-ad-slot="9855290481"
				 data-ad-format="horizontal"></ins>
		<script>
		//https://support.google.com/adsense/answer/6307124
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
		</div>
	</div>
<div id="middleSolo">
	<h1><a href="http://www.swgoh.life/index.html">More Tools</a> &gt; Squad High Scores</h1>

	<p>Please share your SWGOH raid high score screenshots here. You can have the bragging rights to the top score, and everyone else can learn how to do better!</p>
	<br />
	<a href="squad_submit.php" class="btn">Submit Your Score</a>
	<br /><br /><br />
	
	<?
		if(empty($_GET['raid'])) {
			?>
			<div class="square short">
				<a href="squads.php?raid=rancor"><img src="http://www.swgoh.life/images/rancor.png" width="205" height="150" /></a><br />
				<b><a href="squads.php?raid=rancor">The Pit / Rancor</a></b><br />
				<p>Find out which squads work well against the Rancor.</p>
			</div>

			<div class="square short">
				<a href="squads.php?raid=haat1"><img src="http://www.swgoh.life/images/aat1.png" width="205" height="150" /></a><br />
				<b><a href="squads.php?raid=haat1">Tank Takedown Phase 1</a></b><br />
				<p>Find out which squads work well against General Grievous in Phase 1.</p>
			</div>

			<div class="square short">
				<a href="squads.php?raid=haat2"><img src="http://www.swgoh.life/images/aat2.png" width="205" height="150" /></a><br />
				<b><a href="squads.php?raid=haat2">Tank Takedown Phase 2</a></b><br />
				<p>Find out which squads work well against the Tank in Phase 2.</p>
			</div>

			<div class="square short">
				<a href="squads.php?raid=haat3"><img src="http://www.swgoh.life/images/aat3.png" width="205" height="150" /></a><br />
				<b><a href="squads.php?raid=haat3">Tank Takedown Phase 3</a></b><br />
				<p>Find out which squads work well against the Droids in Phase 3.</p>
			</div>

			<div class="square short">
				<a href="squads.php?raid=haat4"><img src="http://www.swgoh.life/images/aat4.png" width="205" height="150" /></a><br />
				<b><a href="squads.php?raid=haat4">Tank Takedown Phase 4</a></b><br />
				<p>Find out which squads work well against the Tank in Phase 4.</p>
			</div>
			
			<br />
			
			<div class="square short">
				<a href="squads.php?raid=nasl1"><img src="http://www.swgoh.life/images/nasl1.png" width="205" height="150" /></a><br />
				<b><a href="squads.php?raid=nasl1">Sith Triumvirate (Tier 6) Phase 1</a></b><br />
				<p>Find out which squads work well against Darth Nihilus in Phase 1.</p>
			</div>
			
			<div class="square short">
				<a href="squads.php?raid=nasl2"><img src="http://www.swgoh.life/images/nasl.png" width="205" height="150" /></a><br />
				<b><a href="squads.php?raid=nasl2">Sith Triumvirate (Tier 6) Phase 2</a></b><br />
				<p>Find out which squads work well against Darth Sion in Phase 2.</p>
			</div>
			
			<div class="square short">
				<a href="squads.php?raid=nasl3"><img src="http://www.swgoh.life/images/nasl.png" width="205" height="150" /></a><br />
				<b><a href="squads.php?raid=nasl3">Sith Triumvirate (Tier 6) Phase 3</a></b><br />
				<p>Find out which squads work well against Darth Traya in Phase 3.</p>
			</div>
			
			<div class="square short">
				<a href="squads.php?raid=nasl4"><img src="http://www.swgoh.life/images/nasl.png" width="205" height="150" /></a><br />
				<b><a href="squads.php?raid=nasl4">Sith Triumvirate (Tier 6) Phase 4</a></b><br />
				<p>Find out which squads work well against the Triumvirate in Phase 4.</p>
			</div>

			<br />
			
			<div class="square short">
				<a href="squads.php?raid=hasl1"><img src="http://www.swgoh.life/images/http://www.swgoh.life/images/nasl1.png" width="205" height="150" /></a><br />
				<b><a href="squads.php?raid=hasl1">Sith Triumvirate (Heroic) Phase 1</a></b><br />
				<p>Find out which squads work well against Darth Nihilus in Phase 1.</p>
			</div>
			
			<div class="square short">
				<a href="squads.php?raid=hasl2"><img src="http://www.swgoh.life/images/nasl.png" width="205" height="150" /></a><br />
				<b><a href="squads.php?raid=hasl2">Sith Triumvirate (Heroic) Phase 2</a></b><br />
				<p>Find out which squads work well against Darth Sion in Phase 2.</p>
			</div>
			
			<div class="square short">
				<a href="squads.php?raid=hasl3"><img src="http://www.swgoh.life/images/nasl.png" width="205" height="150" /></a><br />
				<b><a href="squads.php?raid=hasl3">Sith Triumvirate (Heroic) Phase 3</a></b><br />
				<p>Find out which squads work well against Darth Traya in Phase 3.</p>
			</div>
			
			<div class="square short">
				<a href="squads.php?raid=hasl4"><img src="http://www.swgoh.life/images/nasl.png" width="205" height="150" /></a><br />
				<b><a href="squads.php?raid=hasl4">Sith Triumvirate (Heroic) Phase 4</a></b><br />
				<p>Find out which squads work well against the Triumvirate in Phase 4.</p>
			</div>
			
			<?
		} else {
			$sql = "";
			if($_GET['raid']=="rancor") $sql = "AND raid='rancorh'";
			else if($_GET['raid']=="haat1") $sql = "AND raid='aath' AND phase=1";
			else if($_GET['raid']=="haat2") $sql = "AND raid='aath' AND phase=2";
			else if($_GET['raid']=="haat3") $sql = "AND raid='aath' AND phase=3";
			else if($_GET['raid']=="haat4") $sql = "AND raid='aath' AND phase=4";
			else if($_GET['raid']=="nasl1") $sql = "AND raid='nasl' AND phase=1";
			else if($_GET['raid']=="nasl2") $sql = "AND raid='nasl' AND phase=2";
			else if($_GET['raid']=="nasl3") $sql = "AND raid='nasl' AND phase=3";
			else if($_GET['raid']=="nasl4") $sql = "AND raid='nasl' AND phase=4";
			else if($_GET['raid']=="hasl1") $sql = "AND raid='hasl' AND phase=1";
			else if($_GET['raid']=="hasl2") $sql = "AND raid='hasl' AND phase=2";
			else if($_GET['raid']=="hasl3") $sql = "AND raid='hasl' AND phase=3";
			else if($_GET['raid']=="hasl4") $sql = "AND raid='hasl' AND phase=4";

			$raid = "";
			$phase = 0;
			echo "<table>";
			$rs = $db->query("SELECT * FROM swgoh_screenshot WHERE verified=0 ".$sql." order by raid desc, score desc limit 30");
			while($row = $db->getNext($rs,1)) {
				if($raid !== $row['raid']) {
					$phase = $row['phase'];
					$raid = $row['raid'];
					echo "</table>";
					echo "<h2><a href='squads.php'>Raids</a> &gt; ".translateName($raid);
					if($raid=="aath") echo " Phase ".$phase;
					echo " High Scores</h2><br />";
					echo "<table><tr><th>Score</th><th>Player</th><th>Squad</th><th>View</th></tr>";
				} else if($phase !== $row['phase'] && $raid=="aath") {
					$phase = $row['phase'];
					echo "</table>";
					echo "<h2><a href='squads.php'>Raids</a> &gt; ".translateName($raid);
					if($raid=="aath") echo " Phase ".$phase;
					echo " High Scores</h2><br />";
					echo "<table><tr><th>Score</th><th>Player</th><th>Squad</th><th>View</th></tr>";
				}
				echo "<tr><td>".number_format($row['score'])."</td>";
				if(empty($row['gg'])) echo "<td>".$row['name']."</td>";
				else echo "<td><a href='https://swgoh.gg/u/".$row['gg']."/' target='_blank'>".$row['name']."</a></td>";
		
				echo "<td>";
					if($row['zeta1']) echo "z";
					echo $row['toon1'];
					if(!empty($row['toon2'])) echo "(L), ";

					if($row['zeta2']) echo "z";
					echo $row['toon2'];
					if(!empty($row['toon3'])) echo ", ";
					
					if($row['zeta3']) echo "z";
					echo $row['toon3'];
					if(!empty($row['toon4'])) echo ", ";
					
					if($row['zeta4']) echo "z";
					echo $row['toon4'];
					if(!empty($row['toon5'])) echo ", ";
					
					if($row['zeta5']) echo "z";
					echo $row['toon5'];
				
				echo "</td>";
				if(!empty($_GET['showID'])) echo "<td>".$row['id']."</td>";
				
				echo "<td><a href='#' class='viewImage' data-src='https://lambdaexperiment.s3.amazonaws.com/".$row['id']."'>View Image</a></td></tr>";
			}
			echo "</table>";
		}
	?>

	<img src="" id="popImage" />
	<div id="screen"></div>

	<br /><br /><br /><br /><br /><ins class="adsbygoogle"
		 style="display:block; text-align:center;"
		 data-ad-format="fluid"
		 data-ad-layout="in-article"
		 data-ad-client="ca-pub-0176506581219642"
		 data-ad-slot="6732943283"></ins>
<script>
		 (adsbygoogle = window.adsbygoogle || []).push({});
</script>
	
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-92624-14', 'auto');
	ga('send', 'pageview');
</script>

</div>
<div id="foot">
	<p>SWGOH.LIFE is not affiliated with EA, EA Capital Games, Disney or Lucasfilm LTD.</p>
</div>
</body>
</html>