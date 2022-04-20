<?php

header('Content-Type: application/json');
$f = json_decode(file_get_contents('../joueurs.json'), true);
$e = count($f);

$p = json_decode(file_get_contents('../parties.json'), true);
$idp = count($p);

if ($e == 4) {
    $res = "[" . $e . ',' . ($idp - 1) . "]";
} else {
    $res = "[" . $e . ',' . $idp . "]";
}

print($res);
