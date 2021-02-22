<?php

namespace Source\Support;

use Source\Core\Session;

/**
 * FSPHP | Class Message
 *
 * @author Robson V. Leite <cursos@upinside.com.br>
 * @package Source\Core
 */
class Message
{
    /** @var string */
    private $text;

    /** @var string */
    private $type;

    /** @var string */
    private $before;

    /** @var string */
    private $after;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * @param string|null $text
     * @return string|Message 
     */
    public function text(string $text = null)
    {
        if ($text) {
            $this->text = $this->filter($text);
            return $this;
        }

        return $this->text;
    }

    /**
     * @return string
     */
    public function type(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function success(string $message): Message
    {
        $this->type = 'alert-success';
        $this->text($message);
        return $this;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function warning(string $message): Message
    {
        $this->type = 'alert-warning';
        $this->text($message);
        return $this;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function error(string $message): Message
    {
        $this->type = 'alert-danger';
        $this->text($message);
        return $this;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return <<<MESSAGE
            <div class="alert {$this->type()} alert-dismissible fade show" role="alert">
                {$this->text()}
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
        MESSAGE;
    }

    /**
     * Set flash Session Key
     */
    public function flash(): void
    {
        (new Session())->set('flash', clone $this);
        $this->text = null;
        $this->type = null;
    }

    /**
     * @param string $message
     * @return string
     */
    private function filter(string $message): string
    {
        return filter_var($message, FILTER_SANITIZE_STRIPPED);
    }
}
