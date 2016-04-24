<?php

namespace Mab\Service;

use Interop\Container\ContainerInterface;
use Symfony\Component\Yaml\Parser;

/**
 * Class ConfigReader
 */
class ConfigReader
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * ConfigReader constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $rootDir
     * @param string $configurationFilePath
     *
     * @return array
     */
    public function loadConfiguration($rootDir, $configurationFilePath)
    {
        $parser = new Parser();
        $config = [];
        if (file_exists($configurationFilePath)) {
            $config = $parser->parse(file_get_contents($configurationFilePath));
            array_walk_recursive($config, function (&$item, $key) use ($rootDir) {
                $item = str_replace('%root%', $rootDir, $item);
            });
        }

        return $config;
    }
}
