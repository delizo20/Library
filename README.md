# Library API Documentation

This API provides access to a library database, allowing for user authentication and CRUD operations on authors, books, and their relationships.

## Table of Contents
Authentication
User Registration
User Authentication
Authors
Add Author
Get All Authors
Update Author
Delete Author
Books
Add Book
Get All Books
Update Book
Delete Book
Book-Author Relationships
Create Relationship
Get All Relationships
Delete Relationship

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



