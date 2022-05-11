<?php

namespace Amirition\Inpsyde\Admin;

class UserDetailEndpoint implements CustomEndpointInterface
{
    /**
     * @var string
     */
    private $customUrl;

    /**
     * @var string
     */
    private $customUrlFilter;

    /**
     * @var UsersInfo
     */
    private $usersInfo;

    public function __construct(UsersInfo $usersInfo)
    {
        $this->customUrl = 'user-detail-api';
        $this->customUrlFilter = 'ait_user_detail_url';
        $this->usersInfo = $usersInfo;
        $this->setHooks();
    }

    /**
     * @return void
     */
    public function customEndpointOutput()
    {
        if (isset($_SERVER["REQUEST_URI"]) and strpos($_SERVER["REQUEST_URI"], $this->customUrl)) {
            if (isset($_GET['user-id']) and strlen($_GET['user-id']) > 0) {
                $this->setCache(86400);
                $userId = sanitize_text_field($_GET['user-id']);
                $userDetail = $this->usersInfo->getUserDetail($userId);

                echo $this->printUserDetail($userDetail);
            } else {
                echo 'You must Enter the user id!';
            }
            exit();
        }
    }

    /**
     * @return void
     */
    public function modifyCustomUrl()
    {
        $this->customUrl = apply_filters($this->customUrl, $this->customUrl);
    }

    /**
     * @return string
     */
    public function customUrl(): string
    {
        return $this->customUrl;
    }

    /**
     * @param  array $userDetailResponse
     * @return string
     */
    public function printUserDetail(array $userDetailResponse): string
    {
        $content = "";
        foreach ($userDetailResponse as $user) {
            $content .= '<p>' . $user->title . '</p>';
        }
        return $content;
    }

    /**
     * @param  int $time
     * @return void
     */
    private function setCache(int $time)
    {
        header("Cache-Control: max-age={$time}");
    }

    /**
     * @return void
     */
    public function setHooks()
    {
        $this->modifyCustomUrl();
        add_action('parse_request', [$this, 'customEndpointOutput']);
    }
}
