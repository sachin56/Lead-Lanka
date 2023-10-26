# Capricon Exam
   - Starting time: 
   - Completed time: 

## This project includes 3 docker containers 
    1. Database > db-book-management
    2. Nginx > nginx-book-management
    3. Php > php-app-book-management

## Run the project 

   ##  Clone the project
      `git clone https://github.com/sachin56/Capricon-blog-app.git`

   ## Run command   
      `docker compose up -d`

   ## Migarete table
   - Go to php container > docker exec -it php-app-book-management sh
   - install composer > composer install
   - Migarte table > php artisan migrate
   - Running Seeders > php artisan db:seed

   ## If you want db backup add
   - please copy and paste the below command database Backup is in the folder
   # Restore
      `cat backup.sql | docker exec -i db-book-management /usr/bin/mysql -u root --password=leadlanka#1234 bookmanagement`

   - NOTE DATABASE WILL BE AUTOMATICLY CREATE WHEN DOCKER UP

   ## Container Down command   
      `docker compose down`   
      
   ## Change the .env file database credentials 
          DB_CONNECTION=mysql
          DB_HOST=db-bookmanagement
          DB_PORT=3306
          DB_DATABASE=capricon
          DB_USERNAME=root
          DB_PASSWORD=leadlanka#1234
          
   ## Once Container is getting up run the following commands 

       docker exec -it php-app-book-management sh  ----> it can go to inside container
       docker exec -it db-book-management sh  ----> it can go to inside container


   
