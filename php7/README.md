# Gilded Rose Refactoring Kata by Alex Gemmell using PHP v7.3

This project was forked from https://github.com/emilybache/GildedRose-Refactoring-Kata.
 
I updated the PHP7 folder to use Docker so that there's no need to run PHP locally. 

My refactored solution to this Gilded Rose kata can be found at [./src/GildedRose.php](./src/GildedRose.php)

See commit history for each refactored step. 

## Docker Container Management

Build the PHP container or restart it the container was in a stopped state
```
> docker-compose up -d
```

Stop the container (does not remove the container volume)
```
> docker-compose stop 
```

Start a previously stopped container
```
> docker-compose start 
```

Stop and remove the container volume (will get built again when `docker-composer up -d` is run)
```
> docker-compose down
```

Rebuild the container (required if any of the Dockerfiles have been changed)
```
> docker-compose up -d --build
```

### Run commands in Docker
```
> docker exec <container name/ID> <command to run>
```

## Install PHP Composer Packages
```
> docker exec -it agemmell-gilded-rose composer install
```

## Run Tests
```
> docker exec -it agemmell-gilded-rose php vendor/bin/phpunit
```

## Debugging PHP
For some reason xdebug will not connect to PHPStorm using the host IP address that docker creates (e.g. 192.168.192.1).

A solution on MacOS is to create an alias IP to your host machine's localhost and tell xdebug to use that IP.
The php docker config expects this IP to be `10.254.254.254`.  
(You can set it to whatever you want but just be sure to update the php docker config and rebuild the box) 
```
> sudo ifconfig lo0 alias 10.254.254.254
```

You can verify this alias IP is attached to your `lo0` device by inspecting the output when running `ifconfig` on your host machine:
```
> ifconfig
```

Enable xdebug on the php docker box:
```
(from outside the container)
> docker exec -it agemmell-gilded-rose ./toggle-xdebug
PHP Xdebug Enabled & OPcache Disabled!

(from inside the container)
> /var/www/app/toggle-xdebug
PHP Xdebug Disabled & OPcache Enabled!
```