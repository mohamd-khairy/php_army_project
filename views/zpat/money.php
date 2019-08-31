<center ><h1> اضف سحب  ضابط </h1></center>

<span class=" help-block alert alert-success" id="res" style="text-align: center;display: none;color:#006600">تمت الاضافه بنجاح...</span>
<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%;">

    <label class="control-label pull-right" style="margin-top: 3%">الضابط</label>
    <select  class="form-control" id="z_name">
        <?php
        $data_z = ZpatModel::getAllData();
        foreach ($data_z as $zpat) {
            ?>
            <option value="<?= $zpat['z_name'] ?>"><?= $zpat['z_name'] ?></option>    
        <?php } ?>  
    </select>
</div>
<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">  المبلغ  </label>
    <input type="number"   id="ms7_cost"   class="form-control"  placeholder="  ادخل  المبلغ ...">
</div>
<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">  التاريخ  </label>
    <input  type="date" value="<?= date("Y-m-d") ?>"  id="ms7_date" class="form-control">
</div>

<br>
<div>
    <button class="btn btn-success center-block" onclick="save_()">احــفــظ</button>
</div>
<script>

    function save_() {
        var z_name = $("#z_name").val();
        var ms7_cost = $("#ms7_cost").val();
        var ms7_date = $("#ms7_date").val();

        $.post("?rt=Zpat/money", {z_name: z_name, ms7_cost: ms7_cost, ms7_date: ms7_date}, function (res) {
            if (res == 'yes') {
                $("#res").show();
                 $("#ms7_cost").val("");
                 $("#ms7_cost").attr("autofocus",'on');
                setTimeout(function () {
                    $('#res').fadeOut('fast');
                }, 2000);
            } else {
                alert(res);
            }
        });

    }
</script>