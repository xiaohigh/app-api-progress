# api接口内容

1. app接口实现和注意事项

2. 三方平台的接口调用

## 通过版本来一步一步的完善接口

1. version-1 简单的创建只能返回一个结果

2. version-2 对返回的结果进行情况划分, xml和json格式

3. version-3 对返回结果的功能进行封装,完善xml格式返回功能,添加多个api接口

4. version-4 添加时间戳检测

5. version-5 添加md5签名检测

6. version-6 添加默认token进行组合签名

7. version-7 添加登陆操作. 登陆向客户端写入登陆token, 针对登陆操作必须使用登陆token来签名

8. version-8 添加多种加密方式, 确保签名的隐秘