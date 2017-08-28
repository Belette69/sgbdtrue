<?php

namespace sgbdtrue\entities\classroom;


class Classroom
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $local;
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
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * @param string $local
     */
    public function setLocal($local)
    {
        $this->local = $local;
    }

    






}