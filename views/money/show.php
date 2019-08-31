


<style>
    input,th,td,p{
        text-align: center;
        font-weight: bold;
    }

</style>
<div id="show">
    <center>
        <?php
        if (isset($_SESSION['mon_current']) && $_SESSION['mon_current'] != 0) {
            ?>
            <a class="btn btn-danger" href="#ask"   >تقفيل حسابات الشهر الحالي</a>
        <?php } ?>
        <div id="ask" class="modalDialog" >
            <div style="width: 50%">
                <a href="#" type="button" id="c"  title="closelogin" class="closee">X</a>
                <h1>سيتم اغلاق حسابات الشهر نهائيا ...</h1>
                <button class="btn btn-success" onclick="money()" style="width: 15%">موافق</button>
                <a class="btn btn-danger" href="#" style="width: 15%">انتظر</a>

            </div>
        </div>
        <br><br> 
        <div >
            <table id="" class="table"   style="width: 30%;background-color: #444">
                <td >   
                    <?php
                    $mon = MonthModel::getAllData();
                    if (count($mon) == 1) {
                        ?>
                        <select  class="form-control" id="spc_mon" onblur="special_mon()">
                        <?php } else {
                            ?>
                            <select  class="form-control" id="spc_mon" onchange="special_mon()">
                                <?php
                            }
                            foreach ($mon as $m) {
                                if ($_SESSION['last_mon_current'] == $m['mon_current']) {
                                    ?>
                                    <option selected><?= $m['mon_current'] ?></option>  
                                <?php } else { ?>
                                    <option ><?= $m['mon_current'] ?></option>  
                                    <?php
                                }
                            }
                            ?>
                        </select>
                </td>
                <td><h4 style="color: white;">  اختر شهر </h4></td>
            </table>
        </div>

        <table border="1"  class="table" style="width: 95%">
            <tr>
                <th colspan="2" style="background-color: #ff9900">عليه</th>
                <th colspan="2" style="background-color: #ff9900">لــه</th>
            </tr>

            <?php
            error_reporting(0);
            if (isset($_SESSION['last_mon_current'])) {
                $sum = 0;
                $data_to = ToModel::getAllDataby_special_mon_current($_SESSION['last_mon_current']);
                $data_from = FromModel::getAllDataby_special_mon_current($_SESSION['last_mon_current']);
                $sum_to = ToModel::get_special_mon_current_sum($_SESSION['last_mon_current']);
                $sum_from = FromModel::get_special_mon_current_sum($_SESSION['last_mon_current']);
                $from_sum = $sum_from['from_goods'] + $sum_from['from_fwater'] + $sum_from['from_other'];
                $to_sum = $sum_to['to_goods'] + $sum_to['to_special'] + $sum_to['to_nsryat'] + $sum_to['to_ms7obat'] + $sum_to['to_other'];
                $to = $data_to[0];
                $from = $data_from[0];
            }
            ?>
            <tr>
                <td><?= $from['from_goods'] ?></td>
                <td style="width: 10%;background-color: #cccccc">البضاعه المرحله من السابق</td>
                <td><?= $to['to_goods'] ?></td>
                <td style="width: 10%;background-color: #cccccc">بضاعه مرحله من الحالي</td>
            </tr>

            <tr>
                <td><?= $from['from_fwater'] ?></td>
                <td style="width: 10%;background-color: #cccccc">فواتير رباش</td>
                <td><?= $to['to_nsryat'] ?></td>
                <td style="width: 10%;background-color: #cccccc">نثريات</td>
            </tr>


            <tr>
                <td></td>
                <td ></td>
                <td><?= number_format($to['to_ms7obat'], 2) ?></td>
                <td style="width: 10%;background-color: #cccccc">سحب الضباط </td>
            </tr>
            <tr>
                <td></td>
                <td ></td>
                <td><?= $to['to_special'] ?></td>
                <td style="width: 10%;background-color: #cccccc">مشتريات خاصه</td>

            </tr>
            <tr>
                <td><?= $from['from_other'] ?></td>
                <th><a class="btn btn-primary"  href="#other_from" style="width: 100%">اضافات اخري</a></th>
                <td><?= $to['to_other'] ?></td>
                <th><a class="btn btn-primary" href="#other" style="width: 100%">اضافات اخري</a></th>
            </tr>
            <tr>
                <td style="background-color: #cccccc"><?= $from_sum; ?></td>
                <th colspan="1" style="background-color: #ff9900">المجموع</th>
                <td style="background-color: #cccccc"><?= $to_sum; ?></td>
                <th colspan="1" style="background-color: #ff9900">المجموع</th>
            </tr>

            </tr>
        </table>
        <?php
        if ($from_sum > $to_sum) {
            $agz = $from_sum - $to_sum;
        } else {
            $agz = "لا يوجد";
        }
        ?>
        <h1 style="font-weight: bold;color: #ff0000"> العجــز  : <?= $agz ?>   
            <?php
            if (is_numeric($agz)) {
                $as = MonthModel::getAllDataby_special_mon_current($_SESSION['last_mon_current']);
                echo "  >>> " . $as[0]['mon_askry'];
            }
            ?>
        </h1> 
        <br>
        <a class="btn btn-success" href="#zpat" onclick="ms7_money(<?= $_SESSION['last_mon_current'] ?>)"  >حـسـابات الضبـاط</a>

    </center>
