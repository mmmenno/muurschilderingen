<?php 


include("_infra/functions.php");

if(!isset($_GET['id'])){
  header( "Location: gebouwen.php" );
}else{
  $id = $_GET['id'];
}

// data gebouw uit gebouwen.csv halen

$i = 0;
if (($handle = fopen("data/gebouwen.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
      if(!isset($columnnames)){
        $columnnames = $data;
      }
      if($data[0] == $id){
        foreach ($data as $k => $v) {
          $gebouw[$columnnames[$k]] = $v;
        }
        $wdidsstring = "wd:" . $data[2];
      }
    }
    fclose($handle);
}

//print_r($gebouw);


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

include("_parts/header.php");

?>


<div id="main">

	<div class="container-fluid">

		<h1><?= $gebouw['naam'] ?></h1>

		<div class="row">

			<div class="col-md-8">
				<table class="table">
					<tr>
						<th>id</th>
						<th>naam</th>
						<th>wikidata label</th>
						<th>monumentnr</th>
						<th>wikidata id</th>
						<th>commons categorie</th>
					</tr>
				
					<tr>
						<td><a href="gebouw.php?id=<?= $gebouw['id'] ?>"><?= $gebouw['id'] ?></a></td>
						<td><a href="gebouw.php?id=<?= $gebouw['id'] ?>"><?= $gebouw['naam'] ?></a></td>
						<td><?= $wdinfo['itemLabel'] ?></td>
						<td><a href="https://monumentenregister.cultureelerfgoed.nl/monumenten/<?= $gebouw['monumentnummer'] ?>"><?= $gebouw['monumentnummer'] ?></a></td>
						<td><a href="http://www.wikidata.org/entity/<?= $gebouw['wikidata'] ?>"><?= $gebouw['wikidata'] ?></a></td>					
						<td><a href="https://commons.wikimedia.org/wiki/Category:<?= $wdinfo['commons'] ?>"><?= $wdinfo['commons'] ?></a></td>					
					</tr>
				
				</table>

        <img class="wikiafb" src="<?= $wdinfo['afb'] ?>?width=500" />
        <p><?= $gebouw['bouwgeschiedenis_restauratiegeschiedenis_herbestemming'] ?></p>
			</div>
			<div class="col-md-4">
				<div id="map"></div>
			</div>

		</div>

    <div class="row">
      <h2>Algemene beschrijving muurschilderingen</h2>
      <p><?= $gebouw['beschrijving_schildering'] ?></p>
    </div>

    <div class="row">
      <h2>Afbeeldingen gebouw RCE beeldbank</h2>
    </div>

		
	</div>
</div>



<script>
  $(document).ready(function() {
    createMap();
    refreshMap();
  });

  function createMap(){
    center = [53.279,6.815];
    zoomlevel = 17;
    
    map = L.map('map', {
          center: center,
          zoom: zoomlevel,
          minZoom: 1,
          maxZoom: 20,
          scrollWheelZoom: true,
          zoomControl: false
      });

    L.control.zoom({
        position: 'bottomright'
    }).addTo(map);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
  subdomains: 'abcd',
  maxZoom: 20
    }).addTo(map);
  }

  function refreshMap(){
    $.ajax({
          type: 'GET',
          url: 'gebouw-geojson.php?id=<?= $id ?>',
          dataType: 'json',
          success: function(jsonData) {
            if (typeof herkomsten !== 'undefined') {
              map.removeLayer(herkomsten);
            }

            buildings = L.geoJson(null, {
              pointToLayer: function (feature, latlng) {                    
                  return new L.CircleMarker(latlng, {
                      color: "#ac437e",
                      radius:6,
                      weight: 1,
                      opacity: 0.8,
                      fillOpacity: 0.8
                  });
              },
            }).addTo(map);

              buildings.addData(jsonData).bringToFront();
          
              map.fitBounds(buildings.getBounds());

              //map.setCenter(buildings.getBounds().getCenter());
              map.setZoom(16);
          },
          error: function() {
              console.log('Error loading data');
          }
      });
  }

  

  

</script>



<?php

include("_parts/footer.php");

?>
