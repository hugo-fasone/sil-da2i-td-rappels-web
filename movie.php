<!DOCTYPE html>
<html>
<head>
    <title>Le Film</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container">
    <?php include 'getblock.php'; getBlock('header.php',getPersonByFilm($_GET['id']));?>
    <main>
        <aside>
            <div class="testinline real">
                <p class="decal">Réalisé par :</p>

                <?php

                foreach (getPersonByFilm($_GET['id']) as $oui) {
                    if ($oui['role'] == 'director'){
                        getBlock('cadrepersonne.php',$oui);
                    }
                }

                ?>
            </div>
            <div class="testinline actors">
                <p class="decal">Acteurs principaux :</p>
                <?php
                $i = 2;
                foreach (getPersonByFilm($_GET['id']) as $item) {
                    if ($item['role'] == 'actor'){
                        if ($i%2 == 0){
                            echo '<div class="inli">';
                            getBlock('cadrepersonne.php',$item);

                        } else{
                            getBlock('cadrepersonne.php',$item);
                            echo '</div>';
                        }
                        ++$i;
                    }
                }

                ?>
            </div>
        </aside>

<?php getBlock('infosfilm.php',array(getFilmById($_GET['id']), getPersonByFilm($_GET['id']),getPictureByFilm($_GET['id'])));
getBlock('images.php',getPictureByFilm($_GET['id']));
?>


</main>
<?php getBlock('footer.php');?>
</div>
</body>
</html>