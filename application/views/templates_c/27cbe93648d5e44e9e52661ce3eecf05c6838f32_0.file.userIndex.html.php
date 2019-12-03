<?php
/* Smarty version 3.1.33, created on 2019-12-03 20:59:22
  from 'D:\phpStudy\PHPTutorial\WWW\application\views\templates\admin\userIndex.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5de65c2a6b08c1_73216151',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '27cbe93648d5e44e9e52661ce3eecf05c6838f32' => 
    array (
      0 => 'D:\\phpStudy\\PHPTutorial\\WWW\\application\\views\\templates\\admin\\userIndex.html',
      1 => 1575377368,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5de65c2a6b08c1_73216151 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>数据库管理系统</title>
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
    <style type="text/css">
        td {
            vertical-align: middle !important;
        }
    </style>
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
                        <a href="/admin/userIndex">用户管理</a>
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
    <div class="container-fluid">
            <div style="width:300px;" class="center-block">
                <div class="form-inline">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="输入搜索内容" id="input" style="width:130px;" 
                        "<?php if (isset($_GET['value'])) {?>" value=$smarty.get.value <?php }?>>
                    </div>
                    <div class="form-group">
                        <select name="type" class="form-control">
                            <option value="num" <?php if ($_smarty_tpl->tpl_vars['mode']->value == 'id') {?>selected<?php }?>>ID查询</option>
                            <option value="name" <?php if ($_smarty_tpl->tpl_vars['mode']->value == 'name') {?>selected<?php }?>>姓名查询</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" id="research" class="btn btn-primary">搜索</button>
                    </div>
                </div>
            </div>
            <div class="container">
                <a class="btn btn-info pull-right" href="/admin/addUser" style="margin:15px 10px 10px;">添加用户</a>
                <table class="table table-bordered table-hover text-center">
                    <thead>
                        <tr class="active">
                            <th class="text-center">用户ID</th>
                            <th class="text-center">姓名</th>
                            <th class="text-center">省份/分公司</th>
                            <!-- <th class="text-center">最后登陆时间</th> -->
                            <th class="text-center" style="width:70px;">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($_smarty_tpl->tpl_vars['users']->value)) {?>
                            <tr>
                                <td colspan="6">无记录！</td>
                            </tr>
                        <?php } else { ?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['user']->value['province'];?>
</td>
                                <!-- <td><?php echo $_smarty_tpl->tpl_vars['user']->value['last_login_time'];?>
</td> -->
                                <td>
                                    <a href="/admin/userManager/<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" class="btn btn-primary btn-xs">详情</a>
                                </td>
                            </tr>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php }?>
                    </tbody>
                </table>
            </div>
    </body>
    <?php echo '<script'; ?>
>
    
        $(function(){
    
            //注册回车查找
            $("#input").keydown(function(event){
                if(event.keyCode == 13){
                    $("#research").click();
                }
            });
            //查找
            $("#research").click(function(){
                if($("#input").val().length > 0){
                    if($("[name='type']").val() == "name"){
                        var mode="name";
                        location.href = "/admin/userIndex/"+mode+"/"+$("#input").val();
                    }else if($("[name='type']").val() == "num"){
                        var mode="id";
                        location.href = "/admin/userIndex/"+mode+"/"+ $("#input").val();
                    }
                }else{
                    alert("请输入搜索条件");
                }
            });
    
        })
    
    <?php echo '</script'; ?>
>
    
</html><?php }
}
