<?php

namespace CupNoodles\PrintLayouts\Models;

use Model;

/**
 * UOM Model Class
 */
class PrintLayouts extends Model
{
    /**
     * @var string The database table name
     */
    protected $table = 'printlayouts';

    /**
     * @var string The database table primary key
     */
    protected $primaryKey = 'printlayouts_id';

    public $casts = [
    ];

    public $relation = [];

}
