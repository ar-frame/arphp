# start mode


## web framework
index.php
```
$loader = require dirname(dirname(__FILE__)) .  '/vendor/autoload.php';
ar\core\Ar::init($loader);
```

## OUTER FRAME 
start.php
```
define('AR_AS_OUTER_FRAME', true);
// define('AR_ROOT_PATH', __DIR__ . '/../dpb/');
define('AR_ORI_NAME', 'dpb');
$loader = require dirname(dirname(__FILE__)) .  '/vendor/autoload.php';
ar\core\Ar::init($loader);
```

## arws 异构服务，可用getCoder client连接
arws.php
```
date_default_timezone_set('PRC');
// 开启AR支持workerman的web服务器
$webserverConfig = [
    // 绑定服务端口
    'bind' => 'http://0.0.0.0:8088',
    // host
    'host' => 'www.server.com.lk',
    // 网站根目录
    'root' => dirname(__FILE__),
    // 设置开启多少进程
    'count' => 10,
    // 入口文件
    'entry' => '/arws.php'
];
$loader = require dirname(dirname(__FILE__)) .  '/vendor/autoload.php';
ar\core\Ar::init($loader, $webserverConfig);

```


### 启动arws web server workerman模式
` php server/arws.php start -d ` 


* aw server demo
```

<?php
namespace server\ctl\main;
/**
 * Powerd by ar 10.
 *
 * Controller.
 *
 * @author ycassnr <ycassnr@gmail.com>
 */

/**
 * Default service for test.
 */
class TestService extends BaseService
{
     /////////////////////////START////////////////////////////////
    /******************演示数据基础类型返回*************************/

    /**
     * 测试接口
     *
     * 客户端调用方式
        try {
            // 接口名称
            $apiname = 'Ws'.'server.ctl.main.Test';
            $res = \ar\core\comp('rpc.service')->$apiname("t1",array ($param1));
            // todo $res
        } catch (\ar\core\Exception $e) {
            // todos 异常处理
            echo $e->getMessage();
        }
     *
     * @param string $param1 参数1
     *
     * @author yaoxf <bestyao@gmail.com>
     *
     * @apiname 测试接口
     *
     * @return object
     */
    public function t1Worker($param1)
    {
       
        $this->response(['a' => 'hello ', 'b' => $param1]);
    }

}


## ar-frame 学习交流q群
259956472
爬虫，大数据，金融，量化交易，数字货币 编程开发
【java,php,python,nodejs,c++】




---------------------------------------------------------

# 常规使用说明

* 直接上代码 (*控制器代码*)

<pre>
namespace ori\ctl\main;  
use \ar\core\ApiController as Controller;

/**
 * 新增了ApiController  
 */
class Index extends Controller
{
    // 第一个被执行的初始化方法
    public function init()
    {
        // $this->request 请求参数数组， 控制器任意地方可调用
        // var_dump($this->request);
    }

    // get请求 并且严格限制参数类型 , 参数严格按字母顺序
    public function get_param($aa, int $bb)
    {
        //var_dump($this->request);
        var_dump($aa, $bb);
    }

    // post 请求
    public function post_param($p1, $p2)
    {
        var_dump($this->request);
        var_dump();

    }

    // get请求无参数
    public function get_noparam()
    {
        echo 'get no params';

    }

    // request 请求 支持post 和 get 请求
    public function actionrequest($p1 = 'hello', $p2 = ' arphp')
    {
        echo 'action request';
        var_dump($p1 . $p2);

    }

    // 错误异常回调
    public handleError($errorMsg)
        {
        // 对父类的错误函数进行重置，定义其他的一些异常行为
        parent::handleError($errorMsg);

    }

}

</pre>
--------------------------------------------------------




### 目录结构说明

- **ar.ason**

    ar项目静态配置文件

- **cfg**

    配置文件夹

  - **cfg/base.php**

    *全局配置*， 第一次安装复制base0.php > base.php, 数据库配置等

  - **cfg/main.php**

    模块配置


- **ori**

    *项目目录* 建议线上设置的 **DocumentRoot**

  - **ori/index.php**

    访问入口文件

  - **ori/ctl**

    控制器目录

    - **ori/ctl/service**

      模块控制器中间件*service*

  - **ori/lib**

    库目录
    - **ori/lib/model**

      数据库模型目录

    - **ori/lib/module**
      全局公共库目录

  - **ori/assets**

    全局公共css,js等静态资源目录

  - **ori/themes**

    模块静态js,css等主题资源目录  （默认主题皮肤为*def*，可扩展，可定制）

  - **ori/view**

    模块定义模板目录，（默认主题模板为def，可扩展多套模板，可定制）


- **data**

  缓存，日志，临时文件目录


* **vendor**

  composer框架等目录

### 常用操作方法

#### 控制器
- 控制器分配置模板变量

  - *控制器代码*

    `$this->assign(['hello' => 'arphp', 'anarr' => ['edition' => 'ar5.0']]);`

  - *模板使用*   

    `来自控制器字符串 {{hello}}, ar edition {{anarr.edition}}`

  - *控制器跳转*

    `$this->redirect('user');`

    `$this->redirect(['user/detail', ['id' => 1]]);` // 参数类似url生成

    `$this->redirectSuccess('user', '操作成功');` // 跳转成功

    `$this->redirectError('user', '失败');`   // 跳转失败

- 控制器使用*service*

  - 新建`ori/ctl/main/service/Test.php`
```
<?php
/**
 * Powerd by ArPHP.
 *
 * test service.
 *
 */
