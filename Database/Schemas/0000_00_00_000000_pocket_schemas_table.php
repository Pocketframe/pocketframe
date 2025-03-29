<?php

namespace Database\Schemas;

use Pocketframe\PocketORM\Schema\TableScript;
use Pocketframe\PocketORM\Schema\TableBuilder;

class PocketSchemas extends TableScript
{
  public function up(): void
  {
    $this->createTable('pocket_schemas', function (TableBuilder $table) {
      $table->id();
      $table->string('schema_name')->unique();
      $table->datetime('applied_at');
      $table->integer('batch')->index();
    });
  }

  public function down(): void
  {
    $this->dropTable('pocket_schemas');
  }
}
