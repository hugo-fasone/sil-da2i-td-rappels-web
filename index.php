<!DOCTYPE html>
<html>
<head>
    <title>Le Film</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="inli"><h2>Films</h2><ul>
    <?php
    include 'getblock.php';
    $movies = getMovies();
    foreach ($movies as $movie){
        echo '<li><a href="movie.php?id='.$movie['id'].'">'. $movie['title'] .'</a></li>';
    }
    echo '</ul></div><div class="inli"><h2>Acteurs</h2><ul>';
    $persons = getPerson();
    foreach ($persons as $person){
        if ($person['role'] == 'actor')
            echo '<li><a href="person.php?person='.$person['id'].'">'. $person['firstname'] . ' ' . $person['lastname'] .'</a></li>';
    }

    echo '</ul></div><div class="inli"><h2>Réalisateurs</h2><ul class="inli">';
    foreach ($persons as $person){
        if ($person['role'] == 'director')
            echo '<li><a href="person.php?person='.$person['id'].'">'. $person['firstname'] . ' ' . $person['lastname'] .'</a></li>';
    }
    echo '</ul></div>'


    ?>

</body>
</html>