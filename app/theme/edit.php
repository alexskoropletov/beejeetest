[errors]
<form action="/add" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Пользователь</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Имя пользователя">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="description">Описание</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <div class="form-group">
        <label for="image">Изображение</label>
        <input type="file" id="image">
        <p class="help-block">Файл в формате JPG/PNG/GIF. Изображение с габаритами больше 320 х 240 будет автоматически уменьшено.</p>
    </div>
    <button type="submit" name="add" value="1" class="btn btn-default">Добавить</button>
</form>

