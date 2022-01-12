<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Адмінпанель</a></li>
                    <li class="active">Управління товарами</li>
                </ol>
            </div>

            <a href="/admin/product/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавити товар</a>
            
            <h4>Список товарів</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID товара</th>
                    <th>Артикул</th>
                    <th>Назва товара</th>
                    <th>Ціна</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($productsList as $product): ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['code']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['price']; ?></td>  
                        <td><a href="/admin/product/update/<?php echo $product['id']; ?>" title="Редагувати"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/product/delete/<?php echo $product['id']; ?>" title="Видалити"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
<a href="/admin/" class="btn btn-default back"><i class="fa fa-arrow-left"></i> Назад</a>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

