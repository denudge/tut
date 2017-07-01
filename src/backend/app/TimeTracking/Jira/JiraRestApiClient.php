<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 01.07.17
 * Time: 20:11
 */

namespace App\TimeTracking\Jira;

use GuzzleHttp\Client as GuzzleClient;

/**
 * Class JiraRestApiClient
 * @package App\TimeTracking\Jira
 */
class JiraRestApiClient
{
    /**
     * @var string
     */
    protected $username = '';

    /**
     * @var string
     */
    protected $password = '';

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * ApiClient constructor.
     * @param string $baseUrl
     * @param string $username
     * @param string $password
     * @param string $version
     */
    public function __construct(
        string $baseUrl,
        string $username,
        string $password,
        string $version = '2'
    ) {
        // strip trailing slashes
        $baseUrl = rtrim($baseUrl, '/');
        $this->baseUrl = $baseUrl;
        $this->username = $username;
        $this->password = $password;
        $this->version = $version;
        $this->client = $this->buildClient();
    }
    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }
    /**
     * @param string $baseUrl
     * @return self
     */
    public function setBaseUrl(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }
    /**
     * @return string
     * @return self
     */
    public function getVersion(): string
    {
        return $this->version;
    }
    /**
     * @param string $version
     * @return self
     */
    public function setVersion(string $version)
    {
        $this->version = $version;
        return $this;
    }
    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
    /**
     * @param string $username
     * @return self
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }
    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    /**
     * @param string $password
     * @return self
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }
    /**
     * @return array
     */
    public function getHeaders()
    {
        return [
            'Content-Type' => 'application/json; charset=utf-8'
        ];
    }
    /**
     * @return GuzzleClient
     */
    public function getClient(): GuzzleClient
    {
        return $this->client;
    }
    /**
     * @return GuzzleClient
     */
    protected function buildClient(): GuzzleClient
    {
        return new GuzzleClient([
            'auth' => [$this->username, $this->password],
            'base_uri' => $this->buildBaseUri(),
        ]);
    }
    /**
     * @return string
     */
    protected function buildBaseUri(): string
    {
        return $this->getBaseUrl() . '/rest/api/' . $this->getVersion() . '/';
    }
}
