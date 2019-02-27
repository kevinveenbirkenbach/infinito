# REST API Controller
The controllers use the [FOSRestBundle](https://symfony.com/doc/master/bundles/FOSRestBundle/index.html).
## Url Scheme
The scheme for the rest api is the following:

| Url | Methods  | Function |
|---|---|---|
| /{locale}/api/rest/{layer}.{format} | GET |    Returns the create information for an specific entity |
| /{locale}/api/rest/{layer}.{format} | POST | Creates a specific entity and returns it.  |
| /{locale}/api/rest/{layer}/{uri}.{format} | GET |    Returns a specific entity. Including all actions |
|  /{locale}/api/rest/{layer}/{uri}.{format} | PUT, PATCH | Updates a specific entity and returns it. |
| /{locale}/api/rest/{layer}/{uri}.{format} | DELETE | Deletes a specific entity|

If an layer of an entity doesn't implement an method it should redirect to the connected (source) entity which is responsible for this method.
### Optional GET Parameters
| Parameter | Type | Format | CRUD | Layer | Description | Standard |
|-----------|---------|--------|--------------|--------|-----------------------------------------------------------|----------------------------|
| version | integer | all | read, update | all | Which version of an entity should be used to be processed | Process newest version |
| class | string | all | create | source | Which class should be used for creation of an source | No class |
| view | string | html | read | all | Which view (action type) should be used for an layer. | All views will be loaded |
| frame | boolean | html | all | all | Shows the full html frame and not just the content part | Frame will be loaded |
| schema | boolean | json | all | all | Shows the schema of an entity.  | No schema will be returned |
| execute | boolean | all | read | source | Executes an entity | No execution will be done |

### Methods
In the future it would make sense to implement [more methods](https://de.wikipedia.org/wiki/Representational_State_Transfer#Umsetzung).

### Formats
The standard format of an entity MUST be JSON.

## Workflow
The abstract workflow of the REST API controllers for a singular entity looks like this:
![REST API Workflow](.meta/workflow.svg)
Special actions, e.g. lists are not shown in this diagram. This diagram also shows downstream procedures, to remember to implement them. Feel free to remove them from the diagram, as soon as they are documented somewhere else.
