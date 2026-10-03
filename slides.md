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

# Web 服务构建与抓包入门

<div class="mt-6 text-lg opacity-60 font-light tracking-wide">
  从最简单的 web 服务搭建，到用 Yakit 抓取真实流量
</div>

<div class="mt-14 flex justify-center gap-3 text-sm">
  <span class="px-4 py-1.5 rounded-full border border-current opacity-70">PHP</span>
  <span class="px-4 py-1.5 rounded-full border border-current opacity-70">Yakit</span>
  <span class="px-4 py-1.5 rounded-full border border-current opacity-70">HTTP</span>
</div>

<div class="absolute bottom-10 left-0 right-0 text-xs opacity-30 font-mono">
  b1ank · 2026.10.18
</div>

---
layout: default
---

<div class="pt-6">

# 上回书说到……

<div class="mt-10 pl-5 border-l-2 border-white/30 text-lg leading-relaxed opacity-80">
  互联网是由 <strong class="opacity-100">大量设备</strong> 和 <strong class="opacity-100">网络</strong> 连接起来的通信系统。
</div>

<div class="mt-10 text-base leading-loose opacity-70">
  所以，web 服务通常是某些设备 <span class="text-blue-400">开放</span> 在 <span class="text-blue-400">特定端口</span> 上的 <span class="text-blue-400">信息服务</span>。
</div>

<div v-click class="mt-14 p-6 rounded-lg border border-blue-400/30 bg-blue-400/5 transition-all duration-500">
  <div class="text-base leading-relaxed">
    那么，要怎么构建这种信息服务呢？我们进行一个最简单的演示。
  </div>
</div>

</div>

---
layout: section
---

<div class="text-sm tracking-[0.3em] uppercase opacity-40 font-light mb-3">
  Part 01
</div>

<h1 class="!text-3xl !font-semibold !m-0 tracking-wide">
  构建 Web 服务
</h1>

<div class="mt-5 w-10 h-px bg-white/30 mx-auto"></div>

---
layout: default
---

<div class="pt-6">

# 最简单的 Web 应用

<div class="mt-8 text-base leading-loose opacity-70">
  在上面的演示中，我们了解了如何将本地的 PHP 文件放到端口上，实现最简单的 web 应用。
</div>

<div class="mt-10 text-sm tracking-widest uppercase opacity-40">
  相似的编程语言还有
</div>

<div class="mt-4 grid grid-cols-4 gap-4 text-center">

  <div class="py-5 rounded-lg border border-white/10 bg-white/5 transition-colors hover:border-white/25">
    <div class="text-lg font-medium">PHP</div>
  </div>

  <div class="py-5 rounded-lg border border-white/10 bg-white/5 transition-colors hover:border-white/25">
    <div class="text-lg font-medium">Python</div>
  </div>

  <div class="py-5 rounded-lg border border-white/10 bg-white/5 transition-colors hover:border-white/25">
    <div class="text-lg font-medium">Java</div>
  </div>

  <div class="py-5 rounded-lg border border-white/10 bg-white/5 transition-colors hover:border-white/25">
    <div class="text-lg font-medium">JavaScript</div>
  </div>

</div>

<div v-click class="mt-12 pl-5 border-l-2 border-blue-400/40 text-base leading-loose opacity-80 transition-all duration-500">
  但是，现实中的 web 服务是十分 <strong class="opacity-100">复杂</strong> 的。当我们 <strong class="opacity-100">没有办法获取直接的后端代码</strong> 时，<span class="text-blue-400">抓包</span> 会是很有利的一个 <strong class="opacity-100">信息搜集方法</strong>。
</div>

</div>

---
layout: default
---

<div class="pt-6">

# Tips：PHP 内置服务器

<div class="mt-8 p-6 rounded-lg border border-white/10 bg-white/5 leading-loose">
  <div class="text-xs tracking-widest uppercase opacity-40 mb-3">Tips</div>
  <div class="opacity-80">
    <code class="px-1.5 py-0.5 rounded bg-white/10 text-blue-400 text-sm">php -S</code>
    是启动 <strong class="opacity-100">PHP 内置开发服务器</strong>（Built-in Web Server）的命令。
  </div>
  <div class="mt-3 opacity-60 text-sm leading-relaxed">
    不用装 Apache、Nginx，就能直接在本地跑 PHP 网页，适合开发调试。
  </div>
</div>

<v-click>

```bash
# 在当前目录启动服务，监听 8000 端口
php -S 0.0.0.0:8000
```

</v-click>

<v-click>

<div class="mt-10 pl-5 border-l-2 border-yellow-400/40 text-sm leading-relaxed opacity-60">
  感兴趣的同学可以在培训结束后进行简单的网页构建尝试。
</div>

</v-click>

</div>

---
layout: section
---

<div class="text-sm tracking-[0.3em] uppercase opacity-40 font-light mb-3">
  Part 02
</div>

