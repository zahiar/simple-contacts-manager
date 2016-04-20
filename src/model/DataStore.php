<?php

namespace Model;

require_once dirname(__FILE__) . '/Person.php';

class DataStore
{

    private $filepath,
        $file;

    public function __construct($filepath)
    {
        $this->setFilePath($filepath);

        $this->file = new \SplFileObject($filepath, 'c+');
    }

    public function setFilePath($filepath)
    {
        $this->filepath = $filepath;
    }

    public function getPeople()
    {
        $people = array();

        foreach ($this->file as $serialisedData) {
            $unserialisedData = unserialize($serialisedData);

            if ($unserialisedData !== false) {
                $people[] = new Person($unserialisedData[0], $unserialisedData[1], $unserialisedData[2]);
            }
        }

        return $people;
    }

    public function savePeople(array $peopleObjects)
    {
        $this->file->ftruncate(0);
        $this->file->rewind();

        foreach ($peopleObjects as $person) {
            /* @var $person Person */
            $array = array(
                $person->getFirstname(),
                $person->getSurname(),
                $person->getJobTitle()
            );
            $this->file->fwrite(serialize($array));

            $this->file->fwrite("\n");
        }
    }

}