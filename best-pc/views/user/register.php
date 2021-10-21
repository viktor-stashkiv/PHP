<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                
                <?php if ($result): ?>
                    <p>Ви зареєстровані!</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Реєстрація на сайті</h2>
                        <form action="#" method="post">
                            <input type="text" name="name" placeholder="Введіть своє і'мя" value="<?php echo $name; ?>"/>
                            <input type="email" name="email" placeholder="Введіть пошту" value="<?php echo $email; ?>"/>
                            <input type="password" name="password" placeholder="Придумайте пароль" value="<?php echo $password; ?>"/>
                            <input type="submit" name="submit" class="btn btn-default" value="Зареєструватися" />
                        </form>
                        
                        <h4>Вже реєструвалися? <u><a href="/user/login">Увійти</a></u></h4>
                    </div><!--/sign up form-->
                
                <?php endif; ?>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>