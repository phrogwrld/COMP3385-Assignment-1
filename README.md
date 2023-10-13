# COMP3385 Assignment 1
*Framework Development for Advanced Web Applications*

<p> Used: </p><ul>
<li>PHP 8.2</li>
<li>MySQL 8.0.26</li>
<li>TailwindCSS</li>
<li>Prettier</li>
</ul>

## Important
When registering for a new user, the default role is Researcher, but for the sake of grading it will default to the highest (Researcher Group Manager).

## Installation
```console
$ git clone https://github.com/phrogwrld/COMP3385-Assignment-1.git
$ cd COMP3385-Assignment-1
```

Since we were allowed to use a CSS Framework I decided to use TailwindCSS. To install TailwindCSS you will need to install NodeJS and NPM.
```console
$ npm install
```
### Usage
When making changes to the view file the following command watches for changes and rebuilds the css file
```console
$ pnpm run css-watch
```

To build the css file run the following command
```console
$ pnpm run css-build
```

#### Prettier
Also included is a prettier configuration file as I got lazy trying to tidy up the code. To format the code run the following command
```console
$ pnpm run format
```

Again, these are just helper commands to make development easier so it is not for the submission. The folder 4000007969 is the only folder that needs to be submitted.

## File Stucture
The file structure is as follows:
```
└── 400007969                                  # The base folder for the project; this folder is the root of the web server and is the only folder needed
    ├── app                                    # The main application folder
        └── config                             # The configuration folder
            └── config.php                     # Holds configurations for the application (database, etc)
        └── Controllers                        # The controllers folder        
            ├── BaseController.php             # An abstract class used to render a page and pass data to the view
            └── DashboardController.php        # The dashboard controller class
        └── Exceptions                         # Holds all Exceptions              
            └── DatabaseException.php
        └── Helpers                            # Holds all helper functions
            └── Role.php                       # Enum of the roles used in the application
        └── Libs                               # Holds all libraries
            └── Validators                     
                └── BaseValidator.php          # An abstract class used to validate data and store basic validation functions, and return errors
        └── Models                             # Holds all Models, spilt into Entity and Repository   
            ├── Entity
                └── User.php                   # The User entity class; holds all user data
            └── Repository
                └── UserRepository.php         # The User repository class; holds all database queries for the User entity
        └── Service                            # Holds all services
            └── Validator                      # Holds all validators
                └── UserValidator.php
            ├── Database.php                  # The database service class; handles connection to the database
            ├── AccessControl.php             # Class used to handle access to specific pages
            └── Session.php                   # Manages session states and data
        └── Views                             # Holds all views
            └── Dashboard.php
    └── css                                   # Holds all css files
        ├── tailwind.css                      # Needed for tailwindcss to work
        └── main.css                          # TailwindCSS generated file, when running npm run css-watch / npm run css-build
├── package.json                              # Holds all npm packages
├── Plagiarism_Accountability_Statement.pdf   # Required for assignment
├── *.sql                                     # The database file, if needed for grading
└── tailwind.config.js                        # TailwindCSS configuration file
```

## Design
The use of the namespaces allowed for the autoloading of classes. *it was simpler to use namespaces than to create a custom autoloader*.


The idea was that each Controller controls a single page so by default the render function will display the page that matches the controller name. 
For example, the DashboardController will render the Dashboard.php view. The render function also takes an array of data that will be passed to the view.
This function can be overridden in the child class if needed. The BaseController also has a function called redirect that will redirect the user to a specific page and pass an array of variables, that may be needed to display
on the page. Each Controller can have its own validator class that extends the BaseValidator class. The BaseValidator class has a function called validate that takes an array of data and returns an array of errors. 
The BaseController has a function called validate that will call the validate function in the validator class and return the errors. If there are no errors then the BaseController will call the render function and pass the data to the view.


## Assumptions
 - The Create User page should validate the data before creating the user and hash the password before storing it in the database.
 - The Registering of a User defaults to the Researcher role.
 - Since the database had no relationships between tables, I assumed that the User table was enough for the project.