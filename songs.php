<?php
declare(strict_types=1);

require_once 'autoload.php';

$param = $_GET['q'];

//$html = new WebPage("La liste des artistes avec des paramètres");

$song = MyPDO::getInstance()->prepare(<<<SQL
    SELECT DISTINCT album.id, track.number, track.duration, song.name 
    FROM track, song, album
    WHERE song.id = track.songId
    and album.id = track.albumId
    and album.id = :q
SQL
);


$song->execute([":q"=>$param]);

$retour = [];

while(($ligne = $song->fetch()) !== false){
    //$duration= [];
    //$duration[] += $ligne['duration'];
    //for($i= 1; $i < sizeof($duration); $i++){
            //$minute = $duration[$i]%60;
            //echo $minute;
            //$seconde = $duration[$i] -$minute*60;
          //  $duraton[] += $minute.":".$seconde;
        //}
    $duration = $ligne['duration'];
    $minute = round($duration/60);
    if ($duration - $minute*60 <= 0) {
        $seconde = 0;}
    else{
    $seconde = $duration - $minute*60;}
    if ($seconde <10){
        $seconde = "0".$seconde;}
    $duration = $minute.":".$seconde;

    $retour[] = array('num'=>$ligne['number'],
                        'name'=>$ligne['name'],
                        'duration'=>$duration);
                        //'duration'=>$ligne['duration']);
}


echo json_encode($retour);