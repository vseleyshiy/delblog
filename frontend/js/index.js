import { getToken } from './services/jwt.service.js'
import { postService } from './services/post.service.js'

const list = document.querySelector('.list')

// пока посты грузятся пишем загрузка
list.innerHTML = 'Загрузка...'

// получение постов и их вывод
export const getPosts = async () => {
	// получаем посты с сервера
	const posts = await postService.getPosts()

	// чистим лист
	list.innerHTML = ''

	// пробегаемся по постам, создаем для них html и добавляем на страницу
	// если текст длинее 200 символов, обрезаем и добалвяем точки
	posts.forEach(el => {
		const item = `
			<div class="item">
			${
				el.image
					? `
				<div class="item__img-wrap">
					<img
						src='img/posts_img/${el.image}'
						alt='${el.title}'
						class="item__img" />
				</div>
				`
					: ''
			}
				<div class="item__info">
					<div class="item__title">${el.title}</div>
					<div class="item__text">
						${el.content.length > 200 ? el.content.slice(0, 200) + '...' : el.content}
					</div>
					<a href="post.php?id=${el.id}" class="link">Читать далее...</a>
				</div>
			</div>
			`
		list.innerHTML += item
	})
}

// при загрузке страницы запрашиваем посты
document.addEventListener('DOMContentLoaded', getPosts)

// проверяем, авторизован ли юзер. Если да, то он может добавлять посты - выводим кнопку, если нет, то не может - не выводим кнопку для добавления постов
const token = getToken()
const mainHeader = document.querySelector('.main__header')

if (token) {
	mainHeader.innerHTML += `
	<div class="btn" id="add-button">
		Добавить пост
	</div>
	`
}
