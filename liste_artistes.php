<?php
declare(strict_types=1);

require_once 'autoload.php';

$param = $_GET['q'];

//$html = new WebPage("La liste des artistes avec des paramètres");

$artistes = MyPDO::getInstance()->prepare(<<<SQL
    SELECT artist.name 
    FROM artist
    WHERE artist.name LIKE :q
    ORDER BY artist.name
SQL
);

$artistes->execute([":q"=>"%".$param."%"]);



$retour = <<<HTML
        {$param} : 
HTML
;


while (($ligne = $artistes->fetch()) !== false) {
    $retour .= $ligne['name'].", ";
}

echo $retour;