<h1 class="!text-3xl !font-semibold !m-0 tracking-wide">
  抓包
</h1>

<div class="mt-5 w-10 h-px bg-white/30 mx-auto"></div>

---
layout: default
---

<div class="pt-6">

# 什么是抓包？

<div class="mt-10 pl-5 border-l-2 border-white/30 text-lg leading-relaxed opacity-80">
  <strong class="opacity-100">抓包</strong>，英文常叫 <strong class="opacity-100">Packet Capture</strong>。
</div>

<div class="mt-8 text-base leading-loose opacity-70">
  简单说就是：把网络传输中的 <span class="text-blue-400">数据包</span> 截获并记录下来，用来查看、分析网络通信内容。
</div>

<div class="mt-12 text-sm tracking-widest uppercase opacity-40">
  常用工具
</div>

<div class="mt-4 grid grid-cols-3 gap-4 text-center">

  <div class="py-6 rounded-lg border border-purple-400/30 bg-purple-400/5">
    <div class="text-xl font-medium">Yakit</div>
    <div class="text-xs opacity-50 mt-2">本课使用</div>
  </div>

  <div class="py-6 rounded-lg border border-white/10 bg-white/5">
    <div class="text-xl font-medium">Burp Suite</div>
    <div class="text-xs opacity-50 mt-2">Web 渗透利器</div>
  </div>

  <div class="py-6 rounded-lg border border-white/10 bg-white/5">
    <div class="text-xl font-medium">Wireshark</div>
    <div class="text-xs opacity-50 mt-2">流量分析</div>
  </div>

</div>

</div>

---
layout: default
---

<div class="pt-6">

# 实战样例：抓取百度请求

<div class="mt-6 text-sm opacity-50">
  这是一个提前抓好的包，一个完整的 HTTP 请求报文长这样 👇
</div>

```http
GET /index.php?tn=68018901_58_oem_dg HTTP/1.1
Host: www.baidu.com
User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:156.0) Gecko/20100101 Firefox/156.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.9,zh-TW;q=0.8,zh-HK;q=0.7,en-US;q=0.6,en;q=0.5
Accept-Encoding: gzip, deflate, br, zstd
Referer: https://cn.bing.com/
Connection: keep-alive
Cookie: BAIDUID=A1995B9A85E608458A6EB3D177CE5AF3:FG=1; BAIDU_WISE_UID=wapp_1785836406297_280; __bid_n=19fcc25055823046d1f4b4; BAIDUID_BFESS=BF7C1CCD1EB0339F99F3946B442E5E6A:FG=1:FG=1; BIDUPSID=BF7C1CCD1EB0339F99F3946B442E5E6A; PSTM=1790936194; H_PS_PSSID=63142_73906_73951_73974_74001_73994_74548_74598_74716_74732_74663_74785_74790_74833_74902_74920_75012_75078_75120_75130_75132_75139_75256_75268_75155_75136; BD_UPN=133352; BA_HECTOR=812k0l078h850k8ha0240k0l81bk2l1lbv14b29; ZFY=NkVUPXNBJkhD2DJkbq:A8FQSlJTCwO5PogbOoqwexadk:C
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: cross-site
Sec-Fetch-User: ?1
Priority: u=0, i
```

</div>

---
layout: default
---

<div class="pt-6">

# 请求行：请求方法 + 路径 + 协议版本

```http
GET /index.php?tn=68018901_58_oem_dg HTTP/1.1
```

<div class="mt-10 grid grid-cols-3 gap-4 text-center">

  <div class="py-5 rounded-lg border border-green-400/30 bg-green-400/5">
    <div class="text-xl font-semibold">GET</div>
    <div class="text-xs opacity-50 mt-2">请求方法</div>
  </div>

  <div class="py-5 rounded-lg border border-blue-400/30 bg-blue-400/5">
    <div class="text-lg font-semibold">/index.php?tn=...</div>
    <div class="text-xs opacity-50 mt-2">请求路径 + 参数</div>
  </div>

  <div class="py-5 rounded-lg border border-purple-400/30 bg-purple-400/5">
    <div class="text-xl font-semibold">HTTP/1.1</div>
    <div class="text-xs opacity-50 mt-2">协议版本</div>
  </div>

</div>

</div>

---
layout: default
---

<div class="pt-6">

# 关键请求头速览

<div class="mt-8 text-sm">

| 请求头 | 作用 |
| --- | --- |
| `Host` | 目标主机（虚拟主机识别） |
| `User-Agent` | 客户端浏览器 / 系统指纹 |
| `Referer` | 从哪个页面跳转过来（**来源**） |
| `Cookie` | 身份凭证 / 会话信息（**重点**） |
| `Connection` | 连接管理方式（`keep-alive`） |


</div>

