<link rel="stylesheet" href="./css/Toolbar.css">

<?php
class Toolbar extends Component
{
    public function __construct()
    {
        $this->buttonIcons = [
            'magnifying-glass',
            'pen-to-square',
            'trash',
            'plus',
            'sliders'
        ];

        $this->eventHandlers =[
            'handleSearch',
            'handleEdit',
            'handleDelete',
            'handleAdd',
            'handleRule',
        ];
    }

    private function renderButtons()
    {
        $buttonElements = '';
        for ($i = 0; $i < count($this->buttonIcons); $i++) {
            $eventHandler = $this->eventHandlers[$i];
            $buttonIcon = $this->buttonIcons[$i];

            $buttonElements .= <<<EOT
            <button type="button" onclick="$eventHandler()">
                <i class="fa-solid fa-$buttonIcon"></i>
            </button>
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
