faint...

create the project

# for teach the fools to learn thinkphp framework
## 如何获取Thinkphp
### 可以先考虑从github获取我编辑过的版本
1. 	首先来到你的wwwroot目录
在文件窗口空白的地方右键后选择Git Bash Here

2. 	再出现的窗口里面输入
`git clone https://github.com/jasnzhuang/mythinkphp5.git thinkphp5`
上面这句话翻译一下就是这样
淫才！ 去拿个文件回来！ 地址是！ 拿来以后给我放在这里！
如果你操作成功了，那么就会在wwwroot里面出现一个thinkphp5的文件夹
里面就是从我的github上clone回来的整个mythinkphp5项目的文件

3. 	但是这样操作之后，会发现在thinkphp5目录里面缺少一个thinkphp的关键目录
所以需要你在thinkphp5目录文件窗口的空白地方右键后选择Git Bash Here
然后输入
`git clone https://github.com/top-think/framework.git thinkphp`
这样就全活儿了！

4. 	但是呢，以后肯定会不断完善这个项目，那么你想要跟上我的最新修改怎么办呢？
首先来到你的wwwroot目录
在文件窗口空白的地方右键后选择Git Bash Here
再出现的窗口里面输入
`git pull`
就可以了，我最新的修改都会被拉取到你这里来
前提是。。。你不能做任何修改
如果你修改了，那么我建议你直接重复最初的步骤

### 也可以考虑自己弄，从github上获取原版的自己改


## 这里再啰嗦一下关于系统环境配置和几个基础组件的部署问题

### PHP
#### windows下的php配置
1. 	首先建议使用php5.4以上的版本，激进一点的可以直接使用7.1或者7.2版本
2. 	拿到php的压缩包以后，一般是解压到某个指定目录，譬如c:\php下面去
3. 	然后呢，根据用途选择php.ini-development或者php.ini-production这俩文件中的一个，复制并改名为php.ini
4. 	既然是改名了，那肯定就要选择一个位置来放置这个php.ini，早些年强制要求放在你的c:\windows或者c:\windows\system下面，现在貌似直接留在c:\php下面也可以了，反正我现在就是
5. 	放置好之后么，开始修改php.ini的文件内容，
6. 	首先打开文件以后，会在（目前我用的是7.1.5版本，其他版本位置可能有变）第86行看到这样一句话
`; This is php.ini-development INI file.` 
这说明这个文件是从php.ini-development复制而来的
7. 	搜索`short_open_tag = `把这句话后面改为`On`这样你就可以使用`<? ?>`标签了
8. 	搜索`error_reporting = E_ALL`这句话有点意思，因为他决定了一旦发现你的php代码中出现错误或者警告又或者提示，会不会通知你，建议把`E_ALL`改为`E_ALL & ~E_NOTICE`
9. 	搜索
`; Directory in which the loadable extensions (modules) reside.`
这句话，在它下面找到
`; On windows:`
这句话之后，看紧接着的下一行，默认应该是
`; extension_dir = "ext"`
，改为
`extension_dir = "c:\php\ext"`
，这里的
`c:\php`
看自己的实际情况哈
10. 搜索`Windows Extensions`找到后，会在下面看到一堆类似这样的内容：
`extension=php_curl.dll`
`extension=php_gd2.dll`
`extension=php_mbstring.dll`
`extension=php_mysqli.dll`
`extension=php_pdo_mysql.dll`
把以上行的第一个字符`;`去掉，也就是变成我上面的样子，只有这样，第9点和第10点搭配起来，才不会出现找不到插件或者数据库驱动的情况（啥？别笑，真的有傻逼犯这个错误）
11. 以上10点就是目前为止我们开发编写php程序所需要涉及到的有关php.ini的修改点
