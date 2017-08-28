<?php
namespace sgbdtrue\exceptions\classroom;

class InvalidDataException extends \Exception
{
    /**
     * @var array
     */
    private $invalidData;

    public function __construct($message = "", array $invalidData = array())
    {
        $this->invalidData = $invalidData;
        parent::__construct($message);
    }


    /**
     * @return array
     */
    public function getInvalidData()
    {
        return $this->invalidData;
    }



}