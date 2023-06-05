package org.example.demo;

import lombok.Data;

import java.lang.String;
import java.lang.Integer;

@Data
public class DeliveryorderConfirmRequest {

    public DeliveryorderRequest deliveryOrder;

    public DeliveryorderPackageListRequest packages;

    public OrderLinesListRequest orderLines;
}

@Data
class DeliveryorderRequest
{
    public String deliveryOrderCode;

    public String warehouseCode;

    public String orderType;

    public String status;

    public String orderConfirmTime;

    public String operatorCode;

    public String operatorName;

    public String remark;
}