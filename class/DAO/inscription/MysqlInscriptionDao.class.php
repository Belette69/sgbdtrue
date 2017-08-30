<?php
namespace sgbdtrue\DAO\inscription;


use sgbdtrue\entities\cours\Cours;
use sgbdtrue\entities\eleve\Eleve;


class MysqlInscriptionDao implements IInscriptionDao
{
    
    /**
     * @var \PDO
     */
    private $pdo;
    private $coursDao;
    private $eleveDao;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param Eleve $eleve, Cours $cours
     * @return void
     * @throws \PDOException
     */
    public function insert(Eleve $eleve, Cours $cours){
        $sql = "INSERT INTO sgbdtrue.inscriptions (id_eleve, id_cours) 
                  VALUES (:id_eleve, :id_cours);";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':id_eleve', $eleve->getId(), \PDO::PARAM_INT);
        $preparedStatement->bindValue(':id_cours', $cours->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

    }

    /**
     * @param Eleve $eleve, Cours $cours
     * @return void
     * @throws \PDOException
     */
    public function delete(Eleve $eleve, Cours $cours){

        $sql = "DELETE FROM sgbdtrue.inscriptions  WHERE id_eleve = :id_eleve AND id_cours = :id_cours LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);

        $preparedStatement->bindValue(':id_eleve', $eleve->getId(), \PDO::PARAM_INT);
        $preparedStatement->bindValue(':id_cours', $cours->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();
    }

    /**
     * @param Eleve $eleve
     * @return multiple:Cours
     */
    public function getCoursForThisEleve(Eleve $eleve){
        $sql = "SELECT cours.id, cours.intitule FROM sgbdtrue.cours INNER JOIN sgbd.inscription ON cours.id = inscription.id_cours  WHERE inscription.id_eleve = :id_eleve ";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':id_eleve', $eleve->getId(), \PDO::PARAM_INT);
        $preparedStatement->execute();

        $coursList=[];
        while(false !== ($row = $statement->fetch(\PDO::FETCH_ASSOC))){
            $cours=new Cours();
            $cours->setId($row['id']);
            $cours->setIntitule($row['intitule']);
            $coursList[]=$cours;
        }


        if($row === false)
            return null;

        return $coursList;
    }

    /**
     * @param Cours $cours
     * @return multiple:Eleve
     */
    public function getEleveForThisCours(Cours $cours){
        $sql = "SELECT eleve.id, eleve.nom, eleve.prenom FROM sgbdtrue.eleve INNER JOIN sgbd.inscription ON eleve.id = inscription.id_eleve  WHERE inscription.id_cours = :id_cours ";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':id_cours', $cours->getId(), \PDO::PARAM_INT);
        $preparedStatement->execute();

        $elevesList=[];
        while(false !== ($row = $statement->fetch(\PDO::FETCH_ASSOC))){
            $eleve=new Eleve();
            $eleve->setId($row['id']);
            $eleve->setNom($row['nom']);
            $eleve->setPrenom($row['prenom']);
            $elevesList[]=$eleve;
        }


        if($row === false)
            return null;

        return $elevesList;
    }

}