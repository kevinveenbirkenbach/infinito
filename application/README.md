## Application
## Architecture

### Design Principles
The software MUST follow this design principles:

#### [Domain Driven Design](https://de.wikipedia.org/wiki/Domain-driven_Design)
The software MUST use a DDD architecture.

#### [SOLID](https://de.wikipedia.org/wiki/Prinzipien_objektorientierten_Designs#SOLID-Prinzipien)
SOLID allows to easy maintain and expand the functions of the software.

It is based on the following princibles:
- [Single-Responsibility-Prinzip](https://de.wikipedia.org/wiki/Single-Responsibility-Prinzip)
- [Open-Closed-Prinzip](https://de.wikipedia.org/wiki/Open-Closed-Prinzip)
- [Liskov substitution principle](https://en.wikipedia.org/wiki/Liskov_substitution_principle)
- [Interface-Segregation-Prinzip](https://de.wikipedia.org/wiki/Interface-Segregation-Prinzip)
- [Dependency Inversion Prinzip](https://de.wikipedia.org/wiki/Dependency-Inversion-Prinzip)

#### [12 factor](https://12factor.net/)
The following 12 factor allow to get the application ready for [IaaS](https://de.wikipedia.org/wiki/Everything_as_a_Service) and make it [high scalable](https://en.wikipedia.org/wiki/Scalability):

##### I. Codebase
One codebase tracked in revision control, many deploys
##### II. Dependencies
Explicitly declare and isolate dependencies
##### III. Config
Store config in the environment
#### IV. Backing services
Treat backing services as attached resources
##### V. Build, release, run
Strictly separate build and run stages
##### VI. Processes
Execute the app as one or more stateless processes
##### VII. Port binding
Export services via port binding
##### VIII. Concurrency
Scale out via the process model
##### IX. Disposability
Maximize robustness with fast startup and graceful shutdown
##### X. Dev/prod parity
Keep development, staging, and production as similar as possible
##### XI. Logs
Treat logs as event streams
##### XII. Admin processes
Run admin/management tasks as one-off processes

## Tested
The software MUST be automized tested by the following tests:

- [Functional tests](https://en.wikipedia.org/wiki/Functional_testing)
- [Integration tests](https://de.wikipedia.org/wiki/Integrationstest)
- [Unit Tests](https://en.wikipedia.org/wiki/Unit_testing)

A test coverage of 100% must be reached.

### Continues Integration
The software MUST be [continues integrated](https://de.wikipedia.org/wiki/Kontinuierliche_Integration).

### Applications
The application is a merge out of two indepentend applications.
#### Core Application
More informations you will find in the [symfony README.md](./symfony/README.md)

This software offers the following interfaces:
##### [REST](https://de.wikipedia.org/wiki/Representational_State_Transfer)
This interface allows a client, which can be e.g. a Java Application or an SPA to process the domain logic.

##### HTML
This interface offers an static GUI which allows the user to execute basic tasks.

#### Single Page Application
This application offers a [SPA](https://en.wikipedia.org/wiki/Single-page_application) on the base of [Vue.js](https://vuejs.org/) to allow a good and dynamic user experience.

More informations you will find in the [node README.md](./node/README.md)
