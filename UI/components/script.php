<script>
    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);

    const sidebarButtons = $('.sidebar')?.querySelectorAll('li')
    const toolbarButtons = $('.toolbar')?.querySelectorAll('button')
    const featureTitle = $('.feature-title')
    const features = {
        'room': 0,
        'customer': 1,
        'bill': 2,
        'report': 3,
    }

    // Xử lý sự kiện
    function handleEvents() {
        function handleButtons(buttons) {
            if (buttons) {
                buttons.forEach((button) => {
                    button.addEventListener('click', () => {
                        buttons.forEach((btn) => {
                            btn.classList.remove('actived')
                        })

                        button.classList.add('actived')
                    })
                })
            }
        }

        handleButtons(sidebarButtons)
        handleButtons(toolbarButtons)
    }

    // Thay đổi giao diện của chức năng
    function updateFeature(featureIndex) {
        // Cập nhật nút chức năng
        const featureButton = sidebarButtons[features[featureIndex]];
        featureButton?.classList.add('actived');

        // Cập nhật tiêu đề chức năng
        sidebarButtons.forEach((button) => {
            if (button.classList.contains('actived'))
                featureTitle.textContent =
                button.querySelector('span').textContent
        })
    }
</script>