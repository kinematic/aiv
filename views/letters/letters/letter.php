<?php
use yii\data\ArrayDataProvider;

// require_once '@vendor\autoload.php';
$phpWord = new \PhpOffice\PhpWord\PhpWord();

$phpWord->setDefaultFontName('Courier New');
$phpWord->setDefaultFontSize(9);

$properties = $phpWord->getDocInfo();
$properties->setCreator('AIV');
$properties->setCompany("ПрАТ 'Київстар'");
$properties->setTitle('Письмо на проход');
$properties->setDescription('Письмо на проход');
$properties->setCategory('Доступ');
$properties->setLastModifiedBy('Александр Марченко');
$properties->setCreated(mktime(0, 0, 0, 3, 12, 2014));
$properties->setModified(mktime(0, 0, 0, 3, 14, 2014));
$properties->setSubject('My subject');
$properties->setKeywords('my, key, word');

$sectionStyle = array(
	'orientation' => 'landscape',
	'pageSizeH' => round(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(29.7), 0),
	'pageSizeW' => round(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(21), 0),
	'marginTop' => round(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1), 0),
	'marginBottom' => round(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1), 0),
	'marginLeft' => round(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(2), 0),
	'marginRight' => round(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1), 0),
);

$section = $phpWord->addSection($sectionStyle);
$section->addPageBreak();

$styleTable = array();
$styleFirstRow = array();
$styleCell = array();
$styleCellBTLR = array();
$fontStyle = array();
$phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
$table = $section->addTable('Fancy Table', array('width' => 100));

$table->addRow();
$widthCell = round(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(18)/2, 0);
$table->addCell($widthCell, $styleCell)
->addText('"___" _________ 2018 р. № ___________', $fontStyle);
$cell = $table->addCell($widthCell, $styleCell);
$cell->addText($model->appeal1, $fontStyle);
$cell->addText($model->appeal2, $fontStyle);

$section->addText('Дозвіл на прохід та виконання робіт на 2018 р. (UA0932)', array('italic' => TRUE));

$section->addText($model->appeal3, array('bold' => TRUE), array('align' => 'center'));

$textrun = $section->createTextRun();
$textrun->addText($model->text1);
$textrun->addText($model->site->fulladdress);
$textrun->addText($model->text2);

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->list,
    'key' => 'id',
    'sort' => [
        'attributes' => [
			'man.companyid', 
			'man.fullname'
		],
        'defaultOrder' => [
			'man.companyid' => SORT_ASC,
            'man.fullname' => SORT_ASC,
        ],
    ],
]);

$workers = $dataProvider->getModels();

foreach($workers as $key => $value) {
// 	print $key . '<br>';
	print_r($value);
// 	print $value['fullname'];


};




// header("Content-Description: File Transfer");
// header('Content-Disposition: attachment; filename="' . $model->site->sitename . '.docx"');
// header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
// header('Content-Transfer-Encoding: binary');
// header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
// header('Expires: 0');
// $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
// ob_clean();
// $xmlWriter->save("php://output");
// exit;

?> 
