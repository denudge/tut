<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 28.06.17
 * Time: 18:14
 */

namespace App\TimeTracking\Entry;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Entry
 * @package App\TimeTracking\Entry
 */
class Entry extends Model
{
    protected $table = 'entries';

    protected $fillable = [
        'user_id',
        'period',
        'date',
        'start',
        'end',
        'duration',
        'project_id',
        'ticket',
    ];
}
