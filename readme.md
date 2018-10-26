**News Wallet Api Documentation**

**Introduction**

This api is used to help in development of an app that saves articles read from various websites.

Through out this documentation,

- -- the terms "any one " refers to any person who has not logged  to the application and "Client" refers to a person who has not logged in to the application
- --Articles news articles  written in various websites
- --Categories are the classifications of these articles

The client can CREATE, UPDATE, and DELETE articles and categories.

The client can categorize the articles

Any one can READ my categories and articles

**Read All Categories**

Permission: Any one

Method Type: GET

Route :         /api/categories/all

Http Header parameters: None

Parameter: none

Success:

| Field | Type | Description |
| --- | --- | --- |
| Id | Integer | The category id |
| Title | String | The title of the category |
| Views | Integer | The number of times the category has been read |
| created\_at | DateTime | The date and time when it was created |
| updated\_at | DateTime | The date and time when the category was updated |

Example usage:

127.0.0.1:8000/api/categories/all

Example Response:

[

    {

        "id": 1,

        "title": "Category 1",

        "views": 1,

        "created\_at": "2018-10-26 08:03:31",

        "updated\_at": "2018-10-26 08:03:31"

    },

    {

        "id": 2,

        "title": "Category 2",

        "views": 5,

        "created\_at": "2018-10-26 08:04:33",

        "updated\_at": "2018-10-26 08:04:33"

    }

]

**Read one category**

Permission: Any one

Method Type: GET

Route : /api/categories/get/1/{id}

Http Header parameters: None

Parameter:

| Field | Type | Description |
| --- | --- | --- |
| Id | Integer | The id number of the category |

Success:

| Field | Type | Description |
| --- | --- | --- |
| Id | Integer | The category id |
| Title | String | The title of the category |
| Views | Integer | The number of times the category has been read |
| created\_at | DateTime | The date and time when it was created |
| updated\_at | DateTime | The date and time when the category was updated |

Example usage:

127.0.0.1:8000/api/categories/get/1

Example Response:

{

    "id": 1,

    "title": "Category 1",

    "views": 3,

    "created\_at": "2018-10-26 08:03:31",

    "updated\_at": "2018-10-26 10:42:49"

}

**Read popular categories**

Permission: Any one

Method Type: GET

Route: /api/categories/popular

Http Header parameters: None

Parameter: none

Success:

| Field | Type | Description |
| --- | --- | --- |
| Id | Integer | The category id |
| Title | String | The title of the category |
| Views | Integer | The number of times the category has been read |
| created\_at | DateTime | The date and time when it was created |
| updated\_at | DateTime | The date and time when the category was updated |

Example usage:

127.0.0.1:8000/api/categories/popular

Example Response:

[

    {

        "id": 1,

        "title": "Category 1",

        "views": 1,

        "created\_at": "2018-10-26 08:03:31",

        "updated\_at": "2018-10-26 08:03:31"

    },

    {

        "id": 2,

        "title": "Category 2",

        "views": 5,

        "created\_at": "2018-10-26 08:04:33",

        "updated\_at": "2018-10-26 08:04:33"

    }

]

**Get articles in a category**

Permission: Any one

Method Type: GET

Route: /api/categories/{id}/articles/

Http Header parameters: None

Parameter:

| Field | Type | Description |
| --- | --- | --- |
| Id | Integer | The id of the category |



Success:

| Field | Type | Description |
| --- | --- | --- |
| Id | Integer | The id of the article |
| Title | String | The title of the article |
| Author | String | The name of the author of the article |
| website\_name | String | The name of the website where the article was posted  |
| webUrl | String | The url of the website where the article was posted |
| brief\_description | String | The excerpt of the article |
| category\_id | Integer | The id of the category of the article |
| views | Integer | The number of times that the article is viewed |
| created\_at | DateTime | The date and time when it was created |
| updated\_at | DateTime | The date and time when the article was updated |
|   |   |   |

Example usage:

127.0.0.1:8000/api/categories/popular

Example response:

