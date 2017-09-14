###使用方法
系统功能的使用方法在相应的页面下方都有提示

### 登录系统的方式:
如使用单点登录方式请完善系统根目录下的SSO.php文件；
如果不需要删除使用密码登录方式，请在该工程里全局搜索“如果不使用密码登录方式”，按照提示进行代码修改；

### 全局配置文件
请按照其中的提示手动配置./config/config.php文件

### 计划任务
请将./schedule文件夹中的文件加入操作系统的计划任务（windows为”计算机管理“中的”系统工具/任务计划程序“，linux为contrab）
DB-update.php使用php命令在每天的凌晨一点运行，
restore-network.php使用php命令每三分钟运行一次；

其中DB-update.php文件为自动更新数据库课程数据表的脚本文件，其中只实现了远程服务器为Oracle的方法，
如果您的远程服务器使用的其他型号的数据库，请根据实际情况修改后再运行。

###关于匹配上课时间和周次明细的规则
系统中默认的是石油大学的规则，
上课时间的规则是”3091011“，第一个数字为周几，后面的数字为当天的第几节课，
周次明细的规则是”1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16“，即第1，2，3，……，16周有课
如果需要修改规则，则需要修改tch.php中的代码。
该系统的后续版本会完善规则的设置功能

###致歉
由于开发的时间紧迫，本系统还有很多不完善和存在漏洞的地方，在后续的版本中会不断修正和完善，敬请谅解。
使用过程中如遇到问题请邮件联系：1507020326@s.upc.edu.cn