# Laravel and Vue3 Project

Welcome to the Laravel and Vue3 Student Management Project repository! This project provides a comprehensive solution for managing students, including features such as login, registration, updating profiles, and a dashboard.

## Project Overview

This project revolves around student management, providing functionalities to create, list, and delete students efficiently. Leveraging the power of Laravel and Vue3, it offers a seamless user experience and robust backend functionalities.

### Key Features:

- **User Authentication**: Secure login and registration system.
- **Profile Management**: Ability for users to update their profiles.
- **Dashboard**: A centralized dashboard for an overview of the system.
- **Student Management Module**: CRUD operations for managing students.

## Setup Instructions

1. Clone the repository:

```bash
git clone <repository-url>
```

2. Copy `.env.example` to `.env` file:

```bash
cp .env.example .env
```

3. Update `.env` file with your database credentials.

4. Make sure to have PHP version 8.2 installed.

5. Make sure to have Node.js version >= 16 installed.

6. Install PHP dependencies using Composer:

```bash
composer install
```

7. Run database migrations:

```bash
php artisan migrate
```

8. Install Node.js dependencies:

```bash
npm install
```

9. Build the frontend assets:

```bash
npm run build
```

10. Run the Laravel server:

```bash
php artisan serve
```

## Running Tests

To run test cases, use the following command:

```bash
php artisan test --testsuite=Unit
```

This will run the unit tests defined in the Laravel project.

## Versions Used

- Laravel: v10
- Node.js: >= 16
- PHP: 8.2
