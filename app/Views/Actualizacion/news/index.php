 <h2><?= esc($title) ?></h2>

<?php if (! empty($news) && is_array($news)): ?>
<a class="btn btn-primary" href="<?= base_url('/news/create') ?>">Crear item</a>
	
<div class="container-fluid">
    <table> 
        <thead>
            <tr>
                <th>Num.</th>
                <th>Titulo</th>
                <th>Noticia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($news as $news_item): ?>
		    <tr>
                <td><?= esc($news_item['id']) ?></td>
                <td><?= esc($news_item['title']) ?></td>
                <td><?= esc($news_item['body']) ?></td>
                <td>
                    <a class ="btn btn-primary" href="<?= url_to('News::updateShow', $news_item['id']) ?>">Editar</a>
                    <a class ="btn btn-primary" href="<?= url_to('News::delete',     $news_item['id']) ?>">Eliminar</a>
                </td>
            </tr>
	        <?php endforeach ?>
        </table>
</div>
<?php else: ?>


	<h3>No News</h3>

	<p>Unable to find any news for you.</p>
<?php endif ?>

