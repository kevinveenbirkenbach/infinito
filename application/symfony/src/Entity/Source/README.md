# Source
Sources are the core component of infinito.
## Purpose
The whole domain logic just processes sources. This allows a high layer of abstraction.
### Functions
- Heritage values from other sources
- Connect data of APIS, executable, and static documents
- High scalability of rights
- Versioning of every state of a source
- Process different kinds of types through a identical core of domain logic
- Easy to modify and to expand

## UML
The following UML shows the context of source entities.
![Entity UML](../.meta/uml.png)

## Types
### Primitive
Just contain out of one [MySQL native data type](https://dev.mysql.com/doc/refman/8.0/en/data-types.html).
### Complex
Contain out of other sources. E.g. primitives and executables.
#### Executable
Process information. They have a seperat class with logic, which is automaticly loaded and processed by the domain logic.
##### API
API sources adapt CRUD actions to other services.
