<?php

namespace Amirition\UTable\Admin;

interface CustomEndpointInterface
{
    public function customEndpointOutput();

    public function modifyCustomUrl();

    public function customUrl(): string;
}
