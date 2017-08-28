<?php

namespace sgbdtrue\entities\prof;


class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $prenom;
    /**
     * @var string
     */
    private $nom;

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
    public function getprenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setprenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getnom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setnom($nom)
    {
        $this->nom = $nom;
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