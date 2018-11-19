<?php

/**
 *Representation of "Bed" as a business entity 
 */
class Product
{
    private $code;
    private $floor;
    private $room;
    private $description;
    private $patient;
    private $status;
   


    public function __construct($code, $floor, $room, $description, $patient, $status)
    {
        $this->code = $code;
        $this->floor = $floor;
        $this->room = $room;
        $this->description = $description;
        $this->patient = $patient;
        $this->status = $status;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getFloor()
    {
        return $this->floor;
    }

    public function getRoom()
    {
        return $this->room;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPatient()
    {
        return $this->patient;
    }

    public function getStatus()
    {
        return $this->status;
    }

}