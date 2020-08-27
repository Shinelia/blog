Project blog

**Install**

create .env.local<br/>
*Example .env.local:*
APP_ENV=dev
DATABASE_URL=mysql://username:password@ip/blog?serverVersion=mariadb-10.3.22

composer install<br/>
php bin/console do:da:cr <br/>
php bin/console do:mi:mi<br/>
npm install<br/>
npm run dev<br/>

**symfony serve to run**

--> add fixtures in database
use script : bin/hafilo.sh


**DISABLE_HTML5_VALIDATION disable validation in all forms**<br/>
If you want form validation to be disabled when you run tests, create an .env.test.local with:
*DISABLE_HTML5_VALIDATION=true*
