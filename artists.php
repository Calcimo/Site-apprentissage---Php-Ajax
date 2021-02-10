<?php
declare(strict_types=1);

require_once 'autoload.php';

$param = $_GET['q'];

//$html = new WebPage("La liste des artistes avec des paramètres");

$artistes = MyPDO::getInstance()->prepare(<<<SQL
    SELECT DISTINCT artist.id, artist.name 
    FROM artist, genre, album
    WHERE genre.id = album.genreId 
    and artist.id = album.artistId 
    and genre.id = :q
SQL
);


$artistes->execute([":q"=>$param]);

$retour = [];

while(($ligne = $artistes->fetch()) !== false){
    $retour[] = array('id'=>$ligne['id'],
                        'txt'=>$ligne['name']);
}


echo json_encode($retour);