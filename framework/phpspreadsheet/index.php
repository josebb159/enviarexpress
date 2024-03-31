<?php
require 'vendor/autoload.php';
include '../../model/producto.php';

$n_producto  = new producto();
$productos = $n_producto -> buscar_producto_excel();

$n_producto  = new producto();
$productos_categoria = $n_producto -> buscar_producto_categoria_excel();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();

$sheet = $spreadsheet->getActiveSheet();

//$sheet
//->setCellValue('D1', 'DATOS CORPORATIVOS DE DATOS ESPECIALES \n hola');
//$sheet->getActiveSheet()->getStyle('D1')->getAlignment()->setWrapText(true);
$spreadsheet->getActiveSheet()->getCell('D1')->setValue("Enviar Express C.A 001\nAV. BRICEÑO MENDEZ CASA N° 3-18 SECTOR CENTRO BARINAS\nBARINAS 5201\nVENEZUELA");
$spreadsheet->getActiveSheet()->getStyle('D1')->getAlignment()->setWrapText(true);



$spreadsheet->getActiveSheet()->mergeCells('D1:I1');





$cont = 3;




foreach($productos_categoria as $productos_categoria){
    $porciones = explode("#", $productos_categoria['color']);

    $sheet->setCellValue('A'.$cont, "-")
    ->setCellValue('B'.$cont,$productos_categoria['nombre'] );


      $spreadsheet->getActiveSheet()->getStyle('B'.$cont)
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);

    $spreadsheet->getActiveSheet()->getStyle('B'.$cont)
    ->getFill()->getStartColor()->setARGB($porciones[1]);
    $cont++;
    
}




$cont++;
$cont++;






//hear tittle producto 

$sheet
->setCellValue('A'.$cont, 'N°')
->setCellValue('B'.$cont, 'IMAGEN')
->setCellValue('C'.$cont, 'Código')
->setCellValue('D'.$cont, 'PRODUCTO')
->setCellValue('E'.$cont, 'UNIDADES')
->setCellValue('F'.$cont, 'P/U')
->setCellValue('G'.$cont, 'PEDIDO');

$spreadsheet->getActiveSheet()->getStyle('A'.$cont.':H'.$cont)->getFont()->setBold(true);

$spreadsheet->getActiveSheet()->getStyle('A'.$cont)
->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);


$spreadsheet->getActiveSheet()->getStyle('B'.$cont)
->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

$spreadsheet->getActiveSheet()->getStyle('C'.$cont)
->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

$spreadsheet->getActiveSheet()->getStyle('D'.$cont)
->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

$spreadsheet->getActiveSheet()->getStyle('E'.$cont)
->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

$spreadsheet->getActiveSheet()->getStyle('F'.$cont)
->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

$spreadsheet->getActiveSheet()->getStyle('G'.$cont)
->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$spreadsheet->getActiveSheet()->getStyle('H'.$cont)
->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

$spreadsheet->getActiveSheet()->getStyle('A'.$cont.':G'.$cont)
 ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

   $spreadsheet->getActiveSheet()->getStyle('A'.$cont.':G'.$cont)
 ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);


  //end hear tittle product

$cont++;








/*
$drawing->setName('Paid2');
$drawing->setDescription('Paid2');
$drawing->setPath('images/pr.jpg'); /* put your path and image here 
$drawing->setCoordinates('A3');
$drawing->setOffsetX(0);
$drawing->setWidth(50);
$drawing->setHeight(50);
$drawing->getShadow()->setVisible(true);
$drawing->getShadow()->setDirection(45);
$drawing->setWorksheet($spreadsheet->getActiveSheet());

$spreadsheet->getActiveSheet()->getRowDimension('2')->setRowHeight(50);
$spreadsheet->getActiveSheet()->getRowDimension('3')->setRowHeight(50);

*/

function addImage($path,$coordinates,$sheet, $height){
    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $drawing->setPath($path);
    $drawing->setCoordinates($coordinates);
    $drawing->setWidth(50);
    $drawing->setOffsetX(10); 
    $drawing->setOffsetY(5); 
    $drawing->setHeight($height);
    $drawing->setWorksheet($sheet);
}


