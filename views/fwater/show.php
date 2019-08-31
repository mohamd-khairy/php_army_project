<center ><h1>اضافه فاتوره جديده</h1></center>
<span class=" help-block alert alert-success" id="res" style="text-align: center;display: none;color:#006600">تمت الاضافه بنجاح...</span>



<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">العسكري المستلم  </label>
    <select  class="form-control" id="fw_askry">
        <?php
        $data_a = AsakrModel::getAllData();
        foreach ($data_a as $asakr) {
            ?>
            <option value="<?= $asakr['a_name'] ?>"><?= $asakr['a_name'] ?></option>    
        <?php } ?>  
    </select>        </div> 


<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">  التاريخ  </label>
    <input  type="date" value="<?= date("Y-m-d") ?>"   id="fw_date" class="form-control">
</div>
<br>
<div>
    <a class="btn btn-success center-block" style="width: 20%"  onclick="save_f()">حــفــظ</a>
</div>


<div id="goods" class="modalDialog">
    <div>
        <a href="#" type="button"  title="close" class="closee">X</a>
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

        <button type="button" onclick="save_det()" style="margin-left: 45%;" class="btn btn-primary  col-sm-2 " >حــفظ</button>
        <div  style="margin-bottom:5%;">
        </div>
    </div>
</div>


<script>
    var id;
    function save_f() {
        var fw_askry = $("#fw_askry").val();
        var fw_date = $("#fw_date").val();
        $.post("?rt=fwater/show", {fw_askry: fw_askry, fw_date: fw_date}, function (res) {
            var data = res.split("|");
            if (data[0] == "yes") {
                $("#fw_count").val("");
                $("#fw_date").val("");
                id = data[1];
                window.location.href = "#goods";
            } else {
                alert(res);
            }
        });
    }
    function save_det() {
        var det_type = $("#det_type").val();
        var det_count = $("#det_count").val();
        var det_cost = $("#det_cost").val();
        $.post("?rt=fwater/add_det", {fw_id: id, det_type: det_type, det_count: det_count, det_cost: det_cost}, function (res) {
            if (res == 'yes') {
                $("#det_type").val("");
                $("#det_count").val("");
                $("#det_cost").val("");
                $("#res_c").show();
                setTimeout(function () {
                    $('#res_c').fadeOut('fast');
                }, 2000);
            } else {
                alert(res);
            }
        });
    }

</script>
