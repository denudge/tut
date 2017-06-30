<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 30.06.17
 * Time: 07:33
 */

namespace App\TimeTracking\Activity;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Activity
 * @package App\TimeTracking\Activity
 */
class Activity extends Model
{
    /**
     * @var string
     */
    protected $table = 'activities';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];
}
