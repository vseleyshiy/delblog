import { DOMAIN } from './config/config.js'
import { getToken } from './services/jwt.service.js'
import { postService } from './services/post.service.js'
import { userService } from './services/user.service.js'

const postLabel = document.querySelector('.post')
// загрузка до подгрузки данных
postLabel.innerHTML = 'Загрузка...'

// асинк функция для получения конкретного поста по query параметру из url
const getPost = async id => {
	const post = await postService.getPost(id)
	const token = getToken()
	let html

	// если зареган
	if (token && post) {
		// запрашиваем данные о текущем юзере
		const user = await userService.getProfile()

		if (user) {
			// если юзер зареган, а так же он является владельцем поста или является админом, то ставим кнопку удаления
			html = `
	${
		post.owner === user.id || user.is_admin === 1
			? `
		<div class="delete">
			<img src="img/trash.svg" alt="delete post" class="delete__img">
		</div>
		`
			: ''
	}
	`
		}
		// добавляем оставшуюся часть кода разметки поста
		html += `
	<div class="user">
		<div class="avatar">
			<img
				src="img/circle-user-round.svg"
				alt="${post.name}"
				class="avatar__img" />
		</div>
		<div class="name">${post.name}</div>
	</div>
	<h1 class="post__title">${post.title}</h1>
	<div class="post__date">
		Дата:
		<span>${post.created_at}</span>
	</div>
	${
		post.image
			? `
		<div class="post__img-wrap">
		<img
			src='img/posts_img/${post.image}'
			alt="post_img"
			class="post__img" />
		</div>
		`
			: ''
	}
	<div class="post__text">
		${post.content}
	</div>
	<a href="index.php" class="link">Назад к списку</a>
	`

		postLabel.innerHTML = html

		// инициализируем кнопку удаления
		deletePost()
	}
}

// достаем query параметры url
const url = location.href
const params = new URLSearchParams(url)

// получаем айди из query параметра url
const id = params.get(`${DOMAIN}/post.php?id`)

// при загрузке кода тащим из базы пост
document.addEventListener('DOMContentLoaded', () => getPost(id))

const deletePost = () => {
	const btn = document.querySelector('.delete')

	// если кнопки нету, то выходим
	if (!btn) return

	btn.addEventListener('click', async () => {
		// запрос на удаление поста
		const response = await postService.deletePost(id)
		// если удалилось, то отправляем на главную
		if (response.status === 'success') {
			location.href = 'index.php'
		}
	})
}
