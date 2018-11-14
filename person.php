<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Réalisateur</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php
include 'getblock.php';
$idActor = $_GET['person'];

getBlock('infospersonne.php',array(getPersonById($idActor), getPictureByPerson($idActor), getPersonByFilm(1)));
//getBlock('filmo.php');?>
</body>
</html>