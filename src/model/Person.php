<?php

namespace Model;

class Person
{

    private $firstname,
        $surname,
        $jobTitle;

    public function __construct($firstname, $surname, $jobTitle)
    {
        $this->setFirstname($firstname);
        $this->setSurname($surname);
        $this->setJobTitle($jobTitle);
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;
    }

    public function getJobTitle()
    {
        return $this->jobTitle;
    }

}