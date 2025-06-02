// функция дебаунс, при помощи которой сделан поиск. Помогает защитить сервер от клиенского спама и постоянного дерганья => это оптимизация для сервера и некая защита.

export const debounce = (cb, delay = 1000) => {
	let timeout
	return (...args) => {
		clearTimeout(timeout)
		timeout = setTimeout(() => {
			cb(...args)
		}, delay)
	}
}
