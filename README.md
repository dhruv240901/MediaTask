# Media Task

The Media Task is a comprehensive project aimed at providing video upload. In this user can login using their google account and upload videos and share there videos with others.

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP(v8.2) and Laravel(v10.29) are installed on your system.
- A basic understanding of Laravel.
- Composer(v2.6.4) for PHP dependencies.
- npm(v10.2.5) for node dependencies.

## Getting Started

1. Clone this repository to your local machine (In Windows go to the xampp/htdocs folder):

   ```bash
   git clone https://github.com/dhruv240901/User-Role-Permission-Module

2. Change to the project directory:

    ```bash
   cd User-Role-Permission-Module

3. Install Laravel dependencies:

   ```bash
   composer install

4. Create a .env file by copying the .env.example file and configure your database
   and mail settings:

   ```bash
   cp .env.example .env

5. Generate an application key:

   ```bash
   php artisan key:generate

6. Migrate and seed the database:

   ```bash
   php artisan migrate --seed

7. Start the Laravel development server:

   ```bash
   php artisan serve

8. Access the application in your web browser at http://localhost:8000.

9. Modify php.ini file set :
    upload_max_filesize = 30M,
    post_max_size = 30M

## Features
1. Google Authentication: User can login using there google account.
2. User Manangement: User can edit or delete other user that have logged in using google.
3. Video Upload: User can upload video less than or equal to 30MB.
4. Video Sharing: User can share there videos to other users.


