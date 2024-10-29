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

- **Endpoint:** `/user/register`
- **Method:** `POST`

Registers a new user in the system.

**Request Body:**
```json
{
  "username": "rdelizo05852",
  "password": "passDelizo"
}
