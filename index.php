<?php


/**
 * Movie night voting application
 *
 *Author: Karen Liang
 */

include('includes/error_reporting.php');
include('includes/database.php');


// The copyright year.
$copyrightYear='2016';

$people = [];
$peopleQuery = $pdo ->query("SELECT * FROM people");
while ($person = $peopleQuery -> fetch(PDO::FETCH_OBJ)) { 
	$people[$person->id] = $person->name; 
	}
?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Movie Night Vote</title>
  <link type="text/css" href="css/style.css" rel="stylesheet">
</head>

<body>
  <div id="wrapper">
  <header>

    <div id="user-info">
      <a href="login.html">Log in</a>
      <a href="admin.html">Site admin</a>
    </div>

    <h1>Movie Night Vote</h1>

    <nav>
      <ul>
        <li><a href="index.html">This week's vote</a></li>
        <li><a href="results.html">This week's results</a></li>
        <li><a href="previous.html">Previous results</a></li>
        <li><a href="about.html">About this site</a></li>
        <li><a href="contact.html">Contact</a></li>
      </ul>
    </nav>

  </header>

  <div id="content">
    <h2> This week's movies </h2>
      <div id="movies">
        <form method="POST" action="results.html">

          <p>
            Hi
            <select name="name">
               <?php
			foreach ($people as $id => $name) {
			echo '<option value="' . $id . '">' .
			$name . '</option>';
			}
        	?>
            </select>
          </p>



	
          <p>Which of the following movies would you like to see on the next Movie Night?<br>Pick which one you'd like below!</p>

<?php
$movieQuery = $pdo->query("SELECT * FROM movies");

while ($movie = $movieQuery->fetch(PDO::FETCH_OBJ)) {
   echo <<<EOT
<p class="movie">
   <label for="vote_$movie->id">
	<img class="poster"
	  alt="$movie->name"
	  src="img/$movie->id.jpg">
	$movie->name
   </label>
	<input type="radio"
	id="vote_$movie->id"
	value="$movie->id"
	name="vote"
   <span class="synopsis">&hellip;</span>
</p>
EOT;
	
}
?>
        </div>

        <input type="submit" value="Vote!" id="vote_button">

    </div>



</div>
  <footer>
    <p class="small">
	A page by Karen Liang
	<?php echo $copyrightYear; ?>
    </p>
  </footer>

  <script
    src="https://code.jquery.com/jquery-3.1.1.js"
    integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
    crossorigin="anonymous"></script>

<script type="text/javascript" src="js/script.js"></script>
</body>


</html>
