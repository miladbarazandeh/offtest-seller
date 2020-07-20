<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
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
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->enum('status', self::STATUS_ALL);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
