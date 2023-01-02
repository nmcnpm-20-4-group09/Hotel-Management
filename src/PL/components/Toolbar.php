<?php
namespace Components;

class Toolbar extends Component
{
    public function __construct($props = [])
    {
        $this->buttons = [
            [
                'icon' => 'list',
                'action' => 'view',
            ],
            [
                'icon' => 'plus',
                'action' => 'add',
            ],
            [
                'icon' => 'trash',
                'action' => 'delete',
            ],
            [
                'icon' => 'pen-to-square',
                'action' => 'edit',
            ],
            [
                'icon' => 'sliders',
                'action' => 'justify',
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