<?php


namespace sgbdtrue\DAO\classroom;


use sgbdtrue\entities\classroom\User;

class MysqlUserDao implements IUserDao
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
     * @param User $user
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(User $user)
    {
        if($user->getId() === null)
            $this->insert($user);
        else
            $this->update($user);

    }

    /**
     * @param User $user
     * @return void
     * @throws \PDOException
     */
    private function insert(User $user)
    {

        $sql = "INSERT INTO labosgbd1.users (id, first_name, last_name, gender, email) 
                  VALUES (null, :firstName, :lastName, :gender, :email);";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':firstName', $user->getFirstName(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':lastName', $user->getLastName(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':gender', $user->getGender(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);

        $preparedStatement->execute();

        $lastId = $this->pdo->lastInsertId();
        $user->setId($lastId);


    }
    /**
     * @param User $user
     * @return void
     * @throws \PDOException
     */
    private function update(User $user)
    {

        $sql = "UPDATE labosgbd1.users SET first_name = :firstName, last_name = :lastName, gender = :gender, email = :email WHERE id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':firstName', $user->getFirstName(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':lastName', $user->getLastName(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':gender', $user->getGender(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $preparedStatement->bindValue(':id', $user->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

    }



    /**
     * @param User $user
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(User $user)
    {
        if($user->getId() === null)
            throw new \LogicException("Id can't be null");

        $sql = "DELETE FROM labosgbd1.users  WHERE id = :id LIMIT 1";

        $preparedStatement = $this->pdo->prepare($sql);

        $preparedStatement->bindValue(':id', $user->getId(), \PDO::PARAM_INT);

        $preparedStatement->execute();

        $user->setId(null);

    }

    /**
     * @param $id int
     * @return User | null
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM labosgbd1.users  WHERE id = :id LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':id', $id, \PDO::PARAM_INT);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeUserFromRow($row);;


    }

    /**
     * @return multitpe:User
     */
    public function findAll()
    {
        $sql = "SELECT * FROM labosgbd1.users ORDER BY first_name, last_name ASC";
        $statement = $this->pdo->query($sql);

        $userList = [];
        while(false !== ($row = $statement->fetch(\PDO::FETCH_ASSOC)))
        {

            $userList[] =  $this->makeUserFromRow($row);
        }

        return $userList;
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM labosgbd1.users  WHERE email = :email LIMIT 1";
        $preparedStatement = $this->pdo->prepare($sql);
        $preparedStatement->bindValue(':email', $email, \PDO::PARAM_INT);

        $preparedStatement->execute();

        $row = $preparedStatement->fetch(\PDO::FETCH_ASSOC);

        if($row === false)
            return null;

        return $this->makeUserFromRow($row);;
    }

    private function makeUserFromRow(array $row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setEmail($row['email']);
        $user->setFirstName($row['first_name']);
        $user->setLastName($row['last_name']);
        $user->setGender($row['gender']);
        return $user;
    }


}