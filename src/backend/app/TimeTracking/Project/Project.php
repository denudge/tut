<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 28.06.17
 * Time: 18:21
 */

namespace App\TimeTracking\Project;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 * @package App\TimeTracking\Project
 *
 * @property string $name
 * @property string $description
 * @property int $instance_id
 * @property string $key
 */
class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description',
        'instance_id',
        'key',
    ];
}
