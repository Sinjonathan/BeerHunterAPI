Project
=======

BeerHunterAPI

Santoni Jonathan - Parant Benjamin - Sufiane Souissi


Clean install on production
===========================

git clone https://github.com/Sinjonathan/BeerHunterAPI.git
cd BeerHunterAPI/
composer install
rm -rf app/cache/*
rm -rf app/logs/*
HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs



The API Platform framework
==========================

This project use API Platform

The official project documentation is available **[on the API Platform website][1]**.

[1]: https://api-platform.com
