<?php

namespace sgbdtrue\entities\classroom;


class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string | défini dans la classe Gender
     */
    private $gender;
    /**
     * @var string
     */
    private $email;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {

        $this->id = (int)$id;
        if($this->id === 0)
            $this->id = null;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return défini|string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param défini|string $gender
     */
    public function setGender($gender)
    {
        if($gender == Gender::F)
            $this->gender = $gender;
        else
            $this->gender = Gender::M;


    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }






}