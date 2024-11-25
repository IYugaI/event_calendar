# Event Calendar Project :calendar:

This project demonstrates the implementation of core functionalities for a simple **Event Calendar**. It also includes optional features such as a slider, a week-based calendar system, AJAX-driven interactions, and API-based data fetching.


## Features

The project implements the following key functionalities:

-   **Database Design**:
    
    -   Creation of normalized tables (3NF) for efficient data storage.
    -   Population of tables with test data for development.
-   **Backend and Frontend Development**:
    
    -   Backend logic implemented using PHP.
    -   Frontend design with responsive styles and user-friendly forms.
-   **Version Control**:
    
    -   Use of Git for version control and GitHub for remote repository management.

## Functionalities of the Event Calendar

-   Visual representation of events fetched from the database.
-   Week-based calendar system with:
    -   Correctly formatted dates and day names.
    -   Events displayed visually by week and day.
-   Creation of new events via an HTML form:
    -   Input for date, time, description, and selection of related data (sports, location, teams).
-   Database integration:
    -   Adding new events to the database while maintaining relational integrity.
-   Detailed event view:
    -   Overview of events for a single day.
    -   Detailed information about a single event.

## Technologies Used
-   **Backend**: PHP
-   **Database**: MySQL
-   **Frontend**: HTML, CSS, JavaScript, and Bootstrap
-   **Libraries**:
    -   Carbon (PHP date/time library)

## Setup Instructions

### Prerequisites

-   **Database and PHP Environment**:
    
    -   Download and install **[XAMPP](https://www.apachefriends.org/)** for Apache Server, MySQL, and PHP.
    -   Launch XAMPP and enable **Apache** and **MySQL** services.
    -   Navigate to `http://127.0.0.1` in your browser to access **phpMyAdmin**.
    -   Import the provided `event_calendar.sql` file:
        -  Ensure you import it at the **server level**, not a specific table.
        -   The `.sql` file is pre-configured to create the necessary database and tables.

-	**Dependencies**:

	-   Download and install **[Composer](https://getcomposer.org/)**.
	-   Install the **Carbon** library using the following command in bash console:
	    `composer require nesbot/carbon` 



### Serving the Project

1.  Open the project folder in **[Visual Studio Code](https://code.visualstudio.com/)**.
2.  Install the **PHP Server** extension (author: _brapifra_).
3.  Right-click on the `home.php` file and select **"PHP Server: Serve Project"**.
4.  The browser should automatically open the project. If not, manually navigate to:
    `http://localhost:3000/home.php`

