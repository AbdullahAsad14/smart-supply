## About Smart Supply

This readme provides instructions on setting up and running the APIs for this Supply Smart project, which focuses on streamlining ingredient purchasing and box fulfillment.

## Technologies

- Framework: Laravel 6.0
- Language: PHP 7.2
- Database: MySQL 5.7
- Containerization: Docker

## API Endpoints

This service implements the following REST HTTP endpoints:

### 1. Create Ingredient 

 `POST /ingredients`

#### Request:
```json5
{
    "name": "Potato", //String (required)
    "measure": "pieces", //String (required)
    "supplier": "Supermarket" //String (required)
}
```
#### Response: 
```json5
{
    "id": 1,
    "name": "Potato",
    "measure": "pieces",
    "supplier": "Supermarket",
    "updated_at": "2023-12-15 14:56:29",
    "created_at": "2023-12-15 14:56:29"
}
```


### 2. List Ingredients

`GET /ingredients`

#### Query Parameters:
- **page**: Integer (optional)
- **limit**: Integer (optional)

#### Response:
```json5
[
  {
      "id": 1,
      "name": "Potato",
      "measure": "pieces",
      "supplier": "Supermarket",
      "updated_at": "2023-12-15 14:56:29",
      "created_at": "2023-12-15 14:56:29",
  }, 
  {
      "id": 2,
      "name": "Potato",
      "measure": "pieces",
      "supplier": "Supermarket",
      "updated_at": "2023-12-15 14:56:29",
      "created_at": "2023-12-15 14:56:29",
  }
]
```


### 3. Create Recipe

`POST /recipes`

#### Request:
```json5
{
    "name": "Potato Salad",  //String (required)
    "description": "", //String (required)
    "ingredients": [ //Array of Ingredients (required)
      {
        "ingredient_id": 1, //Integer (required)
        "amount": 8 //Float (required)
      }
    ]
}
```
#### Response:
```json5
{
  "id": 1,
  "name": "Potato",
  "measure": "pieces",
  "supplier": "Supermarket",
  "updated_at": "2023-12-15 14:56:29",
  "created_at": "2023-12-15 14:56:29"
}
```

### 4. List Recipes

`GET /recipes`

#### Query Parameters:
- **page**: Integer (optional)
- **limit**: Integer (optional)

#### Response:
```json5
[
    {
        "id": 1,
        "name": "Potato",
        "measure": "pieces",
        "supplier": "Supermarket",
        "updated_at": "2023-12-15 14:56:29",
        "created_at": "2023-12-15 14:56:29",
    },
    {
        "id": 2,
        "name": "Potato",
        "measure": "pieces",
        "supplier": "Supermarket",
        "updated_at": "2023-12-15 14:56:29",
        "created_at": "2023-12-15 14:56:29",
    }
]
```

### 5. Create Box

`POST /boxes`

#### Request:
```json5
{
    "delivery_date": 1, //Date (required, needs future date)
    "recipe_ids": [ //Array of Recipies (required, max 4 recipies)
        1, 2
    ]
    
}
```
#### Response:
```json5
{
    "id": 1,
    "name": "Potato",
    "measure": "pieces",
    "supplier": "Supermarket",
    "updated_at": "2023-12-15 14:56:29",
    "created_at": "2023-12-15 14:56:29"
}
```

### 6. View Ingredients Required for Order

`GET /required-ingredients`

#### Query Parameters:
- **order_date**: Date (required, needs future date within 7 days)
- **supplier**: String (optional)

#### Response:
```json5
{
    "id": 1,
    "name": "Potato",
    "measure": "pieces",
    "supplier": "Supermarket",
    "updated_at": "2023-12-15 14:56:29",
    "created_at": "2023-12-15 14:56:29"
}
```

## Setting Up the Project
1) Clone the project repository from https://github.com/abdullahasad14/smart-supply. 
2) Make sure you have Docker and Docker Compose installed. 
3) Run composer install to install PHP dependencies. 
4) Run php artisan migrate to create and migrate database tables. 
5) Edit .env file with your database credentials and other environment variables. 
6) Run docker-compose up -d to start all services (database and API). 
7) The API is accessible at http://localhost:8080/ (you can change the port in the code).

## Running Tests (Bonus)
1) Run php artisan test to execute the unit/integration tests.
