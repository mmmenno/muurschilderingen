<?php 


include("_infra/functions.php");

if(!isset($_GET['id'])){
  die;
}else{
  $id = $_GET['id'];
}

// data gebouw uit gebouwen.csv halen
$gebouw = array();

$i = 0;
if (($handle = fopen("data/gebouwen.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
      if($data[0] == $id){
        $gebouw = $data;
        $wdidsstring = "wd:" . $data[2];
      }
    }
    fclose($handle);
}

//print_r($wdids);


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
		$wdinfo[$k] = $v['value'];
	}
}

//print_r($wdinfo);

$fc = array("type"=>"FeatureCollection", "features"=>array());


  
$building = array("type"=>"Feature");

$wkt = strtolower($wdinfo['coords']);
$ll = explode(" ",str_replace(array("point(",")"),"",$wkt));
$building['geometry'] = array(
  "type" => "Point",
  "coordinates" => array($ll[0],$ll[1])
);
$props = array(
  "label" => $wdinfo['itemLabel']
);
$building['properties'] = $props;
$fc['features'][] = $building;



$geojson = json_encode($fc);

header('Content-Type: application/json');
echo $geojson;


?>
