<?php

include('./database.php');

$id = intval(htmlentities($_GET["id"]));

function getHero($id) {	
		$sql = "
			SELECT heroes.*
			FROM heroes 
			WHERE heroes.id= " . $id;
		
		$request = pg_query(getDb(), $sql);
		return pg_fetch_all($request);
}

function getAbilities($id) {	
			$sql = "
				SELECT heroes.id, abilities.ability
				FROM heroes
				JOIN ability_hero ON ability_hero.hero_id = heroes.id
				JOIN abilities ON abilities.id = ability_hero.ability_id
				WHERE heroes.id=" . $id;
			$request = pg_query(getDb(), $sql);
			return pg_fetch_all($request);
}

function getAllies($id) {
	$sql = "
		SELECT relationships.id, relationship_types.type, relationships.hero1_id, relationships.hero2_id, heroes.name 
		FROM relationships
		JOIN heroes ON heroes.id = relationships.hero2_id 
		JOIN relationship_types ON relationships.type_id = relationship_types.id
		WHERE relationships.type_id = 1 AND relationships.hero1_id=" . $id;
	$request = pg_query(getDb(), $sql);
	return pg_fetch_all($request);
}	

function getEnemies($id) {
	$sql = "
		SELECT relationships.id, relationship_types.type, relationships.hero1_id, relationships.hero2_id, heroes.name 
		FROM relationships
		JOIN heroes ON heroes.id = relationships.hero2_id 
		JOIN relationship_types ON relationships.type_id = relationship_types.id
		WHERE relationships.type_id = 2 AND (relationships.hero1_id=" . $id . ")";
		;
	
	$request = pg_query(getDb(), $sql);
	return pg_fetch_all($request);
}

?>


<!DOCTYPE html>
<html>

<head>
	<?php include('./header.php'); 
		foreach(getHero($id) as $hero) { ?>
	<title><?=$hero['name']?></title>
	<?php } ?>
</head>

<body class="container">

<?php foreach(getHero($id) as $hero) { ?>

<div class="row">
	<div class="mr-5">
		<a class="homeLink" href="./../index.php"><h4 class="profileLogo mt-4">Hero-Book</h4></a>
	</div>
</div>

<h1 class="profileName mt-4 text-center"><?=$hero['name']?></h1>

	<div class="row mt-4">
		<div class="imageCenter">
			<img class="profilePic img-responsive img-thumbnail" src="<?=$hero['image_url']?>">
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-6">
			<!-- <div class="centerInfo"> -->
				<div class="infoColBackground">
					<div class="row mt-3">
						<h3 class="profileText"><span class="miniHeader">About Me: </span><?=$hero['about_me']?></h3>
					</div>
					<div class="row mt-3">
						<h3 class="profileText"><span class="miniHeader">Abilties: </span>
							<?php foreach(getAbilities($id) as $ability) { ?>
								- <?=$ability['ability']?>
							<?php } ?>
						</h3>
					</div>
					<div class="row mt-3">
						<h3 class="profileText"><span class="miniHeader">Allies: </span>
							<?php if(getAllies($id)) {
								foreach(getAllies($id) as $ally) { ?>
								- <a class="allyProfiles" href="profile.php?id=<?=$ally['hero2_id']?>"><?=$ally['name']?></a> 
							<?php }
								} else {
									echo "No Allies";
								}?>
						</h3>
					</div>
					<div class="row mt-3 mb-3">
						<h3 class="profileText"><span class="miniHeader">Enemies: </span>
							<?php if(getEnemies($id)) {
								foreach(getEnemies($id) as $enemy) { ?>
								- <a class="enemyProfiles" href="profile.php?id=<?=$enemy['hero2_id']?>"><?=$enemy['name']?></a>
							<?php } 
								} else {
									echo "No Enemies";
								} ?>
						</h3>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="row bio mb-4">
					<div class="col bioCol">
						<h4 class="miniHeader">Bio:</h4>
							<?=$hero['biography']?>
					</div>
				</div>
			</div>
		</div>
	</div>

	

<?php } ?>


</body>
</html>