[

    {

        "id": 4,

        "title": "Article 1",

        "image": "www.myurl.com/images/image.jpg",

        "author": "Ann Doe",

        "website\_name": "Another Webistes",

        "webUrl": "www.myurl.com",

        "brief\_description": "this is my brief description",

        "category\_id": 2,

        "views": 0,

        "created\_at": "2018-10-26 09:37:23",

        "updated\_at": "2018-10-26 09:37:23"

    },

    {

        "id": 5,

        "title": "Another Article",

        "image": null,

        "author": "Ann Doe",

        "website\_name": "Another Webistes",

        "webUrl": "www.myurl.com",

        "brief\_description": "this is my brief description",

        "category\_id": 2,

        "views": 0,

        "created\_at": "2018-10-26 12:07:39",

        "updated\_at": "2018-10-26 12:07:39"

    }

]

**Create a new category**

Permission: Client

Method Type: POST

Route: /api/categories/create

Http Header parameters:

Content-type: multipart/form-data

Authorization: Bearer <AccessToken>

Parameter:

| Field | Type | Description |
| --- | --- | --- |
| title | String | The title of the category |

Success:

| Field | Type | Description |
| --- | --- | --- |
| status | String | The status of the operation. Possible outcome: "success" or "error" |
| status\_code | Integer | The code of the status of the operation |
| message | String | The message response regarding the operation |
| data | JSON array | The output data. Shows the properties of the new created category |
| title | String | The title of the new created category |
| updated\_at | Datetime | The timestamp of when the category was updated |
| created\_at | Datetime | The timestamp of when the category was updated |
| id | Integer | The id of the new created category |



Example usage:

127.0.0.1:8000/api/categories/create/

Example response:

{

    "status": "success",

    "status\_code": 201,

    "message": "Category Created",

    "data": {

        "title": "Another Article",

        "updated\_at": "2018-10-26 12:34:04",

        "created\_at": "2018-10-26 12:34:04",

        "id": 3

    }

}

**Update category**

Permission: Client

Method Type: POST

Route: /api/categories/update

Http Header parameters:

Content-type: multipart/form-data

Authorization: Bearer <AccessToken>

Parameter:

| Field | Type | Description |
| --- | --- | --- |
| title | String | The title of the category |
| Id | Integer | The id of the category that you want to update |
| title | String | The title of the category |

Success:

| Field | Type | Description |
| --- | --- | --- |
| status | String | The status of the operation. Possible outcome: "success" or "error" |
| status\_code | Integer | The code of the status of the action |
| message | String | The message response regarding the action |
| data | JSON array | The output data. Shows the properties of the updated category |
| title | String | The title of the updated category |
| updated\_at | Datetime | The timestamp of when the category was updated |
| created\_at | Datetime | The timestamp of when the category was updated |
| id | Integer | The id of the updated category |

Example usage:

127.0.0.1:8000/api/categories/update/

Example response:

{

    "status": "success",

    "status\_code": 201,

    "message": "Saved successfully",

    "data": {

        "id": 3,

        "title": "Updated  Category",

        "views": 0,

        "created\_at": "2018-10-26 12:34:04",

        "updated\_at": "2018-10-26 12:57:42"

    }

}

**Delete a category**

Permission: Client

Method Type: GET

Route: /api/categories/delete/{id}

Http Header parameters:

Content-type: multipart/form-data

Authorization: Bearer <AccessToken>

Parameter:

| Field | Type | Description |
| --- | --- | --- |
| Id | Integer | The id of the category that you want to update |

Response:

| Field | Type | Description |
| --- | --- | --- |
| status | String | The status outcome of the action. Possible outputs "success" or "error" |
| Data | JSON array | null |

Example usage:

127.0.0.1:8000/api/categories/delete/1

Example response:

{

    "status": "success",

    "status\_code": 200,

    "message": "Deleted",

    "data": null

}

**Get all articles**

Permission: Any one

Method Type: GET

Route: /api/articles/all

Http Header parameters: none

Parameter:none

Response:

| Field | Type | Description |
| --- | --- | --- |
| id | Integer | The id of the article |
| title | String | The title of the article |
| image | string | The name of the featured image |
| author | String | The name of the article aiuthor |
| website\_name | String | The name of the website where the article was posted |
| webUrl | String | The url of the website where the article was posted |
| brief\_description | String | An excerpt of the article |
| category\_id | integer | The id of the category of the article |
| views | Integer | The number of times the article has been viewed |
| created\_at | DateTime | The timestamp of when the article was created |
| updated\_at | DateTime | The timestamp of when the article was updated |

Example usage:

127.0.0.1:8000/api/articles/all

Example response:

