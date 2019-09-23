<?php

namespace PinpointDesigns\CustomerTestimonial\Model\ResourceModel\CustomerTestimonial\Grid;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use PinpointDesigns\CustomerTestimonial\Api\Data\CustomerTestimonialInterface;
use PinpointDesigns\CustomerTestimonial\Model\ResourceModel\CustomerTestimonial;
use Psr\Log\LoggerInterface as Logger;

class Collection extends SearchResult
{
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable = CustomerTestimonialInterface::TABLE_NAME,
        $resourceModel = CustomerTestimonial::class
    ) {
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $mainTable,
            $resourceModel
        );
    }
}
