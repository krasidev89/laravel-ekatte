<?php

namespace App\Models;

use App\Traits\SerializeDate;
use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Activity
{
    use SerializeDate;
}
