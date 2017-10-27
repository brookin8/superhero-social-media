<!DOCTYPE html>
<html>
<head>
	<title>Hero-book</title>

	<link href="https://fonts.googleapis.com/css?family=Bangers|Oswald" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="style.css">
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
						<div class="col">
							<img class="img-fluid img-thumbnail mb-2 indexPic" src="<?=$hero['image_url']?>">
						</div>
						<div class="col">
							<div class="row">
								<h2 class="mb-3 mt-4 name"><?=$hero['name']?></h2>
							</div>
							<div class="row">
								<p class="aboutMe"><?=$hero['about_me']?></p>
							</div>
						</div>
						<div class="col">
							<a href="/components/<?=$hero['id']?>.php"><button class="btn btn-primary profileButton mt-5">View Profile</button></a>
						</div>
					</div>
				</div>
			</li>

		<?php } ?>

	</ul>

</body>
</html>