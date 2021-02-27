# A mail sender
Sending mails with base64 attachments

# Installation
- Clone the repo
- cd folder
- `composer i`
- `cp .env.example .env`
- open your `.env` file and set the database connection and the redis configrations and queue driver and mail settings
- run `php artisan migrate:fresh --seed`
- `php artiser serve` and open another terminal then run: `php artisan horizon`

# Testing
- create a database for testing and fill the database cerds in phpunit.xml
- `./vendor/bin/phpunit`

check the postman collection in the project dir `postman_collection.json`
