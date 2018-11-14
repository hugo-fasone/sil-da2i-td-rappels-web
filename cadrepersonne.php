<?php
$picture = getPictureByPerson($data['id']);
?>
<figure>
    <img src="<?php echo $picture['path'] ?>">
    <figcaption><?php echo $data['firstname'].' '.$data['lastname']?></figcaption>
</figure>
