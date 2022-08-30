package org.example.demo;

import lombok.Data;
import java.lang.*;

@Data
class OrderLinesRequest {

    public String orderLineNo;

    public String itemCode;

    public String itemId;

    public String itemName;

    public String inventoryType;

    public Integer actualQty;

    public String batchCode;

    public String productDate;

    public String expireDate;

    public String produceCode;
}

@Data
class OrderLinesListRequest
{
    public OrderLinesRequest orderLine;
}

