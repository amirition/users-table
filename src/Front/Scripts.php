<?php

declare(strict_types=1);

namespace Amirition\UTable\Front;

use Amirition\UTable\Admin\UserDetailEndpoint;

class Scripts
{
    /**
     * This is the plugin name
     */
    private $pluginName;

    /**
     * Version of the plugin
     */
    private $version;

    /**
     * @var
     */
    private $userDetailEndpoint;

    public function __construct(string $pluginName, string $version, UserDetailEndpoint $userDetailEndpoint)
    {
        $this->pluginName = $pluginName;
        $this->version = $version;
        $this->userDetailEndpoint = $userDetailEndpoint;
        $this->setHooks();
    }

    /**
     * Register CSS files
     */
    public function enqueueStyles()
    {
        wp_enqueue_style(
            $this->pluginName,
            plugin_dir_url(__DIR__) . 'Assets/css/main.css',
            [],
            $this->version
        );
    }

    /**
     * Register JS files
     */
    public function enqueueScripts()
    {

        wp_enqueue_script($this->pluginName, plugin_dir_url(__DIR__) . 'Assets/js/main.js',
          [], $this->version, true);
        wp_localize_script(
            $this->pluginName,
            'info',
            [
            'userDetailApi' =>  $this->userDetailEndpoint->customUrl(),
            ]
        );
    }

    /**
     * @return void
     */
    private function setHooks()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueStyles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
    }
}
