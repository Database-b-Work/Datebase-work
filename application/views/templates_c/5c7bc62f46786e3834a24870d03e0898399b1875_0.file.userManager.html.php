<?php
/* Smarty version 3.1.33, created on 2019-12-03 22:12:29
  from 'D:\phpStudy\PHPTutorial\WWW\application\views\templates\admin\userManager.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5de66d4d774242_15496381',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5c7bc62f46786e3834a24870d03e0898399b1875' => 
    array (
      0 => 'D:\\phpStudy\\PHPTutorial\\WWW\\application\\views\\templates\\admin\\userManager.html',
      1 => 1575382333,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5de66d4d774242_15496381 (Smarty_Internal_Template $_smarty_tpl) {
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
    <div class="text-center container" style="width:65%;margin-top:40px;padding-top:10px;background-color: #f5f5f5;border-radius:20px;">
        <div class="h4">
            <b>用户信息</b>
        </div>
        <p>用户ID：<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['id'];?>
</p>
        <p>用户姓名：<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['username'];?>
</p>
        <p>用户省份/公司：<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['province'];?>
</p>
        <div style="width: 450px;margin:20px auto;overflow: hidden;display: flex;justify-content: space-between">
            <button class="btn btn-success" data-toggle="modal" data-target="#info">修改账户</button>
            <button class="btn btn-warning" data-toggle="modal" data-target="#pwd">修改密码</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#del">删除账户</button>
        </div>
    </div>
    <div class="container-fluid text-center">
        <!-- 修改用户信息模态框（Modal） -->
        <div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="margin-top:150px;">
                <div class="modal-content">
                    <form id="changeInfo">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">
                                修改用户信息
                            </h4>
                        </div>
                        <div class="modal-body center-block" style="width:45%">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">姓名</div>
                                    <input name="username" type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['username'];?>
">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom:0">
                                <div class="input-group">
                                    <div class="input-group-addon">省份/分公司</div>
                                    <input name="province" type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['province'];?>
">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="changeButton" type="button" class="btn btn-primary">确认</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal -->
        </div>

        <!-- 修改密码模态框（Modal） -->
        <div class="modal fade" id="pwd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="margin-top:150px;">
                <div class="modal-content">
                    <div>
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">
                                修改密码
                            </h4>
                        </div>
                        <div class="modal-body center-block" style="width:45%">
                            <div class="form-group " style="margin-bottom:0">
                                <div class="input-group">
                                    <div class="input-group-addon">新密码</div>
                                    <input id="newPwd" type="password" class="form-control" placeholder="请输入新密码">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="pwdButton" type="button" class="btn btn-primary">确认</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal -->
        </div>

        <!-- 删除用户模态框（Modal） -->
        <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="margin-top:150px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">
                            删除账户
                        </h4>
                    </div>
                    <div class="modal-body">
                        <h4>确认要删除账号为<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['id'];?>
的账户?</h3>
                    </div>
                    <div class="modal-footer">
                        <button id="deleteButton" class="btn btn-primary">确认</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal -->
        </div>
    </div>
</body>
<?php echo '<script'; ?>
>

    $(function(){

        //更改信息
        $("#changeButton").click(function(){
            $.post({
                url: "/admin/changeUserInfo",
                data: "id=<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['id'];?>
&" + $("#changeInfo").serialize(),
                success:function(data){
                    alert(data.message);
                    if(data.code == 0){
                        location.reload();
                    }
                }
            })
        });


        //修改密码
        $("#pwdButton").click(function(){
            $.post({
                url: "/admin/changeUserPasswd",
                data:{
                    id : "<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['id'];?>
",
                    pwd : $("#newPwd").val()
                },
                success:function(data){
                    alert(data.message);
                    if(data.code == 0){
                        location.reload();
                    }
                }
            })
        });

        //删除用户
        $("#deleteButton").click(function(){
            $.post({
                url: "/admin/deleteUser",
                data:{
                    id : "<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['id'];?>
"
                },
                success:function(data){
                    alert(data.message);
                    location.href = "/admin/userManager/";
                }
            })
        });



    })

<?php echo '</script'; ?>
>

</html><?php }
}
