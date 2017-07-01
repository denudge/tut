<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 01.07.17
 * Time: 22:49
 */

namespace App\TimeTracking\Jira\Commands;

use App\TimeTracking\Entry\Entry;
use App\TimeTracking\Entry\Event\EntryAddedEvent;
use App\TimeTracking\Jira\Factories\WorklogFactory;
use App\TimeTracking\Jira\JiraRestApiClient;

/**
 * Class AddWorklog
 * @package App\TimeTracking\Jira\Commands
 */
class AddWorklog
{
    /**
     * @const string
     */
    const URI = 'issue/%s/worklog';

    /**
     * @const string
     */
    const ERROR_PREFIX = 'Cannot add JIRA worklog from entry: ';

    /**
     * @var JiraRestApiClient
     */
    protected $apiClient;

    /**
     * AddWorklog constructor.
     * @param JiraRestApiClient $apiClient
     */
    public function __construct(JiraRestApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @param EntryAddedEvent $event
     */
    public function handle(EntryAddedEvent $event)
    {
        try {
            $this($event->entry);
        } catch (\Exception $e) {}
    }

    /**
     * @param Entry $entry
     * @return Entry
     * @throws \InvalidArgumentException|\Exception
     */
    public function __invoke(Entry $entry): Entry
    {
        \Log::debug('Trying to add JIRA worklog for entry with id ' . $entry->id);

        if (empty($entry->ticket)) {
            throw new \InvalidArgumentException(static::ERROR_PREFIX . 'Ticket field empty.');
        }

        if ((int) $entry->jira_worklog_id > 0) {
            throw new \InvalidArgumentException(static::ERROR_PREFIX . 'Worklog ID already exists.');
        }

        try {
            $worklog = WorklogFactory::fromEntry($entry);
            \Log::debug('Worklog JSON: ' . $worklog->toJson());

            $target = sprintf(static::URI, $entry->ticket);
            $response = $this->apiClient->getClient()->post(
                $target,
                [
                    'headers' => $this->apiClient->getHeaders(),
                    'json' => $worklog->toArray(),
                    'query' => [ 'adjustEstimate' => 'leave' ],
                ]
            );

            if ($response->getStatusCode() !== 201) {
                throw new \Exception(
                    static::ERROR_PREFIX . 'Response Code ' . $response->getStatusCode() . '.'
                );
            }

            $content = $response->getBody()->getContents();
            \Log::debug('Got response: ' . $content);
            $structure = json_decode($content);
            if (!is_object($structure)) {
                throw new \Exception(static::ERROR_PREFIX . 'Malformed answer.');
            }

            $id = (int) $structure->id;

            if ($id < 1) {
                throw new \Exception(
                    static::ERROR_PREFIX . 'Got no worklog ID back.'
                );
            }

            $entry->jira_worklog_id = $id;
            $entry->save();

            \Log::debug('Successfully added JIRA worklog with ID ' . $id);

            return $entry;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            throw $e;
        }
    }
}
