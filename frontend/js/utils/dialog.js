// скрипт для открытия диалоговых окон при добавлении поста из админки/главной страницы

// диалоговое окно - <dialog></dialog> tag
const dialog = document.querySelector('.dialog')
// кнопка "Добавить пост"
const addButton = document.getElementById('add-button')

if (addButton) {
	addButton.addEventListener('click', () => {
		// показываем модалку
		dialog.showModal()
		// добавляем класс к body с overflow: hidden, чтобы при открытии нельзя было скроллить страницу
		document.body.classList.add('lock')
	})

	// слушатель для закрытия модалки при клике на любое другое место, кроме самой модалки
	dialog.addEventListener('click', e => {
		// получаем родителя диалога, то есть задний фон, по которому обычно кликают для закрытия
		const dialog_current = e.currentTarget
		// если наш клик === заднему фону, то true
		const isClickOnBackdrop = e.target === dialog_current

		// если true - закрываем
		if (isClickOnBackdrop) {
			dialog.close()
		}
	})

	// слушаем закрытие модалки и при закрытии убираем overflow: hidden с body тега
	dialog.addEventListener('close', () => {
		document.body.classList.remove('lock')
	})
}
