# Library API Documentation

This API allows users to manage a library database with users, authors, books, and book-author relationships. It also includes JWT-based authentication to secure specific endpoints.

## Setup
1. Clone the repository.
2. Install dependencies using `composer install`.
3. Configure database settings in the `$dbConfig` array.
4. Run the application with `php -S localhost:8080`.

## Authentication

All endpoints except for `/user/register` and `/user/auth` require a JWT token passed in the request body as `token`. On successful authentication, each request returns a new access token.
