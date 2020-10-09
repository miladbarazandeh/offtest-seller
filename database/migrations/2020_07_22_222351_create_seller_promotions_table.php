<?php

use Illuminate\Database\Schema\Blueprint;
use App\Database\Migrations\BaseMigration;
use App\Models\SellerPromotion;

class CreateSellerPromotionsTable extends BaseMigration
{
    public function __construct()
    {
        parent::__construct(SellerPromotion::TABLE);
    }

    protected function createTable(Blueprint $table)
    {
        $table->integer(SellerPromotion::COLUMN_SELLER_ID, false, true)
            ->nullable(false);
        $table->enum('status', SellerPromotion::STATUS_ALL);
        $table->string(SellerPromotion::COLUMN_TITLE, 100)
            ->nullable(false);
        $table->text(SellerPromotion::COLUMN_DESCRIPTION);
        $table->string(SellerPromotion::COLUMN_PRODUCT_URL, 1000)
            ->nullable(false);
        $table->string(SellerPromotion::COLUMN_IMAGE, 100)
            ->nullable(true);
        $table->bigInteger(SellerPromotion::COLUMN_FULL_PRICE, false, true)
            ->nullable(false);
        $table->bigInteger(SellerPromotion::COLUMN_TESTER_PRICE, false, true)
            ->nullable(false);
        $table->integer(SellerPromotion::COLUMN_AVAILABLE_PRODUCTS_COUNT, false, true)
            ->nullable(false);
        $table->integer(SellerPromotion::COLUMN_MIN_USER_EXPERIENCE, false, true)
            ->default(0)
            ->nullable(false);
        $table->dateTime(SellerPromotion::COLUMN_START_AT)
            ->nullable(false);
        $table->dateTime(SellerPromotion::COLUMN_END_AT)
            ->nullable(false);

        $sellerIndex = 'index_'.SellerPromotion::TABLE.'_'.SellerPromotion::COLUMN_SELLER_ID;
        $table->index([SellerPromotion::COLUMN_SELLER_ID], $sellerIndex);
    }

    protected function alterTable(Blueprint $table)
    {
    }
}