namespace ori\ctl\main\service;
/**
 * Default Controller of webapp.
 */
class Test
{
    // in controller $this->getTestService()->myTestFunc();
    public function myTestFunc()
    {
    echo "my test func is called";

    }

}
```

 - 使用

    `$this->getTestService()->myTestFunc()`

* 控制器其他方法

  - `init()`

    第一个执行的方法, 进行初始化操作，权限验证等
  - `$this->showJson(['data' => 'dataname'])`

    返回json数据, 自带`ret_code`, `ret_msg`

  - `$this->showJsonError('没有权限')`

    返回错误json信息, 自带`ret_code`, `ret_msg`,`err_msg`

  - `$this->showJsonSuccess('更新成功')`

      返回成功json信息, 自带`ret_code`, `ret_msg`,`err_msg`

  - `$this->display()`

    渲染action同名的模板

  - `$this->display('user')`

    渲染user.html模板, 默认模板后缀为.html， 可修改配置




#### 数据库模型

- *配置文件* `cfg/base.php`

  - 修改节点*components.db.mysql.config*节点 需要开启PDO_MYSQL扩展

  - 修改对应的参数 dsn: 连接字符（包含数据库名和端口号等）， user: 用户名， pass: 密码, prefix: 表前缀

- *数据库模型使用*

  - 新建模型文件    `ori/lib/model/Test.php`

```
  <?php
    namespace ori\lib\model;
    /**
     * Test model.
     */
    class Test extends \ar\core\model
    {
        // 表名
        public $tableName = 'test';

        // 插入一条数据
        public function addTest($data)
        {
              $add = self::model()->getDb()
                ->insert(array(
                'username' => 'ceshi',
              ));
              if ($add) {
                  return true;
              }
        }
    }
