import { fetchWithAuth } from '../api/interceptors.js'

class UserService {
	// запрос на получение данных о юзере. Запрос работает только для авторизированных пользователей, поэтому использую fetchWithAuth
	async getProfile() {
		const request = await fetchWithAuth('/user/profile.php', {
			method: 'GET',
		})
		const response = await request.json()

		return response
	}
}

// создаем объект класса для обращения из вне
export const userService = new UserService()
