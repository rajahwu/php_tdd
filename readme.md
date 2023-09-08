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