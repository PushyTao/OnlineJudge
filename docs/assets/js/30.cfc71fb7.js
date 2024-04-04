(window.webpackJsonp=window.webpackJsonp||[]).push([[30],{333:function(v,_,e){"use strict";e.r(_);var a=e(14),t=Object(a.a)({},(function(){var v=this,_=v._self._c;return _("ContentSlotsDistributor",{attrs:{"slot-key":v.$parent.slotKey}},[_("h1",{attrs:{id:"功能介绍"}},[_("a",{staticClass:"header-anchor",attrs:{href:"#功能介绍"}},[v._v("#")]),v._v(" 功能介绍")]),v._v(" "),_("h2",{attrs:{id:"🏠-首页"}},[_("a",{staticClass:"header-anchor",attrs:{href:"#🏠-首页"}},[v._v("#")]),v._v(" 🏠 首页")]),v._v(" "),_("p",[v._v("首页可以显示公告列表、提交记录曲线、本周和上周的top10用户。\n本周top10是指自本周一0点起至此时此刻，解决问题数量最多的10位用户。\n上周top10是指上周一0点至上周日24点，解决问题数量最多的10位用户。")]),v._v(" "),_("h2",{attrs:{id:"🖍-评测-提交记录"}},[_("a",{staticClass:"header-anchor",attrs:{href:"#🖍-评测-提交记录"}},[v._v("#")]),v._v(" 🖍 评测（提交记录）")]),v._v(" "),_("p",[v._v("以列表的形式展示所有的提交记录。注意，普通用户只能看到题库中的题目的提交记录，而无法看到竞赛中的提交记录；而管理员用户可以看到全量的提交记录。\n该页面可以自动刷新最新的评测结果，用户无需手动刷新网页。")]),v._v(" "),_("h2",{attrs:{id:"📜-题库"}},[_("a",{staticClass:"header-anchor",attrs:{href:"#📜-题库"}},[v._v("#")]),v._v(" 📜 题库")]),v._v(" "),_("p",[v._v("包含所有题目。普通用户只能看到非隐藏题目。管理员添加题目时可选择公开或隐藏题目（默认隐藏）。\n题目唯一编号（题号）默认起始于1000，管理员添加题目自动生成（自增），无法修改，无法自定义。\n对于每道题目，出题人应当设置以下属性：")]),v._v(" "),_("ul",[_("li",[v._v("标题（必需）")]),v._v(" "),_("li",[v._v("题目描述（必需）")]),v._v(" "),_("li",[v._v("输入描述、输出描述、提示、题目来源（均为可选项）")]),v._v(" "),_("li",[v._v("时间限制（必需，默认1000MS），对于C/C++之外的语言，判题服务自动放宽至2倍")]),v._v(" "),_("li",[v._v("空间限制（必需，默认64MB），对于C/C++之外的语言，判题服务自动放宽至2倍")]),v._v(" "),_("li",[v._v("样例（可选项），向选手提供若干组示例以帮助选手准确的理解题目")]),v._v(" "),_("li",[v._v("特判（可选项），参考"),_("RouterLink",{attrs:{to:"/web/spj.html"}},[v._v("特判说明")])],1)]),v._v(" "),_("h3",{attrs:{id:"测试数据"}},[_("a",{staticClass:"header-anchor",attrs:{href:"#测试数据"}},[v._v("#")]),v._v(" 测试数据")]),v._v(" "),_("p",[v._v("对于每道题目，出题人必需上传测试数据。测试数据必需成对出现，以后缀来区分输入和输出。")]),v._v(" "),_("ul",[_("li",[_("code",[v._v("data.in")]),v._v(","),_("code",[v._v("data.out")]),v._v(" 这是一组合法的测试数据")]),v._v(" "),_("li",[_("code",[v._v("1.in")]),v._v(","),_("code",[v._v("1.ans")]),v._v(" 这也是一组合法的测试数据")])]),v._v(" "),_("h3",{attrs:{id:"问题标签"}},[_("a",{staticClass:"header-anchor",attrs:{href:"#问题标签"}},[v._v("#")]),v._v(" 问题标签")]),v._v(" "),_("p",[v._v("对于每道题目，若当前用户已通过，将被邀请填写题目标签，来标记这道题目所涉及的知识点。")]),v._v(" "),_("h3",{attrs:{id:"其它功能"}},[_("a",{staticClass:"header-anchor",attrs:{href:"#其它功能"}},[v._v("#")]),v._v(" 其它功能")]),v._v(" "),_("ol",[_("li",[v._v("重判；管理员可以重判某些提交记录，可根据提交编号、题目编号、竞赛编号、时间区间这些选项来筛选提交记录并重判；")]),v._v(" "),_("li",[v._v("导入与导出；管理员可以以"),_("code",[v._v("xml")]),v._v("文件的方式导入或导出若干个题目；注意，不宜一次性导出大量题目，因为文件太大而无法生成。")])]),v._v(" "),_("h2",{attrs:{id:"🏆-竞赛"}},[_("a",{staticClass:"header-anchor",attrs:{href:"#🏆-竞赛"}},[v._v("#")]),v._v(" 🏆 竞赛")]),v._v(" "),_("p",[v._v("也可称为“作业”，包含所有竞赛。普通用户只能看到公开，且所在类别也公开的竞赛。\n竞赛唯一编号默认起始于1000，管理员添加竞赛时自动生成（自增），无法修改，无法自定义。\n对于每个竞赛，管理员可以设置以下属性：")]),v._v(" "),_("ul",[_("li",[v._v("竞赛类别（必需，默认不分类且前台无法看到）")]),v._v(" "),_("li",[v._v("标题（必需）")]),v._v(" "),_("li",[v._v("描述信息（可选）")]),v._v(" "),_("li",[v._v("附件（可选，创建者可以上传一些必要的文件）")]),v._v(" "),_("li",[v._v("比赛时间（必需）")]),v._v(" "),_("li",[v._v("封榜比例（必需，默认0），规定比赛结尾不刷新榜单的时间；例如封榜比例为 0.2 则表示比赛时间进行到80%时将冻结榜单，不再向选手展示最新的排名情况，但管理员仍可查看最新榜单")]),v._v(" "),_("li",[v._v("参赛方式\n"),_("ul",[_("li",[_("code",[v._v("public")]),v._v(" 所有能在看台看到该竞赛的人，皆可参与")]),v._v(" "),_("li",[_("code",[v._v("password")]),v._v(" 选择此模式，必需设置密码；任何人进入竞赛，必需正确输入参赛密码")]),v._v(" "),_("li",[_("code",[v._v("private")]),v._v(" 选择此模式，只有指定的用户可以进入竞赛")])])]),v._v(" "),_("li",[v._v("竞赛题目\n"),_("ul",[_("li",[v._v("题目列表；必需使用题目唯一编号（题号）来指定")]),v._v(" "),_("li",[v._v("编程语言；参赛选手只能使用创建者指定的语言来提交代码")]),v._v(" "),_("li",[v._v("榜单类型；"),_("code",[v._v("ACM")]),v._v("或"),_("code",[v._v("OI")])]),v._v(" "),_("li",[v._v("公开榜单；创建者可以设定是否将榜单公开在网络上")])])])]),v._v(" "),_("p",[v._v("其它功能：在后台竞赛列表中，当管理员切换到某个具体的类别时，可以改变排列顺序。")]),v._v(" "),_("h3",{attrs:{id:"竞赛类别"}},[_("a",{staticClass:"header-anchor",attrs:{href:"#竞赛类别"}},[v._v("#")]),v._v(" 竞赛类别")]),v._v(" "),_("p",[v._v("每个竞赛都拥有一个唯一的类别（若没设置则默认不分类）。前台查看竞赛时，已设为公开的类别将展示在导航菜单中，并展示该类别下的所有非隐藏竞赛。")]),v._v(" "),_("ul",[_("li",[v._v("名称")]),v._v(" "),_("li",[v._v("父类别（默认一级类别）")]),v._v(" "),_("li",[v._v("类别简介")])]),v._v(" "),_("p",[v._v("其它功能：在类别列表中，当管理员切换到某个具体的类别时，可以改变排列顺序。")]),v._v(" "),_("h2",{attrs:{id:"👨‍👨‍👦-群组"}},[_("a",{staticClass:"header-anchor",attrs:{href:"#👨‍👨‍👦-群组"}},[v._v("#")]),v._v(" 👨‍👨‍👦 群组")]),v._v(" "),_("p",[v._v("类似于“班级”、“课程”等概念。")]),v._v(" "),_("p",[v._v("在实际教学、ACM集训中，某一门课程可能包含若干课时（例如32课时），每一课时都有对应的作业（竞赛），那么这些作业非常适合收集起来，提供给一批用户使用。\n对于每个团队，创建者可以设定以下属性：")]),v._v(" "),_("ul",[_("li",[v._v("标题（必需），可填写课程名")]),v._v(" "),_("li",[v._v("课程简介（可选）")]),v._v(" "),_("li",[v._v("作业列表（竞赛编号列表）")])]),v._v(" "),_("p",[v._v("此外，管理员可以对团队成员进行管理。")]),v._v(" "),_("h2",{attrs:{id:"🧑‍✈️-权限管理"}},[_("a",{staticClass:"header-anchor",attrs:{href:"#🧑‍✈️-权限管理"}},[v._v("#")]),v._v(" 🧑‍✈️ 权限管理")]),v._v(" "),_("p",[v._v("采用laravel第三方拓展包spatie/laravel-permission作为权限管理支持。该拓展包含以下数据表；")]),v._v(" "),_("ul",[_("li",[v._v("permissions —— 权限表；")]),v._v(" "),_("li",[v._v("roles —— 角色表；")]),v._v(" "),_("li",[v._v("role_has_permissions —— 角色-权限关联表，某角色所拥有的角色，一个角色能拥有多个权限；")]),v._v(" "),_("li",[v._v("model_has_permissions —— 模型-权限关联表，某用户所拥有的权限，一个用户能拥有多个权限；")]),v._v(" "),_("li",[v._v("model_has_roles —— 模型-角色关联表，某用户所拥有的角色，一个用户能拥有多个角色；\n可以看出，该拓展允许用户跳过角色，直接拥有权限。用户-角色-权限之间的关系是多对多对多，即一个用户可拥有多个角色，一个角色包含若干条权限；反之，一个权限可包含于多个角色，一个角色可以应用于多个用户。")])]),v._v(" "),_("h3",{attrs:{id:"权限命名原则-permissions表的权限"}},[_("a",{staticClass:"header-anchor",attrs:{href:"#权限命名原则-permissions表的权限"}},[v._v("#")]),v._v(" 权限命名原则（permissions表的权限）")]),v._v(" "),_("p",[v._v("基于"),_("a",{attrs:{href:"https://github.com/spatie/laravel-permission",target:"_blank",rel:"noopener noreferrer"}},[v._v("spatie/laravel-permission"),_("OutboundLink")],1),v._v("支持通配符匹配（详情），我们以.符号对权限进行分层，基本权限命名的基本格式为"),_("code",[v._v("admin.{resource}.{action}.{target}")]),v._v("。\n对于通配符*，需要特别注意：")]),v._v(" "),_("blockquote",[_("p",[v._v("The "),_("code",[v._v("*")]),v._v(' means "ALL". It does not mean "ANY".'),_("br"),v._v("\nThus "),_("code",[v._v("can('post.*')")]),v._v(" will only pass if the user has been assigned "),_("code",[v._v("post.*")]),v._v(" explicitly.")])]),v._v(" "),_("p",[v._v("意思是说，查询权限"),_("code",[v._v("*")]),v._v("时匹配的是“所有”（全部满足），而不是存在“任意一个”就够了。因此，当调用"),_("code",[v._v("can('post.*')")]),v._v("查询权限时，用户必须拥有权限"),_("code",[v._v("post.*")]),v._v("才能返回"),_("code",[v._v("true")]),v._v("。而当调用"),_("code",[v._v("can('post.a')")]),v._v("查询权限时，存在权限"),_("code",[v._v("post.a")]),v._v("或"),_("code",[v._v("post.*")]),v._v("则返回"),_("code",[v._v("true")]),v._v("。")]),v._v(" "),_("p",[v._v("以“公告”为例（其他权限只需将notice改为对应的单词），其增删改查权限是固有的：")]),v._v(" "),_("ul",[_("li",[_("code",[v._v("admin.notice.create")]),v._v("创建公告；")]),v._v(" "),_("li",[_("code",[v._v("admin.notice.delete")]),v._v("删除公告；")]),v._v(" "),_("li",[_("code",[v._v("admin.notice.update")]),v._v("修改公告；")]),v._v(" "),_("li",[_("code",[v._v("admin.notice.view")]),v._v("查看公告（仅针对隐藏的公告）；")]),v._v(" "),_("li",[_("code",[v._v("admin.notice")]),v._v("等价于"),_("code",[v._v("admin.notice.*")]),v._v("，即匹配以上所有权限；")]),v._v(" "),_("li",[_("code",[v._v("admin")]),v._v("等价于"),_("code",[v._v("admin.*")]),v._v("，即超级管理员；")])]),v._v(" "),_("h3",{attrs:{id:"开发约定"}},[_("a",{staticClass:"header-anchor",attrs:{href:"#开发约定"}},[v._v("#")]),v._v(" 开发约定")]),v._v(" "),_("p",[v._v("为了提高系统安全性、易用性，我们做以下约定：")]),v._v(" "),_("ul",[_("li",[v._v("用户必须通过“角色”获得相关权限，而不能直接获得权限。也就是说，此时"),_("code",[v._v("model_has_permissions")]),v._v("表是不使用的。例如用户"),_("code",[v._v("admin")]),v._v("想要成为超级管理员，应当拥有角色"),_("code",[v._v("administrator")]),v._v("，而角色"),_("code",[v._v("administrator")]),v._v("收录所有权限；")]),v._v(" "),_("li",[v._v("普通用户默认视为学生，无需分配任何角色；")])]),v._v(" "),_("h3",{attrs:{id:"对公告、题库、竞赛等模块的影响"}},[_("a",{staticClass:"header-anchor",attrs:{href:"#对公告、题库、竞赛等模块的影响"}},[v._v("#")]),v._v(" 对公告、题库、竞赛等模块的影响")]),v._v(" "),_("p",[v._v("以“公告”为例（题库、竞赛等同理），权限判断遵循以下原则：")]),v._v(" "),_("ul",[_("li",[v._v("创建公告；管理员的角色中，存在权限"),_("code",[v._v("admin.notice.create")]),v._v("或更高；")]),v._v(" "),_("li",[v._v("删除/修改公告；角色中存在权限"),_("code",[v._v("admin.notice.delete")]),v._v("/"),_("code",[v._v("admin.notice.update")]),v._v("或更高，"),_("strong",[v._v("或者自己是创建者")]),v._v("；")]),v._v(" "),_("li",[v._v("查看公告；\n"),_("ul",[_("li",[v._v("对于隐藏的条目，角色中存在权限"),_("code",[v._v("admin.notice.view")]),v._v("或更高，"),_("strong",[v._v("或者自己是创建者")]),v._v("；")]),v._v(" "),_("li",[v._v("对于前台公开的条目，不检查权限，即任意用户可获取；")])])])]),v._v(" "),_("h3",{attrs:{id:"角色配置技巧"}},[_("a",{staticClass:"header-anchor",attrs:{href:"#角色配置技巧"}},[v._v("#")]),v._v(" 角色配置技巧")]),v._v(" "),_("p",[v._v("如果希望某角色，能够创建公告，能够浏览所有公告，但只允许修改/删除自己创建的公告，则只需给该角色分配以下权限：")]),v._v(" "),_("ul",[_("li",[_("code",[v._v("admin.view")]),v._v("；使用户能够进入后台管理页面；")]),v._v(" "),_("li",[_("code",[v._v("admin.notice.view")])]),v._v(" "),_("li",[_("code",[v._v("admin.notice.create")])])])])}),[],!1,null,null,null);_.default=t.exports}}]);