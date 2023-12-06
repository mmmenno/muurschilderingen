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

### Huidige functie/gebruik gebouw

De huidige hoofdfunctie van het gebouw

### Patrocinium

Beschermheilige gebouw
Thesaurus: Iconclass

### Type verwarming

Keuzelijst: 
- convector kachel
- electrische kachel
- gaskachel / gashaard
- hout- of pelletkachel
- open haard
- vloerverwarming
- overig

### Datum invoer type verwarming

../../....

### Bouwgeschiedenis
Opsomming korte beschrijving met aanduiding periodes / jaartallen bouwgeschiedenis

### Restauratiegeschiedenis
Korte beschrijving met aanduiding periodes / jaartallen restauraties

### Geschiedenis van lekkages
Korte beschrijving van lekkage mbt eventuele schade muurschilderingen




## Muurschilderingen

[muurschilderingen.csv]() bevat de volgende velden:

### id

De identifier van de muurschildering. Gebruik het gebouwid + 'MU' + nummer. Logischerwijs begint de nummering bij 1 en is die oplopend.

### positie

Het nummer waarmee de positie aangegeven wordt in het schema, bijv. '11' of '11b'.




## Muurschilderingen algemeen in het gebouw

muurschilderingen algemeen bevat de volgende velden:

### Algemene beschrijving muurschildering

Een algemene beschrijving van de soorten muurschilderingen in verschillende periodes

### Bronvermelding

Bron van algemene beschrijving of naam wie beschrijving heeft gemaakt

### Literatuur

Literatuurverwijzingen uit bron

### Categorie culturele waardestelling

keuzelijst:
- zeer waardevol (internationaal belang)
- zeer behoudenswaardig (nationaal van belang)
- behoudenswaardig (regionaal van belang)
- enigszins behoudenswaardig (plaatselijk van belang)

### Categorie conditie / staat beoordeling

keuzelijst:
- dringende noodzaak tot behandeling
- noodzaak tot behandeling
- mogelijke behandeling
- conditie bevredigend

### Categorie aanbeveling restauratie / consolidatie

keuzelijst:
- hoogste prioriteit
- hoge prioriteit
- gemiddelde prioriteit
- lage prioriteit

### Conditie / staat beschrijving

Beschrijving van huidige staat / conditie muurschildering

### Datum laatste conditiebeschrijving

../../....

### Door wie verricht

Naam bedrijf / restaurator



## Kunsthistorisch
[kunsthistorisch.csv] () bevat de volgende velden:

### Muurschildering id

### Welke ruimte bevindt zich de muurschildering

Locatie in het gebouw van de muurschildering (bv derde travee)
koppeling naar Erfgoedthesaurus

### Nadere specificering locatie schildering

Eventueel nader aan te duiden locatie (bv linker nis noordzijde)

### Orientatie NOZW

keuzelijst:
- Noord
- Oost
- Zuid
- West

### Schema

Nummer muurschildering in schema

### Beschrijving

Beschrijving muurschildering

### Titel

Titel muurschildering

### Vervaardiger

Naam vervaardiger
Link naar RKDartist

### Datering schildering

.... - ....

voorbeelden notatie:
1ste kwart 14de eeuw = 1300 - 1325
voor de 2de helft 15de eeuw = jaartal bouw - 1450
ca. 1275 = 1270 - 1280
ca. 1510-1520 = 1510 - 1520

### Opmerking datering

Eventuele extra informatie over datering

### Bronnen informatie 

Verwijzing naar QXXXXXXXXX nummer Wikidata

### Motief

keuzelijst:
- Verhalen
- Personen en wezens
- Allegorieen
- Ornamentiek
- Tekens en merken
  
### Motief verfijning

- Verhalen:
  Scenes van een gebeurtenis, een situatie of verhaal
  keuzelijst:
  - bijbels
  - literatuur
  - mythologie
  - historisch
  - scenes uit alledaags leven


- Personen en wezens:
  levende of historische personen, heiligen, bijbelse of mythologische persomages, dieren en denkbeeldige wezens
  keuzelijst niet te doen
  Linken naar 
  - Iconclass
  - Artistic themes Wiki
  - ?

- Allegorieen:
  Scenes met allegorische of symbolische betekenis
  Linken naar
  - Iconclass
  ?

- Ornamentiek
  keuzelijst, bijvoorbeeld en uit te breiden:
  - Beslag en cartouche
  - Bloem, naturalistisch
  - Bloem, stilistisch
  - Cirkel, vierkant, driehoek, ruit
  - Fruit en bessen
  - Lint (gedraaid, gevlochten)
  - Mens, dier en wezen
  - Muizentrap
  - Meander
  - Palmette
  - Plantmotief
  - Ster
 
