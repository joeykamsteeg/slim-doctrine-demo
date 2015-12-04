# Slim Framework with Doctrine (Demo)

A simple demo to show how Doctrine works with Slim Framework.

## Installation
1 Checkout the code and run the composer to download all the dependecies
```
	composer install
```
2 Configure your apache server for run the application in a browser

3 Open index.php and configure the database settings in the parameters of App object. Example:
```php
$app = new App( array(
	'DB_DRIVER' => 'pdo_mysql',
	'DB_HOST' => 'localhost',
	'DB_USER' => 'root',
	'DB_PASS' => 'root',
	'DB_NAME' => 'slim_doctrine'
) );
```

4 Now we need to create our database using Doctrine. Simpleway to navigate to this url (http://example.com/console/createschema) with a browser. If you got a blank page, the database should be created. **Never set this url open for public**

5 Add some entries to the user table.

6 Show all users: http://example.com/users

7 Show one user with unique id: http://example.com/users/1


## Usage

#### Updating database
Would you like to made some changes to a database entities. You can simply update the database by navigating to this url: ttp://example.com/console/updateschema **Never set this url open for public**

### User Calls

#### Cet a single user
```GET http://example.com/users/1```

#### Get list of users
```GET http://example.com/users```

#### New user
```POST http://example.com/users```

Key | Value
------------ | -------------
firstname | Joey
lastname | Kamsteeg
email | joey_kamsteeg@live.nl
password | trustno1

### Update user
```PUT http://example.com/users/ID```

Key | Value
------------ | -------------
firstname | Joey
lastname | Kamsteeg
email | joey_kamsteeg@live.nl
password | trustno1

### Delete user
`DELETE http://example.com/users/ID`