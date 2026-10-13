---
theme: apple-basic
title: Web服务构建与抓包入门
info: |
  ## Web服务构建与抓包入门
  从最简单的 web 服务搭建，到用 Yakit 抓取真实流量
class: text-center
colorSchema: dark
highlighter: shiki
lineNumbers: false
drawings:
  persist: false
transition: slide-left
mdc: true
layout: intro
fonts:
  sans: 'Inter, "Noto Sans SC"'
  serif: '"Noto Serif SC"'
  mono: '"JetBrains Mono", "Noto Sans Mono CJK SC"'
---

<div class="cover-grid">
<div>
<div class="cover-eyebrow">WEB DEVELOPMENT & TRAFFIC ANALYSIS</div>
<h1 class="cover-title">Web 服务构建<br>与<span>抓包入门</span></h1>
<div class="cover-description">从最简单的 Web 服务搭建，<br>到用 Yakit 抓取真实流量。</div>
<div class="cover-tags"><span>PHP</span><span>HTTP</span><span>YAKIT</span></div>
</div>
<div class="cover-terminal">
<div class="terminal-bar"><i></i><i></i><i></i><span>request → response</span></div>
<div class="terminal-content">
<div class="accent">$ php -S 127.0.0.1:8000</div>
<div>Development Server started</div>
<div class="terminal-divider"></div>
<div class="accent">GET /index.php?name=Alice</div>
<div>Host: 127.0.0.1:8000</div>
<div class="terminal-divider"></div>
<div class="success">HTTP/1.1 200 OK</div>
<div>&lt;h1&gt;你好，Alice！&lt;/h1&gt;</div>
</div>
</div>
</div>
<div class="cover-meta">b1ank / 2026.10.18</div>

<!--
一小时课程。课前：讲师准备 PHP，学生准备 Yakit 与 Chrome。讲师备用本地示例，外网不可用时仍可完成讲解。
-->

---
layout: default
---

# 内容速览

<div class="mt-10 grid grid-cols-3 gap-5">
<div class="p-6 rounded-xl border border-blue-400/30 bg-blue-400/5">
<div class="text-blue-400 text-sm">01 </div>
<div class="mt-4 text-xl">运行一个 PHP 网页</div>
<div class="mt-3 text-sm opacity-60">知道地址、端口与文件的关系</div>
</div>
<div class="p-6 rounded-xl border border-purple-400/30 bg-purple-400/5">
<div class="text-purple-400 text-sm">02 </div>
<div class="mt-4 text-xl">读懂请求与响应</div>
<div class="mt-3 text-sm opacity-60">找到路径、参数、状态码与正文</div>
</div>
<div class="p-6 rounded-xl border border-green-400/30 bg-green-400/5">
<div class="text-green-400 text-sm">03 </div>
<div class="mt-4 text-xl">用 Yakit 观察流量</div>
<div class="mt-3 text-sm opacity-60">配置代理，抓到并解释一次访问</div>
</div>
</div>

<!--
第 0–2 分钟。介绍目标与节奏。Yakit、Chrome 建议课前安装完成，PHP 演示由讲师完成，避免全员安装占用课堂时间。
-->

---
layout: default
---

# 上回书说到……

<div class="mt-10 pl-5 border-l-2 border-white/30 text-xl leading-relaxed opacity-80">互联网把设备连接起来，Web 服务通过地址和端口接收请求。</div>

<div class="mt-12 grid grid-cols-3 gap-5 text-center">
<div class="p-6 rounded-xl border border-white/15">浏览器<div class="mt-3 text-sm opacity-50">发出请求</div></div>
<div class="p-6 rounded-xl border border-blue-400/30 text-blue-400">HTTP<div class="mt-3 text-sm opacity-70">请求 → / ← 响应</div></div>
<div class="p-6 rounded-xl border border-white/15">Web 服务器<div class="mt-3 text-sm opacity-50">处理并返回内容</div></div>
</div>

<div v-click class="mt-12 text-lg opacity-80">打开一个网页，就是从这里开始的一次通信。</div>

<!--
第 2–5 分钟。提问：浏览器输入网址后，谁向谁发送了什么？本节只解释应用层通信，不展开 DNS、TCP。
-->

