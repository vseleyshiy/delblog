import { fetchWithAuth } from '../api/interceptors.js'

// сервис для админки
// СЕРВИС - это файл, где находится вся так называемая бизнес-логика приложения, все запросы типо. В будущем мы просто импортируем запрос в виде adminService.getInfo() и получаем информацию. Таким образом код лучше читается, потому что все запросы вынесены отдельно
class AdminService {
	// запрос на получение информации для админ панели в первый столбик
	async getInfo() {
		const request = await fetchWithAuth(`/admin/get_info.php`, {
			method: 'GET',
		})
		const response = await request.json()

		return response
	}
}

// создаем объект класса для обращения из вне
export const adminService = new AdminService()
