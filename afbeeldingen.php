<?php 

include("_infra/functions.php");


$murals = array();

// data uit muurschilderingen.csv halen
$i = 0;
if (($handle = fopen("data/muurschilderingen.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {

    	$i++;
    	if($i==1){
    		$fieldnames = $data;
    		continue;
    	}
        for($n=0; $n<count($data);$n++){
        	$murals[$data[0]][$fieldnames[$n]] = $data[$n];
        }
    }
    fclose($handle);
}

//print_r($murals);


// afbeeldingen uit afbeeldingen.csv halen
$imgs = array();
if (($handle = fopen("data/afbeeldingen.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        
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

        $murals[$data[2]]["imgs"][] = array(
        	"url" => $imgurl,
        	"link" => $imglink,
        	"jaar" => $data[3]
        );

        usort($murals[$data[2]]["imgs"], 'sortByYear');

    }
    fclose($handle);
}

//print_r($murals);

function sortByYear($a, $b) {
    if ($a['jaar'] > $b['jaar']) {
        return 1;
    } elseif ($a['jaar'] < $b['jaar']) {
        return -1;
    }
    return 0;
}




include("_parts/header.php");

?>


<div id="main">

	<div class="container-fluid">

		<h1>Alle afbeeldingen</h1>



		<div class="row">

			<div class="col-md-12">

				<?php foreach ($murals as $mural) { ?>

					<?php if(!isset($mural['imgs'])){ continue; } ?>

					<h2 style="clear: both">
						<a href="muurschildering.php?id=<?= $mural['id'] ?>"><?= $mural['id'] ?></a> | <?= $mural['titel'] ?></h2>

					<?php foreach ($mural['imgs'] as $img) { ?>
						<a class="imglink" href="<?= $img['link'] ?>">
							<img class="muralimg" src="<?= $img['url'] ?>" />
							<?php if(preg_match("/[0-9]{4}/",$img['jaar'])){ ?>
							<div class="imgyear"><?= $img['jaar'] ?></div>
							<?php } ?>
						</a>
					<?php } ?>
				<?php } ?>

			</div>


		
	</div>
</div>






<?php

include("_parts/footer.php");

?>
