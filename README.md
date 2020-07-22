Projet blog


# create .env.local
composer install
php bin/console do:da:cr 
php bin/console do:mi:mi
npm install
npm run dev

# ou si vous utilisez yarn
# yarn install
# yarn encore dev

symfony serve to run


--> fixtures in database
use script : bin/hafilo.sh


Example .env.local:
APP_ENV=dev
DATABASE_URL=mysql://username:password@ip/blog?serverVersion=mariadb-10.3.22



DISABLE_HTML5_VALIDATION=false 

DISABLE_HTML5_VALIDATION disable validation in all forms

If you want form validation to be disabled when you run tests, create an .env.test.local with:
DISABLE_HTML5_VALIDATION=true
