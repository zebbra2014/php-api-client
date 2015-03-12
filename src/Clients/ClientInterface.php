<?php

/*
 * This file is part of the Rutube PHP API Client package.
 *
 * (c) Rutube
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rutube\Clients;

/**
 * Interface ClientInterface
 * @package Rutube\Clients
 */
interface ClientInterface
{
    public function get($uri);

    public function put($uri);

    public function delete($uri);

    public function post($uri);

    public function patch($uri);

    public function setHeaders($headers);

    public function setBody($body);

    public function attach(array $files);

    public function send();

    public function setUserAgent($userAgent);

    public function setXRealIP($ip);
}