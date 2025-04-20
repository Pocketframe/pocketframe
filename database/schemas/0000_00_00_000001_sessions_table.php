<?php

namespace Database\Schemas;

use Pocketframe\PocketORM\Schema\TableScript;
use Pocketframe\PocketORM\Schema\TableBuilder;

class Sessions extends TableScript
{
  public function up(): void
  {
    $this->createTable('sessions', function (TableBuilder $table) {
      $table->string('id')->primary();
      $table->foreignId('user_id')->nullable()->index();
      $table->string('ip_address', 45)->nullable();
      $table->text('user_agent')->nullable();
      $table->longText('payload');
      $table->integer('last_activity')->index();
    });
  }

  public function down(): void
  {
    $this->dropTable('sessions');
  }
}
