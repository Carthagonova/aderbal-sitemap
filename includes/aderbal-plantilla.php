<?php
/*
*
* Template Name: aderbal-sitemap
*
*/
 wp_head();

 define("pagina","sitemapgenerator");
 $current_pagina = 'sitemapgenerator';

 $protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http' . '://';
 $rutita = $current_url="//".$_SERVER['HTTP_HOST'];

 /* Template Name: sitemapgenerator */;


 ?>
 <meta name="viewport" content="initial-scale=1, maximum-scale=6">

 <link rel='stylesheet'href='<?php echo plugin_dir_url( __DIR__ );?>/includes/front-end/css/aderbal.css' type='text/css' media='all' />
<body>
 <x-layout>
   <h1 class="aderbalh1">Generador Automático de Sitemaps</h1>
   
 <section>
   <?php
   echo "<h2 class='h2carlossanchez'>Posts</h2>";
   $dom = new DOMDocument('1.0','UTF-8');
   $dom->formatOutput = true;
   $root = $dom->createElement('urlset');
   $dom->appendChild($root);
   $root->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
   //$result->setAttribute('id', 1);
   $args = array(
     'posts_per_page' => -1,
     //'post__not_in' => array($post->ID), // Ensure that the current post is not displayed
     'post_type' => 'post',
     'orderby' => 'date',
     'order'   => 'DESC',
   'post_status' => 'publish',
   );
   $obtencion = new WP_Query( $args );
   if ( $obtencion-> have_posts() ) : ?>
   <?php while ( $obtencion->have_posts() ) : $obtencion->the_post();
   $enlace = get_permalink();
   $lastestmod = get_the_modified_date('Y-m-d');
     $result = $dom->createElement('url');
     $root->appendChild($result);
     $result->appendChild( $dom->createElement('loc', $enlace) );
     $result->appendChild( $dom->createElement('lastmod', $lastestmod) );
  endwhile;
  endif; wp_reset_postdata();

   echo '<div class="codigo-post"><xmp>'. $dom->saveXML() .'</xmp></div>';
   echo  '<div class="comprobadorcsanchez"><a href="' . $rutita . '/sitemap-posts-aderbal.xml" target="_blank">Comprobar Sitemap</a></div>';
 $dom->save('sitemap-posts-aderbal.xml') or die('XML Create Error');
