# PHP TDD

php extensions

```text
* DOM
* JSON
* PCRC
* Reflection
* SPL
* XMLWriter
* Xdbug
```

[getComposer](https://getcomposer.org/)

## [PHP Unit Assertions](https://phpunit.de/manual/6.5/en/appendixes.assertions.html)

```bash
 vendor/bin/phpunit tests
```

## Arrange-Act_Assert

* Arrange -- All necessary preconditions and inputs
* Act -- On the object or method under test
* Assert -- That the expected results have occurred

## General Principles

* Test in isolation
* Test only a few things at once or even just jone thing at once
* Tests should be easy to write, a hard test generally means
    re-write your implementation

## Test Double

a generic term for any case where you replace a production object
    for testing purposes
[link](http://www.martinfowler.com/bliki/TestDouble.html)

### Uses

* Replace a dependency
* Ensure a conditon occurs
* Improve the performance of our tests

```php
public function add($data = []) {
    if ($this->Model->validate($data)) {
        $result = $this->Model->save($data);
        return $this->processSave($result)
    }
    $this->Log->warning($data);
}
```

* Make it fast
* Make it isolated
* Make it fully covered

### Test Double objects

* Dummy

```php
    // Replaces an object typically as an input,
    // that isn't used or needed for the test.
    public function __construct(Database $db, ArrayObject $config) {
        if(!$db->isConnected()) {
            throw new Exception('Database is not connected');
        }
        .....
    }
```

* Fake

```php
    // Replaces an object in which we need a simplified
    // version of the object, typically to achieve speed
    // improvements or to eliminate side effects.
    public function save($data) {
        ...
        return $this->DB->sql();
    }
```

* Stub

```php
    // Provides a preset anser to method calls that
    // we have decided ahead of time.
    public function __construct(Database $db, ArrayObject $config) {
        if(!$db->isConnected()) {
            throw new Exception('Database is not connected');
        }
        .....
    }
```

* Spy

```php
    // A spy acts as a higher level stub, it allow us to
    // also record information about what happened with this
    // test double.
    public function sendMessage(Email $email, Messages $messages) {
        foreach($messages as $message) {
            $email->send($message)
        }
        .....
    }
```

* Mock

```php
    // A mock acts as a higher level stub, they are pre-
    // programmed with expectations, including the ability
    // to both respond to calls they know about and don;t
    // know about
    public function sendMessage(Email $email, Messages $messages) {
        foreach($message as $message) {
            if ($message->readyToSend()) {
                $email->send($message);
            }
        }
        .....
    }
```

## Test Doubles are core to unit testing