---
layout: section
---

<div class="text-sm tracking-widest opacity-40 mb-4">PART 01 </div>

# 构建 Web 服务

<div class="mt-6 opacity-60">从一个文件，到一个可以访问的网页</div>

<!--
第 5 分钟。切换终端和编辑器，使用 demo/index.php。
-->

---
layout: default
---

# 一个最小的 PHP 网页

把下面的代码保存为 `index.php`：

```php
<?php
header('Content-Type: text/html; charset=utf-8');
$name = $_GET['name'] ?? '同学';
$safeName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
?>
<h1>你好，<?= $safeName ?>！</h1>
<p>这是我们自己的 Web 服务。</p>
```

<div class="mt-8 pl-5 border-l-2 border-blue-400/40 opacity-70">URL 中的 <code>name</code> 参数，会影响服务器返回的页面内容。</div>

<!--
第 5–9 分钟。展示 demo/index.php。解释默认值与输出，转义仅一句带过，不讲 PHP 语法细节。先让学生预测 name=Alice 会看到什么。
-->

---
layout: default
---

# 启动服务，再用浏览器访问

在 `index.php` 所在目录执行：

```bash
php -S 127.0.0.1:8000
```

浏览器打开：

```text
http://127.0.0.1:8000/index.php?name=Alice
```

<div class="mt-8 grid grid-cols-2 gap-5 text-sm">
<div class="p-5 rounded-xl border border-blue-400/25">终端：出现访问日志<br><span class="opacity-60">服务运行时保持终端开启，Ctrl+C 停止</span></div>
<div class="p-5 rounded-xl border border-green-400/25">浏览器：显示“你好，Alice！”<br><span class="opacity-60">把 Alice 改成自己的名字，再刷新</span></div>
</div>

<div class="mt-6 text-sm opacity-50">PHP 内置服务器适合开发与课堂演示。</div>

<!--
第 9–13 分钟。运行 php -S 127.0.0.1:8000 -t demo（从项目根目录运行时）。并排展示浏览器与终端。修改参数，观察页面和日志变化。
-->

---
layout: default
---

# 这个地址里，每一段是什么？

```text
http://127.0.0.1:8000/index.php?name=Alice
```

<div class="mt-8 text-base">

| 部分 | 含义 |
| --- | --- |
| `http://` | 通信协议 |
| `127.0.0.1` | 本机回环地址，指向访问者自己的电脑 |
| `8000` | 服务监听的端口 |
| `/index.php` | 请求路径 |
| `?name=Alice` | 查询参数，多个参数用 `&` 连接 |

</div>

<div v-click class="mt-6 text-sm text-blue-400">0.0.0.0 是监听所有 IPv4 网卡的地址；浏览器应访问实际 IP 或本机地址。</div>

<!--
第 13–17 分钟。区分监听地址与访问地址。学生电脑上的 127.0.0.1 不会指向讲师电脑。提问：只改端口能否访问同一个服务？结束搭建部分。
-->

---
layout: section
---

<div class="text-sm tracking-widest opacity-40 mb-4">PART 02 </div>

# 什么是 HTTP

<div class="mt-6 opacity-60">先看请求，再看响应</div>

<!--
第 17 分钟。提醒以下使用 HTTP/1.1 文本形式讲解，工具可能把其他版本流量展示为类似形式。
-->

---
layout: default
---

# 请求报文：浏览器在说什么？

```http
GET /index.php?name=Alice HTTP/1.1
Host: 127.0.0.1:8000
User-Agent: Mozilla/5.0
Accept: text/html

```

<div class="mt-10 grid grid-cols-3 gap-5 text-center">
<div class="p-5 rounded-xl border border-green-400/30">请求行<div class="mt-3 text-sm opacity-60">方法 · 路径 · 版本</div></div>
<div class="p-5 rounded-xl border border-blue-400/30">请求头<div class="mt-3 text-sm opacity-60">目标与客户端信息</div></div>
<div class="p-5 rounded-xl border border-purple-400/30">空行之后<div class="mt-3 text-sm opacity-60">可选的请求正文</div></div>
</div>

