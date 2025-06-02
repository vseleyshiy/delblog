import { authService } from './services/auth.service.js'
import { getToken } from './services/jwt.service.js'
import { searchService } from './services/search.service.js'
import { userService } from './services/user.service.js'
import { debounce } from './utils/debounce.js'

const profile = document.querySelector('.profile')
const token = getToken()

// пока юзер не грузанулся пишем загрузка.
profile.innerHTML = 'Загрузка...'

// функция для выхода из системы
const logout = () => {
	const logoutBtn = document.querySelector('.logout')

	logoutBtn.addEventListener('click', () => {
		authService.logout()
		location.href = location.href
	})
}

// если токена нет, значит не авторизирован и значит выводим ему кнопку войти
if (!token) {
	profile.innerHTML = `<a href="login.php" class="login">Войти</a>`
} else {
	// иначе выводим его никнейм и кнопку выйти, а если он админ, то кнопку для админ панели
	const user = await userService.getProfile()

	const html = `
	<div class="user">
		<div class="avatar">
			<img
				src="img/circle-user-round.svg"
				alt="user"
				class="avatar__img" />
		</div>
		<div class="name">${user.name}</div>
		${
			user.is_admin === 1
				? '<a href="admin.php" class="link">Админ панель</a>'
				: ''
		}
		<button class="logout">Выйти</button>
	</div>
	`

	profile.innerHTML = html
	logout()
}

const searchInput = document.querySelector('.search__input')
const searchList = document.querySelector('.search__list')

// функция для поиска записей и их дальнейшего вывода
const debounceSearch = debounce(async text => {
	// если человек стёр введенное, то нету смысла дергать сервер и идти дальше выполнять запрос на сервер, ведь в поле пусто и ничего так и так не выведится
	if (text === '') {
		searchList.innerHTML = ''
		return
	}

	const response = await searchService.search(text)

	if (response && response.length > 0) {
		searchList.style.display = 'flex'
		searchList.innerHTML = ''
		response.forEach((el, index) => {
			const item = `
			<a class="search__item" href="post.php?id=${el.id}">
				<div class="search__list-img"></div>
				<div class="search__content">
					<div class="search__title">
						${el.title}
					</div>
					<div class="search__text">
						${el.content.slice(0, 20) + '...'}
					</div>
				</div>
			</a>
			`
			searchList.innerHTML += item
			// если есть имадж, ставим эту картинку (она не будет полноразмерной и будем выглядеть не очень, но зато видно, что картинка есть)
			if (el.image !== null) {
				const image = document.querySelectorAll('.search__list-img')
				image[index].style.backgroundImage = `url('img/posts_img/${el.image}')`
			}
		})
	} else {
		// иначе если нету результатов, то просто скрываем поле с результатами
		searchList.style.display = 'none'
	}
})

// листенер для ввода чего-то в поле поиска
searchInput.addEventListener('input', e => debounceSearch(e.target.value))
