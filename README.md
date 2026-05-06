# University Project – Social Website

## Overview
This project is a simple social media web application developed using **PHP, MySQL, HTML, and CSS**. It allows users to create accounts, manage profiles, search for other users, and interact through comments.

The project was developed during the **first year of Computer Science studies**, prior to the widespread use of AI-assisted development tools, and was built while following a YouTube tutorial as a learning resource. The assignment requirements included implementing:
- Individual user profiles
- Comment functionality
- Like system (UI assets included)
- User search
- Backend logic using PHP
- Optional JavaScript (minimal usage)

---

## Features

### Authentication System
- User registration with validation
- Secure password hashing
- Login via username or email
- Session-based authentication
- Logout functionality

### User Profiles
- View user profile pages
- Display profile picture, real name, username, email, and bio
- Default profile picture support
- Edit profile information:
  - Username
  - Real name
  - Email
  - Bio
  - Profile picture upload

### Social Interaction
- Post comments on user profiles
- View comments left by others
- Sort comments by:
  - Date
  - Username
  - Real name

### Search
- Search users by username
- Redirect to profile if found
- Error handling for invalid or empty searches

### UI Elements
- Bootstrap-based responsive layout
- Custom CSS styling
- Like button assets (filled/outline icons included)

---

## Project Structure
```
├───config
│       db.php                   # Database connection
│
├───controllers
│       authController.php       # Login, signup, logout logic
│       comments.php             # Comment creation logic
│       editinfoForm.php         # Update username, email, real name
│       editprofileForm.php      # Update bio
│       processForm.php          # Profile picture upload handling
│
├───users
│   └───websiteresources
│           defpfp.jpg           # Default profile picture
│           like_filled.png      # Active like icon
│           like_outline.png     # Inactive like icon
│
│   editinfo.php                 # Edit user info UI
│   editpfp.php                  # Edit profile picture UI
│   editprofile.php              # Edit bio UI
│   index.php                    # Main page (profile + comments)
│   login.php                    # Login page
│   profile.php                  # Profile loading + search logic
│   README.md                    # Project documentation
│   signup.php                   # Registration page
│   style.css                    # Styling
│   user-verification.sql        # Database schema
```
---

## Architecture

### Backend
- **PHP (procedural style)** used for all server-side logic
- **MySQL (MariaDB)** for data storage
- Uses:
  - Sessions for authentication
  - Prepared statements (partially) for security
  - Direct queries in some areas

### Database Design

#### `user_info`
Stores user account data:
```
- id (Primary Key)
- realname
- username (unique)
- email (unique)
- password (hashed)
- bio
- profile picture path
```
#### `comments`
Stores user comments:
```
- id (Primary Key)
- posting user (id, username, real name)
- receiving user id
- date
- comment text
```
### Frontend
- HTML forms for input
- Bootstrap 4 for layout and responsiveness
- Custom CSS for styling
- Minimal JavaScript usage

---

## Getting Started

### Requirements
- PHP (7.x or newer recommended)
- MySQL / MariaDB
- Local server (e.g., XAMPP, WAMP, LAMP)

### Setup Instructions

1. Clone the repository:
   ```bash
   git clone https://github.com/Taengsil/University-Project-Social-Website.git
   ```
2. Move the project into your web server directory:
- Example (XAMPP): `htdocs/unversity-project-social-website`

3. Import the database:
- Open phpMyAdmin
- Create a database named `user-verification`
- Import `user-verification.sql`

4. Configure database connection:
- Open `config/db.php`
- Update credentials if necessary:
```
$conn = new mysqli('localhost', 'root', '', 'user-verification');
```

5. Start your server and access:
```
http://localhost/University-Project-Social-Website
```

---

## Areas for Improvement
### Security
- Some queries are vulnerable to SQL injection (e.g., comments insertion, profile queries)
- Missing input sanitization and output escaping (XSS risk)
- No CSRF protection
- File upload validation is minimal (no type/size restrictions)
### Code Quality
- Mixed use of prepared statements and raw SQL
- Tight coupling between logic and presentation
- Lack of MVC structure
- Repeated code patterns
### Features
- Like system is not implemented (only assets exist)
- No pagination for comments
- No password reset or email verification
- No role/permission system
### UX/UI
- Basic styling and layout
- No real-time updates (AJAX)
- Limited responsiveness optimization
- Scalability
- Not optimized for large datasets
- No indexing strategy beyond defaults
- No API layer
  
---
## Notes

This project reflects an early-stage understanding of:
- Web development fundamentals
- PHP and MySQL integration
- Session handling
- Basic CRUD operations
  
It serves as a learning milestone rather than a production-ready application.
---
## Possible Improvements

This project meets the core requirements of a basic social media website, but there are several areas where it could be improved in terms of security, structure, scalability, and user experience in order for it to begin to resemble a production-ready application.

### Security Improvements
- Sanitize and validate all user inputs to prevent SQL injection and XSS vulnerabilities.
- Replace remaining raw SQL queries with prepared statements consistently.
- Add CSRF protection to all form submissions.
- Improve file upload security by validating file type, size, and content.

### Code Structure
- Refactor the project into an MVC (Model–View–Controller) architecture to separate logic, presentation, and database access.
- Reduce duplication in authentication and database-related logic across controllers.
- Improve naming consistency and file organization for better maintainability.

### Functionality Enhancements
- Implement the like system (currently only UI assets exist without backend logic).
- Add pagination for comments to improve performance with large datasets.
- Improve user search with partial matching and filtering options.
- Add password reset functionality and email verification for accounts.

### User Experience
- Improve responsiveness and mobile layout support.
- Replace full page reload interactions with AJAX for smoother updates.
- Add real-time updates for comments and interactions.

### Database Improvements
- Normalize database structure further for scalability.
- Add indexing for frequently queried fields (e.g., username, email, receivinguserid).
- Separate features such as comments, posts, and likes into dedicated tables if the project is extended.

These improvements would significantly increase the robustness, scalability, and production readiness of the application.
