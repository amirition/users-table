<?php

declare(strict_types=1);

namespace Amirition\Inpsyde\Admin;

use Amirition\Inpsyde\Front\UsersTemplate;

class UsersTableEndpoint implements CustomEndpointInterface
{
    private $customUrl;

    /**
     * Filter hook to use, when we want to change the custom url
     * custom_inpsyde_url
     */
    private $customUrlFilter;

    /**
     * @var usersTemplate
     */
    private $usersTemplate;

    /**
     * @param UsersTemplate $usersTemplate
     */
    public function __construct(UsersTemplate $usersTemplate)
    {
        $this->customUrl = 'inpsyde-users-table';
        $this->customUrlFilter = 'ait_users_table_url';
        $this->usersTemplate = $usersTemplate;
        $this->setHooks();
    }

    /**
     * Creates a custom endpoint
     */
    public function customEndpointOutput()
    {
        if (strpos($_SERVER["REQUEST_URI"], $this->customUrl)) {
            $this->setCache(86400);
            $this->usersTemplate->create();
            exit();
        }
    }

    /**
     * Check for the URL and assign it
     */
    public function modifyCustomUrl()
    {
        $this->customUrl = apply_filters($this->customUrlFilter, $this->customUrl);
    }

    public function customUrl(): string
    {
        return $this->customUrl;
    }

    /**
     * @return void
     */
    public function setHooks()
    {
        add_action('parse_request', [$this, 'customEndpointOutput']);
    }

    /**
     * @param  int $time
     * @return void
     */
    private function setCache(int $time)
    {
        $this->modifyCustomUrl();
        header("Cache-Control: max-age={$time}");
    }
}
