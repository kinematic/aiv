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
	'pageSizeH' => 16838,
	'pageSizeW' => 11906,
	'marginTop' => 567,
	'marginBottom' => 567,
	'marginLeft' => 1134,
	'marginRight' => 567,
);

$section = $phpWord->addSection($sectionStyle);

// $section->addTextBreak();

$styleTable = array();
$styleFirstRow = array();
$styleCell = array();
$styleCellBTLR = array();
$fontStyle = array('size' => 9);
$paragraphStyle = array('spaceAfter' => 0);
$phpWord->addTableStyle('HeaderTableStyle', $styleTable, $styleFirstRow);
$table = $section->addTable('HeaderTableStyle', array('width' => 100));

$table->addRow();

$widthCell = 5102;
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
$textrun = $section->addTextRun(array('indentation' => array('firstLine' => 720), 'alignment'  => \PhpOffice\PhpWord\SimpleType\Jc::BOTH));

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
$phpWord->addTableStyle('PeopleTableStyle', array('cellMargin' => array('right' => 170)), $styleFirstRow);
$table = $section->addTable('PeopleTableStyle', array('width' => 70));

$fontStyle = array('size' => 8);
$paragraphStyle = array('spaceAfter' => 0);
$styleCell = array();

foreach($workers as $key => $value) {
	$table->addRow();
	$table->addCell(567, $styleCell)->addText($key + 1, $fontStyle, $paragraphStyle);
	$table->addCell(2835, $styleCell)->addText($value->man->fullname, $fontStyle, $paragraphStyle);
	$table->addCell(2835, $styleCell)->addText($value->man->position, $fontStyle, $paragraphStyle);
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
