<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class DocController extends Controller
{
    public function phpword(Request $request)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        //设置默认样式
        $phpWord->setDefaultFontName('仿宋');//字体
        $phpWord->setDefaultFontSize(16);//字号

        //添加页面
        $section = $phpWord->createSection();

        //添加目录
        $styleTOC  = ['tabLeader' => \PhpOffice\PhpWord\Style\TOC::TABLEADER_DOT];
        $styleFont = ['spaceAfter' => 60, 'name' => 'Tahoma', 'size' => 12];
        $section->addTOC($styleFont, $styleTOC);

        //默认样式
        $section->addText('Hello PHP!');
        $section->addTextBreak();//换行符

        //指定的样式
        $section->addText(
            'Hello world!',
            [
                'name' => '宋体',
                'size' => 16,
                'bold' => true,
            ]
        );
        $section->addTextBreak(5);//多个换行符

        //自定义样式
        $myStyle = 'myStyle';
        $phpWord->addFontStyle(
            $myStyle,
            [
                'name' => 'Verdana',
                'size' => 12,
                'color' => '1BFF32',
                'bold' => true,
                'spaceAfter' => 20,
            ]
        );
        $section->addText('Hello Laravel!', $myStyle);
        $section->addText('Hello Vue.js!', $myStyle);
        $section->addPageBreak();//分页符

        //添加文本资源
        $textrun = $section->createTextRun();
        $textrun->addText('加粗', ['bold' => true]);
        $section->addTextBreak();//换行符
        $textrun->addText('倾斜', ['italic' => true]);
        $section->addTextBreak();//换行符
        $textrun->addText('字体颜色', ['color' => 'AACC00']);

        //超链接
        $linkStyle = ['color' => '0000FF', 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE];
        $phpWord->addLinkStyle('myLinkStyle', $linkStyle);
        $section->addLink('http://www.baidu.com', '百度一下', 'myLinkStyle');
        $section->addLink('http://www.baidu.com', null, 'myLinkStyle');

        //添加图片
        $imageStyle = ['width' => 480, 'height' => 640, 'align' => 'center'];
        $section->addImage('./img/t1.png', $imageStyle);
        $section->addImage('./img/php.jpg',$imageStyle);

        //添加标题
        $phpWord->addTitleStyle(1, ['bold' => true, 'color' => '1BFF32', 'size' => 38, 'name' => 'Verdana']);
        $section->addTitle('标题1', 1);
        $section->addTitle('标题2', 1);
        $section->addTitle('标题3', 1);

        //添加表格
        $styleTable = [
            'borderColor' => '006699',
            'borderSize' => 6,
            'cellMargin' => 50,
        ];
        $styleFirstRow = ['bgColor' => '66BBFF'];//第一行样式
        $phpWord->addTableStyle('myTable', $styleTable, $styleFirstRow);

        $table = $section->addTable('myTable');
        $table->addRow(400);//行高400
        $table->addCell(2000)->addText('学号');
        $table->addCell(2000)->addText('姓名');
        $table->addCell(2000)->addText('专业');
        $table->addRow(400);//行高400
        $table->addCell(2000)->addText('2015123');
        $table->addCell(2000)->addText('小明');
        $table->addCell(2000)->addText('计算机科学与技术');
        $table->addRow(400);//行高400
        $table->addCell(2000)->addText('2016789');
        $table->addCell(2000)->addText('小傻');
        $table->addCell(2000)->addText('教育学技术');

        //页眉与页脚
        $header = $section->createHeader();
        $footer = $section->createFooter();
        $header->addPreserveText('页眉');
        $footer->addPreserveText('页脚 - 页数 {PAGE} - {NUMPAGES}.');

        //生成的文档为Word2007
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save('./word/hello.docx');

        //将文档保存为HTML文件...
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
        $writer->save('./word/hello.html');
    }

    public function doc1(Request $request)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->createSection();

        $comcname = '贵阳';
        $czsr = 6.82;
        $section->addTitle('');
        $section->addTextBreak(5);;
        $section->addText($comcname."财政总收入10.91亿元，比上年增收3761万元，增长3.6%。其中：税务征收8.97亿元，增长6.5%；财政征收1.93亿元，下降8.3%。");
        $section->addTextBreak();
        $section->addText('公共财政预算收入'.$czsr.'亿元，比上年增收2727万元，增长4.2%。其中：税收收入4.89亿元，增长10.1%；非税收入完成1.93亿元，下降8.3%。');
        $section->addTextBreak();
        $section->addText($comcname.'公共财政预算支出32.93亿元, 同比增支5.1亿元，增长18.3%。主要支出项目完成情况是：');
        $section->addTextBreak();

        //生成的文档为Word2007
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $res = $writer->save('./word/'.date('YmdHis').'.docx');
        dump($res);
    }

    public function doc2(Request $request)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->createSection();
        $rn = "\n\n\n\n";

        $section->addTextBreak();
        $section->addTitle('——2020年5月12日在全南县第十八届人民代表大会第五次会议上');
        $section->addTextBreak();
        $section->addTitle('县财政局局长  曾慧华');
        $section->addTextBreak();
        $section->addText('各位代表：');
        $section->addTextBreak();
        $section->addText($rn.'一、2019年财政预算执行情况');
        $section->addTextBreak();
        $section->addText($rn.'（一）2019年财政预算收支执行情况', ['bold' => true]);
        $section->addTextBreak();
        $section->addText($rn.'1.公共财政预算收支执行情况', ['bold' => true]);
        $section->addTextBreak();
        $section->addText($rn.'受县人民政府委托，我向大会书面报告全南县2019年财政预算执行情况和2020年财政预算草案，请予审议，并请各位政协委员和其他列席会议的同志提出意见。');
        $section->addTextBreak();
        $section->addText($rn."财政总收入10.91亿元，比上年增收3761万元，增长3.6%。其中：税务征收8.97亿元，增长6.5%；财政征收1.93亿元，下降8.3%。");
        $section->addTextBreak();
        $section->addText($rn."公共财政预算收入6.28亿元，比上年增收2727万元，增长4.2%。其中：税收收入4.89亿元，增长10.1%；非税收入完成1.93亿元，下降8.3%。");
        $section->addTextBreak();
        $section->addText($rn."全县公共财政预算支出32.93亿元, 同比增支5.1亿元，增长18.3%。主要支出项目完成情况是：");
        $section->addTextBreak();
        $section->addText($rn."（1）一般公共服务支出47360万元，增长18%；");
        $section->addTextBreak();
        $section->addText($rn."（2）国防支出14万元，增长100%；");
        $section->addTextBreak();
        $section->addText($rn."（3）公共安全支出12371万元，增长25.6%；");
        $section->addTextBreak();
        $section->addTextRun($rn."（4）教育支出50287万元，增长12%。其中：普通教育支出45823万元，增长31.9%；".$rn."（5）科学技术支出6687万元，增长18.4%；");

        // 全县公共财政预算支出32.93亿元, 同比增支5.1亿元，增长18.3%。主要支出项目完成情况是：

        //生成的文档为Word2007
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $res = $writer->save('./word/'.date('YmdHis').'.docx');
    }
}