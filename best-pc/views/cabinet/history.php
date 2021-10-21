<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

             

           <h5>Інформація про замовлення</h5>
           
            
            <?php if($getOrders): ?>
            <table class="table-bordered table-striped table">
                <tr>
                    <th>Номер замовлення</th>
                    <th>Ім'я клієнта</th>
                    <th>Телефон клієнта</th>
                    <th>Дата замовлення</th>
                    <th>Коментар клієнта</th>
                    <th>Статус замовлення</th>
                </tr>
                  
                   <?php foreach ($getOrders as $order): ?>
                    <tr>
                        <td><?php echo $order['id']; ?> </td>
                        <td><?php echo $order['user_name']; ?></td>
                        <td><?php echo $order['user_phone']; ?></td>
                        <td><?php echo $order['date']; ?></td>
                        <td><?php echo $order['user_comment']; ?></td>   
                        <td><?php echo Order::getStatusText($order['status']); ?></td>   
                    </tr>
                    <?php endforeach; ?>
                    
            </table>
            <?php else: ?>
            <h3><p>Ви, ще нічого не замовляли!</p></h3>
                    <?php endif; ?>
  
            <a href="/cabinet/" class="btn btn-default back"><i class="fa fa-arrow-left"></i> Назад</a>
        </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>