<center ><h1> اضف عسكري  جديد</h1></center>


<span class=" help-block alert alert-success" id="res" style="text-align: center;display: none;color:#006600">تمت الاضافه بنجاح...</span>

<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right"> الاسم </label>
    <input type="text"   id="a_name" class="form-control"  placeholder="اكتب اسم العسكري ...">
</div>

<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">  الدرجه  </label>
    <input type="text"   id="a_degree" class="form-control"  placeholder="اكتب درجه العسكري ...">
</div>

<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">  الموبايل  </label>
    <input type="number"   id="a_mobile" class="form-control"  placeholder="  ادخل رقم الموبايل ...">
</div>
<div class="form-group has-feedback" style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right"> العنوان </label>
    <input type="text"   id="a_address" class="form-control"  placeholder="اكتب عنوان العسكري ...">
</div>

<div class="form-group has-feedback " style="margin-left: 15%; margin-right: 20%">
    <label class="control-label pull-right">  التاريخ  </label>
    <input  type="date" value="<?= date("Y-m-d") ?>"   id="a_date" class="form-control">
</div>
<br>
<div>
    <button class="btn btn-success center-block" onclick="save_3skry()">احــفــظ</button>
</div>
<script>

    function save_3skry() {
        var a_name = $("#a_name").val();
        var a_degree = $("#a_degree").val();
        var a_mobile = $("#a_mobile").val();
        var a_address = $("#a_address").val();
        var a_date = $("#a_date").val();
        $.post("?rt=Asakr/show", {a_name: a_name, a_degree: a_degree, a_mobile: a_mobile, a_address: a_address, a_date: a_date}, function (res) {
            if (res == 'yes') {
                $("#a_name").val("");
                $("#a_degree").val("");
                $("#a_mobile").val("");
                $("#a_address").val("");
                $("#res").show();
                setTimeout(function () {
                    $('#res').fadeOut('fast');
                }, 3000);
            }
        });
    }
</script>