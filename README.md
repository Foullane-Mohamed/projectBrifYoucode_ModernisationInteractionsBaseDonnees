# # Project Name: Modernisation des Interactions avec la Base de Données

## Overview
This project is a custom Object-Relational Mapping (ORM) solution implemented in PHP. It aims to simplify database interactions by automating CRUD operations and managing relationships between models. The ORM is designed to be flexible and easy to configure, making it suitable for various applications.
## Project Structure
```

├── src
│   ├── config
│   │   └── Database.php
│   ├── controllers
│   │   └── PlayerController.php
│   ├── database
│   │   └── db.sql
│   ├── models
│   │   └── Player.php
│   ├── views
│   │   ├── create.php
│   │   ├── read.php
│   │   ├── update.php
│   │   └── delete.php
├── index.php
├── .htaccess
├── .documantation.md
└── README.md
```
## Features
- **Easy Configuration**: Quickly set up the ORM with database connection parameters.
- **Automated CRUD Operations**: Perform create, read, update, and delete operations without writing explicit SQL queries.
- **Simple Relationship Management**: Support for one-to-one and one-to-many relationships between tables.
- **Data Validation**: Basic validation mechanisms to ensure data integrity before insertion.
- **Error Handling**: Robust error and exception management for improved resilience.
- **Database Compatibility**: Works with multiple database management systems, including MySQL, PostgreSQL, and SQLite.

## Installation
1. Clone the repository:
   ```
    git clone https://github.com/Foullane-Mohamed/projectBrifYoucode_ModernisationInteractionsBaseDonnees.git 
   ```
2. Navigate to the project directory:
   ```
   cd php-orm
   ```
3. Install dependencies using Composer:
   ```
   composer install
   ```

## Usage
To use the ORM, follow these steps:

1. **Configure Database Connection**: Update the `src/Config/Database.php` file with your database credentials.
2. **Perform CRUD Operations**: Use the `ORM` class to interact with your models and perform CRUD operations.


## Testing
Unit tests for the ORM functionality can be found in the `tests/ORMTest.php` file. To run the tests, use the following command:
```
vendor/bin/phpunit tests/ORMTest.php
```

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.

## License
This project is licensed under the MIT License. See the LICENSE file for more details.