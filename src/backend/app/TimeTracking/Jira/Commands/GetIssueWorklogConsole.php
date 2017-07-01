<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 01.07.17
 * Time: 20:25
 */

namespace App\TimeTracking\Jira\Commands;

use Illuminate\Console\Command;

/**
 * Class GetIssueWorklogConsole
 * @package App\TimeTracking\Jira\Commands
 */
class GetIssueWorklogConsole extends Command
{
    /**
     * @var string
     */
    protected $signature = 'jira:getIssueWorklog {key}';

    /**
     * @var string
     */
    protected $description = 'Dumps a JIRA issue\'s worklogs JSON structure.';

    /**
     * @param GetIssueWorklog $getIssueWorklog
     * @return int
     */
    public function handle(GetIssueWorklog $getIssueWorklog)
    {
        try {
            $worklog = $getIssueWorklog($this->argument('key'));
            print_r($worklog);
            return 0;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return -1;
        }
    }
}
