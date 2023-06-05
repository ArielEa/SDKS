<?php

//$xml = <<<XML
//<root>
//    <flag>success</flag>
//    <code>404</code>
//    <message>test api result</message>
//</root>
//XML;
//
//$xmlParse = @simplexml_load_string($xml);
//print_r( $xmlParse );
//print_r( $xmlParse->code );

//$xml = <<<XML
//<response>
//  <flag>success</flag>
//  <code></code>
//  <message>????</message>
//</response>
//XML;

//libxml_disable_entity_loader(true);
//$values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
//
//print_r( $values );
//
//die;

$abc = [
    [
        'tid' => 123,
        'order' => 123,
        'oid' => 123,
    ],
    [
        'tid' => 123,
        'order' => 1789,
        'oid' => 6,
    ],
    [
        'tid' => 123,
        'order' => 8761739,
        'oid' => 567,
    ],
];

$abc = array_column($abc, 'order', 'tid');

print_r( $abc );die;


$a = (14520 - 3400 - 2500) * 14 + 39300 + 10200 + 27000 + 3300 + 15000;

$a *= 20.2;

$b = $a - 730000 - (5000 + 5000) * 20.0 - 410000*2;

$c = $b / 20.2 / 12;

$d = 14520 * 12;

$e = (14520 - 3400 - 2500) * 8 + 39300 + 27000 + 15000;

var_dump( $a );
var_dump( $b );
var_dump( $c );
var_dump( $d );
var_dump( $e );
die;

class blank
{
    public function test(): array|bool
    {
        try {
//            throw new \Exception("test", 100);
            var_dump(123);
        }catch ( \Exception $e) {
            return $this->handle($e);
        }
        return false;
    }

    private function handle(Exception $e)
    {
        return [
            'code' => $e->getCode(),
            'message' => $e->getMessage()
        ];
    }
}

$a = (new blank())->test();

print_r( $a );
