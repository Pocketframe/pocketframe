<?php

namespace App\Container;

use Pocketframe\Container\Container;
use Pocketframe\Container\ContainerRegister as BaseContainerRegister;

class ContainerRegister extends BaseContainerRegister
{
  /**
   * Register bindings into the container
   *
   * This method registers application-specific bindings into the dependency injection container.
   * Add your custom service bindings here to make them available throughout the application.
   *
   * @param Container $container The container instance to register bindings into
   * @return void
   */
  public function register(Container $container)
  {
    // Example: Binding with dependencies
    // $container->bind(PostService::class, function ($container) {
    //   $userService = $container->get(UserService::class);
    //   return new PostService($userService);
    // });

  }
}
