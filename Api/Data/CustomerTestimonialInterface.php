<?php

namespace PinpointDesigns\CustomerTestimonial\Api\Data;

interface CustomerTestimonialInterface
{
    const TABLE_NAME = 'customer_testimonial';
    const CUSTOMER_TESTIMONIAL_ID = 'customer_testimonial_id';
    const FULLNAME = 'fullname';
    const CONTENT = 'content';
    const IS_PUBLISHED = 'is_published';
    const PUBLISHED = true;
    const UNPUBLISHED = false;
    const CREATED_AT = 'created_at';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param $id
     * @return CustomerTestimonialInterface
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getFullname(): string;

    /**
     * @param string $fullname
     * @return CustomerTestimonialInterface
     */
    public function setFullname(string $fullname): CustomerTestimonialInterface;

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @param string $text
     * @return CustomerTestimonialInterface
     */
    public function setContent(string $text): CustomerTestimonialInterface;

    /**
     * @return bool
     */
    public function isPublished(): bool;

    /**
     * @param bool $status
     * @return CustomerTestimonialInterface
     */
    public function setPublished(bool $status): CustomerTestimonialInterface;

    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @param \DateTime $dateTime
     * @return CustomerTestimonialInterface
     */
    public function setCreatedAt(\DateTime $dateTime): CustomerTestimonialInterface;
}
