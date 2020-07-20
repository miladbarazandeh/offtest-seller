<?php
namespace App\Database\Migrations;

use App\Models\baseModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class BaseMigration extends Migration
{
    private $table;
    private $doctrineTable;
    private $hasBigInt;

    public function __construct(string $table, bool $hasBigInt = false)
    {
        $this->table = $table;
        $this->hasBigInt = $hasBigInt;

        $connection = \Schema::getConnection();
        $schemaManager = $connection->getDoctrineSchemaManager();
        $this->doctrineTable = $schemaManager->listTableDetails($table);
    }

    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        if (\Schema::hasTable($this->table)) {
            \Schema::table($this->table, function (Blueprint $table) {
                $this->alterTable($table);
            });
        } else {
            \Schema::create($this->table, function (Blueprint $table) {
                $this->appendIdColumn($table);
                $this->createTable($table);
                $this->appendTimestampsColumn($table);
                $table->boolean(baseModel::COLUMN_ACTIVE)
                    ->default(true)
                    ->nullable(false);
            });
        }
    }

    private function appendIdColumn(Blueprint $table)
    {
        if ($this->hasBigInt) {
            $table->bigIncrements(baseModel::COLUMN_ID);
        } else {
            $table->increments(baseModel::COLUMN_ID);
        }

    }

    private function appendTimestampsColumn(Blueprint $table)
    {
        $table->timestamps();
    }

    protected function createTable(Blueprint $table){}

    protected function alterTable(Blueprint $table){}

    protected function hasIndex(string $indexName): bool
    {
        return $this->doctrineTable->hasIndex($indexName);
    }

    protected function hasPrimaryKey(): bool
    {
        return $this->doctrineTable->hasPrimaryKey();
    }

    protected function hasColumn(string $column): bool
    {
        return $this->doctrineTable->hasColumn($column);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::dropIfExists($this->table);
    }
}