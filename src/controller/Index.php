<?php

namespace Controller;

require_once dirname(__FILE__) . '/../model/DataStore.php';
use Model\DataStore;
use Model\Person;

class Index
{

    private $dataStore;

    private function getDataStore()
    {
        if ($this->dataStore instanceof DataStore) {
            return $this->dataStore;
        }

        $this->dataStore = new DataStore(dirname(__FILE__) . '/../data.ser');
        return $this->dataStore;
    }

    public function indexAction()
    {
        require_once dirname(__FILE__) . '/../view/index.php';
        exit;
    }

    public function getPeopleAction()
    {
        $returnStatus = array(
            'success' => false,
            'message' => '',
            'people' => array()
        );

        try {
            $people = $this->getDataStore()->getPeople();
        } catch (\RuntimeException $ex) {
            $returnStatus['message'] = 'Error: cannot load data due to - ' . $ex->getMessage();

            echo json_encode($returnStatus);
            exit;
        }

        $peopleArray = array();
        foreach ($people as $person) {
            /* @var $person Person */

            $peopleArray[] = array(
                'firstname' => $person->getFirstname(),
                'surname' => $person->getSurname(),
                'jobTitle' => $person->getJobTitle()
            );
        }

        $returnStatus['people'] = $peopleArray;
        $returnStatus['success'] = true;

        echo json_encode($returnStatus);
        exit;
    }

    public function savePeopleHandler()
    {
        $returnStatus = array(
            'success' => false,
            'message' => ''
        );

        $formDataRaw = file_get_contents('php://input');
        $formData = json_decode($formDataRaw, true);

        if (!is_array($formData)) {
            $returnStatus['message'] = 'Error: no data to save.';

            echo json_encode($returnStatus);
            exit;
        }

        foreach ($formData as $personData) {
            $firstname = filter_var($personData['firstname'], FILTER_SANITIZE_STRING);
            $firstname = trim($firstname);

            $surname = filter_var($personData['surname'], FILTER_SANITIZE_STRING);
            $surname = trim($surname);

            $jobTitle = filter_var($personData['jobTitle'], FILTER_SANITIZE_STRING);
            $jobTitle = trim($jobTitle);

            if (strlen($firstname) === 0 && strlen($surname) === 0 && strlen($jobTitle) === 0) {
                continue;
            }

            $peopleToSave[] = new Person($firstname, $surname, $jobTitle);
        }

        try {
            $this->getDataStore()->savePeople($peopleToSave);
            $returnStatus['success'] = true;
        } catch (\RuntimeException $ex) {
            $returnStatus['message'] = 'Error: cannot save data due to - ' . $ex->getMessage();
        }

        echo json_encode($returnStatus);
        exit;
    }

}