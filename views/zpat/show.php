<center ><h1> اضف ضابط جديد</h1></center>

<span class=" help-block alert alert-success" id="res" style="text-align: center;display: none;color:#006600">تمت الاضافه بنجاح...</span>

<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right"> الاسم </label>
    <input type="text"   id="z_name" class="form-control"  placeholder="اكتب اسم الضابط ...">
</div>

<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">  الرتبه  </label>
    <input type="text"   id="z_degree" class="form-control"  placeholder="اكتب رتبه الضابط ...">
</div>

<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">  الموبايل  </label>
    <input type="number"   id="z_mobile" class="form-control"  placeholder="  ادخل رقم الموبايل ...">
</div>
<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right"> العنوان </label>
    <input type="text"   id="z_address" class="form-control"  placeholder="اكتب عنوان الضابط ...">
</div>

<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">  التاريخ  </label>
    <input  type="date" value="<?= date("Y-m-d") ?>"   id="z_date" class="form-control">
</div>
<br>
<div>
    <button class="btn btn-success center-block" onclick="save_zapt()">احــفــظ</button>
</div>
<script>

    function save_zapt() {
        var z_name = $("#z_name").val();
        var z_degree = $("#z_degree").val();
        var z_mobile = $("#z_mobile").val();
        var z_address = $("#z_address").val();
        var z_date = $("#z_date").val();
        $.post("?rt=Zpat/show", {z_name: z_name, z_degree: z_degree, z_mobile: z_mobile, z_address: z_address, z_date: z_date}, function (res) {
            if (res == 'yes') {
                $("#z_name").val("");
                $("#z_degree").val("");
                $("#z_mobile").val("");
                $("#z_address").val("");
                $("#res").show();
                setTimeout(function () {
                    $('#res').fadeOut('fast');
                }, 3000);
            }
        });
    }
</script>