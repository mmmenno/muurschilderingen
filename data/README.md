# Data Muurschilderingen

Dit document beschrijft in welke velden en met welke waarden een en ander beschreven wordt. De informatie is onderverdeeld in de volgende csv-bestanden:

- [gebouwen](#Gebouwen)
- [muurschilderingen-overzicht](#muurschilderingen-overzicht)
- [muurschilderingen](#Muurschilderingen)
- [kunsthistorisch](#Kunsthistorisch)
- [materiaaltechnisch](#Materiaaltechnisch)
- [restauraties](#Restauraties)
- [bedreigende-gebeurtenissen](#bedreigende-gebeurtenissen)
- [afbeeldingen](#Afbeeldingen)
- [bronnen](#Bronnen)
- [schadegeschiedenis](#Schadegeschiedenis)

Eerst nog een algemene opmerking inzake bronnen. Onder [bronnen_links](#Bronnen-links) zie je hoe je links naar bronnen bij gebouwen _en/of_ muurschilderingen op kunt nemen.

Wil je een bron bij welk specifiek veld dan ook vermelden, bijvoorbeeld bij 'huidige_functie' of 'bouwgeschiedenis', doe dat dan door de tekst in het veld zelf te beëindigen met ` (bron:Qnummer)`, bijvoorbeeld ` (bron:Q55968573)`, waarbij het Qnummer het Wikidata item van de bron (boek of artikel) is. Wil je daarbij een paginanummer vermelden, schrijf dan bijvoorbeeld ` (bron:Q55968573;77)`.

Als een boek artikel niet op Wikidata bekend is, kan je dat daar toevoegen - [voorbeeld boek](https://www.wikidata.org/wiki/Q122982902), [voorbeeld artikel](https://www.wikidata.org/wiki/Q55968573).

## Gebouwen

In [gebouwen.csv](gebouwen.csv) wordt het gebouw zelf beschreven. Het bestand bevat de volgende velden:

#### id

De identifier van een gebouw. Gebruik 'RM' + rijksmonumentnummer voor rijksmonumenten, gebruik 'BAG' + Bag pand id voor overige gebouwen.

#### monumentnummer

Het rijksmonumentnummer.

#### wikidata

Het wikidata Qnummer van het gebouw, bijvoorbeeld 'Q2618966'.

#### naam

De naam van het gebouw.

#### huidige_functie

De huidige hoofdfunctie van het gebouw.

#### ~~patrocinium~~

Het lijkt logischer dit op het Wikidata-item van het gebouw aan te geven met de property [P417](https://www.wikidata.org/wiki/Property:P417) (patroonheilige). Op deze [lijst met rijksmonumentale kerken met patroonheilige](https://w.wiki/8QcW) zie je van welke kerken dat al gedaan is.

#### type_verwarming

| kies optie |
| ----------- |
| convector kachel |
| electrische kachel |
| gaskachel / gashaard |
| hout- of pelletkachel |
| open haard |
| vloerverwarming |
| overig |

#### type\_verwarming\_sinds

Het jaar sinds wanneer het verwarming-type gebruikt wordt.

#### bouwgeschiedenis
Opsomming korte beschrijving met aanduiding periodes / jaartallen bouwgeschiedenis

#### restauratiegeschiedenis
Korte beschrijving met aanduiding periodes / jaartallen restauraties

#### schadegeschiedenis
Korte beschrijving van scheurvorming, verzakkingen, lekkage mbt eventuele schade muurschilderingen.
Specifieke informatie met jaartallen kan in bedreigende gebeurtenissen.csv

#### ingevoerd_door:
Naam invoerder informatie over restaturatiegeschiedenis en schadegeschiedenis










## Muurschilderingen overzicht

De tabel [muurschilderingen-overzicht.csv](muurschilderingen-overzicht.csv) is bedoeld om per gebouw alle muurschilderingen samen kort te beschrijven en iets te zeggen over conditie en waardestelling van het geheel aan muurschilderingen. De csv bevat de volgende velden:

#### gebouwid

De identifier van het gebouw zoals vastgelegd in [gebouwen.csv](gebouwen.csv), bijvoorbeeld 'RM8247'.

#### beschrijving

Een algemene beschrijving van de soorten muurschilderingen in verschillende periodes

#### culturele_waardestelling

| categorie | uitleg |
| :-------- | :----- |
| zeer waardevol | internationaal belang |
| zeer behoudenswaardig | nationaal van belang |
| behoudenswaardig | regionaal van belang |
| enigszins behoudenswaardig | plaatselijk van belang |

#### beoordeling\_staat\_conditie

| categorie |
| :-------- |
| dringende noodzaak tot behandeling |
| noodzaak tot behandeling |
| mogelijke behandeling |
| conditie bevredigend |

#### aanbeveling\_restauratie\_consolidatie

| categorie |
| :-------- |
| hoogste prioriteit |
| hoge prioriteit |
| gemiddelde prioriteit |
| lage prioriteit |

#### beschrijving\_staat\_conditie

Beschrijving van huidige staat / conditie muurschildering.

#### laatste_conditiebeschrijving

Datum van de laatste conditiebeschrijving, als `dd-mm-jjjj`

#### beoordelaar

Naam van het bedrijf dat / de restaurator die de beoordeling gedaan heeft.







## Muurschilderingen

De tabel [muurschilderingen.csv](muurschilderingen.csv) beschrijft elke muurschildering afzonderlijk en bevat de volgende velden:

#### id

De identifier van de muurschildering. Gebruik het gebouwid + 'MU' + nummer. Logischerwijs begint de nummering bij 1 en is die oplopend.

#### gebouwid

De identifier van het gebouw zoals vastgelegd in [gebouwen.csv](gebouwen.csv), bijvoorbeeld 'RM8247'.

#### positie

Het nummer waarmee de positie aangegeven wordt in het schema, bijv. '11' of '11b'.

#### titel

Titel of korte aanduiding van de muurschildering.

#### volgnr

Nummer, vooralsnog alleen gebruikt in het prototype, om op te sorteren.

#### ruimte

Locatie in het gebouw van de muurschildering. Voorbeelden: 'eerste travee', 'tweede travee', 'gewelf koortravee en koorsluiting', 'koor', 'triomfboog'.
 
#### locatie\_in\_ruimte

Eventueel nader aan te duiden locatie. Voorbeelden: 'linker nis noordzijde', 'zuidwand', 'noord- en zuidzijde'.

#### orientatie_nozw

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


#### specifieke_locatie

Eventuele specificatie van de locatie in de ruimte.








## Kunsthistorisch

Het bestand [kunsthistorisch.csv](kunsthistorisch.csv) beschrijft datering, vervaardiger en motieven van de muurschildering. Het bevat de volgende velden:

#### muurschilderingid

Het id van de muurschildering, zoals vastgelegd in [muurschilderingen.csv](muurschilderingen.csv)

#### beschrijving

Kunsthistorische beschrijving muurschildering.

#### vervaardiger

Bij voorkeur RKDartist URI (bijv. `https://rkd.nl/explore/artists/72909`), anders Wikidata Qnummer van de maker van de muurschildering.

#### datering_vroegst

Jaartal `jjjj` van de vroegst mogelijke vervaardigingsdatum, '1300' als het werk in het eerste kwart van de 14e eeuw is vervaardigd.

#### datering_laatst

Jaartal `jjjj` van de laatst mogelijke vervaardigingsdatum, '1325' als het werk in het eerste kwart van de 14e eeuw is vervaardigd.

#### datering_opmerking

Eventuele extra informatie over datering

#### gehele concept aanwezig

| keuze |
| ----- |
| ja |
| nee |

#### percentage aanwezig

Geef percentage (numeriek) aan, hoeveel procent is nog aanwezig van gehele concept

#### motief

Kies één van de volgende termen:

| keuze |
| ----- |
| allegorie |
| ornamentiek |
| personen en wezens |
| tekens |
| verhalend |

#### motief_thema

Geef een Wikidata Qnummer, bijvoorbeeld van een artistiek thema of bijbelverhaal. Ook evangelisten, dieren, objecten, etc. zijn op Wikidata te vinden.

Een overzicht van artistieke thema's vind je op <https://w.wiki/8RLS>
Een overzicht van bijbelverhalen vind je op <https://w.wiki/8RLV>

Zet tussen haakjes in volgorde het thema waarnaar het Q nummer verwijst.


#### ~~personen\_en\_wezens~~

Niet meer nodig, want bij de Qnummers in het veld `motief_thema` is al opgenomen welke personen en wezens afgebeeld worden.


#### motief_ornamentiek

Kies één van de volgende termen:

| term | cultuurhistorische thesaurus | aat |
| :--- | :--------------------------- | :-- |
| beslag en cartouche |  | <https://vocab.getty.edu/aat/300010256> |
| biezen |  | <http://vocab.getty.edu/page/aat/300011879> |
| bloem |  | <https://vocab.getty.edu/aat/300375563> |
| boom en struik |
| fruit en bessen |
| geometrisch motief |  | <https://vocab.getty.edu/aat/300009764> |
| lint |  | <https://vocab.getty.edu/aat/300387440> |
| keperband |  | <https://vocab.getty.edu/aat/300165028> |
| materiaalimitaties
| meander |  | <https://vocab.getty.edu/aat/300165279> |
| palmette |  | <https://vocab.getty.edu/aat/300009995> |
| plantmotief |  | <https://vocab.getty.edu/aat/300164599> |
| ster |  | <https://vocab.getty.edu/aat/300009811> |
| trap |

![image](https://github.com/mmmenno/muurschilderingen/assets/152972000/41ad16af-4ee9-407d-b4fc-a6738c911280)




Indien een term niet in het bovenstaande lijstje voorkomt, geef dan een AAT  URI. Zoek bijvoorbeeld binnen de lijst [patroon (ontwerpelementen)](https://www.getty.edu/vow/AATHierarchy?find=&logic=AND&note=&subjectid=300010108) of [motieven](https://www.getty.edu/vow/AATHierarchy?find=&logic=AND&note=&subjectid=300009700). Of doorzoek de hele AAT op <https://vocab.getty.edu/> (selecteer AAT voor zoekveld). Dat kan ook in het Nederlands, zoals bijvoorbeeld [deze zoekactie op 'vlecht'](https://vocab.getty.edu/resource/getty/search?q=vlecht&luceneIndex=Brief&indexDataset=AAT&_form=%2F) laat zien.

#### motief_tekens

Kies één van de volgende termen:

| term | cultuurhistorische thesaurus | aat |
| :--- | :--------------------------- | :-- |
| inscripties |  | <https://vocab.getty.edu/aat/300028702> |
| merkteken |  | <https://vocab.getty.edu/aat/300028744> |
| wapenschilden | <https://data.cultureelerfgoed.nl/term/id/cht/c58475d5-0795-4623-b4be-ea1524f4b4fb> | <https://vocab.getty.edu/aat/300138227> |
| wijdingskruisen |  | <https://vocab.getty.edu/aat/300395632> |

  
    
#### motief_opmerking

Eventuele nadere opmerking 

#### restauratie_kunsthistorisch

Opmerkingen restauratie van belang voor kunsthistorische beschrijving / datering. Zijn bijvoorbeeld bepaalde lagen van een schildering bijvoorbeeld verwijderd of juist overschilderd.







## Materiaaltechnisch

[materiaaltechnisch.csv](materiaaltechnisch.csv) bevat de volgende velden:

#### muurschildering_id

Het id van de muurschildering, zoals vastgelegd in [muurschilderingen.csv](muurschilderingen.csv)

#### hoogte

De hoogte van de muurschildering in centimeters

#### breedte

De breedte van de muurschildering in centimeters

#### constructie

Kies één van de volgende termen:

| term | cultuurhistorische thesaurus |
| ---- | ---------------------------- |
| baksteen | <https://data.cultureelerfgoed.nl/term/id/cht/bbe4a82c-d0af-42c9-86c2-cca2e9560bac>|
| beton | <https://data.cultureelerfgoed.nl/term/id/cht/a64a233b-91ab-4431-afca-dac58c5b63a7> |
| natuursteen | <https://data.cultureelerfgoed.nl/term/id/cht/160dd0cb-52ec-4320-82a0-16cad8889f5d> |
| graniet | <https://data.cultureelerfgoed.nl/term/id/cht/9940cc61-e695-40f9-b0a7-ad3270091e1f>|
| tufsteen | <https://data.cultureelerfgoed.nl/term/id/cht/fe46430e-3e7a-4e9d-9be4-c76ee19bf2d5> |
| kalksteen | <https://data.cultureelerfgoed.nl/term/id/cht/b003b3b2-65d1-4aa7-bbe4-c035ae230c53> |
| keien | <https://data.cultureelerfgoed.nl/term/id/cht/c57a23c6-92ef-4063-9dc0-e92393931988> |
| kloostermop | <https://data.cultureelerfgoed.nl/term/id/cht/7c556686-e7d7-4681-81f2-b2a2b73af01a> |
| ijsselsteen | <https://data.cultureelerfgoed.nl/term/id/cht/acef9ca8-368a-4cf6-9035-e65408674b82> |
| zandsteen | <https://data.cultureelerfgoed.nl/term/id/cht/07067413-15a3-4210-a2ca-5fa80893357d> |

Laat leeg indien 'onbepaald', geef een Cultuurhistorische Thesaurus (CHT) URI indien specifieker (Bentheimer zandsteen) of anders. Zoeken in de CHT [doe je hier](https://thesaurus.cultureelerfgoed.nl/search) (vink Cultuurhistorische Thesaurus aan). De CHT URI is het 'Internetadres van de resource', zie bijvoorbeeld onderaan de [Bentheimer zandsteen pagina](https://thesaurus.cultureelerfgoed.nl/concept/cht:5bc0df3e-f90b-496d-af67-b131c239cc7d/nl). De CHT is hiërarchisch geordend, dus `Bentheimer zandsteen` valt binnen `zandsteen`, etc.


#### opmerking\_over\_constructie

Nadere beschrijving constructie, bijvoorbeeld onderkant muur is van een ander soort constructie dan bovenkant


#### schildertechniek

Kies één van de volgende termen:

| term | cultuurhistorische thesaurus |
| :--- | :--------------------------- |
| graffiti | <https://data.cultureelerfgoed.nl/term/id/cht/f302aa2a-05cf-4994-9ae9-118639374bb2> |
| fresco | <https://data.cultureelerfgoed.nl/term/id/cht/551d2fbc-c358-4229-aca8-320bdfacdcd7> |
| secco | <https://data.cultureelerfgoed.nl/term/id/cht/c7c593d5-2b94-4413-be91-0d98984458af> |
| keim | |
| tekening | <https://data.cultureelerfgoed.nl/term/id/cht/eb9e1e5b-b319-4519-a4f5-0dd26dbf4524> |
| kalkschildering | |


#### grondlaag

| term | cultuurhistorische thesaurus |
| :--- | :--------------------------- |
| kalk | <https://data.cultureelerfgoed.nl/term/id/cht/2f06513a-a4dd-4001-9a7b-efea781fab2c> |
| kalk op pleister |  |
| pleister | <https://data.cultureelerfgoed.nl/term/id/cht/1a289d6b-fbdc-4888-a953-4c046f16c89e> |
| overig |  |


#### bindmiddelen

| term | cultuurhistorische thesaurus |
| :--- | :--------------------------- |
| temperaverf | <https://data.cultureelerfgoed.nl/term/id/cht/443e133a-7c93-4c8f-af20-19ff4b3b6be0> |
| lijnolie | <https://data.cultureelerfgoed.nl/term/id/cht/eef09c5c-23fc-4796-bda9-9b73e992288b> |
| lijm | <https://data.cultureelerfgoed.nl/term/id/cht/c623de2a-4e2a-476d-9d3c-10c4501cabad> |
| kalkwater | <https://data.cultureelerfgoed.nl/term/id/cht/04f74ebd-68b1-4fba-ad07-65034a5e6f0c> |

Laat leeg indien 'onbepaald', geef een Cultuurhistorische Thesaurus (CHT) URI indien specifieker ([beenderlijm](https://data.cultureelerfgoed.nl/term/id/cht/48f4bf0b-d3e0-42f5-be61-bfe5a8b1315c)) of anders.

#### verguldingen

| keuze |
| ----- |
| ja |
| nee |












## Restauraties

[restauraties.csv](restauraties.csv) bevat de volgende velden:

#### gebouwid

De identifier van het gebouw zoals vastgelegd in [gebouwen.csv](gebouwen.csv), bijvoorbeeld 'RM8247'.


#### begin_restauratie

Het beginjaar, als `jjjj`.


#### einde_restauratie

Het eindjaar, als `jjjj`.


#### restaurator

Naam bedrijf / restaurator die de restauratie heeft uitgevoerd.

#### activiteit

Wat was / is belangrijkste activiteit geweest
Vrij invoerveld of keuzelijst van maken?


#### beschrijving

Korte omschrijving restauratie, ook bouwkundig. Materiaalgebruik restauratie opschrijven als informatie bekend is, retouches etc.

#### restauratieverslag

Is er een restauratieverslag bekend? Link naar digitale locatie.







## Bedreigende gebeurtenissen
Het bestand [bedreigende-gebeurtenissen.csv](bedreigende-gebeurtenissen.csv) bevat de volgende velden:

#### muurschildering

Het id van de muurschildering, zoals vastgelegd in [muurschilderingen.csv](muurschilderingen.csv).

#### soort_gebeurtenis

| keuze |
| ----- |
| aardbeving |
| brand |
| lekkage |
| overstroming |


#### locatie
Waar in het gebouw / muurschildering is de schade door de bedreigende gebeurtenis?

#### ernst_gebeurtenis

| categorie |
| :-------- |
| omvangrijk |
| in grote mate |
| in mindere mate |
| onbetekenend |

<!--
Geef de ernst  aan op de volgende schaal:
100-75 % : zeer ernstig
75-50 % : ernstig
50-25 % : behoorlijk
25-0 % : gering
-->

#### beschrijving

Beschrijving van de bedreigende gebeurtenis

#### datum

De datum van de bedreigende gebeurtenis, in het formaat `dd-mm-jjjj`.















## Afbeeldingen

Op een aantal plaatsen zijn afbeeldingen van gebouwen en de muurschilderingen daarin te vinden, vooral in de RCE beeldbank en op Wikimedia Commons (met een flinke overlap). Op beide plekken kan en wordt al een verbinding met het gebouw gelegd. Hier beperken we ons daarom tot het verbinden van afbeeldingen met muurschilderingen. Het bestand [afbeeldingen.csv](afbeeldingen.csv) bevat de volgende velden:

#### afbeelding

- komt de afbeelding van Wikimedia Commons, geef dan de bestandsnaam zoals die bijvoorbeeld [hier](https://commons.wikimedia.org/wiki/File:%27t_Zandt_-_Mariakerk_-_muurschildering_noordzijde.jpg) staat, bovenaan de pagina, zonder 'File:' ervoor. In dit geval dus `'t Zandt - Mariakerk - muurschildering noordzijde.jpg`
- komt de afbeelding van de RCE beeldbank, kopieer dan de url uit de adresbalk, als in <https://beeldbank.cultureelerfgoed.nl/rce-mediabank/detail/c1cbb975-edef-a394-038c-42ccae40e095/media/8ab84d0d-de77-6516-57f0-8da035a3d731>. Soms staat er ook wat rommel achter, beginnend met een vraagteken. Dat hoeft niet meegekopieerd te worden.
- wordt de afbeelding lokaal opgeslagen, geef dan de bestandsnaam

Het wordt aanbevolen eigen afbeeldingen, mits ze onder een open licentie aangeboden kunnen worden, via Wikimedia Commons te publiceren. Daar zijn ze voor iedereen toegankelijk en bruikbaar. Het is onduidelijk waar afbeeldingen 'lokaal' opgeslagen moeten worden en het is weinig duurzaam.

#### muurschildering

Het id van de muurschildering, zoals vastgelegd in [muurschilderingen.csv](muurschilderingen.csv)

#### jaar

In welk jaar is de afbeelding gemaakt? Formaat `jjjj`.

#### locatie

Waar is de afbeelding te vinden? Kies uit:

| keuze |
| :---- |
| commons |
| rce |
| lokaal |






## Bronnen

Het bestand [bronnen.csv](bronnen.csv) bevat de volgende velden:

#### gebouwid

De identifier van het gebouw zoals dat voorkomt in [gebouwen.csv](gebouwen.csv).

#### muurschildering_id

Het id van de muurschildering, zoals vastgelegd in [muurschilderingen.csv](muurschilderingen.csv)

#### link
Dit kan een wikidata item zijn (bijvoorbeeld van een boek), maar ook een link naar een artikel in Delpher of een webpagina waar het gebouw of de muurschildering beschreven wordt.



## Schadegeschiedenis

#### muurschildering_id

Het id van de muurschildering, zoals vastgelegd in [muurschilderingen.csv](muurschilderingen.csv)

#### terugkerende_problematiek

Beschrijf kort wat de terugkerende problematiek is.

#### inspectiefrequentie

Wanneer moet de schildering weer geïnspecteerd worden? Kies uit:

| keuze |
| :---- |
| 1 - 2 jaar |
| 2 - 5 jaar |
| 5 - 10 jaar |
| 10 - 15 jaar |
| 15 - 20 jaar |

#### externe_factoren

Waardoor is de schade ontstaan? Kies uit:

| keuze |
| :---- |
| constructiefactoren |
| gebruik van gebouw |
| fysische krachten |
| dieven en vandalen |
| brand |
| water |
| ongedierte en schimmel |
| veronreiniging |
| licht en straling |
| verkeerde temperatuur |
| verkeerde relatieve vochtigheid |

#### percentage_origineel_werk

Geef aan hoeveel procent van de schildering origineel is.


#### percentage_origineel_werk

| keuze |
| :---- |
| 0 - 25 % |
| 25 - 50 % |
| 50 - 75 % |
| 75 - 100 % |

#### aanwezigheid_van_retouches

| keuze |
| :---- |
| 0 - 25 % |
| 25 - 50 % |
| 50 - 75 % |
| 75 - 100 % |

#### mate_van_overschildering

| keuze |
| :---- |
| 0 - 25 % |
| 25 - 50 % |
| 50 - 75 % |
| 75 - 100 % |

#### aangebrachte_lagen

| keuze |
| :---- |
| kalkresten |
| kalklagen |
| vernis |
| pleisterlagen |
| fixatief |
| verflagen |

#### ondergrond

| keuze |
| :---- |
| goed |
| matig |
| slecht |

#### verf los

| keuze |
| :---- |
| bladderend |
| poederend |


#### vervuilingsschade

| keuze |
| :---- |
| 0 - 25 % |
| 25 - 50 % |
| 50 - 75 % |
| 75 - 100 % |


#### vlekken

Schade door (vocht)vlekken.

| keuze |
| :---- |
| 0 - 25 % |
| 25 - 50 % |
| 50 - 75 % |
| 75 - 100 % |

#### microbacterieel

| keuze |
| :---- |
| 0 - 25 % |
| 25 - 50 % |
| 50 - 75 % |
| 75 - 100 % |

#### zoutschade

| keuze |
| :---- |
| 0 - 25 % |
| 25 - 50 % |
| 50 - 75 % |
| 75 - 100 % |

#### pleisterwerk

| keuze |
| :---- |
| loszittend |
| verzand |
| cementpleister |
| gaten |

#### pleisterschade

| keuze |
| :---- |
| 0 - 25 % |
| 25 - 50 % |
| 50 - 75 % |
| 75 - 100 % |

#### scheuren

| keuze |
| :---- |
| 0 - 25 % |
| 25 - 50 % |
| 50 - 75 % |
| 75 - 100 % |

#### verfbeschadigingen

beschadiging in verf en onderliggende lagen

| keuze |
| :---- |
| 0 - 25 % |
| 25 - 50 % |
| 50 - 75 % |
| 75 - 100 % |

#### verkleuring

| keuze |
| :---- |
| 0 - 25 % |
| 25 - 50 % |
| 50 - 75 % |
| 75 - 100 % |


#### schade_opmerkingen

Nadere beschrijving schade

#### schade\_vastgesteld\_op

Datum, in formaat `dd-mm-jjjj`.


#### schade\_vastgesteld\_door

Wie heeft schade vastgesteld?