<div class="mt-7 text-sm opacity-50">这是简化的教学报文；本次 GET 请求没有请求正文。</div>

<!--
第 17–20 分钟。和刚才浏览器地址对应起来。强调空行用于分隔头部与正文，不逐个讲所有浏览器请求头。
-->

---
layout: default
---

# 请求行：方法 + 路径 + 版本

```http
GET /index.php?name=Alice HTTP/1.1
```

<div class="mt-10 grid grid-cols-3 gap-5 text-center">
<div class="p-6 rounded-xl border border-green-400/30 bg-green-400/5"><div class="text-xl text-green-400">GET</div><div class="mt-3 text-sm opacity-60">请求获取资源</div></div>
<div class="p-6 rounded-xl border border-blue-400/30 bg-blue-400/5"><div class="text-lg text-blue-400">/index.php?name=Alice</div><div class="mt-3 text-sm opacity-60">访问哪里，带什么参数</div></div>
<div class="p-6 rounded-xl border border-purple-400/30 bg-purple-400/5"><div class="text-xl text-purple-400">HTTP/1.1</div><div class="mt-3 text-sm opacity-60">报文使用的协议版本</div></div>
</div>

<div v-click class="mt-10 opacity-75">参数在请求里传给服务器，页面变化出现在响应里。</div>

<!--
第 20–22 分钟。让学生指出参数名称和参数值；预测修改 name 后请求中哪一部分发生变化。
-->

---
layout: default
---

# GET 与 POST：参数还可以放在哪里？

<div class="grid grid-cols-2 gap-6 mt-8">
<div>
<div class="text-blue-400 mb-4">GET：这个例子把参数放在 URL</div>

```http
GET /index.php?name=Alice HTTP/1.1
Host: 127.0.0.1:8000

```

</div>
<div>
<div class="text-purple-400 mb-4">POST：这个例子把参数放在正文</div>

```http
POST /submit.php HTTP/1.1
Host: 127.0.0.1:8000
Content-Type: application/x-www-form-urlencoded
Content-Length: 10

name=Alice
```

</div>
</div>

<div class="mt-8 pl-5 border-l-2 border-yellow-400/40 text-sm opacity-75">POST 也可以带查询参数；参数放在正文里，并不等于加密。</div>

<div class="mt-5 text-sm opacity-50">右侧仅展示报文结构，本次演示不需要创建 submit.php。</div>

<!--
第 22–24 分钟。强调方法与参数位置不是一一对应，不讲请求走私、编码细节。
-->

---
layout: default
---

# 关键请求头：先认这几个

<div class="mt-8 text-base">

| 请求头 | 看什么 |
| --- | --- |
| `Host` | 请求的主机与端口 |
| `User-Agent` | 客户端声明的浏览器与系统信息，可修改 |
| `Referer` | 请求来源页面，可能缺失或被裁剪 |
| `Cookie` | 客户端发送的状态信息，部分用于会话识别 |
| `Content-Type` | 请求正文的格式，如表单或 JSON |

</div>

<div v-click class="mt-8 pl-5 border-l-2 border-blue-400/40 opacity-75">抓包时要注意：访问哪里？传了什么？携带了哪些状态信息？</div>

<!--
第 24–27 分钟。说明不是每个请求都有这些头，也不是所有 Cookie 都表示登录。不要把 User-Agent 当作可靠身份凭证。
-->

---
layout: default
---

# 响应报文：服务器返回了什么？

```http
HTTP/1.1 200 OK
Content-Type: text/html; charset=utf-8

<h1>你好，Alice！</h1>
<p>这是我们自己的 Web 服务。</p>
```

<div class="mt-9 grid grid-cols-3 gap-5 text-center">
<div class="p-5 rounded-xl border border-green-400/30">状态行<div class="mt-3 text-sm opacity-60">版本 · 状态码 · 描述</div></div>
<div class="p-5 rounded-xl border border-blue-400/30">响应头<div class="mt-3 text-sm opacity-60">内容格式等元信息</div></div>
<div class="p-5 rounded-xl border border-purple-400/30">响应正文<div class="mt-3 text-sm opacity-60">HTML、JSON、图片等内容</div></div>
</div>