[

    {

        "id": 4,

        "title": "Another Article",

        "image": null,

        "author": "Ann Doe",

        "website\_name": "Another Webistes",

        "webUrl": "www.myurl.com",

        "brief\_description": "this is my brief description",

        "category\_id": 2,

        "views": 0,

        "created\_at": "2018-10-26 09:37:23",

        "updated\_at": "2018-10-26 09:37:23"

    },

    {

        "id": 5,

        "title": "Another Article",

        "image": null,

        "author": "Ann Doe",

        "website\_name": "Another Webistes",

        "webUrl": "www.myurl.com",

        "brief\_description": "this is my brief description",

        "category\_id": 2,

        "views": 0,

        "created\_at": "2018-10-26 12:07:39",

        "updated\_at": "2018-10-26 12:07:39"

    }

]

**Get popular articles**

Permission: Any one

Method Type: GET

Route: /api/articles/popular

Http Header parameters: none

Parameter: none

Response:

| Field | Type | Description |
| --- | --- | --- |
| id | Integer | The id of the article |
| title | String | The title of the article |
| image | string | The name of the featured image |
| author | String | The name of the article author |
| website\_name | String | The name of the website where the article was posted |
| webUrl | String | The url of the website where the article was posted |
| brief\_description | String | An excerpt of the article |
| category\_id | integer | The id of the category of the article |
| views | Integer | The number of times the article has been viewed |
| created\_at | DateTime | The timestamp of when the article was created |
| updated\_at | DateTime | The timestamp of when the article was updated |

Example usage:

127.0.0.1:8000/api/articles/popular

Example response:

[

    {

        "id": 4,

        "title": "Another Article",

        "image": null,

        "author": "Ann Doe",

        "website\_name": "Another Webistes",

        "webUrl": "www.myurl.com",

        "brief\_description": "this is my brief description",

        "category\_id": 2,

        "views": 0,

        "created\_at": "2018-10-26 09:37:23",

        "updated\_at": "2018-10-26 09:37:23"

    },

    {

        "id": 5,

        "title": "Another Article",

        "image": null,

        "author": "Ann Doe",

        "website\_name": "Another Webistes",

        "webUrl": "www.myurl.com",

        "brief\_description": "this is my brief description",

        "category\_id": 2,

        "views": 0,

        "created\_at": "2018-10-26 12:07:39",

        "updated\_at": "2018-10-26 12:07:39"

    }

]

**Get paginated articles**

Permission: Any one

Method Type: GET

Route: /api/articles/paginate

Http Header parameters: none

Parameter: none

Response:

| Field | Type | Description |
| --- | --- | --- |
| current\_page | Integer | The  page number of the output |
| data | JSON Array | The data output of all the articles in the page |
| id | Integer | The id of the article |
| title | String | The title of the article |
| image | string | The name of the featured image |
| author | String | The name of the article author |
| website\_name | String | The name of the website where the article was posted |
| webUrl | String | The url of the website where the article was posted |
| brief\_description | String | An excerpt of the article |
| category\_id | integer | The id of the category of the article |
| views | Integer | The number of times the article has been viewed |
| created\_at | DateTime | The timestamp of when the article was created |
| updated\_at | DateTime | The timestamp of when the article was updated |
| id |   |   |
| first\_page\_url | String | The link to the first page of the output   |
| from | Integer | The index of the first output |
| last\_page | Integer | The index of the last page of the out put |
| last\_page\_url | String | The link to the last page of the output |
| next\_page\_url | String | The link to the next page of the output |
| path | String | The link to the homepage of the output |
| per\_page | Integer | The total number of articles displayed in a page |
| prev\_page\_url | String | The link to the previous page of the output |
| to | Integer | The last index of the output displayed in this page |
| total | Integer | The total number of the items from the database |

Example usage:

127.0.0.1:8000/api/articles/paginate

Example outcome:

