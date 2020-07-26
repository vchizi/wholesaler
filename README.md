# Wholesaler Integration
### Start application
Install dependencies
```
composer install
```
(if you have `php` lower version then `php7.4`)
```
composer install --ignore-platform-reqs
```

Build docker 
```
docker-compose build
```

Run application 
```
docker-compose up -d
```

Open in browser
 
[http://127.0.0.1:8085/](http://127.0.0.1:8085/)

Stop application
```
docker-compose down
```

### Tests
Run tests
```
docker-compose up -d && docker exec -it wholesaler-php vendor/bin/phpunit && docker-compose down
```
