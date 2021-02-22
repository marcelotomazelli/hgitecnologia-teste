<?php

namespace Source\Core;

use Source\Support\Message;

/**
 * FSPHP | Class Controller
 *
 * @author Robson V. Leite <cursos@upinside.com.br>
 * @package Source\Core
 */
abstract class Controller
{
    /** @var Message */
    protected $message;

    /** @var string */
    protected $view;

    /** @var array */
    protected $data;

    /** @var string */
    protected $template;

    /** @var array */
    protected $json;

    /** @var string */
    protected $redirect;

    /**
     * Controller constructor. 
     * @param string|null $pathToViews 
     */
    public function __construct(string $pathToViews = null)
    {
        $this->message = new Message();

        $this->view = $pathToViews;

        $this->data = [];
        $this->json = [];
        $this->redirect = null;
    }

    /**
     * @param string $name 
     * @return Controller
     */
    protected function template(string $name): Controller
    {
        $this->template = $name;
        return $this;
    }

    /**
     * @param string $path 
     * @return Controller
     */
    protected function redirect(string $path): void
    {
        $this->redirect = $path;
    }

    /**
     * @param array|null $array 
     * @return array|null 
     */
    protected function filterData(?array $data): ?array
    {
        if (empty($data)) {
            return $data;
        }

        return filter_var_array($data, FILTER_SANITIZE_STRIPPED);
    }
    
    /**
     * Crotroller finalize.
     */
    private function finalize(): void
    {
        if (!empty($this->redirect)) {
            redirect($this->redirect);
            return;
        }

        if (!empty($this->json)) {
            echo json_encode($this->json);
            return;
        }

        if ($this->template) {
            if ($this->message->text() && $this->message->type()) {
                $this->data['message'] = $this->message->render();
            }
            
            echo (new View($this->view))->render($this->template, $this->data);
            return;
        }
        
        if (empty($this->redirect)) {
            redirect('/erro/manutencao');
        }
    }

    /**
     * Controller destructor.
     */
    public function __destruct()
    {
        $this->finalize();
    }
}