<div class="mt-6 text-sm opacity-50">简化示例：浏览器渲染后的页面，与原始响应正文是两种查看方式。</div>

<!--
第 27–30 分钟。返回浏览器，解释 HTML 标签为何没有直接显示。对照参数 Alice 与正文 Alice。
-->

---
layout: default
---

# 状态码：先判断结果，再看正文

<div class="mt-10 text-lg">

| 状态码 | 常见含义 | 接下来观察什么 |
| --- | --- | --- |
| `200` | 请求成功 | 正文是否是预期内容 |
| `302` | 临时重定向 | `Location` 指向哪里 |
| `404` | 找不到资源 | 路径、文件名是否正确 |
| `500` | 服务器内部错误 | 服务端日志与错误信息 |

</div>

<!--
第 30–32 分钟。讲师访问不存在的文件展示 404。强调 HTTP 200 不一定意味着业务成功，仍要查看正文。
-->

---
layout: section
---

<div class="text-sm tracking-widest opacity-40 mb-4">PART 03 </div>

# Yakit

<!--
第 32 分钟。准备 Yakit，学生打开已安装的客户端。
-->

---
layout: default
---

# Yakit 在通信中的什么位置？

<div class="flow-diagram mt-12 flex items-center justify-center gap-5 text-center">
<div class="p-7 rounded-xl border border-white/20">浏览器<div class="mt-3 text-xs opacity-50">代理指向 Yakit</div></div>
<div class="text-blue-400 text-2xl">⇄</div>
<div class="p-7 rounded-xl border border-purple-400/40 bg-purple-400/5">Yakit<div class="mt-3 text-xs opacity-60">记录请求与响应</div></div>
<div class="text-blue-400 text-2xl">⇄</div>
<div class="p-7 rounded-xl border border-white/20">Web 服务器<div class="mt-3 text-xs opacity-50">处理并返回结果</div></div>
</div>

<div class="mt-12 pl-5 border-l-2 border-blue-400/40 opacity-75">本课的“抓包”通过 HTTP 代理观察通信；浏览器流量需要经过这个代理。</div>

<div class="mt-7 text-sm opacity-50">Yakit / Burp Suite 常用于 Web 代理分析；Wireshark 常用于网络数据包分析。</div>

<!--
第 32–35 分钟。指出请求和响应都经过 Yakit。解释代理端口不是 PHP 服务端口。
-->

---
layout: default
---

#  HTTP 与 HTTPS

<div class="mt-10 grid grid-cols-2 gap-6">
<div class="p-7 rounded-xl border border-blue-400/30 bg-blue-400/5">
<div class="text-xl text-blue-400">HTTP · 本地演示</div>
<div class="mt-5 opacity-75">此次新生赛使用</div>
<div class="mt-5 text-sm opacity-50">目标：127.0.0.1:8000</div>
</div>
<div class="p-7 rounded-xl border border-purple-400/30 bg-purple-400/5">
<div class="text-xl text-purple-400">HTTPS </div>
<div class="mt-5 opacity-75">通信使用 TLS 加密，代理查看明文需要浏览器配合信任。</div>
<div class="mt-5 text-sm opacity-50">外部浏览器通常需要配置 Yakit CA 证书</div>
</div>
</div>

<div class="mt-9 text-sm opacity-60">需要注意的是，本地抓取127.0.0.1流量时，需要检查浏览器的 network.proxy.allow_hijacking_localhost 配置，才能抓取本地流量</div>

<!--
第 35–37 分钟。根据 Yakit 官方文档解释免配置模式与外部浏览器差别。不要指导学生全局关闭证书校验。
-->

---
layout: default
---

# 推荐路径：免配置浏览器

<div class="mt-10 text-lg leading-loose">

1. 打开 Yakit 的 **MITM** 模块并启动监听
2. 查看监听地址和端口，打开**自动放行**
3. 点击**免配置启动**，使用新打开的 Chrome
4. 在这个浏览器里访问目标页面
5. 在请求历史列表中选择记录，查看请求和响应

</div>

<div class="mt-9 p-5 rounded-xl border border-green-400/25 text-sm opacity-75">常见监听地址为 127.0.0.1:8083，以当前界面实际值为准。</div>

