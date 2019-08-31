


<style>
    input,th,td{
        text-align: center;
        font-weight: bold;
    }

</style>
<div id="show">
    <center>
        <button class="btn btn-success"  onclick="mido_get('?rt=nsryat/show&active=nsryat', '?rt=nsryat/show')">إضافه نثريه جديده</button>
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
            $sum = NsryatModel::get_order_sum('nsr_cost');
            $data = NsryatModel::getAllDataby_mon_current();
            $i = 1;
            foreach ($data as $nsr) {
                ?>
                <tr>
                    <td style="width: 15% ">
                        <a onclick="delete_nsr(<?= $nsr['nsr_id'] ?>)" class="btn btn-danger">حذف</a>
                        <a onclick="edit_nsr(<?= $nsr['nsr_id'] ?>)" class="btn btn-success">تعديل</a>
                    </td>
                    <td style="width: 15% "><?= date("Y-m-d", strtotime($nsr['nsr_date'])) ?></td>
                    <td ><?= $nsr['nsr_cost'] ?></td>
                    <td><?= $nsr['nsr_count'] ?></td>
                    <td style="width: 20% "><?= $nsr['nsr_type'] ?></td>
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
        <input type="hidden"   id="nsr_id"  class="form-control"  >
        <input type="hidden"   id="mon_current"  class="form-control"  >

        <div class="form-group has-feedback" style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right"> النوع </label>
            <input type="text"   id="nsr_type" class="form-control"  placeholder="اكتب نوع النثريه ...">
        </div>

        <div class="form-group has-feedback" style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right">  العدد  </label>
            <input type="number"   id="nsr_count" class="form-control"  placeholder="  ادخل الكميه ...">
        </div>

        <div class="form-group has-feedback" style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right">  المبلغ  </label>
            <input type="number"   id="nsr_cost" class="form-control"  placeholder="  ادخل  المبلغ ...">
        </div>
        <div class="form-group has-feedback" style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right">  التاريخ  </label>
            <input  type="date"   id="nsr_date" class="form-control">
        </div>
        <br>
        <div>
            <button class="btn btn-success center-block" onclick="update_nsr()">تعديل</button>
        </div>
    </div>
</div>

<script>
    function delete_nsr(id) {
        $.post('?rt=nsryat/delete', {id: id}, function (res) {
            mido_get('?rt=nsryat/all&active=nsryat', '?rt=nsryat/all');
        });
    }
    function edit_nsr(id) {
        $.post('?rt=nsryat/edit', {id: id}, function (res) {
            var data = res.split(",");
            $("#nsr_id").val(data[0]);
            $("#nsr_type").val(data[1]);
            $("#nsr_count").val(data[2]);
            $("#nsr_cost").val(data[3]);
            $("#nsr_date").val(data[4]);
            $("#mon_current").val(data[5]);
            window.location.href = "#edit";
        });
    }
    function update_nsr() {
        var nsr_id = $("#nsr_id").val();
        var nsr_type = $("#nsr_type").val();
        var nsr_count = $("#nsr_count").val();
        var nsr_cost = $("#nsr_cost").val();
        var nsr_date = $("#nsr_date").val();
        var mon_current = $("#mon_current").val();
        $.post("?rt=nsryat/update", {nsr_id: nsr_id, nsr_type: nsr_type, nsr_count: nsr_count, nsr_cost: nsr_cost, nsr_date: nsr_date,mon_current:mon_current}, function (res) {
            if (res == 'yes') {
                $("#res_c").show();
                setTimeout(function () {
                    mido_get('?rt=nsryat/all&active=nsryat', '?rt=nsryat/all');
                }, 2000);
            } else {
                $("#res_f").show();
                setTimeout(function () {
                    mido_get('?rt=nsryat/all&active=nsryat', '?rt=nsryat/all');
                }, 2000);
            }
        });
    }
</script>

