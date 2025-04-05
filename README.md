---

# Laravel Project - Race Condition

## Setup Instructions

## php: 8.4
## laravel: 12

### 1. Configure Environment Files

- Copy `.env.example` to `.env` and set your database connection credentials.
- Create a `.env.testing` file for the test environment and configure it similarly.

### 2. Run Migrations

```bash
php artisan migrate

3. Run Tests

php artisan test

4. Seed the Database

php artisan db:seed

After seeding, a token will be generated and printed in the terminal.

Save this token — it will be used for authentication in the API documentation.


5. Serve the Application

php artisan serve

Visit http://localhost:8000 in your browser.



---

API Documentation

After running the application, go to the home page where the Scramble / Dedoc API documentation is available.

Using the Seeded Token

1. In the documentation interface, enter the token you received after seeding.


2. Navigate to the Mock Times section.


3. Send a request and copy the returned id.


4. Go to the Mock Registration section and use the received id in the request.
