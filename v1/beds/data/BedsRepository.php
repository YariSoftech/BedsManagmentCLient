<?php

/**
 * Concrete implementation of the product repository
 */
class BedRepository implements IBedsRepository
{
    private $sqlBedsDataSource;

    public function __construct(BedsDataSource $bedsDataSource)
    {
        $this->sqlBedsDataSource = $bedsDataSource;
    }


    public function getAllBeds()
    {
        return $this->sqlBedsDataSource->retrieve();
    }
}