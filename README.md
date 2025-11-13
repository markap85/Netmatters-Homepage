# Netmatters Homepage

A responsive website homepage built with PHP, SCSS, and JavaScript featuring modular architecture, database integration, and a contact form with validation.

## Features

- **Modular PHP Architecture**: Organized with reusable includes (header, footer, navigation)
- **Database Integration**: MySQL database with PDO for news items and contact form submissions
- **Contact Form**: Server-side and client-side validation with CSRF protection
- **Responsive Design**: Mobile-first approach with SCSS/SASS
- **Interactive Elements**: Banner slideshow, client carousel, sticky header, cookie consent
- **Accessibility**: ARIA labels, semantic HTML, keyboard navigation support

## Prerequisites

- PHP 8.0 or higher
- MySQL 5.7 or higher
- Composer (for dependency management)
- Node.js/npm (for Sass compilation - optional)

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/markap85/Netmatters-Homepage.git
cd Netmatters-Homepage
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Set Up Environment Variables

The repository excludes the `.env` file for security. Follow these steps to configure your environment:

1. **Copy the example environment file:**
   ```bash
   cp example.env .env
   ```

2. **Edit the `.env` file** with your database credentials:
   ```
   DB_HOST=localhost
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   DB_NAME=netmatters_db
   DB_PORT=3306
   ```

   **For Local Development (XAMPP/WAMP):**
   ```
   DB_HOST=localhost
   DB_USERNAME=root
   DB_PASSWORD=
   DB_NAME=netmatters_db
   ```

   **For Production (cPanel):**
   Use your cPanel MySQL database credentials provided by your hosting provider.

### 4. Set Up the Database

1. **Create the database:**
   ```sql
   CREATE DATABASE netmatters_db;
   ```

2. **Import the database schema:**
   - Locate the SQL file in the project (if provided) or create tables manually
   - For the news section, create a `news` table
   - For contact form submissions, create a `contact_submissions` table

3. **Sample schema** (if not provided):
   ```sql
   USE netmatters_db;

   CREATE TABLE news (
       id INT AUTO_INCREMENT PRIMARY KEY,
       title VARCHAR(255) NOT NULL,
       excerpt TEXT,
       image VARCHAR(255),
       image_alt VARCHAR(255),
       tag_text VARCHAR(50),
       tag_class VARCHAR(50),
       btn_text VARCHAR(50),
       btn_class VARCHAR(50),
       author VARCHAR(100),
       date_published DATE,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   CREATE TABLE contact_submissions (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL,
       telephone VARCHAR(20),
       message TEXT NOT NULL,
       marketing_consent BOOLEAN DEFAULT FALSE,
       submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

### 5. Compile SCSS (Optional)

If you need to modify styles:

```bash
# Install Sass globally (if not already installed)
npm install -g sass

# Compile SCSS to CSS
sass scss/styles.scss css/styles.css

# Watch for changes (development)
sass --watch scss/styles.scss:css/styles.css
```

### 6. Run the Application

**Local Development:**
- Place the project in your XAMPP/WAMP `htdocs` folder
- Access via `http://localhost/Netmatters-Homepage`

**Production Deployment (cPanel):**
1. Upload all files to your public_html directory
2. Ensure the `.env` file is uploaded with your production credentials
3. Verify `.htaccess` is uploaded for clean URLs
4. Access via your domain

## Project Structure

```
Netmatters-Homepage/
├── css/                    # Compiled CSS files
├── scss/                   # SCSS source files
│   ├── base/              # Base styles, layout, normalize
│   ├── layout/            # Component layouts (header, footer, etc.)
│   └── utilities/         # Variables, mixins, extends
├── includes/              # PHP includes
│   ├── header.php
│   ├── footer.php
│   └── navigation.php
├── js/                    # JavaScript files
├── img/                   # Images and assets
├── vendor/                # Composer dependencies
├── index.php              # Homepage
├── contact-us.php         # Contact form page
├── .env                   # Environment variables (excluded from repo)
├── example.env            # Example environment file
├── .htaccess              # Apache configuration
├── composer.json          # PHP dependencies
└── README.md              # This file
```

## Environment Variables

The `.env` file is excluded from the repository for security reasons. **Never commit your `.env` file to version control.**

Required environment variables:
- `DB_HOST` - Database host (usually localhost)
- `DB_USERNAME` - Database username
- `DB_PASSWORD` - Database password
- `DB_NAME` - Database name
- `DB_PORT` - Database port (default: 3306)
- `APP_NAME` - Application name
- `APP_ENV` - Environment (development/production)
- `APP_VERSION` - Application version

## Security

- `.env` file is excluded via `.gitignore`
- CSRF protection on contact form
- PDO prepared statements to prevent SQL injection
- Input validation and sanitization
- Secure password hashing (if user authentication is added)

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## License

This project is for educational purposes as part of the Netmatters SCS training program.

## Author

Mark Peters - [GitHub](https://github.com/markap85)
