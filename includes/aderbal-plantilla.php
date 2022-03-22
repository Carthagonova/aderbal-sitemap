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
 $domblog = new DOMDocument('1.0','UTF-8');
 $domblog->formatOutput = true;
 $rootblog = $domblog->createElement('urlset');
 $domblog->appendChild($rootblog);
 $rootblog->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
 //$resultblog->setAttribute('id', 1);
 $argsblog = array(
   'posts_per_page' => -1,
   //'post__not_in' => array($post->ID), // Ensure that the current post is not displayed
   'post_type' => 'aderbal',
   'orderby' => 'date',
   'order'   => 'DESC',
 'post_status' => 'publish',
 );
 $obtencionblog = new WP_Query( $argsblog );
 if ( $obtencionblog-> have_posts() ) : ?>
 <?php while ( $obtencionblog->have_posts() ) : $obtencionblog->the_post();

   $enlace = get_permalink();
   $lastestmod = get_the_modified_date('Y-m-d');
   $resultblog = $domblog->createElement('url');
   $rootblog->appendChild($resultblog);
   $resultblog->appendChild( $domblog->createElement('loc', $enlace) );
   $resultblog->appendChild( $domblog->createElement('lastmod', $lastestmod) );
 endwhile;
 endif; wp_reset_postdata();

   echo '<div class="codigo-post"><xmp>'.  $domblog->saveXML() .'</xmp></div>';
   echo  '<div class="comprobadorcsanchez"><a href="' . $rutita . '/sitemap-eventos-aderbal.xml" target="_blank">Comprobar Sitemap</a></div>';
 $domblog->save('sitemap-eventos-aderbal.xml') or die('XML Create Error');




   ?>
 </section>
 <div class="watermark">Plugin generado por&nbsp;<a target="_blank" href="https://carlos.sanchezdonate.com/">Carlos Sánchez</a></div>
 </x-layout>
</body>
 <?php


  wp_footer();
?>