</div>


<div id="zpat" class="modalDialog" >
    <div >
        <a href="#" type="button" id="c"  title="close" class="closee">X</a>
        <center>
            <table border="1"  class="table" style="width: 95%">
                <tr>
                    <?php
                    $data_z = ZpatModel::getAllData();
                    foreach ($data_z as $zpat) {
                        ?>
                        <th style="background-color: #ff9900"> <?= $zpat['z_name'] ?></th>
                    <?php } ?> 
                    <th style="background-color: #cccccc;width: 9% ">التاريخ</th>
                    <th style="width: 1%; background-color: #cccccc;" >#</th>
                </tr>
                <?php
                $arr = [];
                $i = 1;
                $m = 0;
                $data = Ms7obatModel::getAllDataby_special_mon_current($_SESSION['last_mon_current']); //get_All_date_by_mon_current();
                foreach ($data as $dates) {
                    $arr[$m] = $dates['ms7_date'];
                    $m++;
                }
                $all_date = array_unique($arr);

                foreach ($all_date as $d) {
                    ?>
                    <tr>
                        <?php
                        $data_z = ZpatModel::getAllData();
                        foreach ($data_z as $zpat) {
                            $zpats = Ms7obatModel::get_All_data_by_special_mon_current_and_date($d, $zpat['z_name'], $_SESSION['last_mon_current']);
                            if (empty($zpats)) {
                                ?>
                                <td>-</td>
                            <?php } else {
                                ?>
                                <td><?= $zpats[0]['ms7_cost'] ?></td>
                                <?php
                            }
                        }
                        ?> 
                        <td ><?= date("Y-m-d", strtotime($d)) ?></td>
                        <td ><?= $i++ ?></td>
                    </tr>
                <?php }
                ?>
                <tr>
                    <?php
                    $data_z = ZpatModel::getAllData();
                    $days = 0;
                    foreach ($data_z as $zpat) {
                        $zpats = Ms7obatModel::get_All_date_by_special_mon_current_and_any_colm('z_name', $zpat['z_name'], $_SESSION['last_mon_current']);
                        if (empty($zpats)) {
                            ?>
                            <td style="background-color: #cccccc">-</td>
                        <?php } else {
                            ?>
                            <td style="background-color: #cccccc"><?= $zpats[0]['count'] ?></td>
                            <?php
                            $days+=$zpats[0]['count'];
                        }
                    }
                    ?> 
                    <td ><?= $days ?></td>
                    <th style="background-color: #ff9900">  عدد الايام</th>
                </tr>
                <tr>
                    <?php
                    $data_z = ZpatModel::getAllData();
                    foreach ($data_z as $zpat) {
                        $zpats = Ms7obatModel::get_All_date_by_special_mon_current_and_any_colm('z_name', $zpat['z_name'], $_SESSION['last_mon_current']);
                        if (empty($zpats)) {
                            ?>
                            <td style="background-color: #cccccc"> - </td>
                        <?php } else {
                            ?>
                            <td style="background-color: #cccccc"><?= number_format($zpats[0]['sum'], 2) ?></td>
                            <?php
                        }
                    }
                    ?> 
                    <td ></td>
                    <th style="background-color: #ff9900">  المسحوبات </th>
                </tr>
                <tr>
                    <?php
                    $data_z = ZpatModel::getAllData();
                    foreach ($data_z as $zpat) {
                        $zpats = Ms7obatModel::get_All_date_by_special_mon_current_and_any_colm('z_name', $zpat['z_name'], $_SESSION['last_mon_current']);
                        if (empty($zpats)) {
                            ?>
                            <td style="background-color: #cccccc"> - </td>
                            <?php
                        } else {
                            $spc1 = SpecialModel::get_order_by_spc_mon_sum($_SESSION['last_mon_current'], $zpat['z_name']);
                            ?>
                            <td style="background-color: #cccccc"><?= number_format($spc1[0]['sum'], 2) ?></td>
                            <?php
                        }
                    }
                    ?> 
                    <td ></td>
                    <th style="background-color: #ff9900">   المشتروات الخاصه</th>
                </tr>
                <tr>
                    <?php
                    $one_nsr = ($to['to_nsryat'] / $days);
                    $data_z = ZpatModel::getAllData();
                    foreach ($data_z as $zpat) {
                        $zpats = Ms7obatModel::get_All_date_by_special_mon_current_and_any_colm('z_name', $zpat['z_name'], $_SESSION['last_mon_current']);
                        if (empty($zpats)) {
                            ?>
                            <td style="background-color: #cccccc"> - </td>
                        <?php } else {
                            ?>
                            <td style="background-color: #cccccc"><?= number_format(($one_nsr * $zpats[0]['count']), 2) ?></td>
                            <?php
                        }
                    }
                    ?> 
                    <td ></td>
                    <th style="background-color: #ff9900">النثريات</th>
                </tr>
                <tr>
                    <?php
                    $data_z = ZpatModel::getAllData();



                    foreach ($data_z as $zpat) {
                        $zpats = Ms7obatModel::get_All_date_by_special_mon_current_and_any_colm('z_name', $zpat['z_name'], $_SESSION['last_mon_current']);
                        $spc = SpecialModel::get_order_by_spc_mon_sum($_SESSION['last_mon_current'], $zpat['z_name']);
                        if (empty($zpats)) {
                            ?>
                            <td style="background-color: black; color: white"> - </td>
                        <?php } else {
                            ?>
                            <td style="background-color: black;color: white"><?= number_format($spc[0]['sum'] + $zpats[0]['sum'] + ($one_nsr * $zpats[0]['count']), 2) ?></td>
                            <?php
                        }
                    }
                    ?> 
                    <td ></td>
                    <th style="background-color: black; color: white">  اجمالي المسحوبات</th>
                </tr>
            </table>
        </center>
    </div>
