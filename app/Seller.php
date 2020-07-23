<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Seller extends Authenticatable
{
    use Notifiable;

    const TABLE = 'sellers';
    const COLUMN_ID = 'id';

    const STATUS_NEW = 'new';
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_LIMITED = 'limited'; // Expired contract
    const STATUS_RESTRICTED = 'restricted'; // Expired contract
    const STATUS_BLOCKED = 'blocked'; // delete accounts, due to history tracking
    const STATUS_DELETED = 'deleted'; // delete accounts, due to history tracking

    const STATUS_ALL = [
        self::STATUS_NEW,
        self::STATUS_PENDING,
        self::STATUS_LIMITED,
        self::STATUS_CONFIRMED,
        self::STATUS_RESTRICTED,
        self::STATUS_BLOCKED,
        self::STATUS_DELETED
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'email_verified_at', 'phone_verified_at', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public function getId(): int
    {
        return $this->{self::COLUMN_ID};
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getFirstName(): string
    {
        if ($this->name) {
            return mb_split(' ', $this->name)[0];
        }
        return '';
    }

    public static function getByEmail(string $email): self
    {
        return (new User())
            ->where('email', '=', $email)
            ->first();
    }

    private static function getEntityItemCacheKey(int $id = 0): string
    {
        return 'mysql:model:'.static::TABLE.':'.$id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public static function getById(int $id)
    {
        $cacheKey = self::getEntityItemCacheKey($id);
        $model = \Cache::remember($cacheKey, 300, function () use ($id) {
            $model = (new User())->find($id);

            if ($model !== null) {
                return $model;
            }
            return null;
        });
        return $model;
    }

    public static function getColumns(string $col = '*', string $alias = '', $with_table = true)
    {
        if ($col == '*') {
            $alias = '';
        }
        return ($with_table ? static::TABLE.'.': '' ).$col.($alias ? ' AS '.$alias: '');
    }
}
