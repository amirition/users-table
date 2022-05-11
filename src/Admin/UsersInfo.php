<?php

declare(strict_types=1);

namespace Amirition\Inpsyde\Admin;

class UsersInfo
{
    /**
     * This is where we save our users
     */

    private string $usersApiUrl;

    /**
     * I've only considered posts as "User Detail" here,
     * we can send a request to "todo" and "albums" too.
     */
    private string $userMetaApiUrl;

    public function __construct()
    {
        $this->usersApiUrl = 'https://jsonplaceholder.typicode.com/users/';
        $this->userMetaApiUrl = 'https://jsonplaceholder.typicode.com/users/%d/posts';
    }

    /**
     * @return array
     * @param string
     */
    public function retrieveAllUsers($response): array
    {
        if (wp_remote_retrieve_response_code($response) == 200) {
            return json_decode(wp_remote_retrieve_body($response));
        }
        return [];
    }

    /**
     * @return array|\WP_Error
     */
    public function sendAllUsersRequest()
    {
        $response = wp_remote_get($this->usersApiUrl);
        if (!is_wp_error($response)) {
            return $response;
        } else {
            return $response->get_error_messages();
        }
    }

    /**
     * @param  $response
     * @return array
     */
    public function retrieveUserDetails($response): array
    {
        if (wp_remote_retrieve_response_code($response) == 200) {
            return json_decode(wp_remote_retrieve_body($response));
        }
        return [];
    }

    /**
     * @param int $id
     */
    public function sendUserDetailRequest(int $id)
    {
        $response = wp_remote_get(sprintf($this->userMetaApiUrl, $id));

        if (!is_wp_error($response)) {
            return $response;
        } else {
            return $response->get_error_messages();
        }
    }

    /**
     * @return array
     */
    public function getAllUsers(): array
    {
        $userResponse = $this->sendAllUsersRequest();

        return $this->retrieveAllUsers($userResponse);
    }

    /**
     * @param  int $id
     * @return array
     */
    public function getUserDetail(int $id): array
    {
        $userResponse = $this->sendUserDetailRequest($id);
        return $this->retrieveUserDetails($userResponse);
    }
}
