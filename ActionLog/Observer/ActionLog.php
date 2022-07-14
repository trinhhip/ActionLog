<?php
namespace Leo\ActionLog\Observer;

class ActionLog implements \Magento\Framework\Event\ObserverInterface
{
    protected $url;

    public function __construct(
        \Magento\Framework\App\Request\Http $url
    ) {
        $this->url = $url;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/action-log.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('Module: ' . $this->url->getModuleName());
        $logger->info('Action name: ' . $this->url->getFullActionName());
        $logger->info('Route name: ' . $this->url->getRouteName());
        $logger->info('-------------------');
    }
}