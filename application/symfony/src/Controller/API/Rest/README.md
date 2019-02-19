# REST API Controller
The controllers use the [FOSRestBundle](https://symfony.com/doc/master/bundles/FOSRestBundle/index.html).
## Url Scheme
The scheme for the rest api is the following:

| Url | Methods  | Function |
|---|---|---|
| api/rest/{entity}.{format} | HEAD |    Returns the create information for a specific entity |
| api/rest/{entity}.{format} | POST | Creates a specific entity and returns it.  |
| api/rest/{entity}/{uri}.{format} | GET |    Returns a specific entity. Including all actions |
| api/rest/{entity}/{uri}/{action}.{format} | GET | Returns the result for an action of an specific entity. |
| api/rest/{entity}/{uri}.{format} | PUT, PATCH | Updates a specific entity and returns it. |
| api/rest/{entity}/{uri}.{format} | DELETE | Deletes a specific entity|

If an concrete entity doesn't implement an method it should redirect to the connected entity which is responsible for this method.

In the future it would make sense to implement [more methods](https://de.wikipedia.org/wiki/Representational_State_Transfer#Umsetzung).

The standard format of an entity MUST be JSON.

## Workflow
The abstract workflow of the REST API controllers for a singular entity looks like this:
![REST API Workflow](.meta/workflow.svg)
Special actions, e.g. lists are not shown in this diagram. This diagram also shows downstream procedures, to remember to implement them. Feel free to remove them from the diagram, as soon as they are documented somewhere else.
