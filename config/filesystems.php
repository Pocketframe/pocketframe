<?php

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
