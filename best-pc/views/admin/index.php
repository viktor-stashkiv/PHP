<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            
            <br/>
            
            <h4>Добрий день, адміністратор!</h4>
            
            <br/>
            
            <p>Вам доступні такі можливості:</p>
            
            <br/>
            
            <ul>
                <li><a href="/admin/product">Управління товарами</a></li>
                <li><a href="/admin/category">Управління категоріями</a></li>
                <li><a href="/admin/order">Управління замовленнями</a></li>
            </ul>
            <a href="/cabinet/" class="btn btn-default back"><i class="fa fa-arrow-left"></i> Назад</a>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

