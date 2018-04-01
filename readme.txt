Project Name:MyStore

Purpose:This application allows users to buy products and manage their accounts

Steps to setupon local machine:

1.clone fashionstore project from github 
2.From the DB_backup folder import mystore.sql file on your local mysql database
2.using cmd on local machine go to project folder
3.run composer install
4.open .env file and change database credentials DB_DATABASE(database name you imported the file into)
and DB_USERNAME (your mysql password) and DB_PASSWORD if any
5.Run php artisan serve
6.You may need to run 
  php artisan storage:link
  for linking public folder to storage for uploades files
7. localhost:8080 to run the application

Note:
User with userlevel=1 id administrator(for testing i used admin@admin.com with password debugger1)
User with userlevel=0 is a customer
[Both users and admin dashboards are on the dropdown under the username on the top right]