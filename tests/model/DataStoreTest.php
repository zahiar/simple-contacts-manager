<?php

require_once dirname(__FILE__) . '/../../src/model/DataStore.php';

class DataStoreTest extends PHPUnit_Framework_TestCase
{

    public function testGetPeople()
    {
        $filePath = dirname(__FILE__) . '/get_people_test.ser';

        $peopleDataSerialised = 'a:3:{i:0;s:7:"Leonard";i:1;s:9:"Hofstader";i:2;s:22:"Experimental physicist";}' . "\n";
        $peopleDataSerialised .= 'a:3:{i:0;s:7:"Sheldon";i:1;s:6:"Cooper";i:2;s:21:"Theoretical physicist";}' . "\n";
        $peopleDataSerialised .= 'a:3:{i:0;s:3:"Raj";i:1;s:11:"Koothrapali";i:2;s:21:"Particle astrophysics";}' . "\n";
        $peopleDataSerialised .= 'a:3:{i:0;s:6:"Howard";i:1;s:8:"Wolowitz";i:2;s:18:"Aerospace engineer";}' . "\n";
        $peopleDataSerialised .= 'a:3:{i:0;s:5:"Penny";i:1;s:0:"";i:2;s:0:"";}' . "\n";

        file_put_contents($filePath, $peopleDataSerialised);

        $dataStore = new \Model\DataStore($filePath);

        $expectedResult = array(
            new \Model\Person('Leonard', 'Hofstader', 'Experimental physicist'),
            new \Model\Person('Sheldon', 'Cooper', 'Theoretical physicist'),
            new \Model\Person('Raj', 'Koothrapali', 'Particle astrophysics'),
            new \Model\Person('Howard', 'Wolowitz', 'Aerospace engineer'),
            new \Model\Person('Penny', '', '')
        );

        $actualResult = $dataStore->getPeople();

        foreach ($expectedResult as $index => $expectedPerson) {
            $actualPerson = $actualResult[$index];

            $this->assertEquals($expectedPerson->getFirstname(), $actualPerson->getFirstname());
            $this->assertEquals($expectedPerson->getSurname(), $actualPerson->getSurname());
            $this->assertEquals($expectedPerson->getJobTitle(), $actualPerson->getJobTitle());
        }
    }

    public function testSavePeople()
    {
        $filePath = dirname(__FILE__) . '/save_people_test.ser';

        $people = array(
            new \Model\Person('Leonard', 'Hofstader', 'Experimental physicist'),
            new \Model\Person('Sheldon', 'Cooper', 'Theoretical physicist'),
            new \Model\Person('Raj', 'Koothrapali', 'Particle astrophysics'),
            new \Model\Person('Howard', 'Wolowitz', 'Aerospace engineer'),
            new \Model\Person('Penny', '', '')
        );

        $dataStore = new \Model\DataStore($filePath);
        $dataStore->savePeople($people);

        $expectedResult = 'a:3:{i:0;s:7:"Leonard";i:1;s:9:"Hofstader";i:2;s:22:"Experimental physicist";}' . "\n";
        $expectedResult .= 'a:3:{i:0;s:7:"Sheldon";i:1;s:6:"Cooper";i:2;s:21:"Theoretical physicist";}' . "\n";
        $expectedResult .= 'a:3:{i:0;s:3:"Raj";i:1;s:11:"Koothrapali";i:2;s:21:"Particle astrophysics";}' . "\n";
        $expectedResult .= 'a:3:{i:0;s:6:"Howard";i:1;s:8:"Wolowitz";i:2;s:18:"Aerospace engineer";}' . "\n";
        $expectedResult .= 'a:3:{i:0;s:5:"Penny";i:1;s:0:"";i:2;s:0:"";}' . "\n";

        $actualResult = file_get_contents($filePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

}