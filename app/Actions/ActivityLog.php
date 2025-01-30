<?php

namespace app\Actions;

use Core\Database\DB;
use Core\Sessions\Session;

class ActivityLog
{

    public static function activity(string $activity)
    {
        DB::insert('activity_logs', [
            'activity' => $activity,
            'user_id' => Session::get('user')['id'],
            'branch_id' => Session::get('user')['branch_id'],
            'business_id' => Session::get('user')['business_id'],
        ]);
    }
}
