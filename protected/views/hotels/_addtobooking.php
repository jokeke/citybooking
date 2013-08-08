</br>
</br>
<div style="border: solid 1px #000000" class="booking-item">
    <input hidden name="room_id<?= $i ?>" type="text" value="<?= $room['id'] ?>">
    <h3><?= $room['category'] ?></h3>
    Колличество взрослых:
    <input name="man_num<?= $i ?>" type="text"></br>
    Колличество детей:
    <input name="kid_num<?= $i ?>" type="text"></br>
    Дата заезда:
    <input name="date_checkin<?= $i ?>" type="text"></br>
    Дата отъезда:
    <input name="date_checkout<?= $i ?>" type="text"></br>
    Время заезда:
    <input name="time_checkin<?= $i ?>" type="text"></br>
    Время отъезда:
    <input name="time_checkout<?= $i ?>" type="text"></br>
    <input type="radio" name="bed_type<?= $i ?>" value="Двухстпальная кровать" checked > Двухстпальная кровать<Br>
    <input type="radio" name="bed_type<?= $i ?>" value="Раздельные кровати"> Раздельные кровати<Br>
    <input type="checkbox" name="smoke<?= $i ?>" value="1">Номер для курящих<br>
    Оплата:</br>
    <input type="radio" class="pay-type" price="<?= $room['price'] ?>" name="pay_type<?= $i ?>" value="По предоплате" checked > По предоплате <br>
    <input type="radio" class="pay-type" price="<?= $room['price']*1.6 ?>" name="pay_type<?= $i ?>" value="Оплата в отеле"> Оплата в отеле<br>
    Гости:<br>
    Фамилия: <input name="guest_surname<?= $i ?>[]" type="text"> Имя: <input name="guest_firstname<?= $i ?>[]" type="text"> Отчество: <input name="guest_familyname<?= $i ?>[]" type="text"><br>
    Фамилия: <input name="guest_surname<?= $i ?>[]" type="text"> Имя: <input name="guest_firstname<?= $i ?>[]" type="text"> Отчество: <input name="guest_familyname<?= $i ?>[]" type="text"><br>
    <div class="booking-price">Итоговая цена: <span><?= $room['price'] ?></span> руб</div>
    <input  class="booking-price" name="room_price<?= $i ?>" value="<?= $room['price'] ?>" type="text">
</div>
</br>
</br>