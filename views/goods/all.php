
<center ><h1> البضاعه المرحله من الشهر الحالي</h1></center>


<style>
    input,th,td{
        text-align: center;
        font-weight: bold;
    }

</style>
<div id="show">
    <center>
        <button class="btn btn-success"  onclick="mido_get('?rt=goods/show&active=goods', '?rt=goods/show')">إضافه البضاعه المرحله  الجديده</button>
        <br>
        <br>

        <table border="1"  class="table" style="width: 95%">
            <tr>
                <th style="background-color: #cccccc">التحكم</th>
                <th style="background-color: #cccccc">التاريخ</th>
                <th style="background-color: #cccccc">المبلغ </th>
                <th style="background-color: #cccccc">العدد </th>
                <th style="background-color: #ff9900"> النوع </th>

                <th style="width: 3%; background-color: #cccccc" >#</th>

            </tr>

            <?php
            $sum = GoodsModel::get_order_sum('go_cost');
            $data = GoodsModel::getAllDataby_mon_current();
            $i = 1;
            foreach ($data as $go) {
                ?>
                <tr>
                    <td style="width: 15% ">
                        <a onclick="delete_go(<?= $go['go_id'] ?>)" class="btn btn-danger">حذف</a>
                        <a onclick="edit_go(<?= $go['go_id'] ?>)" class="btn btn-success">تعديل</a>
                    </td>
                    <td style="width: 15% "><?= date("Y-m-d", strtotime($go['go_date'])) ?></td>
                    <td ><?= $go['go_cost'] ?></td>
                    <td><?= $go['go_count'] ?></td>
                    <td style="width: 20% "><?= $go['go_type'] ?></td>
                    <td ><?= $i++ ?></td>
                </tr>
            <?php } ?>

              <tr>
                <td ></td>
                <td></td>
                <td style="background-color: #cccccc"><?= $sum['sum'] ?></td>
                <td ></td>
                <td ></td>
                <th style="background-color: #ff9900">  اجمالي النثريات</th>
            </tr>
        </table>
    </center>
</div>




<div id="edit" class="modalDialog">
    <div style="width: 40%">
        <a href="#" type="button" title="close" class="closee">X</a>
        <span class=" help-block alert alert-danger" id="res_f" style="text-align: center;display: none;color:#c9302c">لم يتم تعديل البيانات ... ! </span>
        <span class=" help-block alert alert-success" id="res_c" style="text-align: center;display: none;color:#006600"> تم تعديل البيانات بنجاح ... ! </span>
        <input type="hidden"   id="go_id"  class="form-control"  >
        <input type="hidden"   id="mon_current"  class="form-control"  >

        <div class="form-group has-feedback" style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right"> النوع </label>
            <input type="text"   id="go_type" class="form-control"  placeholder="اكتب نوع النثريه ...">
        </div>

        <div class="form-group has-feedback" style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right">  العدد  </label>
            <input type="number"   id="go_count" class="form-control"  placeholder="  ادخل الكميه ...">
        </div>

        <div class="form-group has-feedback" style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right">  المبلغ  </label>
            <input type="number"   id="go_cost" class="form-control"  placeholder="  ادخل  المبلغ ...">
        </div>
        <div class="form-group has-feedback" style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right">  التاريخ  </label>
            <input  type="date"   id="go_date" class="form-control">
        </div>
        <br>
        <div>
            <button class="btn btn-success center-block" onclick="update_go()">تعديل</button>
        </div>
    </div>
</div>

<script>
    function delete_go(id) {
        $.post('?rt=goods/delete', {id: id}, function (res) {
            mido_get('?rt=goods/all&active=goods', '?rt=goyat/all');
        });
    }
    function edit_go(id) {
        $.post('?rt=goods/edit', {id: id}, function (res) {
            var data = res.split(",");
            $("#go_id").val(data[0]);
            $("#go_type").val(data[1]);
            $("#go_count").val(data[2]);
            $("#go_cost").val(data[3]);
            $("#go_date").val(data[4]);
            $("#mon_current").val(data[5]);
            window.location.href = "#edit";
        });
    }
    function update_go() {
        var go_id = $("#go_id").val();
        var go_type = $("#go_type").val();
        var go_count = $("#go_count").val();
        var go_cost = $("#go_cost").val();
        var go_date = $("#go_date").val();
        var mon_current = $("#mon_current").val();
        $.post("?rt=goods/update", {go_id: go_id, go_type: go_type, go_count: go_count, go_cost: go_cost, go_date: go_date,mon_current:mon_current}, function (res) {
            if (res == 'yes') {
                $("#res_c").show();
                setTimeout(function () {
                    mido_get('?rt=goods/all&active=goods', '?rt=goods/all');
                }, 2000);
            } else {
                $("#res_f").show();
                setTimeout(function () {
                    mido_get('?rt=goods/all&active=goods', '?rt=goods/all');
                }, 2000);
            }
        });
    }
</script>


