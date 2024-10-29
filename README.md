# Library API Documentation

This API provides access to a library database, allowing for user authentication and CRUD operations on authors, books, and their relationships.

---

## Authentication

All endpoints except for `/user/register` and `/user/auth` require a JWT token passed in the request body as `token`. On successful authentication, each request returns a new access token.

## Endpoints

### User Registration
-**Endpoint**:  `127.0.0.1/library/public/user/register`
-**Method:** `POST`

Registers a new user in the system.

- **Body**:  `{ "username": "rDelizo", "password": "r123" }`
- **Response**:
  ```json
  {
    "status": "success",
    "data": null
  }

### User Authentication
**Endpoint**:  `127.0.0.1/library/public/auth`
**Method:** `POST`

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
**Endpoint**:  `127.0.0.1/library/public/authors`
**Method:** `POST`

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
**Endpoint**:  `127.0.0.1/library/public/authors/get`
**Method:** `GET`

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
**Endpoint**:  `127.0.0.1/library/public/update/{1}`
**Method:** `PUT`

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
**Endpoint**:  `127.0.0.1/library/public/authors/delete/{1}`
**Method:** `DELETE`

Deletes an author.

- **Body**:  `{"token": "your_jwt_token"}`
- **Response**:
  ```json
  {
    "status": "success",
    "message": "Author deleted successfully",
    "access_token": "new_jwt_token"
  }
