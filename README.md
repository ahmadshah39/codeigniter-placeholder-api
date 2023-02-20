# Project: Codeigniter Placeholder Api
Codeigniter Placeholder Api is a clone of json-placeholder-api by typicode and is an attempt to replicate all the resources provided by the original. The main goal is to demostrate how one can build such a backend api in php with proper exception/error handling and clean code that is self explanatory and follows modern php standard. I used the codeingniter 4 framework as it provides a minimal base structure the helps speed up the developement process.

# Instructions to run loacally
To the run this app locally you would need php 8.1 or above mysql 8 or above.
First clone the repository then duplicate .env-example to .env add you desired db credentials the run 
>```
> php spark migrate 
>```
to migrate the database tables
then run
>```
> php spark  db:seed DatabaseSeed
>``` 
then run 
>```
> php spark serve
>``` 
most likely your php server will be running on http://localhost:8080/
# 📁 Collection: User Resource 


## End-point: Get Users
The endpoint returns a collection of users based on the parameters provided and allows you to sort, query and paginate the results.
### Method: GET
>```
>http://localhost:8080/api/users
>```
### Query Params

|Param| Possible values|
|---|---|
|sort_by|id, user_name, first_name, last_name, email|
|sort|asc, desc|
|query|Search term|
|limit|10, 20, 30 ....|
|page|1,2,3 ....|


### Response: 200
```json
[
    {
        "id": 1,
        "user_name": "thalia.legros",
        "first_name": "Lori",
        "last_name": "Hills",
        "email": "clare62@ratke.com"
    },
    {
        "id": 2,
        "user_name": "breitenberg.dante",
        "first_name": "Maci",
        "last_name": "Larson",
        "email": "jeanie.mante@hotmail.com"
    },
   ....
]
```


#

## End-point: Get User
The endpoint returns a single user based on the id passed in the url.
### Method: GET
>```
>http://localhost:8080/api/users/1
>```
### Response: 200
```json
{
    "id": 1,
    "user_name": "thalia.legros",
    "first_name": "Lori",
    "last_name": "Hills",
    "email": "clare62@ratke.com"
}
```


#

## End-point: Create User
### Method: POST
>```
>http://localhost:8080/api/users
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "user_name": "admin",
    "first_name": "admin",
    "last_name": "super",
    "email": "admin@admin.com",
    "password": "123456",
    "confirm_password": "123456"
}
```


#

## End-point: Update User
### Method: PUT
>```
>http://localhost:8080/api/users/{{user_id}}
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "user_name": "admin",
    "first_name": "admin",
    "last_name": "super",
    "email": "admin@admin.com",
    "password": "123456",
    "confirm_password": "123456"
}
```


#

## End-point: Patch User
### Method: PATCH
>```
>http://localhost:8080/api/users/{{user_id}}
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "last_name": "superAdmin"
}
```


#

## End-point: Delete User
### Method: DELETE
>```
>http://localhost:8080/api/users/{{user_id}}
>```

#
# 📁 Collection: Album Resource 


## End-point: Get Albums
The endpoint returns a collection of albums based on the parameters provided and allows you to sort, query and paginate the results.
### Method: GET
>```
>http://localhost:8080/api/albums
>```
### Query Params

|Param|Possible values|
|---|---|
|sort_by|"id","title", 'user_id'|
|sort|asc, desc|
|query|search terms|
|limit|3|
|page|2|
|user_id|2|


### Response: 200
```json
[
    {
        "id": 1,
        "title": "Aut odit aliquam non ea.",
        "user_id": 1
    },
    {
        "id": 2,
        "title": "Possimus facere numquam omnis autem aliquid dolor.",
        "user_id": 1
    },
    {
        "id": 3,
        "title": "Quaerat quia velit suscipit quo officia.",
        "user_id": 1
    },
    ....
]
```


#

## End-point: Get Album
The endpoint returns a single album based on the id passed in the url.
### Method: GET
>```
>http://localhost:8080/api/albums/{{album_id}}
>```
### Response: 200
```json
{
    "id": 1,
    "title": "Aut odit aliquam non ea.",
    "user_id": 1
}
```


#

## End-point: Create Album
### Method: POST
>```
>http://localhost:8080/api/albums
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "title": "admin",
    "user_id": 1
}
```


#

## End-point: Update Album
### Method: PUT
>```
>http://localhost:8080/api/albums/{{album_id}}
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "title": "daht",
    "user_id":2
}
```


#

## End-point: Alter Album
### Method: PATCH
>```
>http://localhost:8080/api/albums/{{album_id}}
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "title": "superAdmin"
}
```


#

## End-point: Delete Album
### Method: DELETE
>```
>http://localhost:8080/api/albums/{{album_id}}
>```

#
# 📁 Collection: Todo Resource 


## End-point: Get Todos
The endpoint returns a collection of todos based on the parameters provided and allows you to sort, query and paginate the results.

### Method: GET
>```
>http://localhost:8080/api/todos
>```
### Query Params

