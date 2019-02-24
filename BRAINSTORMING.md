# Brainstorming
This document is work in process and just contains some brainstorming ideas. 
## Interfaces

### Offered Interfaces
- REST ___(JSON, HTML, XML)___
- GUI ___(HTML)___
- CLI

### Offered Methods

| Entity\Action     | Create | Read | Update | Delete | Execute | Log | Schema |
|-------------------|--------|------|--------|--------|---------|-----|--------|
| Source            | x      | x    | x      | x      | x       | x   | x      |
| Right             | x      | x    | x      | x      |         | x   | x      |
| Law               |        | x    | x      |        |         | x   | x      |
| Member Relation   |        | x    | x      |        |         | x   | x      |
| Heredity Relation |        | x    | x      |        |         | x   | x      |
| Parent Relation   |        | x    |        |        |         | x   | x      |
### Method Description
#### Create
Creates an entity
#### Read
Reads an entity
#### Update
Updates an entity
#### Delete
Deletes an entity
#### Execute
Executes an entity
#### Log
Logs of an entity
##### Data
- timestamp
- client entity
- requested entity
- requested action

#### Schema
Schema of an entity

## Entities
### Source
A source is executable data.

### Law
A law contains rules, how to handle the rights

### Right
A right defines, which client source is allowed to commit an action to a layer of a requested source.
### Relations
#### Member Relation
The member relation describes which sources are members of which other sources.
#### Parent Relation
Describes which sources had been involved in the creation of sources.
#### Heredity Relation
Describes from which sources child sources inhere rights.
