<?php
namespace sgbdtrue\DAO\secretariat;


use sgbdtrue\entities\secretariat\Secretariat;

interface ISecretariatDao
{
    /**
     * @param Secretariat $secretariat
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(Secretariat $secretariat);

    /**
     * @param Secretariat $secretariat
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(Secretariat $secretariat);

    /**
     * @param $id int
     * @return Secretariat | null
     */
    public function findById($id);

    /**
     * @return multitpe:Secretariat
     */
    public function findAll();


}