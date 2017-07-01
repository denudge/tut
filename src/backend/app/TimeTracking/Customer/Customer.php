<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 30.06.17
 * Time: 07:33
 */

namespace App\TimeTracking\Customer;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * @package App\TimeTracking\Customer
 */
class Customer extends Model
{
    /**
     * @var string
     */
    protected $table = 'customers';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];
}
