<?php

/*
 * This file is part of the Silex framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (file_exists($file = __DIR__.'/../silex.phar')) {
   require_once $file;
} elseif (file_exists($file = __DIR__.'/../autoload.php')) {
   require_once $file;
}
