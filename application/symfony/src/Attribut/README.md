# Attribut
This folder containes the attributs which are used by entity, domain logic etc.
# Structure
Each attribut containes out of an interface and a trait.
## Interface
The interface MUST define a __get-__ and a __set-method__. Optional an interface can define a __has-method__.
### Methods
#### Set
The __setter__ MUST return nothing(void). It SHOULD throw an exception if the value is not valid.
#### Get
The __getter__ MUST return the attribute. Void is not allowed.
#### Has
__has__ must return an boolean. True if the attribut is defined, otherwise false.
## Trait
The trait represents the implementation of the interface. Also it contains an __private__ or __protected__ attribute, which is modified by the methods which are defined in the interface.
