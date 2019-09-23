<?php

namespace PinpointDesigns\CustomerTestimonial\Api;

use PinpointDesigns\CustomerTestimonial\Api\Data\CustomerTestimonialInterface;

interface CustomerTestimonialRepositoryInterface
{
    /**
     * @return CustomerTestimonialInterface[]
     */
    public function getList(): array;

    /**
     * @return CustomerTestimonialInterface[]
     */
    public function getPublishedList(): array;

    /**
     * @param int $id
     * @return void
     */
    public function togglePublishStatus(int $id): void;

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}
