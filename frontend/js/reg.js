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
			alert('Поле не заполнено!')
		} else {
			fields.push(el.value)
		}
	})

	// если всё ок, то формируем дату
	const data = {
		name: fields[0],
		email: fields[1],
		password: fields[2],
	}

	// отправляем ее и получаем ответ
	const response = await authService.reg(JSON.stringify(data))

	if (response.status === 'success') {
		// если регистрация прошла успешно - кидаем на страницу логина
		location.href = 'login.php'
	}
})
