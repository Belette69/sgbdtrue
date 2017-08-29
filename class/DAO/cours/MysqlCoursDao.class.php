<?php


namespace sgbdtrue\DAO\cours;


use sgbdtrue\entities\cours\Cours;
use sgbdtrue\entities\prof\Prof;
use sgbdtrue\DAO\prof\MysqlProfDao;

class MysqlCoursDao implements ICoursDao
{
    /**
     * @var \PDO
     */
    private $pdo;

    private $profDao;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param Cours $cours
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(Cours $cours)
    {
        if($cours->getId() === null)
            $this->insert($cours);
        else
            $this->update($cours);

    }

    /**
     * @param Cours $cours
     * @return void
     * @throws \PDOException
     */
    private function insert(Cours $cours)
    {

        $sql = "INSERT INTO sgbdtrue.cours (id, intitule, periode, id_professeur, annee_scolaire) 
                  VALUES (null, :intitule, :periode, :id_professeur, :annee_scolaire);";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':intitule', $cours->getIntitule(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':periode', $cours->getPeriode(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':id_professeur', $cours->getProf()->getId(), \PDO::PARAM_INT);
        $preparedStatement->bindValue(':annee_scolaire', $cours->getAnneeScolaire(), \PDO::PARAM_STR);
        

        $preparedStatement->execute();

        $lastId = $this->pdo->lastInsertId();
        $cours->setId($lastId);
        


    }
    /**
     * @param Cours $cours
     * @return void
     * @throws \PDOException
     */
    private function update(Cours $cours)
    {
        $sql = "UPDATE sgbdtrue.cours SET intitule = :intitule, periode = :periode, id_professeur = :id_professeur, annee_scolaire = :annee_scolaire WHERE id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':intitule', $cours->getIntitule(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':periode', $cours->getPeriode(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':id_professeur', $cours->getProf()->getId(), \PDO::PARAM_INT);
        $preparedStatement->bindValue(':annee_scolaire', $cours->getAnneeScolaire(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':id', $cours->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

    }



    /**
     * @param Cours $cours
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(Cours $cours)
    {
        if($cours->getId() === null)
            throw new \LogicException("Id can't be null");

        $sql = "DELETE FROM sgbdtrue.cours  WHERE id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);

        $preparedStatement->bindValue(':id', $cours->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

        $cours->setId(null);

    }

    /**
     * @param $id int
     * @return Cours | null
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM sgbdtrue.cours  WHERE id = :id LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':id', $id, \PDO::PARAM_INT);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeCoursFromRow($row);;


    }

    /**
     * @return multitpe:Cours
     */
    public function findAll()
    {
        $sql = "SELECT * FROM sgbdtrue.cours ORDER BY intitule, periode ASC";
        $statement = $this->pdo->query($sql);

        $coursList = [];
        while(false !== ($row = $statement->fetch(\PDO::FETCH_ASSOC)))
        {

            $coursList[] =  $this->makeCoursFromRow($row);
        }

        return $coursList;
    }

    private function makeCoursFromRow(array $row)
    {
        $cours = new Cours();
        $cours->setId($row['id']);
        $cours->setIntitule($row['intitule']);
        $cours->setPeriode($row['periode']);
        $cours->setProf($this->getProfDao()->findById($row['id_professeur']));
        $cours->setAnneeScolaire($row['annee_scolaire']);
        return $cours;
    }

    private function getProfDao(){
        if($this->profDao==null){
            $this->profDao=new MysqlProfDao($this->pdo);
        }
        return $this->profDao;
    }


}