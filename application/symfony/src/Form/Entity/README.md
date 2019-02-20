# Entity Forms
This folder contains the forms for the entities.

## Scheme
The scheme for entities is the following:

| Name | Action | Description |
|---|---|---|
| ***{Entity}Type*** | general | General form for all actions, if no subform for an action is specified. |
| ***{Entity}{Action}Type*** | create, update, delete | This form maps to an special action type and allows to specify some subattributs of the action. |

## Mapping

The priority of the class mapping is the follow:

1. Use ***{Entity}{Action}Type***
2. Use ***{Entity}Type***
3. Use ***{Entity}{Action}Type*** of parent folder
4. Use ***{Entity}Type*** of parent folder

Steps 3 and 4 will be executed till a class is found
