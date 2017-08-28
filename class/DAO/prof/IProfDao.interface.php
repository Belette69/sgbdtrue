<?php
namespace sgbdtrue\DAO\prof;


use sgbdtrue\entities\prof\Prof;

interface IProfDao
{
    /**
     * @param Prof $prof
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(Prof $prof);

    /**
     * @param Prof $prof
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(Prof $prof);

    /**
     * @param $id int
     * @return Prof | null
     */
    public function findById($id);

    /**
     * @return multitpe:Prof
     */
    public function findAll();


}