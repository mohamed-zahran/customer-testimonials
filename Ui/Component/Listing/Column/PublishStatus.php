<?php

namespace PinpointDesigns\CustomerTestimonial\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use PinpointDesigns\CustomerTestimonial\Api\Data\CustomerTestimonialInterface;

class PublishStatus extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {
                if ($items[CustomerTestimonialInterface::IS_PUBLISHED]) {
                    $items[CustomerTestimonialInterface::IS_PUBLISHED] = __('Yes');
                } else {
                    $items[CustomerTestimonialInterface::IS_PUBLISHED] = __('No');
                }
            }
        }
        return $dataSource;
    }
}
