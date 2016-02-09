Project
=======

BeerHunterAPI

Santoni Jonathan - Parant Benjamin - Sufiane Souissi

M2 e-Services Lille 1

Require
=======

Require **[composer][1]**

Clean install
=============

| Description | Command |
| --- | --- |
| Clone the project | git clone https://github.com/Sinjonathan/BeerHunterAPI.git |
| Move into project | cd BeerHunterAPI/ |
| Install vendor | composer install |
| Change permissions | rm -rf app/cache/* |
| | rm -rf app/logs/* |
| | HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1` |
| | sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs |
| | sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs |
| Clear cache | php app/console cache:clear |
| Get the JWT key | mkdir -p app/var/jwt |
| | openssl genrsa -out app/var/jwt/private.pem -aes256 4096 |
| | openssl rsa -pubout -in app/var/jwt/private.pem -out app/var/jwt/public.pem |
| Start the server | php app/console server:start |


Test the API
===========

This API is online on beer.sinjo.xyz, you can test it with **[Postman][2]** without install the source.

A documentation for the API is available at **[beer.sinjo.xyz/doc][3]**.

Note :

All the request use parameters in raw format ( JSON ), except :

| Route |
| --- |
| /api/login_check |
| /post_user |
| /salt |
| /post_hunt_filter |

that use form-data parameters.


IMPORTANT NOTE (API SECURITY)
=============================

This API is protect by a session token provide by the **[LexikJWTAuthenticationBundle][5]**.

You can obtain a session token with the POST request :

http://beer.sinjo.xyz/api/login_check ( or http://localhost:8000/api/login_check in local )

and the parameters "_username" and "_password"

IMAGE POSTMAN

To use the token, add it in the request header "Authorization" preceded by the mention "Bearer"

IMAGE POSTMAN

You don't need the token for the requests :

| Route |
| --- |
| /api/login_check |
| /post_user |
| /salt |
| /post_hunt_filter |

All other requests needs the token.

The API Platform framework
==========================

This project use API Platform.

Thanks to it, all basics entities REST controller only needs to be declared in app/config/services.yml. They aren't generated, we can't show there.

The official project documentation is available **[on the API Platform website][4]**

[1]: https://getcomposer.org/
[2]: https://chrome.google.com/webstore/detail/postman/fhbjgbiflinjbdggehcddcbncdddomop
[3]: http://beer.sinjo.xyz/doc
[4]: https://api-platform.com
[5]: https://github.com/lexik/LexikJWTAuthenticationBundle
