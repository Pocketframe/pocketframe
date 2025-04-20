<?php

namespace Database\Planters;

use Pocketframe\PocketORM\Data\DataPlanter;
use Pocketframe\PocketORM\Data\PlanterRegistry;
use Database\Planters\CategoryPlanter;
use Database\Planters\TagPlanter;

class DatabasePlanter extends DataPlanter
{
  public function plant(): void
  {
    /**
     * This is the main planter that will call other data planters
     * You can register your data planters here or use the PlanterRegistry
     *
     * Example:
     * $this->runPlanters([
     *    UserPlanter::class,          // Runs once
     *    PostPlanter::class => 5,     // Runs 5 times
     *    CommentPlanter::class => 2,  // Runs 2 times
     * ]);
     *
     * Or use the PlanterRegistry. This will discover and register all planters in the database/planters directory. This means you don't have to register them manually and all data planters in the directory will be planted into your database.
     *
     * PlanterRegistry::discoverAndRegister();
     * PlanterRegistry::plantAll();
     */
  }
}
