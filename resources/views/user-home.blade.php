<h1>{{$email}}，欢迎您使用本系统</h1>

<p>您目前已使用的流量为 ： {{$usage}} 。 流量上限为 ： {{$max}}</p>

<p>您的账号配置：</p>

<p>二维码图片可用于直接扫描加载配置</p>
<p><img src="{{$imgSrc}}" width="200" height="200"></p>

<p>vmess链接可用于复制后在软件内使用"粘贴板（剪切板）加载"来加载配置</p>
<p style="width:500px;height:300px;word-wrap:break-word;">{{$vmess}}</p>
