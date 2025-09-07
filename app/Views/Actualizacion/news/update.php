
<!-- Contenido -->
<h2><?=esc($title)?></h2>
<form method="post" action="<?= url_to('News::updateEdit') ?>">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= $news['id'] ?>">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" value="<?= $news['title'] ?>">
    </div>
    <div>
        <label for="body">Texto</label>
        <input name="body" value="<?= $news['body'] ?>">
    </div>
    <div>
        <input type="submit" name="submit" value="Guardar">
    </div>
</form>
<div>
    <?= validation_list_errors() ?>
</div>
<!-- /Contenido -->
