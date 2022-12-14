<?php
require_once("../View.php");

class Toolbar extends Component
{
    private $buttonIcons = [
        'magnifying-glass',
        'pen-to-square',
        'trash',
        'plus',
        'sliders'
    ];

    private function renderButtons()
    {
        $buttonElements = '';
        foreach ($this->buttonIcons as $icon) {
            $buttonElements .= <<<EOT
            <button type="button">
                <i class="fa-solid fa-$icon"></i>
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
?>