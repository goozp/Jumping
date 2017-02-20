# Jumping
基于bootstrap的wordpress主题，支持自适应。
WordPress theme build using bootstrap.

##主题特色
* 采用bootstrap构建
* 支持自适应，适配移动端设备
* 目前提供五个已有样式的侧边栏小工具：热门文章，最新文章，标签云，最新评论，归档
* 模板页面提供archives归档页，treeTime时间轴页面，myJob时间轴页面
* 底部footer提供普通和微信二维码两种方案
* 去除了加载Google Fonts，emoji表情等以优化速度
* 优化了Wordpress默认输出的 head 加载
* 暂时不支持后台更新

##主题说明
* 依赖插件：WP-PostViews（文章浏览量统计插件）
* 小图标：采用Font Awesome v4.7.0，具体图标对应class请前往官网查看。
* 发送邮件：评论回复邮件提醒功能采用了PHPMailer，发送邮件的设置可在主题设置中进行设置。

## 部分功能使用说明
1. 开始使用主题后请先在主题设置页面设置网站信息，非常重要，description和keywords一经设置最好少修改；并选择一款footer样式。
2. 右侧边栏的头像请直接替换public/images/jumbotron_self.png图片，并保持原来名字。（未来开放设置中心修改）
3. archives归档页使用：直接新建一个独立页面，模板选择Archive归档页面即可。
4. treeTime时间轴页使用：新建一个选择treeTime的归档页面，开放评论，但是内容需要在treeTime.php中自行修改，这可能需要你有一些html，css的基础。
5. myJOb时间轴页使用：新建一个选择myJob的归档页面，内容需要自行到myJob.php中修改，这可能需要你有一些html，css的基础。

##待完善
* 底部左侧空旷
* 侧边栏个人板块整合进主题设置
* 顶部导航一级栏目过多时样式会出现混乱
* Gravatar头像的优化
* 楼中楼评论时的用户体验

## V 1.1.0
* 优化Gravatar头像镜像