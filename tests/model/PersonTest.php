<?php

require_once dirname(__FILE__) . '/../../src/model/Person.php';

class PersonTest extends PHPUnit_Framework_TestCase
{

    public function testFirstname()
    {
        $person = new \Model\Person('Zahiar', 'Ahmed', 'Software Developer');
        $this->assertEquals('Zahiar', $person->getFirstname());
    }

    public function testSurname()
    {
        $person = new \Model\Person('Zahiar', 'Ahmed', 'Software Developer');
        $this->assertEquals('Ahmed', $person->getSurname());
    }

    public function testJobTitle()
    {
        $person = new \Model\Person('Zahiar', 'Ahmed', 'Software Developer');
        $this->assertEquals('Software Developer', $person->getJobTitle());
    }

}