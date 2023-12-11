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

### bron bouwgeschiedenis
Verwijzing naar boeken, artikelen, personen waar informatie vandaag komt

### restauratiegeschiedenis
Korte beschrijving met aanduiding periodes / jaartallen restauraties

### schadegeschiedenis
Korte beschrijving van scheurvorming, verzakkingen, lekkage mbt eventuele schade muurschilderingen.
Specifieke informatie met jaartallen kan in bedreigende gebeurtenissen.csv

### ingevoerd door:
Naam invoerder informatie over restaturatiegeschiedenis en schadegeschiedenis

### bron restauratie- en schadegeschiedenis
Eventuele verwijzing naar restauratie- of bouwhistorisch verslag of publicatie





## Muurschilderingen overzicht

De tabel [muurschilderingen-overzicht.csv]() is bedoeld om per gebouw alle muurschilderingen samen kort te beschrijven en iets te zeggen over conditie en waardestelling van het geheel aan muurschilderingen. De csv bevat de volgende velden:

### gebouwid

De identifier van het gebouw zoals vastgelegd in [gebouwen.csv](), bijvoorbeeld 'RM8247'.

### beschrijving

Een algemene beschrijving van de soorten muurschilderingen in verschillende periodes

### beschrijving_bron

Bron van de algemene beschrijving of naam van de persoon die de beschrijving heeft gemaakt. Als de bron een op Wikidata beschreven boek, persoon, etc. is, gebruik dan het Wikidata Qnummer.

### literatuur

Literatuurverwijzingen uit bron

### culturele_waardestelling

| categorie | uitleg |
| :-------- | :----- |
| zeer waardevol | internationaal belang |
| zeer behoudenswaardig | nationaal van belang |
| behoudenswaardig | regionaal van belang |
| enigszins behoudenswaardig | plaatselijk van belang |

### beoordeling\_staat\_conditie

| categorie |
| :-------- |
| dringende noodzaak tot behandeling |
| noodzaak tot behandeling |
| mogelijke behandeling |
| conditie bevredigend |

### aanbeveling\_restauratie\_consolidatie

| categorie |
| :-------- |
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

### muurschildering_id

De identifier van de muurschildering. Gebruik het gebouwid + 'MU' + nummer. Logischerwijs begint de nummering bij 1 en is die oplopend.

### positie

Het nummer waarmee de positie aangegeven wordt in het schema, bijv. '11' of '11b'.

### titel

Titel of korte aanduiding van de muurschildering.

### volgnr

Nummer, gebruikt om op te sorteren.

### ruimte

Locatie in het gebouw van de muurschildering. Voorbeelden: 'eerste travee', 'tweede travee', 'gewelf koortravee en koorsluiting', 'koor', 'triomfboog'.
 
### locatie\_in\_ruimte

Eventueel nader aan te duiden locatie. Voorbeelden: 'linker nis noordzijde', 'zuidwand', 'noord- en zuidzijde'.

### orientatie_nozw

| keuze |
| ----- |
| noord |
| noordoost |
| oost |
| zuidoost |
| zuid |
| zuidwest |
| west |
| noordwest |







## Kunsthistorisch
[kunsthistorisch.csv]() bevat de volgende velden:

### muurschildering_id

Het id van de muurschildering, zoals vastgelegd in [muurschilderingen.csv]()

### beschrijving

Kunsthistorische beschrijving muurschildering.

### vervaardiger

RKDartist URI (bijv. `https://rkd.nl/explore/artists/72909`) of Wikidata Qnummer van de maker van de muurschildering.

### datering_vroegst

Jaartal `jjjj` van de vroegst mogelijke vervaardigingsdatum, '1300' als het werk in het eerste kwart van de 14e eeuw is vervaardigd.

### datering_laatst

Jaartal `jjjj` van de laatst mogelijke vervaardigingsdatum, '1325' als het werk in het eerste kwart van de 14e eeuw is vervaardigd.

### datering_opmerking

Eventuele extra informatie over datering

### bron_kunsthist 1
Vermeld de bron(nen) van voorgaande ingevoerde informatie

