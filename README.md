# 想法来源
在长沙读书想考驾照了就去驾校报了名，练科目二的时候，人真的不是一般的多，一个教练带50多号人，那这么多人怎么上课呢？  
就是在教练的微信群里，每天到了18:00左右教练就发出来一个约课信息，比如今天开两节课，学员就跟帖在教练发的信息后面加上自己的名字，这样子人一多了弊端就出来了，有时候教练信息刚发出来，我刚复制好教练的信息把我的名字加到了上面准备发出去的时候，别人已经跟了贴了，我又得加上他的名字。一天只能练那么几个人，有时候有人同时跟了贴，又都想练，一辆车坐5个人，夏天那真的是太酸爽了！  
这样子什么时候才能拿到驾照哦，不能坐以待毙，刚好那时候在学PHP，就想着能不能到写个抢课的网站（为啥不用小程序因为小程序发布有要求，我拿个香港服务器想干嘛就干嘛），用程序来判断约满了不能约了总比人工喊停要靠谱！

# 关于程序
原生态的PHP写的，MVC的架构模式，面向对象的编程思想，单教练版（后面驾校发现了这玩意，又用Springboot写了多教练版）  
PHP版本：5.*  
MySQL版本：5.*  
MySQL连接配置文件：libs/BaseModel.class.php  
前台：域名  
后台：域名/luo （因为教练姓罗，这个教练真的蛮好的）  

# 截了个图（前端的话找了个商城的h5模板改的，很多jscss都没删除，轻喷）
### 首页
![首页](https://raw.githubusercontent.com/MPengYu/jiaxiaoyueke/master/img/%E9%A6%96%E9%A1%B5.png)  
### 约课
![约课](https://raw.githubusercontent.com/MPengYu/jiaxiaoyueke/master/img/%E7%BA%A6%E8%AF%BE.png)  
### 查看/取消
![查看/取消](https://raw.githubusercontent.com/MPengYu/jiaxiaoyueke/master/img/%E5%8F%96%E6%B6%88%E7%BA%A6%E8%AF%BE.png)  
### 复制信息（传统约课模式）
![复制信息（传统约课模式）](https://raw.githubusercontent.com/MPengYu/jiaxiaoyueke/master/img/%E5%A4%8D%E5%88%B6%E4%BF%A1%E6%81%AF%EF%BC%88%E4%BC%A0%E7%BB%9F%E7%BA%A6%E8%AF%BE%E6%A8%A1%E5%BC%8F%EF%BC%89.png)  
### 后台发课
![后台发课](https://raw.githubusercontent.com/MPengYu/jiaxiaoyueke/master/img/%E5%90%8E%E5%8F%B0%E5%8F%91%E8%AF%BE.png)  

# 事后一支烟
这个也是当初边学边写的，其实还是有很多不足，后面的版本都是用Java来迭代了，这个也没优化了。万事万物皆对象，生活处处有代码，一起加油吧。