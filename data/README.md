# Data Muurschilderingen

Dit document beschrijft in welke velden en met welke waarden een en ander beschreven wordt. De informatie is onderverdeeld in de volgende csv-bestanden:

- [gebouwen](#Gebouwen)
- [muurschilderingen](#Muurschilderingen)
- [materiaaltechnisch](#Materiaaltechnisch)
- [kunsthistorisch](#Kunsthistorisch)
- [afbeeldingen](#Afbeeldingen)



## Gebouwen

[gebouwen.csv]() bevat de volgende velden:

### id

De identifier van een gebouw. Gebruik 'RM' + rijksmonumentnummer voor rijksmonumenten, gebruik 'BAG' + Bag pand id voor overige gebouwen.

### monumentnummer

Het rijksmonumentnummer.

### wikidata

Het wikidata Qnummer van het gebouw, bijvoorbeeld 'Q2618966'.

### naam

De naam van het gebouw.




## Muurschilderingen

[muurschilderingen.csv]() bevat de volgende velden:

### id

De identifier van de muurschildering. Gebruik het gebouwid + 'MU' + nummer. Logischerwijs begint de nummering bij 1 en is die oplopend.

### positie

Het nummer waarmee de positie aangegeven wordt in het schema, bijv. '11' of '11b'.





## Materiaaltechnisch

[materiaaltechnisch.csv]() bevat de volgende velden:

### muurschildering

Het id van de muurschildering, zoals vastgelegd in [muurschilderingen.csv]()

### hoogte

De hoogte van de muurschildering in centimeters

### breedte

De breedte van de muurschildering in centimeters

### metselwerk 

