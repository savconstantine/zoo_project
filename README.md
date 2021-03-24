# README #

To start the project run in terminal (docker is required) 
<code>
docker-compose up -d
</code>
after deployed project run 
<code>
docker-compose exec php-fpm composer install
</code>
to install dependencies 

### Api Documentation

# API

## Requests

### **GET** - /api/v1/animal/list

#### CURL

```sh
curl -X GET "http://localhost:7777/api/v1/animal/list" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "perPage"="1"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **perPage** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "1"
  ],
  "default": "1"
}
```

### **POST** - /api/v1/animal/new

#### CURL

```sh
curl -X POST "http://localhost:7777/api/v1/animal/new" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "name"="Scar" \
    --data-raw "type"="lion"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **name** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "Scar"
  ],
  "default": "Scar"
}
```
- **type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "lion"
  ],
  "default": "lion"
}
```

### **PATCH** - /api/v1/animal/edit

#### CURL

```sh
curl -X PATCH "http://localhost:7777/api/v1/animal/edit" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "animalID"="2" \
    --data-raw "name"="Alex" \
    --data-raw "type"="lion"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **animalID** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "2"
  ],
  "default": "2"
}
```
- **name** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "Alex"
  ],
  "default": "Alex"
}
```
- **type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "lion"
  ],
  "default": "lion"
}
```

### **DELETE** - /api/v1/animal/delete

#### CURL

```sh
curl -X DELETE "http://localhost:7777/api/v1/animal/delete" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "animalID"="7"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **animalID** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "7"
  ],
  "default": "7"
}
```

### **GET** - /api/v1/cage/list

#### CURL

```sh
curl -X GET "http://localhost:7777/api/v1/cage/list\
?perPage=10" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "perPage"="1"
```

#### Query Parameters

- **perPage** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "10"
  ],
  "default": "10"
}
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **perPage** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "1"
  ],
  "default": "1"
}
```

### **POST** - /api/v1/cage/new

#### CURL

```sh
curl -X POST "http://localhost:7777/api/v1/cage/new" \
    -H "Content-Type: multipart/form-data; charset=utf-8; boundary=__X_PAW_BOUNDARY__" \
    --data-raw "name"="cage number 5"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "multipart/form-data; charset=utf-8; boundary=__X_PAW_BOUNDARY__"
  ],
  "default": "multipart/form-data; charset=utf-8; boundary=__X_PAW_BOUNDARY__"
}
```

#### Body Parameters

- **name** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "cage number 5"
  ],
  "default": "cage number 5"
}
```

### **POST** - /api/v1/cage/add-animal

#### CURL

```sh
curl -X POST "http://localhost:7777/api/v1/cage/add-animal" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "cageID"="2" \
    --data-raw "animalID"="6"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **cageID** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "2"
  ],
  "default": "2"
}
```
- **animalID** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "6"
  ],
  "default": "6"
}
```

### **DELETE** - /api/v1/cage/remove-animal

#### CURL

```sh
curl -X DELETE "http://localhost:7777/api/v1/cage/remove-animal" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "cageID"="4" \
    --data-raw "animalID"="3"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **cageID** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "4"
  ],
  "default": "4"
}
```
- **animalID** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "3"
  ],
  "default": "3"
}
```

### **GET** - /api/v1/cage/info/1

#### CURL

```sh
curl -X GET "http://localhost:7777/api/v1/cage/info/1" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "$body"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **body** should respect the following schema:

```
{
  "type": "string",
  "default": ""
}
```

### **PATCH** - /api/v1/cage/edit

#### CURL

```sh
curl -X PATCH "http://localhost:7777/api/v1/cage/edit" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "cageID"="2" \
    --data-raw "name"="cage number 2 edited"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **cageID** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "2"
  ],
  "default": "2"
}
```
- **name** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "cage number 2 edited"
  ],
  "default": "cage number 2 edited"
}
```

### **DELETE** - /api/v1/cage/delete

#### CURL

```sh
curl -X DELETE "http://localhost:7777/api/v1/cage/delete" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "cageID"="5"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **cageID** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "5"
  ],
  "default": "5"
}
```

### **PATCH** - /api/v1/cage/clean

#### CURL

```sh
curl -X PATCH "http://localhost:7777/api/v1/cage/clean" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "cageID"="4"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **cageID** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "4"
  ],
  "default": "4"
}
```

### **POST** - /api/v1/action/new

#### CURL

```sh
curl -X POST "http://localhost:7777/api/v1/action/new" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "name"="летать"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **name** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "летать"
  ],
  "default": "летать"
}
```

### **DELETE** - /api/v1/action/delete

#### CURL

```sh
curl -X DELETE "http://localhost:7777/api/v1/action/delete" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "name"="летать"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **name** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "летать"
  ],
  "default": "летать"
}
```

### **GET** - /api/v1/action/list

#### CURL

```sh
curl -X GET "http://localhost:7777/api/v1/action/list" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "perPage"="1"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **perPage** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "1"
  ],
  "default": "1"
}
```

### **POST** - /api/v1/action/add-to-type

#### CURL

```sh
curl -X POST "http://localhost:7777/api/v1/action/add-to-type" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "nameAction"="летать" \
    --data-raw "nameType"="eagle"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **nameAction** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "летать"
  ],
  "default": "летать"
}
```
- **nameType** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "eagle"
  ],
  "default": "eagle"
}
```

### **DELETE** - /api/v1/action/remove-from-type

#### CURL

```sh
curl -X DELETE "http://localhost:7777/api/v1/action/remove-from-type" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "nameAction"="летать" \
    --data-raw "nameType"="eagle"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **nameAction** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "летать"
  ],
  "default": "летать"
}
```
- **nameType** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "eagle"
  ],
  "default": "eagle"
}
```

### **POST** - /api/v1/animal-type/new

#### CURL

```sh
curl -X POST "http://localhost:7777/api/v1/animal-type/new" \
    -H "Content-Type: multipart/form-data; charset=utf-8; boundary=__X_PAW_BOUNDARY__" \
    --data-raw "name"="какая то фигня"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "multipart/form-data; charset=utf-8; boundary=__X_PAW_BOUNDARY__"
  ],
  "default": "multipart/form-data; charset=utf-8; boundary=__X_PAW_BOUNDARY__"
}
```

#### Body Parameters

- **name** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "какая то фигня"
  ],
  "default": "какая то фигня"
}
```

### **DELETE** - /api/v1/animal-type/delete

#### CURL

```sh
curl -X DELETE "http://localhost:7777/api/v1/animal-type/delete" \
    -H "Content-Type: application/x-www-form-urlencoded; charset=utf-8" \
    --data-raw "name"="какая то фигня"
```

#### Header Parameters

- **Content-Type** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "application/x-www-form-urlencoded; charset=utf-8"
  ],
  "default": "application/x-www-form-urlencoded; charset=utf-8"
}
```

#### Body Parameters

- **name** should respect the following schema:

```
{
  "type": "string",
  "enum": [
    "какая то фигня"
  ],
  "default": "какая то фигня"
}
```

## References

