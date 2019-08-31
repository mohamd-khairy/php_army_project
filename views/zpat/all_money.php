


<style>
    input,th,td{
        text-align: center;
        font-weight: bold;
    }

</style>
<div id="show">
    <center> 
        <br>
        <button class="btn btn-success"  onclick="mido_get('?rt=zpat/money&active=ms7obat', '?rt=zpat/money')">إضافه سحب جديد</button>
        <br>
        <br>

        <table border="1"  class="table" style="width: 95%">
            <tr>
                <th style="background-color: #cccccc;width: 15%;">التحكم</th>
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
            error_reporting(0);
            $arr = [];
            $i = 1;
            $m = 0;
            $data = Ms7obatModel::get_All_date_by_mon_current();
            foreach ($data as $dates) {
                $arr[$m] = $dates['ms7_date'];
                $m++;
            }
            $all_date = array_unique($arr);
            foreach ($all_date as $d) {
                ?>
                <tr>
                    <td style="width: 10% ">
                        <a onclick="delete_first_ms7(<?= strtotime($d) ?>)"  class="btn btn-danger" >حذف</a> 
                        <a onclick="edit_ms7(<?= strtotime($d) ?>)" class="btn btn-success">تعديل</a>
                    </td>
                    <?php
                    $data_z = ZpatModel::getAllData();
                    foreach ($data_z as $zpat) {
                        $zpats = Ms7obatModel::get_All_data_by_mon_current_and_date($d, $zpat['z_name']);
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
                <td ></td>
                <?php
                $data_z = ZpatModel::getAllData();
                foreach ($data_z as $zpat) {
                    $zpats = Ms7obatModel::get_All_date_by_mon_current_and_any_colm('z_name', $zpat['z_name']);
                    if (empty($zpats)) {
                        ?>
                        <td style="background-color: #cccccc">-</td>
                    <?php } else {
                        ?>
                        <td style="background-color: #cccccc"><?= $zpats[0]['count'] ?></td>
                        <?php
                    }
                }
                ?> 
                <td ><?= count($all_date) ?></td>
                <th style="background-color: #ff9900">  عدد الايام</th>
            </tr>
            <tr>
                <td ></td>
                <?php
                $data_z = ZpatModel::getAllData();
                foreach ($data_z as $zpat) {
                    $zpats = Ms7obatModel::get_All_date_by_mon_current_and_any_colm('z_name', $zpat['z_name']);
                    if (empty($zpats)) {
                        ?>
                        <td style="background-color: #cccccc"> - </td>
                    <?php } else {
                        ?>
                        <td style="background-color: #cccccc"><?= number_format($zpats[0]['sum'],2) ?></td>
                        <?php
                    }
                }
                ?> 
                <td ></td>
                <th style="background-color: #ff9900">  اجمالي المسحوبات</th>
            </tr>
        </table>
    </center>
</div>

<div id="delete" class="modalDialog">
    <div style="width: 40%">
        <a href="#" type="button" title="close" class="closee">X</a>

        <span class=" help-block alert alert-danger" id="res_f" style="text-align: center;display: none;color:#c9302c">لم يتم تعديل البيانات ... ! </span>
        <span class=" help-block alert alert-success" id="res_c" style="text-align: center;display: none;color:#006600"> تم تعديل البيانات بنجاح ... ! </span>

        <div class="form-group has-feedback " style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right">  التاريخ  </label>
            <input  type="date"   id="ms7_datee" class="form-control">
        </div>

        <div class="form-group has-feedback" style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right"> الاسم </label>
            <select  class="form-control" id="z_namee" onchange="new_edit()">
                <?php
                $data_zz = ZpatModel::getAllData();
                foreach ($data_zz as $zpat) {
                    ?>
                    <option value="<?= $zpat['z_name'] ?>"><?= $zpat['z_name'] ?></option>    
                <?php } ?>  
            </select>
        </div>
        <div>
            <button class="btn btn-success center-block" onclick="delete_ms7()">حـذف</button>
        </div>
    </div>
</div>


<div id="edit" class="modalDialog">
    <div style="width: 40%">
        <a href="#" type="button" title="close" class="closee">X</a>

        <span class=" help-block alert alert-danger" id="res_f" style="text-align: center;display: none;color:#c9302c">لم يتم تعديل البيانات ... ! </span>
        <span class=" help-block alert alert-success" id="res_c" style="text-align: center;display: none;color:#006600"> تم تعديل البيانات بنجاح ... ! </span>
        <input type="hidden"   id="z_id"  class="form-control"  >

        <div class="form-group has-feedback " style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right">  التاريخ  </label>
            <input  type="date"   id="ms7_date" class="form-control">
        </div>

        <div class="form-group has-feedback" style="margin-left: 20%; margin-right: 15%">
            <label class="control-label pull-right"> الاسم </label>
            <select  class="form-control" id="z_name" onchange="new_edit()">
                <?php
                $data_z = ZpatModel::getAllData();
                foreach ($data_z as $zpat) {
                    ?>
                    <option value="<?= $zpat['z_name'] ?>"><?= $zpat['z_name'] ?></option>    
                <?php } ?>  
            </select>
        </div>

        <div class="form-group has-feedback " style=" display: none;margin-left: 20%; margin-right: 15%" id="cost">
            <label class="control-label pull-right">  المبلغ  </label>
            <input type="number"   id="ms7_cost" class="form-control"  placeholder="  ادخل  المبلغ ...">
        </div>
        <br>
        <div>
            <button class="btn btn-success center-block" onclick="update_ms7()">تعديل</button>
        </div>
    </div>
</div>
<script>
    function delete_ms7() {
        var z_name = $("#z_namee").val();
        var ms7_date = $("#ms7_datee").val();
        //   alert(z_name+ms7_date);
        $.post('?rt=Zpat/delete_ms7', {z_name: z_name, ms7_date: ms7_date}, function (res) {
              mido_get('?rt=zpat/all_money&active=ms7obat', '?rt=zpat/all_money');
        });
    }
    function delete_first_ms7(date) {
        $.post('?rt=Zpat/delete_first_ms7', {date: date}, function (res) {
            $("#ms7_datee").val(res);
            window.location.href = "#delete";
        });
    }
    function new_edit() {
        var z_name = $("#z_name").val();
        var ms7_date = $("#ms7_date").val();
        $.post('?rt=Zpat/new_edit', {z_name: z_name, ms7_date: ms7_date}, function (res) {
            $("#ms7_cost").val(res);
            $("#cost").show();
        });
    }
    function edit_ms7(date) {
        $.post('?rt=Zpat/edit_ms7', {date: date}, function (res) {
            $("#ms7_date").val(res);
            window.location.href = "#edit";
        });
    }
    function update_ms7() {
        var z_name = $("#z_name").val();
        var ms7_cost = $("#ms7_cost").val();
        var ms7_date = $("#ms7_date").val();
        $.post("?rt=Zpat/update_ms7", {z_name: z_name, ms7_cost: ms7_cost, ms7_date: ms7_date}, function (res) {
            if (res == 'yes') {
                $("#res_c").show();
                setTimeout(function () {
                    mido_get('?rt=zpat/all_money&active=ms7obat', '?rt=zpat/all_money');
                }, 3000);
            } else {
                $("#res_f").show();
                setTimeout(function () {
                    mido_get('?rt=zpat/all_money&active=ms7obat', '?rt=zpat/all_money');
                }, 2000);
            }
        });
    }
</script>