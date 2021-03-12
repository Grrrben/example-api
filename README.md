# OA

## setup

### docker && compose

This is a dockerised app. 
Linked together with `compose`, so just run docker-compose up:

```
docker-compose up

# after changes in the dockerfile, use
docker-compose up --build
```

### access

The API is listening on port 8080. http://localhost:8080/

### endpoints

You can search for users, retrieving a list of repos:
- `http://localhost:8080/github/user/grrrben/`

Or search the code of a user, you will retrieve a list of hits
- `http://localhost:8080/github/user/grrrben/code/golang/`
- `http://localhost:8080/github/user/torvalds/code/idiot/`

## documentation

Done by swagger, using the OpenAPI standards. 
You can (re)create the json documentation with the following command:

```
./vendor/zircote/swagger-php/bin/openapi ./src -o swagger.json
```

The file is served when requesting `/`.

## testing

`phpunit` is installed in the php container.  
Run it with make from project root:

```
make phpunit 
```

## technical debt

- Swagger API docs should be created locally as the compose volume is not mounted yet when running the php Dockerfile
- not a MVC setup.
- there is (almost) no error handling, logging, monitoring. `var_dump` is your friend.
