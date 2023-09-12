<?php 

// data uit muurschilderingen.csv halen
$schilderingen = array();
$i = 0;
if (($handle = fopen("data/muurschilderingen.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $i++;
        if($i==1){
        	$columnnames = $data;
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

include("_parts/header.php");

?>


<div id="main">

	<div class="container-fluid">

		<h1>Muurschilderingen</h1>

		<div class="row">

			<div class="col-md-8">
				<table class="table">
					<tr>
						<th>id</th>
						<th>gebouw</th>
						<th>nummer</th>
						<th>beschrijving</th>
					</tr>
				<?php foreach($schilderingen as $schildering){ ?>
					<tr>
						<td><a href="muurschildering.php?id=<?= $schildering['id'] ?>"><?= $schildering['id'] ?></a></td>
						<td><a href="gebouw.php?id=<?= $schildering['gebouw'] ?>"><?= $schildering['gebouw'] ?></a></td>
						<td><?= $schildering['positie'] ?></td>
						<td><?= $schildering['beschrijving'] ?></td>					
					</tr>
				<?php } ?>
				</table>
			</div>
			<div class="col-md-4">
			</div>

		</div>

		
	</div>
</div>






<?php

include("_parts/footer.php");

?>
