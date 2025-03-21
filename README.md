1. Clone the Repository
    git clone https://github.com/Y-Hiriejhha-Dharini/cafe-app
    cd cafe-app
    
2. Install Dependencies
    composer install
    npm install

3. Set Up Environment File
    rename .env.example into .env
    Then, update the .env file with your database credentials.

4. Generate Application Key
    php artisan key:generate

5. Run Database Migrations
    php artisan migrate

6. Run Seeders & Factories (Dummy Data)
    php artisan db:seed

7. Serve the Laravel Application
    php artisan serve
    
 8. Compile TailwindCSS  
    npm run dev   
