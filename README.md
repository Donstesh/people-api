# People API Documentation

## Overview

This is a Laravel-based JSON:API compliant People API that provides mock
data without requiring a database. The API follows RESTful principles
and returns responses in JSON:API format.

## API Endpoints

### Base URL

    http://localhost:8000/api/v1

### 1. Get All People

`GET /peoples`

Returns a paginated list of all people.

#### Query Parameters

  Parameter   Type      Default   Description
  ----------- --------- --------- ----------------------------
  page        integer   1         Page number for pagination
  per_page    integer   3         Number of items per page

#### Example Request

    curl "http://localhost:8000/api/v1/peoples?page=2&per_page=3"

#### Example Response (200 OK)

``` json
{
  "data": [
    {
      "id": "4",
      "type": "people",
      "attributes": {
        "name": "Emily Davis",
        "email": "emily@example.com",
        "phone": "444-555-6666",
        "address": "321 Elm St, Houston, TX",
        "created_at": "2024-01-18T09:15:00Z",
        "updated_at": "2024-01-18T09:15:00Z"
      }
    },
    {
      "id": "5",
      "type": "people",
      "attributes": {
        "name": "Michael Wilson",
        "email": "michael@example.com",
        "phone": "777-888-9999",
        "address": "654 Birch Blvd, Phoenix, AZ",
        "created_at": "2024-01-19T14:45:00Z",
        "updated_at": "2024-01-19T14:45:00Z"
      }
    },
    {
      "id": "6",
      "type": "people",
      "attributes": {
        "name": "Sarah Brown",
        "email": "sarah@example.com",
        "phone": "111-222-3333",
        "address": "987 Cedar Ln, Philadelphia, PA",
        "created_at": "2024-01-20T16:20:00Z",
        "updated_at": "2024-01-20T16:20:00Z"
      }
    }
  ],
  "links": {
    "first": "http://localhost:8000/api/v1/peoples?page=1",
    "last": "http://localhost:8000/api/v1/peoples?page=4",
    "prev": "http://localhost:8000/api/v1/peoples?page=1",
    "next": "http://localhost:8000/api/v1/peoples?page=3"
  },
  "meta": {
    "current_page": 2,
    "from": 4,
    "last_page": 4,
    "path": "http://localhost:8000/api/v1/peoples",
    "per_page": 3,
    "to": 6,
    "total": 10
  }
}
```

### 2. Get Single Person

`GET /peoples/{id}`

Returns a single person by ID.

#### Path Parameters

  Parameter   Type      Description
  ----------- --------- -------------------
  id          integer   Person ID (1--10)

#### Example Request

    curl "http://localhost:8000/api/v1/peoples/1"

#### Example Response (200 OK)

``` json
{
  "data": {
    "id": "1",
    "type": "people",
    "attributes": {
      "name": "John Doe",
      "email": "john@example.com",
      "phone": "123-456-7890",
      "address": "123 Main St, New York, NY",
      "created_at": "2024-01-15T10:30:00Z",
      "updated_at": "2024-01-15T10:30:00Z"
    }
  }
}
```

#### Example Response (404 Not Found)

``` json
{
  "errors": [
    {
      "status": "404",
      "title": "Not Found",
      "detail": "The requested person does not exist."
    }
  ]
}
```

### 3. Create Person (Mock -- Returns 405)

`POST /peoples`

Example Response:

``` json
{ "error": "Method not supported with mock data" }
```

### 4. Update Person (Mock -- Returns 405)

`PUT/PATCH /peoples/{id}`

### 5. Delete Person (Mock -- Returns 405)

`DELETE /peoples/{id}`

## Mock Data

  ID   Name              Email
  ---- ----------------- ----------------------
  1    John Doe          john@example.com
  2    Jane Smith        jane@example.com
  3    Robert Johnson    robert@example.com
  4    Emily Davis       emily@example.com
  5    Michael Wilson    michael@example.com
  6    Sarah Brown       sarah@example.com
  7    David Miller      david@example.com
  8    Lisa Taylor       lisa@example.com
  9    Thomas Anderson   thomas@example.com
  10   Jennifer White    jennifer@example.com

## Response Format

### Success Response Structure

``` json
{
  "data": {
    "id": "string",
    "type": "people",
    "attributes": {
      "name": "string",
      "email": "string",
      "phone": "string",
      "address": "string",
      "created_at": "ISO8601 datetime",
      "updated_at": "ISO8601 datetime"
    }
  }
}
```

### Collection Response Structure

``` json
{
  "data": [],
  "links": {
    "first": "string",
    "last": "string",
    "prev": "string|null",
    "next": "string|null"
  },
  "meta": {
    "current_page": "integer",
    "from": "integer|null",
    "last_page": "integer",
    "path": "string",
    "per_page": "integer",
    "to": "integer|null",
    "total": "integer"
  }
}
```

### Error Response Structure

``` json
{
  "errors": [
    {
      "status": "HTTP status code",
      "title": "Error title",
      "detail": "Error description"
    }
  ]
}
```

## Installation & Setup

### Prerequisites

-   PHP 8.0+
-   Composer
-   Laravel 10+

### Installation Steps

    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan config:clear
    php artisan route:clear
    php artisan cache:clear
    php artisan serve

## Testing the API

### Using cURL

    curl "http://localhost:8000/api/v1/peoples?page=2&per_page=3"
    curl "http://localhost:8000/api/v1/peoples/1"

### Using Browser

-   http://localhost:8000/api/v1/peoples\
-   http://localhost:8000/api/v1/peoples/1

## Project Structure

    app/
    ├── Http/
    │   ├── Controllers/
    │   │   └── PeopleController.php
    │   └── Resources/
    │       ├── PeopleResource.php
    │       └── PeopleCollection.php
    ├── Models/
    │   └── People.php
    routes/
    └── api.php
