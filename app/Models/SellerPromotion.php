<?php
namespace App\Models;

use Carbon\Carbon;

class SellerPromotion extends baseModel
{
    const TABLE = 'seller_promotions';

    const COLUMN_SELLER_ID = 'seller_id';
    const COLUMN_PRODUCT_URL = 'url';
    const COLUMN_FULL_PRICE = 'full_price';
    const COLUMN_TESTER_PRICE = 'tester_price';
    const COLUMN_AVAILABLE_PRODUCTS_COUNT = 'available_product_count';
    const COLUMN_MIN_USER_EXPERIENCE = 'minimum_user_experience';
    const COLUMN_START_AT = 'start_at';
    const COLUMN_END_AT = 'end_at';


    public function getSellerId(): int
    {
        return $this->{self::COLUMN_SELLER_ID};
    }

    public function setSellerId(int $value): self
    {
        $this->{self::COLUMN_SELLER_ID} = $value;
        return $this;
    }

    public function getProductUrl(): ?string
    {
        return $this->{self::COLUMN_PRODUCT_URL};
    }
    public function setProductUrl(?string $value): self
    {
        $this->{self::COLUMN_PRODUCT_URL} = $value;
        return $this;
    }
}
