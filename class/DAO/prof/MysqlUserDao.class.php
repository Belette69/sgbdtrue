<?php


namespace sgbdtrue\DAO\prof;


use sgbdtrue\entities\prof\Prof;

class MysqlProfDao implements IProfDao
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
     * @param Prof $prof
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(Prof $user)
    {
        if($prof->getId() === null)
            $this->insert($prof);
        else
            $this->update($prof);

    }

    /**
     * @param Prof $prof
     * @return void
     * @throws \PDOException
     */
    private function insert(Prof $prof)
    {

        $sql = "INSERT INTO sgbdtrue.professeurs (id, prenom, nom,  email) 
                  VALUES (null, :prenom, :nom, :email);";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':prenom', $prof->getPrenom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':nom', $prof->getNom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':email', $prof->getEmail(), \PDO::PARAM_STR);

        $preparedStatement->execute();

        $lastId = $this->pdo->lastInsertId();
        $prof->setId($lastId);


    }
    /**
     * @param Prof $prof
     * @return void
     * @throws \PDOException
     */
    private function update(Prof $prof)
    {

        $sql = "UPDATE sgbdtrue.professeurs SET prenom = :prenom, nom = :nom, email = :email WHERE id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':prenom', $prof->getPrenom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':nom', $prof->getNom(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':email', $prof->getEmail(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':id', $prof->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

    }



    /**
     * @param Prof $prof
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(Prof $prof)
    {
        if($prof->getId() === null)
            throw new \LogicException("Id can't be null");

        $sql = "DELETE FROM sgbdtrue.professeurs  WHERE id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);

        $preparedStatement->bindValue(':id', $prof->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

        $prof->setId(null);

    }

    /**
     * @param $id int
     * @return Prof | null
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM sgbdtrue.professeurs  WHERE id = :id LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':id', $id, \PDO::PARAM_INT);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeProfFromRow($row);;


    }

    /**
     * @return multitpe:Prof
     */
    public function findAll()
    {
        $sql = "SELECT * FROM sgbdtrue.professeurs ORDER BY prenom, nom ASC";
        $statement = $this->pdo->query($sql);

        $profList = [];
        while(false !== ($row = $statement->fetch(\PDO::FETCH_ASSOC)))
        {

            $profList[] =  $this->makeProfFromRow($row);
        }

        return $profList;
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM sgbdtrue.professeurs  WHERE email = :email LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':email', $email, \PDO::PARAM_INT);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeProfFromRow($row);;
    }

    private function makeProfFromRow(array $row)
    {
        $prof = new Prof();
        $prof->setId($row['id']);
        $prof->setEmail($row['email']);
        $prof->setPrenom($row['prenom']);
        $prof->setNom($row['nom']);
        return $prof;
    }


}