<!DOCTYPE html>
<html>
<head>
	<title>The Seer</title>

	<link href="https://fonts.googleapis.com/css?family=Bangers|Oswald" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="./../style.css">
</head>
<body class="container">

<div class="row">
	<div class="mr-5">
		<h4 class="profileLogo mt-4">Hero-Book</h4>
	</div>
	<div class="text-right float-right mt-4">
		<a class="homeLink" href="./../index.php">Home</a>
	</div>
</div>

<h1 class="profileName mt-4 text-center">The Seer</h1>


<?php 

		include('./../database.php');

		function getHero() {	
			$sql = "
				SELECT heroes.*
				FROM heroes 
				WHERE heroes.id=5;
			";
			$request = pg_query(getDb(), $sql);
			return pg_fetch_all($request);
		}

		function getAbilities() {	
			$sql = "
				SELECT heroes.id, abilities.ability
				FROM heroes
				JOIN ability_hero ON ability_hero.hero_id = heroes.id
				JOIN abilities ON abilities.id = ability_hero.ability_id
				WHERE heroes.id=5;
			";
			$request = pg_query(getDb(), $sql);
			return pg_fetch_all($request);
		}

		function getAllies1() {
			$sql = "
				SELECT relationships.id, relationship_types.type, relationships.hero1_id, relationships.hero2_id, heroes.name 
				FROM relationships
				JOIN heroes ON heroes.id = relationships.hero2_id 
				JOIN relationship_types ON relationships.type_id = relationship_types.id
				WHERE relationships.type_id = 1 AND (relationships.hero1_id= 5);
			";
			$request = pg_query(getDb(), $sql);
			return pg_fetch_all($request);
		}

			function getAllies2() {
			$sql = "
				SELECT relationships.id, relationship_types.type, relationships.hero1_id, relationships.hero2_id, heroes.name 
				FROM relationships
				JOIN heroes ON heroes.id = relationships.hero1_id 
				JOIN relationship_types ON relationships.type_id = relationship_types.id
				WHERE relationships.type_id = 1 AND (relationships.hero2_id= 5);
			";

				$request = pg_query(getDb(), $sql);
				return pg_fetch_all($request);
		}

		function getEnemies1() {
			$sql = "
				SELECT relationships.id, relationship_types.type, relationships.hero1_id, relationships.hero2_id, heroes.name 
				FROM relationships
				JOIN heroes ON heroes.id = relationships.hero2_id 
				JOIN relationship_types ON relationships.type_id = relationship_types.id
				WHERE relationships.type_id = 2 AND (relationships.hero1_id= 5);"
				;
			
			$request = pg_query(getDb(), $sql);
			return pg_fetch_all($request);
		}

			function getEnemies2() {
			$sql = "
				SELECT relationships.id, relationship_types.type, relationships.hero1_id, relationships.hero2_id, heroes.name 
				FROM relationships
				JOIN heroes ON heroes.id = relationships.hero1_id 
				JOIN relationship_types ON relationships.type_id = relationship_types.id
				WHERE relationships.type_id = 2 AND (relationships.hero2_id= 5);
			";
			$request = pg_query(getDb(), $sql);
			return pg_fetch_all($request);
		}

?>

<?php foreach(getHero() as $hero) { ?>

	<div class="row mt-4">
		<div class="col">
			<img class="profilePic img-responsive img-thumbnail" src="<?=$hero['image_url']?>">
		</div>
		<div class="col infoCol">
			<div class="infoColBackground">
			<div class="row mt-4">
				<h3 class="profileText"><span class="miniHeader">About Me: </span><?=$hero['about_me']?></h3>
			</div>
			<div class="row mt-4">
				<h3 class="profileText"><span class="miniHeader">Abilties: </span>
					<?php foreach(getAbilities() as $ability) { ?>
						- <?=$ability['ability']?> -
					<?php } ?>
				</h3>
			</div>
			<div class="row mt-4">
				<h3 class="profileText"><span class="miniHeader">Allies: </span>
					<?php foreach(getAllies1() as $ally1) { ?>
						- <?=$ally1['name']?> -
					<?php } ?>
				</h3>
			</div>
			<div class="row mt-4 mb-4">
				<h3 class="profileText"><span class="miniHeader">Enemies: </span>
					<?php foreach(getEnemies2() as $enemy2) { ?>
						- <?=$enemy2['name']?> -
					<?php } ?>
				</h3>
			</div>
			</div>
		</div>
	</div>

	<div class="row mt-4 bio ml-2 mr-2 mb-4">
		<?=$hero['biography']?>
	</div>

<?php } ?>
</html>