#  -----Prerequisites-----
        1. PHP (version 8.1 or higher)

        2. Composer (Dependency Manager for PHP)

        3. MySQL or any other database system supported by Laravel

        4. Git (optional, for version control)  

#  -----Project Setup-----

        1. cloning the project:
            => git clone https://github.com/Gunavelraj/user-management-app.git

        2. Navigate to your project directory:
           =>  cd project-name

        3. Copy the .env.example file to .env
           => cp .env.example .env

        4. Update the .env file with your database credentials:

                DB_CONNECTION=mysql
                DB_HOST=127.0.0.1
                DB_PORT=3306
                DB_DATABASE=your_database_name
                DB_USERNAME=your_database_username
                DB_PASSWORD=your_database_password
        
        5. Create DataBase to enter this command
            => php artisan db:create

        6. composer command
          => composer install
          
        7. Migrate the database tables
          => php artisan migrate

        8. Run the project
          => php artisan serve

#  -----API Summary-----

    1. Reagister API
        URL     :   APP_URl/api/auth/register
        Method  :   POST
        Payload :   {
                        "first_name" : "guna",
                        "last_name" : "velraj",
                        "role" : "admin",
                        "email" : "gunavelraj23@gmail.com",
                        "latitude" : "3333.4455",
                        "longitude" : "23.445",
                        "date_of_birth" : "1999/12/23",
                        "timezone" : "UTF",
                        "password" : "guna@123"
                    }
        Response : {
                        status": true,
                        "message": "User successfully registered",
                        "data": {
                            "first_name": "guna",
                            "last_name": "velraj",
                            "role": "admin",
                            "email": "gunavelraj23@gmail.com",
                            "latitude": "3333.4455",
                            "longitude": "23.445",
                            "date_of_birth": "1999/12/23",
                            "timezone": "UTF",
                            "updated_at": "2025-03-06T14:10:23.000000Z",
                            "created_at": "2025-03-06T14:10:23.000000Z",
                            "id": 2
                        }
                    }

    2. Login API
        URL     :   APP_URl/api/auth/login
        Method  :   POST
        Payload :   {
                        "email" : "gunavelraj23@gmail.com",
                        "password" : "guna@123"
                    }
        Response : {
                        "status": true,
                        "message": "User successfully loggedin",
                        "token_details": {
                            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3NDEyNzA0ODcsImV4cCI6MTc0MTI3NDA4NywibmJmIjoxNzQxMjcwNDg3LCJqdGkiOiJYRE9YczdJYmFTN0FwZGxkIiwic3ViIjoiMiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.smy0kbPe4h8vF8k6MvnztOHhxuH0Tc-CCqA8JOEm-Xg",
                            "token_type": "bearer",
                            "expires_in": 3600
                        },
                        "data": {
                            "id": 2,
                            "first_name": "guna",
                            "last_name": "velraj",
                            "role": "admin",
                            "email": "gunavelraj23@gmail.com",
                            "latitude": "3333.4455",
                            "longitude": "23.445",
                            "date_of_birth": "1999-12-23",
                            "timezone": "UTF",
                            "created_at": "2025-03-06T14:10:23.000000Z",
                            "updated_at": "2025-03-06T14:10:23.000000Z"
                        }
                    }

    3.Profile API 
        URL     :   APP_URl/api/auth/login
        Method  :   GET
        Header  :   bearer token ('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3NDEyNzA0ODcsImV4cCI6MTc0MTI3NDA4NywibmJmIjoxNzQxMjcwNDg3LCJqdGkiOiJYRE9YczdJYmFTN0FwZGxkIiwic3ViIjoiMiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ')

        Response : {
                        "status": true,
                        "message": "Success",
                        "data": {
                            "id": 2,
                            "first_name": "guna",
                            "last_name": "velraj",
                            "role": "admin",
                            "email": "gunavelraj23@gmail.com",
                            "latitude": "3333.4455",
                            "longitude": "23.445",
                            "date_of_birth": "1999-12-23",
                            "timezone": "UTF",
                            "created_at": "2025-03-06T14:10:23.000000Z",
                            "updated_at": "2025-03-06T14:10:23.000000Z"
                        }
                    }
`
    4.Logout API
        URL     :   APP_URl/api/auth/login
        Method  :   POST
        Header  :   bearer token ('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3NDEyNzA0ODcsImV4cCI6MTc0MTI3NDA4NywibmJmIjoxNzQxMjcwNDg3LCJqdGkiOiJYRE9YczdJYmFTN0FwZGxkIiwic3ViIjoiMiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ')

        Response : {
                        "status": true,
                        "message": "User logged out"
                    }

#  -----User CRUD-----

    It is a user Create, Read, Update, Delete web application with all request create into storage/log/laravel.log
<!--  -->
