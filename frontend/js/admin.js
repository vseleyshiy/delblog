import { adminService } from './services/admin.service.js'
import { getToken } from './services/jwt.service.js'
import { postService } from './services/post.service.js'
import { userService } from './services/user.service.js'

const token = getToken()
// токена нет - значит не авторизован - значит на странице логина кидаем
if (!token) location.href = 'login.php'

const user = userService.getProfile()

// получаем юзера, и если он не админ, то ему нечего делать в админке
// а вообще админку надо прятать, выдавать 404 страницу если юзер не админ, потому что теперь ясно, что админ панель находится по url admin.php, потому что нас кидает не на 404 not found, а на главную страницу. Но я не знаю, как реализовать 404 page на html вместе с js
if (user.is_admin === 0) location.href = 'index.php'

const cols = document.querySelectorAll('.admin__col-item > span')

cols.forEach(el => (el.innerText = 'Загрузка...'))

// устанавливаем инфу для админ панели
const setInfo = async () => {
	const info = await adminService.getInfo()

	cols[0].innerText = info.all_posts_count
	cols[1].innerText = info.today_posts_count
}

// добавляем кнопки для удаления постов
const delList = document.querySelector('.admin__col-list.delete-list')

const getPostsForDel = async () => {
	const response = await postService.getPosts()

	response.forEach(el => {
		const button = document.createElement('button')
		button.className = 'admin__col-button'
		button.innerHTML = `
		<div class="delete">
			<img class="delete__img" src="img/trash.svg" alt="delete post" />
		</div>
		${el.title}
		`

		// при нажатии на кнопку запрос на сервер с удалением по айди
		button.addEventListener('click', async () => {
			const response = await postService.deletePost(el.id)

			if (response.status === 'success') {
				// если удаление прошло успешно, обновляем страницу.
				location.href = location.href
			}
		})

		delList.append(button)
	})
}

// при загрузке страницы устанавливаем в поля значения и создаем кнопки с функционалом удаления
document.addEventListener('DOMContentLoaded', () => {
	setInfo()
	getPostsForDel()
})
