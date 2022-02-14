
### 1.Project1

## Deployment steps:
- composer install
- edit .env file and add database connection.
- php artisan db:wipe (To remove all tables)
- php artisan db:seed (to re-execute this command you need re-execute previous command).

## URLS
- all the users which are active (users table) and have an Austrian citizenship
  http://project1.test/api/users
- EDIT USER:  http://project1.test/api/users/7/edit
- DELETE USER 
  - with details
  http://project1.test/api/users/7/delete
  - without details:
  http://project1.test/api/users/2/delete

### Unit Test
- execute command:
   php artisan test

