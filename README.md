# GH Issues App Project Setup

This guide will walk you through setting up this project on your local machine.

## Prerequisites

Ensure you have the following installed on your machine:

- PHP (version 8.2 or higher)
- Composer
- Laravel
- Node.js and npm

## Setup Steps

1. **Clone the repository**

   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

2. **Install Node.js dependencies**

   Run the following command to install all required Node.js packages:

   ```bash
   npm install
   ```

3. **Install PHP dependencies**

   Use Composer to install all required PHP packages:

   ```bash
   composer install
   ```

4. **Build frontend assets**

   This step will build your frontend assets (css, etc) with Vite:

   ```bash
   npm run build
   ```

5. **Environment Configuration**

   Copy the `.env.example` file to `.env.local`:

   ```bash
   cp .env.example .env.local
   ```

   Open the `.env.local` file and add your GitHub token:

   ```plaintext
   GITHUB_PERSONAL_TOKEN=your_github_token_here
   ```

6. **Run the application**

   Start the Laravel development server:

   ```bash
   php artisan serve
   ```

7. **Access the application**

   Open your web browser and go to `http://localhost:8000` to see the application in action.

## Notes

Ensure that your PHP, Composer, and Laravel installations are up-to-date to avoid any compatibility issues.
