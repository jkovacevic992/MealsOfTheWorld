The application will return a json response with requested info.

Installation:
- configure .env
- run "composer install"
- Create database: php bin/console doctrine:database:create
- Run migrations = php bin/console doctrine:migrations:migrate
- Load fixtures = php bin/console doctrine:fixtures:load

Request example:
http://127.0.0.1:8000/meals?lang=en&with=ingredients,tags,category&per_page=2&page=3

lang = language parameter (accepts en and de). Fallback language if no translation is found is English

with = additional information parameter (can be ingredients, tags or category)

per_page = paginator parameter that tells us how many items per page should be displayed

page = paginator parameter that tells us which page we want

category = category ID parameter that returns all meals with the category ID

tags = list of tag IDs for filtering the result

diff_time = timestamp parameter. Response will return all the meals created after the timestamp

