# Simplistic PHP View Renderer

This is a fun project, just to experiment what could be achieved with little effort.

So far following features have been implemented:

* Stable context in view templates (View::render)
* Buffered content rendering
* View variables (inherited or restricted)
* Global view variables (always available)
* Include other views inside a view (new variables can be passed through)
* Chainable view filters
* Resolvable custom View classes

## Test

For testing you may run built-in PHP server by running:

```shell
php -S localhost:8080
```

and go to http://localhost:8080/
