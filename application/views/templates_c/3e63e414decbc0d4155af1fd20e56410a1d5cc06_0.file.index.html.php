<?php
/* Smarty version 3.1.33, created on 2019-12-02 23:20:13
  from 'D:\phpStudy\PHPTutorial\WWW\application\views\templates\staff\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5de52bad913c59_60051436',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e63e414decbc0d4155af1fd20e56410a1d5cc06' => 
    array (
      0 => 'D:\\phpStudy\\PHPTutorial\\WWW\\application\\views\\templates\\staff\\index.html',
      1 => 1575299956,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5de52bad913c59_60051436 (Smarty_Internal_Template $_smarty_tpl) {
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
                        <a href="">分公司功能1</a>
                    </li>
                    <li>
                        <a href="">功能2</a>
                    </li>
                    <li>
                        <a href="">功能3</a>
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
    <!-- <div class="container-fluid">
        <div style="width:300px;" class="center-block">
            <div class="form-inline">
                <div class="form-group">
                    <input type="text" id="input" class="form-control" placeholder="输入搜索内容" name="keyword" style="width:130px;"
                           <?php if ($_smarty_tpl->tpl_vars['mode']->value == 'keyword') {?>value='<?php echo $_GET['keyword'];?>
'<?php } elseif ($_smarty_tpl->tpl_vars['mode']->value == 'bookId') {?>value='<?php echo $_GET['bookId'];?>
'<?php }?>>
                </div>
                <div class="form-group">
                    <select name="type" class="form-control">
                        <option value="name" <?php if ($_smarty_tpl->tpl_vars['mode']->value == 'keyword') {?>selected<?php }?>>书名查询</option>
                        <option value="num" <?php if ($_smarty_tpl->tpl_vars['mode']->value == 'bookId') {?>selected<?php }?>>书号查询</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="button" id="research" class="btn btn-primary">搜索</button>
                </div>
            </div>
        </div>
        <a class="btn btn-info pull-right" href="?p=Admin&c=Book&a=add" style="margin:15px 10px 10px;">添加图书</a>
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr class="active">
                    <th class="text-center">图书号</th>
                    <th class="text-center">图书名</th>
                    <th class="text-center">作者</th>
                    <th class="text-center" style="width: 90px;">状态</th>
                    <th class="text-center" style="width: 100px;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($_smarty_tpl->tpl_vars['books']->value)) {?>
                    <tr>
                        <td colspan="5">无记录！</td>
                    </tr>
                <?php }?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['books']->value, 'book');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['book']->value) {
?>
                    <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['book']->value['id'];?>
</td>
                        <td>
                            <a href="?p=Admin&c=Book&a=detail&id=<?php echo $_smarty_tpl->tpl_vars['book']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['book']->value['name'];?>
</a>
                        </td>
                        <td><?php echo $_smarty_tpl->tpl_vars['book']->value['author'];?>
</td>
                        <?php if ($_smarty_tpl->tpl_vars['book']->value['user_id'] == '') {?>
                            <td class="success">在馆</td>
                        <?php } else { ?>
                            <td class="danger">已借出</td>
                        <?php }?>
                        <td>
                            <a href="?p=Admin&c=Book&a=edit&id=<?php echo $_smarty_tpl->tpl_vars['book']->value['id'];?>
" class="btn btn-success btn-xs">修改</a>&nbsp;
                            <button class="btn btn-danger btn-xs delete" bookId="<?php echo $_smarty_tpl->tpl_vars['book']->value['id'];?>
">删除</button>
                        </td>
                    </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
        </table> -->

        <!-- 分页 -->
        <!-- <?php echo $_smarty_tpl->tpl_vars['pageStr']->value;?>


    </div> -->
</body>
<!-- <?php echo '<script'; ?>
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
                    var mode = "keyword";
                }else if($("[name='type']").val() == "num"){
                    var mode = "bookId";
                }
                location.href = "?p=Admin&c=Book&a=index&"+ mode + "=" + $("#input").val();
            }else{
                alert("请输入搜索条件");
            }
        });

        //删除
        $(".delete").click(function(){
            if(confirm("真的要删除吗?")){
                $.post({
                    url: "?p=Admin&c=Book&a=delete",
                    data: {"id":$(this).attr("bookId")},
                    success:function(data){
                        alert(data.message);
                        location.reload();
                    }
                });
            }
        })
    });

<?php echo '</script'; ?>
> -->

</html><?php }
}
