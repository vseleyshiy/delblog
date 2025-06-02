import { customFetch, fetchWithAuth } from '../api/interceptors.js'

class PostService {
	// базовый url
	BASE_URL = '/post'

	// добавление поста.
	async addPost(data) {
		const request = await fetchWithAuth(`${this.BASE_URL}/add_post.php`, {
			body: data,
			method: 'POST',
		})
		const response = await request.json()

		return response
	}

	// удаление поста
	async deletePost(id) {
		const request = await fetchWithAuth(`${this.BASE_URL}/delete_post.php`, {
			body: JSON.stringify({ id }),
			method: 'PUT',
		})
		const response = await request.json()

		return response
	}

	// получение всех постов. К слову, написать просто /post не достаточно, работает только когда пишешь полностью - /post/index.php
	async getPosts() {
		const request = await customFetch(`${this.BASE_URL}/index.php`, {
			method: 'GET',
		})
		const response = await request.json()

		return response
	}

	// получение определенного поста с сервера по айди
	async getPost(id) {
		const request = await customFetch(`${this.BASE_URL}/get_post.php`, {
			method: 'POST',
			body: JSON.stringify({ id }),
		})
		const response = await request.json()

		return response
	}
}

// создаем объект класса для обращения из вне
export const postService = new PostService()
