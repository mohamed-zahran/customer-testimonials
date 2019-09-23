<?php

namespace PinpointDesigns\CustomerTestimonial\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use PinpointDesigns\CustomerTestimonial\Api\Data\CustomerTestimonialInterface;

class CustomerTestimonial extends AbstractDb
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(CustomerTestimonialInterface::TABLE_NAME, CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID);
    }
}
