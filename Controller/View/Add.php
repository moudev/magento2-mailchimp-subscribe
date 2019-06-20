<?php

namespace Magento\MailChimpApi\Controller\View;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

/**
 * Customer section controller
 */
class Add extends \Magento\Framework\App\Action\Action implements HttpGetActionInterface
{
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var Request
     */
    private $_requestManager;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param \Learning\FirstUnit\Model\Page\Request $requestManager
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        \Magento\MailChimpApi\Model\View\Request $requestManager
    ) {
        
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_requestManager = $requestManager;
        parent::__construct($context);
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        $resultJson->setHeader('Cache-Control', 'max-age=0, must-revalidate, no-cache, no-store', true);
        $resultJson->setHeader('Pragma', 'no-cache', true);
        try {
            $params = $this->getRequest()->getParams();
            array_splice($params, 3);
            $response = $this->_requestManager->addSubscriberList(json_encode($params), '33fd85651a');
        } catch (\Exception $e) {
            $resultJson->setStatusHeader(
                \Zend\Http\Response::STATUS_CODE_400,
                \Zend\Http\AbstractMessage::VERSION_11,
                'Bad Request'
            );
            $response = ['error' => $this->escaper->escapeHtml($e->getMessage())];
        }
        return $resultJson->setData($response);        
    }
}
