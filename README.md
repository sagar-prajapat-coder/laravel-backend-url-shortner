<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Shortly

Shortly is a Laravel-based URL shortener and client/team management system.

## Features

- User authentication
- Role-based access (SuperAdmin, Admin)
- Client and team member management
- Short URL creation and download

## Setup Instructions

### Requirements

- PHP >= 8.1
- Composer
- MySQL or compatible database
- Node.js & npm (for frontend assets)

### Installation

1. **Clone the repository:**
   ```sh
   git clone https://github.com/yourusername/shortly.git
   cd shortly
   ```

2. **Install dependencies:**
   ```sh
   composer install
   npm install
   ```

3. **Copy and configure `.env`:**
   ```sh
   cp .env.example .env
   ```
   - Set your database credentials in `.env`.

4. **Generate application key:**
   ```sh
   php artisan key:generate
   ```

5. **Run migrations:**
   ```sh
   php artisan migrate
   ```

6. **(Optional) Seed the database:**
   ```sh
   php artisan db:seed
   ```

7. **Build frontend assets:**
   ```sh
   npm run dev
   ```

8. **Start the development server:**
   ```sh
   php artisan serve
   ```
   Visit [http://localhost:8000](http://localhost:8000) in your browser.

## Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
