<?php 


include("_infra/functions.php");

if(!isset($_GET['id'])){
  header( "Location: gebouwen.php" );
}else{
  $id = $_GET['id'];
}

// GEGEVENS GEBOUW UIT CSV HALEN

$i = 0;
if (($handle = fopen("data/gebouwen.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
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


// RESTAURATIEGESCHIEDENIS
$restaurations = array();
if (($handle = fopen("data/restauraties.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
      if(!isset($rescolnames)){
        $rescolnames = $data;
      }
      if($data[1] == $id){
        $rescol = array();
        foreach ($data as $k => $v) {
          if($rescolnames[$k] == "restauratieverslag"){
            if(substr($v,0,4) == "http"){
              $v = '<a href="' . $v . '">' . $v . '</a>';
            }
          }
          $rescol[$rescolnames[$k]] = $v;
        }
        $restaurations[] = $rescol;
      }
    }
    fclose($handle);
}

//print_r($restaurations);


// GEGEVENS OVERZICHT UIT CSV HALEN
$overzicht = array();
if (($handle = fopen("data/muurschilderingen-overzicht.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
      if(!isset($colnames)){
        $colnames = $data;
      }
      if($data[0] == $id){
        foreach ($data as $k => $v) {
          $overzicht[$colnames[$k]] = $v;
        }
      }
    }
    fclose($handle);
}

//print_r($overzicht);


// GEGEVENS GEBOUW VAN WIKIDATA HALEN

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






// MUURSCHILDERINGEN IN DIT GEBOUW UIT CSV HALEN

$schilderingen = array();
$i = 0;
if (($handle = fopen("data/muurschilderingen.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $i++;
        if($i==1){
          $columnnames = $data;
          continue;
        }
        if($data[1] != $id){ // ander gebouw
          continue;
        }
        $n = 0;
        foreach ($data as $k => $v) {
          $schilderingen[$data[0]][$columnnames[$n]] = $data[$n];
          $n++;
        }
    }
    fclose($handle);
}

//ksort($schilderingen,SORT_NATURAL);

function sortByOrder($a, $b) {
    if ($a['volgnr'] > $b['volgnr']) {
        return 1;
    } elseif ($a['volgnr'] < $b['volgnr']) {
        return -1;
    }
    return 0;
}

usort($schilderingen, "sortByOrder");

//print_r($schilderingen);





// IS ER EEN SITUATIESCHETS VAN SCHILDERINGEN IN DIT GEBOUW?

$schemaimg = "<p>Er is geen situatieschema.</p>";
if(file_exists("_assets/img/schemas/" . $id . ".jpg")){
  $schemaimg = '<img class="schemaimg" src="_assets/img/schemas/' . $id . '.jpg" />';
}

// of staat er een (betere) situatieschets in plattegronden.csv?
if (($handle = fopen("data/plattegronden.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
      if($data[0] == $id){
        $imgname = str_replace(" ","_",$data[1]);
        $md5hashed = md5($imgname);
        $imgurl = "https://upload.wikimedia.org/wikipedia/commons/thumb/" . substr($md5hashed,0,1) . "/" . substr($md5hashed,0,2) . "/" . $imgname . "/800px-" . $imgname;
        $imglink = "https://commons.wikimedia.org/wiki/File:" . urlencode($imgname);
        $schemaimg = '<a href="' . $imglink . '"><img class="schemaimg" src="' . $imgurl . '" /></a>';
      }
    }
    fclose($handle);
}





// AFBEELDINGEN UIT RCE SPARQL ENDPOINT

$sparqlquery = "PREFIX dc: <http://purl.org/dc/elements/1.1/>
PREFIX edm: <http://www.europeana.eu/schemas/edm/>
PREFIX ceo: <https://linkeddata.cultureelerfgoed.nl/def/ceo#>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX rm: <https://linkeddata.cultureelerfgoed.nl/cho-kennis/id/rijksmonument/>
      
SELECT * WHERE {
  ?rmafb ceo:rijksmonumentnummer \"" . $wdinfo['rmnr'] . "\" .
  ?rmafb a edm:ProvidedCHO .
  ?rmafb edm:isShownAt ?shownat .
  ?rmafb edm:isShownBy ?shownby .
  ?rmafb dc:description ?description .
  FILTER (REGEX(?shownat,\"cultureelerfgoed\"))
} LIMIT 1000";

$imgsqueryurl = "https://linkeddata.cultureelerfgoed.nl/rce/cho/sparql/cho#query=" . urlencode($sparqlquery) . "";
$endpoint = 'https://api.linkeddata.cultureelerfgoed.nl/datasets/rce/cho/services/cho/sparql';

$json = getSparqlResults($endpoint,$sparqlquery);
$data = json_decode($json,true);

$imgs = array();
foreach ($data['results']['bindings'] as $rec) {
  //print_r($rec);
  $rceafbid = str_replace("https://linkeddata.cultureelerfgoed.nl/cho-kennis/beeldbank/id/","",$rec['rmafb']['value']);
  foreach ($rec as $k => $v) {
    $imgs[$rceafbid][$k] = str_replace("&w=400","",$v['value']);
  }
}





// bronnen info uit csv halen
$bronnen = array();
$i = 0;
if (($handle = fopen("data/bronnen.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {

      if($data[1]!=$id){
          continue;
        }

        $bronnen[$data[3]] = $data[3];
    }
    fclose($handle);
}





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
        
        <p>
          <strong>type verwarming</strong>: <?= $gebouw['type_verwarming'] ?><br />
          <strong>type verwarming sinds</strong>: <?= $gebouw['type_verwarming_sinds'] ?><br />
          <strong>huidige functie</strong>: <?= $gebouw['huidige_functie'] ?>
        </p>

        <p>
          <strong>bouwgeschiedenis</strong><br />
          <?= $gebouw['bouwgeschiedenis'] ?>
        </p>

        <p>
          <strong>schadegeschiedenis</strong><br />
          <?= $gebouw['schadegeschiedenis'] ?>
        </p>

			</div>
			<div class="col-md-4">
				<div id="map"></div>
			</div>

		</div>






    <h1>Muurschilderingen</h1>

    

    <div class="row">


      <div class="col-md-12" style="overflow:hidden">

        <h2>Restauratiegeschiedenis</h2>
            
        <table class="table">
          <tr>
            <th>begin</th>
            <th>einde</th>
            <th>restaurator</th>
            <th>activiteit</th>
            <th>beschrijving</th>
            <th>restauratieverslag</th>
          </tr>
          <?php foreach ($restaurations as $restauration) { ?>
          <tr>
            <td><?= $restauration['begin_restauratie'] ?></td>
            <td><?= $restauration['einde_restauratie'] ?></td>
            <td><?= $restauration['restaurator'] ?></td>
            <td><?= $restauration['activiteit'] ?></td>
            <td><?= $restauration['beschrijving'] ?></td>
            <td><?= $restauration['restauratieverslag'] ?></td>
          </tr>
          <?php } ?>
        </table>
        
      </div>

    </div>

    <div class="row">


      <div class="col-md-6" style="overflow:hidden">

        <h2>Algemene beschrijving muurschilderingen</h2>
        <p><?= $overzicht['beschrijving'] ?></p>

        <p>
          <strong>culturele waardestelling</strong>: <?= $overzicht['culturele_waardestelling'] ?><br />
          <strong>beoordeling staat conditie</strong>: <?= $overzicht['beoordeling_staat_conditie'] ?><br />
          <strong>aanbeveling restauratie consolidatie</strong>: <?= $overzicht['aanbeveling_restauratie_consolidatie'] ?><br />
          <strong>beschrijving staat conditie</strong>: <?= $overzicht['beschrijving_staat_conditie'] ?><br />
          <strong>laatste conditiebeschrijving</strong>: <?= $overzicht['laatste_conditiebeschrijving'] ?>
        </p>

        <h2>Situatieschema</h2>
        <?= $schemaimg ?>

        <h2>bronnen</h2>
            
        <table class="table">
          <?php foreach ($bronnen as $bron) { ?>
          <tr>
            <td><a href="<?= $bron ?>"><?= $bron ?></a></td>
          </tr>
          <?php } ?>
        </table>
        
      </div>

      <div class="col-md-6">

        

        <h2>Afzonderlijke muurschilderingen</h2>  

        <?php if(count($schilderingen)){ ?>

          <p>De posities in de tabel refereren aan de nummers in het situatieschema</p>
          
          <table class="table">
            <tr>
              <th>id</th>
              <th>positie</th>
              <th>beschrijving</th>
            </tr>
          <?php foreach($schilderingen as $schildering){ ?>
            <tr>
              <td><a href="muurschildering.php?id=<?= $schildering['id'] ?>"><?= $schildering['id'] ?></a></td>
              <td><?= $schildering['positie'] ?></td>
              <td><?= nl2br($schildering['titel']) ?></td>          
            </tr>
          <?php } ?>
          </table>

        <?php  }else{ ?>
          Er zijn geen afzonderlijke muurschilderingen beschreven.
        <?php  } ?>
      </div>

    </div>


    <h1>Afbeeldingen gebouw</h1>

    <div class="row">
      <div class="col-md-12">

        <p>De afbeeldingen zijn opgehaald uit de <a target="_blank" href="<?= $imgsqueryurl ?>">RCE sparql endpoint</a>. Op <a target="_blank" href="https://commons.wikimedia.org/wiki/Category:<?= $wdinfo['commons'] ?>">Wikimedia Commons</a> zijn wellicht meer afbeeldingen te vinden.</p>

        <?php foreach ($imgs as $img) { ?>
          <a target="_blank" title="<?= $img['description'] ?>" href="<?= $img['shownat'] ?>"><img class="rmimg" src="<?= $img['shownby'] ?>&w=200" /></a>
        <?php } ?>
        
      </div>
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
