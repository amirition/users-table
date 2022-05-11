<?php

declare(strict_types=1);

namespace Amirition\Inpsyde;

use Amirition\Inpsyde\Admin\UsersTableEndpoint;
use Amirition\Inpsyde\Admin\CustomEndpointInterface;
use Amirition\Inpsyde\Admin\UserDetailEndpoint;
use Amirition\Inpsyde\Admin\UsersInfo;
use Amirition\Inpsyde\Front\UsersTemplate;
use Amirition\Inpsyde\Front\Scripts;

final class InpsydeTest
{
    /**
     * @var UsersTableEndpoint
     */
    private $usersTableEndpoint;

    /**
     * @var UserDetailEndpoint
     */
    private $userDetailEndpoint;

    /**
     * @var Scripts
     */
    private $scripts;

    public static $pluginName = 'inpsyde-users-table';

    public static $pluginVersion = '0.1.0';

    /**
     * @param UserDetailEndpoint $userDetailEndpoint
     * @param UsersTableEndpoint $usersTableEndpoint
     * @param Scripts            $scripts
     */
    public function __construct(
        CustomEndpointInterface $userDetailEndpoint,
        CustomEndpointInterface $usersTableEndpoint,
        Scripts $scripts
    ) {

        $this->usersTableEndpoint = $usersTableEndpoint;
        $this->userDetailEndpoint = $userDetailEndpoint;
        $this->scripts = $scripts;
    }

    public static function instance(): self
    {
        $usersInfo = new UsersInfo();
        $usersTable = new UsersTemplate($usersInfo);
        $userDetailEndpoint = new UserDetailEndpoint($usersInfo);
        $usersTableEndpoint = new UsersTableEndpoint($usersTable);
        $scripts = new Scripts(self::$pluginName, self::$pluginVersion, $userDetailEndpoint);

        $instance = new self($userDetailEndpoint, $usersTableEndpoint, $scripts);

        return $instance;
    }
}