</div>

<div id="other" class="modalDialog" >
    <div style="width: 50%">
        <a href="#" type="button" id="c"  title="close" class="closee">X</a>              
        <input type="number" id="to_other" class="form-control"  placeholder="  ادخل  المبلغ المطلوب اضافته ...">
        <input type="hidden" id="to_id" value="<?= $to['to_id'] ?>">
        <a class="btn btn-primary" onclick="other_to()"  style="width: 100%"> اضــف</a>

    </div>
</div>
<div id="other_from" class="modalDialog" >
    <div style="width: 50%">
        <a href="#" type="button" id="c"  title="close" class="closee">X</a>              
        <input type="number" id="from_other" class="form-control"  placeholder="  ادخل  المبلغ المطلوب اضافته ...">
        <input type="hidden" id="from_id" value="<?= $from['from_id'] ?>">
        <a class="btn btn-primary" onclick="other_from()"  style="width: 100%"> اضــف</a>

    </div>
</div>
<script>

    function special_mon() {
        var spc_mon = $("#spc_mon").val();
        $.post("?rt=money/special_mon", {spc_mon: spc_mon}, function (res) {
            mido_get('?rt=money/show&active=money', '?rt=money/show');
        });
    }
    function money() {
        $.post("?rt=money/calc", function (res) {
            mido_get('?rt=money/show&active=money', '?rt=money/show');
        });
    }
    function other_to() {
        var to_id = $("#to_id").val();
        var to_other = $("#to_other").val();
        $.post("?rt=money/other_to", {to_id: to_id, to_other: to_other}, function (res) {
            if (res == 'yes') {
                mido_get('?rt=money/show&active=money', '?rt=money/show');
            }
        });
    }
    function other_from() {
        var from_id = $("#from_id").val();
        var from_other = $("#from_other").val();
        $.post("?rt=money/other_from", {from_id: from_id, from_other: from_other}, function (res) {
            if (res == 'yes') {
                mido_get('?rt=money/show&active=money', '?rt=money/show');
            }
        });
    }

</script>