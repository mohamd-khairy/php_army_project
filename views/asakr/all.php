


<style>
    input,th,td{
        text-align: center;
        font-weight: bold;
    }
</style>
<div id="show">
    <center>
        <button class="btn btn-success"  onclick="mido_get('?rt=Asakr/show&active=asakr', '?rt=Asakr/show')">إضافه عسكري</button>
        <br>
        <br>

        <table border="1"  class="table" style="width: 95%">
            <tr>
                <th style="background-color: #cccccc">التحكم</th>
                <th style="background-color: #cccccc">التاريخ</th>
                <th style="background-color: #cccccc">العنوان</th>
                <th style="background-color: #cccccc">الموبايل</th>
                <th style="background-color: #cccccc">الدرجه</th>
                <th style="background-color: #ff9900">الاسم</th>
                <th style="width: 3%; background-color: #cccccc" >#</th>

            </tr>

            <?php
            $data = AsakrModel::getAllData();
            $i = 1;
            foreach ($data as $askry) {
                ?>
                <tr>
                    <td style="width: 10% ">
                        <a onclick="delete_a(<?= $askry['a_id'] ?>)" class="btn btn-danger">حذف</a>
                        <a onclick="edit_a(<?= $askry['a_id'] ?>)" class="btn btn-success">تعديل</a>
                    </td>
                    <td><?= date("Y-m-d", strtotime($askry['a_date'])) ?></td>
                    <td ><?= $askry['a_address'] ?></td>
                    <td><?= $askry['a_mobile'] ?></td>
                    <td ><?= $askry['a_degree'] ?></td>
                    <td ><?= $askry['a_name'] ?></td>
                    <td ><?= $i++ ?></td>
                </tr>
            <?php } ?>

        </table>
    </center>
</div>



<div id="edit" class="modalDialog">
    <div style="width: 40%">
        <a href="#" type="button" title="close" class="closee">X</a>
        <span class=" help-block alert alert-danger" id="res_f" style="text-align: center;display: none;color:#c9302c">لم يتم تعديل البيانات ... ! </span>
        <span class=" help-block alert alert-success" id="res_c" style="text-align: center;display: none;color:#006600"> تم تعديل البيانات بنجاح ... ! </span>
        <input type="hidden"   id="a_id"  class="form-control"  >

        <div class="form-group has-feedback" style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right"> الاسم </label>
            <input type="text"   id="a_name" class="form-control"  >
        </div>

        <div class="form-group has-feedback " style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right">  الرتبه  </label>
            <input type="text"   id="a_degree" class="form-control"  placeholder="اكتب رتبه العسكري ...">
        </div>

        <div class="form-group has-feedback " style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right">  الموبايل  </label>
            <input type="number"   id="a_mobile" class="form-control"  placeholder="  ادخل رقم الموبايل ...">
        </div>
        <div class="form-group has-feedback" style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right"> العنوان </label>
            <input type="text"   id="a_address" class="form-control"  placeholder="اكتب عنوان العسكري ...">
        </div>

        <div class="form-group has-feedback " style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right">  التاريخ  </label>
            <input  type="date" value="<?= date("Y-m-d") ?>"   id="a_date" class="form-control">
        </div>
        <br>
        <div>
            <button class="btn btn-success center-block" onclick="update_a()">تعديل</button>
        </div>
    </div>
</div>

<script>
    function delete_a(id) {
        $.post('?rt=Asakr/delete', {id: id}, function (res) {
            mido_get('?rt=Asakr/all&active=asakr', '?rt=Asakr/all');
        });
    }
    function edit_a(id) {
        $.post('?rt=Asakr/edit', {id: id}, function (res) {
            var data = res.split(",");
            $("#a_id").val(data[0]);
            $("#a_name").val(data[1]);
            $("#a_degree").val(data[2]);
            $("#a_mobile").val(data[3]);
            $("#a_address").val(data[4]);
            window.location.href = "#edit";
        });
    }
    function update_a() {
        var a_id = $("#a_id").val();
        var a_name = $("#a_name").val();
        var a_degree = $("#a_degree").val();
        var a_mobile = $("#a_mobile").val();
        var a_address = $("#a_address").val();
        var a_date = $("#a_date").val();
        $.post("?rt=Asakr/update", {a_id: a_id, a_name: a_name, a_degree: a_degree, a_mobile: a_mobile, a_address: a_address, a_date: a_date}, function (res) {
            if (res == 'yes') {
                $("#res_c").show();
                setTimeout(function () {
                    mido_get('?rt=Asakr/all&active=asakr', '?rt=Asakr/all');
                }, 3000);
            } else {
                $("#res_f").show();
                setTimeout(function () {
                    mido_get('?rt=Asakr/all&active=asakr', '?rt=Asakr/all');
                }, 2000);
            }
        });
    }
</script>

