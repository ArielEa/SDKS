package org.example;

import org.example.demo.IndexRequest;

/**
 * Hello world!
 *
 */
public class App 
{
    public static void main( String[] args )
    {
        IndexRequest request = new IndexRequest();

        String res = request.request();
    }
}
