# Data Muurschilderingen

Dit document beschrijft in welke velden en met welke waarden een en ander beschreven wordt. De informatie is onderverdeeld in de volgende csv-bestanden:

- [gebouwen](#Gebouwen)
- [muurschilderingen-overzicht](#muurschilderingen-overzicht)
- [muurschilderingen](#Muurschilderingen)
- [materiaaltechnisch](#Materiaaltechnisch)
- [kunsthistorisch](#Kunsthistorisch)
- [bedreigende-gebeurtenissen](#bedreigende-gebeurtenissen)
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

### huidige_functie

De huidige hoofdfunctie van het gebouw.

### ~~patrocinium~~

Het lijkt logischer dit op het Wikidata-item van het gebouw aan te geven met de property [P417](https://www.wikidata.org/wiki/Property:P417) (patroonheilige). Op deze [lijst met rijksmonumentale kerken met patroonheilige](https://w.wiki/8QcW) zie je van welke kerken dat al gedaan is.

### type_verwarming

| kies optie |
| ----------- |
| convector kachel |
| electrische kachel |
| gaskachel / gashaard |
| hout- of pelletkachel |
| open haard |
| vloerverwarming |
| overig |

### type\_verwarming\_sinds

Het jaar sinds wanneer het verwarming-type gebruikt wordt.

### bouwgeschiedenis
Opsomming korte beschrijving met aanduiding periodes / jaartallen bouwgeschiedenis

### restauratiegeschiedenis
Korte beschrijving met aanduiding periodes / jaartallen restauraties

### schadegeschiedenis
Korte beschrijving van scheurvorming, verzakkingen, lekkage mbt eventuele schade muurschilderingen.
Specifieke informatie met jaartallen kan in bedreigende gebeurtenissen.csv





## Muurschilderingen overzicht

De tabel [muurschilderingen-overzicht.csv]() is bedoeld om per gebouw alle muurschilderingen samen kort te beschrijven en iets te zeggen over conditie en waardestelling van het geheel aan muurschilderingen. De csv bevat de volgende velden:

### gebouwid

De identifier van het gebouw zoals vastgelegd in [gebouwen.csv](), bijvoorbeeld 'RM8247'.

### beschrijving

Een algemene beschrijving van de soorten muurschilderingen in verschillende periodes

### beschrijving_bron

Bron van algemene beschrijving of naam wie beschrijving heeft gemaakt

### literatuur

Literatuurverwijzingen uit bron

### culturele_waardestelling

| categorie | uitleg |
| --------- | ------ |
| zeer waardevol | internationaal belang |
| zeer behoudenswaardig | nationaal van belang |
| behoudenswaardig | regionaal van belang |
| enigszins behoudenswaardig | plaatselijk van belang |

### beoordeling\_staat\_conditie

| categorie |
| --------- |
| dringende noodzaak tot behandeling |
| noodzaak tot behandeling |
| mogelijke behandeling |
| conditie bevredigend |

### aanbeveling\_restauratie\_consolidatie

| categorie |
| --------- |
| hoogste prioriteit |
| hoge prioriteit |
| gemiddelde prioriteit |
| lage prioriteit |

### beschrijving\_staat\_conditie

Beschrijving van huidige staat / conditie muurschildering.

### laatste_conditiebeschrijving

Datum van de laatste conditiebeschrijving, als `dd-mm-jjjj`

### beoordelaar

Naam van het bedrijf dat / de restaurator die de beoordeling gedaan heeft.







## Muurschilderingen

De tabel [muurschilderingen.csv]() beschrijft elke muurschildering afzonderlijk en bevat de volgende velden:

### id

De identifier van de muurschildering. Gebruik het gebouwid + 'MU' + nummer. Logischerwijs begint de nummering bij 1 en is die oplopend.

### positie

Het nummer waarmee de positie aangegeven wordt in het schema, bijv. '11' of '11b'.




## Kunsthistorisch
[kunsthistorisch.csv]() bevat de volgende velden:

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

jjjj - jjjj

voorbeelden notatie:
1ste kwart 14de eeuw = 1300 - 1325;
voor de 2de helft 15de eeuw = jaartal bouw - 1450;
ca. 1275 = 1270 - 1280;
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

## Bedreigende gebeurtenissen
[bedreigende-gebeurtenissen]() bevat de volgende velden:


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

### muurschildering

Het id van de muurschildering, zoals vastgelegd in [muurschilderingen.csv]()

### hoogte

De hoogte van de muurschildering in centimeters

### breedte

De breedte van de muurschildering in centimeters

### constructie

Kies één van de volgende termen:

| term | cultuurhistorische thesaurus |
| ---- | ---------------------------- |
| bakstenen | [https://data.cultureelerfgoed.nl/term/id/cht/bbe4a82c-d0af-42c9-86c2-cca2e9560bac]()|
| beton | [https://data.cultureelerfgoed.nl/term/id/cht/a64a233b-91ab-4431-afca-dac58c5b63a7]() |
| graniet | [https://data.cultureelerfgoed.nl/term/id/cht/9940cc61-e695-40f9-b0a7-ad3270091e1f]()|
| tufsteen | [https://data.cultureelerfgoed.nl/term/id/cht/fe46430e-3e7a-4e9d-9be4-c76ee19bf2d5]() |
| kalksteen | [https://data.cultureelerfgoed.nl/term/id/cht/b003b3b2-65d1-4aa7-bbe4-c035ae230c53]() |
| keien | [https://data.cultureelerfgoed.nl/term/id/cht/c57a23c6-92ef-4063-9dc0-e92393931988]() |
| zandsteen | [https://data.cultureelerfgoed.nl/term/id/cht/07067413-15a3-4210-a2ca-5fa80893357d]() |

Laat leeg indien 'onbepaald', geef een cultuurhistorische thesaurus URI indien specifieker (Kloostermop, Doornikse steen, Bentheimer zandsteen) of anders.



### Opmerking over constructie

Nadere beschrijving constructie, bijvoorbeeld de baksteen en is een kloostermop
Linken met erfgoedthesaurus

### Schildertechniek

Kies één van de volgende termen:

| term | cultuurhistorische thesaurus |
| ---- | ---------------------------- |
| graffiti | [https://data.cultureelerfgoed.nl/term/id/cht/f302aa2a-05cf-4994-9ae9-118639374bb2]() |
| fresco | [https://data.cultureelerfgoed.nl/term/id/cht/551d2fbc-c358-4229-aca8-320bdfacdcd7]() |
| secco | [https://data.cultureelerfgoed.nl/term/id/cht/c7c593d5-2b94-4413-be91-0d98984458af]() |
| keim | |
| tekening | [https://data.cultureelerfgoed.nl/term/id/cht/eb9e1e5b-b319-4519-a4f5-0dd26dbf4524]() |
| kalkschildering | |


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

### gebouw
De identifier van het gebouw zoals dat voorkomt in [gebouwen.csv]().

### muurschildering

De identifier van de muurschildering zoals dat voorkomt in [muurschilderingen.csv](). 

### bron
Dit kan een wikidata item zijn, maar ook een link naar een webpagina waar het gebouw of de muurschildering beschreven wordt.

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

