import { customFetch } from '../api/interceptors.js'

// сервис для авторизации пользователя
class AuthService {
	// дефолтное начало url для запроса
	BASE_URL = '/auth'

	// запрос на логин
	async login(data) {
		const request = await customFetch(`${this.BASE_URL}/login.php`, {
			body: data,
			method: 'POST',
		})
		const response = await request.json()

		return response
	}

	// запрос на регистрацию
	async reg(data) {
		const request = await customFetch(`${this.BASE_URL}/reg.php`, {
			body: data,
			method: 'POST',
		})
		const response = await request.json()

		return response
	}

	// запрос на выход из системы(просто чистим токен из куков и всё), возвращаем true
	logout() {
		Cookies.remove('accessToken')

		return true
	}
}

// создаем объект класса для обращения из вне
export const authService = new AuthService()
