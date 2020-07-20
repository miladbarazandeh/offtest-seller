<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Exception;

/**
 * @mixin Builder;
 * @mixin QueryBuilder;
 */
abstract class BaseModel extends Model
{
    const CONNECTION = 'mysql';
    const COLUMN_ID = 'id';

    const COLUMN_CREATED_BY = 'created_by';
    const COLUMN_CREATED_AT = 'created_at';
    const COLUMN_UPDATED_BY = 'updated_by';
    const COLUMN_UPDATED_AT = 'updated_at';
    const COLUMN_DELETED_AT = 'deleted_at';
    const COLUMN_ACTIVE = 'active';

    const TABLE = "base";
    const ALL_COLUMNS = '.*';

    public function __construct(array $attributes = [])
    {
        $this->connection = static::CONNECTION;
        $this->table = static::TABLE;
        parent::__construct($attributes);
    }

    public function getId(): int
    {
        return $this->{self::COLUMN_ID};
    }
    public function setId(int $value): self
    {
        $this->{self::COLUMN_ID} = $value;
        return $this;
    }
    public function hasId(): bool
    {
        return $this->{self::COLUMN_ID} !== null;
    }

    public function getCreatedById(): ?int
    {
        return $this->{self::COLUMN_CREATED_BY};
    }
    public function setCreatedById(int $value): self
    {
        $this->{self::COLUMN_CREATED_BY} = $value;
        return $this;
    }
    public function setCreatedByNull(): self
    {
        $this->{self::COLUMN_CREATED_BY} = null;
        return $this;
    }

    public function getUpdatedById(): ?int
    {
        return $this->{self::COLUMN_UPDATED_BY};
    }
    public function setUpdatedById(?int $value): self
    {
        $this->{self::COLUMN_UPDATED_BY} = $value;
        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        if ($this->{self::COLUMN_CREATED_AT} === null) {
            return null;
        }
        return Carbon::parse($this->{self::COLUMN_CREATED_AT});
    }

    public function getUpdatedAt(): ?Carbon
    {
        if ($this->{self::COLUMN_UPDATED_AT} === null) {
            return null;
        }
        return Carbon::parse($this->{self::COLUMN_UPDATED_AT});
    }

    public function getIsActive(): bool
    {
        return $this->{self::COLUMN_ACTIVE};
    }
    public function setIsActive(bool $value): self
    {
        $this->{self::COLUMN_ACTIVE} = $value;
        return $this;
    }

    public static function getColumns(string $col = '*', string $alias = '', $with_table = true)
    {
        if ($col == '*') {
            $alias = '';
        }
        return ($with_table ? static::TABLE.'.': '' ).$col.($alias ? ' AS '.$alias: '');
    }

    private static function getEntityItemCacheKey(int $id = 0): string
    {
        return static::CONNECTION.':model:'.static::TABLE.':'.$id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public static function getById(int $id)
    {
        $cacheKey = self::getEntityItemCacheKey($id);
        $model = \Cache::remember($cacheKey, 120, function () use ($id) {
            $modelName = get_called_class();
            /** @var baseModel $modelObject */
            $modelObject = (new $modelName);
            $model = $modelObject->find($id);

            if ($model !== null) {
                return $model;
            }
            return null;
        });
        return $model;
    }

    public function save(array $options = [])
    {
        $result = parent::save($options);
        if ($result) {
            $this->forgeIdCache();
        }
        return $result;
    }

    /**
     * @return bool|null
     * @throws Exception
     */
    public function delete()
    {
        $result = parent::delete();
        if ($result) {
            $this->forgeIdCache();
        }
        return $result;
    }

    private function forgeIdCache()
    {
        // clear cache
        if ($this->hasId()) {
            $cacheKey = $this->getEntityItemCacheKey($this->getId());
            \Cache::forget($cacheKey);
        }
    }
}