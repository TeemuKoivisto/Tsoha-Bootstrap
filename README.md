# Opiskelijan Tilinpito -palvelu

Yleisiä linkkejä:

* [Linkki sovellukseeni](https://teekoivi.users.cs.helsinki.fi/tsoha/)
* [Linkki dokumentaatiooni](https://github.com/TeemuKoivisto/Tsoha-Bootstrap/blob/master/doc/dokumentaatio.pdf)
* [Linkki loginiin](https://teekoivi.users.cs.helsinki.fi/tsoha/login)
* [Linkki opiskelijaan](https://teekoivi.users.cs.helsinki.fi/tsoha/opiskelija)
* [Linkki adminiin](https://teekoivi.users.cs.helsinki.fi/tsoha/admin)
* [Linkki tilinäkymään](https://teekoivi.users.cs.helsinki.fi/tsoha/tilinakyma)

Kolmannen viikon esimerkit:

* [Listaus](https://teekoivi.users.cs.helsinki.fi/tsoha/tapahtumat)
* [Esittely](https://teekoivi.users.cs.helsinki.fi/tsoha/opiskelijat/1)
* [Lisäys](https://teekoivi.users.cs.helsinki.fi/tsoha/tapahtumat/new)

Neljännen viikon, käyttäjä: Repe salasana: 123:

* [Muokkaus ja poisto](https://teekoivi.users.cs.helsinki.fi/tsoha/tapahtumat)
* [Kirjautuminen](https://teekoivi.users.cs.helsinki.fi/tsoha/login)
* [Validointi lisäyksessä](https://teekoivi.users.cs.helsinki.fi/tsoha/tapahtumat/new)
* [Linkki käyttöohjeeseen](https://github.com/TeemuKoivisto/Tsoha-Bootstrap/blob/master/K%C3%84YTT%C3%96OHJE.md)

## Aihekuvaus

Aina välillä saattaa opiskelija huomata, että tili ammottaa tyhjyyttään eikä kukkarossakaan ole
sentin senttiä vaikka juuri opintorahat kilahtivat tilille. Siksi siis aiheenani on Tilinpito-palvelu,
jotta opiskelija voisi kirjata ylös omat menonsa ja tulonsa ja huomata minne ne rahat oikein katoavat.

Tarkoituksena siis on luoda palvelu, johon voi käyttäjä, Opiskelija, kirjata ylös tulojaan ja menojaan.
Niitä olisi mahdollista myös muokata automaattisesti, jolloin opintoraha kirjautuu automaattisesti joka
kuukausi kuten myös vaikka vuokranmaksu. (jos ei asu jo pahvilaatikossa)

Käyttäjäryhmiä on kolme: Satunnaisselaaja, Opiskelija ja Admin eli ylläpitäjä. Satunnaisselaaja voi
rekisteröityä sivulle, Opiskelija voi lisätä menojaan ja tulojaan sekä seurata ja tutkia niitä 
haluamillaan aikajaksoilla ja Admin voi poistaa rasittavia opiskelijoita sekä tarkastella kaikkien
rekisteröityneiden käyttäjien tietoja.

Toimintoja:

* Menon tai Tulon lisääminen, muokkaus ja poisto
* Tilinpidon selailu haluamalla ajanjaksolla
* Rekisteröityminen
* Sisään- ja uloskirjautuminen
* Käyttäjän poistaminen
* Kaikkien käyttäjien tarkastelu
