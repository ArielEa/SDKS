package org.example.demo;

import lombok.Data;

@Data
class DeliveryorderPackageMaterial {
    public String type;

    public Integer quantity;
}


@Data
class DeliveryOrderPackageList {

    public DeliveryorderPackageMaterial packageMaterial;
}