import { getPosts } from './index.js'
import { postService } from './services/post.service.js'

// скрипт для добавления постов

const publicateBtn = document.getElementById('publicate')
const fileInput = document.querySelector('.form__row > input[type="file"]')

// функция для изменения текста при добавлении файла
fileInput.addEventListener('change', () => {
	const fileLabel = document.querySelector('.form__row:has(input[type="file"])')
	if (fileInput.files.length === 1) {
		fileLabel.textContent = 'Файл добавлен'
	}
})

publicateBtn.addEventListener('click', () => addPost())

const addPost = async () => {
	const inputs = document.querySelectorAll(
		'.form__row > input, .form__row > textarea'
	)

	const fields = []

	// проверка полей на заполненность
	inputs.forEach(el => {
		if (el.value === '') {
			if (el.getAttribute('type') !== 'file') alert('Поле не заполнено!')
		} else {
			fields.push(el.value)
		}
	})

	// создаем формдату и добавляем в нее картинку, если она есть. Формдата была выбрана (а не json), потому что я не знаю, как при помощи json передать файл
	const formData = new FormData()

	formData.append('title', fields[0])
	formData.append('content', fields[1])
	if (fileInput.value !== '') {
		formData.append('image', fileInput.files[0])
	} else {
		formData.append('image', null)
	}

	// делаем запрос на сервер с добавлением поста, передавая дату
	const response = await postService.addPost(formData)

	// если всё ок, обновляем посты на главной странице. Делаем так, чтобы избежать перезагрузки страницы.
	if (response.status === 'success') {
		getPosts()
	}
}
