# Personal Blogpost

- This is a simple personal Blogpost project built with **Laravel 8**. 
- Admin user can create, read, update, and delete posts.
- Normal user can view posts.
<br><br><br>

# Installation Prerequiste
- Git
     ### For Window operating system
      - Download git for window from official site.
      https://git-scm.com/download/win


     ### For Linux operating system 
        sudo yum install git -y

- PHP >= 7.3
- Web server like Apache or XAMPP installed and configured, and a database management system like MySQL, PostgreSQL, or SQLite.
- Dependency manager for PHP

                    
# Installation
- Clone the repository:
 
        git clone https://github.com/nepalirakesh/BlogPost.git

- Navigate to the project directory:

        cd BlogPost

- Install the dependencies:

        composer install

- Create a copy of the **.env** file:

        cp .env.example .env

- Generate an app key:

        php artisan key:generate

- Configure the database connection in the **.env** file

- Run the migrations:

       php artisan migrate
       
-Storage Link

       php artisan storage:link

- Start the development server: 

       php artisan serve

- The application will be running at http://localhost:8000




