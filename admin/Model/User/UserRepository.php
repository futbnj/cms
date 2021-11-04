<?php

namespace Admin\Model\User;

use Engine\Model;

class UserRepository extends Model
{
    public function getUsers()
    {
        $sql = $this->queryBuilder->select()
            ->from('user')
            ->orderBy('id', 'DESC')
            ->sql();

        print_r($sql);

        return $this->db->query($sql);
    }

//    public function test()
//    {
//        $user = new User;
//        $user->setEmail('dko@mail.com');
//        $user->setPassword(md5(rand(1, 10)));
//        $user->setRole('user');
//        $user->setHash('6009964381ff0768ef53143590992d11');
//        $user->save();
//    }

}