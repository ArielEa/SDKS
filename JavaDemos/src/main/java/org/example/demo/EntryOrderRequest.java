package org.example.demo;

import lombok.Data;

@Data
class EntryOrderRequest {
    public EntryOrder entryOrder;

    public OrderLinesListRequest orderLines;
}

@Data
class EntryOrder
{
    public String entryOrderCode;

    public String entryOrderId;

    public String warehouseCode;

    public String ownerCode;

    public String entryOrderType;

    public String outBizCode;

    public String confirmType;

    public String status;

    public String operateTime;

    public String Remark;
}