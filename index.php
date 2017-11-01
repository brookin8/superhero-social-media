<!DOCTYPE html>
<html>

<head>
	<?php include('./header.php'); ?>
	<title>Hero-book</title>
</head>

<body class="container">

	<h1 class="text-center mt-4 heading">Hero-Book</h1>

	<h2 class="text-center subheading mt-5 mb-5"><img class ="line" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/Pipe.svg/600px-Pipe.svg.png"> Super Members <img class ="line" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/Pipe.svg/600px-Pipe.svg.png"></h2>

	<?php 

		include('./database.php');

		function getHeroes() {	
			$sql = "SELECT * FROM heroes ORDER BY id;";
			$request = pg_query(getDb(), $sql);
			return pg_fetch_all($request);
		}
	?>

	<ul class="indexList">

		<?php foreach(getHeroes() as $hero) { ?>

			<li class="mb-5">
				<div class="profile">
					<div class="row">
						<div class="col-4 col-xs-4">
							<img class="img-fluid img-thumbnail mb-2 indexPic" src="<?=$hero['image_url']?>">
						</div>
						<div class="col-6 aboutCol col-xs-6">
							<div class="row">
								<h2 class="mb-3 mt-4 name"><?=$hero['name']?></h2>
							</div>
							<div class="row">
								<p class="aboutMe"><?=$hero['about_me']?></p>
							</div>
						</div>
						<div class="col-2 buttonCol col-xs-2">
							<a href="profile.php?id=<?=$hero['id']?>"><button class="btn btn-primary profileButton mt-5">View Profile</button></a>
						</div>
					</div>
				</div>
			</li>

		<?php } ?>

	</ul>

</body>
</html>