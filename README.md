# Library API Documentation

This API provides access to a library database, allowing for user authentication and CRUD operations on authors, books, and their relationships.

---

## Authentication

All endpoints except for `/user/register` and `/user/auth` require a JWT token passed in the request body as `token`. On successful authentication, each request returns a new access token.

## Endpoints

### User Registration
**Endpoint**: `POST /user/register`
- **Body**:  `{ "username": "rDelizo", "password": "r123" }`
- **Response**:
  ```json
  {
    "status": "success",
    "data": null
  }
