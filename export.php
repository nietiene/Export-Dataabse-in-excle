<?php
$conn = mysqli_connect('localhost', 'root', '', 'replace_your_database');

if (!$conn) {
    die ("ERROR". mysqli_connect_error());

}
$table = "replace_your_table_here";
$selectData = "SELECT * FROM $table";
$retrieve = mysqli_query($conn, $selectData);

header("Content-Type: application/vnd.ms-excel");
// this method of header() handle some content that will be sent ot the browser
// Content-Type => this explain the type of data we are sending to our browser to be downloaded later
// aplication/vdn.ms-excel => this tell browser that it is microsoft excel we are sending 
header("Content-Disposition: attachement; filename={$table}_holiday.xls");
// Content-Disposing => this show how browser should interact with received content 
//attachement => this tells browser to download content instead of displaying it in browser. only download without displaying
// filename => this contain our table data
// {$table} = this varable contain or table stored in database
// _ this semicolumn separate or combine or table in database and our file in ms-excel
// holiday.xls => here you will replace your random name you want ot give your file in ms-excel  


$DbField = mysqli_fetch_fields($retrieve);
// mysql_fetch_fields() => brother this method allows you to get all columns in your table
foreach($DbField as $field) {
    // mn reka nkoreshe kinyarwanda kugirango ubyumve fresh
    // iyi variable ya $DbField i containing colums zose dufite mur database ex: id, name, password
    // noneho as $fiels // iyi yariable ya $field storing buri culumn ukwayo 
    // byari bimeze gutya $DbFields = [id, name, passowrd];
    // noneho as $field bihita bimera gutya $field = [id], $field = [name], $field = [password];
    // mn buri column iyi storing ukwayo sufatax
    echo $field -> name. "\t"; // iyi line ishyira buri culumn muri tab yayo to avoid disorder
    // noheho $field -> name; iyi name ihagarariye each column_name id, name, passowrd byonyine
    // gusa hejuru ($DbField as $field) hano ni column name na values zazo
    // . "\t" iyi ni tab buri column mur ms-excel iraza kuba ifite tab yayo kaba kameze nka rectangural mur ms-excel

}
echo "\n"; // mn iyi "\n" ikora nka <br> yoyo ivuga new line
while($rows = mysqli_fetch_assoc($retrieve)) { // iyi line i getting data as key and value ex $rows = [1, 'nathan', 122];
   // nikuriya i gettinga data
    echo implode("\t", $rows). "\n"; // iyi line iraza gufata za data izishire muri tab zitandukanye muri excel 
    // noneho implode() iy method yoyo ira joining mn buri data iyishyira muri tab yayo nkuko twabikoze kuri column
    // ex nimba byari bimeze gutya [1, 'nathan', 12343] birahita bimera gutya [1] [nathan] [1222] []=>udufate nka tab
   // . "\n" noneho buri data zizajya zia munsi yizindi
}

mysqli_close($conn); // tugaclosing connection 

?>