```
- **数据库常用操作**

  - 查询

    - 按条件查一行 , 查所有字段, 返回一维数组
    `\ori\lib\model\Test::model()->getDb()->where(['username' => 'ceshi'])->queryRow();`

    - 按条件查一行, 自定字段
    `\ori\lib\model\Test::model()->getDb()->select(['username', 'userid'])->where(['username' => 'ceshi'])->queryRow();`

    - 直接返回username列字符串
    `\ori\lib\model\Test::model()->getDb()->select(['username', 'userid'])->where(['username' => 'ceshi'])->queryColumn('username');`

    - 查所有, 返回二维数组, = where 传入空数组
    `\ori\lib\model\Test::model()->getDb()->queryAll();`

    - 按条件查所有, 返回二维数组
    `\ori\lib\model\Test::model()->getDb()->where(['username' => 'ceshi'])->queryAll();`

    - 按条件查所有 ,id 排序
    `\ori\lib\model\Test::model()->getDb()->where(['username' => 'ceshi'])->order('id desc')->queryAll();`

    - 按条件查所有 ,id 排序, id为键值
    `\ori\lib\model\Test::model()->getDb()->where(['username' => 'ceshi'])->order('id desc')->queryAll('id');`

    - 按条件查所有 id 排序, 最多10条，limit一般配合分页类
    `\ori\lib\model\Test::model()->getDb()->where(['username' => 'ceshi'])->order('id desc')->limit(10)->queryAll();`

    - 分组查询
    `\ori\lib\model\Test::model()->getDb()->where(['username' => 'ceshi'])->group('id')->queryAll();`

    - 联表查询，不推荐
    `\ori\lib\model\Test::model()->getDb()->where(['username' => 'ceshi'])->join|leftJoin|rightJoin('other table name')->queryAll();`


  - 修改
    - 条件修改username为chshi2, 返回影响行数
  `\ori\lib\model\Test::model()->getDb()->where(['username' => 'ceshi'])->update(['username' => 'ceshi2']);`

  - 添加

    - 插入数据 username为chshinew, 返回主键*last insert id*
    `\ori\lib\model\Test::model()->getDb()->insert(['username' => 'ceshinew']);`

    - 批量插入数据 , 返回boolean
    `\ori\lib\model\Test::model()->getDb()->batchInsert([['username' => 'ceshinew'], 'username' => 'hehe']]);`

  - 删除
    - 条件删除， 返回 boolean
    `\ori\lib\model\Test::model()->getDb()->where(['username' => 'ceshi'])->delete();`

*其他操作如跨库，多数据库，其他数据库类型等请加群讨论*


#### View(视图层)

* 模板使用变量
  - `{{C.PATH.GPUBLIC}}`
    assets目录

  - `{{C.PATH.PUBLIC}}`
    模块themes目录， 后台可以配置读取不同的theme，适合多风格模板切换改版
  - `{{date('Y-m-d, H:i:s', time())}}`  
    模板中出现括号“（）”字符， 将自动echo出来

  - `{{valueData}}`
    自动echo,  错误的写法 {{$valueData}}, 正确的是不加$的

* 模板标签
  - `<if exp="$zhangsan == '张三'">我是张三<else/>我是谁？</if>`
  if语句写法，exp里面完全是php代码

  - `<for exp="$i = 0; $i < 3; $i++">count: {{i}}</for>`
  for循环，exp里完全是php语法

  - `<for exp="$key in $actionData" as="item">{{item.dataname}}</for>`
  for循环2，actionData为后端分配过来变量 转换成foreach语法了

  - `<php>echo time(); </php>`  
    里面完全php代码， 不推荐

  - `<import from="要导入的文件" name="导入的具体名字标记">some extend string</import>`  
  导入模板，模板公用常用, extend 需要实现 export文件里的对应标记如:
```
    <import from="/Layout/global" name="html5">
        <extend name="title">
          {{welcomeTitle}},  this is html title
        </extend>
        <extend name="body">
        <h1>
            {{welcomeTitle}}, version: {{constant("AR_VERSION")}}
        </h1>
        </extend>
    </import>
```

  - `<export name="html5">some tpl string</export>`  导出模板如:
```
    <export name="html5">
    <html>
        <head>
        <title>
            <extend name="title"/>
        </title>
        <extend name="css"/>
        <extend name="jshead"/>
        </head>
        <body>
        <extend name="body"/>
        </body>
        <extend name="jsfoot"/>
    </html>
    </export>
