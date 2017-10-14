<?php

    require(__DIR__ . "/../includes/config.php");

    // numerically indexed array of places
    $places = [];
    //die($_GET["geo"]);
    $query = $_GET["geo"] . "%";

    // Search database for places matching $_GET["geo"], store in $places
    $places = CS50::query("
        SELECT postal_code, place_name, admin_name1, latitude, longitude  FROM places
        WHERE postal_code LIKE ? OR place_name LIKE ? OR admin_name1 LIKE ? LIMIT 20",
        $query, $query, $query
    );
    // $places = CS50::query(
    // 	"SELECT * FROM places WHERE MATCH(postal_code, place_name, admin_name1) AGAINST (?) LIMIT 20",
    // 	$_GET["geo"]); FULLTEXT

    // output places as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($places, JSON_PRETTY_PRINT));

?>
