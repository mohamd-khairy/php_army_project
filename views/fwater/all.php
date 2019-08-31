


<style>
    input,th,td{
        text-align: center;
        font-weight: bold;
    }

</style>
<div id="show">
    <center>
        <button class="btn btn-success"  onclick="mido_get('?rt=fwater/show&active=fwater', '?rt=fwater/show')">إضافه فاتوره جديده</button>
        <br>
        <br>

        <table border="1"  class="table" style="width: 95%">
            <tr>
                <th style="background-color: #cccccc">التحكم</th>
                <th style="background-color: #ff9900">  المستلم</th>
                <th style="background-color: #cccccc">التاريخ</th>
                <th style="width: 3%; background-color: #cccccc" >#</th>
            </tr>

            <?php
            $data = FwaterModel::getAllDataby_mon_current();
            $i = 1;
            foreach ($data as $fw) {
                ?>
                <tr>
                    <td style="width: 10% "> 
                        <a href="#" onclick="show_det(<?= $fw['fw_id'] ?>)" class="btn btn-primary">تفاصيل الفاتوره</a>
                        <a  onclick="add_id(<?= $fw['fw_id'] ?>)"  class="btn btn-success"> اضف صنف للفاتوره</a></td>
                    <td style="width: 20% "><?= $fw['fw_askry'] ?></td>
                    <td style="width: 15% "><?= date("Y-m-d", strtotime($fw['fw_date'])) ?></td>
                    <td ><?= $i++ ?></td>
                </tr>
            <?php } ?>

        </table>
    </center>
</div>

<div id="detailss" class="modalDialog">
    <div>
        <a href="#" type="button" id="c"  title="close" class="closee">X</a>
        <center>
            <div id="dataa"></div> 
        </center>
    </div>
</div>


<div id="goods" class="modalDialog">
    <div>
        <a href="#" type="button"  title="close" class="closee">X</a>
        <input type="hidden" id="fw_id" >
        <span class=" help-block alert alert-success" id="res_c" style="text-align: center;display: none;color:#006600"> تم اضافه البيانات بنجاح ... ! </span>

        <div class="form-group has-feedback" style="margin-left: 25%; margin-right: 15%">
            <label class="control-label pull-right"> النوع </label>
            <input type="text" id="det_type" class="form-control"  placeholder="اكتب  اسم المنتج ...">
        </div>
        <div class="form-group has-feedback" style="margin-left: 25%; margin-right: 15%">
            <label class="control-label pull-right"> العدد </label>
            <input type="number" id="det_count" class="form-control"  placeholder="اكتب الكميه ...">
        </div>

        <div class="form-group has-feedback" style="margin-left: 25%; margin-right: 15%">
            <label class="control-label pull-right">  المبلغ </label>
            <input type="number" id="det_cost" class="form-control"  placeholder="اكتب المبلغ ...">
        </div>

        <button type="button" onclick="add_det()" style="margin-left: 45%;" class="btn btn-primary  col-sm-2 " >حــفظ</button>
        <div  style="margin-bottom:5%;">
        </div>
    </div>
</div>

<script>
    function show_det(id) {
        $.post("?rt=fwater/show_det", {id: id}, function (res) {
            $("#dataa").html(res);
            window.location.href = '#detailss';
        });
    }

    function delete_det(det_id) {
        $.post('?rt=fwater/delete_det', {id: det_id}, function (res) {
            mido_get('?rt=fwater/all&active=fwater', '?rt=fwater/all');
        });
    }
    function add_id(id) {
        window.location.href = '#goods';
        $("#fw_id").val(id);

    }
    function add_det() {
        var fw_id = $("#fw_id").val();
        var det_type = $("#det_type").val();
        var det_count = $("#det_count").val();
        var det_cost = $("#det_cost").val();
        $.post("?rt=fwater/add_det", {fw_id: fw_id, det_type: det_type, det_count: det_count, det_cost: det_cost}, function (res) {
            if (res == 'yes') {
                $("#fw_id").val("");
                $("#det_type").val("");
                $("#det_count").val("");
                $("#det_cost").val("");
                $("#res_c").show();
                setTimeout(function () {
                    $('#res_c').fadeOut('fast');
                }, 2000);
            }
        });
    }
</script>