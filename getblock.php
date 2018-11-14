<?php

function getBlock($file, $data = [])
{
    require $file;
}

function connect(){
    $link = mysqli_connect('mysql-hugofasone.alwaysdata.net', '131384', 'DBPassword')
    or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
    mysqli_select_db($link, 'hugofasone_devdyn')
    or die ('Erreur de sélection de la BD : ' . mysqli_error($link));
    mysqli_set_charset($link, 'utf8');
    return $link;
}

//function getFilm(){
//    $link = connect();
//    $query = "SELECT DISTINCT title, releaseDate, synopsis, rating, path, legend, lastname, firstname, birthDate, biography, type
//              FROM movie, movieHasPerson, movieHasPicture, person, personHasPicture, picture
//              WHERE movie.id=movieHasPicture.idMovie AND movie.id=movieHasPerson.idMovie AND movieHasPicture.idPicture=picture.id
//              AND movieHasPerson.idPerson=person.id AND movie.id=1";
//    $data = [];
//$i = 0;
//    if ($result = mysqli_query($link, $query)) {
//        /* Récupère un tableau associatif */
//        while ($row = mysqli_fetch_row($result)) {
//            $data['title'] = $row[0];
//            $data['releaseDate'] = $row[1];
//            $data['synopsis'] = $row[2];
//            $data['rating'] = $row[3];
//            $data['path'][$i] = $row[4];
//            $data['legend'][$i] = $row[5];
//            $data['lastname'][$i] = $row[6];
//            $data['firstname'][$i] = $row[7];
//            $data['birthDate'][$i] = $row[8];
//            $data['biography'][$i] = $row[9];
//            $data['type'][$i] = $row[10];
//            ++$i;
//        }
//    }
//
//    return $data;
//}

function getFilmById($idMovie){
    $link = connect();


    $query = 'SELECT `title`,`releaseDate`,`synopsis`,`rating` FROM `movie` WHERE `id` = ?';
    $stmt = mysqli_prepare($link, $query)
    or die('Échec de préparation de la requête : ' . mysqli_error($link));
    mysqli_stmt_bind_param($stmt, "i", $idMovie) // type: i, d, s or b
    or die('Échec de paramétrage de la requête : ' . mysqli_error($link));
    mysqli_stmt_execute($stmt)
    or die('Erreur dans la requête : ' . mysqli_error($link));


    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) != 0) {
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            return $row;
        }
    } else {
        return 'ntm';
    }
    return 'ntm';
}

function getMovies(){
    $link = connect();

    $query = 'SELECT `id`, `title`,`releaseDate`,`synopsis`,`rating`
              FROM `movie` ';
    $stmt = mysqli_prepare($link, $query)
    or die('Échec de préparation de la requête : ' . mysqli_error($link));
    //mysqli_stmt_bind_param($stmt, "i", $idMovie) // type: i, d, s or b
    //or die('Échec de paramétrage de la requête : ' . mysqli_error($link));
    mysqli_stmt_execute($stmt)
    or die('Erreur dans la requête : ' . mysqli_error($link));

    $data = array();
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($data,$row);
        }
    } else {
        return 'ntm';
    }
    //mysqli_close($link);
    return $data;
}

function getPersonById($idPerson){
    $link = connect();



    $query = 'SELECT `id`, `lastname`,`firstname`,`birthDate`,`biography` FROM `person` WHERE `id` = ?';
    $stmt = mysqli_prepare($link, $query)
    or die('Échec de préparation de la requête : ' . mysqli_error($link));
    mysqli_stmt_bind_param($stmt, "i", $idPerson) // type: i, d, s or b
    or die('Échec de paramétrage de la requête : ' . mysqli_error($link));
    mysqli_stmt_execute($stmt)
    or die('Erreur dans la requête : ' . mysqli_error($link));


    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) != 0) {
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            return $row;
        }
    } else {
        return 'ntm';
    }
    return 'ntm';
}

function getPersonByFilm($idMovie){
    $link = connect();

    $query = 'SELECT `id`, `lastname`,`firstname`,`birthDate`,`biography`, `role` 
              FROM `person` JOIN `movieHasPerson` ON person.id=movieHasPerson.idPerson
              WHERE `idMovie` = ?';
    $stmt = mysqli_prepare($link, $query)
    or die('Échec de préparation de la requête : ' . mysqli_error($link));
    mysqli_stmt_bind_param($stmt, "i", $idMovie) // type: i, d, s or b
    or die('Échec de paramétrage de la requête : ' . mysqli_error($link));
    mysqli_stmt_execute($stmt)
    or die('Erreur dans la requête : ' . mysqli_error($link));

    $data = array();
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($data,$row);
        }
    } else {
        return 'ntm';
    }
    //mysqli_close($link);
    return $data;
}

function getPerson(){
    $link = connect();

    $query = 'SELECT `id`, `lastname`,`firstname`,`birthDate`,`biography`, `role` 
              FROM `person` JOIN `movieHasPerson` ON person.id=movieHasPerson.idPerson';
    $stmt = mysqli_prepare($link, $query)
    or die('Échec de préparation de la requête : ' . mysqli_error($link));
    //mysqli_stmt_bind_param($stmt, "i", $idMovie) // type: i, d, s or b
    //or die('Échec de paramétrage de la requête : ' . mysqli_error($link));
    mysqli_stmt_execute($stmt)
    or die('Erreur dans la requête : ' . mysqli_error($link));

    $data = array();
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($data,$row);
        }
    } else {
        return 'ntm';
    }
    //mysqli_close($link);
    return $data;
}

function getPictureByFilm($idMovie){
    $link = connect();


    $query = 'SELECT `path`,`legend`,`type`
              FROM `picture` JOIN `movieHasPicture` ON picture.id=movieHasPicture.idPicture
              WHERE `idMovie` = ?';
    $stmt = mysqli_prepare($link, $query)
    or die('Échec de préparation de la requête : ' . mysqli_error($link));
    mysqli_stmt_bind_param($stmt, "i", $idMovie) // type: i, d, s or b
    or die('Échec de paramétrage de la requête : ' . mysqli_error($link));
    mysqli_stmt_execute($stmt)
    or die('Erreur dans la requête : ' . mysqli_error($link));

    $data = array();
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            array_push($data,$row);
        }
    } else {
        return 'ntm';
    }
    return $data;
}


function getPictureByPerson($idPerson){
    $link = connect();


    $query = 'SELECT `legend`,`path`
              FROM `picture` JOIN `personHasPicture` ON picture.id=personHasPicture.idPicture
              WHERE `idPerson` = ?';
    $stmt = mysqli_prepare($link, $query)
    or die('Échec de préparation de la requête : ' . mysqli_error($link));
    mysqli_stmt_bind_param($stmt, "i", $idPerson) // type: i, d, s or b
    or die('Échec de paramétrage de la requête : ' . mysqli_error($link));
    mysqli_stmt_execute($stmt)
    or die('Erreur dans la requête : ' . mysqli_error($link));

    $data = array();
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) != 0) {
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            return $row;
        }
    } else {
        return 'ntm';
    }
    return $data;
}