# Hebah Portfolio — Digital Studio & Education Platform

<p align="center">
  <strong>A full-stack Laravel portfolio platform combining Digital Solutions, Web Development, and Quran & Arabic Education.</strong>
</p>

<p align="center">
  <a href="https://hebahgift.com">Live Website</a>
  &nbsp;•&nbsp;
  <a href="https://github.com/hebah-abdelwhab26">GitHub Profile</a>
</p>



## Overview

**Hebah Portfolio** is a custom Laravel web platform designed to present two professional areas within one unified digital experience:

* **Digital Studio** — Web development, digital solutions, UI/UX, and project showcase.
* **Quran & Arabic Education** — An educational platform for Quran and Arabic learning.

The project was designed and developed as a real-world application rather than a simple portfolio template, with a focus on scalable architecture, authentication, administration, localization, responsive interfaces, and content management.



## Main Sections

### 💻 Digital Studio

The Digital Studio presents my work and services in web development and digital solutions.

Features include:

* Personal professional profile
* Services and capabilities
* Project portfolio
* Project details and galleries
* Live project links
* GitHub and Figma references
* Contact system
* Comments and communication features
* Arabic / English localization
* Administrative dashboard
* Project and content management



### 📖 Quran & Arabic Education Platform

The education section provides a dedicated environment for Quran and Arabic learning.

Features include:

* Student accounts
* Student dashboard
* Quran and Arabic lessons
* Assignments
* Quizzes and assessments
* Lesson progress tracking
* Private educational sessions
* Booking management
* Session duration and scheduling
* Payment-related workflow
* Notifications
* Student/teacher communication
* Comments and educational interaction
* Arabic / English localization
* Administrative management



## Admin Dashboard

The project includes a dedicated administration system for managing the platform and its content.

Administrative functionality includes:

* Dashboard and statistics
* Project management
* Education content management
* Student management
* Lessons and assignments
* Bookings
* Notifications
* Comments
* Conversations
* Contact messages
* Content activation and ordering
* Multilingual content management



## Authentication

The application includes separate authentication flows for different areas of the platform, including:

* Administrative users
* Education students
* Protected dashboards
* Session management
* Role-based access control
* Email verification where applicable



## Localization

The platform supports both:

* 🇸🇦 Arabic
* 🇬🇧 English

The interfaces are designed to support both **RTL** and **LTR** layouts depending on the selected language.

## Technology Stack

### Backend

* PHP
* Laravel
* Laravel Eloquent ORM
* Laravel Blade
* Laravel Middleware
* Laravel Authentication
* Laravel Migrations
* Laravel Artisan

### Frontend

* HTML5
* CSS3
* JavaScript
* Blade Templates
* Font Awesome
* Responsive Design
* RTL / LTR interfaces

### Database

* MySQL / MariaDB

### Development Tools

* Git
* GitHub
* Composer
* NPM
* Vite
* VS Code

### Deployment

* Hostinger
* Linux hosting environment
* Production Laravel configuration



## Project Architecture

The application is organized into separate areas to keep the platform maintainable and scalable.


Hebah Portfolio
│
├── Digital Studio
│   ├── Portfolio
│   ├── Services
│   ├── Contact
│   └── Project Management
│
├── Quran & Arabic Education
│   ├── Students
│   ├── Lessons
│   ├── Assignments
│   ├── Quizzes
│   ├── Bookings
│   ├── Notifications
│   └── Communication
│
└── Administration
    ├── Dashboard
    ├── Content Management
    ├── Students
    ├── Projects
    ├── Bookings
    └── Messages



## Live Website

The production version of the platform is available at:

**https://hebahgift.com**

The website contains the public Digital Studio and Quran & Arabic Education sections.



## Security & Environment

Sensitive configuration and user-generated private files are intentionally excluded from this repository.

The project uses environment variables for configuration such as:

* Database credentials
* Application keys
* Mail configuration
* Production environment settings

Private uploaded files and sensitive user-related directories are also excluded from version control.


## Installation

Clone the repository:


git clone https://github.com/hebah-abdelwhab26/hebah-portfolio.git

cd hebah-portfolio


Install PHP dependencies:


composer install


Install frontend dependencies:


npm install


Create the environment file:


cp .env.example .env


Generate the application key:


php artisan key:generate


Configure the database and other environment variables in `.env`.

Run migrations:


php artisan migrate


Build frontend assets:


npm run build


Start the local development server:


php artisan serve




## Development

For local development with Vite:


npm run dev


For Laravel development:


php artisan serve



## Author

**Hebah Abdelwahab**

Web Developer & Digital Solutions Specialist
Quran & Arabic Education

GitHub:
https://github.com/hebah-abdelwhab26

Portfolio:
https://hebahgift.com


## License

This project is primarily a personal portfolio and educational platform.

The source code is publicly available for demonstration and professional portfolio purposes. Please respect the project's original design, content, branding, and assets.
