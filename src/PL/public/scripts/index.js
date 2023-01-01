const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

const features = {
    room: 0,
    booking: 1,
    customer: 2,
    bill: 3,
    report: 4,
}

// Xử lý sự kiện cho các nút bấm
function handleEvents() {
    const sidebarButtons = $('.sidebar')?.querySelectorAll('li')
    const toolbarButtons = $('.toolbar')?.querySelectorAll('button')

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
    const sidebarButtons = $('.sidebar')?.querySelectorAll('li')
    const featureButton = sidebarButtons[features[featureIndex]]
    featureButton?.classList.add('active')

    // Cập nhật tiêu đề chức năng
    const featureTitle = $('.feature-title')
    sidebarButtons.forEach((button) => {
        if (button.classList.contains('active'))
            featureTitle.textContent = button.querySelector('span').textContent
    })
}

// Xóa dòng đã chọn trong bảng
function deleteSelectedEntries() {
    const entries = $('table').querySelectorAll('tr')
    const selectedEntries = Array.from(entries).filter(
        (field) => field.querySelector('input')?.checked,
    )

    if (selectedEntries) {
        selectedEntries.forEach((entry) => {
            entry.remove()
        })
    }
}