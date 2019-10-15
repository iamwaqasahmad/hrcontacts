# HR Contacts

## Setup

**System requirements**

* PHP 7.1
* Composer
* Phalcon 3.4
* Phalcon dev tool
* MYSQL

## Development

Run the following commands in order to start the project

- `git clone git@github.com:iamwaqasahmad/hrcontacts.git`
- `composer install`
- `phalcon migration --action=run`
- `phalcon serve`

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

