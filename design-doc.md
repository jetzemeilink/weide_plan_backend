# Design Doc for Api implementation

## End points
* This project will follow the REST achitecture.

* All the resource names will be written in english

* The endpoints will have the following structure:

           Base url / the api version (currently v0.0.0) / resource to be requested

* No rate limiter will be used for now.


## authentication 
The authentication will be implemented using Symfony's Lexik-JWT Bundle

## Tests 
The Service and Domain layer should have every function tested using PHPUnit which means writing the corresponding tests for every new piece of the system. 
Feature tests will be added later.

