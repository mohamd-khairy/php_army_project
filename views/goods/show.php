<center ><h1> البضاعه المرحله من الشهر الحالي</h1></center>
<span class=" help-block alert alert-success" id="res" style="text-align: center;display: none;color:#006600">تمت الاضافه بنجاح...</span>

<div class="form-group has-feedback" style="margin-left: 25%; margin-right: 15%">
    <label class="control-label pull-right"> النوع </label>
    <input type="text" id="go_type" class="form-control"  placeholder="اكتب  اسم المنتج ...">
</div>
<div class="form-group has-feedback" style="margin-left: 25%; margin-right: 15%">
    <label class="control-label pull-right"> العدد </label>
    <input type="number" id="go_count" class="form-control"  placeholder="اكتب الكميه ...">
</div>

<div class="form-group has-feedback" style="margin-left: 25%; margin-right: 15%">
    <label class="control-label pull-right">  المبلغ </label>
    <input type="number" id="go_cost" class="form-control"  placeholder="اكتب المبلغ ...">
</div>

<div class="form-group has-feedback " style="margin-left: 25%; margin-right: 15%">
    <label class="control-label pull-right">  التاريخ  </label>
    <input  type="date" value="<?= date("Y-m-d") ?>"   id="go_date" class="form-control">
</div>
<br>
<div>
    <a class="btn btn-success center-block" style="width: 20%" href="#goods" onclick="save_go()">حــفــظ</a>
</div>

<script>

    function save_go() {
        var go_type = $("#go_type").val();
        var go_count = $("#go_count").val();
        var go_cost = $("#go_cost").val();
        var go_date = $("#go_date").val();
        $.post("?rt=goods/show", {go_type: go_type, go_count: go_count, go_cost: go_cost, go_date: go_date}, function (res) {
            if (res == 'yes') {
                $("#go_type").val("");
                $("#go_count").val("");
                $("#go_cost").val("");
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



