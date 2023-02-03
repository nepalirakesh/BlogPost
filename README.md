# Personal Blogpost

- This is a simple personal Blogpost project built with **Laravel 8**. 
- Admin user can create, read, update, and delete posts.
- Guest user can view all Posts,search Post by Category and See individual Post.
<br><br>

# Project Workflow
- Normal user can view Posts on landing page i.e http://localhost:8000.
- Normal user can filter post by category.
- There is no login or register button inside Home Page as it is a Personal Blogpost.
- To create Admin we must enter the URL http://localhost:8000/register and provide name and email to register the admin.
- After regisration admin will be directed to dashboard.
- Admin can vist dashboard with http://localhost:8000/dashboard.
- On dashboard Admin can see Manage Author/Posts/Tags/Categories menu
- Inside each menu  there List Authors/Category/Tags/Post and Create  Author/Posts/Tags/Categories menu items.
- First of all we have to create Author,Tags,Category then we can create Post .
- There is a Home link on the navbar inside dashboard form where we can go to Home page.
- If somehow guest use try to access the dashboard or URl for managing Author/Posts/Tags/Categories they will be redirected to login page.
<br><br>



# Installation Prerequiste
- Git
     ##### For Window operating system
      - Download git for window from official site.
      https://git-scm.com/download/win


     ##### For Linux operating system 
        sudo yum install git -y

- PHP version 7.3 or greater is required as this project runs on Laravel 8
- Web server like Apache or XAMPP installed and configured, and a database management system like MySQL, PostgreSQL, or SQLite.
- Dependency manager (Composer) is required.
 <br><br>

                    
# Installation
- Clone the repository:
 
        git clone https://github.com/nepalirakesh/BlogPost.git

- Navigate to the project directory:

        cd BlogPost

- Install the dependencies:

        composer install

- Create **.env** file and copy the contents of **.env.example** file:

        cp .env.example .env

- Generate an app key and it will be reflected on APP_KEY field of new created **.env** file :

        php artisan key:generate

- Configure the database connection in the **.env** file
        DB_DATABASE= "Your database name"
        DB_USERNAME= "Your username" or by default it is **root**
        DB_PASSWORD= "Your password"

- Run the migrations to make required tables on database :

       php artisan migrate
       
- To link storage folder and public folder

       php artisan storage:link

- Start the development server: 

       php artisan serve

- The application will be running at http://localhost:8000




