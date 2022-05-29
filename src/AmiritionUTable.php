<?php

declare(strict_types=1);

namespace Amirition\UTable;

use Amirition\Utable\Admin\UsersTableEndpoint;
use Amirition\UTable\Admin\CustomEndpointInterface;
use Amirition\UTable\Admin\UserDetailEndpoint;
use Amirition\UTable\Admin\UsersInfo;
use Amirition\UTable\Front\UsersTemplate;
use Amirition\UTable\Front\Scripts;

final class AmiritionUTable
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

    public static $pluginName = 'amirition-users-table';

    public static $pluginVersion = '0.1.0';
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