```

#### 其他常用公共变量及方法

* 常用公共函数
  - `\ar\core\get()`  
    获取$_GET数据, 转义了一些原生过来的数据

  - `\ar\core\get('name')`  
    获取$_GET['name']数据

  - `\ar\core\post()`  
    获取$_POST数据

  - `\ar\core\request()`  
    获取$_REQUEST数据


* *comp*函数

  - `\ar\core\comp('lists.session')->set('uid', 1)`
    设置session

  - `\ar\core\comp('lists.session')->get('uid')`
    获取$_SESSION['uid']

  - `\ar\core\comp('lists.session')->flush()`
    清除session

  - `\ar\core\comp('cache.file')->set('uk', 123, 60)`
    文件类型，设置缓存uk = 123, 60秒后过期，为0 永不过期

  - `\ar\core\comp('cache.file')->get('uk')`
    文件类型获取缓存uk

  - `\ar\core\comp('tools.log')->record(['d' => 'dname'], 'logfile')`
    打日志，以日期目录可在data/log查看

  - `\ar\core\comp('tools.Util')->getClientIp()`
    获取客户端IP，

  - `\ar\core\comp('tools.Util')->substr_cut($str, $len, $charset="utf-8")`
    截取字符串， util其他函数可查看源文件

  - `\ar\core\comp('ext.upload')-upload($upField, $dest = '上传目标地址', $extension = 'all')`
    上传文件 ， upField post过来的文件标志id


* 获取配置 全局配置文件 `cfg/base.php , ar.ason`文件CONFIG 位置

  - `\ar\core\cfg()`  
    所有配置

  - `\ar\core\cfg('cfgkey0')`
    具体配置

  - `\ar\core\cfg('cfgkey0.subkey')`  
    子配置

  - `\ar\core\cfg('cfgkey0', 'defautValue')`
    具体配置, 如果未设置， 返回defaultValue

  - 获取路由参数

    - `\ar\core\cfg('requestRoute')`  
      用于动态配置信息，权限验证等


  - 动态设置配置

    `\ar\core\Ar::setConfig('hello', '周五')`

* 其他系统可配置的参数

  - `URL_MODE`  
    URL生成模式，默认PATH

  - `DEBUG_SHOW_TRACE`  
    URL生成模式，默认false

  - `URL_MODE`  
    URL生成模式，默认PATH

  - `DEBUG_LOG`
    错误日志写入文件， 需要AR_DEBUG=false

  - `TPL_SUFFIX`
    模板后缀，默认html

  - `URL_ROUTE_RULES`
    路由规则，群里讨论

  - `theme`
    主题， 默认def

  - `REBUILD_TPL_CACHE`
    是否每次重建模板缓存，默认true，建议在线上设置false，加快访问速度

  - `moduleLists`
    模块列表 默认['main'], 加入新的需要修改此处，可以在ar.ason配置

*说明：cfg/base.php 配置可以覆盖ar.ason配置，模块配置覆盖base配置*

* 全局常量
  - `AR_DEBUG`
  是否调试模式， 默认true

  - `AR_ROOT_PATH`  
  入口文件上级目录, 系统跟目录

  - `AR_ORI_NAME`  
  默认ori

  - `AR_ORI_PATH`
  ori目录， 建议的DocumentRoot, 网站根目录

  - `AR_SERVER_PATH`
  服务地址

  - `AR_DEFAULT_APP_NAME`
  默认访问模块名字，默认为main

  - `AR_DEFAULT_CONTROLLER`  
  默认为 Index

  - `AR_DEFAULT_ACTION`
  默认action 为index

* 链接生成

  - `\ar\core\url('otheraction')`
  生成otheraction路由请求地址

  - `\ar\core\url(['user/otheraction', ['uid' => 123]])`
  生成User/otheraction路由, 带参数uid = 123

  - `\ar\core\url(['/system/user/otheraction', ['uid' => 123]])`
  生成其他模块system 下面User/otheraction路由, 带参数uid = 123

  - `\ar\core\url(['user/otheraction', ['uid' => 123]], 'PATH|QUERY|FULL')`
  生成User/otheraction路由, 带参数uid = 123, 生成链接的形式， 默认PATH

  - `\ar\core\url(['user/otheraction', ['uid' => 123， 'greedyUrl' => true]])`
  生成User/otheraction路由, 带参数uid = 123, 生成链接的形式， 贪婪模式，保留之前请求的其他参数，筛选分类等常用

* 调用*module*

*一般比较公用各个模块都可以调用的方法， 相对于 service 是当前模块的调用*

  - `\ar\core\module('Test')->testFunc()`     ori\lib\module\Test.php  
  自定义类,  可以定义initModule() 每次调用初始化方法

* **访问路由说明**
  - `入口文件.php/modulename/contro/action`
    - 解释
      - *modulename* 模块    对应 *a_m*
      - *contro* 控制器名字   对应 *a_c*
      - *action* 里面的方法   对应 *a_a*