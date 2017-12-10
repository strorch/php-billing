<?php
/**
 * PHP Billing Library
 *
 * @link      https://github.com/hiqdev/php-billing
 * @package   php-billing
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\php\billing\price;

use hiqdev\php\billing\action\ActionInterface;
use hiqdev\php\billing\EntityInterface;
use hiqdev\php\billing\plan\PlanInterface;
use hiqdev\php\billing\target\TargetInterface;
use hiqdev\php\billing\type\TypeInterface;
use hiqdev\php\units\QuantityInterface;

/**
 * Price.
 * @see PriceInterface
 * By default Price is applicable when same target and same type as Action.
 * But it can be different e.g. same price for all targets when certain type.
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
abstract class AbstractPrice implements PriceInterface, EntityInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var TypeInterface
     */
    protected $type;

    /**
     * @var TargetInterface
     */
    protected $target;

    /**
     * @var PlanInterface
     */
    protected $plan;

    public function __construct(
                            $id,
        TypeInterface       $type,
        TargetInterface     $target,
        PlanInterface       $plan = null
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->target = $target;
        $this->plan = $plan;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * {@inheritdoc}
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * {@inheritdoc}
     * Default sum calculation method: sum = price * usage.
     */
    public function calculateSum(QuantityInterface $quantity)
    {
        $usage = $this->calculateUsage($quantity);
        if ($usage === null) {
            return null;
        }

        $price = $this->calculatePrice($quantity);
        if ($price === null) {
            return null;
        }

        return $price->multiply($usage->getQuantity());
    }

    public static function create(array $data)
    {
        return new SinglePrice($data['id'], $data['target']);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'target' => $this->target,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function isApplicable(ActionInterface $action)
    {
        return $this->target->equals($action->getTarget()) &&
               $this->type->equals($action->getType());
    }

    /**
     * {@inheritdoc}
     */
    abstract public function calculateUsage(QuantityInterface $quantity);

    /**
     * {@inheritdoc}
     */
    abstract public function calculatePrice(QuantityInterface $action);
}
