<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                
                <?php if ($result): ?>
                    <p>Дані відредаговані!</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Редагування даних</h2>
                        <form action="#" method="post">
                            <p>І'мя:</p>
                            <input type="text" name="name" placeholder="І'мя" value="<?php echo $name; ?>"/>
                            
                            <p>Пароль:</p>
                            <input type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/>
                            <br/>
                            <input type="submit" name="submit" class="btn btn-default" value="Зберігти" />
                        </form>
                    </div><!--/sign up form-->
                
                <?php endif; ?>
                
                <a href="/cabinet/" class="btn btn-default back"><i class="fa fa-arrow-left"></i> Назад</a>
            </div>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>