<?php

namespace App\Components;

class Toolbar extends Component
{
    public function __construct($props = [])
    {
        $this->uri = explode($_SERVER['REQUEST_URI'], '?')[0];
        $this->buttons = [
            [
                'icon' => 'magnifying-glass',
                'action' => 'view',
                'handler' => 'handleSearch'
            ],
            [
                'icon' => 'pen-to-square',
                'action' => 'edit',
                'handler' => 'handleEdit'
            ],
            [
                'icon' => 'trash',
                'action' => 'delete',
                'handler' => 'handleDelete'
            ],
            [
                'icon' => 'plus',
                'action' => 'add',
                'handler' => 'handleAdd'
            ],
            [
                'icon' => 'sliders',
                'action' => 'justify',
                'handler' => 'handleRule'
            ]
        ];
        $this->action = $props['action'] ?? '';
    }

    private function renderButtons()
    {
        $buttonElements = '';

        foreach ($this->buttons as $button) {
            $active = $this->action == $button['action'] ? 'active' : '';

            $buttonElements .= <<<EOT
            <a 
            href="?action={$button['action']}" 
            class="button $active"
            >
                <i class="fa-solid fa-{$button['icon']}"></i>
            </a>
            EOT;
        }

        return $buttonElements;
    }

    public function render()
    {
        $buttonElements = $this->renderButtons();

        return <<<EOT
        <div class="toolbar active">
            $buttonElements
        </div>

        EOT;
    }
}
?>

<link rel="stylesheet" href="./css/Toolbar.css">