//ALTO
$spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(100);
//$spreadsheet->getActiveSheet()->getRowDimension('2')->setRowHeight(50);
//$spreadsheet->getActiveSheet()->getRowDimension('3')->setRowHeight(50);

//ANCHO
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('d')->setWidth(20);


//addImage('images/pr.jpg','A2',$spreadsheet->getActiveSheet(), 50);
//addImage('images/pr.jpg','A3',$spreadsheet->getActiveSheet(),50 );
addImage('images/logo.png','A1',$spreadsheet->getActiveSheet(), 100);

$spreadsheet->getActiveSheet()->getStyle('A1:I1')
    ->getFont()->getColor()->setARGB('88ED58');
$spreadsheet->getActiveSheet()->getStyle('A1:I1')
    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
$spreadsheet->getActiveSheet()->getStyle('A1:I1')
    ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$spreadsheet->getActiveSheet()->getStyle('A1:I1')
    ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$spreadsheet->getActiveSheet()->getStyle('A1:I1')
    ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$spreadsheet->getActiveSheet()->getStyle('A1:I1')
    ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$spreadsheet->getActiveSheet()->getStyle('A1:I1')
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
$spreadsheet->getActiveSheet()->getStyle('A1:I1')
    ->getFill()->getStartColor()->setARGB('000000');


    $sheet->getStyle('A:I')->getAlignment()->setHorizontal('center');


    $spreadsheet->getActiveSheet()->getStyle('D1')
    ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
    /*
    $styleArray = [
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                'color' => ['argb' => 'FFFF0000'],
            ],
        ],
    ];
    $spreadsheet->getStyle('D1')->applyFromArray($styleArray);
*/




$i = 1;
$sheet->getStyle('A')->getAlignment()->setHorizontal('center');
foreach($productos as $producto){
    $porciones = explode("#", $producto['color']);
    addImage('../upload/'.$producto['img'],'B'.$cont,$spreadsheet->getActiveSheet(), 100);
    $sheet
    ->setCellValue('A'.$cont, $i)
    ->setCellValue('B'.$cont, '')
    ->setCellValue('C'.$cont, $producto['referencia'])
    ->setCellValue('D'.$cont, $producto['nombre'])
    ->setCellValue('E'.$cont, 1)
    ->setCellValue('F'.$cont, $producto['precio_venta'])
    ->setCellValue('G'.$cont, ' ');
    $spreadsheet->getActiveSheet()->getRowDimension($cont)->setRowHeight(100);


//lineas vertical
//$spreadsheet->getActiveSheet()->getStyle('A'.$cont.':I'.$cont)
 //   ->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

  //  $spreadsheet->getActiveSheet()->getStyle('A'.$cont.':I'.$cont)
  //  ->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);



    $spreadsheet->getActiveSheet()->getStyle('A'.$cont)
        ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      

        $spreadsheet->getActiveSheet()->getStyle('B'.$cont)
        ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

        $spreadsheet->getActiveSheet()->getStyle('C'.$cont)
        ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

        $spreadsheet->getActiveSheet()->getStyle('D'.$cont)
        ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

        $spreadsheet->getActiveSheet()->getStyle('E'.$cont)
        ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

        $spreadsheet->getActiveSheet()->getStyle('F'.$cont)
        ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
        
        $spreadsheet->getActiveSheet()->getStyle('G'.$cont)
        ->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);







    $spreadsheet->getActiveSheet()->getStyle('A'.$cont.':G'.$cont)
        ->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);




    $spreadsheet->getActiveSheet()->getStyle('A'.$cont.':G'.$cont)
    ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);

    $spreadsheet->getActiveSheet()->getStyle('A'.$cont.':G'.$cont)
    ->getFill()->getStartColor()->setARGB($porciones[1]);

    $sheet->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getStyle('A'.$cont.":"."G".$cont)
    ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $spreadsheet->getActiveSheet()->getStyle('A'.$cont.":"."G".$cont)
    ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    
    $cont++;
    $i++;

}




$writer = new Xlsx($spreadsheet);
$writer->save('producto.xlsx');


header("Content-disposition: attachment; filename=producto.xlsx");
header("Content-type: application/pdf");
readfile("producto.xlsx");