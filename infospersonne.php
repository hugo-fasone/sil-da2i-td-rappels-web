<?php

echo '<h1>'. $data[0]['firstname'] . ' ' . $data[0]['lastname'] . '</h1>
<figure>
    <img src="'. $data[1]['path'] .'">
    <figcaption>'. $data[1]['legend'] .'</figcaption>
</figure>
<time datetime="'. $data[0]['birthDate'] .'"> '. $data[0]['birthDate'] .' </time>
<h2>Biographie</h2>
<p>'. $data[0]['biography'] .'</p>';

foreach ($data[2] as $pls){
    if ($data[0]['id'] == $pls['id'] && $pls['role'] == 'director'){
        getBlock('filmo.php');
    }
}

?>