?>
  </section>


  <section>
    <?php

 // Con eventos
 echo "<h2 class='h2carlossanchez'>Eventos Aderbal</h2>";
 $domblog = new DOMDocument('1.0', 'UTF-8');
 $domblog->formatOutput = true;
 $rootblog = $domblog->createElement('urlset');
 $domblog->appendChild($rootblog);
 $rootblog->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
 
 $argsblog = array(
   'posts_per_page' => -1,
   'post_type' => 'aderbal',
   'orderby' => 'date',
   'order' => 'DESC',
   'post_status' => 'publish',
 );
 $obtencionblog = new WP_Query($argsblog);
 if ($obtencionblog->have_posts()) :
   while ($obtencionblog->have_posts()) : $obtencionblog->the_post();
 
     $enlace = get_permalink();
     $lastestmod = get_the_modified_date('Y-m-d');
     $resultblog = $domblog->createElement('url');
     $rootblog->appendChild($resultblog);
     $resultblog->appendChild($domblog->createElement('loc', $enlace));
     $resultblog->appendChild($domblog->createElement('lastmod', $lastestmod));
   endwhile;
 endif;
 wp_reset_postdata();
 
 echo '<div class="codigo-post"><xmp>' . $domblog->saveXML() . '</xmp></div>';
 echo '<div class="comprobadorcsanchez"><a href="' . $rutita . '/sitemap-eventos-aderbal.xml" target="_blank">Comprobar Sitemap</a></div>';
 $domblog->save('sitemap-eventos-aderbal.xml') or die('XML Create Error');
 
 echo "<hr></p><h2>Noticia</h2>";
 $domnoticia = new DOMDocument('1.0', 'UTF-8');
 $domnoticia->formatOutput = true;
 $domnoticia->preserveWhiteSpace = false;
 $domnoticia->formatOutput = true;
 $xslt = $domnoticia->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="wp-content/themes/sanchezdonate/core/css/stylesheet.xsl"');
 $domnoticia->appendChild($xslt);
 $rootnoticia = $domnoticia->createElement('urlset');
 $domnoticia->appendChild($rootnoticia);
 $rootnoticia->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
 $rootnoticia->setAttribute('xmlns:news', 'http://www.google.com/schemas/sitemap-news/0.9');
 $rootnoticia->setAttribute('xmlns:image', 'http://www.google.com/schemas/sitemap-image/1.1');
 
 $argsnoticia = array(
   'posts_per_page' => -1,
   'post_type' => 'Noticia',
   'orderby' => 'date',
   'order' => 'DESC',
   'post_status' => 'publish',
 );
 $obtencionnoticia = new WP_Query($argsnoticia);
 if ($obtencionnoticia->have_posts()) {
   while ($obtencionnoticia->have_posts()) {
     $obtencionnoticia->the_post();
 
     if (!get_field("canonical")) {
       $metarobots_checked_values = get_field('metarobots');
       if (($metarobots_checked_values && in_array('all', $metarobots_checked_values)) || in_array('index', $metarobots_checked_values)) {
         $enlace = get_permalink();
         $lastestmod = get_the_modified_date('Y-m-d\TH:i:s.uP');
         $resultnoticia = $domnoticia->createElement('url');
         $rootnoticia->appendChild($resultnoticia);
         $resultnoticia->appendChild($domnoticia->createElement('loc', $enlace));
         $resultnoticia->appendChild($domnoticia->createElement('lastmod', $lastestmod));
         $publicationDate = get_the_date('Y-m-d\TH:i:s.uP');
         $publicationDateTimestamp = strtotime($publicationDate);
         $currentDateTimestamp = strtotime(date('Y-m-d'));
         $daysDifference = floor(($currentDateTimestamp - $publicationDateTimestamp) / (60 * 60 * 24));
 
         if ($daysDifference <= 2) {
           // Añadir estructura adicional dentro de <news:news>
           $newsElement = $domnoticia->createElement('news:news');
           $resultnoticia->appendChild($newsElement);
           $titulonoticia = get_the_title();
           $publishednoticia = get_the_date('Y-m-d\TH:i:s.uP');
           $newstitle = get_field('title');
 
           // Definir las variables dentro de <news:news> según tus necesidades
           $publicationElement = $domnoticia->createElement('news:publication');
           $publicationNameElement = $domnoticia->createElement('news:name', $titulonoticia);
           $publicationLanguageElement = $domnoticia->createElement('news:language', 'es');
           $publicationElement->appendChild($publicationNameElement);
           $publicationElement->appendChild($publicationLanguageElement);
           $newsElement->appendChild($publicationElement);
 
           $publicationDateElement = $domnoticia->createElement('news:publication_date', $publishednoticia);
           $newsElement->appendChild($publicationDateElement);
 
           $titleElement = $domnoticia->createElement('news:title', $newstitle);
           $newsElement->appendChild($titleElement);
         }
 
         // Obtener las imágenes en el contenido de the_content()
         $content = get_the_content();
         $pattern = '/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/';
         preg_match_all($pattern, $content, $matches);
 
         // Agregar las URL de las imágenes al elemento <url>
         if (!empty($matches[1])) {
           foreach ($matches[1] as $image_url) {
             $image_element = $domnoticia->createElement('image:image');
             $resultnoticia->appendChild($image_element);
 
             $loc_element = $domnoticia->createElement('image:loc', $image_url);
             $image_element->appendChild($loc_element);
           }
         }
       }
     }
   }
   wp_reset_postdata();
 }
 
 echo '<div class="codigo-post"><xmp>' . $domnoticia->saveXML() . '</xmp></div>';
 echo '<a href="' . $rutita . '/sitemap-news.xml" target="_blank">Comprobar Sitemap</a>';
 $domnoticia->save('sitemap-news.xml') or die('XML Create Error');
 



   ?>
 </section>
 <div class="watermark">Plugin generado por&nbsp;<a target="_blank" href="https://carlos.sanchezdonate.com/">Carlos Sánchez</a></div>
 </x-layout>
</body>
 <?php


  wp_footer();
?>
