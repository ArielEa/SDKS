package org.example.demo;

import java.io.UnsupportedEncodingException;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.text.SimpleDateFormat;
import java.util.Arrays;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;
import java.io.IOException;
import java.net.URLEncoder;

import com.alibaba.fastjson.JSON;
import org.apache.commons.lang.StringUtils;
import org.example.App;

import java.net.URLDecoder;

public class GenerateSign {

    private String AppKey = "26314927";
    private static String SecretKey = "7e636468adb10c4840f8d88be14514e0";
    private String CustomerId = "cdkj"; // 用户customerId
    private String WarehouseCode = "chengdukuajing"; // 仓库编码
//    private String host = "https://uitestapi.b2c.omnixdb.com/wms-service/openapi/delivery-confirm";
    private String host = "https://zhao.b2c.omnixdb.com/wms-service/openapi/db-instock-confirm";
    public String format = "json";
    public String connectTimeout;
    public String readTimeout;
    public String signMethod = "md5";
    public String apiVersion = "1.0";
    public String sdkVersion = "oms-sdk-20220825";
    public String customerid = "cdkj";

    public String sign(String method, String newJsonData) throws IOException {
        Map<String, String> sysParams = new HashMap<>();

        Date date = new Date();
        SimpleDateFormat dateFormat= new SimpleDateFormat("yyyy-MM-dd hh:mm:ss");
        String currentTime = dateFormat.format(date).toString();

        sysParams.put("app_key", AppKey);
        sysParams.put("v", apiVersion);
        sysParams.put("format", format);
        sysParams.put("sign_method", signMethod);
        sysParams.put("method", method);
        sysParams.put("timestamp", currentTime);
        sysParams.put("customerId", customerid);


        String[] keys = sysParams.keySet().toArray(new String[0]);
        Arrays.sort(keys);

        String secretKey = SecretKey;

        // 第二步：把所有参数名和参数值串在一起
        StringBuilder query = new StringBuilder();
//        if (Constants.SIGN_METHOD_MD5.equals(signMethod)) {
//            query.append(secretKey);
//        }
//        query.append(secretKey);
        for (String key : keys) {
            String value = sysParams.get(key);
            if (StringUtils.isNotEmpty(value)) {
                query.append(key).append(value);
            }
        }

        // 第三步：把请求主体拼接在参数后面
        if (newJsonData != null) {
            query.append(newJsonData);
        }

        // 第四步：使用MD5/HMAC加密
        byte[] bytes;
        return "";
    }

    public void getSign(String method, String body)
    {
        Date date = new Date();
        SimpleDateFormat dateFormat= new SimpleDateFormat("yyyy-MM-dd hh:mm:ss");
        String currentTime = dateFormat.format(date);

        Map<String, String> sysParams = new HashMap<>();
        sysParams.put("app_key", AppKey);
        sysParams.put("method", method);
        sysParams.put("timestamp", URLEncoder.encode(currentTime));
        sysParams.put("v", apiVersion);
        sysParams.put("sign_method", signMethod);
        sysParams.put("customerId", customerid);
        sysParams.put("format", format);

        String secretKey = SecretKey;

        String md5 = sign(sysParams, body, secretKey);

        StringBuilder url = new StringBuilder(host + "?");

        for (String key : sysParams.keySet()) {
            url.append(key).append("=").append(sysParams.get(key)).append("&");
        }
        url.append("&sign=").append(md5);

        HashMap<String, String> headers = new HashMap<>(3);

        headers.put("content-type", "application/json");

        HttpUtils httpUtils = new HttpUtils();
        String interfaceRes = httpUtils.sendPostWithJson(url.toString(), body, headers);

        try {
            System.out.println(JSON.parse(interfaceRes));
        }
        catch (Exception e) {
            e.printStackTrace();
        }

    }

    public static String sign(Map<String, String> params, String body, String secretKey)
    {
        // 1. 第一步，确保参数已经排序

        String[] keys = params.keySet().toArray(new String[0]);

        Arrays.sort(keys);

        // 2. 第二步，把所有参数名和参数值拼接在一起(包含body体)

        //your_secretKeyapp_keyyour_appkeycustomerIdyour_customerIdformatxmlmethodyour_methodsign_methodmd5timestamp2022-08-25 15:00:00vyour_versionyour_bodyyour_secretKey

        String joinedParams = joinRequestParams(params, body, secretKey, keys);

        // 3. 第三步，使用加密算法进行加密（目前仅支持md5算法）

        String signMethod = params.get("sign_method");

        if (!"md5".equalsIgnoreCase(signMethod)) {
            return null;

        }

        byte[] abstractMesaage = digest(joinedParams);

        // 4. 把二进制转换成大写的十六进制

        String sign = byte2Hex(abstractMesaage);

        return sign;
    }

    private static Map<String, String> getParamsFromUrl(String url) {
        Map<String, String> requestParams = new HashMap<String, String>();
        try {
            String fullUrl = URLDecoder.decode(url, "UTF-8");
            String[] urls = fullUrl.split("\\?");
            if (urls.length == 2) {
                String[] paramArray = urls[1].split("&");
                for (String param : paramArray) {
                    String[] params = param.split("=");
                    if (params.length == 2) {
                        requestParams.put(params[0], params[1]);
                    }
                }
            }
        } catch (UnsupportedEncodingException e) { }
        return requestParams;
    }

    private static String byte2Hex(byte[] bytes)
    {
        char hexDigits[] = { '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F' };
        int j = bytes.length;
        char str[] = new char[j * 2];
        int k = 0;
        for (byte byte0 : bytes) {
            str[k++] = hexDigits[byte0 >>> 4 & 0xf];
            str[k++] = hexDigits[byte0 & 0xf];
        }
        return new String(str);
    }

    private static byte[] digest(String message)  {
        try {
            MessageDigest md5Instance = MessageDigest.getInstance("MD5");
            md5Instance.update(message.getBytes("UTF-8"));
            return md5Instance.digest();
        } catch (UnsupportedEncodingException e) {
            //TODO
            return null;
        } catch (NoSuchAlgorithmException e) {
            //TODO
            return null;
        }
    }

    private static String joinRequestParams(Map<String, String> params, String body, String secretKey, String[] sortedKes)
    {
        StringBuilder sb = new StringBuilder(secretKey); // 前面加上secretKey

        for (String key : sortedKes) {
            if ("sign".equals(key)) {
                continue; // 签名时不计算sign本身
            } else {
                String value = params.get(key);
                if (isNotEmpty(key) && isNotEmpty(value)) {
                    sb.append(key).append(value);
                }
            }
        }
        sb.append(body); // 拼接body体
        sb.append(secretKey); // 最后加上secretKey
        return sb.toString();

    }

    private static boolean isNotEmpty(String s) {

        return null != s && !"".equals(s);

    }
}
