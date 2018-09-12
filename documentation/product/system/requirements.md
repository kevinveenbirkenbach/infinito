The key words “MUST”, “MUST NOT”, “REQUIRED”, “SHALL”, “SHALL NOT”, “SHOULD”,
“SHOULD NOT”, “RECOMMENDED”, “MAY”, and “OPTIONAL” in this document are to be
interpreted as described in [RFC 2119](https://tools.ietf.org/html/rfc2119).

"entity" or "entities" are to be interpreted as [Doctrine Objects](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/working-with-objects.html).

**Bold** words define a unique type.

# requiremts

## interfaces
The application MUST contain the following interfaces:
* HTML
* JSON

## actors

### user
The application MUST provide the following functions:
* delete user
* register user
* modify user
* create user (child)
* login
* logout

A **user** MUST have one **node**.

A **user** MUST be a **source**.

### law
A **law** MUST belong exclusive to a **node**.

A **law** MUST contain one of each of **right** types one time.

#### right
A **right** MUST NOT be a **source**.

A **right** MUST belong to a **law**.

A **right** MUST be of one of the following types:
* read
* write
* administrate

#### permission
A **permission** MAY have a father from which it inherit.

A **permission** MUST belong to a **right**.

A **permission** MUST allow blacklisting.

A **permission** MUST allow whitelisting.

A **permission** MUST allow that it applies to the parent **relative collection** s of the rule set.

A **permission** MUST allow that it applies to the child **relative collection** s of the rule set.

A **permission** MUST contain a **collection** on which the rule set applies.

### node
A **node** MUST have one **source**.

A **node** MUST contain a parent **relative collection**.

A **node** MUST contain a children **relative collection**.

A **node** MAY be a member of one or more **relative collection** s.

A **node** MAY be a member of one or more **collection** entity.


A **node** MUST have a **law**.

A **node** MUST have a **history**.

#### relative collection

A **relative collection** MUST belong to a **node**.

A **relative collection** MUST contain **node** s.

A **relative collection** MUST provide the following functions:
* get all relatives
* get specific relative
* get relatives
* get relatives of generation

### source
A **source** MUST have one node.

A **source** MUST be an entity.

A **source** MUST contain a file fabric.

#### entities
Sources MUST be on of the following entities:

entity|attributes
--- | ---
user|username,password,identity
identity|names,addresses
address|
date|datetime
name|string
birthday|date
death|date
text|text(varchar)
collection|nodes
live|birthday,death

#### file

A **file** MUST be on of the following types:

* HTML
* JSON
* XML
* TEXT
* CSV
* JPG

It SHOULD be possible to export a **file** to one or more other **file** s.

It MUST be possible to edit a **file**.

IT MUST be possible to save a **file**.

#### collection
A **source** MAY contain other **nodes**.

### history
A **history** MUST log all of the actions which happen to a **node**.

A **history** MUST exclusive belong to a **node**.

A **history** MUST allow to give the state of a **node** of a special date back.
