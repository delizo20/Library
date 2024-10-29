# Library API Documentation

This API provides access to a library database, allowing for user authentication and CRUD operations on authors, books, and their relationships.

---

## Authentication

All endpoints except for `/user/register` and `/user/auth` require a JWT token passed in the request body as `token`. On successful authentication, each request returns a new access token.

## Endpoints

### User Registration
**Method**: `POST`
**Endpoint**:  `127.0.0.1/library/public/user/register`

Registers a new user in the system.

- **Body**:  `{ "username": "rDelizo", "password": "r123" }`
- **Response**:
  ```json
  {
    "status": "success",
    "data": null
  }

### User Authentication
**Method:** `POST`
**Endpoint**:  `127.0.0.1/library/public/auth`

Authenticates a user and returns a JWT access token.

- **Body**:  `{ "username": "rDelizo", "password": "r123" }`
- **Response**:
  ```json
  {
    "status": "success",
    "access_token": "your_jwt_token",
    "data": null
  }

## Authors
### Add Author
**Method:** `POST`
**Endpoint**:  `127.0.0.1/library/public/authors`

Creates a new author in the library.

- **Body**:  `{ "name": "Rhuby Ann Delizo", "token": "your_jwt_token"}`
- **Response**:
  ```json
  {
    "status": "success",
    "message": "Author created successfully",
    "access_token": "new_jwt_token"
  }

### Get All Author
**Method:** `GET`
**Endpoint**:  `127.0.0.1/library/public/authors/get`

Retrieves a list of all authors.

- **Body**:  `{ "token": "your_jwt_token"}`
- **Response**:
  ```json
  {
    "status": "success",
  "message": "Authors retrieved successfully",
  "data": [
    {
      "authorid": 1,
      "name": "R.Delizo"
    }
  ],
  "access_token": "new_jwt_token"
  }

### Update Author
**Method:** `PUT`
**Endpoint**:  `127.0.0.1/library/public/authors/update/{1}`

Updates an author's details.

- **Body**:  `{ "name": "R.A.Delizo","token": "your_jwt_token"
}`
- **Response**:
  ```json
  {
    "status": "success",
    "message": "Author updated successfully",
    "access_token": "new_jwt_token"
  }

### Delete Author
**Method:** `DELETE`
**Endpoint**:  `127.0.0.1/library/public/authors/delete/{1}`

Deletes an author.

- **Body**:  `{"token": "your_jwt_token"}`
- **Response**:
  ```json
  {
    "status": "success",
    "message": "Author deleted successfully",
    "access_token": "new_jwt_token"
  }

## Books
### Add Book
**Method:** `POST`
**Endpoint**:  `127.0.0.1/library/public/books`

Adds a new book to the library.

- **Body**:  `{ "title": "Book Title","author_id": 1, "token": "your_jwt_token"}`
- **Response**:
  ```json
  {
    "status": "success",
    "message": "Book created successfully",
    "access_token": "new_jwt_token"
  }

### Get All Books
**Method:** `GET`
**Endpoint**:  `127.0.0.1/library/public/books/get`

Retrieves a list of all books.

- **Body**:  `{ "token": "your_jwt_token"}`
- **Response**:
  ```json
  {
    "status": "success",
  "message": "Books retrieved successfully",
  "data": [
    {
      "bookid": 1,
      "name": "A BEGINNER'S GUIDE TO THE STOCK MARKET"
      "authorid": 1
    }
  ],
  "access_token": "new_jwt_token"
  }

### Update Book
**Method:** `PUT`
**Endpoint**:  `127.0.0.1/library/public/books/update/{1}`

Updates an book's details.

- **Body**:  `{ "title": "STOCK MARKET","token": "your_jwt_token", "author_id": 1,
}`
- **Response**:
  ```json
  {
    "status": "success",
    "message": "Book updated successfully",
    "access_token": "new_jwt_token"
  }

### Delete Book
**Method:** `DELETE`
**Endpoint**:  `127.0.0.1/library/public/books/delete/{1}`

Deletes an author.

- **Body**:  `{"token": "your_jwt_token"}`
- **Response**:
  ```json
  {
    "status": "success",
    "message": "Book deleted successfully",
    "access_token": "new_jwt_token"
  }
