<?php

namespace PinpointDesigns\CustomerTestimonial\Model\Import;

use Exception;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\ImportExport\Helper\Data as ImportHelper;
use Magento\ImportExport\Model\Import;
use Magento\ImportExport\Model\Import\Entity\AbstractEntity;
use Magento\ImportExport\Model\Import\ErrorProcessing\ProcessingErrorAggregatorInterface;
use Magento\ImportExport\Model\ResourceModel\Helper;
use Magento\ImportExport\Model\ResourceModel\Import\Data;
use PinpointDesigns\CustomerTestimonial\Api\Data\CustomerTestimonialInterface;

class Testimonial extends AbstractEntity
{
    public const ENTITY_CODE = 'customer_testimonial';

    protected $connection;

    protected $needColumnCheck = true;

    protected $_permanentAttributes = [
        CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID,
    ];

    protected $validColumnNames = [
        CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID,
        CustomerTestimonialInterface::FULLNAME,
        CustomerTestimonialInterface::CONTENT,
    ];

    public function __construct(
        JsonHelper $jsonHelper,
        ImportHelper $importExportData,
        Data $importData,
        ResourceConnection $resource,
        Helper $resourceHelper,
        ProcessingErrorAggregatorInterface $errorAggregator
    ) {
        $this->jsonHelper = $jsonHelper;
        $this->_importExportData = $importExportData;
        $this->_resourceHelper = $resourceHelper;
        $this->_dataSourceModel = $importData;
        $this->connection = $resource->getConnection(ResourceConnection::DEFAULT_CONNECTION);
        $this->errorAggregator = $errorAggregator;
        $this->initMessageTemplates();
    }

    private function initMessageTemplates()
    {
        $this->addMessageTemplate(
            'NameIsRequired',
            __('The name cannot be empty.')
        );
        $this->addMessageTemplate(
            'DurationIsRequired',
            __('Duration should be greater than 0.')
        );
    }

    public function getEntityTypeCode()
    {
        return static::ENTITY_CODE;
    }

    public function validateRow(array $rowData, $rowNum)
    {
        $fullname = $rowData['fullname'] ?? '';
        $content = $rowData['content'] ?? '';

        if (!$fullname) {
            $this->addRowError('FullnameIsRequired', $rowNum);
        }

        if (!$content) {
            $this->addRowError('ContentIsRequired', $rowNum);
        }

        if (isset($this->_validatedRows[$rowNum])) {
            return !$this->getErrorAggregator()->isRowInvalid($rowNum);
        }

        $this->_validatedRows[$rowNum] = true;

        return !$this->getErrorAggregator()->isRowInvalid($rowNum);
    }

    protected function _importData(): bool
    {
        switch ($this->getBehavior()) {
            case Import::BEHAVIOR_DELETE:
                $this->deleteEntity();
                break;
            case Import::BEHAVIOR_APPEND:
            case Import::BEHAVIOR_REPLACE:
                $this->saveAndReplaceEntity();
                break;
        }

        return true;
    }

    private function deleteEntity(): bool
    {
        $rows = [];

        while ($bunch = $this->_dataSourceModel->getNextBunch()) {
            foreach ($bunch as $rowNum => $rowData) {
                $this->validateRow($rowData, $rowNum);

                if (!$this->getErrorAggregator()->isRowInvalid($rowNum)) {
                    $rows[] = $rowData[CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID];
                }

                if ($this->getErrorAggregator()->hasToBeTerminated()) {
                    $this->getErrorAggregator()->addRowToSkip($rowNum);
                }
            }
        }

        if ($rows) {
            return $this->deleteEntityFinish(array_unique($rows));
        }

        return false;
    }

    private function saveAndReplaceEntity(): void
    {
        $rows = [];

        $behavior = $this->getBehavior();

        while ($bunch = $this->_dataSourceModel->getNextBunch()) {
            $entityList = [];

            foreach ($bunch as $rowNum => $row) {
                if (!$this->validateRow($row, $rowNum)) {
                    continue;
                }

                if ($this->getErrorAggregator()->hasToBeTerminated()) {
                    $this->getErrorAggregator()->addRowToSkip($rowNum);
                    continue;
                }

                $rowId = $row[CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID];
                $rows[] = $rowId;
                $columnValues = [];

                foreach ($this->validColumnNames as $columnKey) {
                    $columnValues[$columnKey] = $row[$columnKey];
                }

                $entityList[$rowId][] = $columnValues;

                $this->countItemsCreated += (int)!isset($row[CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID]);
                $this->countItemsUpdated += (int)isset($row[CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID]);
            }

            if (Import::BEHAVIOR_REPLACE === $behavior) {
                if ($rows && $this->deleteEntityFinish(array_unique($rows))) {
                    $this->saveEntityFinish($entityList);
                }
            } elseif (Import::BEHAVIOR_APPEND === $behavior) {
                $this->saveEntityFinish($entityList);
            }
        }
    }

    private function saveEntityFinish(array $entityData): bool
    {
        if (!$entityData) {
            return false;
        }

        $rows = [];

        foreach ($entityData as $entityRows) {
            foreach ($entityRows as $row) {
                $rows[] = $row;
            }
        }

        if (!$rows) {
            return false;
        }

        $this->connection->insertOnDuplicate(
            $this->connection->getTableName(CustomerTestimonialInterface::TABLE_NAME),
            $rows,
            $this->validColumnNames
        );

        return true;
    }

    private function deleteEntityFinish(array $entityIds): bool
    {
        if ($entityIds) {
            try {
                $this->countItemsDeleted += $this->connection->delete(
                    $this->connection->getTableName(CustomerTestimonialInterface::TABLE_NAME),
                    $this->connection->quoteInto(CustomerTestimonialInterface::CUSTOMER_TESTIMONIAL_ID . ' IN (?)', $entityIds)
                );
                return true;
            } catch (Exception $e) {
                return false;
            }
        }

        return false;
    }
}
