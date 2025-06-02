<?php
require_once '../db.php';
require_once '../../services/auth.service.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // получаем айди юзера при помощи декодирования токена, который находится в заголовке Authorization
  $id = getUserId();

  // если в массиве $_POST есть нам нужная инфа, то идём дальше
  if (isset($_POST['title']) && isset($_POST['content'])) {

    // чистим от лишнего при помощи моей функции fix_string
    $title = fix_string($conn, $_POST['title']);
    $content = fix_string($conn, $_POST['content']);

    // если что-то пусто - возвращаем ошибку на клиет
    if ($title === '' || $content === '') message('error', 'Some fields is not fullish');

    $filename = '';

    // если передали image (просто он не обязателен, поэтому его могут не передать)
    if (isset($_FILES['image'])) {
      // забираем имя файла, а так же временное разположение
      $name = $_FILES['image']['name'];
      $tmp = $_FILES['image']['tmp_name'];

      // делим по точке имя файла
      $name_array = explode('.', $name);

      // получаем расширение файла
      $ext = $name_array[1];

      $exts = ['jpg', 'png', 'webp', 'jpeg'];

      // если расширение не jpg, png, webp или jpeg, то возращаем ошибку
      if (!in_array($ext, $exts)) message('error', 'Invalid format. App allowed jpg, png, jpeg, webp');

      // сканируем директорию с имаджами, чтобы в будущем создать уникальное имя для новой фотографии
      $uploads = scandir(__DIR__ . '/../../../frontend/img/posts_img');

      // вот как раз создаем уникальное имя для новой фотографии (вычитаем единицу, потому что изначально scandir возвращает что-то по типу этого - ['.', '../'] и поэтому даже если папка была пуста - там есть 2 элемента и count вернет 2. Так как нам нужно создать новый уникальный айди, который должен быть больше прошлого на единицу, мы вычитаем только ОДИН)
      $new_id = count($uploads) - 1;

      // собираем новое имя + расширение
      $filename = $new_id . '.' . $ext;

      // закидываем в папку со всеми posts фотографиями
      move_uploaded_file($tmp, __DIR__ . '/../../../frontend/img/posts_img/' . $filename);
    }

    // если переменная filename так и осталась пустой (то есть её не меняли => фотографию к посту не добавляли), то назначаем её как null, чтобы записать в бд именно null, а не пустую строчку
    $filename = $filename === '' ? null : $filename;

    $stmt = $conn->prepare('INSERT INTO posts (title, content, image, owner) VALUES (?, ?, ?, ?)');

    $stmt->bind_param('ssss', $title, $content, $filename, $id);

    if ($stmt->execute()) {
      // если всё удачно создалось - возращаем успешный статус
      message('success', 'Post was created');
    } else {
      // иначе возвращаем ошибку
      echo message('error', 'Post is not created');
    }

    $stmt->close();
    $conn->close();
  }
} else {
  message('error', 'This is not a POST request');
}
