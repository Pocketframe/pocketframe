<?php

/**
 * Filesystem configuration file
 *
 * This file contains the filesystem configuration settings for the application.
 * It uses environment variables to set the connection parameters.
 *
 * @package Pocketframe
 */
return [
  /**
   * Default Filesystem Disk
   */
  'default' => 'local',

  /**
   *  Filesystem Disks
   *
   * The filesystems are defined as an array of disk configurations.
   * Each disk configuration includes a driver, root directory, and optional URL and visibility settings.
   */
  'disks' => [
    /**
     * Local Storage Disk
     *
     * This disk is used for local file storage.
     */
    'local' => [
      'driver' => 'local',
      'root'   => storage_path('app'),
    ],

    /**
     * Public Storage Link
     *
     * This disk is used to store files that are publicly accessible.
     */
    'public_link' => 'public/store',

    /**
     * Public Storage Disk
     *
     * This disk is used to store files that are publicly accessible.
     *
     */
    'public' => [
      'driver'     => 'local',
      'root'       => storage_path('app/public'),
      'url'        => env('APP_URL') . '/store',
      'visibility' => 'public',
    ],
  ],
];
