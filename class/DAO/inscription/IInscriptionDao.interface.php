<?php
namespace sgbdtrue\DAO\inscription;


use sgbdtrue\entities\cours\Cours;
use sgbdtrue\entities\eleve\Eleve;

interface IInscriptionDao
{
    /**
     * @param Eleve $eleve, Cours $cours
     * @return void
     * @throws \PDOException
     */
    public function insert(Eleve $eleve, Cours $cours);

    /**
     * @param Eleve $eleve, Cours $cours
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(Eleve $eleve, Cours $cours);

}