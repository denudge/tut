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
 *
 * @property int $user_id
 * @property int $period
 * @property string $date
 * @property string $start
 * @property string $end
 * @property int $duration
 * @property int $customer_id
 * @property int $project_id
 * @property string $ticket
 * @property int $activity_id
 * @property string $description
 * @property int $jira_worklog_id
 */
class Entry extends Model
{
    /**
     * @var string
     */
    protected $table = 'entries';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'period',
        'date',
        'start',
        'end',
        'duration',
        'customer_id',
        'project_id',
        'ticket',
        'activity_id',
        'description',
        'jira_worklog_id',
    ];
}
