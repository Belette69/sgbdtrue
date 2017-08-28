<?php
namespace sgbdtrue\DAO\secretariat;


use sgbdtrue\entities\secretariat\User;

interface IUserDao
{
    /**
     * @param User $user
     * @return void
     * @throws \PDOException
     */
    public function insertOrUpdate(User $user);

    /**
     * @param User $user
     * @return void
     * @throws \PDOException, \LogicException
     */
    public function delete(User $user);

    /**
     * @param $id int
     * @return User | null
     */
    public function findById($id);

    /**
     * @return multitpe:User
     */
    public function findAll();


}