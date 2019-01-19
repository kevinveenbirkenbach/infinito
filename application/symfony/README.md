# Core Application

## Conventions

### Symfony
The application MUST use [Symfony 4. coding standards](https://symfony.com/doc/current/contributing/code/standards.html).

### PHP
PHP code MUST follow the [PSR-4](https://www.php-fig.org/psr/psr-4/) standard.

### Twig
Twig templates MUST follow the [Symfony Template best practices](https://symfony.com/doc/current/best_practices/templates.html).

### Naming

#### Interfaces

A Interfaces MUST be named *ClassnameInterface*.

It SHOULD be based in the directory of the class.

Each class SHOULD implement an interface.

#### Abstract Classes

A abstract class MUST be named *AbstractClassname*.

It SHOULD be based in the directory of the classes which inherit from it.

## Technologies
The following Symfony related components will be used:
- [Services](https://symfony.com/doc/current/service_container.html)
- [ORM](https://symfony.com/doc/current/doctrine.html)
- [Routing](https://symfony.com/doc/current/routing.html)
- [Form](https://symfony.com/doc/current/forms.html)
- [Validation](https://symfony.com/doc/current/validation.html)
- [Events](https://symfony.com/doc/current/event_dispatcher.html)
- [Twig](https://twig.symfony.com/)
- [REST](https://symfony.com/doc/master/bundles/FOSRestBundle/index.html)
- [User Bundle](https://symfony.com/doc/current/bundles/FOSUserBundle/index.html)

## Domain
More information about the domain logic you will find in [./src/Domain/README.md](./src/Domain/README.md).
