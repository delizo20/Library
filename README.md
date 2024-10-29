# Library API Documentation

This API provides access to a library database, allowing for user authentication and CRUD operations on authors, books, and their relationships.

## Table of Contents

- [Authentication](#authentication)
  - [User Registration](#user-registration)
  - [User Authentication](#user-authentication)
- [Authors](#authors)
  - [Add Author](#add-author)
  - [Get All Authors](#get-all-authors)
  - [Update Author](#update-author)
  - [Delete Author](#delete-author)
- [Books](#books)
  - [Add Book](#add-book)
  - [Get All Books](#get-all-books)
  - [Update Book](#update-book)
  - [Delete Book](#delete-book)
- [Book-Author Relationships](#book-author-relationships)
  - [Create Relationship](#create-relationship)
  - [Get All Relationships](#get-all-relationships)
  - [Delete Relationship](#delete-relationship)

---
## Endpoints
## Authentication

All endpoints except for `/user/register` and `/user/auth` require a JWT token passed in the request body as `token`. On successful authentication, each request returns a new access token.

### User Registration
**Endpoint**: `POST /user/register`
- **Body**: `{ "username": "rhuby", "password": "rdelizo20" }`
- **Response**:
  ```json
  {
    "status": "success",
    "data": null
  }

### User Authentication
**Endpoint**: `POST /user/auth`
- **Body**: `{ "username": "rhuby", "password": "rdelizo20" }`
- **Response**:
   ```json
  {
    "status": "success",
    "access_token": "jwt_token",
    "data": null
  }

### Create an Author
**Endpoint**: `POST POST /authors
- **Body**: `{ "username": "rhuby", "password": "rdelizo20" }`
- **Response**:
   ```json
  {
    "status": "success",
    "access_token": "jwt_token",
    "data": null
  }