|Param|Possible values|
|---|---|
|sort_by|'id', 'title', 'completed', 'user_id'|
|sort|asc, desc|
|query|vel|
|limit|10|
|page|1|


### Response: 200
```json
[
    {
        "id": 1,
        "title": "Explicabo iusto ut velit qui in architecto.",
        "completed": 0,
        "user_id": 1
    },
    {
        "id": 2,
        "title": "Enim ea quaerat earum et.",
        "completed": 0,
        "user_id": 1
    },
    {
        "id": 3,
        "title": "Facilis totam et atque.",
        "completed": 1,
        "user_id": 1
    },
]
```


#

## End-point: Get Todo
The endpoint returns a single todo based on the id passed in the url.
### Method: GET
>```
>http://localhost:8080/api/todos/{{todo_id}}
>```
### Response: 200
```json
{
    "id": 1,
    "title": "Explicabo iusto ut velit qui in architecto.",
    "completed": 0,
    "user_id": 1
}
```


#

## End-point: Create Todo
### Method: POST
>```
>http://localhost:8080/api/todos
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "title": "todo titile",
    "completed": 0,
    "user_id": 1
}
```


#

## End-point: Update Todo
### Method: PUT
>```
>http://localhost:8080/api/todos/{{todo_id}}
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "title": "todo titile",
    "completed": 1,
    "user_id": 1
}
```


#

## End-point: Alter Todo
### Method: PATCH
>```
>http://localhost:8080/api/todos/{{todo_id}}
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "title": "superAdmin todo"
}
```


#

## End-point: Delete Todo
### Method: DELETE
>```
>http://localhost:8080/api/todos/{{todo_id}}
>```

#
# 📁 Collection: Post Resource 


## End-point: Get Posts
The endpoint returns a collection of posts based on the parameters provided and allows you to sort, query and paginate the results.
### Method: GET
>```
>http://localhost:8080/api/posts
>```
### Query Params

|Param|Possible values|
|---|---|
|sort_by|'id', 'title', 'body', 'user_id'|
|sort|asc, desc|
|query|vel|
|limit|10|
|page|1|
|user_id|1|


### Response: 200
```json
[
    {
        "id": 1,
        "title": "Praesentium voluptatum omnis ex ducimus quae in fuga modi.",
        "body": "Et in quos sunt quasi dolor libero. Ut provident ad voluptatibus labore nam eum. Praesentium blanditiis est debitis saepe aperiam. Reiciendis ut vero omnis illum a ea accusamus eaque.",
        "user_id": 1
    },
    {
        "id": 2,
        "title": "Quidem neque quibusdam enim atque voluptas accusamus.",
        "body": "Voluptas ea recusandae cum architecto itaque aspernatur harum ut. Qui aut eum a soluta repellendus.",
        "user_id": 1
    },
    {
        "id": 3,
        "title": "Facilis eos illo laboriosam.",
        "body": "Velit quae possimus vel. Dolor ipsam odit in. Voluptas libero sunt molestias ut praesentium commodi voluptatem. Quaerat cumque est architecto eum perferendis.",
        "user_id": 1
    },
    
]
```


#

## End-point: Get Post
The endpoint returns a single post based on the id passed in the url.
### Method: GET
>```
>http://localhost:8080/api/posts/{{post_id}}
>```
### Response: 200
```json
{
    "id": 1,
    "title": "Praesentium voluptatum omnis ex ducimus quae in fuga modi.",
    "body": "Et in quos sunt quasi dolor libero. Ut provident ad voluptatibus labore nam eum. Praesentium blanditiis est debitis saepe aperiam. Reiciendis ut vero omnis illum a ea accusamus eaque.",
    "user_id": 1
}
```


#

## End-point: Create Post
### Method: POST
>```
>http://localhost:8080/api/posts
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "title": "admin",
    "body":"dataldfkjdkfjaf",
    "user_id": 1
}
```


#

## End-point: Update Post
### Method: PUT
>```
>http://localhost:8080/api/posts/{{post_id}}
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "title": "daht",
    "user_id":2
}
```


#

## End-point: Alter Post
### Method: PATCH
>```
>http://localhost:8080/api/posts/{{post_id}}
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "title": "superAdmin title"
}
```


#

## End-point: Delete Post
### Method: DELETE
>```
>http://localhost:8080/api/posts/{{post_id}}
>```

#
# 📁 Collection: Photo Resource 


## End-point: Get Photos
The endpoint returns a collection of photos based on the parameters provided and allows you to sort, query and paginate the results.

### Method: GET
>```
>http://localhost:8080/api/photos
>```
### Query Params

|Param|Possible values|
|---|---|
|sort_by|"id",'title', 'url', 'thumbnail_url', 'album_id'|
|sort|asc, desc|
|query|vel|
|limit|3|
|page|2|
|album_id|1|


