<?php

namespace System;
/**
 * View-specific wrapper.
 * Limits the accessible scope available to templates.
 */
class View{
    /**
     * Template being rendered.
     */
    protected $template = null;


    /**
     * Initialize a new view context.
     */
    public function __construct($template) {
        $this->template = $template;
    }

    /**
     * Safely escape/encode the provided data.
     */
    public function h($data) {
        return htmlspecialchars((string) $data, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Render the template, returning it's content.
     * @param array $data Data made available to the view.
     * @return string The rendered template.
     */
    public function render(Array $data) {
        extract($data);
        ob_start();
        include ( __DIR__ . DIRECTORY_SEPARATOR .'../view'. DIRECTORY_SEPARATOR. $this->template);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}