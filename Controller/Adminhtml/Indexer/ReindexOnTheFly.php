<?php
/**
 * Copyright © Magenuts Pvt Ltd. All rights reserved.
 * See COPYING.txt for license details.
 * http://www.magenuts.com | support@magenuts.com
 */
namespace Magenuts\Reindex\Controller\Adminhtml\Indexer;

use Exception;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Indexer\IndexerInterface;
use Magento\Indexer\Model\IndexerFactory;
use Magenuts\Reindex\Controller\Adminhtml\Indexer;

class ReindexOnTheFly extends Indexer
{

    /** @var IndexerInterface  */
    protected $indexerFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param IndexerFactory $indexerFactory
     */
    public function __construct(
        Context $context,
        IndexerFactory $indexerFactory
    ) {
        $this->indexerFactory = $indexerFactory;
        parent::__construct($context);
    }

    /**
     * @return void
     */
    public function execute()
    {
        $indexerIds = $this->getRequest()->getParam('indexer_ids');
        if (!is_array($indexerIds)) {
            $this->messageManager->addErrorMessage(__('Please select indexers.'));
        } else {
            try {
                foreach ($indexerIds as $indexerId) {
                    $indexer = $this->indexerFactory->create();
                    $indexer->load($indexerId)->reindexAll();
                }

                $this->messageManager->addSuccessMessage(
                    __('Reindex %1 indexer(s).', count($indexerIds))
                );
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage(
                    $e,
                    __("We couldn't reindex because of an error.")
                );
            }
        }

        $this->_redirect('*/*/list');
    }
}
