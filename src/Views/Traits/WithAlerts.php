<?php

namespace LaravelViews\Views\Traits;

use LaravelViews\Views\View;

trait WithAlerts
{
    public function success($message = null)
    {
        $this->setMessage('success', $message);
    }

    public function error($message = null)
    {
        $this->setMessage('danger', $message);
    }

    private function setMessage($type = 'success', $message = null)
    {
        $view = $this->view && $this->view instanceof View ? $this->view : $this;

        $messages = [
            'success' => __('Action was executed successfully'),
            'danger' => __('There was an error executing this action'),
        ];

        // Nico, 20240514.17:44
        //$view->emitSelf('notify', [
        $view->dispatchSelf('notify', [
            'message' => $message ? $message : $messages[$type],
            'type' => $type
        ]);
    }
}
