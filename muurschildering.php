<?php 

include("_infra/functions.php");


$muralid = $_GET['id'];

// data uit muurschilderingen.csv halen
$metadata = array();
$i = 0;
if (($handle = fopen("data/muurschilderingen.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {

    	$i++;
    	if($i==1){
    		$fieldnames = $data;
    		continue;
    	}
        if($data[0]!=$muralid){
        	continue;
        }

        for($n=0; $n<count($data);$n++){
        	$metadata[$fieldnames[$n]] = $data[$n];
        }
    }
    fclose($handle);
}



// afbeeldingen uit afbeeldingen.csv halen
$imgs = array();
if (($handle = fopen("data/afbeeldingen.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        if($data[2]!=$muralid){
        	continue;
        }

        if($data[4]=="lokaal"){
        	$imgurl = "_assets/img/lokaal/" . $data[1];
        	$imglink = "_assets/img/lokaal/" . $data[1];
        }elseif($data[4]=="commons"){
        	$imgname = str_replace(" ","_",$data[1]);
        	$md5hashed = md5($imgname);
        	$imgurl = "https://upload.wikimedia.org/wikipedia/commons/thumb/" . substr($md5hashed,0,1) . "/" . substr($md5hashed,0,2) . "/" . $imgname . "/300px-" . $imgname;
        	$imglink = "https://commons.wikimedia.org/wiki/File:" . urlencode($imgname);
        }elseif($data[4]=="rce"){
        	if(!preg_match("/media\/([^\?]+)/",$data[1],$found)){
        		continue;
        	}
        	$uuid = $found[1];
        	$imgurl = "https://images.memorix.nl/rce/thumb/640x480/" . $uuid . ".jpg";
        	$imglink = $data[1];
        }else{
        	continue;
        }

        $imgs[] = array(
        	"url" => $imgurl,
        	"link" => $imglink,
        	"jaar" => $data[3]
        );
    }
    fclose($handle);
}

function sortByYear($a, $b) {
    if ($a['jaar'] > $b['jaar']) {
        return 1;
    } elseif ($a['jaar'] < $b['jaar']) {
        return -1;
    }
    return 0;
}

usort($imgs, 'sortByYear');


// materiaaltechnische staat uit csv halen
$mattech = array();
$i = 0;
if (($handle = fopen("data/materiaaltechnisch.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {

    	$i++;
    	if($i==1){
    		$fieldnames = $data;
    		continue;
    	}

        if($data[1]!=$muralid){
        	continue;
        }

        for($n=0; $n<count($data);$n++){
        	
        	if($fieldnames[$n]=="constructie"){
        		$constructions = array(
	        		"baksteen" => "https://data.cultureelerfgoed.nl/term/id/cht/bbe4a82c-d0af-42c9-86c2-cca2e9560bac",
					"beton" => "https://data.cultureelerfgoed.nl/term/id/cht/a64a233b-91ab-4431-afca-dac58c5b63a7",
					"natuursteen" => "https://data.cultureelerfgoed.nl/term/id/cht/160dd0cb-52ec-4320-82a0-16cad8889f5d",
					"graniet" => "https://data.cultureelerfgoed.nl/term/id/cht/9940cc61-e695-40f9-b0a7-ad3270091e1f",
					"tufsteen" => "https://data.cultureelerfgoed.nl/term/id/cht/fe46430e-3e7a-4e9d-9be4-c76ee19bf2d5",
					"kalksteen" => "https://data.cultureelerfgoed.nl/term/id/cht/b003b3b2-65d1-4aa7-bbe4-c035ae230c53",
					"keien" => "https://data.cultureelerfgoed.nl/term/id/cht/c57a23c6-92ef-4063-9dc0-e92393931988",
					"kloostermop" => "https://data.cultureelerfgoed.nl/term/id/cht/7c556686-e7d7-4681-81f2-b2a2b73af01a",
					"ijsselsteen" => "https://data.cultureelerfgoed.nl/term/id/cht/acef9ca8-368a-4cf6-9035-e65408674b82",
					"zandsteen" => "https://data.cultureelerfgoed.nl/term/id/cht/07067413-15a3-4210-a2ca-5fa80893357d"
				);

	        	if(array_key_exists($data[$n],$constructions)){
	        		$data[$n] = '<a href="' . $constructions[$data[$n]] . '">' . $data[$n] . '</a>';
	        	}elseif(substr($data[$n],0,4) == "http"){
	        		$data[$n] = '<a href="' . $data[$n] . '">' . $data[$n] . '</a>';
	        	}
        	}

        	if($fieldnames[$n]=="schildertechniek"){
        		$techniques = array(
	        		"graffiti" => "https://data.cultureelerfgoed.nl/term/id/cht/f302aa2a-05cf-4994-9ae9-118639374bb2",
					"fresco" => "https://data.cultureelerfgoed.nl/term/id/cht/551d2fbc-c358-4229-aca8-320bdfacdcd7",
					"secco" => "https://data.cultureelerfgoed.nl/term/id/cht/c7c593d5-2b94-4413-be91-0d98984458af",
					"tekening" => "https://data.cultureelerfgoed.nl/term/id/cht/eb9e1e5b-b319-4519-a4f5-0dd26dbf4524"
				);

	        	if(array_key_exists($data[$n],$techniques)){
	        		$data[$n] = '<a href="' . $techniques[$data[$n]] . '">' . $data[$n] . '</a>';
	        	}elseif(substr($data[$n],0,4) == "http"){
	        		$data[$n] = '<a href="' . $data[$n] . '">' . $data[$n] . '</a>';
	        	}
        	}

        	if($fieldnames[$n]=="grondlaag"){
        		$grounds = array(
			        "kalk" => "https://data.cultureelerfgoed.nl/term/id/cht/2f06513a-a4dd-4001-9a7b-efea781fab2c",
					"pleister" => "https://data.cultureelerfgoed.nl/term/id/cht/1a289d6b-fbdc-4888-a953-4c046f16c89e",
				);

	        	if(array_key_exists($data[$n],$grounds)){
	        		$data[$n] = '<a href="' . $grounds[$data[$n]] . '">' . $data[$n] . '</a>';
	        	}elseif(substr($data[$n],0,4) == "http"){
	        		$data[$n] = '<a href="' . $data[$n] . '">' . $data[$n] . '</a>';
	        	}
        	}

        	if($fieldnames[$n]=="bindmiddelen"){
        		$bindmiddelen = array(
			        "temperaverf" => "https://data.cultureelerfgoed.nl/term/id/cht/443e133a-7c93-4c8f-af20-19ff4b3b6be0",
					"lijnolie" => "https://data.cultureelerfgoed.nl/term/id/cht/eef09c5c-23fc-4796-bda9-9b73e992288b",
					"lijm" => "https://data.cultureelerfgoed.nl/term/id/cht/c623de2a-4e2a-476d-9d3c-10c4501cabad",
					"kalkwater" => "https://data.cultureelerfgoed.nl/term/id/cht/04f74ebd-68b1-4fba-ad07-65034a5e6f0c"
				);

	        	if(array_key_exists($data[$n],$bindmiddelen)){
	        		$data[$n] = '<a href="' . $bindmiddelen[$data[$n]] . '">' . $data[$n] . '</a>';
	        	}elseif(substr($data[$n],0,4) == "http"){
	        		$data[$n] = '<a href="' . $data[$n] . '">' . $data[$n] . '</a>';
	        	}
        	}

        	$mattech[$fieldnames[$n]] = $data[$n];
        }
    }
    fclose($handle);
}
unset($mattech['id']);
unset($mattech['muurschildering']);



// kunsthistorische info uit csv halen
$kunsthist = array();
$i = 0;
if (($handle = fopen("data/kunsthistorisch.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {

    	$i++;
    	if($i==1){
    		$fieldnames = $data;
    		continue;
    	}

        if($data[0]!=$muralid){
        	continue;
        }

        for($n=0; $n<count($data);$n++){

        	if($fieldnames[$n]=="motief_thema"){
        		$themes = explode(",",$data[$n]);
        		$themelinks = array();
        		foreach($themes as $theme){
        			if(preg_match("/(Q[0-9]+) ?(.*)/",$theme,$found)){
        				$themelinks[] = '<a href="https://www.wikidata.org/wiki/' . $found[1] . '">' . trim($found[0]) . '</a>';
        			}else{
        				$themelinks[] = trim($theme);
        			}
        			
        		}
        		$data[$n] = implode(", ",$themelinks);
        	}elseif($fieldnames[$n]=="motief_ornamentiek"){
	        	$ornaments = array(
	        		"beslag en cartouche" => "https://vocab.getty.edu/aat/300010256",
					"biezen" => "http://vocab.getty.edu/page/aat/300011879",
					"bloem"	=>	"https://vocab.getty.edu/aat/300375563",
					"bloemrank"	=> "https://vocab.getty.edu/aat/300010135",
					"boom en struik" =>	"https://vocab.getty.edu/aat/300132412",
					"decoratieve band" => "https://vocab.getty.edu/aat/300009700",
					"fruit en bessen" => "https://vocab.getty.edu/aat/300011868",
					"geometrisch motief" => "https://vocab.getty.edu/aat/300009764",
					"keperband" => "https://vocab.getty.edu/aat/300165028",
					"kleurvlakken" => "https://vocab.getty.edu/aat/300164595",
					"lint" => "https://vocab.getty.edu/aat/300387440",
					"materiaalimitaties" => "https://vocab.getty.edu/aat/300015640",
					"meander" => "https://vocab.getty.edu/aat/300165279",
					"palmette" => "https://vocab.getty.edu/aat/300009995",
					"plantmotief" => "https://vocab.getty.edu/aat/300164599",
					"rolwerk" => "https://vocab.getty.edu/aat/300010205",
					"ster" => "https://vocab.getty.edu/aat/300009811"
				);

	        	if(array_key_exists($data[$n],$ornaments)){
	        		$data[$n] = '<a href="' . $ornaments[$data[$n]] . '">' . $data[$n] . '</a>';
	        	}
        	}elseif($fieldnames[$n]=="motief_tekens"){
        		$tekens = array(
        			"inscripties" => "https://vocab.getty.edu/aat/300028702",
					"merkteken" => "https://vocab.getty.edu/aat/300028744",
					"wapenschilden" => "https://vocab.getty.edu/aat/300138227",
					"wijdingskruisen" => "https://vocab.getty.edu/aat/300395632"
				);
				if(array_key_exists($data[$n],$tekens)){
	        		$data[$n] = '<a href="' . $tekens[$data[$n]] . '">' . $data[$n] . '</a>';
	        	}
        	}
        	$kunsthist[$fieldnames[$n]] = $data[$n];
        }
    }
    fclose($handle);
}
//unset($kunsthist['motief']);
unset($kunsthist['muurschilderingid']);



// schadegeschiedenis uit csv halen
$schades = array();
$i = 0;
if (($handle = fopen("data/schadegeschiedenis.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {

    	$i++;
    	if($i==1){
    		$fieldnames = $data;
    		continue;
    	}

        if($data[1]!=$muralid){
        	continue;
        }

        for($n=0; $n<count($data);$n++){
			$schades[$fieldnames[$n]] = $data[$n];
        }
    }
    fclose($handle);
}
unset($schades['id']);
unset($schades['muurschildering']);


// BEDREIGINGEN
$threats = array();
if (($handle = fopen("data/bedreigende-gebeurtenissen.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
      if(!isset($threatcolnames)){
        $threatcolnames = $data;
      }
      if($data[2] == $muralid){
        $threatcol = array();
        foreach ($data as $k => $v) {
          $threatcol[$threatcolnames[$k]] = $v;
        }
        $threats[] = $threatcol;
      }
    }
    fclose($handle);
}


// bronnen info uit csv halen en labels bij wikidata halen
$bronnen = array();
$i = 0;
if (($handle = fopen("data/bronnen.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {

    	if($data[2]!=$muralid){
        	continue;
        }

        $bronnen[] = $data[3];
    }
    fclose($handle);
}

//print_r($bronnen);

$wdbronnenstring = "";
foreach ($bronnen as $bron) {
	if(strpos($bron,"http://www.wikidata.org/entity/") !== false){
		$wdbronnenstring .= "wd:" . str_replace("http://www.wikidata.org/entity/","",$bron) . " ";
	}
}

$endpoint = 'https://query.wikidata.org/sparql';

$sparql = "
SELECT ?item ?itemLabel WHERE {
  VALUES ?item {
    " . $wdbronnenstring . "
  }
  SERVICE wikibase:label { bd:serviceParam wikibase:language \"nl,en\". }
}
limit 1000";

//echo $sparql;
//die;

$json = getSparqlResults($endpoint,$sparql);
$data = json_decode($json,true);

$wdbronnen = array();
if(isset($data['results']['bindings'])){
	foreach ($data['results']['bindings'] as $rec) {
		//print_r($rec);
		$wdbronnen[$rec['item']['value']] = $rec['itemLabel']['value'];
	}
}




// IS ER EEN SITUATIESCHETS VAN SCHILDERINGEN IN DIT GEBOUW?
$schemaimg = "<p>Er is geen situatieschema.</p>";
if(file_exists("_assets/img/schemas/" . $metadata['gebouwid'] . ".jpg")){
  $schemaimg = '<img class="schemaimg" src="_assets/img/schemas/' . $metadata['gebouwid'] . '.jpg" />';
}
// of staat er een (betere) situatieschets in plattegronden.csv?
if (($handle = fopen("data/plattegronden.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
      if($data[0] == $metadata['gebouwid']){
        $imgname = str_replace(" ","_",$data[1]);
        $md5hashed = md5($imgname);
        $imgurl = "https://upload.wikimedia.org/wikipedia/commons/thumb/" . substr($md5hashed,0,1) . "/" . substr($md5hashed,0,2) . "/" . $imgname . "/800px-" . $imgname;
        $imglink = "https://commons.wikimedia.org/wiki/File:" . urlencode($imgname);
        $schemaimg = '<a href="' . $imglink . '"><img class="schemaimg" src="' . $imgurl . '" /></a>';
      }
    }
    fclose($handle);
}


include("_parts/header.php");

?>


<div id="main">

	<div class="container-fluid">

		<h1>Muurschildering <?= $metadata['id'] ?></h1>



		<div class="row">

			<div class="col-md-6">
				<h2>basisgegevens</h2>
        		
        		<table class="table">
					<?php 
					foreach ($metadata as $key => $value) { 
						if($key == "volgnr"){
							continue; 
						}
						if($key == "gebouwid"){
							$value = '<a href="gebouw.php?id=' . $value . '">' . $value . '</a>'; 
						}
					?>
					<tr>
						<th><?= str_replace("_"," ",$key) ?></th><td><?= $value ?></td>
					</tr>
					<?php } ?>
				</table>


				<h2>kunsthistorisch</h2>
        		
        		<table class="table">
					<?php foreach ($kunsthist as $key => $value) { ?>
					<tr>
						<th><?= str_replace("_"," ",$key) ?></th><td><?= $value ?></td>
					</tr>
					<?php } ?>
				</table>


				<h2>materiaaltechnisch</h2>

				<table class="table">
					<?php foreach ($mattech as $key => $value) { ?>
					<tr>
						<th><?= str_replace("_"," ",$key) ?></th><td><?= $value ?></td>
					</tr>
					<?php } ?>
				</table>


				
				<h2>bronnen</h2>
        		
        		<table class="table">
					<?php foreach ($bronnen as $bron) { ?>
					<tr>
						<td>
							<a href="<?= $bron ?>">
								<?php if(isset($wdbronnen[$bron])){ ?>
									<?= $wdbronnen[$bron] ?>
								<?php }else{ ?>
									<?= $bron ?>
								<?php } ?>
							</a>
						</td>
					</tr>
					<?php } ?>
				</table>


			</div>
			<div class="col-md-6">

				<h2>situatieschema</h2>
        		<?= $schemaimg ?>


        		<h2>schadegeschiedenis</h2>

				<table class="table">
					<?php foreach ($schades as $key => $value) { ?>
					<tr>
						<th><?= str_replace("_"," ",$key) ?></th><td><?= $value ?></td>
					</tr>
					<?php } ?>
				</table>

				<h2>Bedreigende gebeurtenissen</h2>
            
		        <table class="table">
		          <tr>
		            <th>soort gebeurtenis</th>
		            <th>locatie</th>
		            <th>ernst gebeurtenis</th>
		            <th>beschrijving</th>
		          </tr>
		          <?php foreach ($threats as $threat) { ?>
		          <tr>
		            <td><?= $threat['soort_gebeurtenis'] ?></td>
		            <td><?= $threat['locatie'] ?></td>
		            <td><?= $threat['ernst_gebeurtenis'] ?></td>
		            <td><?= $threat['beschrijving'] ?></td>
		          </tr>
		          <?php } ?>
		        </table>




			</div>

		</div>




		<div class="row">

			<div class="col-md-12">
				<h2>afbeeldingen</h2>

				<?php foreach ($imgs as $img) { ?>
					<a class="imglink" href="<?= $img['link'] ?>">
						<img class="muralimg" src="<?= $img['url'] ?>" />
						<?php if(preg_match("/[0-9]{4}/",$img['jaar'])){ ?>
						<div class="imgyear"><?= $img['jaar'] ?></div>
						<?php } ?>
					</a>
				<?php } ?>

			</div>

		</div>

		
	</div>
</div>






<?php

include("_parts/footer.php");

?>
