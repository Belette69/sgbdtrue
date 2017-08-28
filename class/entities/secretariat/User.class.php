<?php

namespace sgbdtrue\entities\secretariat;


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