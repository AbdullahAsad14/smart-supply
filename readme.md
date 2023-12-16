# Smart Supply API

## 📖 Project Description

This readme provides instructions on setting up and running the APIs for this Supply Smart project, which focuses on streamlining ingredient purchasing and box fulfillment.

## 💻 Technologies

- Framework: Laravel 6.0
- Language: PHP 7.2
- Database: MySQL 5.7
- Containerization: Docker

## 📲 API Endpoints

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
    "id": 4,
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
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "Chicken",
            "measure": "kg",
            "supplier": "Meat Shop",
            "created_at": "2023-12-15 14:21:05",
            "updated_at": "2023-12-15 14:21:05"
        },
        {
            "id": 2,
            "name": "Salt",
            "measure": "g",
            "supplier": "Supermarket",
            "created_at": "2023-12-15 14:21:05",
            "updated_at": "2023-12-15 14:21:05"
        }
    ],
    "first_page_url": "http://127.0.0.1:8080/api/ingredients?page=1",
    "from": 1,
    "last_page": 3,
    "last_page_url": "http://127.0.0.1:8080/api/ingredients?page=3",
    "next_page_url": "http://127.0.0.1:8080/api/ingredients?page=2",
    "path": "http://127.0.0.1:8080/api/ingredients",
    "per_page": 2,
    "prev_page_url": null,
    "to": 2,
    "total": 5
}
```


### 3. Create Recipe

`POST /recipes`

#### Request:
```json5
{
    "name": "Magic Recipe",  //String (required)
    "description": "Description of the magic recipe", //String (required)
    "ingredients": [
      {
        "id": 1, //Integer (required)
        "amount": 8.00 //Float (required)
      }, {
        "id": 2,
        "amount":1.00
      }
    ] //Array of Ingredients (required)
}
```
#### Response:
```json5
{
    "id": 3,
    "name": "Magic Recipe",
    "description": "Description of the magic recipe",
    "updated_at": "2023-12-15 20:51:27",
    "created_at": "2023-12-15 20:51:27",
}
```

### 4. List Recipes

`GET /recipes`

#### Query Parameters:
- **page**: Integer (optional)
- **limit**: Integer (optional)

#### Response:
```json5
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "Boiled Chicken",
            "description": "Boiled Chicken Recipe: Add water, boil chicken.",
            "created_at": "2023-12-15 14:21:05",
            "updated_at": "2023-12-15 14:21:05"
        },
        {
            "id": 2,
            "name": "Potato Chicken Salad",
            "description": "Potato Chicken Salad Recipe: Cut potato, add chicken, add salt.",
            "created_at": "2023-12-15 14:21:05",
            "updated_at": "2023-12-15 14:21:05"
        }
    ],
    "first_page_url": "http://127.0.0.1:8080/api/recipes?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8080/api/recipes?page=1",
    "next_page_url": null,
    "path": "http://127.0.0.1:8080/api/recipes",
    "per_page": 10,
    "prev_page_url": null,
    "to": 2,
    "total": 2
}
```

### 5. Create Box

`POST /boxes`

#### Request:
```json5
{
    "delivery_date": 1, //Date (required, needs future date)
    "recipe_ids": [ 1, 2 ] //Array of Recipes (required, max 4 recipes)
    
}
```
#### Response:
```json5
{
    "id": 3,
    "delivery_date": "2023-12-20",
    "updated_at": "2023-12-15 20:46:08",
    "created_at": "2023-12-15 20:46:08",
}
```

### 6. View Ingredients Required for Order

`GET /required-ingredients`

#### Query Parameters:
- **order_date**: Date (optional, should be a future date)
- **supplier**: String (optional)

#### Response:
```json5
[
    {
        "id": 1,
        "name": "Chicken",
        "measure": "kg",
        "supplier": "Meat Shop",
        "required_amount": "2.00"
    },
    {
        "id": 3,
        "name": "Potato",
        "measure": "pieces",
        "supplier": "Grocery Shop",
        "required_amount": "11.00"
    }
]
```

## ⚙️ Setting Up the Project

Clone the project repository from `https://github.com/abdullahasad14/smart-supply`. 

**Note**: If you face any permissions issue while running the following commands, add `sudo` at the start.

### With Docker

1) Make sure you have Docker and Docker Compose installed.
2) Run `cp .env.local .env` to create `.env` file locally. 
3) Run `./start.sh` to create docker containers. 
4) The APIs are now accessible at `http://localhost:8080/`.

### Without Docker

1) Make sure you have PHP, Composer and MySQL installed.
2) Run `composer install` to install all dependencies.
3) Run `cp .env.local .env` to create `.env` file.
4) Update `.env` file to reflect your local MySQL DB configs.
5) Run `php artisan migrate:refresh --seed` to create tables and seed data.
6) Run `php artisan serve --port=8080`.
7) The APIs are now accessible at `http://localhost:8080/`.

## 🧪 Running Tests
1) Run `docker exec -it smart-supply-app bash` to connect via docker container.
2) Run `vendor/bin/phpunit --testdox` to execute the unit/integration tests.
