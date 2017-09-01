<?php


namespace sgbdtrue\DAO\secretariat;


use sgbdtrue\entities\secretariat\Secretariat;

class MysqlSecretariatDao implements ISecretariatDao
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
     * @param Secretariat $secretariat
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(Secretariat $secretariat)
    {
        if($secretariat->getId() === null)
            $this->insert($secretariat);
        else
            $this->update($secretariat);

    }

    /**
     * @param Secretariat $secretariat
     * @return void
     * @throws \PDOException
     */
    private function insert(Secretariat $secretariat)
    {

        $sql = "INSERT INTO sgbdtrue.secretariat (id, nom, prenom, email, numero, pseudo, password) 
                  VALUES (null, :nom, :prenom, :email, :numero, :pseudo, :password);";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':nom', $secretariat->getNom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':prenom', $secretariat->getPrenom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':email', $secretariat->getEmail(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':numero', $secretariat->getNumero(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':pseudo', $secretariat->getPseudo(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':password', $secretariat->getPassword(), \PDO::PARAM_STR);


        $preparedStatement->execute();

        $lastId = $this->pdo->lastInsertId();
        $secretariat->setId($lastId);


    }
    /**
     * @param Secretariat $secretariat
     * @return void
     * @throws \PDOException
     */
    private function update(Secretariat $secretariat)
    {

        $sql = "UPDATE sgbdtrue.secretariat SET nom = :nom, prenom = :prenom, email = :email, numero = :numero, pseudo = :pseudo, password = :password WHERE Id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':nom', $secretariat->getNom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':prenom', $secretariat->getPrenom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':email', $secretariat->getEmail(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':numero', $secretariat->getNumero(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':pseudo', $secretariat->getPseudo(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':password', $secretariat->getPassword(), \PDO::PARAM_STR);

        $preparedStatement->bindValue(':id', $secretariat->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

    }



    /**
     * @param Secretariat $secretariat
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(Secretariat $secretariat)
    {
        
        if($secretariat->getId() === null)
            throw new \LogicException("Id can't be null");

        $sql = "DELETE FROM sgbdtrue.secretariat  WHERE Id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);

        $preparedStatement->bindValue(':id', $secretariat->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

        $secretariat->setId(null);

    }

    /**
     * @param $id int
     * @return Secretariat | null
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM sgbdtrue.secretariat  WHERE Id = :id LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':id', $id, \PDO::PARAM_INT);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeSecretariatFromRow($row);;


    }

    /**
     * @return multitpe:Secretariat
     */
    public function findAll()
    {
        $sql = "SELECT * FROM sgbdtrue.secretariat ORDER BY nom, prenom ASC";
        $statement = $this->pdo->query($sql);

        $secretariatList = [];
        while(false !== ($row = $statement->fetch(\PDO::FETCH_ASSOC)))
        {

            $secretariatList[] =  $this->makeSecretariatFromRow($row);
        }

        return $secretariatList;
    }

    public function findByPseudo($pseudo)
    {
        $sql = "SELECT * FROM sgbdtrue.secretariat  WHERE pseudo = :pseudo LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':pseudo', $pseudo, \PDO::PARAM_STR);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeSecretariatFromRow($row);
    }

    private function makeSecretariatFromRow(array $row)
    {
        $secretariat = new Secretariat();
        $secretariat->setId($row['id']);
        $secretariat->setEmail($row['email']);
        $secretariat->setNom($row['nom']);
        $secretariat->setPrenom($row['prenom']);
        $secretariat->setNumero($row['numero']);
        $secretariat->setPseudo($row['pseudo']);
        $secretariat->setPassword($row['password']);
        
        return $secretariat;
    }


}