package org.example.demo;

import java.io.IOException;
import java.lang.*;
import java.util.Date;
import java.text.SimpleDateFormat;
import com.alibaba.fastjson.JSON;
import org.example.demo.DeliveryorderConfirmRequest;
import com.alibaba.fastjson.JSONObject;

import org.example.demo.GenerateSign;

public class IndexRequest {

    public String body = "";

    public String request()
    {
        try {
//            this.DeliveryPartsRequest();
            this.EntryOrderRequest();
        }catch (IOException ioException) {

        }

        return "test request";
    }

    public void DeliveryPartsRequest() throws IOException
    {
        DeliveryorderConfirmRequest confirmRequest = new DeliveryorderConfirmRequest();
        confirmRequest.setDeliveryorderCode("22xxxxxx8810");
        confirmRequest.setOperatorCode("sustem");
        confirmRequest.setWarehouseCode("warehouse");
        confirmRequest.setOrderType("JYCK");
        confirmRequest.setOrderConfirmTime("2022-08-25 15:00:00");
        confirmRequest.setStatus("DELIVERED");
        confirmRequest.setRemark("发货单确认");
        confirmRequest.setOperatorName("System");


        DeliveryorderPackage deliveryorderPackage = new DeliveryorderPackage();

        deliveryorderPackage.setPackageCode("ZX-1523756");
        deliveryorderPackage.setLogisticsCode("STO");
        deliveryorderPackage.setLogisticsName("申通");
        deliveryorderPackage.setExpressCode("7764xxxxx754");
        deliveryorderPackage.setWeight((float) 1.77);

        DeliveryorderPackageMaterial deliveryorderPackageMaterial = new DeliveryorderPackageMaterial();
        deliveryorderPackageMaterial.setType("XYY35");
        deliveryorderPackageMaterial.setQuantity(1);

        DeliveryOrderPackageList deliveryOrderPackageList = new DeliveryOrderPackageList();
        deliveryOrderPackageList.setPackageMaterial(deliveryorderPackageMaterial);

        DeliveryorderItem deliveryorderItem = new DeliveryorderItem();
        deliveryorderItem.setItemId("itemCode");
        deliveryorderItem.setItemCode("itemCode");
        deliveryorderItem.setQuantity(1);
        DeliveryorderItemList deliveryorderItemList = new DeliveryorderItemList();
        deliveryorderItemList.setItem(deliveryorderItem);

        deliveryorderPackage.setPackageMaterialList(deliveryOrderPackageList);
        deliveryorderPackage.setItems(deliveryorderItemList);

        DeliveryorderPackageListRequest deliveryorderPackageListRequest = new DeliveryorderPackageListRequest();
        deliveryorderPackageListRequest.setPackageList(deliveryorderPackage);

        confirmRequest.setPackages(deliveryorderPackageListRequest);


        OrderLinesRequest orderLinesRequest = new OrderLinesRequest();
        orderLinesRequest.setOrderLineNo("1");
        orderLinesRequest.setItemCode("itemCode");
        orderLinesRequest.setActualQty(1);
        orderLinesRequest.setItemName("itemName");
        orderLinesRequest.setInventoryType("ZP");
        orderLinesRequest.setBatchCode("");

        OrderLinesListRequest orderLinesListRequest = new OrderLinesListRequest();
        orderLinesListRequest.setOrderLine(orderLinesRequest);

        confirmRequest.setOrderLines(orderLinesListRequest);


        String jsonData = JSON.toJSONString(confirmRequest);

        // fixme json 签名
        String newJsonData = jsonData.replace("packageList", "package");

        this.body = newJsonData;

        GenerateSign generateSign = new GenerateSign();

        generateSign.getSign("delivery-confirm", newJsonData);

    }

    public void EntryOrderRequest() throws IOException
    {

        EntryOrderRequest entryOrderRequest = new EntryOrderRequest();
        entryOrderRequest.setEntryOrderCode("E202208243549");
        entryOrderRequest.setEntryOrderId("E202208243549");
        entryOrderRequest.setWarehouseCode("warehouse");
        entryOrderRequest.setOwnerCode("customerId");
        entryOrderRequest.setEntryOrderType("DBRK"); // 调拨入库
        entryOrderRequest.setOutBizCode("xxxxxx");
        entryOrderRequest.setConfirmType("1");
        entryOrderRequest.setStatus("FULFILLED");
        entryOrderRequest.setOperateTime("2022-08-25 15:00:00");
        entryOrderRequest.setRemark("调拨入库确认");

        OrderLinesRequest orderLinesRequest = new OrderLinesRequest();
        orderLinesRequest.setOrderLineNo("1");
        orderLinesRequest.setItemCode("itemCode");
        orderLinesRequest.setActualQty(1);
        orderLinesRequest.setItemName("itemName");
        orderLinesRequest.setInventoryType("ZP");
        orderLinesRequest.setBatchCode("");

        OrderLinesListRequest orderLinesListRequest = new OrderLinesListRequest();
        orderLinesListRequest.setOrderLine(orderLinesRequest);

        entryOrderRequest.setOrderLines(orderLinesListRequest);

        String entryJson = JSON.toJSONString(entryOrderRequest);

        GenerateSign generateSign = new GenerateSign();

        generateSign.getSign("entry-order-confirm", entryJson);
    }
}
