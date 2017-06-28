<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 28.06.17
 * Time: 20:00
 */

namespace App\TimeTracking\Jira;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Instance
 * @package App\TimeTracking\Jira
 *
 * @property string $name
 * @property string $base_url
 */
class Instance extends Model
{
    protected $table = 'jira_instances';

    protected $fillable = [
        'name',
        'base_url',
    ];
}
