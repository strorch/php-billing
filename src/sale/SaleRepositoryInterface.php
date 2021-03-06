<?php
/**
 * PHP Billing Library
 *
 * @link      https://github.com/hiqdev/php-billing
 * @package   php-billing
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\php\billing\sale;

use hiqdev\php\billing\order\OrderInterface;
use hiqdev\php\billing\plan\PlanInterface;
use hiqdev\php\billing\sale\SaleInterface;

/**
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
interface SaleRepositoryInterface
{
    public function findId(SaleInterface $sale);

    /**
     * Finds suitable sales for given order.
     * @return PlanInterface[] array: actionKey => plan
     */
    public function findByOrder(OrderInterface $order);
}
