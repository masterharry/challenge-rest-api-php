# Challenge Rest API PHP

I have implemented a simple application which works with REST APIs.

## Getting Started

Copy or Download Files to get started on your local machine

### Prerequisites

What things you need to install the software and how to install them

```
You need two things to run on your local machine,
- Mysql
- Wamp/Xampp Server
```

## Running the tests

Explain how to run the tests for the system

### Create User API Call

The API allows the client to create a user object with a request like this.

```
Call : http://localhost/UAPI/users/
Method : POST
Post Json Row Data 
{
  "name": "hiren1",
  "role": "bar"
}

```

### Get User List By Role

The API allows the client to retrieve a user object given its Role


```
Call : http://localhost/UAPI/users/?role=foo
Method : GET
```

### Get User List by ID

The API allows the client to retrieve a user object given its ID

```
Call http://localhost/UAPI/users/977e3f5b-6a70-4862-9ff8-96af4477272a
Method : GET
```