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

- **Endpoint:** `127.0.0.1/library/public/user/register`
- **Method:** `POST`

Registers a new user in the system.

**Request Body:**
```json
{
  "username": "rdelizo05852",
  "password": "passDelizo"
}
**Response:**
```json
{
  "status": "success",
  "data": null
}

### User Authentication

- **Endpoint:** `127.0.0.1/library/public/user/auth`
- **Method:** `POST`

Authenticates a user and returns a JWT access token.

**Request Body:**
```json
{
  "username": "rdelizo05852",
  "password": "passDelizo"
}
**Response:**
```json
{
  "status": "success",
  "access_token": "your_jwt_token",
  "data": null
}

## Authors
### Add Author
- **Endpoint:** `127.0.0.1/library/public/authors`
- **Method:** `POST`

Creates a new author in the library.

**Request Body:**
```json
{
  "name": "R.Delizo",
  "token": "your_jwt_token"
}
**Response:**
```json
{
  "status": "success",
  "message": "Author created successfully",
  "access_token": "new_jwt_token"
}

### Get All Authors
- **Endpoint:** `127.0.0.1/library/public/authors/get`
- **Method:** `GET`

Retrieves a list of all authors.

**Request Body:**
```json
{
  "token": "your_jwt_token"
}
**Response:**
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
- **Endpoint:** `127.0.0.1/library/public/update/{1}`
- **Method:** `PUT`

Updates an author's details.

**Request Body:**
```json
{
  "name": "R.Delizo",
  "token": "your_jwt_token"
}
**Response:**
```json
{
  "status": "success",
  "message": "Author updated successfully",
  "access_token": "new_jwt_token"
}

### Delete Author
- **Endpoint:** `127.0.0.1/library/public/authors/delete/{1}`
- **Method:** `DELETE`

Deletes an author.

**Request Body:**
```json
{
  "token": "your_jwt_token"
}

**Response:**
```json
{
  "status": "success",
  "message": "Author deleted successfully",
  "access_token": "new_jwt_token"
}







