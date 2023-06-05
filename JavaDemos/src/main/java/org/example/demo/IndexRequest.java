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

        DeliveryorderRequest deliveryorderRequest = new DeliveryorderRequest();
        deliveryorderRequest.setDeliveryOrderCode("22xxxxxx8810");
        deliveryorderRequest.setOperatorCode("sustem");
        deliveryorderRequest.setWarehouseCode("warehouse");
        deliveryorderRequest.setOrderType("JYCK");
        deliveryorderRequest.setOrderConfirmTime("2022-08-25 15:00:00");
        deliveryorderRequest.setStatus("DELIVERED");
        deliveryorderRequest.setRemark("发货单确认");
        deliveryorderRequest.setOperatorName("System");

        confirmRequest.setDeliveryOrder(deliveryorderRequest);


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

//        // fixme json 签名
        String newJsonData = jsonData.replace("packageList", "package");

        this.body = newJsonData;

        GenerateSign generateSign = new GenerateSign();

        generateSign.getSign("delivery-confirm", newJsonData);

    }

    public void EntryOrderRequest() throws IOException
    {

        EntryOrderRequest entryOrderRequest = new EntryOrderRequest();

        EntryOrder entryOrder = new EntryOrder();
        entryOrder.setEntryOrderCode("E202208243549");
        entryOrder.setEntryOrderId("E202208243549");
        entryOrder.setWarehouseCode("warehouse");
        entryOrder.setOwnerCode("customerId");
        entryOrder.setEntryOrderType("DBRK"); // 调拨入库
        entryOrder.setOutBizCode("xxxxxx");
        entryOrder.setConfirmType("1");
        entryOrder.setStatus("FULFILLED");
        entryOrder.setOperateTime("2022-08-25 15:00:00");
        entryOrder.setRemark("调拨入库确认");

        entryOrderRequest.setEntryOrder(entryOrder);

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
