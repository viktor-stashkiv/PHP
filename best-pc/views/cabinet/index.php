<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <?php if($user['role'] == 'admin'): ?>
            <h3>Кабінет адміністратора</h3>
            <?php else: ?> 
            <h3>Кабінет користувача</h3>
            <?php endif; ?>
            <h4>Привіт, <?php echo $user['name'];?>!</h4>
            <ul>
                <li><a href="/cabinet/edit">Змінити ім'я або пароль</a></li>
                
                <li><a href="/cabinet/history">Історія замовлень</a></li> 
               
                <?php if($user['role'] == 'admin'): ?>
                <li><a href="/admin">Адмінпанель</a></li 
                <?php endif; ?>
            </ul>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>