### bron_kunsthist 2
Vermeld de bron(nen) van voorgaande ingevoerde informatie

### motief_thema

| keuze |
| ----- |
| allegorie |
| ornamentiek |
| personen en wezens |
| tekens en merken |
| verhalend |


### motief_thema_specifiek

Verhalend, Personen en wezens, Allegorieen

Geef een Wikidata Qnummer van een artistiek thema of bijbelverhaal.

Een overzicht van artistieke thema's vind je op [https://w.wiki/8RLS]()
Een overzicht van bijbelverhalen vind je op [https://w.wiki/8RLV]()


### motief_ornamentiek

| term | cultuurhistorische thesaurus | aat |
| ---- | ---------------------------- | --- |
| Beslag en cartouche |  |  |
| cartouche |  | [https://vocab.getty.edu/aat/300010256]() |
| Bloem, naturalistisch |  |  |
| Bloem, stilistisch |  |  |
| bloem |  | [https://vocab.getty.edu/aat/300375563]() |
| Cirkel, vierkant, driehoek, ruit |  |  |
| geometrisch motief |  | [https://vocab.getty.edu/aat/300009764]() |
| Fruit en bessen |  |  |
| Lint (gedraaid, gevlochten) |  |  |
| lint |  | [https://vocab.getty.edu/aat/300387440]() |
| Mens, dier en wezen |  |  |
| Muizentrap |  |  |
| trappatroon |  | [https://vocab.getty.edu/aat/300010229]() |
| meander |  | [https://vocab.getty.edu/aat/300165279]() |
| palmette |  | [https://vocab.getty.edu/aat/300009995]() |
| plantmotief |  | [https://vocab.getty.edu/aat/300164599]() |
| ster |  | [https://vocab.getty.edu/aat/300009811]() |

Indien een term niet in het bovenstaande lijstje voorkomt, geef dan een AAT  URI. Zoek bijvoorbeeld binnen de lijst [patroon (ontwerpelementen)](https://www.getty.edu/vow/AATHierarchy?find=&logic=AND&note=&subjectid=300010108) of [motieven](https://www.getty.edu/vow/AATHierarchy?find=&logic=AND&note=&subjectid=300009700).

### motief_tekens

| term | cultuurhistorische thesaurus | aat |
| ---- | ---------------------------- | --- |
| inscripties |  | [https://vocab.getty.edu/aat/300028702]() |
| keurmerken |  |  |
| merkteken |  | [https://vocab.getty.edu/aat/300028744]() |
| wapenschilden | [https://data.cultureelerfgoed.nl/term/id/cht/c58475d5-0795-4623-b4be-ea1524f4b4fb]() | [https://vocab.getty.edu/aat/300138227]() |
| wijdingskruisen |  | [https://vocab.getty.edu/aat/300395632]() |

  
    
### motief_opmerking

Eventuele nadere opmerking 

### Opmerkingen restauratie van belang voor kunsthistorische beschrijving / datering

Zijn bijvoorbeeld bepaalde lagen van een schildering bijvoorbeeld verwijderd of juist overschilderd.





## Bedreigende gebeurtenissen
[bedreigende-gebeurtenissen]() bevat de volgende velden:

### monumentnummer_id
id van het gebouw

### muurschildering_id
id van de muurschildering

### soort_gebeurtenis

| keuze |
| ----- |
| aardbeving |
| brand |
| lekkage |
| overstroming |


### locatie
Waar in het gebouw / muurschildering is de schade door de bedreigende gebeurtenis?

### ernst bedreigende gebeurtenis
Geef de ernst  aan op de volgende schaal:
100-75 % : zeer ernstig
75-50 % : ernstig
50-25 % : behoorlijk
25-0 % : gering

### beschrijving bedreigende gebeurtenis
Beschrijf de bedreigende gebeurtenis

### datum bedreigende gebeurtenis

../../....



## Restauraties

[restauraties.csv] () bevat de volgende velden:

### monument_id
id nummer van het gebouw


### jaartallen restauratie

.... - ....


### bijbehorende restaurator

Naam bedrijf / restaurator

### activiteit

Wat was / is belangrijkste activiteit geweest
Vrij invoerveld of keuzelijst van maken?


### beschrijving restauratie

Korte omschrijving restauratie, ook bouwkundig. Materiaalgebruik restauratie opschrijven als informatie bekend is, retouches etc.

### restauratieverslagen

Zijn restauratieverslagen bekend en waar bevinden deze zich, link naar digitale locatie.




## Materiaaltechnisch

[materiaaltechnisch.csv]() bevat de volgende velden:

### muurschildering_id

Het id van de muurschildering, zoals vastgelegd in [muurschilderingen.csv]()

### hoogte

De hoogte van de muurschildering in centimeters

### breedte

De breedte van de muurschildering in centimeters

### constructie

Kies één van de volgende termen:

| keuze |
| ----- |
| baksteen | [https://data.cultureelerfgoed.nl/term/id/cht/bbe4a82c-d0af-42c9-86c2-cca2e9560bac]()|
| beton | [https://data.cultureelerfgoed.nl/term/id/cht/a64a233b-91ab-4431-afca-dac58c5b63a7]() |
| natuursteen | [https://data.cultureelerfgoed.nl/term/id/cht/41febb28-264d-4b64-a6ef-5716e43c0154]() |

Laat leeg indien 'onbepaald'

### Verfijning_constructie

| term | cultuurhistorische thesaurus |
| ---- | ---------------------------- |
| graniet | [https://data.cultureelerfgoed.nl/term/id/cht/9940cc61-e695-40f9-b0a7-ad3270091e1f]()|
| tufsteen | [https://data.cultureelerfgoed.nl/term/id/cht/fe46430e-3e7a-4e9d-9be4-c76ee19bf2d5]() |
| kalksteen | [https://data.cultureelerfgoed.nl/term/id/cht/b003b3b2-65d1-4aa7-bbe4-c035ae230c53]() |
| keien | [https://data.cultureelerfgoed.nl/term/id/cht/c57a23c6-92ef-4063-9dc0-e92393931988]() |
| kloostermop | [https://data.cultureelerfgoed.nl/term/id/cht/c57a23c6-92ef-4063-9dc0-e92393931988]() |
| ijsselsteen | [https://data.cultureelerfgoed.nl/term/id/cht/2d1df478-abf5-4aec-a47b-d4d1787b0de9() |
| zandsteen | [https://data.cultureelerfgoed.nl/term/id/cht/07067413-15a3-4210-a2ca-5fa80893357d]() |

Laat leeg indien 'onbepaald', geef een cultuurhistorische thesaurus URI indien specifieker (Kloostermop, Doornikse steen, Bentheimer zandsteen) of anders.



### Opmerking over constructie

Nadere beschrijving constructie, bijvoorbeeld onderkant muur is van een ander soort constructie dan bovenkant

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
- (lijn)olie
- lijm
- kalkwater
- overig

### Schade door vervuiling

| categorie |
| :-------- |
| omvangrijk |
| in grote mate |
| in mindere mate |
| onbetekenend |

Of aangeven in percentages?


### (Vocht)vlekken

| categorie |
| :-------- |
| omvangrijk |
| in grote mate |
| in mindere mate |
| onbetekenend |

### Micro bacteriele activiteit

| categorie |
| :-------- |
| omvangrijk |
| in grote mate |
| in mindere mate |
| onbetekenend |


### Schade door zout

| categorie |
| :-------- |
| omvangrijk |
| in grote mate |
| in mindere mate |
| onbetekenend |

### Pleisterschade

| categorie |
| :-------- |
| omvangrijk |
| in grote mate |
| in mindere mate |
| onbetekenend |

### Scheuren

| categorie |
| :-------- |
| omvangrijk |
| in grote mate |
| in mindere mate |
| onbetekenend |

### Beschadiging in verf en onderliggende lagen

| categorie |
| :-------- |
| omvangrijk |
| in grote mate |
| in mindere mate |
| onbetekenend |

### Verkleuring

| categorie |
| :-------- |
| omvangrijk |
| in grote mate |
| in mindere mate |
| onbetekenend |


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

