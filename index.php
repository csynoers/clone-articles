<?php
$dir    = [
   './*.txt',
   './*/*.txt',
   './*/*/*.txt',
   './*/*/*/*.txt',
   './*/*/*/*/*.txt',
   './*/*/*/*/*/*.txt',
];
$result= [];
foreach ( $dir as $key => $value ) {
   foreach( glob($value) as $file ){
      $text= get_texts( $file ); 
      $result[]= [
         'src' => strtolower(str_replace(' ','-', explode('/',$file)[1] ) ).'.jpg',
         'title'=> $text['title'],
         'seo'=> strtolower(str_replace(' ','-',$text['title'])),
         'desc'=> '<p>'.str_replace('\'','"',$text['desc']).'</p>',
      ];
   }
}

function get_texts( $file )
{
   $text = file_get_contents($file);
   $str = strtok($text, "\n");
   return [
      'title' => $str,
      'desc' => get_desc( $text ),
   ];
}

function get_desc( $file )
{
   $text= str_replace("Ahli Sumur Bor Air Jakarta Raditia Teknik","<a href='{home}'><strong>Ahli Sumur Bor Air Jakarta Raditia Teknik</strong></a>", preg_replace('/^.+\n/', '', $file) );
   $text2= str_replace("www.servicepompaairjakarta.com", "<a href='{home}'>www.servicepompaairjakarta.com</a>" , $text);
   $text3= str_replace("Telpon : 085215573803 (AS) / 08174991283 (XL)", "{telpon}" , $text2);
   $text4= str_replace("Telpon 085215573803 (AS) / 08174991283 (XL)", "{telpon}" , $text3);
   $text5= str_replace("Telp. Raditia Teknik 085215573803 (AS) / 08174991283 (XL)", "{telpon}" , $text4);
   $text6= str_replace("Telp. Raditia Teknik 085215573803 (AS)/ 08174991283 (XL)", "{telpon}" , $text5);
   $text7= str_replace("Telp. Raditia Teknik 085215573803 (AS)/ 08174991283 (XL)", "{telpon}" , $text6);
   $text8= str_replace("{telpon}", "<strong>Telp. Raditia Teknik 085215573803 (AS) / 08174991283 (XL)</strong>" , $text7);
   $text9= str_replace("{home}", "https://www.servicepompaairjakarta.com/service-pompaair-jakarta" , $text8);
    
   return $text9;
}

echo "<pre>";
print_r($result);
echo "</pre>";

// generate query
// $g= "INSERT INTO artikel(judul, isi, hari, tanggal, jam, gambar) VALUES ";
// foreach ($result as $k => $v) {
//    $g .= " ('{$v["title"]}','{$v["desc"]}','Selasa','".date('Y-m-d')."','".date('h:i:s')."','{$v["src"]}'),";
// }
// echo substr($g,0,-1).';';
// end generate query



