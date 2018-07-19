<?php
try {
	$objDb = new PDO('mysql:host=localhost;dbname=ses01', 'admin', 'udemy');
	$objDb->exec('SET CHARACTER SET utf8');
	
	$sql = "SELECT *,
			DATE_FORMAT(`date`, '%m/%d/%Y') AS `date_formatted`
			FROM `comments`
			WHERE `active` = 1
			ORDER BY `date` DESC";
	$statement = $objDb->query($sql);
	$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch(Exception $e) {
	echo $e->getMessage();
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SeS01-jQDialog</title>
	<link rel="stylesheet" href="css/core.css">
</head>
<body>
	<div id="wrapper">
		<div id="comments">
			<h1 id="head">SeS01-jQDialog Posts</h1>
			<?php if (!empty($posts)): ?>
				<?php foreach($posts as $p): ?>
					<div class="comment">
						<div class="confirm">
							<a href="#" class="button buttonGreen cancel flr">No</a>
							<a href="#" class="button delete flr mr4" data-id="<?= $p['id']; ?>">Yes</a>
							<span>Are you sure you want to delete this post?</span>
						</div>
						<div class="commentContent">
							<a href="#" class="button delConfirm flr">Delete</a>
							<span class="name">Posted by <?= htmlentities(stripslashes($p['full_name'])); ?>
								on <time datetime="<?= $p['date']; ?>"><?= $p['date_formatted']; ?></time></span>
							<p><?= htmlentities(stripslashes($p['comment'])); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<p>There are currently no comments.</p>
			<?php endif; ?>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/core.js"></script>
</body>
</html>



