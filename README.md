# OA

## setup

### docker && compose

This is a dockerised app. Just run docker-compose up:

```
docker-compose up
```

### Access

The API is listening on port 8080. http://localhost:8080/

### endpoints

You can search for users only, retrieving a list of repos:
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

- Swagger API docs should be created locally as the compose volume is not mounted yet when runnen the php Dockerfile
- phpunit8, ^9 is not yet compatible with the used PHP-FPM image
- there is (almost) no error handling, logging, monitoring. 