<div v-click class="mt-8 pl-5 border-l-2 border-yellow-400/40 text-sm leading-relaxed opacity-70">
  渗透测试中，<code class="px-1.5 py-0.5 rounded bg-white/10 text-blue-400">Cookie</code>、<code class="px-1.5 py-0.5 rounded bg-white/10 text-blue-400">User-Agent</code>、<code class="px-1.5 py-0.5 rounded bg-white/10 text-blue-400">Referer</code> 等往往是 <strong class="opacity-100">信息搜集</strong> 与 <strong class="opacity-100">越权测试</strong> 的突破口。
</div>

</div>

---
layout: section
---

<div class="text-sm tracking-[0.3em] uppercase opacity-40 font-light mb-3">
  Part 03
</div>

<h1 class="!text-3xl !font-semibold !m-0 tracking-wide">
  Yakit 实战
</h1>

<div class="mt-5 w-10 h-px bg-white/30 mx-auto"></div>

---
layout: default
---

<div class="pt-6">

# 实战：对百度进行抓包

<div class="mt-8 text-base leading-loose opacity-70">
  接下来，请同学们自行下载 <strong class="opacity-100">Yakit</strong>，并对 <span class="text-blue-400">https://www.baidu.com/</span> 进行实战。
</div>

<div class="mt-10 grid grid-cols-2 gap-6">

  <div class="p-6 rounded-lg border border-green-400/20 bg-green-400/5">
    <div class="text-xs tracking-widest uppercase text-green-400/60 mb-3">方式一</div>
    <div class="text-lg font-medium mb-3">免配置启动</div>
    <div class="text-sm opacity-70 leading-relaxed">
      提前装有 Chrome 浏览器的同学，可以免配置直接启动使用 Yakit，无需手动修改系统代理。
    </div>
  </div>

  <div class="p-6 rounded-lg border border-blue-400/20 bg-blue-400/5">
    <div class="text-xs tracking-widest uppercase text-blue-400/60 mb-3">方式二</div>
    <div class="text-lg font-medium mb-3">手动配置代理</div>
    <div class="text-sm opacity-70 leading-relaxed">
      没有 Chrome 的同学，对自己的浏览器进行代理配置，或使用代理插件进行配置。
    </div>
  </div>

</div>

</div>

---
layout: default
---

<div class="pt-6">

# 配置要点

<div class="mt-8 p-6 rounded-lg border border-white/10 bg-white/5 font-mono text-sm leading-loose opacity-80">

1. 启动 Yakit，打开「MITM 交互式劫持」<br>
2. 确认监听地址与端口（默认 127.0.0.1:8083）<br>
3. 浏览器代理指向该地址<br>
4. 访问 https://www.baidu.com/<br>
5. 回到 Yakit 的 History 中查看抓取到的请求

</div>

<div class="mt-10 grid grid-cols-2 gap-6">

  <div class="p-5 rounded-lg border border-orange-400/20 bg-orange-400/5">
    <div class="text-xs tracking-widest uppercase text-orange-400/60 mb-3">常见问题</div>
    <div class="text-sm opacity-70 leading-relaxed">
      · 页面打不开 → 检查代理端口<br>
      · HTTPS 报错 → 证书未信任<br>
      · 抓不到包 → 代理未生效
    </div>
  </div>

  <div class="p-5 rounded-lg border border-purple-400/20 bg-purple-400/5">
    <div class="text-xs tracking-widest uppercase text-purple-400/60 mb-3">观察重点</div>
    <div class="text-sm opacity-70 leading-relaxed">
      · 请求行与请求头<br>
      · Cookie 的变化<br>
      · 参数传递方式<br>
      · 响应状态码与内容
    </div>
  </div>

</div>

</div>

---
layout: center
class: text-center
---

<div class="text-sm tracking-[0.3em] uppercase opacity-40 font-light mb-6">
  Practice
</div>

<h1 class="!text-3xl !font-semibold !m-0">课后小练习</h1>

<div class="mt-10 text-left inline-block opacity-80 leading-loose">

1. 用 <code class="px-1.5 py-0.5 rounded bg-white/10 text-blue-400">php -S 0.0.0.0:8000</code> 起一个本地服务，浏览器访问看看
2. 用 Yakit 抓取一次 <code class="px-1.5 py-0.5 rounded bg-white/10 text-blue-400">www.baidu.com</code> 的完整请求
3. 找出你这次请求里的 `Cookie` 与 `User-Agent`
4. 思考：如果去掉 `Cookie`，页面会有什么变化？

</div>

<div class="mt-14 text-sm opacity-40">
  抓包的本质，是理解「数据如何流动」
</div>

---
layout: center
class: text-center
---

<h1 class="!text-4xl !font-semibold !m-0 tracking-wide">谢谢观看</h1>

<div class="mt-6 text-sm tracking-[0.3em] uppercase opacity-40">
  构建 · 通信 · 抓取 · 分析
</div>

<div class="mt-16 text-xs opacity-30 font-mono">
  b1ank · 2026.10.18
</div>