### Response: 200
```json
[
    {
        "id": 1,
        "title": "Totam illo aliquid sit laudantium.",
        "url": "https://via.placeholder.com/600x600.png/00ff11?text=animals+quia",
        "thumbnail_url": "https://via.placeholder.com/150x150.png/00ff11?text=animals+quia",
        "album_id": 1
    },
    {
        "id": 2,
        "title": "Voluptates voluptates veritatis veritatis ut est maxime.",
        "url": "https://via.placeholder.com/600x600.png/005533?text=animals+impedit",
        "thumbnail_url": "https://via.placeholder.com/150x150.png/005533?text=animals+impedit",
        "album_id": 1
    },
    {
        "id": 3,
        "title": "Quis illum aut quaerat voluptates.",
        "url": "https://via.placeholder.com/600x600.png/006666?text=animals+quod",
        "thumbnail_url": "https://via.placeholder.com/150x150.png/006666?text=animals+quod",
        "album_id": 1
    },
    ....
]
```


#

## End-point: Get Photo
The endpoint returns a single photo based on the id passed in the url.
### Method: GET
>```
>http://localhost:8080/api/photos/{{photo_id}}
>```
### Response: 200
```json
{
    "id": 1,
    "title": "Totam illo aliquid sit laudantium.",
    "url": "https://via.placeholder.com/600x600.png/00ff11?text=animals+quia",
    "thumbnail_url": "https://via.placeholder.com/150x150.png/00ff11?text=animals+quia",
    "album_id": 1
}
```


#

## End-point: Create Photo
### Method: POST
>```
>http://localhost:8080/api/photos
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "title": "photaa ",
    "url": "https://via.placeholder.com/600x600.png/00ff11?text=animals+aqua",
    "thumbnail_url": "https://via.placeholder.com/150x150.png/00ff11?text=animals+aqua",
    "album_id": "1"
}
```


#

## End-point: Update Photo
### Method: PUT
>```
>http://localhost:8080/api/photos/{{photo_id}}
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "title": "aqua ",
    "url": "https://via.placeholder.com/600x600.png/00ff11?text=animals+aqua",
    "thumbnail_url": "https://via.placeholder.com/150x150.png/00ff11?text=animals+aqua",
    "album_id": "1"
}
```


#

## End-point: Alter Photo
### Method: PATCH
>```
>http://localhost:8080/api/photos/{{photo_id}}
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "title": "superAdmin aqua"
}
```


#

## End-point: Delete Photo
### Method: DELETE
>```
>http://localhost:8080/api/photos/{{photo_id}}
>```

#
# 📁 Collection: Comment Resource 


## End-point: Get Comments
The endpoint returns a collection of comments based on the parameters provided and allows you to sort, query and paginate the results.
### Method: GET
>```
>http://localhost:8080/api/comments
>```
### Query Params

|Param|Possible values|
|---|---|
|sort_by|title|
|sort|desc|
|query|vel|
|limit|3|
|page|2|
|post_id|1|


### Response: 200
```json
[
    {
        "id": 1,
        "name": "Jerrod Satterfield",
        "email": "ernser.rigoberto@corwin.net",
        "body": "Unde voluptas fugiat debitis quia distinctio. Ut omnis recusandae assumenda sed.",
        "post_id": 1
    },
    {
        "id": 2,
        "name": "Mr. Stevie Padberg",
        "email": "vdurgan@gmail.com",
        "body": "Temporibus perspiciatis voluptatem sit dolorem quia quia voluptatem. Maxime alias unde optio quasi.",
        "post_id": 1
    },
    {
        "id": 3,
        "name": "Ms. Joanny Gerlach",
        "email": "buck.okon@konopelski.com",
        "body": "Eos alias et saepe adipisci. Enim tempore animi quis quia sed. Qui at vel nesciunt qui animi.",
        "post_id": 1
    },
    ....
]
```


#

## End-point: Get Comment
The endpoint returns a single comment based on the id passed in the url.
### Method: GET
>```
>http://localhost:8080/api/comments/{{comment_id}}
>```
### Response: 200
```json
{
    "id": 1,
    "name": "Jerrod Satterfield",
    "email": "ernser.rigoberto@corwin.net",
    "body": "Unde voluptas fugiat debitis quia distinctio. Ut omnis recusandae assumenda sed.",
    "post_id": 1
}
```


#

## End-point: Create Comment
### Method: POST
>```
>http://localhost:8080/api/comments
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "title": "admin",
    "user_id": 1
}
```


#

## End-point: Update Comment
### Method: PUT
>```
>http://localhost:8080/api/comments/{{comment_id}}
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "title": "daht",
    "user_id":2
}
```


#

## End-point: Alter Comment
### Method: PATCH
>```
>http://localhost:8080/api/comments/{{comment_id}}
>```
### Headers

|Content-Type|Value|
|---|---|
|X-Requested-With|XMLHttpRequest|


### Headers

|Content-Type|Value|
|---|---|
|Content-Type|application/json|


### Body (**raw**)

```json
{
    "title": "superAdmin"
}
```


#

## End-point: Delete Comment
### Method: DELETE
>```
>http://localhost:8080/api/comments/{{comment_id}}
>```

#
