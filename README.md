# HR Contacts

## Description

HR Contacts list provides a solution for users to login, register and creates their contacts with an interactive user interface. 

* After login user see a dashboard where he can view and add/edit/delete contacts. 
* A user can also search contacts by Name, Phone and Email.  


## Setup

**System requirements**

* PHP 7.1
* Composer
* Phalcon 3.4
* Phalcon dev tool
* MYSQL

## Development

Run the following commands in order to start the project

- `composer install`
- `phalcon migration --action=run`
- `phalcon serve`
- Open `http://localhost:8000/` in browser

**Note:** Change database details + base uri in `app/config/config.php`
and also `codeception.yml` for testing

## Testing

`Codeception` is used for test suite.

Execute either of these command to run the test cases.

```

- php vendor/bin/codecept run --steps
OR
-.\vendor\bin\codecept run --steps

```

