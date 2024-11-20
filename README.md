# Google Distance Matrix API Integration

This project integrates the **Google Distance Matrix API** with a Laravel application to calculate distances and travel times between companies and users asynchronously. The results are stored in a `distances` table in the database.

## Features

- Asynchronous job handling for calculating distances and travel times.
- Fetches company and user location data from the database.
- Stores calculated distances and travel times in a structured format.
- Handles bulk processing of records efficiently.
- Error handling and logging for failed API requests.

## Requirements

- PHP >= "^7.2.5|^8.0"
- Laravel "^7.29"
- MySQL or another compatible database
- Composer
- Google Distance Matrix API key

## Setup

### 1. Clone the repository

Clone the project to your local machine:

git clone https://github.com/RanaIshtiyaq/Google_Distance_Matrix/

### 2. Install Dependencies
Navigate to the project folder and install all dependencies using Composer:


cd google-distance-matrix
composer install
### 3. Set Up Environment Variables
Copy the .env.example file to create your .env file:


cp .env.example .env
Update the .env file with your database connection details and Google Distance Matrix API key:

makefile
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

GOOGLE_DISTANCE_MATRIX_API_KEY=your_google_api_key
### 4. Set Up Database
Run the migrations to set up the database tables:


php artisan migrate
If needed, you can also seed the database with sample data:


php artisan db:seed
### 5. Set Up Queues
Ensure that your queue system is set up. You can use the database or redis queue driver. In the .env file, configure the queue connection:

makefile
Copy code
QUEUE_CONNECTION=database
Run the queue worker to process jobs:


php artisan queue:work
### 6. Running the Application
Once everything is set up, you can run the Laravel development server:

php artisan serve
Your application will be accessible at http://localhost:8000.

### 7. Dispatching the Job
The distance calculation job can be triggered via the /calculate-distances route:

php artisan route:call /calculate-distances
or 
php artisan calculate:distances
or
http://localhost:8000/calculate-distances

This will dispatch the CalculateDistances job to calculate the distances between companies and users.

Error Handling & Logging
Failures during the API requests are logged in the storage/logs/laravel.log file. You can check this file for any issues related to the distance calculations.

or use to retive back all failed job in job
php artisan queue:retry all


Logs Location
The logs are stored in the following location:


storage/logs/laravel.log
Contributing
If you'd like to contribute to the project, feel free to fork the repository and create a pull request. Please make sure your code follows the Laravel coding standards and includes appropriate tests for new features or bug fixes.

### 8. Run all the job

php artisan queue:work
it will choose the job make chunks of 50 and calculate the distance and save into database

### 9. For more details visit video presentation

https://www.canva.com/design/DAGXDCpYLZk/MGqT-NPSj3qVMgIPVUgIHg/edit?utm_content=DAGXDCpYLZk&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton


