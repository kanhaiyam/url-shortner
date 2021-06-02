# URL Hash APP

Hi!
This is an API to generate a unique hash for every link.

### Application Architecture
The application is built on PHP using Laravel Framework and MySQL as Database.
I decided to use Laravel because it is a very feature rich framework and I have use it whenever possible to teach myself some of the concepts of Laravel. 

### Prerequisite
-   PHP >= 7.3
-   OpenSSL PHP Extension
-   PDO PHP Extension
-   Mbstring PHP Extension
-   Tokenizer PHP Extension
-   XML PHP Extension
-   Ctype PHP Extension
-   JSON PHP Extension


### Setup Instruction
 1. Open Terminal. Navigate to the directory you want to work from.
 2. Clone this repository.
 3. Now in the cloned repository type **`composer install`** and install all the dependencies. The project already has a compoer.lock file. Please use that file.
 4. Now create a database a new database for the project with any name.
 5. Set/Change the **`APP_URL`** and other database related changes in **`.env`** file.
 6. Migrate the schema from app. Execute **`php artisan migrate`**
 7. Seed the database to create the users for the App. Execute **`php artisan db:seed`**
 8. Install the laravel/passport for API authentication. Execute **`php artisan passport:install`**
 9. Start the server with **`php artisan serve`**
 
 *Any changes to the .env file will require a restart of the server*


### Register
You can register yourself as a user of this portal via /api/register API

``` 
curl --location --request POST '127.0.0.1:8000/api/register' \
--form 'email="admin1@test.com"' \
--form 'password="enigmaterm"' \
--form 'password_confirmation="enigmaterm"' \
--form 'name="Admin"'
```

### Login
To create a short url you have to first login and get the API Token for it

```
curl --location --request POST '127.0.0.1:8000/api/login'  \
--form 'email="admin@test.com"' \
--form 'password="enigma"'
```

From the response copy the **access_token** and click on the **Authorization** tab and select **Bearer Token** from the dropdown and paste the value of the **access_token** copied earlier:

### Sample Request For Link Generation

    curl --location --request POST '127.0.0.1:8000/api/link/generate' --header 'Content-Type: application/json'  --data-raw '{"link": "https://user-api.hirist.com/user/recruiter/73476/"}'

### Redirection
- All redirection by the application will be **302 Redirect**.
- To check if the link is working fine, you can try with *`ExampleLink`* from the Response.
- To redirect using custom URL, point the custom URL to the project and make an entry in *`routes/web.php`*. Please refer the example in the comments and it will be working perfectly.

## Database 
`link_master` - This table stores the link and the hash generated for the link.
`stats` - This table has all the data regarding the user who click on the link.