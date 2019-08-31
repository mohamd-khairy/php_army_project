


<style>
    input,th,td{
        text-align: center;
        font-weight: bold;
    }
</style>
<div id="show">
    <center>
        <button class="btn btn-success"  onclick="mido_get('?rt=zpat/show&active=zpat', '?rt=zpat/show')">إضافه ضابط</button>
        <br>
        <br>

        <table border="1"  class="table" style="width: 95%">
            <tr>
                <th style="background-color: #cccccc">التحكم</th>
                <th style="background-color: #cccccc">التاريخ</th>
                <th style="background-color: #cccccc">العنوان</th>
                <th style="background-color: #cccccc">الموبايل</th>
                <th style="background-color: #cccccc">الرتبه</th>
                <th style="background-color: #ff9900">الاسم</th>
                <th style="width: 3%; background-color: #cccccc" >#</th>

            </tr>
            <?php
            $data = ZpatModel::getAllData();
            $i = 1;
            foreach ($data as $zapt) {
                ?>
                <tr>
                    <td style="width: 10% ">
                        <a onclick="delete_z(<?= $zapt['z_id'] ?>)" class="btn btn-danger">حذف</a>
                        <a onclick="edit_z(<?= $zapt['z_id'] ?>)" class="btn btn-success">تعديل</a>
                    </td>
                    <td><?= date("Y-m-d", strtotime($zapt['z_date'])) ?></td>
                    <td ><?= $zapt['z_address'] ?></td>
                    <td><?= $zapt['z_mobile'] ?></td>
                    <td ><?= $zapt['z_degree'] ?></td>
                    <td ><?= $zapt['z_name'] ?></td>
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
        <input type="hidden"   id="z_id"  class="form-control"  >

        <div class="form-group has-feedback" style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right"> الاسم </label>
            <input type="text"   id="z_name" class="form-control"  >
        </div>

        <div class="form-group has-feedback " style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right">  الرتبه  </label>
            <input type="text"   id="z_degree" class="form-control"  placeholder="اكتب رتبه الضابط ...">
        </div>

        <div class="form-group has-feedback " style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right">  الموبايل  </label>
            <input type="number"   id="z_mobile" class="form-control"  placeholder="  ادخل رقم الموبايل ...">
        </div>
        <div class="form-group has-feedback" style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right"> العنوان </label>
            <input type="text"   id="z_address" class="form-control"  placeholder="اكتب عنوان الضابط ...">
        </div>

        <div class="form-group has-feedback " style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right">  التاريخ  </label>
            <input  type="date" value="<?= date("Y-m-d") ?>"   id="z_date" class="form-control">
        </div>
        <br>
        <div>
            <button class="btn btn-success center-block" onclick="update_z()">تعديل</button>
        </div>
    </div>
</div>

<script>
    function delete_z(id) {
        $.post('?rt=Zpat/delete', {id: id}, function (res) {
            mido_get('?rt=zpat/all&active=zpat', '?rt=zpat/all');
        });
    }
    function edit_z(id) {
        $.post('?rt=Zpat/edit', {id: id}, function (res) {
            var data = res.split(",");
            $("#z_id").val(data[0]);
            $("#z_name").val(data[1]);
            $("#z_degree").val(data[2]);
            $("#z_mobile").val(data[3]);
            $("#z_address").val(data[4]);
            window.location.href = "#edit";
        });
    }
    function update_z() {
        var z_id = $("#z_id").val();
        var z_name = $("#z_name").val();
        var z_degree = $("#z_degree").val();
        var z_mobile = $("#z_mobile").val();
        var z_address = $("#z_address").val();
        var z_date = $("#z_date").val();
        $.post("?rt=Zpat/update", {z_id: z_id, z_name: z_name, z_degree: z_degree, z_mobile: z_mobile, z_address: z_address, z_date: z_date}, function (res) {
            if (res == 'yes') {
                $("#res_c").show();
                setTimeout(function () {
                    mido_get('?rt=zpat/all&active=zpat', '?rt=zpat/all');
                }, 2000);
            } else {
                $("#res_f").show();
                setTimeout(function () {
                    mido_get('?rt=zpat/all&active=zpat', '?rt=zpat/all');
                }, 2000);
            }
        });
    }
</script>

