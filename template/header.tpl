<html>
    <head>
        <title>مـــيـــس</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
        <script src="<?=HostName.DS.'jQuery/jquery.min.js'?>"></script>
        <link href="<?=HostName.DS.'css/bootstrap.css'?>" rel="stylesheet"/>
        <link rel="shortcut icon" href="<?=HostName.'/images/1.png'?>">
        <script src="<?=HostName.DS.'jQuery/main.js'?>"></script>
        <script>
            function mido_get(true_path, fake_path) {
                $("#case").load(true_path);
                ChangeUrl('Page1', fake_path);
            }
        </script>
    </head>
    <body  id='img2' style="background-image: url( '<?= HostName ?>./images/pattern.jpg')">

        <div id="mizo">
            <div  id="case" style="display: block">
                <table border="0" style="width: 100%;height: 100%">
                    <tr style="height: 2%" id="head">
                        <td colspan="2" id="menubar" >
                            <ul id="menu" style="margin-left: -5%">
                                <style>
                                    li>a{
                                        width: 6%;
                                    }
                                    ul#menu li.active > a{
                                        color: #262626;
                                        background-color: #e3dfdf;
                                        font-weight: normal;
                                    }
                                </style>
                                <?php 
                                if(!isset($_GET['active'])){
                                $active='index';
                                }else{
                                $active=$_GET['active'];
                                }?>
                                <li ><a href="?rt=HomePage/logout"> الخروج</a></li>
                                <li class=" <?php if($active == 'money'){ echo 'active'; }?>"><a href="#" onclick="mido_get('?rt=money/show&active=money', '?rt=money/show')">الحساب</a></li>
                                <li class=" <?php if($active == 'goods'){ echo 'active'; }?>"><a href="#" onclick="mido_get('?rt=goods/all&active=goods', '?rt=goods/all')">البضاعه </a></li>                            
                                <li class=" <?php if($active == 'special'){ echo 'active'; }?>"><a href="#" onclick="mido_get('?rt=fwater/special&active=special', '?rt=fwater/special')">المشتريات</a></li>
                                <li class=" <?php if($active == 'fwater'){ echo 'active'; }?>"><a href="#" onclick="mido_get('?rt=fwater/all&active=fwater', '?rt=fwater/all')">الفواتير</a></li>
                                <li class=" <?php if($active == 'nsryat'){ echo 'active'; }?>"><a href="#" onclick="mido_get('?rt=nsryat/all&active=nsryat', '?rt=nsryat/all')">النثريات</a></li>
                                <li class=" <?php if($active == 'ms7obat'){ echo 'active'; }?>"><a href="#"  onclick="mido_get('?rt=zpat/all_money&active=ms7obat', '?rt=zpat/all_money')">المسحوبات</a></li>
                                <li class=" <?php if($active == 'asakr'){ echo 'active'; }?>"><a href="#" onclick="mido_get('?rt=Asakr/all&active=asakr', '?rt=Asakr/all')" >العساكر</a></li>
                                <li class=" <?php if($active == 'zpat'){ echo 'active'; }?>"><a href="#" onclick="mido_get('?rt=Zpat/all&active=zpat', '?rt=Zpat/all')">الضباط</a></li>
                                <li class=" <?php if($active == 'month'){ echo 'active'; }?>"><a href="#" onclick="mido_get('?rt=HomePage/month&active=month', '?rt=HomePage/month')">الشهر</a></li>

                            </ul>
                        </td>
                    </tr>
                    <tr>

