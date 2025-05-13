<?php

namespace App\Models;

use App\Traits\SerializeDate;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use SerializeDate;
}
