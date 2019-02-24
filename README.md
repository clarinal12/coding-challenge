# coding-challenge

## Setup

```bash
# install dependencies
Change your directory to coding-challenge-api and run 'composer install'
Change your directory to coding-challenge-webapp and run 'npm install'

# migrations and seeding
Change your directory to coding-challenge-api
Create a database called 'challenge' and update your .env variables according to your MySQL settings.
Run 'php artisan migrate'
Run 'php artisan db:seed --class=PassersSeeder'

# serve with hot reload
Change your directory to coding-challenge-api and run 'php artisan serve'
Change your directory to coding-challenge-webapp and run 'npm run dev'
```
