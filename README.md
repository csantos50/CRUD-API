# CRUD API

## Installation

Clone this repository and run Composer as follows:

```bash
git clone https://github.com/csantos50/CRUD-API.git

cd crud_api

composer install
```

## Run

```bash
composer serve
```
 You can then visit the site at http://localhost:8080/


## Endpoints

```bash
[get] '/v1/category/get-all/{name}'
[get] '/v1/category/get-all'
[get] '/v1/category/get/{id}'
[post] '/v1/category/create'
[post] '/v1/category/delete/{id}'
[post] '/v1/category/update/{id}'
```
Category example
```bash
    {
        "id": 1,
        "name": "Comida",
        "created": "2020-07-02 00:32:19",
        "modified": "2020-07-03 13:13:44"
    },
```