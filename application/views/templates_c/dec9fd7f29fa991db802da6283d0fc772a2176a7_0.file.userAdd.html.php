<?php
/* Smarty version 3.1.33, created on 2019-12-03 20:43:57
  from 'D:\phpStudy\PHPTutorial\WWW\application\views\templates\admin\userAdd.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5de6588db13678_37215209',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dec9fd7f29fa991db802da6283d0fc772a2176a7' => 
    array (
      0 => 'D:\\phpStudy\\PHPTutorial\\WWW\\application\\views\\templates\\admin\\userAdd.html',
      1 => 1575373720,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5de6588db13678_37215209 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>数据库馆管理系统</title>
    <!--jquery-->
    <?php echo '<script'; ?>
 src="/Resources/jquery.min.js"><?php echo '</script'; ?>
>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="/Resources/bootstrap.min.css">
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <?php echo '<script'; ?>
 src="/Resources/bootstrap.min.js"><?php echo '</script'; ?>
>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav" aria-expanded="false">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="JavaScript:void(0)">
                    <b>数据库管理系统</b>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="nav">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="">主页</a>
                    </li>
                    <li class="active">
                        <a href="admin/audit">审核管理</a>
                    </li>
                    <li>
                        <a href="/admin/usermanager">用户管理</a>
                    </li>
                    <li>
                        <a href="">角色管理</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="JavaScript:void(0)" style="cursor:default"><?php echo $_SESSION['name'];?>
</a>
                    </li>
                    <li>
                        <a href="/user/logout">退出</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div class="h3 text-center" style="margin-top: 100px;">
        <b>添加用户</b>
    </div>
    <form id="form" class="form-horizontal text-center" style="width:250px;margin: 20px auto 0;">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">用户ID</div>
                <input type="text" class="form-control" placeholder="请输入用户ID" name="id">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">密码</div>
                <input type="password" class="form-control" placeholder="请输入密码" name="password">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">姓名</div>
                <input type="text" class="form-control" placeholder="请输入姓名" name="username">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">省份/分公司</div>
                <input type="text" class="form-control" placeholder="请输入省份/分公司" name="province">
            </div>
        </div>
        <div class="form-group">
            <button type="button" id="submit" class="btn btn-primary" style="margin-right: 10px">添&nbsp;加</button>
            <button type="reset" id="reset" class="btn btn-danger" style="margin-left: 10px">重&nbsp;置</button>
        </div>
    </form>
</body>

<?php echo '<script'; ?>
>

    $(function(){

        $("#submit").click(function(){
            $.post({
                url: "/Admin/insertUser",
                data: $("#form").serialize(),
                success: function(data){
                    alert(data.message);
                    if(data.code == 1){
                        $("#reset").click();
                    }
                }
            })
        });

    })

<?php echo '</script'; ?>
>

</html><?php }
}
