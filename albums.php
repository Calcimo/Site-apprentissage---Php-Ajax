<?php
declare(strict_types=1);

require_once 'autoload.php';

$param = $_GET['q'];

//$html = new WebPage("La liste des artistes avec des paramètres");

$album = MyPDO::getInstance()->prepare(<<<SQL
    SELECT DISTINCT artist.id, album.name, album.year 
    FROM artist, album
    WHERE artist.id = album.artistId 
    and artist.id = :q
SQL
);


$album->execute([":q"=>$param]);

$retour = [];

while(($ligne = $album->fetch()) !== false){
    $retour[] = array('id'=>$ligne['id'],
                        'txt'=>$ligne['year']."-".$ligne['name']);
}


echo json_encode($retour);