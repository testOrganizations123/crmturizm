<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: SalesPlatform Ltd
 * The Initial Developer of the Original Code is SalesPlatform Ltd.
 * All Rights Reserved.
 * If you have any questions or comments, please email: devel@salesplatform.ru
 ************************************************************************************/

require_once 'include/utils/utils.php';
require_once 'vtlib/Vtiger/Unzip.php';

/**
 * Describes operations, need to save files from one es and prepare them
 * to import.
 * @author alexd
 */
class ImportFileManager {
    
    /* File uploads directories */
    const UPLOAD_DIR = 'test/upload/1c/';
    
    /**
     * Initilizate load directory to import files.
     */
    public function __construct() {
        if(!file_exists(self::UPLOAD_DIR)) {
            mkdir(self::UPLOAD_DIR);
        }
    }
    
    /**
     * Return number in document name
     * @param type $importFileName
     * @return int | NULL
     */
    private function getImportFileNumber($importFileName) {
        $result = array();
        preg_match("/(\d{1,})/", $importFileName, $result);
        return current($result);
    }
    
    /**
     * Return an array of files name, sorted by $order and 
     * satisfy mask $mask. Not my realization.
     * @param string $searchDirectory
     * @param string $mask
     * @return array
     */
    private function getFiles($searchDirectory, $mask = '*') {
        $searchFiles = array();
        if (false !== ($files = scandir($searchDirectory)) ) {  
            foreach ($files as $i => $entry) {     
               if ($entry != '.' && $entry != '..' && fnmatch($mask, $entry)) {
                  $searchFiles[] = $entry;
               }
            }
        }
        return $searchFiles;
    }
    
    /**
     * Return name of the offers file by import file name.
     * @param String $importFileName
     * @return String
     */
    private function getOfferFileName($importFileName) {
        $fileNumber = $this->getImportFileNumber($importFileName);
        return 'offers'.$fileNumber.'.xml';
    }
    
    /**
     * Save file content by file named $fileName and return save status.
     * If file exists, append content to the end.
     * @param String $fileName
     * @return boolean
     */
    public function saveRequestFile($fileName) {
        $filePath = self::UPLOAD_DIR.$fileName;
        $fileContent = file_get_contents("php://input");
        if (!$fileContent) {
            return false;
        }
        
        $writeStatus = file_put_contents($filePath, $fileContent, FILE_APPEND | LOCK_EX);
        if(!$writeStatus) {
            return false;
        }
        chmod($filePath, 0666);     
        return true;
    }
    
    /**
     * Unzip all zip files and delete unzipped archives. 
     */
    private function unzipLoadedFiles() {
        $files = $this->getFiles(self::UPLOAD_DIR, "*.zip"); 
        foreach ($files as $file) {
            $unzip = new Vtiger_Unzip(self::UPLOAD_DIR.$file);
            if (!$unzip)  {
                unlink(self::UPLOAD_DIR.$file);
                continue;
            }
            $unzip->unzipAllEx(self::UPLOAD_DIR);
            $unzip->close();
            unlink(self::UPLOAD_DIR.$file);
        }
    }
    
    /**
     * Return order.xml file content
     * @param type $importFileName
     */
    public function getOrdersFileContent($importFileName) {
        $this->unzipLoadedFiles();
        $files = $this->getFiles(self::UPLOAD_DIR, "orders*.xml");
        $ordersContent = file_get_contents(self::UPLOAD_DIR.$files[0]);
        unlink(self::UPLOAD_DIR.$files[0]);
        return $ordersContent;
    }
    
    /**
     * Return import.xml file content.
     * @param type $importFileName
     */
    public function getImportFileContent($importFileName) {
        $this->unzipLoadedFiles();
        return file_get_contents(self::UPLOAD_DIR.$importFileName);
    }
    
    /**
     * Return offer.xml file contrnt
     * @param type $importFileName
     */
    public function getOffersFileContent($importFileName) {
        $this->unzipLoadedFiles();
        $offerFileName = $this->getOfferFileName($importFileName);      //specific of vtiger data model need
        return file_get_contents(self::UPLOAD_DIR.$offerFileName);
    }
    
}
