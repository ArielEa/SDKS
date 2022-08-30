package org.example.demo;

import lombok.Data;

import java.lang.String;

@Data
class DeliveryorderPackage {

    public String logisticsCode;

    public String logisticsName;

    public String expressCode;

    public String packageCode;

    public float length;

    public float width;

    public float height;

    public float weight;

    public float volume;

    public String invoiceNo;

    public DeliveryOrderPackageList packageMaterialList;

    public DeliveryorderItemList items;
}

@Data
class DeliveryorderPackageListRequest
{
    public DeliveryorderPackage packageList;
}
