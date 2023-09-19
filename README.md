# Laravel Validator

## Laravel package that extends default laravel validator

<!-- TOC -->
* [Laravel Validator](#laravel-validator)
  * [Laravel package that extends default laravel validator](#laravel-package-that-extends-default-laravel-validator)
  * [Installation](#installation)
  * [Validator](#validator)
    * [Validate function](#validate-function)
    * [Code function](#code-function)
    * [Messages function](#messages-function)
    * [Status Code function](#status-code-function)
  * [Rules](#rules)
    * [Exists rule](#exists-rule)
    * [IsInteger rule](#isinteger-rule)
    * [IsString rule](#isstring-rule)
    * [IsArray rule](#isarray-rule)
<!-- TOC -->

## Installation

```bash
composer require wamesk/laravel-validator
```

**Publish translations**

```bash
php artisan vendor:publish --provider="Wame\Validator\LaravelValidatorServiceProvider" --tag="translations"
```

## Validator

Validator used by default in this package.
It works by chaining functions and getting response.
Response is generated by `wamesk/laravel-api-response` package functions.
To better understand how response works checkout documentation for response package [here](https://github.com/wamesk/laravel-api-response)

### Validate function

This function is final function. Always last.
It requires data and rules for validation.
Documentation for rules [click here](https://laravel.com/docs/9.x/validation)

Usage example:

```php
$data = ['email' => 'example@gmail.com', 'password' => 'password'];

$validator = Validator::validate($data, [
    'email' => 'email|required|max:255',
    'password' => 'required|string'
]);
if ($validator) return $validator;
```

In case of validation error it will return

```json
{
    "data": null,
    "code": null,
    "errors": {
        "email": [
            "validation.required"
        ]
    },
    "message": null
}
```

### Code function

This function is add internal code in response.
You can pass second parameter that changes prefix for message translation.

Usage example:

```php
$data = ['email' => 'example@gmail.com', 'password' => 'password'];

$validator = Validator::code('1.2')->validate($data, [
    'email' => 'email|required|max:255',
    'password' => 'required|string'
]);
if ($validator) return $validator;
```

In case of validation error it will return

```json
{
    "data": "1.2",
    "code": null,
    "errors": {
        "email": [
            "The email field is required"
        ]
    },
    "message": "api.1.2"
}
```

### Messages function

This function adds custom response for validation.
You need to pass objects of which key is field, and it's validation.
As value, you pass your custom message as shown in example.

Usage example:

```php
$data = ['email' => 'example@gmail.com', 'password' => 'password'];

$validator = Validator::code('1.2')
    ->messages([
        'email.required' => 'Email is required'
    ])
    ->validate($data, [
        'email' => 'email|required|max:255',
        'password' => 'required|string'
    ]);
if ($validator) return $validator;
```

In case of validation error it will return

```json
{
    "data": "1.2",
    "code": null,
    "errors": {
        "email": [
            "Email is required"
        ]
    },
    "message": "api.1.2"
}
```

### Status Code function

This function doesn't change response visually but changes status code of response.
Default status code is 400 *(Bad Request)*.
If you want to chain all functions it can look like this.
Status code is always integer.

```php
Validator::statusCode($statusCode)->code($code)->messages($messages)->validate($data, $rules);
```

## Rules

This package also provides you with these custom rules for your project.

Usage:
```php
Validator::code($code)->validate($data, [
    'id' => [
        new Exists(User::class),
    ]
]);
```

### Exists rule

This rule validates if entity exists.
It requires model class in construct.
Firstly it validates if there is entity with this parameter in database.
Secondly it checks if it wasn't deleted, if it was it returns validation error.
You can pass second *(optional)* parameter *column name*.

```php
new \Wame\Validator\Rules\Exists(User::class, 'id')
```

### IsInteger rule

This rule validates if attribute is integer.
You can pass additional data (min, max) in construct to create range of acceptable integers.

```php
new \Wame\Validator\Rules\IsInteger(min: 10, max: 100)
```

### IsString rule

This rule validates if attribute is string.
You can pass additional data (min, max) to validate length of string.

```php
new \Wame\Validator\Rules\IsString(min: 10, max: 100)
```

### IsArray rule

This rule validates if attribute is array.
You can pass additional data (min, max) to validate length of array.

```php
new \Wame\Validator\Rules\IsString(min: 10, max: 100)
```

### IsEmail rule

Validates email format, checks domain existence, and optionally blocks temporary email domains in Laravel.
You can pass additional data (true, false) to enable some functions.

```php
new \Wame\Validator\Rules\IsEmail(domainMustExist: false, disableTempMail: false)
```
