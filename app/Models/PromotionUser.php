<?php
namespace App\Models;

use App\User;

class PromotionUser extends baseModel
{
    const TABLE = 'promotion_users';

    const COLUMN_USER_ID = 'user_id';


    public function getUserId(): int
    {
        return $this->{self::COLUMN_USER_ID};
    }

    public function setUserId(int $value): self
    {
        $this->{self::COLUMN_USER_ID} = $value;
        return $this;
    }

    public function setUser(): User
    {
        return User::getById($this->getUserId());
    }
}