- Tekens en merken
  keuzelijst:
  - inscripties
  - keurmerken
  - wapenschilden
  - wijdingskruisen
    
### Opmerking over motief

Eventuele nadere opmerking 

### Opmerkingen restauratie van belang voor kunsthistorische beschrijving / datering

Zijn bijvoorbeeld bepaalde lagen van een schildering bijvoorbeeld verwijderd of juist overschilderd.



## Restauraties

[restauraties.csv] () bevat de volgende velden:

### Jaartallen restauratie

.... - ....


### Bijbehorende restaurator

Naam bedrijf / restaurator

### Activiteit

Wat was / is belangrijkste activiteit geweest
Keuzelijst van maken?


### Beschrijving restauretie

Korte omschrijving restauratie, ook bouwkundig. Materiaalgebruik restauratie opschrijven als informatie bekend is, retouches etc.

### Restauratieverslagen

Zijn restauratieverslagen bekend en waar bevinden deze zich, link naar digitale locatie.




## Materiaaltechnisch

[materiaaltechnisch.csv]() bevat de volgende velden:

### Muurschildering

Het id van de muurschildering, zoals vastgelegd in [muurschilderingen.csv]()

### Hoogte

De hoogte van de muurschildering in centimeters

### Breedte

De breedte van de muurschildering in centimeters

### Constructie

Keuzelijst:
- baksteen
- beton
- graniet
- tufsteen
- kalksteen
- onbepaald
- overig
- veldkeien
- zandsteen
Linken met erfgoedthesaurus

### Opmerking over constructie

Nadere beschrijving constructie, bijvoorbeeld de baksteen en is een kloostermop
Linken met erfgoedthesaurus

### Schildertechniek

keuzelijst:
- graffiti
- fresco
- secco
- keim
- tekening
- kalkschildering

Linken naar erfgoedthesaurus

### Grondlaag

keuzelijst:
- kalk
- kalk op pleister
- pleister
- overig

### Bindmiddelen

keuzelijst:
- temperaverf, ei of caseine
- (lij)nolie
- lijm
- kalkwater
- overig

### Schade door vervuiling

keuzelijst:
- omvangrijk
- in grote mate
- in mindere mate
- onbetekenend

### (Vocht)vlekken

keuzelijst:
- omvangrijk
- in grote mate
- in mindere mate
- onbetekenend

### Micro bacteriele activiteit

keuzelijst:
- omvangrijk
- in grote mate
- in mindere mate
- onbetekenend


### Schade door zout

keuzelijst:
- omvangrijk
- in grote mate
- in mindere mate
- onbetekenend

### Pleisterschade

keuzelijst:
- omvangrijk
- in grote mate
- in mindere mate
- onbetekenend

### Scheuren

keuzelijst:
- omvangrijk
- in grote mate
- in mindere mate
- onbetekenend

### Beschadiging in verf en onderliggende lagen

keuzelijst:
- omvangrijk
- in grote mate
- in mindere mate
- onbetekenend

### Verkleuring

keuzelijst:
- omvangrijk
- in grote mate
- in mindere mate
- onbetekenend


### Opmerkingen betreffende schade

Nadere beschrijving schade

### Datum notatie schade

../../....


## Bedreigende gebeurtenissen

[bedreigende gebeurtenissen.csv]() bevat de volgende velden:


### Lekkage locatie

Locatie-aanduiding waar de lekkage is geweest

### Ernst lekkage

keuzelijst:
- heel ernstig
- ernstig
- behoorlijk
- beetje

### Beschrijving lekkage

Beschrijving van de lekkage

### Datum lekkage

../../....

### Datum aardbeving

../../....

### Schadebeschrijving

Beschrijving wat voor en waar de schade is


## Bronnen
[bronnen.csv]() bevat de volgende velden:

### Monumentnummer
id van het gebouw, het rijksmonumentnummer

### Muurschildering id

De identifier van de muurschildering, zie [muurschilderingen.csv]. 

### Link
Link naar de bron online, ofwel betreffende muurschildering of gebouw

### Fysieke loactie
Indien niet digitaal, waar is de bron te raadplegen?


## Afbeeldingen
[afbeeldingen.csv]() bevat de volgende velden:

### Monumentnummer
id van het gebouw, het rijksmonumentnummer

### Muurschildering id

De identifier van de muurschildering, zie [muurschilderingen.csv]. 

### Jaartal foto

Wanneer is de afbeelding gemaakt?

### Link
Link naar de afbeelding online (RCE beeldbank of Wikimedia), ofwel betreffende muurschildering of gebouw

