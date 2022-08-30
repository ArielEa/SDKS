package org.example.demo;

import lombok.Data;

@Data
class EntryOrderRequest {
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

    public OrderLinesListRequest orderLines;
}
