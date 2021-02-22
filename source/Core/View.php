<?php

namespace Source\Core;

use League\Plates\Engine;

/**
 * @package Source\Core
 */
class View
{
    /** @var Engine */
    private $engine;

    /**
     * View constructor.
     * @param string $baseDir
     * @param string $ext
     */
    public function __construct(string $baseDir, string $ext = CONF_VIEW_EXT)
    {
        $this->engine = Engine::create($baseDir, $ext);
    }

    /**
     * @param string $templateName
     * @param array $data
     * @return string
     */
    public function render(string $templateName, array $data): string
    {
        return $this->engine->render($templateName, $data);
    }
}
