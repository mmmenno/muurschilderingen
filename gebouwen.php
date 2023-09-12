<?php 


include("_infra/functions.php");

// data uit gebouwen.csv halen
$gebouwen = array();
$wdids = array();

$i = 0;
if (($handle = fopen("data/gebouwen.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
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


include("_parts/header.php");

?>


<div id="main">

	<div class="container-fluid">

		<h1>Gebouwen</h1>

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
				<?php foreach($gebouwen as $gebouw){ ?>
					<tr>
						<td><a href="gebouw.php?id=<?= $gebouw['id'] ?>"><?= $gebouw['id'] ?></a></td>
						<td><a href="gebouw.php?id=<?= $gebouw['id'] ?>"><?= $gebouw['naam'] ?></a></td>
						<td><?= $wdinfo[$gebouw['wikidata']]['itemLabel'] ?></td>
						<td><a href="https://monumentenregister.cultureelerfgoed.nl/monumenten/<?= $gebouw['monumentnummer'] ?>"><?= $gebouw['monumentnummer'] ?></a></td>
						<td><a href="http://www.wikidata.org/entity/<?= $gebouw['wikidata'] ?>"><?= $gebouw['wikidata'] ?></a></td>					
						<td><a href="https://commons.wikimedia.org/wiki/Category:<?= $wdinfo[$gebouw['wikidata']]['commons'] ?>"><?= $wdinfo[$gebouw['wikidata']]['commons'] ?></a></td>					
					</tr>
				<?php } ?>
				</table>
			</div>
			<div class="col-md-4">
				<div id="map"></div>
			</div>

		</div>

		
	</div>
</div>



<script>
  $(document).ready(function() {
    createMap();
    refreshMap();
    window.apiBase = 'images.php?wikidataID=';
  });

  function createMap(){
    center = [53.279,6.815];
    zoomlevel = 9;
    
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
          url: 'gebouwen-geojson.php',
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
                      fillOpacity: 0.8,
                      title: feature.properties.label,
                      gotourl: feature.properties.buildingurl
                  });
              },
              style: function(feature) {
                return {
                    clickable: true
                };
              },
              onEachFeature: function(feature, layer) {
                layer.on({
                    mouseover: rollover,
                    click: whenClicked
                  });
                }
              }).addTo(map);

              buildings.addData(jsonData).bringToFront();
          
              map.fitBounds(buildings.getBounds());
              //$('#straatinfo').html('');
          },
          error: function() {
              console.log('Error loading data');
          }
      });
  }

  

  function rollover() {
    var props = $(this)[0].feature.properties;
    this.bindPopup($(this)[0].options.title)
    this.openPopup();
    var self = this;
    setTimeout(function() {
      self.closePopup();
    },1500);
  }

  function whenClicked(){
    //console.log(this.options);
    window.open(this.options.gotourl,"_self");
    
  }

</script>



<?php

include("_parts/footer.php");

?>
