<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">

                <?php if ($result): ?>
                    <p>Повідомлення відправлено! Ми відповімо Вам на вказаний email.</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form">
                        <h2>Зворотній зв'язок</h2>
                        <h5>Є питання? Напишіть нам</h5>
                        <br/>
                        <form action="#" method="post">
                            <p>E-mail:</p>
                            <input type="email" name="userEmail" placeholder="Введіть ваш e-mail..." value="<?php echo $userEmail; ?>"/>
                            <p>Текст повідомлення:</p>
                            <textarea name="userText" cols="20" rows="9"></textarea>
                            <br/><br/>
                            <input type="submit" name="submit" class="btn btn-default" value="Відправати" />
                        </form>
                    </div><!--/sign up form-->
                <?php endif; ?>


                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>