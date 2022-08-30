package org.example.demo;

import lombok.Data;

import java.lang.String;
import java.lang.Integer;

@Data
public class DeliveryorderConfirmRequest {

    public String deliveryorderCode;

    public String warehouseCode;

    public String orderType;

    public String status;

    public String orderConfirmTime;

    public String operatorCode;

    public String operatorName;

    public String remark;

    public DeliveryorderPackageListRequest packages;

    public OrderLinesListRequest orderLines;
}
