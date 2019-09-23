<?php

namespace PinpointDesigns\CustomerTestimonial\Model;

use PinpointDesigns\CustomerTestimonial\Api\CustomerTestimonialRepositoryInterface;
use PinpointDesigns\CustomerTestimonial\Api\Data\CustomerTestimonialInterface;
use PinpointDesigns\CustomerTestimonial\Model\ResourceModel\CustomerTestimonial\CollectionFactory;

class CustomerTestimonialRepository implements CustomerTestimonialRepositoryInterface
{
    private $collectionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return CustomerTestimonialInterface[]
     */
    public function getList(): array
    {
        return $this->collectionFactory
            ->create()
            ->setOrder(CustomerTestimonialInterface::CREATED_AT, 'DESC')
            ->getItems();
    }

    /**
     * @return CustomerTestimonialInterface[]
     */
    public function getPublishedList(): array
    {
        return $this->collectionFactory
            ->create()
            ->setOrder(CustomerTestimonialInterface::CREATED_AT, 'DESC')
            ->addFieldToFilter(CustomerTestimonialInterface::IS_PUBLISHED, ['eq' => CustomerTestimonialInterface::PUBLISHED])
            ->getItems();
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function togglePublishStatus(int $id): void
    {
        /** @var CustomerTestimonial $testimonial */
        $testimonial = $this->collectionFactory
            ->create()
            ->addFieldToFilter(CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID, ['eq' => $id])
            ->getFirstItem();

        if ($testimonial) {
            $testimonial->setPublished($testimonial->isPublished() ? false : true);
            $testimonial->save();
        }
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function delete(int $id)
    {
        /** @var CustomerTestimonial $testimonial */
        $testimonial = $this->collectionFactory
            ->create()
            ->addFieldToFilter(CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID, ['eq' => $id])
            ->getFirstItem();

        if ($testimonial) {
            $testimonial->delete();
        }
    }
}
