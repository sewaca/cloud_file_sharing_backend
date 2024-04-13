<?php 

class HZip{private static function folderToZip($folder,&$zipFile,$exclusiveLength) {$handle=opendir($folder);while(false!==$f=readdir($handle)){if($f!='.'&&$f!='..'){$filePath="$folder/$f";$localPath=substr($filePath,$exclusiveLength);if(is_file($filePath)){$zipFile->addFile($filePath,$localPath);}elseif(is_dir($filePath)){$zipFile->addEmptyDir($localPath);self::folderToZip($filePath,$zipFile,$exclusiveLength);}}}closedir($handle);} public static function zipDir($sourcePath,$outZipPath){$pathInfo=pathInfo($sourcePath);$parentPath=$pathInfo['dirname'];$dirName=$pathInfo['basename'];$z=new ZipArchive();$z->open($outZipPath,ZIPARCHIVE::CREATE);$z->addEmptyDir($dirName);self::folderToZip($sourcePath,$z,strlen("$parentPath/"));$z->close();}} 

/**
 * Compresses a folder into a zip archive.
 *
 * @param string $source The path to the folder to be compressed.
 * @param string $destination The path to the destination zip archive.
 * @return string The path to the created zip archive.
 */
function compress_folder($source, $destination) {
    if (!is_dir($source)) return include BASE_PATH."/server/404.php";

    HZip::zipDir($source, $destination);

    return $destination;
}