package org.example.demo;

import lombok.Data;
import java.lang.String;

@Data
class DeliveryorderItem {
    public String itemCode;

    public String itemId;

    public Integer quantity;
}

@Data
class DeliveryorderItemList
{
    public DeliveryorderItem item;
}
