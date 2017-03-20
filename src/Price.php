<?php
/**
 * PHP Billing Library
 *
 * @link      https://github.com/hiqdev/php-billing
 * @package   php-billing
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\php\billing;

/**
 * Price.
 * Tariff consists of prices.
 */
class Price
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Type
     */
    protected $type;

    /**
     * @var Tariff
     */
    protected $tariff;

    /**
     * @var object
     */
    protected $object;

    /**
     * @var Currency
     */
    protected $currency;

    /**
     * @var Quantity prepaid quantity also implies Unit
     */
    protected $quantity;

    /**
     * @var integer
     */
    protected $price;

    /**
     * Calculate action value.
     * @param Action $action
     * @return null|BillResource
     */
    public function calculateCharge(Action $action)
    {
        if (!$this->isApplicable($action)) {
            return null;
        }

        $quantity = 1;
        $sum = 1;

        return Charge($action, $quantity, $sum);
    }
}
