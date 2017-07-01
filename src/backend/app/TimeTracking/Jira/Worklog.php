<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 01.07.17
 * Time: 20:57
 */

namespace App\TimeTracking\Jira;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Worklog
 * @package App\TimeTracking\Jira
 *
 * @property int $id
 * @property string $self
 * @property array $author
 * @property array $updateAuthor
 * @property string $updated
 * @property string $timeSpent
 * @property string $comment
 * @property string $started
 * @property int $timeSpentSeconds
 * @property array $visibility
 */
class Worklog extends Model
{
    /**
     * @var string
     */
    protected $table = 'worklogs';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'self',
        'author',
        'updateAuthor',
        'started',
        'updated',
        'timeSpent',
        'comment',
        'started',
        'timeSpentSeconds',
        'visibility',
    ];
}
