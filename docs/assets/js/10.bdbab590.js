(window.webpackJsonp=window.webpackJsonp||[]).push([[10],{300:function(a,s,t){"use strict";t.r(s);var e=t(14),r=Object(e.a)({},(function(){var a=this,s=a._self._c;return s("ContentSlotsDistributor",{attrs:{"slot-key":a.$parent.slotKey}},[s("h1",{attrs:{id:"安装维护"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#安装维护"}},[a._v("#")]),a._v(" 安装维护")]),a._v(" "),s("h2",{attrs:{id:"🍷-准备工作"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#🍷-准备工作"}},[a._v("#")]),a._v(" 🍷 准备工作")]),a._v(" "),s("ol",[s("li",[a._v("安装"),s("code",[a._v("docker")]),a._v("；"),s("a",{attrs:{href:"https://yeasy.gitbook.io/docker_practice/install/ubuntu#shi-yong-jiao-ben-zi-dong-an-zhuang",target:"_blank",rel:"noopener noreferrer"}},[a._v("参考文档"),s("OutboundLink")],1)])]),a._v(" "),s("div",{staticClass:"language-bash extra-class"},[s("pre",{pre:!0,attrs:{class:"language-bash"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[a._v("sudo")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("curl")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token parameter variable"}},[a._v("-fsSL")]),a._v(" https://get.docker.com "),s("span",{pre:!0,attrs:{class:"token operator"}},[a._v("|")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("bash")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token parameter variable"}},[a._v("-s")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("docker")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token parameter variable"}},[a._v("--mirror")]),a._v(" Aliyun\n"),s("span",{pre:!0,attrs:{class:"token comment"}},[a._v("# 启动docker")]),a._v("\n"),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("sudo")]),a._v(" systemctl "),s("span",{pre:!0,attrs:{class:"token builtin class-name"}},[a._v("enable")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("docker")]),a._v("\n"),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("sudo")]),a._v(" systemctl start "),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("docker")]),a._v("\n")])])]),s("ol",{attrs:{start:"2"}},[s("li",[a._v("安装"),s("code",[a._v("docker-compose")]),a._v("；"),s("a",{attrs:{href:"https://yeasy.gitbook.io/docker_practice/compose/install",target:"_blank",rel:"noopener noreferrer"}},[a._v("参考文档"),s("OutboundLink")],1)])]),a._v(" "),s("div",{staticClass:"language-bash extra-class"},[s("pre",{pre:!0,attrs:{class:"language-bash"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[a._v("sudo")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("curl")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token parameter variable"}},[a._v("-L")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token string"}},[a._v('"https://github.com/docker/compose/releases/download/v2.2.2/docker-compose-'),s("span",{pre:!0,attrs:{class:"token variable"}},[s("span",{pre:!0,attrs:{class:"token variable"}},[a._v("$(")]),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("uname")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token parameter variable"}},[a._v("-s")]),s("span",{pre:!0,attrs:{class:"token variable"}},[a._v(")")])]),a._v("-"),s("span",{pre:!0,attrs:{class:"token variable"}},[s("span",{pre:!0,attrs:{class:"token variable"}},[a._v("$(")]),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("uname")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token parameter variable"}},[a._v("-m")]),s("span",{pre:!0,attrs:{class:"token variable"}},[a._v(")")])]),a._v('"')]),a._v(" "),s("span",{pre:!0,attrs:{class:"token parameter variable"}},[a._v("-o")]),a._v(" /usr/local/bin/docker-compose\n"),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("sudo")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("chmod")]),a._v(" +x /usr/local/bin/docker-compose\n"),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("sudo")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("ln")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token parameter variable"}},[a._v("-s")]),a._v(" /usr/local/bin/docker-compose /usr/bin/docker-compose\n"),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("docker-compose")]),a._v(" version\n")])])]),s("h2",{attrs:{id:"🔨-一键部署"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#🔨-一键部署"}},[a._v("#")]),a._v(" 🔨 一键部署")]),a._v(" "),s("div",{staticClass:"language-bash extra-class"},[s("pre",{pre:!0,attrs:{class:"language-bash"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[a._v("git")]),a._v(" clone "),s("span",{pre:!0,attrs:{class:"token parameter variable"}},[a._v("-b")]),a._v(" deploy https://github.com/winterant/OnlineJudge.git\n"),s("span",{pre:!0,attrs:{class:"token builtin class-name"}},[a._v("cd")]),a._v(" OnlineJudge\n"),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("docker-compose")]),a._v(" up "),s("span",{pre:!0,attrs:{class:"token parameter variable"}},[a._v("-d")]),a._v("\n")])])]),s("ul",[s("li",[a._v("访问首页"),s("code",[a._v("http://ip:8080")]),a._v("；可在宿主机"),s("RouterLink",{attrs:{to:"/deploy/network.html"}},[a._v("配置域名")]),a._v("；")],1),a._v(" "),s("li",[a._v("默认管理员用户："),s("code",[a._v("admin")]),a._v("，默认密码"),s("code",[a._v("adminadmin")]),a._v("，务必更改默认密码；")])]),a._v(" "),s("h2",{attrs:{id:"🚗-升级"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#🚗-升级"}},[a._v("#")]),a._v(" 🚗 升级")]),a._v(" "),s("ul",[s("li",[a._v("版本内更新(docker tag不变)"),s("div",{staticClass:"language-bash extra-class"},[s("pre",{pre:!0,attrs:{class:"language-bash"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[a._v("docker-compose")]),a._v(" pull web judge-server\n"),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("docker-compose")]),a._v(" up "),s("span",{pre:!0,attrs:{class:"token parameter variable"}},[a._v("-d")]),a._v("\n")])])])]),a._v(" "),s("li",[a._v("跨版本升级"),s("br"),a._v("\n务必提前备份！获取稳定版本"),s("a",{attrs:{href:"https://github.com/winterant/LDUOnlineJudge/releases",target:"_blank",rel:"noopener noreferrer"}},[a._v("releases"),s("OutboundLink")],1),a._v("，解压后进入文件夹，一键部署即可。")])]),a._v(" "),s("h2",{attrs:{id:"💿-备份-迁移"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#💿-备份-迁移"}},[a._v("#")]),a._v(" 💿 备份/迁移")]),a._v(" "),s("h3",{attrs:{id:"备份"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#备份"}},[a._v("#")]),a._v(" 备份")]),a._v(" "),s("ol",[s("li",[a._v("将"),s("code",[a._v("docker-compose.yml")]),a._v("所在文件夹打包备份；"),s("div",{staticClass:"language-bash extra-class"},[s("pre",{pre:!0,attrs:{class:"language-bash"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[a._v("tar")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token parameter variable"}},[a._v("-cf")]),a._v(" - ./lduoj "),s("span",{pre:!0,attrs:{class:"token operator"}},[a._v("|")]),a._v(" pigz "),s("span",{pre:!0,attrs:{class:"token parameter variable"}},[a._v("-p")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token variable"}},[s("span",{pre:!0,attrs:{class:"token variable"}},[a._v("$(")]),a._v("nproc"),s("span",{pre:!0,attrs:{class:"token variable"}},[a._v(")")])]),a._v(" "),s("span",{pre:!0,attrs:{class:"token operator"}},[a._v(">")]),a._v(" lduoj_bak.tar.gz\n")])])])])]),a._v(" "),s("h3",{attrs:{id:"恢复"}},[s("a",{staticClass:"header-anchor",attrs:{href:"#恢复"}},[a._v("#")]),a._v(" 恢复")]),a._v(" "),s("ol",[s("li",[a._v("解压备份包"),s("div",{staticClass:"language-bash extra-class"},[s("pre",{pre:!0,attrs:{class:"language-bash"}},[s("code",[s("span",{pre:!0,attrs:{class:"token function"}},[a._v("tar")]),a._v(" "),s("span",{pre:!0,attrs:{class:"token parameter variable"}},[a._v("-zxvf")]),a._v(" lduoj_bak.tar.gz\n")])])])]),a._v(" "),s("li",[a._v("一键部署"),s("div",{staticClass:"language-bash extra-class"},[s("pre",{pre:!0,attrs:{class:"language-bash"}},[s("code",[s("span",{pre:!0,attrs:{class:"token builtin class-name"}},[a._v("cd")]),a._v(" lduoj_bak\n"),s("span",{pre:!0,attrs:{class:"token function"}},[a._v("docker-compose")]),a._v(" up "),s("span",{pre:!0,attrs:{class:"token parameter variable"}},[a._v("-d")]),a._v("\n")])])])])])])}),[],!1,null,null,null);s.default=r.exports}}]);