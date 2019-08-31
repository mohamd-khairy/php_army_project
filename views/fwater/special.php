


<style>
    input,th,td{
        text-align: center;
        font-weight: bold;
    }

</style>
<div id="show">
    <center>
        <button class="btn btn-success"  onclick="mido_get('?rt=fwater/zapt&active=special', '?rt=fwater/zapt')">إضافه مشتريات  خاصه</button>
        <br>
        <br>

        <table border="1"  class="table" style="width: 95%">
            <tr>
                <th style="background-color: #cccccc">التحكم</th>
                <th style="background-color: #cccccc">التاريخ</th>
                <th style="width: 3%; background-color: #cccccc" >#</th>

            </tr>

            <?php
            //error_reporting(0);
            $arr = [];
            $i = 1;
            $m = 0;
            $data = SpecialModel::getAllDataby_mon_current();
            foreach ($data as $dates) {
                $arr[$m] = $dates['spc_date'];
                $m++;
            }
            $all_date = array_unique($arr);
            foreach ($all_date as $d) {
                ?>
                <tr>
                    <td style="width: 20% "> <a onclick="show_spc(<?= strtotime($d) ?>)" class="btn btn-primary">تفاصيل الفاتوره</a></td>

                    <td><?= date("Y-m-d", strtotime($d)) ?></td>
                    <td >1</td>
                </tr>

            <?php } ?>
        </table>
    </center>
</div>

<div id="details" class="modalDialog">
    <div>
        <a href="#" type="button" id="c"  title="close" class="closee">X</a>
        <center>
            <div id="data"></div> 
        </center>
    </div>
</div>
<script>
    function show_spc(date) {
        $.post("?rt=fwater/show_spc", {date: date}, function (res) {
            $("#data").html(res);
            window.location.href = '#details';
        });
    }
    function delete_spc(id) {
        $.post('?rt=fwater/delete_spc', {id: id}, function (res) {
            mido_get('?rt=fwater/special&active=special', '?rt=fwater/special');
        });
    }
</script>
