#Twitter Stats Demo

Simple app allowing for periodic fetch, store and display of twitter account stats.
At the momemnt it's only capable of temporal storage of total number of followers and likes
as well as retweets per tweet.

##Requirement
 - Docker Engine
 - Docker Compose (for ease of use)

##Run it locally
(tested on ubuntu16.04)
 - Create a twitter app at: https://apps.twitter.com/
 - Clone this repo
 - run `bash composer.sh install` (in case of any error at later stage try with `update`)
 - export required env vars (you get tokens when you create a twitter app):
```
TWITTER_ACC_TOKEN=XYZ
TWITTER_KEY=XYZ
TWITTER_ACC_SEC=XYZ
TWITTER_SEC=XYZ

```
 - run `docker-compose up -d`
 - run `docker-compose exec php-fpm bin/console doc:dat:cr`
 - run `docker-compose exec php-fpm bin/console doc:sche:cr`
 - in your browser visit `127.0.0.1:9081/app_dev.php/`
 
**API requests can be made from sandbox in the docs - available at `127.0.0.1:9081/app_dev.php/api/docs`**

---
####Based on [Dockerised dev env with Symfony3](https://github.com/strayobject/dockercompose-symfonystandard)

####Contains:
 - Nginx
 - PHP 7.1 (FPM)
 - MariaDB 10.1
 - Redis
 - RabbitMQ
 - Postfix
 - Symfony Standard Edition v3.2


Semi-tested on Ubuntu 16.10
May still work on Windows 7

Pull requests welcomed, feel free to test and improve.
