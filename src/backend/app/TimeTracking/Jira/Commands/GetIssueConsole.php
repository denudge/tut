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
 * Class GetIssueConsole
 * @package App\TimeTracking\Jira\Commands
 */
class GetIssueConsole extends Command
{
    /**
     * @var string
     */
    protected $signature = 'jira:getIssue {key}';

    /**
     * @var string
     */
    protected $description = 'Dumps a JIRA issue\'s JSON structure.';

    /**
     * @param GetIssue $getIssue
     * @return int
     */
    public function handle(GetIssue $getIssue)
    {
        try {
            $issue = $getIssue($this->argument('key'));
            print_r($issue);
            return 0;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return -1;
        }
    }
}
