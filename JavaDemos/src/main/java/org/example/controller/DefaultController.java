package org.example.controller;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;


public class DefaultController {

    @RequestMapping("/redis_test")
    @ResponseBody
    public String IndexAction()
    {

        return  "abcd";
    }
}
