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
