<?php
namespace App\Models;

use App\User;
use Carbon\Carbon;

class SellerPromotion extends BaseModel
{
    const TABLE = 'seller_promotions';

    const STATUS_NEW = 'new';
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_DELETED = 'deleted';

    const STATUS_ALL = [
        self::STATUS_NEW,
        self::STATUS_PENDING,
        self::STATUS_CONFIRMED,
        self::STATUS_DELETED
    ];

    const COLUMN_SELLER_ID = 'seller_id';
    const COLUMN_TITLE = 'title';
    const COLUMN_PRODUCT_URL = 'url';
    const COLUMN_FULL_PRICE = 'full_price';
    const COLUMN_TESTER_PRICE = 'tester_price';
    const COLUMN_AVAILABLE_PRODUCTS_COUNT = 'available_product_count';
    const COLUMN_USED_PRODUCTS_COUNT = 'used_product_count';
    const COLUMN_MIN_USER_EXPERIENCE = 'minimum_user_experience';
    const COLUMN_STATUS= 'status';
    const COLUMN_IMAGE = 'image';
    const COLUMN_START_AT = 'start_at';
    const COLUMN_END_AT = 'end_at';

    const PROMOTION_SELLER_CACHE_KEY = 'promotion:seller';

    protected $guarded = [];


    public function getSellerId(): int
    {
        return $this->{self::COLUMN_SELLER_ID};
    }

    public function setSellerId(int $value): self
    {
        $this->{self::COLUMN_SELLER_ID} = $value;
        return $this;
    }

    public function setSeller(): User
    {
        return User::getById($this->getSellerId());
    }


    public function getProductUrl(): string
    {
        return $this->{self::COLUMN_PRODUCT_URL};
    }

    public function setProductUrl(string $value): self
    {
        $this->{self::COLUMN_PRODUCT_URL} = $value;
        return $this;
    }

    public function getFullPrice(): int
    {
        return $this->{self::COLUMN_FULL_PRICE};
    }

    public function setFullPrice(int $value): self
    {
        $this->{self::COLUMN_FULL_PRICE} = $value;
        return $this;
    }

    public function getTesterPrice(): int
    {
        return $this->{self::COLUMN_TESTER_PRICE};
    }

    public function setTesterPrice(int $value): self
    {
        $this->{self::COLUMN_TESTER_PRICE} = $value;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->{self::COLUMN_STATUS};
    }

    public function setStatus(string $value): self
    {
        $this->{self::COLUMN_STATUS} = $value;
        return $this;
    }

    public function getAvailableProductCount(): int
    {
        return $this->{self::COLUMN_AVAILABLE_PRODUCTS_COUNT};
    }

    public function setAvailableProductCount(int $value): self
    {
        $this->{self::COLUMN_AVAILABLE_PRODUCTS_COUNT} = $value;
        return $this;
    }

    public function getUsedProductCount(): int
    {
        return $this->{self::COLUMN_USED_PRODUCTS_COUNT};
    }

    public function setUsedProductCount(int $value): self
    {
        $this->{self::COLUMN_USED_PRODUCTS_COUNT} = $value;
        return $this;
    }

    public function getMinimumUserExperience(): ?int
    {
        return $this->{self::COLUMN_MIN_USER_EXPERIENCE};
    }

    public function setMinimumUserExperience(?int $value): self
    {
        $this->{self::COLUMN_MIN_USER_EXPERIENCE} = $value;
        return $this;
    }

    public function getStartAt(): Carbon
    {
        return Carbon::parse($this->{self::COLUMN_START_AT});
    }

    public function setStartAt(Carbon $value): self
    {
        $this->{self::COLUMN_START_AT} = $value;
        return $this;
    }

    public function getEndAt(): Carbon
    {
        return Carbon::parse($this->{self::COLUMN_END_AT});
    }

    public function setEndAt(Carbon $value): self
    {
        $this->{self::COLUMN_END_AT} = $value;
        return $this;
    }

    public static function getSellerPromotionCacheTag(int $sellerId) {
        return self::PROMOTION_SELLER_CACHE_KEY.':'.$sellerId;
    }


    public static function getBySellerId(int $sellerId, int $currentPage)
    {
        return \Cache::tags([self::getSellerPromotionCacheTag($sellerId)])->remember('page:'.$currentPage,300, function () use ($sellerId, $currentPage) {
            return SellerPromotion::where(self::COLUMN_SELLER_ID, '=', $sellerId)->orderBy('id', 'desc')->paginate(10, ['*'], 'page', $currentPage);
        });
    }

    public static function getBySellerActivePromotionCount(int $sellerId)
    {
        $now = Carbon::now();
        return SellerPromotion::where(self::COLUMN_SELLER_ID, '=', $sellerId)
            ->where(self::COLUMN_STATUS, SellerPromotion::STATUS_CONFIRMED)
            ->where(self::COLUMN_START_AT, '<', $now)
            ->where(self::COLUMN_END_AT, '>', $now)
            ->count();
    }

    public static function getBySellerPendingPromotionCount(int $sellerId)
    {
        $now = Carbon::now();
        return SellerPromotion::where(self::COLUMN_SELLER_ID, '=', $sellerId)
            ->whereIn(self::COLUMN_STATUS, [SellerPromotion::STATUS_NEW, SellerPromotion::STATUS_PENDING])
            ->where(self::COLUMN_START_AT, '<', $now)
            ->where(self::COLUMN_END_AT, '>', $now)
            ->count();
    }

    public function save(array $options = [])
    {
        $result = parent::save($options);
        if ($result) {
            $this->forgetIdCache();
        }
    }
    public function delete()
    {
        $result = parent::delete();
        if ($result) {
            $this->forgetIdCache();
        }
        return $result;
    }

    private function forgetIdCache()
    {
        $cacheTag = self::getSellerPromotionCacheTag($this->getSellerId());
        \Cache::tags([$cacheTag])->flush();
    }

}
