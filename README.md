# Library API Documentation

This API provides access to a library database, allowing for user authentication and CRUD operations on authors, books, and their relationships.

---

## Authentication

All endpoints except for `/user/register` and `/user/auth` require a JWT token passed in the request body as `token`. On successful authentication, each request returns a new access token.

## Endpoints

### User Registration
**Endpoint**:  `127.0.0.1/library/public/user/register`
**Method:** `POST`

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
 
