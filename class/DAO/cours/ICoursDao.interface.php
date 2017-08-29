<?php
namespace sgbdtrue\DAO\cours;


use sgbdtrue\entities\cours\Cours;

interface ICoursDao
{
    /**
     * @param Cours $cours
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(Cours $cours);

    /**
     * @param Cours $cours
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(Cours $cours);

    /**
     * @param $id int
     * @return Cours | null
     */
    public function findById($id);

    /**
     * @return multiple:Cours
     */
    public function findAll();


}