<script>
    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);

    const sidebarButtons = $('.sidebar')?.querySelectorAll('li')
    const toolbarButtons = $('.toolbar')?.querySelectorAll('button')
    const featureTitle = $('.feature-title')

    // Xử lý sự kiện click vào nút sidebar
    function handleButtons(buttons) {
        buttons.forEach((button) => {
            // Xử lý class actived
            button.addEventListener('click', () => {
                buttons.forEach((btn) => {
                    btn.classList.remove('actived')
                })

                button.classList.add('actived')
                changeFeatureTitle()
            })
        })
    }

    // Thay đổi tiêu đề
    function changeFeatureTitle() {
        sidebarButtons.forEach((button) => {
            if (button.classList.contains('actived'))
                featureTitle.textContent =
                button.querySelector('span').textContent
        })
    }

    handleButtons(sidebarButtons)
    handleButtons(toolbarButtons)
</script>