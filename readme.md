# Flash

This package makes Laravel flash message more flexible. It can be used in laravel 5.5 or higher.

## Installation

```bash
composer require zaichaopan/flash
```

## Usage

In laravel, you can flash message like below

```php
$request->session()->flash($key, $message);
```

Or you can use the __with__ method when redirect

```php
// in your controller action method
return redirect()->with($key, $message);

// or take advantage of dynamically binding
return redirect()->withSuccess($message); // or withError, withWarning, ...
```

But the problem is when it comes to showing flash message in blade, your flash message may have different keys (e.g. error, success, ...). You have to check all the possible keys to determine if you have flash message to show in the blade. This package can be used to make things easier.

* To flash a message

This packages provides a global helper method __flash__ to create a Flash instance. After you create the Flash instance, there are five available methods you can call to generate five different types of flash messages. Each method takes two parameters: __message__ and __options.__

__The first one is required__ which is used to set the message body of the flash. __The second one is an array and it is optional.__ It is used to add addition data to the flash.

```php
// generate a general info message
flash()->info($message, $options) ;

// generate a success message
flash()->success($message, $options);

// generate a warning message
flash()->warning($message, $options);

// generate a danger message
flash()->danger($message, $options);

// generate an error message
flash()->error($message, $options);
```

* Check whether flash exists:

```html
<!-- your blade -->
@if (flash()->ready())
<!-- your flash html -->
@endif
```

* Get flash type:

```php
flash()->type();
```

* Get flash message

```php
flash()->message();
```

* Get additional option data

```php
flash()->options();
```

* Pass data to javascript

In real life, you may want to create a flash component in vue, which can be used to display the flash message from the server or from the js. To do that, let's say you have a component called __Flash.vue__ and there is a property called __flash__ inside it.

```html
<Flash :flash={{ json_encode(flash()) }}></Flash>
```

Now if there is no flash, the value of the __flash__ property will be null. If there is a flash message, the value will be an object contains properties: __message, type, options.__
