# Datebase-work
## 使用方法:
先新建一个名为sjk的数据库，然后将sjk.sql导入到mysql数据库中，再把整个项目文件放到网站根目录下即可
## 2019/12/3 20:36
1、更新了sjk.sql文件 需要大家重新导入
2、新增了文件上传功能，但现在鲁棒性和前端较差，比如上传主键重复的文件会出现databases error。
## 2019/12/4 00:39
1.再次更新sjk.sql文件，需要大家重新导入
2.新增用户管理的功能
## 2019/12/6 16:03
1.完善sjk.sql文件，需要大家重新导入<br />
2.完善文件上传功能，解决文件上传鲁棒性问题<br />
3.完成用户报表功能前端大致框架
## 2019/12/7/ 00:35
1.完善sjk.sql文件，需要大家重新导入<br />
2.实现了报表查看,报表修改（通过使用handsontable来实现在线查看,编辑excel），报表稽核，报表上报功能，报表计算功能完成部分<br />
## 2019/12/7 12:03
1.完成报表计算功能
## 2019/12/10 1:01
1.完善sjk.sql文件，需要大家重新导入<br />
2.excel文件样式表修改完成，报表稽核，计算，上报功能完成
## 2019/12/15 13:07
1.完善sjk.sql文件，重新导入<br />
2.完成机构管理<br />
3.完成角色管理<br />
4.完成权限管理<br />
5.完善界面<br />
6.修改一些bug<br />
7.登录用户变更：规则如下<br />
每个省份三个公司，分别为hn1、hn2、hn3。<br />
每个公司三个用户，分别为hn11、hn12、hn13。<br />
三个用户分别对应三个角色：
分公司上报总公司的操作员，有最终上报权限<br />
分公司上报excel人员:有上报excel权限及查看权限<br />
分公司稽核人员：有查看权限、稽核权限，只有他可以计算指标。<br />
## 2019/12/16 22：26
完结！