{

    "current\_page": 1,

    "data": [

        {

            "id": 4,

            "title": "Another Article",

            "image": null,

            "author": "Ann Doe",

            "website\_name": "Another Webistes",

            "webUrl": "www.myurl.com",

            "brief\_description": "this is my brief description",

            "category\_id": 2,

            "views": 0,

            "created\_at": "2018-10-26 09:37:23",

            "updated\_at": "2018-10-26 09:37:23"

        },

        {

            "id": 5,

            "title": "Another Article",

            "image": null,

            "author": "Ann Doe",

            "website\_name": "Another Webistes",

            "webUrl": "www.myurl.com",

            "brief\_description": "this is my brief description",

            "category\_id": 2,

            "views": 0,

            "created\_at": "2018-10-26 12:07:39",

            "updated\_at": "2018-10-26 12:07:39"

        }

    ],

    "first\_page\_url": "http://127.0.0.1:8000/api/articles/paginate?page=1",

    "from": 1,

    "last\_page": 1,

    "last\_page\_url": "http://127.0.0.1:8000/api/articles/paginate?page=1",

    "next\_page\_url": null,

    "path": "http://127.0.0.1:8000/api/articles/paginate",

    "per\_page": 10,

    "prev\_page\_url": null,

    "to": 2,

    "total": 2

}

**Read a single article**

Permission: Any one

Method Type: GET

Route:  /api/articles/get/{id}

Http Header parameters: none

Parameters:

| Field | Type | Description |
| --- | --- | --- |
| id | Integer | The id of the article |

Response:

| Field | Type | Description |
| --- | --- | --- |
| id | Integer | The id of the article |
| title | String | The title of the article |
| image | string | The name of the featured image |
| author | String | The name of the article author |
| website\_name | String | The name of the website where the article was posted |
| webUrl | String | The url of the website where the article was posted |
| brief\_description | String | An excerpt of the article |
| category\_id | integer | The id of the category of the article |
| views | Integer | The number of times the article has been viewed |
| created\_at | DateTime | The timestamp of when the article was created |
| updated\_at | DateTime | The timestamp of when the article was updated |

Example usage

127.0.0.1:8000/api/articles/get/4

Example response:

{

    "id": 4,

    "title": "Another Article",

    "image": null,

    "author": "Ann Doe",

    "website\_name": "Another Webistes",

    "webUrl": "www.myurl.com",

    "brief\_description": "this is my brief description",

    "category\_id": 2,

    "views": 1,

    "created\_at": "2018-10-26 09:37:23",

    "updated\_at": "2018-10-26 14:25:50"

}

**Read the number of views an article has**

Permission: Any one

Method Type: GETs

Route:  /api/articles/{id}/views

Http Header parameters: none

Parameters:

| Field | Type | Description |
| --- | --- | --- |
| id | Integer | The id of the article |

Success response:

| Field | Type | Description |
| --- | --- | --- |
| status | String | The status of the action, Possible response, "success" or "rror" |
| status\_code | Integer | The status code of the response |
| message | String | The response message |
| data | Integer | The number of views found |

Example usage:

127.0.0.1:8000/api/articles/4/views

Example response:

{

    "status": "success",

    "status\_code": 200,

    "message": "Views found",

    "data": 1

}

**Create an article**

Permission: Client

Method Type: POST

Route:  /api/articles/create

Http Header parameters:

Content-type: multipart/form-data

Authorization: Bearer <AccessToken>

Parameter

| Field | Type | Description |
| --- | --- | --- |
| title | String | The title of the article |
| image | string | The name of the featured image |
| author | String | The name of the article author |
| website\_name | String | The name of the website where the article was posted |
| webUrl | String | The url of the website where the article was posted |
| brief\_description | String | An excerpt of the article |
| category\_id | integer | The id of the category of the article |

Success response:

| Field | Type | Description |
| --- | --- | --- |
| status | String | The status response. |
| status\_code | integer | The status response code of the operation |
| message | String | The response message of the operation |
| data | JSON array | The data response of the newly created article |
| id | Integer | The id of the article |
| title | String | The title of the article |
| image | string | The name of the featured image |
| author | String | The name of the article author |
| website\_name | String | The name of the website where the article was posted |
| webUrl | String | The url of the website where the article was posted |
| brief\_description | String | An excerpt of the article |
| category\_id | integer | The id of the category of the article |
| views | Integer | The number of times the article has been viewed |
| created\_at | DateTime | The timestamp of when the article was created |
| updated\_at | DateTime | The timestamp of when the article was updated |
|   |   |   |

Example usage:

127.0.0.1:8000/api/articles/create

Example response:

