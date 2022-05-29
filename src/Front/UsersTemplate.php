<?php

declare(strict_types=1);

namespace Amirition\UTable\Front;

use Amirition\UTable\Admin\UsersInfo;

class UsersTemplate
{
    /**
     * Which users fields do we want to show?
     * All the possible fields can be found here:
     * https://jsonplaceholder.typicode.com/users
     */
    private $userFields = [
    'id',
    'name',
    'username',
    ];

    /**
     * @var UsersInfo
     */
    private $usersInfo;

    /**
     * @param UsersInfo $usersInfo
     */
    public function __construct(UsersInfo $usersInfo)
    {
        $this->usersInfo = $usersInfo;
    }

    public function create()
    {
        get_header();
        echo '<main>';
        echo $this->getUsersTable();
        echo '</main>';
        get_footer();
    }

    private function getUsersTable(): string
    {

        $content = '<div class="amirition-table-container">';

        $users = $this->usersInfo->getAllUsers();

        if (is_array($users) and count($users) > 0) {
            $content .= $this->getTableHeader();
            foreach ($users as $userInfo) {
                $content .= $this->getUserRow($userInfo);
            }
            $content .= $this->getTableFooter();

            $content .= $this->getSidebar();
        } else {
            $content .= "<p>We don't have any user at the moment!</p>";
        }
        $content .= '</div>';

        return $content;
    }

    /**
     * Print the header row for users table
     */
    private function getTableHeader(): string
    {
        do_action('ait_before_users_table');
        $headerContent =  '<table>
            <thead><tr>';
        foreach ($this->userFields as $field) {
            $headerContent .= '<th>' . $field . '</th>';
        }
        $headerContent .= '</tr></thead><tbody>';

        return $headerContent;
    }

    /**
     * Prints out the table footer
     */
    private function getTableFooter(): string
    {
        $footerContent = '</tbody></table>';
        do_action('ait_after_users_table');

        return $footerContent;
    }

    /**
     * Shows clickable user row
     */
    public function getUserRow($userInfo): string
    {
        $rowContent = '<tr>';
        foreach ($this->userFields as $field) {
            $rowContent .= '<td><a data-id="' . $userInfo->id . '">' . $userInfo->$field . '</a></td>';
        }
        $rowContent .= '</tr>';

        return $rowContent;
    }

    /**
     * Shows the container for showing user meta
     */
    private function getSidebar(): string
    {
        $sidebarContent = '<div class="sidebar-container">';
        do_action('ait_before_users_table_sidebar');
        $sidebarContent .= "<div class='sidebar-content'> <p>User info will be here :D </p></div>";
        do_action('ait_after_users_table_sidebar');
        $sidebarContent .= "</div>";

        return $sidebarContent;
    }
}
