# Domain
This folder contains the [domain logic](https://en.wikipedia.org/wiki/Business_logic) of the application.

## Conventions
### Services
Classes which are optimized to be injected as a service MUST end on the suffix **Service.php**.
## Folders
A folder MUST end on the suffix **Management.php** to show that it has the purpose to manage something.

# Domain Overview

## Repository Management
### Layer Repository Factory Service
Offers a fabric to produce entity repositories by layer
## Entity Management
### Entity Meta Information ###
Offers some meta information about an entity

## Form Management
- FormMetaInformation

## Law Management
### LawPermissionChecker ###
Allows to check if a right has permission by a law.

## Member Management
### Member Manager ###
Allows to add and remove members and memberships from member relations.

## Path Management

### Namespace Path Map ###
Maps a path to a namespace.

## Request Management

Offers classes to manage requests for rights, users and sources. A [detailed description](./RequestManagement/README.md) is available.
## Right Management
### Right Checker ###
Checks if the crud, layer and source combination is granted by a right.
### Right Layer Combination Service ###
Allows to get the possible cruds for a layer, or the possible layers for a crud.
## Source Management
### Source Member Information ###
Offers to get all source members over all dimensions.
### Source Member Manager
Offers to add and remove source members and memberships.
### Source Membership Information
Offers to get all memberships of a source.
### Source Right Manager
Allows to add and remove rights of a source.
### Tree Source Information
Allows to get branches and leaves of a tree.
## Template Management
### Template Path Management
Manages all informations which are needed to process templates.
## User Management
### User Source Director
Offers based on an user variable a user with a source.
### User Source Director Service
Offers the _user source director_ to be used as a service, based on the _entity manager_ and _security_.
