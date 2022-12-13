<script>
    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);

    const features = {
        'room': 0,
        'customer': 1,
        'bill': 2,
        'report': 3,
    }

    const featureTitle = $('.feature-title')
    const sidebarButtons = $('.sidebar')?.querySelectorAll('li')
    const toolbarButtons = $('.toolbar')?.querySelectorAll('button')

    // Xử lý sự kiện
    function handleEvents() {
        function handleButtons(buttons) {
            if (buttons) {
                buttons.forEach((button) => {
                    button.addEventListener('click', () => {
                        buttons.forEach((btn) => {
                            btn.classList.remove('active')
                        })

                        button.classList.add('active')
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
        featureButton?.classList.add('active');

        // Cập nhật tiêu đề chức năng
        sidebarButtons.forEach((button) => {
            if (button.classList.contains('active'))
                featureTitle.textContent =
                button.querySelector('span').textContent
        })
    }

    // Thay đổi form
    function renderForm(formName) {
        const forms = Array.from($$('form'))
        forms.forEach((form) => {
            const formClassName = form.classList[0]
            if (formClassName == formName)
                form.classList.remove('hidden')
        })
    }

    // Xử lý sự kiện khi click vào tháng
    function handleMonths() {
        const months = $$('.month')
        months.forEach((month) => {
            month.addEventListener('click', (e) => {
                const activeMonth = e.target.innerText
                const formToBeRendered = 'report-form'
                // Xử lý chuyển hướng trang
            })
        })
    }
</script>