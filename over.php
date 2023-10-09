<?php 

include("_parts/header.php");

?>


<div id="main">

	<div class="container-fluid">

		<h1>Over deze applicatie</h1>

		<div class="row">

			<div class="col-md-8">

				<p>Deze applicatie is een verkenning. Hoe kan je inzichtelijk maken welke gegevens waar leven? Hoe breng je die verschillende bronnen bij elkaar? Welke data moet je binnen een eigen systeem opslaan om alle gegevens bij elkaar te brengen en kwaliteit te waarborgen? En hoe zou je al die gegevens kunnen tonen en bevraagbaar kunnen maken?</p>

				<h3>Datamodel</h3>

				<p>Verschillende entiteiten zijn voor ons van belang:</p>

				<ul>
					<li><strong>gebouw</strong></li>
					<li><strong>muurschildering</strong></li>
					<li><strong>restauratie</strong></li>
					<li>afbeelding</li>
					<li>bron</li>
					<li>restauratieverslag</li>
				</ul>


				<p>De vet weergegeven entiteiten hierboven hebben we eigen identifiers gegeven - zo kunnen anderen daar ook naar verwijzen. We hebben ons best gedaan die identifiers leesbaar te houden. Zo bestaat een identifier van een gebouw uit het rijksmonumentennummer voorafgegaan door de letters 'RM'. Een gebouw dat geen rijksmonument is kan dan geidentificeerd worden met het BAG id voorafgegaan door de letters 'BAG'. De identifier voor het gebouw vind je ook weer terug in de identifiers voor muurschilderingen en restauraties.</p>

        
			</div>
			<div class="col-md-4">
				<h3>Linked data bronnen</h3>

				<h4>RCE beeldbank</h4>

				<p>Uit de <a href="https://linkeddata.cultureelerfgoed.nl/rce/cho/sparql/cho#">sparql endpoint van de RCE</a> halen we de afbeeldingen van specifieke rijksmonumenten. 

				<h4>Wikidata</h4>

				<p>Uit de <a href="https://linkeddata.cultureelerfgoed.nl/rce/cho/sparql/cho#">Wikidata endpoint</a> halen we de informatie over gebouwen, zoals bijvoorbeeld de coördinaten en de gemeente waar het gebouw zich bevindt. Maar ook de link naar afbeeldingen van het gebouw op Wikimedia Commons halen we hier op.</p>

				<h4>Wikimedia Commons</h4>

				<p>In Wikimedia Commons worden media (afbeeldingen, geluidsfragmenten, video, etc.) opgeslagen die in de verschillende Wikimediaprojecten gebruikt (kunnen) worden. De rechtenvrije afbeeldingen uit de RCE beeldbank zijn ooit allemaal op Wikimedia Commons geplaatst. Afbeeldingen kunnen er in (geneste) categorieën ondergebracht worden. Zo kan je een bijvoorbeeld een categorie aanmaken voor een specifieke restauratie (zoals <a href="https://commons.wikimedia.org/wiki/Category:Restoration_of_Sint-Laurentiuskerk,_Baflo_(1981-1983)">deze van de Sint-Laurentiuskerk in Baflo</a>) binnen de categorie voor een specifiek gebouw.</p>

				
			</div>

		</div>

		
		

		
	</div>
</div>






<?php

include("_parts/footer.php");

?>
