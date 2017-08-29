<?php


namespace sgbdtrue\DAO\eleve;


use sgbdtrue\entities\eleve\Eleve;

class MysqlEleveDao implements IEleveDao
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param Eleve $eleve
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(Eleve $eleve)
    {
        if($eleve->getId() === null)
            $this->insert($eleve);
        else
            $this->update($eleve);

    }

    /**
     * @param Eleve $eleve
     * @return void
     * @throws \PDOException
     */
    private function insert(Eleve $eleve)
    {

        $sql = "INSERT INTO sgbdtrue.eleves (id, nom, prenom,  email) 
                  VALUES (null, :nom, :prenom, :email);";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':nom', $eleve->getNom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':prenom', $eleve->getPrenom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':email', $eleve->getEmail(), \PDO::PARAM_STR);

        $preparedStatement->execute();

        $lastId = $this->pdo->lastInsertId();
        $eleve->setId($lastId);


    }
    /**
     * @param Eleve $eleve
     * @return void
     * @throws \PDOException
     */
    private function update(Eleve $eleve)
    {

        $sql = "UPDATE sgbdtrue.eleves SET nom = :nom, prenom = :prenom, email = :email WHERE Id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':nom', $eleve->getNom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':prenom', $eleve->getPrenom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':email', $eleve->getEmail(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':id', $eleve->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

    }



    /**
     * @param Eleve $eleve
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(Eleve $eleve)
    {
        
        if($eleve->getId() === null)
            throw new \LogicException("Id can't be null");

        $sql = "DELETE FROM sgbdtrue.eleves  WHERE id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);

        $preparedStatement->bindValue(':id', $eleve->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

        $eleve->setId(null);

    }

    /**
     * @param $id int
     * @return Eleve | null
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM sgbdtrue.eleves  WHERE id = :id LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':id', $id, \PDO::PARAM_INT);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeEleveFromRow($row);;


    }

    /**
     * @return multitpe:Eleve
     */
    public function findAll()
    {
        $sql = "SELECT * FROM sgbdtrue.eleves ORDER BY nom, prenom ASC";
        $statement = $this->pdo->query($sql);

        $eleveList = [];
        while(false !== ($row = $statement->fetch(\PDO::FETCH_ASSOC)))
        {

            $eleveList[] =  $this->makeEleveFromRow($row);
        }

        return $eleveList;
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM sgbdtrue.eleves  WHERE email = :email LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':email', $email, \PDO::PARAM_INT);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeEleveFromRow($row);;
    }

    private function makeEleveFromRow(array $row)
    {
        $eleve = new Eleve();
        $eleve->setId($row['id']);
        $eleve->setEmail($row['email']);
        $eleve->setNom($row['nom']);
        $eleve->setPrenom($row['prenom']);
        
        return $eleve;
    }


}