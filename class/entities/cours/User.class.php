<?php

namespace sgbdtrue\entities\cours;


class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $intitule;
    /**
     * @var varchar
     */

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
    public function getintitule()
    {
        return $this->intitule;
    }

    /**
     * @param string $intitule
     */
    public function setintitule($intitule)
    {
        $this->intitule = $intitule;
    }

    






}