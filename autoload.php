<?php

namespace MusicSort;

spl_autoload_register(function( $class ) {
  $classFile = str_replace( '\\', DIRECTORY_SEPARATOR, $class );
  $classPI = pathinfo( $classFile );
  $classPath = strtolower( $classPI[ 'dirname' ] );
  include_once( $classPath . DIRECTORY_SEPARATOR . $classPI[ 'filename' ] . '.php' );
});
