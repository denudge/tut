<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 01.07.17
 * Time: 20:08
 */

namespace App\TimeTracking\Jira\Commands;

use App\TimeTracking\Jira\JiraRestApiClient;

/**
 * Class GetIssueWorklog
 * @package App\TimeTracking\Jira\Commands
 */
class GetIssueWorklog
{
    /**
     * @const string
     */
    const URI = 'issue/%s/worklog';

    /**
     * @const string
     */
    const ERROR_PREFIX = 'Error fetching JIRA issue: ';

    /**
     * @var JiraRestApiClient
     */
    protected $apiClient;

    /**
     * GetIssue constructor.
     * @param JiraRestApiClient $apiClient
     */
    public function __construct(JiraRestApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @param string $ticket
     * @return \stdClass
     * @throws \Exception
     */
    public function __invoke(string $ticket)
    {
        \Log::debug('Fetching JIRA issue worklog with key ' . $ticket . '.');

        try {
            $target = sprintf(static::URI, $ticket);

            $response = $this->apiClient->getClient()->get(
                $target,
                [
                    'headers' => $this->apiClient->getHeaders()
                ]
            );

            if ($response->getStatusCode() !== 200) {
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
            return $structure;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            throw $e;
        }
    }
}
