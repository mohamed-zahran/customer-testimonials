<?php

namespace PinpointDesigns\CustomerTestimonial\Model\ResourceModel\CustomerTestimonial;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use PinpointDesigns\CustomerTestimonial\Api\Data\CustomerTestimonialInterface;
use PinpointDesigns\CustomerTestimonial\Model\CustomerTestimonial;
use PinpointDesigns\CustomerTestimonial\Model\ResourceModel\CustomerTestimonial as CustomerTestimonialResource;

class Collection extends AbstractCollection
{
    protected $_idFieldName = CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID;

    protected function _construct()
    {
        $this->_init(CustomerTestimonial::class, CustomerTestimonialResource::class);
    }
}
