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

// $section->addTextBreak();

$styleTable = array();
$styleFirstRow = array();
$styleCell = array();
$styleCellBTLR = array();
$fontStyle = array('size' => 9);
$paragraphStyle = array('spaceAfter' => 0);
$phpWord->addTableStyle('Header Table Style', $styleTable, $styleFirstRow);
$table = $section->addTable('Header Table', array('width' => 100));

$table->addRow();

$widthCell = round(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(18)/2, 0);
$table->addCell($widthCell, $styleCell)
->addText('"___" _________ 2018 р. № ___________', $fontStyle, $paragraphStyle);
$cell = $table->addCell($widthCell, $styleCell);
$cell->addText($model->appeal1, $fontStyle, $paragraphStyle);
$cell->addText($model->appeal2, $fontStyle, $paragraphStyle);

$section->addTextBreak();
$section->addText('Дозвіл на прохід та виконання робіт на 2018 р. (UA0932)', array('italic' => TRUE));
$section->addTextBreak();
$section->addText($model->appeal3, array('bold' => TRUE), array('align' => 'center'));
$section->addTextBreak();
// $textrun = $section->addTextRun(array('indent' => 720));
$textrun = $section->addTextRun(array('indentation' => array('firstLine' => 720)));

$textrun->addText($model->text1);
$textrun->addText($model->site->fulladdress);
$textrun->addText($model->text2);

$section->addTextBreak();

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

// $phpWord->addTableStyle('Fancy Table', array('cellMarginRight' => 170), $styleFirstRow);
$phpWord->addTableStyle('People Table Style', array('cellMargin' => array('right' => 170)), $styleFirstRow);
$table = $section->addTable('People Table', array('width' => 70));
print round(\PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.27), 0);
$fontStyle = array('size' => 8);
$paragraphStyle = array('spaceAfter' => 0);
$styleCell = array();

foreach($workers as $key => $value) {
	$table->addRow();
	$table->addCell(null, $styleCell)->addText($key + 1, $fontStyle, $paragraphStyle);
	$table->addCell(null, $styleCell)->addText($value->man->fullname, $fontStyle, $paragraphStyle);
	$table->addCell(null, $styleCell)->addText($value->man->position, $fontStyle, $paragraphStyle);
};

$section->addTextBreak();

$textrun = $section->addTextRun();

$textrun->addText($model->signature->position);
$textrun->addText($model->signature->manid);


header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $model->site->sitename . '.docx"');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Expires: 0');
$xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
ob_clean();
$xmlWriter->save("php://output");
exit;

?> 
