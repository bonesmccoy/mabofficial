<?php

namespace Mab\Controller;

use Interop\Container\ContainerInterface;

/**
 * Class AbstractController
 */
class AbstractController
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * HomeController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
