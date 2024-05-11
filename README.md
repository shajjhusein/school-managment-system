
# Student Management System 

**Student Management System ** is a fully responsive web application UI kit built with Laravel (PHP) and modern front-end development tools.

## Prerequisites

Make sure you have the following software installed on your system:

- **Node.js** (v12 or higher)
- **PHP** (v7.4 or higher)
- **Composer** (latest version)
- **Gulp** (latest version)
- **Browser-Sync** (latest version)

## Project Setup

1. **Clone the Repository:**

   Clone the repository to your local machine and navigate to the project directory.

   ```bash
   git clone 
   cd school-managment-system
   ```

2. **Install PHP Dependencies:**

   Install the necessary PHP dependencies using Composer.

   ```bash
   composer install
   ```

3. **Install Node.js Dependencies:**

   Install the Node.js dependencies from `package.json`.

   ```bash
   npm install
   ```

4. **Install Gulp and Browser-Sync:**

   Install `gulp` and `browser-sync` globally if they aren't already.

   ```bash
   npm install -g gulp browser-sync
   ```

5. **Build Front-End Assets:**

   Use Gulp to build and compile front-end assets.

   ```bash
   gulp
   ```

6. **Start the PHP Server:**

   Start a PHP built-in development server.

   ```bash
   cd src
   php -S localhost:8000
   ```

7. **Launch Browser-Sync:**

   Start Browser-Sync to watch for file changes and reload the browser automatically.

   ```bash
   browser-sync start --proxy "localhost:8000" --files "**/*.php, **/*.html, **/*.css, **/*.js"
   ```

## Available Gulp Tasks

- **`gulp`:** Default task to build front-end assets.

## License

This project is UNLICENSED and is intended for demonstration purposes only.
