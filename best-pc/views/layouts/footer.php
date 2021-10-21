    <div class="page-buffer"></div>
</div>

<footer><!--Footer-->
   <div class="container">
       <div class="row">
           <div class="col-sm-3">
               <h5>Інформація</h5>
               <ul class="list-unstyled">
                   <li><a href="/about" target="_blank">Про нас</a></li>
                   <li><a href="#" target="_blank">Політика безпеки</a></li>
                   <li><a href="#" target="_blank">Загальні положення</a></li>
               </ul>
           </div>
           
           <div class="col-sm-3">
               <h5>Служба підтримки</h5>
               <ul class="list-unstyled">
                   <li><a href="/contacts" target="_blank">Контакти</a></li>
                   <li><a href="#" target="_blank">Повернення товару</a></li>
                   <li><a href="#" target="_blank">Карта сайта</a></li>
               </ul>
           </div>
           
           <div class="col-sm-3">
               <h5>Додатково</h5>
               <ul class="list-unstyled">
                   <li><a href="#" target="_blank">Виробники</a></li>
                   <li><a href="#" target="_blank">Подарункові сертифікати</a></li>
                   <li><a href="#" target="_blank">Акції</a></li>
               </ul>
           </div>
           
           <div class="col-sm-3">
               <h5>Особистий кабінет</h5>
               <ul class="list-unstyled">
                   <li><a href="/cabinet" target="_blank">Особистий кабінет</a></li>
                   <li><a href="/cabinet/history" target="_blank">Історія замовлень</a></li>
                   <li><a href="#" target="_blank">Розсилка</a></li>
               </ul>
           </div>
           <hr class="footer_hr">
           <p class="pull-left">Інтернет магазин BEST PC © 2020</p>
           <p class="pull-right">Viktor Stashkiv</p>
       </div>
   </div>
</footer><!--/Footer-->

<script src="/template/js/jquery.js"></script>
<script src="/template/js/jquery.cycle2.min.js"></script>
<script src="/template/js/jquery.cycle2.carousel.min.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/jquery.scrollUp.min.js"></script>
<script src="/template/js/price-range.js"></script>
<script src="/template/js/jquery.prettyPhoto.js"></script>
<script src="/template/js/main.js"></script>
<script>
    $(document).ready(function(){
        $(".add-to-cart").click(function () {
            var id = $(this).attr("data-id");
            $.post("/cart/addAjax/"+id, {}, function (data) {
                $("#cart-count").html(data);
            });
            return false;
        });
    });
</script>

</body>
</html>