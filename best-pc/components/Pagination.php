<?php

/*
 * Клас Pagination для генерації посторінковою навігації
 */

class Pagination
{
    // @var Посилань навігації на сторінку
    private $max = 10;
    // @var Ключ для GET, в який пишеться номер сторінки
    private $index = 'page';
    // @var Поточна сторінка
    private $current_page;
    // @var Загальна кількість записів
    private $total;
    // @var Записів на сторінку
    private $limit;

    /**
     * Запуск необхідних даних для навігації
      * @Param type $total Загальна кількість записів 
      * @Param type $currentPage Номер поточної сторінки 
      * @Param type $limit Кількість записів на сторінку 
      * @Param type $index Ключ для url 
     */
    public function __construct($total, $currentPage, $limit, $index)
    {
        # Встановлюємо загальна кількість записів
        $this->total = $total;

        # Встановлюємо кількість записів на сторінку
        $this->limit = $limit;

        # Встановлюємо Кількість запісів на сторінку
        $this->index = $index;

        # Встановлюємо кількість сторінок
        $this->amount = $this->amount();
        
        # Встановлюємо номер поточної сторінки
        $this->setCurrentPage($currentPage);
    }

    /**
     *  Для виведення посилань
      * @Return HTML-код з посиланнями навігації
      */
    public function get()
    {
        # Для запису посилань
        $links = null;

        # Отримуємо обмеження для циклу
        $limits = $this->limits();
        
        $html = '<ul class="pagination">';
        # генеруємо посилання
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            # Якщо поточна це поточна сторінка, посилання немає і додається клас active
            if ($page == $this->current_page) {
                $links .= '<li class="active"><a href="#">' . $page . '</a></li>';
            } else {
                # Інакше генеруємо посилання
                $links .= $this->generateHtml($page);
            }
        }

        # Якщо посилання створилися
        if (!is_null($links)) {
            # Якщо поточна сторінка не перша
            if ($this->current_page > 1)
            # Створюємо посилання "На першу"
                $links = $this->generateHtml(1, '&lt;') . $links;

            # Якщо поточна сторінка не перша
            if ($this->current_page < $this->amount)
            # Створюємо посилання "На останню"
                $links .= $this->generateHtml($this->amount, '&gt;');
        }

        $html .= $links . '</ul>';

        # повертаємо html
        return $html;
    }

    /**
     * Для генерації HTML-коду посилання
      * @Param integer $page - номер сторінки
      *
      * @return
      */
    private function generateHtml($page, $text = null)
    {
        # Якщо текст посилання не вказано
        if (!$text)
        # Зазначаємо, що текст - цифра сторінки
            $text = $page;

        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);
        # Формуємо HTML код посилання і повертаємо
        return
                '<li><a href="' . $currentURI . $this->index . $page . '">' . $text . '</a></li>';
    }

    /**
     *  Для отримання, звідки стартувати
      *
      * @Return масив з початком і кінцем відліку
     */
    private function limits()
    {
        # Обчислюємо посилання зліва (щоб активне посилання булo посередині)
        $left = $this->current_page - round($this->max / 2);
        
        # Обчислюємо початок відліку
        $start = $left > 0 ? $left : 1;

        # Якщо попереду є як мінімум $this-> max сторінок
        if ($start + $this->max <= $this->amount) {
        # Призначаємо кінець циклу уперед на $ this-> max сторінок або просто на мінімум
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            # Кінець - загальна кількість сторінок
            $end = $this->amount;

            # Початок - мінус $ this-> max від кінця
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }

        # Повертаємо
        return
                array($start, $end);
    }

    /**
     * Для установки поточної сторінки
     * 
     * @return
     */
    private function setCurrentPage($currentPage)
    {
        # Отримуємо номер сторінки
        $this->current_page = $currentPage;

        # Якщо поточна сторінка більше нуля
        if ($this->current_page > 0) {
            # Якщо поточна сторінка менше загальної кількості сторінок
            if ($this->current_page > $this->amount)
            # Встановлюємо сторінку на останню
                $this->current_page = $this->amount;
        } else
        # Встановлюємо сторінку на першу
            $this->current_page = 1;
    }

    /**
     * Для отримання загальної кількості сторінок
     * 
     * @return число сторінок
     */
    private function amount()
    {
        # Ділимо і повертаємо
        return ceil($this->total / $this->limit);
    }

}
