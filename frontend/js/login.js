import { authService } from './services/auth.service.js'
import { getToken } from './services/jwt.service.js'

// если юзер уже авторизирован, нечего ему делать на странице авторизации - выкидываем
const token = getToken()

if (token) location.href = 'index.php'

const inputs = document.querySelectorAll('.form__row > input')
const submit = document.getElementById('submit')
const fields = []

submit.addEventListener('click', async () => {
	// при нажатии на кнопку войти проверяем поля на пустоту
	inputs.forEach(el => {
		if (el.value === '') {
			alert(`Поле не заполнено!`)
		} else {
			fields.push(el.value)
		}
	})

	// если всё ок, то формируем дату
	const data = {
		email: fields[0],
		password: fields[1],
	}

	// отправляем ее и получаем ответ
	const response = await authService.login(JSON.stringify(data))

	if (response.status === 'success') {
		// если всё ок, то забираем из ответа токен и назначаем frontend cookie с токеном, что значит, что юзер авторизировался
		Cookies.set('accessToken', response.accessToken, { expires: 1 })
		// кидаем на главную
		location.href = 'index.php'
	}
})
