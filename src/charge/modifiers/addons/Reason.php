<?php
/**
 * PHP Billing Library
 *
 * @link      https://github.com/hiqdev/php-billing
 * @package   php-billing
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\php\billing\charge\modifiers\addons;

use hiqdev\php\billing\charge\modifiers\AddonInterface;

/**
 * Reason addon.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class Reason implements AddonInterface
{
    /**
     * @var string
     */
    protected $value;

    public function __construct($value)
    {
        $this->value = static::ensureValidValue($value);
    }

    public function getValue()
    {
        return $this->value;
    }

    public static function ensureValidValue($value)
    {
        return (string) $value;
    }
}
