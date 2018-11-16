<?php
// require_once '@vendor\autoload.php';
$phpWord = new \PhpOffice\PhpWord\PhpWord();

$phpWord->setDefaultFontName('Courier New');
$phpWord->setDefaultFontSize(8);

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
	'marginTop' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1),
);
$section = $phpWord->addSection($sectionStyle);
$section->addText('"___" _________ 2018 р. № ___________');
$section->addText('Директору
ТОВ «ПРОПЕРТІ МЕНЕДЖМЕНТ СОЛЮШИНЗ ТУ»
п. Фощану О.М.
', array(), array());

$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('helloWorld.docx');

// print_r($phpWord);
?> 
