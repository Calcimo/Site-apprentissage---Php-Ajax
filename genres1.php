<?php
declare(strict_types=1);

require_once 'autoload.php';

$html = new WebPage("Le form");

$genre = MyPDO::getInstance()->prepare(<<<SQL
    SELECT *
    FROM genre
SQL
);

$genre->execute();

$html->appendContent(<<<HTML
    <style>div {display: inline-block;}</style>
    <div id = "genre">
    <div id = "tout">
    <select name="form" multiple size="5">
    <option value="style">Style...</option>
HTML
);
while (($ligne = $genre->fetch()) !== false) {
        $html->appendContent(<<<HTML
        <option value="genre">{$ligne['name']}</option>
HTML
);
}
$html->appendContent(<<<HTML
    </select>
    </div>
HTML
);



//$artistes = MyPDO::getInstance()->prepare(<<<SQL
  //  SELECT *
    //FROM artist
//SQL
//);
//$artistes->execute();

$html->appendContent(<<<HTML
    <div id = "artist">
    <select name="form" multiple size="5">
    <option value="artist">Artiste...</option>
HTML
);
//while (($ligne = $artistes->fetch()) !== false) {
  //      $html->appendContent(<<<HTML
    //    <option value="artist">{$ligne['name']}</option>
//HTML
//);
//}
$html->appendContent(<<<HTML
    </select>
    </div>
HTML
);


//$album = MyPDO::getInstance()->prepare(<<<SQL
  //  SELECT *
   // FROM album
//SQL
//);
//$album->execute();
$html->appendContent(<<<HTML
    <div id = "album">
    <select name="form" multiple size="5">
    <option value="alb">Album...</option>
HTML
);
//while (($ligne = $album->fetch()) !== false) {
 //       $html->appendContent(<<<HTML
    //    <option value="album">{$ligne['name']}</option>
//HTML
//);
//}
$html->appendContent(<<<HTML
    </select>
    </div>
    </div>
HTML
);

echo $html->toHtml();