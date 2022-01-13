LWT with personal modifications

Cloned to https://github.com/chaosarium/lwt

The project is going again at https://github.com/HugoFara/lwt

This is @chaosarium's fork of [@PirtleShell's fork](https://github.com/pirtleshell/lwt) of [@andreask7's fork](https://github.com/andreask7/lwt). Its altered database structure makes it quicker, and it has many features not found in the original. It also looks more likely to develop communally, whereas the original is fairly stagnant and not open for contributions.

If the reading page displays a database error, try downgrading to PHP version 5.4.45.

[@gustavklopp's LingL](https://github.com/gustavklopp/LingL) is a wonderful alternative written in python.

**THIS IS A THIRD PARTY VERSION**
IT DIFFERS IN MANY RESPECTS FROM THE OFFICIAL LWT-VERSION

## What's in this version (chaosarium/lwt)

In brief, changes include:

- A new theme with a less distracting colour scheme
- Status distribution charts in log scale to improve readability
- Thinner frames for a more minimal look
- Bring back unknown word percentage
- Fix bulk new word lookup when translator is not set to google translate
- Disabled dictionary URI check to allow Mac users to use the built-in dictionary by setting the URI to `dict:///###`
- Disabled text to speech (I can't get it to work at all and it crashes the backend every time)

Note that this version uses MAMP configuration by default. To use other PHP environment, delete `connect.inc.php` and rename one of `connect_easyphp.inc.php` or `connect_wordpress.inc.php` or `connect_xampp.inc.php` to `connect.inc.php`

Unfortunately I haven't figured out a way to port LWT to a newer PHP version so PHP 5 is still required. Anyhow happy language learning.

---

Just an update of what may be added next:

- [ ] Reimplement text to speech using [say.js](https://github.com/Marak/say.js/)
- [ ] Add setting to toggle status chart scale
- [ ] Fix log scale to reflect the number 1 in status charts