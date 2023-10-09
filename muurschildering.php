<?php 

$muralid = $_GET['id'];

// data uit muurschilderingen.csv halen
$schilderingen = array();
if (($handle = fopen("data/muurschilderingen.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        if($data[0]==$muralid){
        	$metadata = $data;
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
        	$mattech[$fieldnames[$n]] = $data[$n];
        }
    }
    fclose($handle);
}
unset($mattech['id']);
unset($mattech['muurschildering']);
unset($mattech['afmetingen']);



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

        if($data[1]!=$muralid){
        	continue;
        }

        for($n=0; $n<count($data);$n++){
        	$kunsthist[$fieldnames[$n]] = $data[$n];
        }
    }
    fclose($handle);
}
unset($kunsthist['id']);
unset($kunsthist['muurschildering']);
$kunsthist['iconclass'] = '<a href="' . $kunsthist['iconclass'] . '">' . $kunsthist['iconclass'] . '</a>';



// bronnen info uit csv halen
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



// us er een schema?
$schemaimg = "<p>Er is geen situatieschema.</p>";
if(file_exists("_assets/img/schemas/" . $metadata[1] . ".jpg")){
  $schemaimg = '<img class="schemaimg" src="_assets/img/schemas/' . $metadata[1] . '.jpg" />';
}

include("_parts/header.php");

?>


<div id="main">

	<div class="container-fluid">

		<h1>Muurschildering <?= $metadata[0] ?></h1>



		<div class="row">

			<div class="col-md-6">
				<h2>basisgegevens</h2>
        		<table class="table">
					<tr>
						<th>id</th><td><?= $metadata[0] ?></td>
					</tr>
					<tr>
						<th>gebouw</th><td><a href="gebouw.php?id=<?= $metadata[1] ?>"><?= $metadata[1] ?></a></td>
					</tr>
					<tr>
						<th>positie in schema</th><td><?= $metadata[2] ?></td>
					</tr>
					<tr>
						<th>beschrijving</th><td><?= $metadata[3] ?></td>
					</tr>
					<tr>
						<th>ruimte</th><td><?= $metadata[5] ?></td>
					</tr>
					<tr>
						<th>locatie in ruimte</th><td><?= $metadata[6] ?></td>
					</tr>
					<tr>
						<th>oriëntatie</th><td><?= $metadata[7] ?></td>
					</tr>
					<tr>
						<th>specificering locatie</th><td><?= $metadata[8] ?></td>
					</tr>
					<tr>
						<th>datering vroegst</th><td><?= $metadata[9] ?></td>
					</tr>
					<tr>
						<th>datering laatst</th><td><?= $metadata[10] ?></td>
					</tr>
					<tr>
						<th>datering opmerking</th><td><?= $metadata[11] ?></td>
					</tr>
				</table>


				<h2>kunsthistorisch</h2>
        		
        		<table class="table">
					<?php foreach ($kunsthist as $key => $value) { ?>
					<tr>
						<th><?= str_replace("_"," ",$key) ?></th><td><?= $value ?></td>
					</tr>
					<?php } ?>
				</table>



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

				<h2>situatieschema</h2>
        		<?= $schemaimg ?>


        		<h2>materiaaltechnisch</h2>

				<table class="table">
					<?php foreach ($mattech as $key => $value) { ?>
					<tr>
						<th><?= str_replace("_"," ",$key) ?></th><td><?= $value ?></td>
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
