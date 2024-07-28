# Sulu Frontend Validation Bundle

## Installation

```bash
composer require pawsitiwe/sulu-frontend-validation-bundle
```

## Setup

### Service Registration

The extension needs to be registered as [symfony service](http://symfony.com/doc/current/service_container.html).

```yml
services:
    Pawsitiwe\Controller\ValidationController:
        arguments:
            $formBuilder: '@sulu_form.builder'
        tags: ['controller.service_arguments']
```
### Bundle Registration

```php
return [
    Pawsitiwe\SuluFrontendValidationBundle::class => ['all' => true],
]
```

### Route Registration
```yml
sulu_frontend_validation:
    resource: '@SuluFrontendValidationBundle/Resources/config/routes.yaml'
    prefix: /
```

## Usage

The route /validate-form-field returns the form validation as JSON

### Example Response

When the form has validation errors, the response will be in the following format:

```json
{
    "errors": {
        "email": [
            "This value is not a valid email address."
        ],
        "lastName": [
            "This value should not be blank."
        ]
    }
}
```

Each key in the errors object represents a form field, and the value is an array of error messages for that field.

### Successful Validation

When the form is valid, the response will be:

```json
{
    "message": "The form is valid!"
}
```

### Error Handling

If no form data is found in the request, the response will be:

```json
{
    "message": "No form data found"
}
```
