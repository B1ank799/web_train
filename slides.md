---
theme: seriph
title: Web安全入门简介
info: |
  ## Web安全基础
class: text-center
drawings:
  persist: false
transition: slide-left
colorSchema: dark
background: /cover.jpg
---

# Web 安全入门
你未曾了解过的互联网世界


---

# 互联网 & Web

### 🌐 互联网
- 由大量设备和网络连接起来的**通信系统**
- 电脑、手机、服务器、智能设备通过它交换数据

### 🌍 Web（万维网）
- 建立在互联网之上的**信息服务**
- 我们访问的网站、管理后台、手机 APP 的服务端接口，大多属于 Web 应用

Web 应用一般包含：**前端、后端、数据库、浏览器、服务器**等部分。

>因此，Web 安全也是较为贴近日常生活的安全方向之一

---

<style scoped>
li {
  margin-bottom: 0.8rem;   
}
</style>

# 什么是 Web 安全？

> Web 安全研究的是 Web 应用在**设计、开发、部署、运行**过程中可能出现的**安全问题**。

漏洞可能来自：
- ⽤户输⼊没有被正确检查和处理
- 数据库查询语句被错误拼接
- 服务器配置错误
- 使⽤了存在已知漏洞的第三⽅组件
- 开发过程中遗留了调试接⼝、源码或备份⽂件

在 CTF 中，我们通常需要利⽤题⽬有意设置的漏洞，找到名为flag的通关凭证

---

# 常见 Web 安全漏洞

<style scoped>
li {
  margin-bottom: 0.8rem;   
}
</style>

1. 信息泄露
2. SQL 注入
3. 跨站脚本攻击（XSS）
4. 跨站请求伪造（CSRF）
5. 文件上传漏洞
6. 路径穿越与文件包含

---

# 常见 Web 安全漏洞

<style scoped>
li {
  margin-bottom: 0.8rem;   
}
</style>

7. 服务端请求伪造（SSRF）
8. 服务端模板注入（SSTI）
9. 反序列化漏洞
10. 认证与访问控制漏洞

 Web的知识可以说是非常丰富，对初学者来说，慢慢学习并掌握才是最重要的，不要因数量繁多而感到为难

<img src="/1.jpg" alt="jiayou" style="float: right;width: 20%; margin: 0 auto;" />

---

<style scoped>
li {
  margin-bottom: 0.8rem;   
}
</style>

# 如何学习 Web 安全？

Web 方向知识繁多，初学者建议先掌握以下基础：

1. **F12 开发者工具** – 页面调试与分析
2. **控制台（Console）** – 前端开发调试台
3. **抓包工具**（如 Burp Suite、Yakit） – 分析网络请求
4. **基础 Linux 命令** – 服务器操作
5. **了解基础的后端语言**（PHP/Java/Python 等）  

  >前端代码多阅读即可，主要是起一个对前端页面的装修作用

⚠️ 使用工具的同时，**理解其原理**更重要。善用 AI 和搜索引擎会事半功倍。

---

# 演示环节

#### 我们对迎新小游戏进行演示

---
background: /2.jpg
---

<style scoped>
li {
  margin-bottom: 0.8rem;   
}
</style>

# 结语

##### 最后，希望大家能保持好奇，持续探索，徜徉在互联网的世界。
