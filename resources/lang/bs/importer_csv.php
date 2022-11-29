<?php
return array (
  'seo' =>
  array (
    'upload' => 'Nadzorna ploča - Otpremanje CSV datoteke - :site_name',
    'csv-data-index' => 'Nadzorna ploča - CSV historija otpremanja - :site_name',
    'csv-data-edit' => 'Nadzorna ploča - Raščlani CSV podatke - :site_name',
    'item-index' => 'Nadzorna ploča - Uvoz unosa - :site_name',
    'item-edit' => 'Nadzorna ploča - Uredi uvoz uvoza - :site_name',
  ),
  'alert' =>
  array (
    'upload-success' => 'Datoteka je uspješno prenesena',
    'upload-empty-file' => 'Otpremljena datoteka ima prazan sadržaj',
    'fully-parsed' => 'CSV datoteka je u potpunosti raščlanjena, ne može se ponovno raščlaniti',
    'parsed-success' => 'Podaci CSV datoteke uspješno su raščlanjeni na privremenu bazu podataka popisa, idite na Izbornik bočne trake> Alati> Uvoznik> Unos za početak konačnog uvoza',
    'csv-file-deleted' => 'CSV datoteka je izbrisana iz memorije poslužiteljske datoteke',
    'import-item-updated' => 'Uvoz podataka o popisu je uspješno ažuriran',
    'import-item-deleted' => 'Uvoz podataka o popisu uspješno je izbrisan',
    'import-process-success' => 'Podaci o listi su uspješno uvezeni na listu web lokacija',
    'import-process-error' => 'Došlo je do greške prilikom obrade uvoza, za detalje provjerite dnevnik pogrešaka',
    'import-all-process-completed' => 'Uvoz svih uvrštenih procesa završen',
    'import-item-cannot-edit-success-processed' => 'Ne možete uređivati informacije o listi uvoza koje su uspješno uvezene',
    'import-process-completed' => 'Proces uvoza završen',
    'import-process-no-listing-selected' => 'Odaberite popise prije početka postupka uvoza',
    'import-process-no-categories-selected' => 'Odaberite jednu ili više kategorija prije početka postupka uvoza',
    'import-listing-process-in-progress' => 'U toku, sačekajte završetak',
    'delete-import-listing-process-no-listing-selected' => 'Molimo odaberite liste prije početka postupka brisanja',
  ),
  'sidebar' =>
  array (
    'importer' => 'Uvoznik',
    'upload-csv' => 'Otpremi CSV',
    'upload-history' => 'Istorija otpremanja',
    'listings' => 'Popisi',
  ),
  'show-upload' => 'Otpremite CSV datoteku',
  'show-upload-desc' => 'Ova stranica vam omogućuje prijenos CSV datoteke i raščlanjivanje na neobrađene podatke s popisa za uvoz u kasnijim koracima.',
  'csv-for-model' => 'CSV datoteka za',
  'csv-for-model-listing' => 'Spisak',
  'choose-csv-file' => 'Odabrati datoteku',
  'choose-csv-file-help' => 'vrsta datoteke za podršku: csv, txt, maksimalna veličina: 10mb',
  'upload' => 'Otpremi',
  'csv-skip-first-row' => 'Preskoči prvi red',
  'filename' => 'Ime dokumenta',
  'progress' => 'Analiziran napredak',
  'uploaded-at' => 'Otpremljeno u',
  'model-for' => 'Model',
  'import-csv-data-index' => 'Povijest prijenosa CSV datoteka',
  'import-csv-data-index-desc' => 'Ova stranica prikazuje sve učitane CSV datoteke i njihov raščlanjeni napredak.',
  'parse' => 'Raščlani',
  'import-csv-data-edit' => 'Analizirajte podatke CSV datoteke',
  'import-csv-data-edit-desc' => 'Ova stranica vam omogućava raščlanjivanje podataka CSV datoteke koju ste prenijeli.',
  'start-parse' => 'Započnite raščlanjivanje',
  'import-csv-data-parse-error' => 'Došlo je do greške. Ponovo učitajte stranicu da biste nastavili raščlanjivati preostale redove.',
  'parsed-percentage' => 'raščlanjeno :parsed_count od :total_count zapisa',
  'column' => 'Kolona',
  'column-item-title' => 'naslov popisa',
  'column-item-slug' => 'popis puža',
  'column-item-address' => 'adresa popisa',
  'column-item-city' => 'popis grada',
  'column-item-state' => 'stanje popisa',
  'column-item-country' => 'popis zemlje',
  'column-item-lat' => 'popis lat',
  'column-item-lng' => 'listing lng',
  'column-item-postal-code' => 'popis poštanskog broja',
  'column-item-description' => 'opis popisa',
  'column-item-phone' => 'popis telefona',
  'column-item-website' => 'popis web stranica',
  'column-item-facebook' => 'listing facebook',
  'column-item-twitter' => 'listing twitter',
  'column-item-linkedin' => 'spisak linkedin',
  'column-item-youtube-id' => 'listing youtube id',
  'delete-file' => 'Izbriši datoteku',
  'csv-file' => 'CSV datoteka',
  'import-errors' =>
  array (
    'user-not-exist' => 'Korisnik ne postoji',
    'item-status-not-exist' => 'Uvrštavanje mora biti u statusu podnesenog, objavljenog ili obustavljenog',
    'item-featured-not-exist' => 'Istaknuti unos mora biti da ili ne',
    'country-not-exist' => 'Država ne postoji, dodajte zemlju u Lokacija> Država> Dodaj zemlju',
    'state-not-exist' => 'Država ne postoji, dodajte državu u Lokacija> Država> Dodaj državu',
    'city-not-exist' => 'Grad ne postoji, dodajte grad u Lokacija> Grad> Dodaj grad',
    'item-title-required' => 'Naslov unosa je obavezan',
    'item-description-required' => 'Opis unosa je obavezan',
    'item-postal-code-required' => 'Potreban je poštanski broj',
    'categories-required' => 'Popis mora biti dodijeljen jednoj ili više kategorija',
    'import-item-cannot-process-success-processed' => 'Ne možete obraditi informacije o popisu uvoza koje su uspješno uvezene',
  ),
  'import-listing-index' => 'Uvozne liste',
  'import-listing-index-desc' => 'Ova stranica prikazuje sve raščlanjene podatke popisa iz CSV datoteke. To su sirovi podaci s popisa, koji su spremni za uvoz na unose na web lokacijama.',
  'import-listing-status-not-processed' => 'Nije obrađeno',
  'import-listing-status-success' => 'Obrađeno uspjehom',
  'import-listing-status-error' => 'Obrađeno s greškom',
  'import-listing-order-newest-processed' => 'Najnovije obrađeno',
  'import-listing-order-oldest-processed' => 'Najstarije obrađeno',
  'import-listing-order-newest-parsed' => 'Najnovije raščlanjeno',
  'import-listing-order-oldest-parsed' => 'Najstarije raščlanjeno',
  'import-listing-order-title-a-z' => 'Naslov (AZ)',
  'import-listing-order-title-z-a' => 'Naslov (ZA)',
  'import-listing-order-city-a-z' => 'Grad (AZ)',
  'import-listing-order-city-z-a' => 'Grad (ZA)',
  'import-listing-order-state-a-z' => 'Država (AZ)',
  'import-listing-order-state-z-a' => 'Država (ZA)',
  'import-listing-order-country-a-z' => 'Država (AZ)',
  'import-listing-order-country-z-a' => 'Država (ZA)',
  'select' => 'Odaberite',
  'import-listing-title' => 'Naslov',
  'import-listing-city' => 'Grad',
  'import-listing-state' => 'Država',
  'import-listing-country' => 'Country',
  'import-listing-status' => 'Status',
  'import-listing-detail' => 'Detalj',
  'import-listing-slug' => 'Slug',
  'import-listing-address' => 'Adresa',
  'import-listing-lat' => 'Latitude',
  'import-listing-lng' => 'Zemljopisna dužina',
  'import-listing-postal-code' => 'Poštanski broj',
  'import-listing-description' => 'Opis',
  'import-listing-phone' => 'Telefon',
  'import-listing-website' => 'Web stranica',
  'import-listing-facebook' => 'Facebook',
  'import-listing-twitter' => 'Twitter',
  'import-listing-linkedin' => 'LinkedIn',
  'import-listing-youtube-id' => 'Youtube Id',
  'import-listing-do-not-parse' => 'NE RAZBIJATI',
  'import-listing-source' => 'Izvor',
  'import-listing-source-csv' => 'Učitavanje CSV datoteke',
  'import-listing-error-log' => 'Evidencija grešaka',
  'import-listing-edit' => 'Uredi uvoz uvoza',
  'import-listing-edit-desc' => 'Ova stranica vam omogućava uređivanje podataka o listi uvoza, kao i obradu pojedinačnih informacija o listi uvoza na listu web lokacija.',
  'import-listing-information' => 'Uvezite informacije o listi',
  'choose-import-listing-preference' => 'Uvoz na popis',
  'choose-import-listing-categories' => 'Odaberite jednu ili više kategorija',
  'choose-import-listing-owner' => 'Vlasnik unosa',
  'choose-import-listing-status' => 'Status unosa',
  'choose-import-listing-featured' => 'Listing Featured',
  'import-listing-button' => 'Uvezi odmah',
  'choose-import-listing-preference-selected' => 'Uvezi odabrano na popis',
  'import-listing-selected-button' => 'Uvoz odabran',
  'import-listing-selected-modal-title' => 'Uvoz odabranih popisa',
  'import-listing-selected-total' => 'Ukupno za uvoz',
  'import-listing-selected-success' => 'Uspjeh',
  'import-listing-selected-error' => 'Greška',
  'import-listing-per-page-10' => '10 redova',
  'import-listing-per-page-25' => '25 redova',
  'import-listing-per-page-50' => '50 redova',
  'import-listing-per-page-100' => '100 redova',
  'import-listing-per-page-250' => '250 redova',
  'import-listing-per-page-500' => '500 redova',
  'import-listing-per-page-1000' => '1000 redova',
  'import-listing-select-all' => 'Označi sve',
  'import-listing-un-select-all' => 'Poništi odabir svih',
  'csv-parse-in-progress' => 'U toku je raščlanjivanje CSV datoteke, sačekajte da se završi',
  'error-notify-modal-close-title' => 'Greška',
  'error-notify-modal-close' => 'Zatvori',
  'csv-file-upload-listing-instruction' => 'Upute',
  'csv-file-upload-listing-instruction-columns' => 'Stupci za popis: naslov, puž (opcija), adresa (opcija), grad, država, država, geografska širina (opcija), dužina (opcija), poštanski broj, opis, telefon (opcija), web stranica (opcija), facebook (opcija) ), twitter (opcija), linkedin (opcija), youtube id (opcija).',
  'csv-file-upload-listing-instruction-tip-1' => 'Iako će postupak raščlanjivanja CSV datoteka pokušati najbolje pogoditi, pobrinite se da se naziv grada, države i države podudara s podacima o lokaciji (bočna traka> Lokacija> država, država, grad) vašeg web mjesta.',
  'csv-file-upload-listing-instruction-tip-2' => 'Ako je vaša web lokacija domaćin zajedničkom hostingu, pokušajte svaki put prenijeti CSV datoteku s manje od 15 000 redaka kako biste izbjegli maksimalno vrijeme prekoračenja pogreške.',
  'csv-file-upload-listing-instruction-tip-3' => 'Molimo grupirajte CSV datoteke po kategorijama radi praktičnosti. Na primjer, restorani u jednoj CSV datoteci pod nazivom restaurant.csv, a hoteli u drugoj CSV datoteci pod nazivom hotel.csv.',
  'import-listing-delete-selected' => 'Izbriši odabrano',
  'import-listing-delete-progress' => 'Brisanje ... sačekajte',
  'import-listing-delete-progress-deleted' => 'obrisano',
  'import-listing-delete-complete' => 'Gotovo',
  'import-listing-delete-error' => 'Došlo je do greške, ponovo učitajte stranicu da biste nastavili brisati preostale zapise.',
  'import-listing-import-button-progress' => 'Uvoz ... pričekajte',
  'import-listing-import-button-complete' => 'Gotovo',
  'import-listing-import-button-error' => 'Došlo je do greške, ponovo učitajte stranicu da biste nastavili s uvozom preostalih zapisa.',
  'import-listing-markup' => 'Oznaka',
  'import-listing-markup-help' => 'Dajte neke riječi koje će se razlikovati od ostalih grupa datoteka',
  'import-listing-markup-all' => 'Sve nadoknade',
);