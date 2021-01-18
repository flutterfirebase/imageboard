## imageboard
Requires Docker as it uses Laravel Sail.
```bash
$ git clone https://github.com/teamreflex/imageboard.git
$ cp .env.example .env
$ docker run --rm -v $(pwd):/opt -w /opt laravelsail/php80-composer:latest composer install
$ ./vendor/bin/sail npm install
$ ./vendor/bin/sail npm run dev
$ ./vendor/bin/sail up -d
```
Application is now running at http://localhost