<div class="mt-5 text-sm opacity-50">按钮名称可能随版本变化。使用普通浏览器窗口访问，不一定会经过 Yakit。</div>

<!--
第 37–40 分钟。投屏操作，等待学生进入相同界面。自动放行避免新手请求被暂停。官方参考：https://yaklang.io/products/chapter-3/3-2/ 。
-->

---
layout: default
---

# 使用自己的浏览器：手动配置

<div class="mt-8 grid grid-cols-2 gap-6">
<div class="p-6 rounded-xl border border-blue-400/25">
<div class="text-blue-400 mb-4">① 代理/代理插件</div>
<div class="text-base leading-loose">让浏览器的 HTTP / HTTPS 代理<br>指向 Yakit 的监听地址和端口。</div>
<div class="mt-5 text-sm opacity-60">例如：127.0.0.1:8083<br>检查“本地地址不走代理”等例外规则。</div>
</div>
<div class="p-6 rounded-xl border border-purple-400/25">
<div class="text-purple-400 mb-4">② HTTPS 证书</div>
<div class="text-base leading-loose">从 Yakit 下载 CA 证书，<br>按浏览器要求导入并信任。</div>
<div class="mt-5 text-sm opacity-60">完成后重新访问 HTTPS 页面。<br>HTTP 本地演示和免配置启动不需要此步骤。</div>
</div>
</div>

<div class="mt-8 text-sm opacity-60">课堂优先走免配置路径；手动配置可作为备用方案。结束后恢复原代理设置。</div>

<!--
第 40–42 分钟。只简述备用路径，不逐个操作系统演示。localhost / 127.0.0.1 可能绕过代理，免配置窗口也应现场确认；如本地抓包失败，用排障页 curl 命令明确走代理。
-->

---
layout: default
---

# 课堂操作：抓到我们自己的请求

```text
http://127.0.0.1:8000/index.php?name=Alice
```

<div class="mt-8 text-lg leading-loose">

1. 在 Yakit 启动的浏览器里访问上面的地址
2. 按主机或 URL 筛选，找到 `index.php` 请求
3. 看请求：方法、路径、`name` 参数
4. 看响应：状态码、`Content-Type`、正文
5. 把 `Alice` 改成 `Bob`，比较两次记录

</div>

<div class="mt-7 text-blue-400">成功标志：请求里的 name=Bob，对应响应里的“你好，Bob！”</div>

<!--
第 42–48 分钟。学生有 PHP 可自己启动；否则观察讲师本地示例，学生在下页操作百度。预留 2 分钟排障。本地代理绕过时先用 curl 生成明确代理请求。
-->

---
layout: default
---

# 真实网站：抓取百度首页

在免配置浏览器中访问 https://www.baidu.com/，按主机筛选记录。

```http
GET / HTTP/1.1
Host: www.baidu.com
User-Agent: Mozilla/5.0 ...
Accept: text/html,...
Cookie: BAIDUID=示例值; ...

```

<div class="mt-7 grid grid-cols-2 gap-5 text-sm">
<div class="p-5 rounded-xl border border-blue-400/25">先找到页面请求<br><span class="opacity-60">再区分图片、脚本与其他资源</span></div>
<div class="p-5 rounded-xl border border-purple-400/25">查看对应响应<br><span class="opacity-60">状态码、内容类型与正文</span></div>
</div>

<!--
第 48–52 分钟。所有学生可跟随操作。外网不可用时继续用本地示例讲解。这里只观察正常浏览产生的流量，不对外部网站重放修改请求。
-->

---
layout: center
---

<h1 class="!text-4xl !font-semibold !m-0 tracking-wide">谢谢观看</h1>

<div class="mt-6 text-sm tracking-[0.3em] uppercase opacity-40">构建 · 通信 · 抓取 · 分析</div>

<div class="mt-10 text-sm opacity-60">结束前：恢复浏览器代理，停止本地演示服务。</div>

<div class="mt-16 text-xs opacity-30 font-mono">b1ank · 2026.10.18</div>

<!--
第 59–60 分钟。提醒恢复代理；补充资料：Yakit 官方 MITM 使用文档 https://yaklang.io/products/chapter-3/3-2/ 。
-->
