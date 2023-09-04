<?php 


include("_infra/functions.php");

// data uit gebouwen.csv halen
$urls = array();
$wdids = array();

$i = 0;
if (($handle = fopen("data/gebouwen.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
        $i++;
        if($i==1){
        	$columnnames = $data;
        	continue;
        }
        $n = 0;
        foreach ($data as $k => $v) {
        	$gebouwen[$data[0]][$columnnames[$n]] = $data[$n];
        	$n++;
        }
        $wdids[] = $data[2];
        $urls[$data[2]] = "gebouw.php?id=" . $data[0];
    }
    fclose($handle);
}

//print_r($wdids);
$wdidsstring = "wd:" . implode(" wd:", $wdids);

$endpoint = 'https://query.wikidata.org/sparql';

$sparql = "
SELECT ?rmnr ?item ?itemLabel ?itemDescription ?coords ?gemLabel ?commons (SAMPLE(?afb) AS ?afb) WHERE {
  VALUES ?item {
    " . $wdidsstring . "
  }
  ?item wdt:P359 ?rmnr .
  ?item wdt:P625 ?coords .
  ?item wdt:P131 ?gem .
  ?item wdt:P373 ?commons .
  ?item wdt:P18 ?afb .
  SERVICE wikibase:label { bd:serviceParam wikibase:language \"nl,en\". }
}
GROUP BY ?rmnr ?item ?itemLabel ?itemDescription ?coords ?gemLabel ?commons
limit 100";

//echo $sparql;
//die;

$json = getSparqlResults($endpoint,$sparql);
$data = json_decode($json,true);

$wdinfo = array();
foreach ($data['results']['bindings'] as $rec) {
	//print_r($rec);
	$wd = str_replace("http://www.wikidata.org/entity/","",$rec['item']['value']);
	foreach ($rec as $k => $v) {
		$wdinfo[$wd][$k] = $v['value'];
	}
}


$fc = array("type"=>"FeatureCollection", "features"=>array());

foreach ($wdinfo as $wdid => $rec) {

	//print_r($value);
	
	$building = array("type"=>"Feature");

	$wkt = strtolower($rec['coords']);
	$ll = explode(" ",str_replace(array("point(",")"),"",$wkt));
	$building['geometry'] = array(
		"type" => "Point",
		"coordinates" => array($ll[0],$ll[1])
	);
	$props = array(
		"label" => $rec['itemLabel'],
		"buildingurl" => $urls[$wdid]
	);
	$building['properties'] = $props;
	$fc['features'][] = $building;
	
}

$geojson = json_encode($fc);

header('Content-Type: application/json');
echo $geojson;

?>
