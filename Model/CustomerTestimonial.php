<?php

namespace PinpointDesigns\CustomerTestimonial\Model;

use Magento\Framework\Model\AbstractModel;
use PinpointDesigns\CustomerTestimonial\Api\Data\CustomerTestimonialInterface;

class CustomerTestimonial extends AbstractModel implements CustomerTestimonialInterface
{
    protected $_idFieldName = CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID;

    protected function _construct()
    {
        $this->_init(ResourceModel\CustomerTestimonial::class);
    }

    /**
     * @return string
     */
    public function getFullname(): string
    {
        return $this->getData(CustomerTestimonialInterface::FULLNAME);
    }

    /**
     * @param string $fullname
     * @return CustomerTestimonialInterface
     */
    public function setFullname(string $fullname): CustomerTestimonialInterface
    {
        return $this->setData(CustomerTestimonialInterface::FULLNAME, $fullname);
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->getData(CustomerTestimonialInterface::CONTENT);
    }

    /**
     * @param string $text
     * @return CustomerTestimonialInterface
     */
    public function setContent(string $text): CustomerTestimonialInterface
    {
        return $this->setData(CustomerTestimonialInterface::CONTENT, $text);
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return (bool) $this->getData(CustomerTestimonialInterface::IS_PUBLISHED);
    }

    /**
     * @param bool $status
     * @return CustomerTestimonialInterface
     */
    public function setPublished(bool $status): CustomerTestimonialInterface
    {
        return $this->setData(CustomerTestimonialInterface::IS_PUBLISHED, $status);
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(CustomerTestimonialInterface::CREATED_AT);
    }

    /**
     * @param \DateTime $dateTime
     * @return CustomerTestimonialInterface
     */
    public function setCreatedAt(\DateTime $dateTime): CustomerTestimonialInterface
    {
        return $this->setData(CustomerTestimonialInterface::CREATED_AT, $dateTime);
    }
}
