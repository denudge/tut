<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 28.06.17
 * Time: 21:06
 */

namespace App\TimeTracking\Http\Controllers;

use App\Http\Controllers\Controller;
use App\TimeTracking\Entry\Entry;
use Illuminate\Http\JsonResponse;

/**
 * Class EntryController
 * @package App\TimeTracking\Http\Controllers
 */
class EntryController extends Controller
{
    public function index()
    {
        $user_id = 1; // TODO Retrieve value from API key

        $day = date('w');
        $week_start = date('Y-m-d 00:00:00', strtotime('-'.$day.' days'));

        \Log::debug('Delivering all entries since ' . $week_start);

        $entries = Entry::where('user_id','=', $user_id)
            ->where('start', '>=', $week_start)
            ->orderBy('start', 'DESC')
            ->get();

        return new JsonResponse($entries, 200);
    }
}
