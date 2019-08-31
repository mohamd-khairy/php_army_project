<center ><h1> اضف نثريه جديده</h1></center>

<span class=" help-block alert alert-success" id="res" style="text-align: center;display: none;color:#006600">تمت الاضافه بنجاح...</span>


<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right"> النوع </label>
    <input type="text"   id="nsr_type" class="form-control"  placeholder="اكتب نوع النثريه ...">
</div>

<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">  العدد  </label>
    <input type="number"   id="nsr_count" class="form-control"  placeholder="  ادخل الكميه ...">
</div>

<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">  المبلغ  </label>
    <input type="number"   id="nsr_cost" class="form-control"  placeholder="  ادخل  المبلغ ...">
</div>
<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">  التاريخ  </label>
    <input  type="date" value="<?= date("Y-m-d") ?>"   id="nsr_date" class="form-control">
</div>
<br>
<div>
    <button class="btn btn-success center-block" onclick="save_nsr()">احــفــظ</button>
</div>
<script>

    function save_nsr() {
        var nsr_type = $("#nsr_type").val();
        var nsr_count = $("#nsr_count").val();
        var nsr_cost = $("#nsr_cost").val();
        var nsr_date = $("#nsr_date").val();
        $.post("?rt=nsryat/show", {nsr_type: nsr_type, nsr_count: nsr_count, nsr_cost: nsr_cost, nsr_date: nsr_date}, function (res) {
            if (res == 'yes') {
                $("#nsr_type").val("");
                $("#nsr_count").val("");
                $("#nsr_cost").val("");
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