{

    "status": "success",

    "status\_code": 201,

    "message": "Article Created",

    "data": {

        "title": "The latest article",

        "website\_name": "East african post",

        "webUrl": "www.myurl.com",

        "brief\_description": "this is my brief description",

        "category\_id": "2",

        "author": "Sammy Doe",

        "updated\_at": "2018-10-26 14:54:45",

        "created\_at": "2018-10-26 14:54:45",

        "id": 8

    }

}

**Update an article**

Permission: Client

Method Type: POST

Route:  /api/articles/update

Http Header parameters:

Content-type: multipart/form-data

Authorization: Bearer <AccessToken>

Parameter

| Field | Type | Description |
| --- | --- | --- |
| title | String | The title of the article |
| image | string | The name of the featured image |
| author | String | The name of the article author |
| website\_name | String | The name of the website where the article was posted |
| webUrl | String | The url of the website where the article was posted |
| brief\_description | String | An excerpt of the article |
| category\_id | integer | The id of the category of the article |
| id | Integer | The id of the article to be updated |

Success response:

| Field | Type | Description |
| --- | --- | --- |
| status | String | The status response. |
| status\_code | integer | The status response code of the operation |
| message | String | The response message of the operation |
| data | JSON array | The data response of the updated article |
| id | Integer | The id of the article |
| title | String | The title of the article |
| image | string | The name of the featured image |
| author | String | The name of the article author |
| website\_name | String | The name of the website where the article was posted |
| webUrl | String | The url of the website where the article was posted |
| brief\_description | String | An excerpt of the article |
| category\_id | integer | The id of the category of the article |
| views | Integer | The number of times the article has been viewed |
| created\_at | DateTime | The timestamp of when the article was created |
| updated\_at | DateTime | The timestamp of when the article was updated |
|   |   |   |

Example usage:

127.0.0.1:8000/api/articles/update

Example response:

{

    "status": "success",

    "status\_code": 201,

    "message": "Saved successfully",

    "data": {

        "id": 4,

        "title": "The updated article",

        "image": null,

        "author": "Sammy Doe",

        "website\_name": "East african post",

        "webUrl": "www.myurl.com",

        "brief\_description": "this is my brief description",

        "category\_id": "2",

        "views": 1,

        "created\_at": "2018-10-26 09:37:23",

        "updated\_at": "2018-10-26 15:11:53"

    }

}

**Delete article**

Permission: Client

Method Type: GET

Route:  /api/articles/delete/{id}

Http Header parameters:

Content-type: multipart/form-data

Authorization: Bearer <AccessToken>

Parameter:

| Field | Type | Description |
| --- | --- | --- |
| Id | Integer | The id of the article |
|   |   |   |

Response:

| Field | Type | Description |
| --- | --- | --- |
| status | String | The status of the response |
| status\_code | Integer | The status code of the task |
| message | integer | The response message |

Example usage:

127.0.0.1:8000/api/articles/delete/1

Example response:

{

    "status": "success",

    "status\_code": 200,

    "message": "Deleted",

    "data": null

}

**Login user/ get access token**

Permission: any one

Method Type: POST

Route:  /api/login

Http Header parameters: none

Parameters:

| Field | Type | Description |
| --- | --- | --- |
| email | string | The email of the user |
| password | String | The password of the user |

Success:

| Field | Type | Description |
| --- | --- | --- |
| status | String | The status of the operation |
| status\_code | Integer | The status code of the operation performed |
| message | String | The response message of the task performed |
| data | JSON array | The response data after login |
| token | String | The JWT authorization code generated after login. Used in http headers to authorize the client to update, delete and create |

Example usage:

127.0.0.1:8000/api/login

Example response:

{

    "status": "success",

    "status\_code": 201,

    "message": "success",

    "data": {

       "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTU0MDU3MDg1OCwiZXhwIjoxNTQwNTc0NDU4LCJuYmYiOjE1NDA1NzA4NTgsImp0aSI6InA3Q2dVblhFUkh6VndRWEsiLCJzdWIiOjE0LCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.XwsVdeIXIP186Cgt69Q\_4b-8sq4jxN\_P4jg9t2oeat8"

    }

}

**Register user**

Permission: any one

Method Type: POST

Route:  /api/login

Http Header parameters: none

Parameters:

| Field | Type | Description |
| --- | --- | --- |
| name | String | The name of the person who wants to register |
| email | String | the email of the person who wants to register |
| password | String | The password of the person who wants to register |
|   |   |   |