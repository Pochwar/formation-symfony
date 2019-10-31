<?php


namespace App\Manager;


use Psr\Log\LoggerInterface;

class ReviewManagerLoggableDecorator implements ReviewManagerInterface
{
    /**
     * @var ReviewManagerInterface
     */
    private $parent;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(ReviewManagerInterface $parent, LoggerInterface $logger)
    {
        $this->parent = $parent;
        $this->logger = $logger;
    }

    public function manage($review)
    {
        $this->parent->manage($review);
        $this->logger->notice('A review has been submitted');
    }
}
