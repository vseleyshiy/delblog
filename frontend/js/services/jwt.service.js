// просто отдельная функция для получения токена из cookie
export const getToken = () => {
	return Cookies.get('accessToken')
}
