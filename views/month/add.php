<div id="show">

    <center>

        <div style="margin-top: -10%;margin-bottom: 8%">
            <h1 >الشهر الحالي</h1>
            <h3 >  <?php
                if (isset($_SESSION['mon_current']) && $_SESSION['mon_current'] != 0) {
                    echo $_SESSION['mon_current'];
                }
                ?>  </h3>

            <span class=" help-block alert alert-success" id="res" style="text-align: center;display: none;color:#006600">تمت الاضافه بنجاح...</span>

        </div>
        <div style="">
            <table id="month" class="table"   style="width: 60%">
                <!--            product-->
                <td > 
                    <select  class="form-control" id="mon_zapt">
                        <?php
                        $data_z = ZpatModel::getAllData();
                        foreach ($data_z as $zpat) {
                            ?>
                            <option value="<?= $zpat['z_name'] ?>"><?= $zpat['z_name'] ?></option>    
                        <?php } ?>  
                    </select>
                </td>
                <td><label>  اختر ضابط </label></td>

                <td > 
                    <select  class="form-control" id="mon_askry">
                        <?php
                        $data_a = AsakrModel::getAllData();
                        foreach ($data_a as $asakr) {
                            ?>
                            <option value="<?= $asakr['a_name'] ?>"><?= $asakr['a_name'] ?></option>    
                        <?php } ?>  
                    </select>
                </td>
                <td><label>  اختر عسكري </label></td>
                <td ><input class="form-control" value="<?= date('m-Y') ?>" placeholder="ادخل رقم الشهر ...."  type="text" id="mon_current" />
                </td>
                <td><label> اضف شهر </label></td>

            </table>


            <input class="btn btn-primary" onclick="add_mon()" type="button" value="اضــف" style="width: 20%" />
        </div>
    </center>
    <br>

    <script>
        function add_mon() {
            var mon_zapt = $("#mon_zapt").val();
            var mon_askry = $("#mon_askry").val();
            var mon_current = $("#mon_current").val();
            $.post("?rt=HomePage/check_month", {mon_current: mon_current}, function (res) {
                if (res == 'yes') {
                    $.post("?rt=HomePage/month", {mon_zapt: mon_zapt, mon_askry: mon_askry, mon_current: mon_current}, function (res) {
                        if (res == 'yes') {
                            $("#res").show();
                            setTimeout(function () {
                                $('#res').fadeOut('fast');
                            }, 3000);
                        } else {
                            alert("يوجد خطا.. !");
                        }
                    });
                } else {
                    alert(res);
                }
            });
        }
    </script>


</div>
<style>
    td{
        background-color: #888;
    }
</style>