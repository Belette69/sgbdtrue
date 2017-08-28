<?php
namespace sgbdtrue\DAO\eleve;


use sgbdtrue\entities\eleve\Eleve;

interface IEleveDao
{
    /**
     * @param Eleve $eleve
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(Eleve $eleve);

    /**
     * @param Eleve $eleve
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(Eleve $eleve);

    /**
     * @param $id int
     * @return Eleve | null
     */
    public function findById($id);

    /**
     * @return multitpe:Eleve
     */
    public function findAll();


}