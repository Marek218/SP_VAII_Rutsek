# PlayStation Games Tracker

Marek Rutšek

Študijná skupina: 5ZYI33

## Stručný opis projektu

PlayStation Games Tracker je webová aplikácia určená pre hráčov, ktorí si chcú jednoducho evidovať a spravovať svoju zbierku hier pre konzoly PlayStation.
Používateľ si môže pridávať hry do svojej osobnej zbierky a zaznamenávať informácie o danej hre, napríklad stav hrania (nehraná, rozohraná alebo dohraná) a spôsob vlastníctva (fyzicky alebo digitálne).

Aplikácia umožňuje aj vytváranie zoznamu želaní (Wishlist), do ktorého si používateľ môže ukladať hry, ktoré by si chcel v budúcnosti zaobstarať. 
Hlavným cieľom aplikácie je poskytnúť hráčom jednoduchý prehľad o hrách, ktoré vlastnia alebo si plánujú zaobstarať.

## Role v projekte

### Návštevník

Návštevníkom je každý, kto navštívi webovú aplikáciu bez registrácie alebo prihlásenia.
Návštevník môže prezerať katalóg hier, vyhľadávať hry a zobrazovať ich základné informácie.
Na správu vlastnej zbierky a zoznamu želaní sa musí návštevník zaregistrovať a prihlásiť.

### Registrovaný používateľ

Registrovaný používateľ je osoba, ktorá sa zaregistrovala a prihlásila do aplikácie.
Registrovaný používateľ môže spravovať svoju zbierku hier, meniť ich stav hrania alebo hodnotenie.
Zároveň môže pridávať a odstraňovať hry zo zoznamu želaní a upravovať svoj profil.

### Administrátor

Administrátor zodpovedá za správu katalógu hier. 
Môže pridávať, upravovať a odstraňovať hry, ako aj nahrávať a meniť obrázky obalov hier.
Taktiež má na starosti spravovanie informácií o vývojároch hier.

## Prípady použitia podľa rolí

### Návštevník

- Návštevník si prezrie katalóg PlayStation hier.
- Návštevník vyhľadá hru podľa názvu.
- Návštevník sa zaregistruje alebo prihlási do aplikácie, aby mohol spravovať svoju zbierku.

### Registrovaný používateľ

- Používateľ si pridá hru z katalógu do svojej zbierky.
- Používateľ upraví informácie o hre vo svojej zbierke, napríklad spôsob vlastníctva alebo stav hrania.
- Používateľ odstráni hru zo svojej zbierky.
- Používateľ si pridá hru do zoznamu želaní alebo ju z neho odstráni.
- Používateľ si zobrazí prehľad svojej zbierky a základné štatistiky o vlastnených hrách.
- Používateľ si zobrazí a upraví svoj profil.

### Administrátor

- Administrátor pridá novú hru do katalógu a vyplní jej základné informácie.
- Administrátor upraví alebo odstráni existujúcu hru z katalógu.
- Administrátor nahrá alebo zmení obrázok obalu hry.
- Administrátor pridá alebo odstráni vývojára.

## Plánované entity

### Používateľ

Entita uchováva údaje o používateľovi aplikácie.

- Atribúty: `id`, `username`, `email`, `password`, `role`
- Vzťahy: Používateľ vlastní práve jednu zbierku a práve jeden zoznam želaní

### Hra

Entita predstavuje jednu hru, ktorú si používatelia môžu prezerať a pridávať do svojej zbierky alebo zoznamu želaní.

- Atribúty: `id`, `name`, `release_year`, `cover_image`, `developer_id`, `description`
- Vzťahy: Hra môže byť súčasťou zbierok a zoznamov želaní viacerých používateľov. Každá hra má priradeného vývojára

### Zbierka

Entita predstavuje osobnú zbierku hier konkrétneho používateľa.

- Atribúty: `id`, `user_id`
- Vzťahy: Každá zbierka patrí jednému používateľovi. Prepojenie s jednotlivými hrami zabezpečuje tabuľka `collection_game`, 
          ktorá uchováva informácie o platforme, spôsobe vlastníctva, stave hrania, hodnotení a prípadnej poznámke.

### Zoznam želaní

Entita predstavuje osobný zoznam hier, ktoré si používateľ plánuje v budúcnosti kúpiť alebo pridať do svojej zbierky.

- Atribúty: `id`, `user_id`
- Vzťahy: Každý zoznam želaní patrí jednému používateľovi. Prepojenie s hrami bude zabezpečovať tabuľka `wishlist_game`, ktorá bude zaznamenávať dodatočné informácie, ako napríklad dátum pridania hry.

### Vývojár

Entita predstavuje spoločnosť, ktorá vytvorila danú hru.

- Atribúty: `id`, `name`, `description`
- Vzťahy: Jeden vývojár môže byť priradený k viacerým hrám.

## Vzťahy medzi entitami

- Používateľ – Zbierka (1:1): Každý používateľ má jednu osobnú zbierku.
- Hra – Zbierka (M:N): Jedna hra môže byť súčasťou viacerých zbierok a jedna zbierka môže obsahovať viacero hier.
- Používateľ – Zoznam želaní (1:1): Každý používateľ má jeden osobný zoznam želaní.
- Hra – Zoznam želaní (M:N): Používateľ si môže pridať do zoznamu želaní viacero hier a jedna hra môže byť v zoznamoch želaní viacerých používateľov.
- Vývojár – Hra (1:N): Jeden vývojár môže byť spojený s viacerými hrami, ktoré vytvoril.

## Hlavné stránky aplikácie

1. Domovská stránka – zobrazí používateľovi základný prehľad jeho zbierky, napríklad celkový počet vlastnených hier, počet dohraných hier, naposledy pridané hry do zoznamu a počet hier v zozname želaní.
2. Katalóg hier – umožní návštevníkom a používateľom prezerať a vyhľadávať PlayStation hry. Pri jednotlivých hrách bude možné zobraziť základné informácie a pridať ich do zbierky alebo zoznamu želaní.
3. Moja zbierka – zobrazí hry, ktoré používateľ vlastní. Umožní mu upravovať spôsob vlastníctva, stav hrania, hodnotenie a poznámky alebo odstrániť hru zo zbierky.
4. Profil používateľa – umožní používateľovi zobraziť a upraviť svoje profilové údaje.
5. Administrácia – umožní administrátorovi pridávať, upravovať a odstraňovať hry a vývojárov.

## Rozdelenie funkcionality

### Základné funkcie

- Registrácia a prihlásenie používateľov.
- Zobrazenie katalógu PlayStation hier.
- Vyhľadávanie hier v katalógu podľa názvu.
- Pridávanie hier do osobnej zbierky, úprava údajov o hrách v zbierke a ich odstraňovanie.
- Pridávanie hier do zoznamu želaní a ich odstraňovanie.
- Zobrazenie základných štatistík osobnej zbierky.
- Zobrazenie a úprava profilových údajov používateľa.
- Administrácia katalógu vrátane pridávania, úpravy a odstraňovania hier a vývojárov.
- Nahrávanie a zmena obrázkov obalov hier.

### Rozširujúce funkcie

- Rozšírené filtrovanie hier.
- Zobrazovanie podrobnejších štatistík.
- Upozornenie používateľa pri pridávaní hry do zbierky, ak ju už má v zozname želaní.
- Zobrazenie odporúčaných hier na základe používateľovej zbierky.
- Implementácia externého API pre získavanie informácií o hrách z externých zdrojov.