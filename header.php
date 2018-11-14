<header>
    <nav>
        <a href="person.php?person=<?php
        foreach ($data as $pls){
            if ($pls['role'] == 'director')
                echo $pls['id'];

        } ?>">Réal</a>
        <a href="actor.php">Acteur</a>
    </nav>
</header>