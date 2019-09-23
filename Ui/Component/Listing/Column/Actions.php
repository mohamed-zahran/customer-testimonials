<?php

namespace PinpointDesigns\CustomerTestimonial\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use PinpointDesigns\CustomerTestimonial\Api\Data\CustomerTestimonialInterface;

class Actions extends Column
{
    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $this->addTogglePublishStatusActionItem($item);
                $this->addEditActionItem($item);
                $this->addDeleteActionItem($item);
            }
        }
        return $dataSource;
    }

    public function addTogglePublishStatusActionItem(&$item): void
    {
        if (strtolower($item[CustomerTestimonialInterface::IS_PUBLISHED]) === 'yes') {
            $label = __('Unpublish');
        } else {
            $label = __('Publish');
        }

        $item[$this->getData('name')]['toggle'] = [
            'href' => $this->urlBuilder->getUrl('testimonials/testimonial/toggle', [
                'id' => $item[CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID]
            ]),
            'label' => $label,
            'hidden' => false,
        ];
    }

    private function addEditActionItem(&$item): void
    {
        $item[$this->getData('name')]['edit'] = [
            'href' => $this->urlBuilder->getUrl('testimonials/testimonial/edit', [
                'id' => $item[CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID]
            ]),
            'label' => __('Edit'),
            'hidden' => false,
        ];
    }

    private function addDeleteActionItem(&$item): void
    {
        $item[$this->getData('name')]['delete'] = [
            'href' => $this->urlBuilder->getUrl('testimonials/testimonial/delete', [
                'id' => $item[CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID]
            ]),
            'label' => __('Delete'),
            'hidden' => false,
        ];
    }
}
