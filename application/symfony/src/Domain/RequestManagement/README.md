# Request Management
The request management works with different layers.

### Layers
Each layer contains out of __2 classes__ and __2 interfaces__ for it.
One class contains the __logic__ and the other class contains the __service__. This makes the classes easier testable and mockable and follows the [SOLID Design Principles](https://en.wikipedia.org/wiki/SOLID). The layer order you can keep in mind with the acronym __RUAE__: __R__ight__U__ser__A__ction__E__ntity.

#### Right
This is the basic request layer from which the other layers inhiere. 
#### User
#### Action
#### Entity
