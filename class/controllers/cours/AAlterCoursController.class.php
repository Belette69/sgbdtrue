<?php


namespace sgbdtrue\controllers\cours;


use sgbdtrue\entities\cours\Cours;
use sgbdtrue\controllers\IController;

abstract class AAlterCoursController implements IController
{

    protected $idsProf;
    protected $profDao;

    protected final function validPostedDataAndSet(Cours $cours)
    {
        $cours->setId(isset($_POST['id'])?(int)$_POST['id']:"");
        $invalidFields = array();

        $cours->setIntitule(isset($_POST['intitule']) ? trim($_POST['intitule']) : "");
        if($cours->getIntitule() == "")
        {
            $invalidFields[] = 'intitule';
        }

        $cours->setPeriode(isset($_POST['periode']) ? trim($_POST['periode']) : "");
        if($cours->getPeriode() == "")
        {
            $invalidFields[] = 'periode';
        }

        if(isset($_POST['id_prof']) && in_array($_POST['id_prof'],$this->idsProf)){
            $cours->setProf($this->profDao->findById((int)$_POST['id_prof']));
        }
        else{
            $invalidFields[]='id_prof';
        }

        $cours->setAnneeScolaire(isset($_POST['annee_scolaire']) ? trim($_POST['annee_scolaire']) : "");
        if($cours->getAnneeScolaire() == "")
        {
            $invalidFields[] = 'annee_scolaire';
        }
        
        return $invalidFields;

        


    }
}