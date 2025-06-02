import { SERVER } from '../config/config.js'
import { getToken } from '../services/jwt.service.js'
// файл с кастомными fetch, чтобы делать запросы, когда клиент не авторизован, и когда авторизован (там в заголовки добавляется Authorization с токеном)

// fetch, для ситуаций, где авторизация не нужна. Всё что тут изменено - это дефолтный url. Не нужно прописывать с самого начала, типо можно писать не https://delblog.local/backend/api/post/index.php, а просто /post/index.php, тк начало у всех запросов одинаковое
export function customFetch(url, options = {}) {
	const fullUrl = `${SERVER}${url}`
	return fetch(fullUrl, options)
}

// получаем токен из куков
const token = getToken()

// добавляем токен в заголовок Authorization
const defaultHeaders = {
	Authorization: `Bearer ${token}`,
}

// добавляем этот объект с заголовком Authorization в наш customFetch и тадам - фетч для авторизованных пользователей готов
export function fetchWithAuth(url, options = {}) {
	const combinedHeaders = {
		// тут добавляем к options, которые были переданы в функцию наш объект с заголовком Authorization
		...options.headers,
		...defaultHeaders,
	}

	// соединяем воедино снова
	const modifiedOptions = {
		...options,
		headers: combinedHeaders,
	}

	// прокидываем новые заголовки с уже предустановленным Authorization
	return customFetch(url, modifiedOptions)
}
