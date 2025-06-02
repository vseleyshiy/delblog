import { customFetch } from '../api/interceptors.js'

// сервис поиска
class SearchService {
	// запрос на поиск постов по тексту
	async search(text) {
		const request = await customFetch('/search/search.php', {
			method: 'POST',
			body: JSON.stringify({ text }),
		})

		const response = await request.json()

		return response
	}
}

// создаем объект класса для обращения из вне
export const searchService = new SearchService()
