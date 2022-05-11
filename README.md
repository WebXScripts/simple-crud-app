
# simple-crud-app

Simple crud application in Laravel to add/remove/modify/get records from Database.

I used JSON file from [here](https://raw.githubusercontent.com/dudeonthehorse/datasets/master/steam.games.json), maybe I will add some auth stuff to this in the future.


## Run Locally

```bash
  #Migrate
  php artisan migrate
  #Put default JSON file into Database
  php artisan db:seed --class=GamesSeeder
  #And start
  php artisan serve
```


## API Reference

Api returns everything in JSON.

#### Get all items

```http
  GET /api/v1/games
```

#### Get item

```http
  GET /api/v1/show${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |

#### Push item

```http
  POST /api/v1/push:${app_id}${name}...
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `app_id`      | `string` | **Required**. App_Id|
| `name`      | `string` | **Required**. Game name|
| `playtime_forever`      | `int` | Playtime in secs (default 0)|
| `img_icon_url`      | `string` | Game icon (default "default")|
| `img_logo_url`      | `string` | Game logo (default "default")|
| `has_community_visible_stats`      | `bool` | Visible stats (default false)|

#### Update item

```http
  POST /api/v1/update:${id}${app_id}...
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. ID in database|
| `app_id`      | `string` | App_Id|
| `name`      | `string` | Game name|
| `playtime_forever`      | `int` | Playtime in secs (default 0)|
| `img_icon_url`      | `string` | Game icon (default "default")|
| `img_logo_url`      | `string` | Game logo (default "default")|
| `has_community_visible_stats`      | `bool` | Visible stats (default false)|

#### Remove item

```http
  POST /api/v1/delete:${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `int` | **Required**. ID in database|


## Based on

 - [Laravel](https://github.com/laravel/laravel)

 ## Authors

- [@WebXScripts](https://github.com/WebXScripts)




