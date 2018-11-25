# Project
This project is a code generator for the Zend Framework 2, to generate the project skeleton the Resful architecture was used and the following packages are used to create the backend:
* zendframework / zendframework 3
* link / oauth2-client 2.3
* lcobucci / jwt 3.2
* doctrine / doctrine-module-0,10
* doctrine / doctrine-module 1.1
* zfr / zfr-cors 1

In creating the frontend was used Angular 5 together as the Material Bootstrap 4 the link to the layout can be found here:
* https://www.creative-tim.com/product/material-dashboard-angular2  
# What the `zf-restful-crud` do?
When started the `zf-restful-crud` generator suggests creating a project or pointing to an existing project, after that you can create your `Modules` and their `Entities`, and all the necessary files for the application to work will be created as based on the data provided.
# Install
You need install Yeoman e o generator.
```
npm i -g yo
```
```
npm i -g generator-zf-restful-crud
```
# Use
To use the generator you can entry into the path of the project (if the project already exist) or you create new project.
* If the project exists you must execute the following command line. 
```
cd <my-project>
```
To start generator you need only execute the command line following.
```
yo zf-restful-crud
```
# Project Structure 
The zend project will have the following structure.
```
|--client
|--config
|   |--autoload
|   |   |--doctrine_orm.global.php
|   |   |--global.php
|   |   |--README.md
|   |   |--zrf_cors.global.php
|   |--application.config.php
|--data
|   |--README.md
|--database
|   |--migration
|   |   |--README.md
|--module
|   |--Application
|   |   |--config
|   |   |   |--module.config.php
|   |   |   |--service.config.php
|   |   |--src
|   |   |   |--Controller
|   |   |   |   |--AppAbstractController.php
|   |   |   |   |--IndexController.php
|   |   |   |--Entity
|   |   |   |   |--AppAbstractEntity.php
|   |   |   |--Exceptions
|   |   |   |   |--AppAccessDeniedException.php
|   |   |   |--http
|   |   |   |   |--AppHttpResponse.php
|   |   |   |--Repository
|   |   |   |   |--AppInterfaceRepository.php
|   |   |   |--Service
|   |   |   |   |--AppAbstractEntityService.php
|   |   |   |--Module.php
|   |   |   |--test
|   |--<Your Modules>
|--public
|   |--css
|   |--fonts
|   |--img
|   |--js
|   |--.htaccess
|   |--index.php
|   |--web.config
|--composer.json
|--CONDUCT.md
|--CONTRIBUTING.md
|--docker-compose.yml
|--Dockerfile
|--LICENCE.md
|--phpcs.xml
|--phpunit.xml.dist
|--README.md
|--TODO.md
|--Vagrantfile
```