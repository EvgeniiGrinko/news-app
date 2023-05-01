

## About News Project

This News Website Project is created with PHP 8.1.18, Laravel 10.8.0, Vue 3.2.47, MySQL 8.0.32
and is simple CRUD consist of following functionality:
- creating/updating/deleting news (only admin),
- reading news (all),
- authorization with Laravel Sanctum (JWT),
- user registration,
- storing news and users' data


## Installing

Clone it.

Go to project folder.

Run "composer install" and "npm install" in CLI.

Set up .env file with the name of db, username and password, after that run: "php artisan migrate".

Run "php artisan tinker", after that execute "\App\Models\News::factory(100)->create()" to fill your db with news, then type "exit", hit Enter.

Start project by running "php artisan serve" and copy path, then run "npm run dev".

Also, be aware that only admin can create/update/delete news. To create admin record go to registration page and register, after that change column "is_admin" to 1 in db for corresponding user, then logout and login with this credentials.

Go to your browser and enter copied path.

## Thank You for time and hope to hear from You soon!

Thank you for considering contributing to Open Source! 

## Code of Conduct

In order to ensure that the Our community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
