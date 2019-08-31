<center ><h1> اضافه مشتريات جديده</h1></center>

<span class=" help-block alert alert-success" id="res" style="text-align: center;display: none;color:#006600">تمت الاضافه بنجاح...</span>

<div class="form-group has-feedback" style="margin-left: 25%; margin-right: 15%">
    <label class="control-label pull-right"> الضابط </label>
    <select  class="form-control" id="z_name">
        <?php
        $data_z = ZpatModel::getAllData();
        foreach ($data_z as $zpat) {
            ?>
            <option value="<?= $zpat['z_name'] ?>"><?= $zpat['z_name'] ?></option>    
        <?php } ?>  
    </select>
</div>

<div class="form-group has-feedback" style="margin-left: 25%; margin-right: 15%">
    <label class="control-label pull-right"> النوع </label>
    <input type="text" id="spc_type" class="form-control"  placeholder="اكتب  اسم المنتج ...">
</div>
<div class="form-group has-feedback" style="margin-left: 25%; margin-right: 15%">
    <label class="control-label pull-right"> العدد </label>
    <input type="number" id="spc_count" class="form-control"  placeholder="اكتب الكميه ...">
</div>

<div class="form-group has-feedback" style="margin-left: 25%; margin-right: 15%">
    <label class="control-label pull-right"> المبلغ </label>
    <input type="number" id="spc_cost" class="form-control"  placeholder="اكتب المبلغ ...">
</div>

<div class="form-group has-feedback " style="margin-left: 25%; margin-right: 15%">
    <label class="control-label pull-right">  التاريخ  </label>
    <input  type="date" value="<?= date("Y-m-d") ?>"   id="spc_date" class="form-control">
</div>

<button type="button" onclick="save_spc()" style="margin-left: 45%;" class="btn btn-primary  col-sm-2 " >حــفظ</button>
<div  style="margin-bottom:5%;">
</div>

<script>

    function save_spc() {
        var z_name=$("#z_name").val();
        var spc_type = $("#spc_type").val();
        var spc_count = $("#spc_count").val();
        var spc_cost = $("#spc_cost").val();
        var spc_date = $("#spc_date").val();
        $.post("?rt=fwater/special", {z_name:z_name,spc_type: spc_type, spc_count: spc_count, spc_cost: spc_cost, spc_date: spc_date}, function (res) {
            if (res == 'yes') {
                $("#spc_type").val("");
                $("#spc_count").val("");
                $("#spc_cost").val("");
                $("#res").show();
                setTimeout(function () {
                    $('#res').fadeOut('fast');
                }, 3000);
            }else{
                alert(res);
            }
        });
    }
</script>