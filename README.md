# Bhavani Hatch Track
 This project provides a comprehensive solution for efficient management and tracking of hatchery operations tailored for Bhavani Hatchery in Visakhapatnam. The system leverages modern web technologies and three separate databases to handle various aspects of hatchery management, including employee records, financial transactions, and hatchery operations.

## Table of Contents

- [Project Overview](#project-overview)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Database Structure](#database-structure)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Project Overview

The Bhavani Hatchery Management System is designed to streamline hatchery operations by providing a centralized platform to manage employee records, financial transactions, and hatchery data. This system helps in maintaining organized records, improving data accessibility, and enhancing the overall efficiency of hatchery operations.

## Features

- **Employee Management**: Manage employee information, roles, and responsibilities.
- **Financial Management**: Track financial transactions, expenses, and revenue.
- **Hatchery Operations**: Monitor and manage hatchery activities, inventory, and production data.
- **User Authentication**: Secure login system for different user roles.
- **Responsive Design**: User-friendly interface compatible with various devices.

## Technologies Used

- **Frontend**:
  - HTML
  - CSS
  - Bootstrap
- **Backend**:
  - PHP
- **Databases**:
  - SQL
    - Employee Database
    - Finance Database
    - Hatchery Database
- **Scripts**:
  - JavaScript

## Database Structure

The system uses three separate databases to efficiently manage different aspects of the hatchery:

1. **Employee Database**:
   - `employees`: Stores employee details such as name, position, contact information, and employment status.
   
2. **Finance Database**:
   - `transactions`: Records financial transactions, including income, expenses, and financial summaries.
   
3. **Hatchery Database**:
   - `hatchery_operations`: Manages hatchery data, including inventory, production schedules, and output tracking.

## Installation
**Clone the repository**:
   ```bash
   git clone https://github.com/Varshini2115/BhavaniHatchTrack.git
   cd BhavaniHatchTrack
   

1. **Set up the databases**:
   - Create three SQL databases: `employee_db`, `finance_db`, and `hatchery_db`.
   - Import the provided SQL scripts to set up the tables for each database.

2. **Configure the backend**:
   - Update the database connection settings in the PHP configuration files to connect to your databases.

3. **Deploy the application**:
   - Host the application on a web server with PHP support.

## Usage

1. **Access the system**:
   - Navigate to the hosted URL of the Bhavani Hatchery Management System.

2. **Login**:
   - Use your credentials to log in to the system. Different user roles will have access to different functionalities.

3. **Manage Records**:
   - Use the interface to manage employee records, financial transactions, and hatchery operations.

## Contributing

We welcome contributions to improve the Bhavani Hatchery Management System. To contribute:

1. Fork the repository.
2. Create a new branch.
3. Make your changes.
4. Submit a pull request.

Please ensure your code follows the project's coding standards and includes appropriate tests.

## License

This project is licensed under the MIT License. 
