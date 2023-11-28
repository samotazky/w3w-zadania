<?php
ini_set('memory_limit', '16M');
/*
$xml_url = "https://demo.shopio.cz/export/zbozi-heureka/";

$xml_data = file_get_contents($xml_url);

if (!$xml_data) {
    die ("Nepodarilo sa načítať XML zo stránky");
} else {
    $xml = simplexml_load_string($xml_data);
    //print_r($xml);

    foreach($xml->SHOPITEM as $oneItem) {
        $productName = $oneItem->PRODUCTNAME;
        $productDescription = $oneItem->DESCRIPTION;
        $productCategory = $oneItem->CATEGORYTEXT;
        $productPrice = $oneItem->PRICE_VAT;
        $productManufacturer = $oneItem->MANUFACTURER;
        $productParamName = $oneItem->PARAM->PARAM_NAME;
        $productParamVal = $oneItem->PARAM->VAL;

        echo "<strong>Názov:</strong> $productName";
        echo "<br>";

        echo "<strong>Popis:</strong> $productDescription";
        echo "<br>";
        
        echo "<strong>Kategória:</strong> $productCategory";
        echo "<br>";

        echo "<strong>Cena:</strong> $productPrice kč";
        echo "<br>";

        echo "<strong>Výrobca</strong> $productManufacturer";
        echo "<br>";
        
        echo "<strong>Parametre:</strong> $productParamName"." ".$productParamVal;
        echo "<hr>";
    }
}*/


class Product {
    public $productName;
    public $productDescription;
    public $productCategory; 
    public $productPrice;
    public $productManufacturer;
    public $productParamName;
    public $productParamVal;

    public function __construct($name,$description, $category, $price, $manufacturer, $paramNam, $paramVal) {
        $this->productName = $name;
        $this->productDescription = $description;
        $this->productCategory = $category;
        $this->productPrice = $price;
        $this->productManufacturer = $manufacturer; 
        $this->productParamName = $paramNam;
        $this->productParamVal = $paramVal; 
    }

    public function displayInfo() {
        echo "<strong>Názov: </strong> $this->productName<br>";
        echo "<strong>Popis: </strong> $this->productDescription<br>";
        echo "<strong>Kategória: </strong> $this->productCategory<br>";
        echo "<strong>Cena: </strong> $this->productPrice kč<br>";
        echo "<strong>Výrobca: </strong> $this->productManufacturer<br>";
        echo "<strong>Parametre: </strong> $this->productParamName"." "."$this->productParamVal<hr>";
    }
}

class ProductList {
    private $products = [];

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function displayProducts() {
        foreach($this->products as $oneProduct) {
            $oneProduct->displayInfo();
        }
    }
}

$xml = simplexml_load_file("https://demo.shopio.cz/export/zbozi-heureka/");

$productList = new ProductList();

foreach($xml->SHOPITEM as $oneItem) {
    $product = new Product(
        (string)$oneItem->PRODUCTNAME,
        (string)$oneItem->DESCRIPTION,
        (string)$oneItem->CATEGORYTEXT,
        (string)$oneItem->PRICE_VAT,
        (string)$oneItem->MANUFACTURER,
        (string)$oneItem->PARAM->PARAM_NAME,
        (string)$oneItem->PARAM->VAL
    );

    $productList->addProduct($product);
}

$productList->displayProducts();